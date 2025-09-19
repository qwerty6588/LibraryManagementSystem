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

    public function index()
    {
            $authors = $this->authorService->getAuthors();
            return view('admin.pages.authors.index', compact('authors'));
    }

    public function create()
    {
            return view('admin.pages.authors.create');
    }

    public function store(AuthorRequest $request):RedirectResponse
    {

            $this->authorService->createAuthor($request->validated());
            return redirect()->route('admin.authors.index',[
                'author' => $this->authorService->getAuthors()
            ])->with('success', 'Author created successfully');

    }

    public function edit(int $id)
    {

            $author = $this->authorService->findAuthorById($id);
            return view('admin.pages.authors.edit', compact('author'));

    }

    public function update(AuthorRequest $request, int $id):RedirectResponse
    {

            $this->authorService->updateAuthor($id, $request->validated());
            return redirect()->route('admin.authors.index', [
                'authors' => $this->authorService->getAuthors()
            ])->with('success', 'Author updated successfully');

    }

    public function destroy(int $id): RedirectResponse
    {

            $this->authorService->deleteAuthor($id);
            return redirect()->route('admin.authors.index', [
                'authors' => $this->authorService->getAuthors()
            ])->with('success', 'Author deleted successfully');

    }
}
