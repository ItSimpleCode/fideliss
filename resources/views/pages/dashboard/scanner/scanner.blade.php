@extends('dashboard')

@section('title', 'Scanner')

@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('dist/css/pages/scanner/scanner.css') }}">
@endsection

@section('content')
    <section class="outer-bg h-100">

        <div class="head">
            <div class="title">Scanner</div>
            {{-- <a class="add" href="{{ route("$table.add.show") }}"> <i class="fa-solid fa-plus"></i><span>ajouter une nouvelle ligne</span></a> --}}
        </div>
        <form class="form body" action={{ route('scanner.addPoints.showv2') }} method='post'>
            @csrf
            <div id="reader" style="width: 500px;"></div>
            <div class="part">
                <div class="field">
                    <label for="Identification_number">Numéro d'identification</label>
                    <input type="text" id="Identification_number" name="card_serial">
                </div>
            </div>
            <div class="part">
                <button class="button-add" type="submit"><span>search</span></button>
            </div>
        </form>
    </section>
@endsection

@section('script')
    <script src="https://unpkg.com/html5-qrcode@2.3.8/html5-qrcode.min.js"></script>
    <script>
        const html5QrCode = new Html5Qrcode("reader");

        const qrCodeSuccessCallback = (decodedText, decodedResult) => {
            html5QrCode.stop().then((ignore) => {
            }).catch((err) => console.log(err));
            window.location.href = `${decodeURIComponent(decodedText)}`;
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
