@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Bayar Event: {{ $bookingData['event_name'] }}</h2>
    <p>Harga: Rp {{ number_format($bookingData['event_cost'], 0, ',', '.') }}</p>

    <!-- Tempat QR / Snap akan muncul -->
    <div id="midtrans-payment"></div>

    <button id="pay-button" class="btn btn-primary">Bayar Sekarang</button>
</div>

<!-- Snap JS -->
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>

<script>
document.getElementById('pay-button').addEventListener('click', function () {
    snap.pay('{{ $snapToken }}', {
        onSuccess: function(result){
            window.location.href = '{{ route("payment.success") }}';
        },
        onPending: function(result){
            alert('Pembayaran tertunda: ' + result.status_message);
        },
        onError: function(result){
            alert('Terjadi error: ' + result.status_message);
        }
    });
});
</script>
@endsection