<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Pesanan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <div class="min-h-screen flex items-center justify-center">
        <div class="max-w-xl w-full p-6 bg-white shadow-xl rounded-2xl">
            <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">Pembayaran Pesanan</h1>

            <div class="space-y-4 text-gray-700">
                <div class="flex justify-between">
                    <span>Nomor Pesanan</span>
                    <span class="font-semibold">#{{ $order->id }}</span>
                </div>
                <div class="flex justify-between">
                    <span>Total Pembayaran</span>
                    <span class="font-bold text-green-600">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between">
                    <span>Status</span>
                    <span class="text-yellow-500 font-medium">Menunggu Pembayaran</span>
                </div>
            </div>

            <div class="mt-8 text-center">
                <button id="pay-button" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-xl transition duration-300">
                    Bayar Sekarang
                </button>
            </div>

            <div class="mt-4 text-sm text-center text-gray-500">
                Setelah pembayaran berhasil, kamu akan diarahkan ke halaman riwayat pesanan.
            </div>
        </div>
    </div>

    <!-- Midtrans Snap JS -->
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="YOUR_CLIENT_KEY"></script>
<script>
    document.getElementById('pay-button').addEventListener('click', function () {
        snap.pay('{{ $snapToken }}', {
            onSuccess: function(result){
                alert("Pembayaran berhasil!");

                // Kirim request untuk update status ke Laravel
                fetch("{{ route('orders.markPaid', ['order' => $order->id]) }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ success: true })
                })
                .then(res => res.json())
                .then(data => {
                    // Setelah status berhasil diupdate, redirect ke history
                    window.location.href = "{{ route('orders.history') }}";
                })
                .catch(err => {
                    console.error("Gagal update status:", err);
                    alert("Terjadi kesalahan saat update status pesanan.");
                });
            },
            onPending: function(result){
                alert("Pembayaran masih dalam proses.");
            },
            onError: function(result){
                alert("Terjadi kesalahan saat pembayaran.");
            },
            onClose: function(){
                alert("Kamu menutup popup pembayaran.");
            }
        });
    });
</script>


</body>
</html>
