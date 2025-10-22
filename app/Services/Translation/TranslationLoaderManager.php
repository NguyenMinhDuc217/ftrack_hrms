<?php

namespace App\Services\Translation;

use Illuminate\Translation\FileLoader;
use App\Services\Translation\TranslationLoaders\TranslationLoader;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Schema;


class TranslationLoaderManager extends FileLoader
{
    /**
     * Load the messages for the given locale.
     */
    public function load($locale, $group, $namespace = null): array
    {
        try {
            $fileTranslations = parent::load($locale, $group, $namespace);

            if (! is_null($namespace) && $namespace !== '*') {
                return $fileTranslations;
            }

            $loaderTranslations = $this->getTranslationsForTranslationLoaders($locale, $group, $namespace);

            return array_replace_recursive($fileTranslations, $loaderTranslations);
        } catch (QueryException $exception) {
            $modelClass = config('translation-loader.model');
            $model = new $modelClass();

            if (is_a($model, LanguageLine::class) && ! Schema::hasTable($model->getTable())) {
                return parent::load($locale, $group, $namespace);
            }

            throw $exception;
        }
    }

    protected function getTranslationsForTranslationLoaders(
        string $locale,
        string $group,
        string|null $namespace = null
    ): array {
        return collect(config('translation-loader.translation_loaders'))
            ->map(function (string $className) {
                return app($className);
            })
            ->mapWithKeys(function (TranslationLoader $translationLoader) use ($locale, $group, $namespace) {
                return $translationLoader->loadTranslations($locale, $group, $namespace);
            })
            ->toArray();
    }
}