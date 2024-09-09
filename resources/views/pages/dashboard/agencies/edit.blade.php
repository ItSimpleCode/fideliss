@extends('dashboard')

@section('title', 'Agences - Modifier')

@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('dist/css/pages/agencies/edit.css') }}">
@endsection

@section('content')
    <section class="outer-bg">
        <div class="head">
            <div class="title">
                <a class="return-link" href="{{ route('agencies') }}">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M16 12H8M8 12L11 9M8 12L11 15" class="stroke" stroke-width="1.5" stroke-linecap="round"
                              stroke-linejoin="round"/>
                        <path
                            d="M22 12C22 16.714 22 19.0711 20.5355 20.5355C19.0711 22 16.714 22 12 22C7.28595 22 4.92893 22 3.46447 20.5355C2 19.0711 2 16.714 2 12C2 7.28595 2 4.92893 3.46447 3.46447C4.92893 2 7.28595 2 12 2C16.714 2 19.0711 2 20.5355 3.46447C21.5093 4.43821 21.8356 5.80655 21.9449 8"
                            class="stroke" stroke-width="1.5" stroke-linecap="round"/>
                    </svg>
                </a>
                <span>
                    Modifier les informations de <span class="bold underline">{{ $agency['name'] }}</span> agence
                </span>
            </div>
        </div>
        <form class="form body" action={{ route('agencies.update', ['id' => $agency['id']]) }} method="POST">
            @csrf
            <div class="part">
                <div class="field">
                    <label for="name">Nom</label>
                    <input type="text" name="name" id="name" value="{{ $agency['name'] }}">
                </div>
                <div class="field">
                    <label for="address">Adresse</label>
                    <input type="text" name="address" id="address" value="{{ $agency['address'] }}">
                </div>
            </div>

            <div class="part">
                <button class="button-add" type="submit">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9.5 10H14.5M12 12.5L12 7.5" class="stroke" stroke-width="1.5" stroke-linecap="round"/>
                        <path
                            d="M5 15.2161C4.35254 13.5622 4 11.8013 4 10.1433C4 5.64588 7.58172 2 12 2C16.4183 2 20 5.64588 20 10.1433C20 14.6055 17.4467 19.8124 13.4629 21.6744C12.5343 22.1085 11.4657 22.1085 10.5371 21.6744C9.26474 21.0797 8.13831 20.1439 7.19438 19"
                            class="stroke" stroke-width="1.5" stroke-linecap="round"/>
                    </svg>
                    <span>Enregistrer les modifications</span>
                </button>
            </div>
        </form>
    </section>
@endsection

@section('script')
    <script src="{{ asset('dist/js/utils/form.js') }}"></script>
@endsection
