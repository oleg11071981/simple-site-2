<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;

class LoginThrottleFilter implements FilterInterface
{
    private const MAX_ATTEMPTS = 10;

    private const WINDOW_SECONDS = 60;

    public function before(RequestInterface $request, $arguments = null)
    {
        $throttler = Services::throttler();
        $key       = 'login_' . $request->getIPAddress();

        if ($throttler->check($key, self::MAX_ATTEMPTS, self::WINDOW_SECONDS) === false) {
            log_message('warning', '[AUTH] Rate limit exceeded for IP: {ip}', [
                'ip' => $request->getIPAddress(),
            ]);

            return redirect()->back()
                ->with('error', 'Слишком много попыток входа. Подождите минуту и попробуйте снова.');
        }

        return $request;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null): ResponseInterface
    {
        return $response;
    }
}
