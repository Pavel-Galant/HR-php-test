@extends('layouts.master')

@section('content')

<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2>ЗАКАЗЫ</h2>
            </div>
        </div>
        
        <div class="row text-center">
            <ul class="nav nav-tabs" role="tablist">
                <li class="active">
                    <a href="#back" role="tab" data-toggle="tab">Просроченные</a>
                </li>
                <li>
                    <a href="#current" role="tab" data-toggle="tab">Текущие</a>
                </li>
                <li>
                    <a href="#new" role="tab" data-toggle="tab">Новые</a>
                </li>
                <li>
                    <a href="#closed" role="tab" data-toggle="tab">Завершенные</a>
                </li>
            </ul>
            
            <div class="tab-content">
                <div class="tab-pane fade active in" id="back">
                    @include('pages.partials.orders-table', ['orders' => $data['backOrders']])
                </div>
                <div class="tab-pane fade" id="current">
                    @include('pages.partials.orders-table', ['orders' => $data['currentOrders']])
                </div>
                <div class="tab-pane fade" id="new">
                @include('pages.partials.orders-table', ['orders' => $data['newOrders']])
                </div>
                <div class="tab-pane fade" id="closed">
                @include('pages.partials.orders-table', ['orders' => $data['closedOrders']])
                </div>
            </div>
        </div>
    </div>
</section>

@endsection