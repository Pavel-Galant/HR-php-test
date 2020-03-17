@extends('layouts.master')

@section('content')

<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h3 class="text-muted">Пояснения к задачам</h3>
            </div>
        </div>
        <div class="row text-center">
            <div class="col-md-4">
                <h4>Погода</h4>
                <p class="text-muted text-justify">Используется api Я.Погода с тестовым ключом. Данные выводятся за 6 дней</p>
            </div>
            <div class="col-md-4">
                <h4>Заказы</h4>
                <p class="text-muted text-justify">Страница с заказамими рендерится на сервере. Вкладки с разными типами заказов добавлены. Отправку уведомлений на почту о смене статуса заказа не делал.</p>
            </div>
            <div class="col-md-4">
                <h4>Товары</h4>
                <p class="text-muted text-justify">Вывод товаров реализован на vue.js (исходники в папке resources/assets/pages/products). Пагинация сделана по 5 элементов на страницу, т.к. мало товаров в базе. Изменение цены товара происходит по щелчку на ячейке (появляется <strong>inline редактор</strong>)</p>
            </div>
        </div>
    </div>
</section>

@endsection