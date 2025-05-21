<?php

/**
 * ConfigDictionary class file.
 */

namespace Oblak\Vocative;

use Stringable;

/**
 * Configurable dictionary
 */
class ConfigDictionary extends BaseDictionary
{
    /**
     * Additional entries from config
     *
     * @var array<string,string>
     */
    private array $configEntries = [];

    /**
     * Create a new dictionary with config entries.
     *
     * @param  array<string,string>  $configEntries
     */
    public function __construct(array $configEntries = [])
    {
        $this->configEntries = array_change_key_case($configEntries, CASE_UPPER);
    }

    /**
     * Check if a name is in the dictionary
     *
     * @param  string|Stringable  $name  Name in nominative case
     */
    public function hasName(string|Stringable $name): bool
    {
        $name = (string) $name;

        return isset($this->configEntries[$name]) || parent::hasName($name);
    }

    /**
     * Get the vocative case form of a name
     *
     * @param  string|Stringable  $name  Name in nominative case
     */
    public function getName(string|Stringable $name): string
    {
        $name = (string) $name;

        if (isset($this->configEntries[$name])) {
            return $this->configEntries[$name];
        }

        return parent::getName($name);
    }
}
