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

    public function index(): View
    {
        try {
            $categories = $this->categoryService->getCategories();
            return view('admin.pages.categories.index', compact('categories'));
        } catch (Throwable $th) {
            return $this->viewException($th);
        }
    }


    public function create(): View
    {
        try {
            return view('admin.pages.categories.create');
        } catch (Throwable $th) {
            return $this->viewException($th);
        }
    }

    public function store(CategoryRequest $request): View|RedirectResponse
    {
        try {
            $this->categoryService->createCategory($request->validated());
            return redirect()->route('admin.categories.index', [
                'categories' => $this->categoryService->getCategories()
            ])->with('success', 'Category created successfully');
        } catch (Throwable $th) {
            return $this->viewException($th);
        }
    }

    public function edit(int $id): View|RedirectResponse
    {
        try {
            $category = $this->categoryService->findCategoryById($id);
            return view('admin.pages.categories.edit', compact('category'));
        } catch (Throwable $th) {
            return $this->viewException($th);
        }
    }

    public function update(CategoryRequest $request, int $id): View|RedirectResponse
    {
        try {
            $this->categoryService->updateCategory($id, $request->validated());
            return redirect()->route('admin.categories.index', [
                'categories' => $this->categoryService->getCategories()
            ])->with('success', 'Category updated successfully');
        } catch (Throwable $th) {
            return $this->viewException($th);
        }
    }

    public function destroy(int $id): View|RedirectResponse
    {
        try {
            $this->categoryService->deleteCategory($id);
            return redirect()->route('admin.categories.index', [
                'categories' => $this->categoryService->getCategories()
            ])->with('success', 'Category deleted successfully');
        } catch (Throwable $th) {
            return $this->viewException($th);
        }
    }
}
