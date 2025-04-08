<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class CategoryController extends Controller
{
    // Список всех категорий
    public function index(): View
    {
        $categories = Category::withCount('products')->simplePaginate(5);

        return view('categories.index', [
            'categories' => $categories,
        ]);
    }

    /**
     * Форма создания
     *
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function create(): View
    {
        return view('categories.create', [
            'page' => request()->get('page', 1),
        ]);
    }

    /**
     * Создание
     *
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function store(CategoryRequest $request): RedirectResponse
    {
        Category::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);

        return redirect()->route('categories.index', [
            'page' => request()->get('page', 1),
        ]);
    }

    /**
     * Форма редактирования
     *
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function edit(Category $category): View
    {
        return view('categories.edit', [
            'category' => $category,
            'page' => request()->get('page', 1),
        ]);
    }

    /**
     * Обновление
     *
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function update(CategoryRequest $request, Category $category): RedirectResponse
    {
        $category->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);

        return redirect()->route('categories.index', [
            'page' => request()->get('page', 1),
        ]);
    }

    /**
     * Удаление
     *
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();

        return redirect()->route('categories.index', [
            'page' => request()->get('page', 1),
        ]);
    }

    // Просмотр
    public function show(Category $category): View
    {
        return view('categories.show', [
            'category' => $category,
        ]);
    }
}
