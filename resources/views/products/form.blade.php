@php
    $product = $product ?? new \App\Models\Product();
@endphp

<div class="input-container">
    <input type="text" name="name" id="name" placeholder="Название" value="{{ $product->name ?? old('name') }}">
    @error('name') <p class="error">{{ $message }}</p> @enderror
</div>

<div class="input-container">
    <textarea name="description" id="description"
              placeholder="Описание">{{ $product->description ?? old('description') }}</textarea>
    @error('description') <p class="error">{{ $message }}</p> @enderror
</div>

<div class="input-container">
    <input type="number" name="price" id="price" placeholder="Цена" step="0.01"
           value="{{ $product->price ?? old('price') }}">
    @error('price') <p class="error">{{ $message }}</p> @enderror
</div>

<div class="input-container">
    <input type="file" name="image" id="image">
    @error('image') <p class="error">{{ $message }}</p> @enderror
</div>

<div class="input-container">
    <select name="category_id" id="category_id">
        @foreach($categories as $category)
            <option
                    value="{{ $category->id }}" {{ $category->id === $product->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
        @endforeach
    </select>
    @error('category_id') <p class="error">{{ $message }}</p> @enderror
</div>
