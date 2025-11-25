<x-guest-layout>
    <div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
        {{-- Naslov --}}
        <div class="mb-6">
            <h1 class="text-2xl font-semibold text-gray-800">
                @if(isset($currentCategory) && $currentCategory)
                    Kategorija: {{ $currentCategory->name }}
                @else
                    Svi oglasi
                @endif
            </h1>
            <p class="text-sm text-gray-500 mt-1">
                Pronađite oglase pomoću kategorija i filtera ispod.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            {{-- SIDEBAR --}}
            <aside class="md:col-span-1">
                <div class="bg-white shadow-sm rounded-lg p-4">
                    <h2 class="text-sm font-semibold text-gray-700 mb-3">
                        Kategorije
                    </h2>

                    {{-- RESET KATEGORIJA --}}
                    <a href="{{ route('front.ads.index') }}"
                       class="inline-block mb-3 text-xs text-blue-600 hover:underline">
                        Reset kategorija
                    </a>

                    @if($categories->count())
                        @include('front.partials.category-tree', [
                            'categories'      => $categories,
                            'currentCategory' => $currentCategory ?? null,
                            'level'           => 0,
                        ])
                    @else
                        <p class="text-xs text-gray-500">Nema kategorija.</p>
                    @endif
                </div>
            </aside>

            {{-- GLAVNI SADRŽAJ --}}
            <main class="md:col-span-3">
                {{-- FILTERI --}}
                <div class="bg-white shadow-sm rounded-lg p-4 mb-4">
                    <form method="GET"
                          action="{{ isset($currentCategory)
                                        ? route('front.ads.category', $currentCategory)
                                        : route('front.ads.index') }}"
                          class="grid grid-cols-1 md:grid-cols-6 gap-3 text-sm">

                        {{-- Naziv / opis --}}
                        <div class="md:col-span-2">
                            <label class="block text-xs font-medium text-gray-600 mb-1">
                                Naziv ili opis
                            </label>
                            <input type="text"
                                   name="q"
                                   value="{{ $filters['q'] ?? '' }}"
                                   class="w-full border-gray-300 rounded-md shadow-sm"
                                   placeholder="Laptop, stan, auto...">
                        </div>

                        {{-- Lokacija --}}
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">
                                Lokacija
                            </label>
                            <input type="text"
                                   name="location"
                                   value="{{ $filters['location'] ?? '' }}"
                                   class="w-full border-gray-300 rounded-md shadow-sm"
                                   placeholder="Beograd, Novi Sad...">
                        </div>

                        {{-- Stanje --}}
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">
                                Stanje
                            </label>
                            <select name="condition"
                                    class="w-full border-gray-300 rounded-md shadow-sm">
                                <option value="">Sve</option>
                                <option value="novo" {{ ($filters['condition'] ?? '') === 'novo' ? 'selected' : '' }}>Novo</option>
                                <option value="polovno" {{ ($filters['condition'] ?? '') === 'polovno' ? 'selected' : '' }}>Polovno</option>
                            </select>
                        </div>

                        {{-- Cena --}}
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">
                                Cena (min - max)
                            </label>
                            <div class="flex space-x-2">
                                <input type="number"
                                       name="min_price"
                                       value="{{ $filters['min_price'] ?? '' }}"
                                       class="w-1/2 border-gray-300 rounded-md shadow-sm"
                                       placeholder="od">
                                <input type="number"
                                       name="max_price"
                                       value="{{ $filters['max_price'] ?? '' }}"
                                       class="w-1/2 border-gray-300 rounded-md shadow-sm"
                                       placeholder="do">
                            </div>
                        </div>

                        {{-- Sortiranje --}}
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">
                                Sortiraj
                            </label>
                            <select name="sort"
                                    class="w-full border-gray-300 rounded-md shadow-sm">
                                <option value="">Podrazumevano</option>
                                <option value="newest" {{ request('sort')=='newest'?'selected':'' }}>Najnoviji</option>
                                <option value="oldest" {{ request('sort')=='oldest'?'selected':'' }}>Najstariji</option>
                                <option value="price_asc" {{ request('sort')=='price_asc'?'selected':'' }}>Cena (rast.)</option>
                                <option value="price_desc" {{ request('sort')=='price_desc'?'selected':'' }}>Cena (opad.)</option>
                            </select>
                        </div>

                        {{-- Dugmad --}}
                        <div class="flex items-end space-x-2">
                            <button type="submit"
                                    class="inline-flex justify-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold rounded-md">
                                Pretraži
                            </button>

                            <a href="{{ isset($currentCategory)
                                        ? route('front.ads.category', $currentCategory)
                                        : route('front.ads.index') }}"
                               class="inline-flex justify-center px-4 py-2 border border-gray-300 bg-white hover:bg-gray-50 text-gray-700 text-xs font-semibold rounded-md">
                                Reset
                            </a>
                        </div>
                    </form>
                </div>

                {{-- LISTA OGLASA --}}
                <div class="bg-white shadow-sm rounded-lg p-4">

                    @if($ads->count())
                        <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                            @foreach($ads as $ad)
                                <a href="{{ route('front.ads.show', $ad) }}"
                                   class="border border-gray-100 rounded-lg overflow-hidden hover:shadow-md transition-shadow">
                                    @if($ad->image)
                                        <img src="{{ asset('storage/' . $ad->image) }}"
                                             alt="{{ $ad->title }}"
                                             class="w-full h-40 object-cover">
                                    @endif

                                    <div class="p-3">
                                        <h3 class="text-sm font-semibold text-gray-800 truncate">
                                            {{ $ad->title }}
                                        </h3>

                                        <p class="mt-1 text-sm text-blue-600 font-semibold">
                                            {{ number_format($ad->price, 2, ',', '.') }} RSD
                                        </p>

                                        <p class="mt-1 text-xs text-gray-500">
                                            {{ $ad->location ?? 'Lokacija nije navedena' }}
                                        </p>

                                        <p class="mt-1 text-xs text-gray-500">
                                            {{ $ad->condition === 'novo' ? 'Novo' : 'Polovno' }}
                                            @if($ad->category)
                                                · {{ $ad->category->name }}
                                            @endif
                                        </p>

                                        <p class="mt-2 text-xs text-gray-400">
                                            Objavio: {{ $ad->user?->name ?? 'Nepoznat korisnik' }}
                                        </p>
                                    </div>
                                </a>
                            @endforeach
                        </div>

                        <div class="mt-4">
                            {{ $ads->links() }}
                        </div>
                    @else
                        <p class="text-sm text-gray-500">
                            Nema oglasa za zadate filtere.
                        </p>
                    @endif
                </div>
            </main>
        </div>
    </div>
</x-guest-layout>
