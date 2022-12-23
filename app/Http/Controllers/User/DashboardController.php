<?php

namespace App\Http\Controllers\User;

use App\News;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App;

class DashboardController extends Controller
{
    //Dashboard

    public function dashboard() {
        // App::setlocale('uk');
        return view('user.dashboard', [
            'new'              => News::lastNew(3),
            'count_new'        => News::count()
        ]);
    }
}
