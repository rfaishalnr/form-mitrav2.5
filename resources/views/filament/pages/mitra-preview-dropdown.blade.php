{{-- <x-filament::page>
    <div class="space-y-4">
        <h2 class="text-xl font-bold text-gray-700 dark:text-white">Pilih Data Mitra</h2>

        <form action="{{ route('mitra.preview.byid', ['id' => '']) }}" method="GET" onsubmit="event.preventDefault(); window.location.href=this.action + this.elements.id.value;">
            <div class="flex items-center gap-4">
                <select name="id" class="w-full p-2 border border-gray-300 rounded" required>
                    <option value="">-- Pilih Mitasdsadra --</option>
                    @foreach($allData as $mitra)
                        <option value="{{ $mitra->id }}">{{ $mitra->nama_mitra }} - {{ $mitra->area }}</option>
                    @endforeach
                </select>
                <button type="submit" class="px-4 py-2 bg-primary-600 text-white rounded hover:bg-primary-700">
                    Preview
                </button>
            </div>
        </form>
    </div>
</x-filament::page> --}}
