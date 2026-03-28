<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight truncate">
                {{ $article->title }}
            </h2>
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('articles.index') }}">
                    <x-secondary-button type="button">{{ __('Back to list') }}</x-secondary-button>
                </a>
                @can('update', $article)
                    <a href="{{ route('articles.edit', $article) }}">
                        <x-primary-button type="button">{{ __('Edit') }}</x-primary-button>
                    </a>
                @endcan
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-4">
            @if (session('status'))
                <div class="rounded-md bg-green-50 p-4 text-sm text-green-800 shadow-sm">
                    {{ session('status') }}
                </div>
            @endif

            <div class="bg-white shadow-sm sm:rounded-lg p-6 space-y-4">
                @if(Auth::user()->isModerator())
                    <p class="text-sm text-gray-500">
                        {{ __('Author') }}:
                        <span class="font-medium text-gray-700">{{ $article->user->name }}</span>
                        <span class="text-gray-400">({{ $article->user->email }})</span>
                    </p>
                @endif
                <div class="prose prose-sm max-w-none text-gray-800 whitespace-pre-wrap">{{ $article->content }}</div>

                @can('delete', $article)
                    <form method="POST" action="{{ route('articles.destroy', $article) }}" class="pt-4 border-t border-gray-100" onsubmit="return confirm(@json(__('Delete this article?')));">
                        @csrf
                        @method('DELETE')
                        <x-danger-button type="submit">{{ __('Delete article') }}</x-danger-button>
                    </form>
                @endcan
            </div>
        </div>
    </div>
</x-app-layout>
