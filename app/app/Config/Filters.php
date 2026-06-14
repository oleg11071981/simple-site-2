<?php

namespace Config;

use App\Filters\AuthFilter;
use App\Filters\LoginThrottleFilter;
use CodeIgniter\Config\Filters as BaseFilters;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\ForceHTTPS;
use CodeIgniter\Filters\Honeypot;
use CodeIgniter\Filters\InvalidChars;
use CodeIgniter\Filters\PageCache;
use CodeIgniter\Filters\PerformanceMetrics;
use CodeIgniter\Filters\SecureHeaders;

class Filters extends BaseFilters
{
    public array $aliases = [
        'csrf'          => CSRF::class,
        'toolbar'       => DebugToolbar::class,
        'honeypot'      => Honeypot::class,
        'invalidchars'  => InvalidChars::class,
        'secureheaders' => SecureHeaders::class,
        'forcehttps'    => ForceHTTPS::class,
        'pagecache'     => PageCache::class,
        'performance'   => PerformanceMetrics::class,
        'auth'          => AuthFilter::class,
        'loginThrottle' => LoginThrottleFilter::class,
    ];

    public array $required = [
        'before' => [
            'forcehttps',
            'pagecache',
        ],
        'after' => [
            'pagecache',
            'performance',
            'toolbar',
        ],
    ];

    public array $globals = [
        'before' => [
            'csrf' => [
                'except' => [
                    'admin-panel/editor/upload',
                    'admin-panel/editor/upload-image',
                ],
            ],
        ],
        'after' => [],
    ];

    public array $methods = [];

    public array $filters = [];

    public function __construct()
    {
        parent::__construct();

        if (ENVIRONMENT === 'development') {
            $this->required['before'] = array_values(array_filter(
                $this->required['before'],
                static fn (string $filter): bool => $filter !== 'forcehttps',
            ));
        }

        if (ENVIRONMENT === 'production') {
            $this->required['after'] = array_values(array_filter(
                $this->required['after'],
                static fn (string $filter): bool => $filter !== 'toolbar',
            ));
            $this->globals['after'] = ['secureheaders'];
        } elseif (ENVIRONMENT !== 'development') {
            $this->required['after'] = array_values(array_filter(
                $this->required['after'],
                static fn (string $filter): bool => $filter !== 'toolbar',
            ));
        }
    }
}
