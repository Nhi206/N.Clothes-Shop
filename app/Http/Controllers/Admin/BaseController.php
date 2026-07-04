<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

abstract class BaseController extends Controller
{
    protected function authorizeAdmin(): void
    {
        abort_unless(auth()->check() && in_array(auth()->user()->role, ['admin', 'staff']), 403);
    }
}
