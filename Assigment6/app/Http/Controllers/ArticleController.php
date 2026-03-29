<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ArticleController extends Controller
{
    use AuthorizesRequests;

    private function articleRules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string', 'max:65535'],
        ];
    }

    public function index(Request $request): View
    {
        $this->authorize('viewAny', Article::class);

        $user = $request->user();
        $articles = $user->isModerator()
            ? Article::query()->with('user')->latest()->paginate(12)
            : $user->articles()->latest()->paginate(12);

        return view('articles.index', compact('articles'));
    }

    public function create(): View
    {
        $this->authorize('create', Article::class);

        return view('articles.write', ['article' => null]);
    }

    public function store(Request $request): RedirectResponse
    {
        $this->authorize('create', Article::class);
        $article = $request->user()->articles()->create($request->validate($this->articleRules()));

        return redirect()->route('articles.show', $article)->with('status', __('Article created.'));
    }

    public function show(Article $article): View
    {
        $this->authorize('view', $article);
        $article->load('user');

        return view('articles.show', compact('article'));
    }

    public function edit(Article $article): View
    {
        $this->authorize('update', $article);

        return view('articles.write', compact('article'));
    }

    public function update(Request $request, Article $article): RedirectResponse
    {
        $this->authorize('update', $article);
        $article->update($request->validate($this->articleRules()));

        return redirect()->route('articles.show', $article)->with('status', __('Article updated.'));
    }

    public function destroy(Article $article): RedirectResponse
    {
        $this->authorize('delete', $article);
        $article->delete();

        return redirect()->route('articles.index')->with('status', __('Article deleted.'));
    }
}
