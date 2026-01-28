<!-- Main Content -->
<div class="flex-1 flex flex-col min-h-screen pt-4 relative z-10">
  <div class="flex-1">
    <div class="p-4 md:p-6 lg:p-8">

      <!-- Header -->
      <div class="flex justify-between items-center mb-6">
        <div>
          <h1 class="text-3xl font-bold text-gray-800">Manajemen Periode Seleksi</h1>
          <p class="text-gray-600 mt-1">Kelola periode penerimaan siswa baru</p>
        </div>
        <button onclick="showAddPeriodeForm()"
          class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-lg flex items-center gap-2 shadow-md">
          <i class="fas fa-plus"></i> Tambah Periode
        </button>
      </div>

      <!-- Form Tambah Periode -->
      <div id="addPeriodeForm" class="hidden mb-6 bg-blue-50 border border-blue-200 rounded-lg p-6">
        <h3 class="text-lg font-semibold mb-4 text-blue-900">
          <i class="fas fa-plus-circle mr-2"></i>Tambah Periode Baru
        </h3>

        <form action="{{ route('admin.periode.store') }}" method="POST">
          @csrf
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            <div>
              <label class="text-sm font-medium text-gray-700">Nama Periode *</label>
              <input type="text" name="nama_periode" required
                class="w-full border rounded-lg px-4 py-2">
            </div>

            <div>
              <label class="text-sm font-medium text-gray-700">Kuota *</label>
              <input type="number" name="kuota" min="1" required
                class="w-full border rounded-lg px-4 py-2">
            </div>

            <div>
              <label class="text-sm font-medium text-gray-700">Tanggal Mulai *</label>
              <input type="date" name="tanggal_mulai" required
                class="w-full border rounded-lg px-4 py-2">
            </div>

            <div>
              <label class="text-sm font-medium text-gray-700">Tanggal Selesai *</label>
              <input type="date" name="tanggal_selesai" required
                class="w-full border rounded-lg px-4 py-2">
            </div>

            <div>
              <label class="text-sm font-medium text-gray-700">Batas Lulus *</label>
              <input type="number" name="batas_lulus" min="0" max="100" step="0.01" value="80" required
                class="w-full border rounded-lg px-4 py-2">
            </div>

            <div>
              <label class="text-sm font-medium text-gray-700">Status *</label>
              <select name="status" required class="w-full border rounded-lg px-4 py-2">
                <option value="draft">Draft</option>
                <option value="aktif">Aktif</option>
                <option value="selesai">Selesai</option>
              </select>
            </div>
          </div>

          <div class="mt-4">
            <label class="text-sm font-medium text-gray-700">Keterangan</label>
            <textarea name="keterangan" rows="3"
              class="w-full border rounded-lg px-4 py-2"></textarea>
          </div>

          <div class="flex justify-end gap-2 mt-4">
            <button type="button" onclick="hideAddPeriodeForm()"
              class="bg-gray-300 px-6 py-2 rounded-lg">Batal</button>
            <button type="submit"
              class="bg-blue-500 text-white px-6 py-2 rounded-lg">Simpan</button>
          </div>
        </form>
      </div>

      <!-- Tabel Periode -->
      <div class="bg-white rounded-lg border overflow-hidden">
        <div class="overflow-x-auto">
          <table class="min-w-full divide-y divide-gray-200">

            <!-- THEAD (JUDUL KOLOM SAJA) -->
            <thead class="bg-gray-50">
              <tr>
                <th class="px-4 py-3 text-left text-xs font-semibold">No</th>
                <th class="px-4 py-3 text-left text-xs font-semibold">Nama</th>
                <th class="px-4 py-3 text-center text-xs font-semibold">Tanggal</th>
                <th class="px-4 py-3 text-center text-xs font-semibold">Kuota</th>
                <th class="px-4 py-3 text-center text-xs font-semibold">Batas</th>
                <th class="px-4 py-3 text-center text-xs font-semibold">Status</th>
                <th class="px-4 py-3 text-center text-xs font-semibold">Peserta</th>
                <th class="px-4 py-3 text-center text-xs font-semibold">Aksi</th>
              </tr>
            </thead>

            <!-- TBODY -->
            <tbody class="divide-y divide-gray-200">
              @forelse($periodes as $index => $periode)
              <tr class="hover:bg-gray-50">
                <td class="px-4 py-3">{{ $index + 1 }}</td>
                <td class="px-4 py-3 font-medium">{{ $periode->nama_periode }}</td>
                <td class="px-4 py-3 text-center">
                  {{ $periode->tanggal_mulai->format('d/m/Y') }} -
                  {{ $periode->tanggal_selesai->format('d/m/Y') }}
                </td>
                <td class="px-4 py-3 text-center">{{ $periode->kuota }}</td>
                <td class="px-4 py-3 text-center">{{ $periode->batas_lulus }}</td>

                <td class="px-4 py-3 text-center">
                  <span class="px-2 py-1 rounded-full text-xs
                    {{ $periode->status === 'aktif' ? 'bg-green-100 text-green-800' :
                       ($periode->status === 'selesai' ? 'bg-gray-100 text-gray-800' :
                       'bg-yellow-100 text-yellow-800') }}">
                   {{ ucfirst($periode->getStatusReal()) }}
                  </span>
                </td>

                <td class="px-4 py-3 text-center">
                  {{ $periode->jumlahPeserta() }}
                </td>

                <!-- AKSI -->
                <td class="px-4 py-3 text-center space-x-2">

                  @if($periode->status !== 'aktif')
                  <form action="{{ route('admin.periode.activate', $periode->id) }}" method="POST" class="inline">
                    @csrf
                    <button onclick="return confirm('Aktifkan periode ini?')"
                      class="text-green-600">
                      <i class="fas fa-check-circle"></i>
                    </button>
                  </form>
                  @endif

                  <button class="text-blue-600">
                    <i class="fas fa-edit"></i>
                  </button>

                  <form action="{{ route('admin.periode.destroy', $periode->id) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button onclick="return confirm('Hapus periode ini?')"
                      class="text-red-600">
                      <i class="fas fa-trash"></i>
                    </button>
                  </form>

                </td>
              </tr>

              @empty
              <tr>
                <td colspan="8" class="text-center py-8 text-gray-500">
                  Belum ada periode
                </td>
              </tr>
              @endforelse
            </tbody>

          </table>
        </div>
      </div>

    </div>
  </div>
</div>


<script>
function showAddPeriodeForm() {
    document.getElementById('addPeriodeForm').classList.remove('hidden');
}

function hideAddPeriodeForm() {
    document.getElementById('addPeriodeForm').classList.add('hidden');
}

function showAddPeriodeForm() {
    const el = document.getElementById('addPeriodeForm');
    el.classList.remove('hidden');
    el.scrollIntoView({ behavior: 'smooth' });
}

</script>
