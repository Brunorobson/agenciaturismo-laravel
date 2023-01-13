<?php

namespace App\Http\Controllers\Sites;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index(){
        $title = 'Passagens Aereas';
        return view('site.home.index', compact('title'));
    }

    public function promotions(){
        $title = 'Promoções';
        return view('site.promotions.list', compact('title'));
    }
}
