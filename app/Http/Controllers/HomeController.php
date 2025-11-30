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
        $recentEvent = Event::with([
            'eventDetail' => function ($q) {
                $q->orderBy('date', 'desc');
            }
        ])
            ->where('event_status', 'Ended')
            ->get()
            ->sortByDesc('eventDetail.date');
        return view(
            'homepage',
            [
                'recentEvent' => $recentEvent,
                'comingSoonEvent' => $comingSoonEvent,
                'openRegisterEvent' => $openRegisterEvent
            ]
        );
    }
    public function booking($eventId)
    {
        $event = Event::with('eventDetail')->where('event_id', $eventId)
            ->firstOrFail();
        ;

        if (!isset($event)) {
            abort(404, 'Event not found');
        }

        return view('homepage', [
            'isBookingPage' => true,
            'eventData' => $event,
        ]);
    }
}