<?php

namespace Config;

use App\Filters\AuthFilter;
use App\Filters\LoginThrottleFilter;
use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\Honeypot;
use CodeIgniter\Filters\InvalidChars;
use CodeIgniter\Filters\SecureHeaders;

class Filters extends BaseConfig
{
    /**
     * @var array<string, class-string|list<class-string>> [filter_name => classname]
     *                                                     or [filter_name => [classname1, classname2, ...]]
     */
    public array $aliases = [
        'csrf'          => CSRF::class,
        'toolbar'       => DebugToolbar::class,
        'honeypot'      => Honeypot::class,
        'invalidchars'  => InvalidChars::class,
        'secureheaders' => SecureHeaders::class,
        'auth'          => AuthFilter::class,
        'loginThrottle' => LoginThrottleFilter::class,
    ];

    /**
     * @var array<string, array<string, array<string, string>>>|array<string, list<string>>
     */
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

    /**
     * @var array<string, list<string>>
     */
    public array $methods = [];

    /**
     * @var array<string, array<string, list<string>>>
     */
    public array $filters = [];

    public function __construct()
    {
        parent::__construct();

        $this->globals['after'] = match (ENVIRONMENT) {
            'development' => ['toolbar'],
            'production'  => ['secureheaders'],
            default       => [],
        };
    }
}
