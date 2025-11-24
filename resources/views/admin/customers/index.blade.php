<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Customers') }}
            </h2>

            {{-- DEBUG: DUGME NOVI CUSTOMER --}}
            <a href="{{ route('admin.customers.create') }}"
               class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white border border-transparent rounded-md font-semibold text-xs uppercase tracking-widest">
                + Novi customer
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

            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead>
                        <tr>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                ID
                            </th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Ime
                            </th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Email
                            </th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Kreiran
                            </th>
                            <th class="px-4 py-2 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Akcije
                            </th>
                        </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse($customers as $customer)
                            <tr>
                                <td class="px-4 py-2 text-sm">{{ $customer->id }}</td>
                                <td class="px-4 py-2 text-sm">{{ $customer->name }}</td>
                                <td class="px-4 py-2 text-sm">{{ $customer->email }}</td>
                                <td class="px-4 py-2 text-sm">{{ $customer->created_at->format('d.m.Y H:i') }}</td>
                                <td class="px-4 py-2 text-sm text-right space-x-2">

                                    <a href="{{ route('admin.customers.edit', $customer) }}"
                                       class="text-indigo-600 hover:underline">
                                        Izmeni
                                    </a>

                                    <form action="{{ route('admin.customers.destroy', $customer) }}"
                                          method="POST"
                                          class="inline-block"
                                          onsubmit="return confirm('Da li ste sigurni da želite da obrišete ovog customera?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="px-2 py-1 bg-red-600 hover:bg-red-700 text-white rounded">
                                            Obriši
                                        </button>
                                    </form>

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-4 text-center text-sm text-gray-500">
                                    Nema registrovanih customera.
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $customers->links() }}
                    </div>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>
