<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Database;
use App\Models\EventDetail;

/**
 * HomeController - Controller untuk halaman utama
 */
class HomeController extends Controller
{
    public function home()
    {
        $comingSoonEvent = Event::with('eventDetail')->where('event_status', 'Coming Soon')->get();
        $openRegisterEvent = Event::with('eventDetail')->where('event_status', 'Open Register')->get();
        $recentEvent = Event::with('eventDetail')
        ->where('event_status', 'Ended')
        ->orderBy('updated_at', 'desc')
        ->take(5) // recent event biasanya dibatasi
        ->get();
        return view(
            'homepage',
            [
                'recentEvent' => $recentEvent,
                'comingSoonEvent' => $comingSoonEvent,
                'openRegisterEvent' => $openRegisterEvent
            ]
        );
    }
}