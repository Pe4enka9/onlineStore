<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\ProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Intervention\Image\ImageManager;
use Intervention\Image\Typography\FontFactory;

class ProductController extends Controller
{
    // Список всех товаров
    public function index(): View
    {
        $products = Product::all();

        return view('products.index', [
            'products' => $products,
        ]);
    }

    // Форма создания
    public function create(): View
    {
        $categories = Category::all();

        return view('products.create', [
            'categories' => $categories,
        ]);
    }

    // Создание
    public function store(ProductRequest $request): RedirectResponse
    {
        $imageUrl = $this->processImage($request->file('image'));

        Product::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'image_url' => $imageUrl,
            'category_id' => $request->input('category_id'),
        ]);

        return redirect()->route('products.index');
    }

    // Форма редактирования
    public function edit(Product $product): View
    {
        $categories = Category::all();

        return view('products.edit', [
            'product' => $product,
            'categories' => $categories,
        ]);
    }

    // Обновление
    public function update(UpdateProductRequest $request, Product $product): RedirectResponse
    {
        if ($request->hasFile('image')) {
            $imageUrl = $this->processImage($request->file('image'));
        }

        $product->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'image_url' => $imageUrl ?? $product->image_url,
            'category_id' => $request->input('category_id'),
        ]);

        return redirect()->route('products.index');
    }

    // Удаление
    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();

        return redirect()->route('products.index');
    }

    // Просмотр
    public function show(Product $product): View
    {
        return view('products.show', [
            'product' => $product,
        ]);
    }

    private function processImage($file): string
    {
        $image = ImageManager::gd()->read($file);

        $image = $image->scaleDown(300, 300);

        $image->text('Shop', $image->width() - 15, $image->height() - 10, function (FontFactory $font) {
            $font->filename('./fonts/Roboto-Regular.ttf');
            $font->size(10);
            $font->color('fff');
            $font->stroke('000');
            $font->align('center');
            $font->valign('middle');
        });

        $path = '/products/' . uniqid() . '.jpg';

        Storage::disk('public')->put($path, $image->encodeByPath($path));

        return Storage::disk('public')->url($path);
    }
}
