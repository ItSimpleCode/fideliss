@extends('dashboard')
@section('title', 'Scan')
@section('stylesheet', 'dist/css/scanner/scan.css')
@section('content')
    <section class="dark-bg">
        <h1>QR Code Scanner</h1>
        <div id="reader" style="width: 500px;"></div>
        <div id="result"></div>
        <script src="https://unpkg.com/html5-qrcode/minified/html5-qrcode.min.js"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const html5QrCode = new Html5Qrcode("reader");

                const qrCodeSuccessCallback = (decodedText, decodedResult) => {

                    html5QrCode.stop().then((ignore) => {
                    }).catch((err) => {
                        console.log(err);
                    });

                    window.location.href = `/dashboard/addPoints/${encodeURIComponent(decodedText)}`;
                };

                const config = {
                    fps: 10,
                    qrbox: 250
                };

                html5QrCode.start({
                        facingMode: "environment"
                    },
                    config,
                    qrCodeSuccessCallback
                ).catch((err) => {
                    console.log(err);
                });
            });
        </script>
    </section>
@endsection
