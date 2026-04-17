<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventController extends Controller
{
    public function indexAdmin(){
        return view('admin.events');
    }

    public function show(){
        return view('event-detail');
    }

    public function checkout(){
        return view('checkout');
    }

    public function transactions(){
        return view('admin.transactions');
    }
}
