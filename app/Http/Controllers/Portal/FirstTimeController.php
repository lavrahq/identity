<?php

namespace App\Http\Controllers\Portal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FirstTimeController extends Controller
{

    public function index(Request $request)
    {
        return url('/logout');
    }

}
