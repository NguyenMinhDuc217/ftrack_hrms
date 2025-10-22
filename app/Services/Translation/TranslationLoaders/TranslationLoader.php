<?php

namespace App\Services\Translation\TranslationLoaders;

interface TranslationLoader
{
    /**
     * Returns all translations for the given locale and group.
     */
    public function loadTranslations(string $locale, string $group): array;
}