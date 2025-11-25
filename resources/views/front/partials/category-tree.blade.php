@php
    // level = dubina u stablu (0 = root)
    $level = $level ?? 0;
@endphp

<ul class="{{ $level === 0 ? 'space-y-1 text-sm' : 'ml-4 border-l border-gray-200 pl-3 space-y-1 text-sm' }}">
    @foreach($categories as $category)
        @php
            $hasChildren = $category->children && $category->children->count();
            $isActive = isset($currentCategory) && $currentCategory && $currentCategory->id === $category->id;
        @endphp

        <li>
            @if($hasChildren)
                <details class="group" {{ $isActive ? 'open' : '' }}>
                    <summary class="flex items-center justify-between cursor-pointer py-1">
                        <a href="{{ route('front.ads.category', $category) }}"
                           class="{{ $isActive ? 'font-semibold text-blue-600' : 'text-gray-700 group-hover:text-blue-600' }}">
                            {{ $category->name }}
                        </a>
                        <span class="text-xs text-gray-500 group-open:hidden">+</span>
                        <span class="text-xs text-gray-500 hidden group-open:inline">−</span>
                    </summary>

                    @include('front.partials.category-tree', [
                        'categories'      => $category->children,
                        'currentCategory' => $currentCategory ?? null,
                        'level'           => $level + 1,
                    ])
                </details>
            @else
                <a href="{{ route('front.ads.category', $category) }}"
                   class="block py-1 {{ $isActive ? 'font-semibold text-blue-600' : 'text-gray-700 hover:text-blue-600' }}">
                    {{ $category->name }}
                </a>
            @endif
        </li>
    @endforeach
</ul>
