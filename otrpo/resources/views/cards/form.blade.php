@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>{{ isset($card) ? 'Редактировать карточку' : 'Добавить новую карточку' }}</h1>
    
    <form action="{{ isset($card) ? route('cards.update', $card->id) : route('cards.store') }}" method="POST" enctype="multipart/form-data" novalidate>
        @csrf
        @if(isset($card))
            @method('PUT')
        @endif

        <div class="mb-3">
            <label for="title" class="form-label">Заголовок</label>
            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" 
                   value="{{ old('title', $card->title ?? '') }}" required>
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Описание</label>
            <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" rows="4">{{ old('description', $card->description ?? '') }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Изображение</label>
            <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
            @error('image')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            @if(isset($card) && $card->image)
                <img src="{{ asset('storage/' . $card->image) }}" alt="Текущее изображение" class="img-thumbnail mt-2" style="max-width: 200px;">
            @endif
        </div>

        <button type="submit" class="btn btn-primary">{{ isset($card) ? 'Обновить' : 'Создать' }}</button>
        <a href="{{ route('cards.index') }}" class="btn btn-secondary">Отмена</a>
    </form>
</div>
@endsection
