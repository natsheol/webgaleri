<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        //
    ];

    /**
     * Add the CSRF token to the response cookies.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Symfony\Component\HttpFoundation\Response  $response
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function addCookieToResponse($request, $response)
    {
        $response = parent::addCookieToResponse($request, $response);
        
        // Add XSRF-TOKEN cookie for JavaScript frameworks
        $response->headers->setCookie(
            new \Symfony\Component\HttpFoundation\Cookie(
                'XSRF-TOKEN',
                $request->session()->token(),
                time() + 60 * 120,
                '/',
                null,
                config('session.secure'),
                false,
                false,
                config('session.same_site', 'lax')
            )
        );

        return $response;
    }
}
