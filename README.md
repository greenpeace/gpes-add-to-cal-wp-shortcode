# Add an event to the user's calendar

With this Wordpress plugin you can add links to add an event to the user's calendar. Use a shortcode like the example bellow.

## How to use

Copy-paste the code bellow to your posts and pages.

```
[add_to_cal date='2018-12-25' time='12:01:00' duration='60' title='Please add a title to the event' description='Please add a description to the event' address='Please add an address to the event']
```

## Analytics

This shortcode uses Google Analytics events to track clicks in the add to calendar links. At the moment it supports the [gtag tracking code](https://developers.google.com/analytics/devguides/collection/gtagjs/events).

## How to installhttps://developers.google.com/analytics/devguides/collection/gtagjs/events

1. Upload the **add-to-cal** folder to **wp-content/plugins/**.
2. Activate the **Add event to calendar** plugin.

## How to translate (new language)

1. Open the languages/add-to-call.pot file with Poedit.
2. Create new language.
3. Translate.
4. Save the .po and .mo files as the examples inside the languages folder.
