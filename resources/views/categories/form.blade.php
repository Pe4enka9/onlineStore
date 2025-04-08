@php
    $category = $category ?? new \App\Models\Category();
@endphp

<div class="input-container">
    <input type="text" name="name" id="name" placeholder="Название" value="{{ $category->name ?? '' }}">
    @error('name') <p class="error">{{ $message }}</p> @enderror
</div>

<div class="input-container">
    <textarea name="description" id="description" placeholder="Описание">{{ $category->description ?? '' }}</textarea>
    @error('description') <p class="error">{{ $message }}</p> @enderror
</div>
