<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-wrap items-center justify-between gap-2">
            <h2 class="font-semibold text-xl text-gray-800">{{ __('Articles') }}</h2>
            @if (Auth::user()->isRegularUser())
                <a href="{{ route('articles.create') }}"><x-primary-button type="button">{{ __('New') }}</x-primary-button></a>
            @endif
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('status'))
                <p class="mb-4 text-sm text-green-700">{{ session('status') }}</p>
            @endif
            @if (Auth::user()->isModerator())
                <p class="mb-4 text-sm text-gray-600">{{ __('All articles (moderator).') }}</p>
            @endif

            <ul class="bg-white shadow sm:rounded-lg divide-y">
                @forelse ($articles as $article)
                    <li class="p-4 flex flex-wrap justify-between gap-2">
                        <div>
                            <a href="{{ route('articles.show', $article) }}" class="font-medium text-indigo-600">{{ $article->title }}</a>
                            <p class="text-sm text-gray-500">{{ \Illuminate\Support\Str::limit(strip_tags($article->content), 120) }}</p>
                            @if (Auth::user()->isModerator() && $article->user)
                                <p class="text-xs text-gray-400 mt-1">{{ $article->user->name }}</p>
                            @endif
                        </div>
                        <div class="flex gap-2">
                            @can('update', $article)
                                <a href="{{ route('articles.edit', $article) }}" class="text-sm text-gray-600 underline">{{ __('Edit') }}</a>
                            @endcan
                        </div>
                    </li>
                @empty
                    <li class="p-8 text-center text-gray-500">{{ Auth::user()->isModerator() ? __('No articles.') : __('No articles yet.') }}</li>
                @endforelse
            </ul>
            <div class="mt-4">{{ $articles->links() }}</div>
        </div>
    </div>
</x-app-layout>
