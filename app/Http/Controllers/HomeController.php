<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Category;
use Carbon\Carbon;

/**
 * HomeController - Controller untuk halaman utama
 */
class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }
}