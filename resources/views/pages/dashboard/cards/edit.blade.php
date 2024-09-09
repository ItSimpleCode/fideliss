@extends('dashboard')

@section('title', 'Cardes - Modifier')

@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('dist/css/pages/cards/type_of_card.css') }}">
@endsection

@section('content')
    <section class="outer-bg mh-100">
        <div class="head">
            <div class="title">
                <a class="return-link" href="{{ Route('cards') }}">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M16 12H8M8 12L11 9M8 12L11 15" class="stroke" stroke-width="1.5" stroke-linecap="round"
                              stroke-linejoin="round"></path>
                        <path
                            d="M22 12C22 16.714 22 19.0711 20.5355 20.5355C19.0711 22 16.714 22 12 22C7.28595 22 4.92893 22 3.46447 20.5355C2 19.0711 2 16.714 2 12C2 7.28595 2 4.92893 3.46447 3.46447C4.92893 2 7.28595 2 12 2C16.714 2 19.0711 2 20.5355 3.46447C21.5093 4.43821 21.8356 5.80655 21.9449 8"
                            class="stroke" stroke-width="1.5" stroke-linecap="round"></path>
                    </svg>
                </a>
                <span>
                    Modifier les informations de <span class="bold underline">{{ $data['row']->name }}</span> card
                </span>
            </div>
        </div>
        <form class="form body" action={{ route('cards.update', ['id' => $data['row']->id]) }} method="POST">
            @csrf
            <div class="part">
                <div class="field">
                    <label for="">type de carte</label>
                    <input type="text" name="name" value={{ $data['row']->name }}>
                </div>
                <div class="field">
                    <label for="">Coût</label>
                    <input type="text" name="cost" value={{ $data['row']->cost }}>
                </div>
                <div class="field">
                    <label for="">période ( En jours )</label>
                    <input type="text" name="period" value={{ $data['row']->period }}>
                </div>

                <div class="selection-field">
                    <div class="field">
                        <label for="">Statut</label>
                        <input class="back" type="hidden" name="active" value={{ $data['row']->active }}>
                        <input class="front" type="text" id="pay-method"
                               value={{ $data['row']->active ? 'actif' : 'inactif' }}>
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M19 9L12 15L10.25 13.5M5 9L7.33333 11" class="stroke" stroke-width="1.5"
                                  stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <div class="options">
                        <span class="option" data-hidden="1">active</span>
                        <span class="option" data-hidden="0">inactif</span>
                    </div>
                </div>
            </div>

            <div class="part">
                <button class="button-add" type="submit">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M22 12C22 8.22876 22 6.34315 20.8284 5.17157C19.6569 4 17.7712 4 14 4M14 20H10C6.22876 20 4.34315 20 3.17157 18.8284C2 17.6569 2 15.7712 2 12C2 8.22876 2 6.34315 3.17157 5.17157C4.34315 4 6.22876 4 10 4"
                            class="stroke" stroke-width="1.5" stroke-linecap="round"/>
                        <path d="M10 16H6" class="stroke" stroke-width="1.5" stroke-linecap="round"/>
                        <path d="M13 16H12.5" class="stroke" stroke-width="1.5" stroke-linecap="round"/>
                        <path d="M2 10L7 10M22 10L11 10" class="stroke" stroke-width="1.5" stroke-linecap="round"/>
                        <path d="M18 18H20M20 18H22M20 18V20M20 18V16" class="stroke" stroke-width="1.5"
                              stroke-linecap="round"/>
                    </svg>
                    <span>ajouter une carte</span>
                </button>
            </div>

        </form>
    </section>
@endsection

@section('script')
    <script src="{{ asset('dist/js/utils/form.js') }}"></script>
@endsection
