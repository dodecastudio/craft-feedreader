# FeedReader plugin for Craft CMS

[![Buy us a tree](https://img.shields.io/badge/Treeware-%F0%9F%8C%B3-lightgreen)](https://plant.treeware.earth/dodecastudio/craft-feedreader)

<img src="src/icon.svg" width="128" height="128" />

## Requirements

- Craft CMS 3.X or 4.x
- PHP 7.4+

## Installation

Install the plugin as follows:

1.  Open your terminal and go to your Craft project:

        cd /path/to/project

2.  Then tell Composer to load the plugin:

        composer require dodecastudio/craft-feedreader

3.  In the Control Panel, go to Settings → Plugins and click the “Install” button for FeedReader.

## Overview

The FeedReader plugin makes use of Craft's built-in [Feeds API](https://docs.craftcms.com/api/v3/craft-feeds-feeds.html) to load and display RSS or Atom feeds directly in templates.

## Using FeedReader

### Fetching a feed

The `get` variable will fetch a feed and return feed information and feed items as an array.

```twig
{% set newsFeed = craft.feedreader.get("http://feeds.bbci.co.uk/news/uk/rss.xml", 43200) %}
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

The parameters available for the `get` variable are:

| Parameter        | Type     | Default | Description                                                                                                                             |
| ---------------- | -------- | ------- | --------------------------------------------------------------------------------------------------------------------------------------- |
| `url`            | `String` |         | The URL of the feed being loaded.                                                                                                       |
| `cacheDuraction` | `Int`    | 86400   | The duration in seconds for which to cache the feed result. The default of 86400 can be overridden using a custom settings config file. |

### Fetching feed items

If you don't need feed information and would like a little bit more control over the feed items, then the `getItems` variable will fetch feed items and return them as an array.

```twig
{% set newsFeedItems = craft.feedreader.getItems("http://feeds.bbci.co.uk/news/uk/rss.xml", 10, 10, 1000) %}
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

The parameters available for the `getItems` variable are:

| Parameter        | Type     | Default | Description                                                                                                                             |
| ---------------- | -------- | ------- | --------------------------------------------------------------------------------------------------------------------------------------- |
| `url`            | `String` |         | The URL of the feed being loaded.                                                                                                       |
| `limit`          | `Int`    | 20      | The number of feed items to return.                                                                                                     |
| `offset`         | `Int`    | 0       | The starting index of the item from which to start the returned feed items.                                                             |
| `cacheDuraction` | `Int`    | 86400   | The duration in seconds for which to cache the feed result. The default of 86400 can be overridden using a custom settings config file. |

## Plugin Settings

Default settings can be overridden. Please see the `feedreader-config.php` file for details.

## Licence 🌳

This package is [Treeware](https://treeware.earth). If you use it in production, then we ask that you [**buy the world a tree**](https://plant.treeware.earth/dodecastudio/craft-feedreader/).  
And why not? By contributing to the Treeware forest you’ll be creating employment for local families and restoring wildlife habitats.

If you've purchased trees through Ecologi, as part of the Treeware license, please let us know for a shout-out.
