@include('includes.header')

<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <h1>Корзина</h1>
            <p>Добро пожаловать на страницу вашей корзины, {{ Auth::user()->name }}!</p>

            @if($products->isEmpty())
                <p>Ваша корзина пуста.</p>
            @else
                <table class="table">
                    <thead>
                        <tr>
                            <th>Название товара</th>
                            <th>Цена</th>
                            <th>Количество</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php
                        $total = 0;
                    @endphp
                    @foreach($products as $product)
                        @php
                            $total += $product->product->price * $product->count;
                        @endphp
                        <tr>
                            <td>{{ $product->product->name }}</td>
                            <td>{{ $product->product->price * $product->count }}</td>
                            <td>
                                <div style="display: flex; align-items: center;">
                                    <form action="{{ route('cart.decrease', $product->product->id) }}" method="POST" style="margin-right: 10px;">
                                        @csrf
                                        <button type="submit" class="btn btn-danger">-</button>
                                    </form>
                                    {{ $product->count }}
                                    <form action="{{ route('cart.increase', $product->product->id) }}" method="POST" style="margin-left: 10px;">
                                        @csrf
                                        <button type="submit" class="btn btn-success">+</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <p>Общая сумма: {{ $total }}</p>
                <form action="{{ route('cart.checkout') }}" method="POST">
                    @csrf
                    <br>
                    <label>Выберите способ оплаты</label>
                    <div class="form-check">
                        <input type="radio" name="paymentMethod" id="card" value="card" class="form-check-input" required>
                        <label for="card" class="form-check-label">Оплатить картой</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" name="paymentMethod" id="cash" value="cash" class="form-check-input" required>
                        <label for="cash" class="form-check-label">Оплатить наличными</label>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="address">Адрес доставки</label>
                        <input type="text" class="form-control" id="address" name="address" value="{{ Auth::user()->address }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Купить</button>
                </form>
            @endif
        </div>
    </div>
</div>

@include('includes.footer')