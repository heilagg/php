<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit article') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                @include('articles.partials.form', [
                    'action' => route('articles.update', $article),
                    'method' => 'PUT',
                    'submitLabel' => __('Save changes'),
                    'article' => $article,
                ])
            </div>
        </div>
    </div>
</x-app-layout>
