<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ThemeController extends Controller
{
    public function changeTheme(Request $request, $theme)
    {
        $request->session()->put('theme', $theme);

        return redirect()->back();
    }
}
