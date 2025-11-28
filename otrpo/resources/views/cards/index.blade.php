@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Карточки</h1>
    <div>
        <a href="{{ route('index') }}" class="btn btn-outline-secondary me-2">← На главную</a>
        <a href="{{ route('cards.create') }}" class="btn btn-primary">Добавить карточку</a>
    </div>

    <div class="row row-cols-1 row-cols-md-3 g-3">
        @foreach($cards as $card)
            <div class="col">
                <div class="card h-100">
                    @if($card->image)
                        <img src="{{ asset('storage/' . $card->image) }}" class="card-img-top" alt="{{ $card->title }}">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $card->title }}</h5>
                        <p class="card-text">{{ Str::limit($card->description, 100) }}</p>
                        <a href="{{ route('cards.show', $card->id) }}" class="btn btn-primary" >
                            Подробнее
                        </a>
                        <a href="{{ route('cards.edit', $card->id) }}" class="btn btn-secondary">Редактировать</a>
                        <form action="{{ route('cards.destroy', $card->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Удалить эту карточку?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Удалить</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
