<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthorRequest;
use App\Service\AuthorService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Throwable;
use Exception;

class AuthorController extends Controller
{
    protected AuthorService $authorService;

    public function __construct(AuthorService $authorService)
    {
        $this->authorService = $authorService;
    }

    public function index(): View
    {
        try {
            $authors = $this->authorService->getAuthors();
            return view('admin.pages.authors.index', compact('authors'));
        } catch (Throwable $th) {
            return $this->viewException($th);
        }
    }

    public function create(): View
    {
        try {
            return view('admin.pages.authors.create');
        } catch (Throwable $th) {
            return $this->viewException($th);
        }
    }

    public function store(AuthorRequest $request):  View|RedirectResponse
    {
        try {
            $this->authorService->createAuthor($request->validated());
            return redirect()->route('admin.pages.authors.index',[
                'author' => $this->authorService->getAuthors()
            ])->with('success', 'Author created successfully');
        } catch (Throwable $th) {
            return $this->viewException($th);
        }
    }

    public function edit(int $id): View
    {
        try {
            $author = $this->authorService->findAuthorById($id);
            return view('admin.pages.authors.edit', compact('author'));
        } catch (Throwable $th) {
            return $this->viewException($th);
        }
    }

    public function update(AuthorRequest $request, int $id): View|RedirectResponse
    {
        try {
            $this->authorService->updateAuthor($id, $request->validated());
            return redirect()->route('admin.pages.authors.index', [
                'authors' => $this->authorService->getAuthors()
            ])->with('success', 'Author updated successfully');
        } catch (Throwable $th) {
            return $this->viewException($th);
        }
    }

    public function destroy(int $id): View|RedirectResponse
    {
        try {
            $this->authorService->deleteAuthor($id);
            return redirect()->route('admin.pages.authors.index', [
                'authors' => $this->authorService->getAuthors()
            ])->with('success', 'Author deleted successfully');
        } catch (Throwable $th) {
            return $this->viewException($th);
        }
    }
}
