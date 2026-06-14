<?php

namespace Config;

/**
 * Optimization Configuration.
 *
 * NOTE: This class does not extend BaseConfig for performance reasons.
 */
class Optimize
{
    public bool $configCacheEnabled = false;

    public bool $locatorCacheEnabled = false;
}
