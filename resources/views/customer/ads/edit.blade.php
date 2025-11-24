<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Izmena oglasa
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <form method="POST"
                          action="{{ route('customer.ads.update', $ad) }}"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- Naslov --}}
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Naslov
                            </label>
                            <input type="text" name="title" value="{{ old('title', $ad->title) }}"
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
                                      class="mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-700 dark:bg-gray-900">{{ old('description', $ad->description) }}</textarea>
                            @error('description')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Cena --}}
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Cena (RSD)
                            </label>
                            <input type="number" step="0.01" name="price" value="{{ old('price', $ad->price) }}"
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
                                <option value="novo" {{ old('condition', $ad->condition) === 'novo' ? 'selected' : '' }}>Novo</option>
                                <option value="polovno" {{ old('condition', $ad->condition) === 'polovno' ? 'selected' : '' }}>Polovno</option>
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
                            <input type="text" name="location" value="{{ old('location', $ad->location) }}"
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
                            <input type="text" name="phone" value="{{ old('phone', $ad->phone) }}"
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
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id', $ad->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Trenutna slika --}}
                        @if($ad->image)
                            <div class="mb-4">
                                <p class="text-sm text-gray-600 mb-1">Trenutna slika:</p>
                                <img src="{{ asset('storage/' . $ad->image) }}"
                                     class="w-40 h-40 object-cover rounded border">
                            </div>
                        @endif

                        {{-- Nova slika --}}
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Nova slika (opciono)
                            </label>
                            <input type="file" name="image"
                                   class="mt-1 block w-full text-sm text-gray-500">
                            @error('image')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-between mt-6">
                            <a href="{{ route('dashboard') }}"
                               class="px-4 py-2 bg-gray-700 hover:bg-gray-800 text-white rounded-md text-sm">
                                Nazad
                            </a>

                            <button type="submit"
                                    class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-md text-sm">
                                Sačuvaj izmene
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
