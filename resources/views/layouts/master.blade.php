<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>HR-php-test</title>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    </head>
    <body id="page-top" class="index">
        <div id="contactsModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">Мои контакты:</h4>
                    </div>
                    <div class="modal-body">
                        <address>
                            <strong>Завражнов Павел Анатольевич</strong><br>
                            <abbr title="Phone">email:</abbr> <a href="mailto:pavel-galant@mail.ru">pavel-galant@mail.ru</a><br>
                            <abbr title="Phone">тел:</abbr> +7(910)913-8354<br>
                            <abbr title="Skype">skype:</abbr> pavel-galant<br>
                        </address>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.partials._navigation')
    
        @include('layouts.partials._header')
    
        <div style="margin-top: 4em;">@yield('content')</div>
    
        @include('layouts.partials._footer')
    </body>
</html>