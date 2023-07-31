<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        $data['title'] = 'Welcome Home';
        return view('home', $data);
    }
}
