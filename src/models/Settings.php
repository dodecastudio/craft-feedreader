<?php

namespace dodecastudio\feedreader\models;

use craft\base\Model;

class Settings extends Model
{
    
    // The default cache time, in seconds.
    public $cacheDuration = 86400;
    // The default number of feed items to return.
    public $limit = 20;

    public function rules() : array
    {
        return [
            ['cacheDuration', 'required'],
            ['limit', 'required'],
        ];
    }
}