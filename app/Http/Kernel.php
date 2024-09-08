<?php

namespace App\Http;

use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Foundation\Http\Kernel as HttpKernel;

/**
 * Created by @alif_coder.
 * User: Yuldashev Shukhratjon
 * Date: 04.05.2024
 * Time: 16:10
 */
class Kernel extends HttpKernel
{
    protected $middlewareAliases = [
        'auth'             => Authenticate::class,
        ];
}
