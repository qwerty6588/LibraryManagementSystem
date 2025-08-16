<?php

declare(strict_types=1);

namespace App\Traits;

trait HasTranslatable
{
    /**
     * Check if model has translatable keys
     *
     * @return bool
     */
    public function hasTranslatable(): bool
    {
        return property_exists($this, 'translatable');
    }

    /**
     * Check if key is translatable
     *
     * @param string $key
     * @return bool
     */
    public function isTranslatable(string $key): bool
    {
        if (!$this->hasTranslatable()) {
            return false;
        }

        return in_array($key, $this->translatable);
    }

    /**
     * Get translatable key
     *
     * @param string|null $key
     * @return mixed
     */
    protected function getTranslatable(string $key = null): mixed
    {
        if (!$this->hasTranslatable()) {
            return [];
        }

        if (is_null($key)) {
            return $this->translatable;
        }

        return $this->isTranslatable($key)
            ? $this->translatable[$key]
            : null;
    }

    /**
     * Translate key
     *
     * @param string $key
     * @param string|null $locale
     * @return array|mixed
     */
    public function translate(string $key, string $locale = null): mixed
    {
        $key = $this->getAttributeValue($key);

        if (is_string($key)) {
            $key = json_decode($key, true);
        }

        if (!is_array($key)) {
            return $key;
        }

        if (!is_null($locale)) {
            return data_get($key, $locale);
        }

        return data_get($key, config('app.locale'));
    }

    /**
     * Get all attribute translations
     *
     * @param string $key
     * @return mixed
     */
    public function getTranslations(string $key): mixed
    {
        return $this->getAttributeValue($key);
    }

    /**
     * Get an attribute from the model.
     *
     * @param string $key
     * @return mixed
     */
    public function getAttribute($key): mixed
    {
        if ($this->isTranslatable($key)) {
            return $this->translate($key);
        }

        return parent::getAttribute($key);
    }

    /**
     * Get the casts array.
     *
     * @return array
     */
    public function getCasts(): array
    {
        return array_merge(
            parent::getCasts(),
            array_fill_keys($this->getTranslatable(), 'array')
        );
    }
}
