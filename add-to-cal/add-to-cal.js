/* jshint browser:true */
var MS_IN_MINUTES = 60 * 1000;
var formatTimeToCal = function (date) {
    return date.toISOString().replace(/-|:|\.\d+/g, '');
};
var calculateEndTimeToCal = function (event) {
    return event.end ?
        formatTimeToCal(event.end) :
        formatTimeToCal(new Date(event.start.getTime() + (event.duration * MS_IN_MINUTES)));
};
var addToCalendarUrls = {
    google: function (event) {
        var startTime = formatTimeToCal(event.start);
        var endTime = calculateEndTimeToCal(event);

        startTime = startTime.substr(0, 15);
        endTime = endTime.substr(0, 15);

        var href = encodeURI([
        'https://www.google.com/calendar/render',
        '?action=TEMPLATE',
        '&text=' + (event.title || ''),
        '&dates=' + (startTime || ''),
        '/' + (endTime || ''),
        '&details=' + (event.description || ''),
        '&location=' + (event.address || ''),
        '&sprop=&sprop=name:'
      ].join(''));
        return href;
    },

    yahoo: function (event) {
        var eventDuration = event.end ?
            ((event.end.getTime() - event.start.getTime()) / MS_IN_MINUTES) :
            event.duration;

        // Yahoo dates are crazy, we need to convert the duration from minutes to hh:mm
        var yahooHourDuration = eventDuration < 600 ?
            '0' + Math.floor((eventDuration / 60)) :
            Math.floor((eventDuration / 60)) + '';

        var yahooMinuteDuration = eventDuration % 60 < 10 ?
            '0' + eventDuration % 60 :
            eventDuration % 60 + '';

        var yahooEventDuration = yahooHourDuration + yahooMinuteDuration;

        // Remove timezone from event time
        var st = formatTimeToCal(new Date(event.start - (event.start.getTimezoneOffset() *
            MS_IN_MINUTES))) || '';

        var href = encodeURI([
        'http://calendar.yahoo.com/?v=60&view=d&type=20',
        '&title=' + (event.title || ''),
        '&st=' + st,
        '&dur=' + (yahooEventDuration || ''),
        '&desc=' + (event.description || ''),
        '&in_loc=' + (event.address || '')
      ].join(''));

        return href;
    },

    ics: function (event) {
        var startTime = formatTimeToCal(event.start);
        var endTime = calculateEndTimeToCal(event);

        startTime = startTime.substr(0, 15);
        endTime = endTime.substr(0, 15);

        var href = encodeURI(
            'data:text/calendar;charset=utf8,' + [
          'BEGIN:VCALENDAR',
          'VERSION:2.0',
          'BEGIN:VEVENT',
          'URL:' + document.URL,
          'DTSTART:' + (startTime || ''),
          'DTEND:' + (endTime || ''),
          'SUMMARY:' + (event.title || ''),
          'DESCRIPTION:' + (event.description || ''),
          'LOCATION:' + (event.address || ''),
          'END:VEVENT',
          'END:VCALENDAR'].join('\n'));

        return href;
    }
};