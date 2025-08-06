<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        // Esta es la página principal de la tienda
        return view('app.frontend.index');
    }
}