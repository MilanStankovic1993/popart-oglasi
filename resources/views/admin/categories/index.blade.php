<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Kategorije') }}
            </h2>

            <a href="{{ route('admin.categories.create') }}"
               class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white border border-transparent rounded-md font-semibold text-xs uppercase tracking-widest">
                + Nova kategorija
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 px-4 py-2 bg-green-100 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif
            <div class="p-6 text-gray-900 dark:text-gray-100">

                <ul class="space-y-1">
                    @foreach($categories as $category)
                        @include('admin.categories._category-item', ['category' => $category, 'level' => 0])
                    @endforeach
                </ul>

                <p class="mt-4 text-sm text-gray-500">
                    Ukupno kategorija: {{ $totalCount }}
                </p>

            </div>
        </div>
    </div>
</x-app-layout>
