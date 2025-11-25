<x-guest-layout>
    <div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
        @php
            // ako imamo kategoriju – vrati se na listu te kategorije,
            // u suprotnom na listu svih oglasa
            $backUrl = isset($currentCategory) && $currentCategory
                ? route('front.ads.category', $currentCategory)
                : route('front.ads.index');
        @endphp

        {{-- Gornja linija: dugme nazad + naslov --}}
        <div class="mb-6 flex items-center justify-between gap-4">
            <a href="{{ $backUrl }}"
               class="inline-flex items-center px-3 py-2 rounded-md border border-gray-300 bg-white text-xs font-medium text-gray-700 hover:bg-gray-50">
                ← Nazad na listu oglasa
            </a>

            @if($ad->category)
                <span class="text-xs text-gray-500">
                    Kategorija:
                    <a href="{{ route('front.ads.category', $ad->category) }}"
                       class="text-blue-600 hover:underline">
                        {{ $ad->category->name }}
                    </a>
                </span>
            @endif
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            {{-- SIDEBAR KATEGORIJE --}}
            <aside class="md:col-span-1">
                <div class="bg-white shadow-sm rounded-lg p-4">
                    <h2 class="text-sm font-semibold text-gray-700 mb-3">
                        Kategorije
                    </h2>

                    <a href="{{ route('front.ads.index') }}"
                       class="inline-block mb-3 text-xs text-blue-600 hover:underline">
                        Reset kategorija
                    </a>

                    @if(isset($categories) && $categories->count())
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

            {{-- GLAVNI SADRŽAJ – SINGLE OGLAS --}}
            <main class="md:col-span-3">
                <div class="bg-white shadow-sm rounded-lg p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Slika --}}
                        <div>
                            <div class="w-full aspect-video bg-gray-100 rounded-lg overflow-hidden flex items-center justify-center">
                                @if($ad->image)
                                    <img src="{{ asset('storage/' . $ad->image) }}"
                                         alt="{{ $ad->title }}"
                                         class="w-full h-full object-cover">
                                @else
                                    <span class="text-xs text-gray-400">Nema slike</span>
                                @endif
                            </div>
                        </div>

                        {{-- Detalji --}}
                        <div class="flex flex-col">
                            <h1 class="text-2xl font-semibold text-gray-900 mb-2">
                                {{ $ad->title }}
                            </h1>

                            <div class="text-2xl font-bold text-blue-600 mb-3">
                                {{ number_format($ad->price, 2, ',', '.') }} RSD
                            </div>

                            <div class="flex flex-wrap gap-2 mb-4 text-xs">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full bg-blue-50 text-blue-700 font-medium">
                                    {{ $ad->condition === 'novo' ? 'Novo' : 'Polovno' }}
                                </span>

                                @if($ad->location)
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full bg-gray-100 text-gray-700">
                                        Lokacija: {{ $ad->location }}
                                    </span>
                                @endif

                                @if($ad->category)
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full bg-gray-100 text-gray-700">
                                        {{ $ad->category->name }}
                                    </span>
                                @endif
                            </div>

                            <div class="mb-4">
                                <h2 class="text-sm font-semibold text-gray-800 mb-1">Opis</h2>
                                <p class="text-sm text-gray-700 leading-relaxed">
                                    {{ $ad->description }}
                                </p>
                            </div>

                            <div class="mt-auto border-t pt-4">
                                <h2 class="text-sm font-semibold text-gray-800 mb-1">
                                    Kontakt
                                </h2>
                                <dl class="text-sm text-gray-700 space-y-1">
                                    @if($ad->user)
                                        <div>
                                            <dt class="inline font-semibold">Objavio:</dt>
                                            <dd class="inline"> {{ $ad->user->name }}</dd>
                                        </div>
                                    @endif

                                    <div>
                                        <dt class="inline font-semibold">Telefon:</dt>
                                        <dd class="inline"> {{ $ad->phone }}</dd>
                                    </div>

                                    <div>
                                        <dt class="inline font-semibold">Objavljeno:</dt>
                                        <dd class="inline">
                                            {{ $ad->created_at?->format('d.m.Y H:i') }}
                                        </dd>
                                    </div>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</x-guest-layout>
