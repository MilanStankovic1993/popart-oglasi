<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Novi customer') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    {{-- DEBUG: FORMA ZA NOVOG CUSTOMER-A --}}
                    <form method="POST" action="{{ route('admin.customers.store') }}">
                        @csrf

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Ime
                            </label>
                            <input type="text" name="name" value="{{ old('name') }}"
                                   class="mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-700 dark:bg-gray-900">
                            @error('name')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Email
                            </label>
                            <input type="email" name="email" value="{{ old('email') }}"
                                   class="mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-700 dark:bg-gray-900">
                            @error('email')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Lozinka
                            </label>
                            <input type="password" name="password"
                                   class="mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-700 dark:bg-gray-900">
                            @error('password')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- DEBUG: BUTTONS --}}
                        <div class="flex items-center justify-between mt-6">
                            <a href="{{ route('admin.customers.index') }}"
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
