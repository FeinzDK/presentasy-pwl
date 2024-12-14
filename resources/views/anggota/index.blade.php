<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Daftar anggota') }}
        </h2>
    </x-slot>

    <div class="container mx-auto mt-6 px-4">
        <div class="overflow-x-auto">
            <table class="table-auto border-collapse border border-gray-200 w-full text-left text-gray-800 dark:text-gray-200 bg-gray-800 dark:bg-gray-700">
                <thead>
                    <tr class="bg-gray-700 text-gray-200 dark:bg-gray-600">
                        <th class="px-4 py-2 border border-gray-500">#</th>
                        <th class="px-4 py-2 border border-gray-500">Nama</th>
                        <th class="px-4 py-2 border border-gray-500">Email</th>
                        <th class="px-4 py-2 border border-gray-500">Dibuat Pada</th>
                        <th class="px-4 py-2 border border-gray-500">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($anggota as $index => $usr) <!-- Ensure this is the correct variable -->
                     <tr class="{{ $index % 2 == 0 ? 'bg-gray-800' : 'bg-gray-700' }} hover:bg-gray-600">
                         <td class="px-4 py-2 border border-gray-500 text-center">{{ $loop->iteration }}</td>
                         <td class="px-4 py-2 border border-gray-500">{{ $usr->name }}</td>
                         <td class="px-4 py-2 border border-gray-500">{{ $usr->email }}</td>
                         <td class="px-4 py-2 border border-gray-500">{{ $usr->created_at->format('Y-m-d H:i:s') }}</td>
                         <td class="px-4 py-2 border border-gray-500 text-center">
                            <x-danger-button 
                                x-data="{ action: '{{ route('anggota.destroy', $usr->id) }}' }"
                                x-on:click.prevent="$dispatch('open-modal', 'confirm-anggota-deletion')">
                                {{ __('delete') }}
                            </x-danger-button>
                         </td>
                     </tr>
                 @endforeach
                </tbody>
            </table>

            <x-modal name="confirm-anggota-deletion" focusable maxWidth="xl">
                <form method="post" x-bind:action="action" class="p-6">
                    @method('delete')
                    @csrf
                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        {{ __('Apakah anda yakin akan menghapus data?') }}
                    </h2>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        {{ __('Setelah proses dilaksanakan. Data akan dihilangkan secara permanen.') }}
                    </p>
                    <div class="mt-6 flex justify-end">
                        <x-secondary-button x-on:click="$dispatch('close')">
                            {{ __('Cancel') }}
                        </x-secondary-button>
                        <x-danger-button class="ml-3">
                            {{ __('Delete!!!') }}
                        </x-danger-button>
                    </div>
                </form>
            </x-modal>
        </div>

        <div class="mt-4">
            {{ $anggota->links() }}
        </div>
    </div>
</x-app-layout>
