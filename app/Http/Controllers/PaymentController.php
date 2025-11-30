<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\EventDetail;
use App\Models\Registered;
use Midtrans\Snap;
use Midtrans\Config as MidtransConfig;
use GuzzleHttp\Client;

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

        $event = Event::with('eventDetail')->where('event_id', $request->event_id)->first();

        if (!$event) {
            abort(404, 'Event not found');
        }

        //jika tidak berbayar
        if (!$event->eventDetail->paid_status) {

            $eventName = $event->event_name;
            $eventCost = $event->eventDetail->cost;

            $bookingData = [
                'event_id' => $request->event_id,
                'event_name' => $eventName,
                'registered_name' => $request->fullName,
                'registered_email' => $request->email,
                'registered_phone' => $request->phone,
                'eventCost' => $eventCost,
                'payment_status' => true,
            ];

            Registered::insert([
                'event_id' => $bookingData['event_id'],
                'registered_name' => $bookingData['registered_name'],
                'registered_email' => $bookingData['registered_email'],
                'registered_phone' => $bookingData['registered_phone'],
                'payment_status' => $bookingData['payment_status'],
            ]);

            $bookingReference = 'INV-' . time();
            session([
                'booking_data' => $bookingData,
                'booking_reference' => $bookingReference
            ]);
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

        MidtransConfig::$serverKey = config('midtrans.server_key');
        MidtransConfig::$isProduction = config('midtrans.is_production');
        MidtransConfig::$isSanitized = config('midtrans.is_sanitized');
        MidtransConfig::$is3ds = config('midtrans.is_3ds');

        $orderId = 'INV-' . time();

        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => 1000,
            ],
            'customer_details' => [
                'first_name' => $request->fullName,
                'email' => $request->email,
                'phone' => $request->phone,
            ]// optional: pilih metode tertentu
        ];

        $snapToken = Snap::getSnapToken($params);

        // Kirim ke view custom
        return view('payments.snap', compact('snapToken', 'orderId', 'event'));
    }

    // private function simulatePaymentGateway($data)
    // {
    //     // This is a simulation - in real app, you'd integrate with:
    //     // - Midtrans (Indonesia)
    //     // - Xendit (Indonesia)
    //     // - Stripe (International)
    //     // - etc.

    //     // For demo purposes, we'll simulate successful payment
    //     return redirect()->route('payment.success');
    // }

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