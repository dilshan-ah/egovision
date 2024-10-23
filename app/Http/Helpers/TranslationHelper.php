<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Cache;
use Stichoza\GoogleTranslate\GoogleTranslate;

class TranslationHelper
{
    public static function translateText($text, $preferredLanguage = 'en') {
        $cacheKey = 'translation_' . md5($text) . '_' . $preferredLanguage;

        return Cache::remember($cacheKey, 60 * 60 * 24, function () use ($text, $preferredLanguage) {
            $preferredLanguage = $preferredLanguage ?? 'en';
            $tr = new GoogleTranslate($preferredLanguage);
            return $tr->translate($text);
        });
    }
}
