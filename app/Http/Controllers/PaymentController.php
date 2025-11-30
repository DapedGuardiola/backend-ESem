<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function process(Request $request)
    {
        // Validate the form data
        $validated = $request->validate([
            'fullName' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string',
            'payment_method' => 'required|string',
            'event_id' => 'required|integer',
            'event_title' => 'required|string',
            'event_price' => 'required|string'
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

        return view('payment.success', [
            'bookingData' => $bookingData,
            'reference' => $reference
        ]);
    }

    public function cancel()
    {
        return view('payment.cancel');
    }
}