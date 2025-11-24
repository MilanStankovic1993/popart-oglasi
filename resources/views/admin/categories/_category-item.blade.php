@php
    $hasChildren = $category->children && $category->children->count();
@endphp

<li x-data="{ open: {{ $level === 0 ? 'false' : 'true' }} }" class="mb-1">

    <div class="flex items-center justify-between py-1">

        <div class="flex items-center space-x-2">
            @if($hasChildren)
                <button type="button"
                        @click="open = !open"
                        class="w-5 h-5 flex items-center justify-center border rounded text-xs focus:outline-none">
                    <span x-show="!open" x-cloak>+</span>
                    <span x-show="open" x-cloak>-</span>
                </button>
            @else
                <span class="w-5 h-5 inline-block"></span>
            @endif

            <span class="text-sm {{ $level === 0 ? 'font-semibold' : '' }}">
                {{ $category->name }}
            </span>
        </div>

        <div class="space-x-2 text-sm">
            <a href="{{ route('admin.categories.edit', $category) }}"
               class="text-indigo-600 hover:underline">
                Izmeni
            </a>

            <form action="{{ route('admin.categories.destroy', $category) }}"
                  method="POST"
                  class="inline-block"
                  onsubmit="return confirm('Da li ste sigurni da želite da obrišete ovu kategoriju?')">
                @csrf
                @method('DELETE')
                <button class="px-2 py-1 bg-red-600 hover:bg-red-700 text-white rounded">
                    Obriši
                </button>
            </form>
        </div>
    </div>

    @if($hasChildren)
        <ul class="ml-8 mt-1 space-y-1 border-l pl-3"
            x-show="open"
            x-transition
            x-cloak>
            @foreach($category->children as $child)
                @include('admin.categories._category-item', ['category' => $child, 'level' => $level + 1])
            @endforeach
        </ul>
    @endif
</li>
