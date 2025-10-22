<?php

return [
    /*
     * Language lines will be fetched by these loaders.
     */
    'translation_loaders' => [
        App\Services\Translation\TranslationLoaders\Db::class,
    ],

    /*
     * This is the model used by the Db Translation loader.
     */
    'model' => App\Services\Translation\LanguageLine::class,

    /*
     * This is the translation manager which overrides the default Laravel `translation.loader`
     */
    'translation_manager' => App\Services\Translation\TranslationLoaderManager::class,
];