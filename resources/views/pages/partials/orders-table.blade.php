<table class="table table-bordered" style="margin-top: 2em;">
    <thead>
        <tr>
            <th class="text-center">№ заказа</th>
            <th class="text-center">Партнер</th>
            <th class="text-center">Стоимость</th>
            <th class="text-center">Состав заказа</th>
            <th class="text-center">Статус заказа</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($orders as $order)
            @php 
                $productCount = count($order['products']);
                $orderSum = 0;
            @endphp
            @if ($productCount > 0)
                @foreach ($order['products'] as $key=>$product)
                @php 
                    $rowSum = $product['extra']['price']*$product['extra']['quantity'];
                    $orderSum += $rowSum; 
                @endphp
                <tr>
                    @if ($key == 0)
                        <td rowspan="{{$productCount+1}}"><a href="{{ url('/orders/edit', ['id' => $order['id']]) }}">{{$order['id']}}</a></td>
                        <td rowspan="{{$productCount}}">{{$order['partner']['name']}}</td>
                    @endif
                        <td>{{$rowSum}}</td>
                        <td>{{$product['name']}}</td>
                    @if ($key == 0)
                        <td rowspan="{{$productCount+1}}">{{$order['status_title']}}</td>
                    @endif
                </tr>
                @endforeach
                <tr>
                    <td><strong>Итого по заказу:</strong></td>
                    <td><strong>{{$orderSum}}</strong></td>
                    <td></td>
                </tr>
            @else
            <tr>
                <td><a href="{{ url('/orders/edit', ['id' => $order['id']]) }}">{{$order['id']}}</a></td>
                <td>{{$order['partner']['name']}}</td>
                <td>--</td>
                <td>--</td>
                <td>{{$order['status_title']}}</td>
            </tr>
            @endif
        @endforeach
    </tbody>
</table>