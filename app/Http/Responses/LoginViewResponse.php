<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginViewResponse as LoginViewResponseContract;
use Illuminate\Http\Request;

class LoginViewResponse implements LoginViewResponseContract
{
    /**
     * Create an HTTP response that represents the login view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function toResponse($request)
    {
        return view('auth.login');
    }
}