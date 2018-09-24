<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MyGalleryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
}
