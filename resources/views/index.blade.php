@include('includes.header')

<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <h1 class="my-4">Главная</h1>
            <p class="lead">Выберите категорию</p>
        </div>
        @foreach ($categories as $category)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <img class="card-img-top" src="{{ $category->image }}" alt="{{ $category->name }}" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h2 class="card-title">{{ $category->name }}</h2>
                        <a href="{{ route('category.show', $category) }}" class="btn btn-primary">Подробнее</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@include('includes.footer')