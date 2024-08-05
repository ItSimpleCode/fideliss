@extends('dashboard')

@section('title', 'Scanner')

@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('dist/css/pages/scanner/scanner.css') }}">
@endsection

@section('content')
    <section class="dark-bg sacnner">

        <div class="head">
            <div class="title">scanner</div>
            {{-- <a class="add" href="{{ route("$table.add.show") }}"> <i class="fa-solid fa-plus"></i><span>add new row</span></a> --}}
        </div>
        <div class="form">
            <div id="reader" style="width: 500px;"></div>
            <form action={{ route('scanner.addPoints.showv2') }}>
                <div class="part">
                    <div class="field">
                        <label for="Identification_number">Identification number</label>
                        <input type="text" id="Identification_number" name="card_serial">
                    </div>
                </div>
                <div class="part">
                    <button type="submit"></i><span>go</span></button>
                </div>
            </form>
        </div>
    </section>
@endsection

@section('script')
    <script src="https://unpkg.com/html5-qrcode/minified/html5-qrcode.min.js"></script>
    <script>
        const html5QrCode = new Html5Qrcode("reader");

        const qrCodeSuccessCallback = (decodedText, decodedResult) => {
            html5QrCode.stop().then((ignore) => {}).catch((err) => console.log(err));
            window.location.href = `/dashboard/addPoints/${encodeURIComponent(decodedText)}`;
        };

        const config = {
            fps: 30,
            qrbox: 250
        };

        html5QrCode.start({
            facingMode: "environment"
        }, config, qrCodeSuccessCallback).catch((err) => console.log(err))
    </script>
@endsection
