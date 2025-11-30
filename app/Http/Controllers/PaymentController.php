<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\EventDetail;
use App\Models\Registered;


class PaymentController extends Controller
{
    public function process(Request $request)
    {
        // Validate the form data
        $request->validate([
            'fullName' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string',
            'event_id' => 'required|integer'
        ]);
        
        $event = Event::with('eventDetail')->where('event_id',$request->event_id)->first();

        if (!$event) {
            abort(404, 'Event not found');
        }

        //jika tidak berbayar
        if(!$event->eventDetail->paid_status){
            $registered = [
                'event_id' => $request->event_id,
                'registered_name' => $request->fullName,
                'registered_email' => $request->email,
                'registered_phone' => $request->phone,
                'payment_status' => true,
            ];
            $register= Registered::insert($registered);          
        return redirect()->route('payment.success');
        }
        
        //if paid_status == true
        $validated = $request->validate([
            'payment_method' => 'required|string',
            'event_title' => 'required|string',
            'event_price' => 'required|string',
        ]);
        // In a real application, you would:    
        // 1. Save the booking to database
        // 2. Generate invoice
        // 3. Integrate with payment gateway (Midtrans, Xendit, etc.)
        
        // For simulation, we'll store in session and redirect to payment gateway
        session([
            'booking_data' => $validated,
            'booking_reference' => 'BK-' . time() . '-' . rand(1000, 9999)
        ]);

        // Simulate payment gateway integration
        // In real application, this would redirect to actual payment gateway
        return $this->simulatePaymentGateway($validated);
    }

    private function simulatePaymentGateway($data)
    {
        // This is a simulation - in real app, you'd integrate with:
        // - Midtrans (Indonesia)
        // - Xendit (Indonesia)
        // - Stripe (International)
        // - etc.
        
        // For demo purposes, we'll simulate successful payment
        return redirect()->route('payment.success');
    }

    public function success()
    {
        $bookingData = session('booking_data');
        $reference = session('booking_reference');

        if (!$bookingData) {
            return redirect('/');
        }

        // Clear session data
        session()->forget(['booking_data', 'booking_reference']);

        return view('payments.success', [
            'bookingData' => $bookingData,
            'reference' => $reference
        ]);
    }

    public function cancel()
    {
        return view('payment.cancel');
    }
}