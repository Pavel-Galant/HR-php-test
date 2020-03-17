@extends('layouts.master')

@section('content')

<section>
    <div class="container">
        <div class="row" style="margin-bottom: 2em;">
            <div class="col-lg-12 text-center">
                <h2>Редактирование заказа</h2>
            </div>
        </div>
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                @foreach ($errors->all() as $key=>$error)
                    <li> {{ $error }}</li>
                @endforeach
                </ul>
            </div>
        @endif
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-primary">
                    <div class="panel-heading text-center"><strong>Заказ № {{$order['id']}}</strong></div>
                    <div class="panel-body">
                    <form role="form" method="POST" action="{{url()->full()}}">
                        <input name="id" type="hidden" value="{{$order['id']}}">
                        <div class="col-md-6">
                            <div class="form-group" style="margin-top: 0.8em;">
                                <label for="client-email">Email клиента <span class="text-danger">*</span></label>
                                <input name="client_email" type="email" class="form-control id="client-email" placeholder="Введите email" value="{{$order['client_email']}}">
                            </div>
                            <div class="form-group">
                                <label for="partner-select">Партнер <span class="text-danger">*</span></label>
                                <select name="partner_id" class="form-control" id="partner-select">
                                    @foreach ($partners as $partner)
                                        <option  @if ($partner['id'] == $order['partner_id']) selected @endif  value="{{$partner['id']}}">{{$partner['name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="status-select">Состояние заказа <span class="text-danger">*</span></label>
                                <select name="status" class="form-control" id="status-select">
                                    @foreach ($statuses as $key=>$status)
                                        <option  @if ($key == $order['status']) selected @endif  value="{{$key}}">{{$status}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 text-center">
                            <div class="form-group">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Наименование товара</th>
                                            <th class="text-center">Кол-во,шт</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $orderSum = 0; @endphp
                                        @foreach ($order['products'] as $product)
                                            @php $orderSum += $product['extra']['quantity']*$product['extra']['price']; @endphp
                                            <tr>
                                                <td>{{$product['name']}}</td>
                                                <td>{{$product['extra']['quantity']}}</td>
                                            </tr>
                                        @endforeach
                                            <tr>
                                                <td>Стоимость заказа:</td>
                                                <td>{{$orderSum}}</td>
                                            </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        {{ csrf_field() }}
                        <div class="row text-right">
                            <button type="submit" class="btn btn-primary" style="margin-right:2em;">Сохранить</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection