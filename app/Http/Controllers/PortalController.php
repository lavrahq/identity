<?php

namespace App\Http\Controllers;

class PortalController extends Controller
{
    /**
     * Setup the middleware to require authentication.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Renders the Portal Vue application.
     *
     * @return void
     */
    public function index()
    {
        return view('portal');
    }
}
