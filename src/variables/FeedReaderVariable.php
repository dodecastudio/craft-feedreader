<?php
/**
 * FeedReader plugin for Craft CMS 4.x
 *
 * Render RSS and Atom data from given feeds.
 *
 * @link      https://dodeca.studio
 * @copyright Copyright (c) 2022 Dodeca Studio
 */

namespace dodecastudio\feedreader\variables;

use dodecastudio\feedreader\FeedReader;
use dodecastudio\feedreader\vendor\feeds\Feeds;
use dodecastudio\feedreader\vendor\feeds\GuzzleClient as FeedReaderGuzzleClient;

use Craft;
use Twig\Markup;

class FeedReaderVariable
{

  public function getFeed(String $url = '', Int $cacheDuration = 0)
  {
		// Get settings
		$settings = FeedReader::getInstance()->getSettings();
		$cacheDuration = $cacheDuration > 0 ? $cacheDuration : $settings['cacheDuration'];
		$Feeds = new Feeds();
		try {
			return $Feeds->getFeed($url, $cacheDuration);
		} catch (\FeedReaderGuzzleClient\GuzzleHttp\Exception\ClientException $e) {
			return false;
		}
  }

  public function getFeedItems(String $url = '', Int $limit = 0, Int $offset = 0, Int $cacheDuration = 0)
  {
		// Get settings
		$settings = FeedReader::getInstance()->getSettings();
		$cacheDuration = $cacheDuration > 0 ? $cacheDuration : $settings['cacheDuration'];
		$Feeds = new Feeds();
		$limit = $limit > 0 ? $limit : $settings['limit'];

		try {
			return $Feeds->getFeedItems($url, $limit, $offset, $cacheDuration);
		} catch (\FeedReaderGuzzleClient\GuzzleHttp\Exception\ClientException $e) {
			return false;
		}
  }

}