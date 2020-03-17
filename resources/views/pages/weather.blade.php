@extends('layouts.master')

@section('content')

<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2>ПОГОДА</h2>
                @if (empty($data))
                    <h3 class="text-muted">К сожалению нет данных о температуре в Брянске</h3>
                @else
                    <h3 class="text-muted">сейчас в  Брянске <strong>{{$data['fact']['temp']}}</strong> &deg;С</h3>
                @endif
            </div>
        </div>
        @unless (empty($data))
            <div class="row text-center">
            @foreach ($data['forecasts'] as $forecast)
            <div class="col-md-2">
                <div class="panel panel-info">
                    <div class="panel-heading"><strong>{{$forecast['date']}}</strong></div>
                    <div class="panel-body">
                        <p class="text-left">Ночью <strong>{{$forecast['parts']['night']['temp_avg']}}</strong> &deg;С</p>
                        <p class="text-left">Утром <strong>{{$forecast['parts']['morning']['temp_avg']}}</strong> &deg;С</p>
                        <p class="text-left">Днем <strong>{{$forecast['parts']['day']['temp_avg']}}</strong> &deg;С</p>   
                        <p class="text-left">Вечером <strong>{{$forecast['parts']['evening']['temp_avg']}}</strong> &deg;С</p> 
                    </div>
                </div>
            </div>
            @endforeach
            </div>
        @endunless
    </div>
</section>

@endsection