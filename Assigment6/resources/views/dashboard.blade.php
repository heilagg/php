<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 space-y-4">
                    <p>{{ __("You're logged in!") }}</p>
                    <p class="text-sm text-gray-600">
                        {{ __('Role') }}:
                        <span class="font-medium capitalize">{{ Auth::user()->role }}</span>
                    </p>
                    <a href="{{ route('articles.index') }}" class="inline-flex items-center text-indigo-600 hover:text-indigo-800 font-medium">
                        {{ __('Go to articles') }} →
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
