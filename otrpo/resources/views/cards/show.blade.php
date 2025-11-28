@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>{{ $card->title }}</h1>
    @if($card->image)
        <img src="{{ asset('storage/' . $card->image) }}" alt="{{ $card->title }}" class="img-fluid mb-3">
    @endif
    <p>{{ $card->description }}</p>

    <a href="{{ route('cards.index') }}" class="btn btn-secondary">Назад к списку</a>
    <a href="{{ route('cards.edit', $card->id) }}" class="btn btn-primary">Редактировать</a>
</div>
@endsection
