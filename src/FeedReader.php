<?php
/**
 * FeedReader plugin for Craft CMS 4.x
 *
 * @link      https://dodeca.studio
 * @copyright Copyright (c) 2022 Dodeca Studio
 */

namespace dodecastudio\feedreader;

use dodecastudio\feedreader\models\Settings;
use dodecastudio\feedreader\variables\FeedReaderVariable;

use Craft;
use craft\base\Plugin;
use craft\web\twig\variables\CraftVariable;
use yii\base\Event;


/**
 * 
 * @author    Dodeca Studio
 * @package   FeedReader
 * @since     1.0.0
 *
 */
class FeedReader extends Plugin
{

    // Static Properties

    /**
     * @var FeedReader
     */
    public static $plugin;

    // Public Methods

    public function init()
    {
        parent::init();

        Event::on(
            CraftVariable::class, 
            CraftVariable::EVENT_INIT, 
            function (Event $event): void {
                $event->sender->set('feedreader', FeedReaderVariable::class);
            }
        );

        Craft::info(
            Craft::t(
                'feedreader',
                '{name} plugin loaded',
                ['name' => $this->name]
            ),
            __METHOD__
        );

    }

    // Settings

    protected function createSettingsModel(): ?\craft\base\Model
    {
        return new Settings();
    }

}

