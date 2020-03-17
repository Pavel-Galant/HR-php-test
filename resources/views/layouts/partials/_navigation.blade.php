<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header page-scroll">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand page-scroll" href="{{ url('/') }}">Домой</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li class="hidden">
                    <a href="#page-top"></a>
                </li>
                <li>
                    <a class="page-scroll" href="{{ url('/weather') }}">Погода</a>
                </li>
                <li>
                    <a class="page-scroll" href="{{ url('/orders') }}">Заказы</a>
                </li>
                <li>
                    <a class="page-scroll" href="{{ url('/products') }}">Товары</a>
                </li>
                <li>
                    <a class="page-scroll" href="#" data-toggle="modal" data-target="#contactsModal">Контакты</a>
                </li>
            </ul>
        </div>
    </div>
</nav>