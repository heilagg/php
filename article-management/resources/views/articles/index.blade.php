<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Articles') }}
            </h2>
            @auth
                @if(Auth::user()->isRegularUser())
                    <a href="{{ route('articles.create') }}">
                        <x-primary-button type="button">{{ __('New article') }}</x-primary-button>
                    </a>
                @endif
            @endauth
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">
            @if (session('status'))
                <div class="rounded-md bg-green-50 p-4 text-sm text-green-800 shadow-sm">
                    {{ session('status') }}
                </div>
            @endif

            @if(Auth::user()->isModerator())
                <p class="text-sm text-gray-600">{{ __('You are viewing all articles as a moderator.') }}</p>
            @endif

            <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
                <ul class="divide-y divide-gray-100">
                    @forelse ($articles as $article)
                        <li class="p-6 hover:bg-gray-50 transition">
                            <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">
                                <div class="min-w-0 flex-1">
                                    <a href="{{ route('articles.show', $article) }}" class="text-lg font-medium text-indigo-600 hover:text-indigo-800">
                                        {{ $article->title }}
                                    </a>
                                    <p class="mt-1 text-sm text-gray-500 line-clamp-2">{{ \Illuminate\Support\Str::limit(strip_tags($article->content), 180) }}</p>
                                    @if(Auth::user()->isModerator() && $article->user)
                                        <p class="mt-2 text-xs text-gray-400">
                                            {{ __('Author') }}: {{ $article->user->name }} ({{ $article->user->email }})
                                        </p>
                                    @endif
                                </div>
                                <div class="flex flex-wrap gap-2 shrink-0">
                                    <a href="{{ route('articles.show', $article) }}">
                                        <x-secondary-button type="button">{{ __('View') }}</x-secondary-button>
                                    </a>
                                    @can('update', $article)
                                        <a href="{{ route('articles.edit', $article) }}">
                                            <x-secondary-button type="button">{{ __('Edit') }}</x-secondary-button>
                                        </a>
                                    @endcan
                                </div>
                            </div>
                        </li>
                    @empty
                        <li class="p-10 text-center text-gray-500">
                            {{ Auth::user()->isModerator() ? __('No articles in the system yet.') : __('You have not created any articles yet.') }}
                        </li>
                    @endforelse
                </ul>
            </div>

            <div class="px-2">
                {{ $articles->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
