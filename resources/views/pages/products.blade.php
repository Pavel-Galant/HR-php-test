@extends('layouts.master')

@section('content')
<section>
    <div id="app"></div>
</section>
@endsection

@section('assets')
    <link rel="stylesheet" href="{{asset('pages/products/main.css')}}">
    <script type="text/javascript" src="{{asset('pages/products/main.js')}}" defer></script>
@endsection