@extends('dashboard')

@section('title', 'Scanner')

@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('dist/css/pages/scanner/scanner.css') }}">
@endsection

@section('content')
    <section class="dark-bg">

        <div class="head">
            <div class="title">scanner</div>
            {{-- <a class="add" href="{{ route("$table.add.show") }}"> <i class="fa-solid fa-plus"></i><span>add new row</span></a> --}}
        </div>



        <div id="reader" style="width: 500px;"></div>
        <div id="result"></div>
    </section>
@endsection

@section('script')
    <script src="https://unpkg.com/html5-qrcode/minified/html5-qrcode.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const html5QrCode = new Html5Qrcode("reader");

            const qrCodeSuccessCallback = (decodedText, decodedResult) => {

                html5QrCode.stop().then((ignore) => {}).catch((err) => {
                    console.log(err);
                });

                window.location.href = `/dashboard/scanner/addPoints/${encodeURIComponent(decodedText)}`;
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
@endsection
