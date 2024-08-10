<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ActionsController extends Controller
{
    public function index(){
        $table = 'sctions';
        return view('pages.dashboard.actions.actions',compact('table'));
    }
}
