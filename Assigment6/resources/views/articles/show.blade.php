<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-wrap items-center justify-between gap-2">
            <h2 class="font-semibold text-xl text-gray-800 truncate">{{ $article->title }}</h2>
            <div class="flex gap-2">
                <a href="{{ route('articles.index') }}"><x-secondary-button type="button">{{ __('List') }}</x-secondary-button></a>
                @can('update', $article)
                    <a href="{{ route('articles.edit', $article) }}"><x-primary-button type="button">{{ __('Edit') }}</x-primary-button></a>
                @endcan
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            @if (session('status'))
                <p class="mb-4 text-sm text-green-700">{{ session('status') }}</p>
            @endif
            <div class="bg-white shadow sm:rounded-lg p-6 space-y-4">
                @if (Auth::user()->isModerator())
                    <p class="text-sm text-gray-500">{{ __('Author') }}: {{ $article->user->name }} ({{ $article->user->email }})</p>
                @endif
                <div class="whitespace-pre-wrap text-gray-800">{{ $article->content }}</div>
                @can('delete', $article)
                    <form method="POST" action="{{ route('articles.destroy', $article) }}" onsubmit="return confirm(@json(__('Delete?')));">
                        @csrf @method('DELETE')
                        <x-danger-button type="submit">{{ __('Delete') }}</x-danger-button>
                    </form>
                @endcan
            </div>
        </div>
    </div>
</x-app-layout>
