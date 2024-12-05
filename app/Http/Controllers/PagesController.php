<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function homepage()
    {
        return view('pages.homepage');
    }

    public function about()
    {
        return view('pages.about', [
            'name' => 'Ihsan Miftahul Huda',
            'address' => 'Bandung',
            'job' => 'Fullstack Developer',
            'image' => 'https://avatars.githubusercontent.com/u/47204300?v=4'
        ]);
    }
}
