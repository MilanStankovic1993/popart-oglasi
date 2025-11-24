<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Novi oglas') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <form method="POST"
                          action="{{ route('admin.ads.store') }}"
                          enctype="multipart/form-data">
                        @csrf

                        {{-- Naslov --}}
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Naslov
                            </label>
                            <input type="text" name="title" value="{{ old('title') }}"
                                   class="mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-700 dark:bg-gray-900">
                            @error('title')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Opis --}}
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Opis
                            </label>
                            <textarea name="description" rows="4"
                                      class="mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-700 dark:bg-gray-900">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Cena --}}
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Cena (RSD)
                            </label>
                            <input type="number" step="0.01" name="price" value="{{ old('price') }}"
                                   class="mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-700 dark:bg-gray-900">
                            @error('price')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Stanje --}}
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Stanje
                            </label>
                            <select name="condition"
                                    class="mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-700 dark:bg-gray-900">
                                <option value="novo" {{ old('condition') === 'novo' ? 'selected' : '' }}>Novo</option>
                                <option value="polovno" {{ old('condition') === 'polovno' ? 'selected' : '' }}>Polovno</option>
                            </select>
                            @error('condition')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Lokacija --}}
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Lokacija
                            </label>
                            <input type="text" name="location" value="{{ old('location') }}"
                                   class="mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-700 dark:bg-gray-900">
                            @error('location')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Kontakt telefon --}}
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Kontakt telefon
                            </label>
                            <input type="text" name="phone" value="{{ old('phone') }}"
                                   class="mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-700 dark:bg-gray-900">
                            @error('phone')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Kategorija --}}
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Kategorija
                            </label>
                            <select name="category_id"
                                    class="mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-700 dark:bg-gray-900">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Vlasnik oglasa (customer) --}}
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Vlasnik oglasa (customer)
                            </label>
                            <select name="user_id"
                                    class="mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-700 dark:bg-gray-900">
                                @foreach($customers as $customer)
                                    <option value="{{ $customer->id }}" {{ old('user_id') == $customer->id ? 'selected' : '' }}>
                                        {{ $customer->name }} ({{ $customer->email }})
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Slika --}}
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Slika (opciono)
                            </label>
                            <input type="file" name="image"
                                   class="mt-1 block w-full text-sm text-gray-500">
                            @error('image')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-between mt-6">
                            <a href="{{ route('admin.ads.index') }}"
                               class="px-4 py-2 bg-gray-700 hover:bg-gray-800 text-white rounded-md text-sm">
                                Nazad
                            </a>

                            <button type="submit"
                                    class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md text-sm">
                                Sačuvaj
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
