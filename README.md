# FeedReader plugin for Craft CMS

<img src="src/icon.svg" width="128" height="128" />

## Requirements

- Craft CMS 3.X, 4.X or 5.X
- PHP 7.4+

## Installation

Install the plugin as follows:

1.  Open your terminal and go to your Craft project:

        cd /path/to/project

2.  Then tell Composer to load the plugin:

        composer require dodecastudio/craft-feedreader

3.  In the Control Panel, go to Settings → Plugins and click the “Install” button for FeedReader.

## Overview

The FeedReader plugin makes use of Craft's built-in [Feeds API](https://docs.craftcms.com/api/v3/craft-feeds-feeds.html) to load and display RSS or Atom feeds directly in templates. As the Feeds API was deprecated in Craft 4, this plugin borrows the original code from Craft 3 in order to ensure function across both these versions of Craft.

## Using FeedReader

### Fetching a feed

The `getFeed` variable will fetch a feed and return feed information and feed items as an array.

```twig
{% set newsFeed = craft.feedreader.getFeed("http://feeds.bbci.co.uk/news/uk/rss.xml", 43200, true) %}
```

You can then output information about the feed and the items it contains, like so:

```twig
{# Output feed info #}
<h1>{{ newsFeed.title }}</h1>
<p>Feed: <a href="{{ newsFeed.link }}">{{ newsFeed.link }}</a></p>
{# Output the feed items #}
<ul>
{% for newsItem in newsFeed.items %}
  <li>
    <a href="{{ newsItem.permalink }}">{{ newsItem.title }}</a> - {{ newsItem.date.date|date("Y-m-d H:i:s") }}
  </li>
{% endfor %}
</ul>
```

#### Supported parameters

The parameters available for the `getFeed` variable are:

| Parameter        | Type      | Default | Description                                                                                                                             |
| ---------------- | --------- | ------- | --------------------------------------------------------------------------------------------------------------------------------------- |
| `url`            | `String`  |         | The URL of the feed being loaded.                                                                                                       |
| `cacheDuraction` | `Int`     | 86400   | The duration in seconds for which to cache the feed result. The default of 86400 can be overridden using a custom settings config file. |
| `normalize`      | `Boolean` | true    | Whether or not to "normalize" the data returned for each item or entry. This is helpful when non-standard data is being returned.       |

### Fetching feed items

If you don't need feed information and would like a little bit more control over the feed items, then the `getFeedItems` variable will fetch feed items and return them as an array.

```twig
{% set newsFeedItems = craft.feedreader.getFeedItems("http://feeds.bbci.co.uk/news/uk/rss.xml", 10, 10, 1000, true) %}
```

You can then output the items, like so:

```twig
{# Output the feed items #}
<ul>
{% for newsItem in newsFeedItems %}
  <li>
    <a href="{{ newsItem.permalink }}">{{ newsItem.title }}</a> - {{ newsItem.date.date|date("Y-m-d H:i:s") }}
  </li>
{% endfor %}
</ul>
```

#### Supported parameters

The parameters available for the `getFeedItems` variable are:

| Parameter        | Type      | Default | Description                                                                                                                             |
| ---------------- | --------- | ------- | --------------------------------------------------------------------------------------------------------------------------------------- |
| `url`            | `String`  |         | The URL of the feed being loaded.                                                                                                       |
| `limit`          | `Int`     | 20      | The number of feed items to return.                                                                                                     |
| `offset`         | `Int`     | 0       | The starting index of the item from which to start the returned feed items.                                                             |
| `cacheDuraction` | `Int`     | 86400   | The duration in seconds for which to cache the feed result. The default of 86400 can be overridden using a custom settings config file. |
| `normalize`      | `Boolean` | true    | Whether or not to "normalize" the data returned for each item or entry. This is helpful when non-standard data is being returned.       |

## Plugin Settings

Default settings can be overridden. Please see the `feedreader-config.php` file for details.
