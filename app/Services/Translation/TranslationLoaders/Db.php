<?php

namespace App\Services\Translation\TranslationLoaders;

use App\Services\Translation\LanguageLine;
use Error;
use Exception;
use Illuminate\Database\Eloquent\Model;

class Db implements TranslationLoader
{
    public function loadTranslations(string $locale, string $group): array
    {
        $modelClass = config('translation-loader.model');

        /** @var Model $modelClass */
        return $modelClass::getTranslationsForGroup($locale, $group);
    }
        protected function getConfiguredModelClass(): string
    {
        $modelClass = config('translation-loader.model');

        if (! is_a(new $modelClass(), LanguageLine::class)) {
            throw new Exception('Invalid Model');
        }

        return $modelClass;
    }
}