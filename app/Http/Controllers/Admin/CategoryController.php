<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Service\CategoryService;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Throwable;

class CategoryController extends Controller
{
    protected CategoryService $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index()
    {

            $categories = $this->categoryService->getCategories();
            return view('admin.pages.categories.index', compact('categories'));

    }


    public function create()
    {
            return view('admin.pages.categories.create');
    }

    public function store(CategoryRequest $request): RedirectResponse
    {

            $this->categoryService->createCategory($request->validated());
            return redirect()->route('admin.categories.index', [
                'categories' => $this->categoryService->getCategories()
            ])->with('success', 'Category created successfully');

    }

    public function edit(int $id)
    {

            $category = $this->categoryService->findCategoryById($id);
            return view('admin.pages.categories.edit', compact('category'));

    }

    public function update(CategoryRequest $request, int $id): RedirectResponse
    {

            $this->categoryService->updateCategory($id, $request->validated());
            return redirect()->route('admin.categories.index', [
                'categories' => $this->categoryService->getCategories()
            ])->with('success', 'Category updated successfully');

    }

    public function destroy(int $id): RedirectResponse
    {
            $this->categoryService->deleteCategory($id);
            return redirect()->route('admin.categories.index', [
                'categories' => $this->categoryService->getCategories()
            ])->with('success', 'Category deleted successfully');
    }
}
