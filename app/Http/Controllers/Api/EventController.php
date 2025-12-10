<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\EventDetail;
use Carbon\Carbon;
use App\Models\Registered;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    public function getEvent(Request $request)
    {
        $comingSoonEvent = Event::with('eventDetail')->where('event_status', 'Coming Soon')->get();
        $openRegisterEvent = Event::with('eventDetail')->where('event_status', 'Open Register')->get();
        $recentEvent = Event::with('eventDetail')->where('event_status', 'Ended')->get();
        $activeEvent = Event::with('eventDetail')->where('event_status', 'On Going')->get();
        $allCollections = [
            'comingSoonEvent' => $comingSoonEvent,
            'openRegisterEvent' => $openRegisterEvent,
            'recentEvent' => $recentEvent,
            'activeEvent' => $activeEvent,
        ];
        $registeredCount = Registered::select('event_id', DB::raw('COUNT(*) as total_registered'))
            ->groupBy('event_id')
            ->get();
        foreach ($allCollections as $key => $collection) {
            $allCollections[$key] = $collection->map(function ($event) {
                if ($event->eventDetail && $event->eventDetail->date) {
                    // Pastikan date selalu string ISO
                    $carbonDate = Carbon::parse($event->eventDetail->date);
                    $event->eventDetail->date_string = $carbonDate->translatedFormat('d F Y');
                    $event->eventDetail->time_string = $carbonDate->format('H:i');
                }
                $event->eventDetail->registered_count = $registeredCounts[$event->event_id]->total_registered??0;
                $event->eventDetail->image_url = url('storage/event/event' . $event->event_id . '.png');
                return $event;
            })->toArray();
        }

        return response()->json([
            'status' => 'success',
            'comingSoonEvent' => $allCollections['comingSoonEvent'],
            'openRegisterEvent' => $allCollections['openRegisterEvent'],
            'recentEvent' => $allCollections['recentEvent'],
            'activeEvent' => $allCollections['activeEvent'],
        ], 200);
    }
}