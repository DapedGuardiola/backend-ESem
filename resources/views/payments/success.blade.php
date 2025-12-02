@extends('layouts.app')

@section('title', 'Payment Successful - ESEM')

@section('content')
    <div class="container" style="padding: 60px 0; text-align: center;">
        <div
            style="max-width: 500px; margin: 0 auto; background: white; padding: 40px; border-radius: 16px; box-shadow: 0 4px 20px rgba(0,0,0,0.1);">
            <div style="font-size: 64px; margin-bottom: 20px;">🎉</div>
            <h1 style="color: #14b8a6; margin-bottom: 20px;">Payment Successful!</h1>
            <p style="color: #6b7280; margin-bottom: 30px; line-height: 1.6;">
                Thank you for your booking. Your registration has been confirmed and payment processed successfully.
            </p>

            <div style="background: #f0fdfa; padding: 20px; border-radius: 12px; margin-bottom: 30px; text-align: left;">
                <h3 style="color: #14b8a6; margin-bottom: 15px;">Booking Details</h3>
                <p><strong>Event:</strong> {{ $bookingData['event_name'] }}</p>
                <p><strong>Name:</strong> {{ $bookingData['registered_name'] }}</p>
                <p><strong>Email:</strong> {{ $bookingData['registered_email'] }}</p>
                <p><strong>Reference:</strong> {{ $reference }}</p>
                <br>
                <br>
                <br>
                <img src="data:image/png;base64,{{ $qrBase64 }}" style="width: 340px;">
                <a href="{{ route('qr.qrdownload', $fileName)}}"
                    class="btn btn-success">
                    Download QR
                </a>
            </div>

            <p style="color: #6b7280; margin-bottom: 30px;">
                A confirmation email has been sent to <strong>{{ $bookingData['registered_email'] }}</strong> with your
                ticket and event details.
            </p>


            <div style="display: flex; gap: 15px; justify-content: center;">
                <a href="/" class="btn-book">Back to Home</a>
                <button onclick="window.print()" class="btn-view">Print Ticket</button>
            </div>
        </div>
    </div>
@endsection