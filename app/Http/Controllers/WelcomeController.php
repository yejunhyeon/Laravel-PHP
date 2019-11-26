<?php

namespace App\Http\Controllers;

class WelcomeController extends Controllers
{
    public function index()
    {
        return view('welcome');
    }
}