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

use Craft;
use Twig\Markup;

class FeedReaderVariable
{

  public function get(String $url = '', Int $cacheDuration = 0)
  {
		// Get settings
		$settings = FeedReader::getInstance()->getSettings();
		$cacheDuration = $cacheDuration > 0 ? $cacheDuration : $settings['cacheDuration'];

		try {
			return Craft::$app->feeds->getFeed($url, $cacheDuration);
		} catch (\GuzzleHttp\Exception\ClientException $e) {
			return false;
		}
  }

  public function getItems(String $url = '', Int $limit = 0, Int $offset = 0, Int $cacheDuration = 0)
  {
		// Get settings
		$settings = FeedReader::getInstance()->getSettings();
		$cacheDuration = $cacheDuration > 0 ? $cacheDuration : $settings['cacheDuration'];
		$limit = $limit > 0 ? $limit : $settings['limit'];

		try {
			return Craft::$app->feeds->getFeedItems($url, $limit, $offset, $cacheDuration);
		} catch (\GuzzleHttp\Exception\ClientException $e) {
			return false;
		}
  }

}