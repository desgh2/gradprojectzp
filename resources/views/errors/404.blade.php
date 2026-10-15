@extends('layouts.app')
@section('title', '404 Сторінку не знайдено')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-10 offset-md-1 col-lg-10 offset-lg-1">
                <div class="error-not-found">
                    <div class="error-code">404</div>
                    <h1 class="error-title">Сторінку не знайдено</h1>
                    <p class="error-text">Вибачте, але таку сторінку на нашому веб-сайті не знайдено. Можливо, що
                        сторінка була вилучена, перейменована або тимчасово недоступна.</p>
                    <p class="error-text">Ми пропонуємо вам повернутися на <a href="#">головну сторінку</a>.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
