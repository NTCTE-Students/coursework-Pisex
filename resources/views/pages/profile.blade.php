@include('includes.header')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="my-4">Профиль</h1>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <img src="{{ Auth::user()->avatar=='default.jpg'?'assets/images/default.jpg':asset('storage/' . Auth::user()->avatar) }}" class="img-fluid rounded-circle" alt="Аватар" style="width: 200px; height: 200px;">
                        </div>
                        <div class="col-md-9">
                            <h2>{{ Auth::user()->name }}</h2>
                            <p>Email: {{ Auth::user()->email }}</p>
                            <p>Возраст: {{ Auth::user()->age }}</p>
                            <button class="btn btn-primary" data-toggle="modal" data-target="#editProfileModal">Редактировать профиль</button>
                        </div>
                    </div>
                </div>
            </div>
            <h2 class="my-4">История заказов</h2>
            @foreach(Auth::user()->receipts as $receipt)
                <div class="card my-2">
                    <div class="card-body">
                        <h5 class="card-title">Заказ #{{ $receipt->id }}</h5>
                        <p class="card-text">Адрес доставки: {{ $receipt->address }}</p>
                        <p class="card-text">Дата: {{ $receipt->created_at }}</p>
                        <p class="card-text">Товары:</p>
                        <ul>
                        @foreach($receipt->products as $product)
                            <li>{{ $product->name }} ({{ $product->pivot->count }} шт.)</li>
                        @endforeach
                        </ul>
                        @if(empty($receipt->review))
                            <form action="{{ route('receipts.review', $receipt->id) }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="comment">Оставьте отзыв:</label>
                                    <textarea class="form-control" id="comment" name="comment"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Оценка:</label>
                                    <div>
                                        @for($i = 1; $i <= 5; $i++)
                                            <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" {{ old('rating') == $i ? 'checked' : '' }}>
                                            <label for="star{{ $i }}">{{ $i }}</label>
                                        @endfor
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Отправить отзыв</button>
                            </form>
                        @else
                            <p>Ваш отзыв: {{ $receipt->review->comment }}</p>
                            <p>Ваша оценка: {{ $receipt->review->rating }} из 5</p>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>


<div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog" aria-labelledby="editProfileModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editProfileModalLabel">Редактировать профиль</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="modal-body">
          <div class="form-group">
            <label for="name">Имя</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}">
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}">
          </div>
          <div class="form-group">
            <label for="password">Пароль</label>
            <input type="password" class="form-control" id="password" name="password">
          </div>
          <div class="form-group">
            <label for="age">Возраст</label>
            <input type="number" class="form-control" id="age" name="age" value="{{ Auth::user()->age }}">
          </div>
          <div class="form-group">
            <label for="avatar">Аватар</label>
            <input type="file" class="form-control-file" id="avatar" name="avatar">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
          <button type="submit" class="btn btn-primary">Сохранить изменения</button>
        </div>
      </form>
    </div>
  </div>
</div>

@include('includes.footer')