<!-- ================= MAIN CONTENT ================= -->
<div class="flex-1 flex flex-col min-h-0 pt-4">
  <div class="p-4 md:p-6">

    <!-- HEADER -->
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 mb-6">
      <div>
        <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Manajemen Periode Seleksi</h1>
        <p class="text-gray-600 text-sm mt-0.5">Kelola periode penerimaan siswa baru</p>
      </div>
      <button
        type="button"
        id="btnTambahPeriode"
        class="bg-blue-600 text-white px-5 py-2.5 rounded-lg shadow hover:bg-blue-700 transition-colors text-sm font-medium inline-flex items-center justify-center gap-2 w-full sm:w-auto">
        <i class="fas fa-plus"></i> Tambah Periode
      </button>
    </div>

    <!-- ================= FORM TAMBAH ================= -->
    <div id="addFormPeriode" class="hidden bg-blue-50/80 border border-blue-100 rounded-xl p-4 md:p-6 mb-6 shadow-sm">
      <form id="formTambahPeriode" method="POST" action="{{ route('admin.periode.store') }}">
        @csrf
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <div>
            <label for="add_nama_periode" class="block text-sm font-medium text-gray-700 mb-1">Nama Periode <span class="text-red-500">*</span></label>
            <input id="add_nama_periode" name="nama_periode" value="{{ old('nama_periode') }}" placeholder="Contoh: PPDB 2025/2026"
              class="border border-gray-300 rounded-lg p-2.5 w-full focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('nama_periode') border-red-500 @enderror">
            @error('nama_periode') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
          </div>
          <div>
            <label for="add_kuota" class="block text-sm font-medium text-gray-700 mb-1">Kuota <span class="text-red-500">*</span></label>
            <input id="add_kuota" name="kuota" type="number" min="1" value="{{ old('kuota') }}" placeholder="Jumlah kuota"
              class="border border-gray-300 rounded-lg p-2.5 w-full focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('kuota') border-red-500 @enderror">
            @error('kuota') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
          </div>
          <div>
            <label for="add_tanggal_mulai" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Mulai <span class="text-red-500">*</span></label>
            <input id="add_tanggal_mulai" name="tanggal_mulai" type="date" value="{{ old('tanggal_mulai') }}"
              class="border border-gray-300 rounded-lg p-2.5 w-full focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('tanggal_mulai') border-red-500 @enderror">
            @error('tanggal_mulai') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
          </div>
          <div>
            <label for="add_tanggal_selesai" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Selesai <span class="text-red-500">*</span></label>
            <input id="add_tanggal_selesai" name="tanggal_selesai" type="date" value="{{ old('tanggal_selesai') }}"
              class="border border-gray-300 rounded-lg p-2.5 w-full focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('tanggal_selesai') border-red-500 @enderror">
            @error('tanggal_selesai') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
          </div>
          <div>
            <label for="add_batas_lulus" class="block text-sm font-medium text-gray-700 mb-1">Batas Nilai Lulus (0–100) <span class="text-red-500">*</span></label>
            <input id="add_batas_lulus" name="batas_lulus" type="number" step="0.01" min="0" max="100" value="{{ old('batas_lulus') }}" placeholder="Contoh: 70"
              class="border border-gray-300 rounded-lg p-2.5 w-full focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('batas_lulus') border-red-500 @enderror">
            @error('batas_lulus') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
          </div>
          <div>
            <label for="add_status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
            <select id="add_status" name="status" class="border border-gray-300 rounded-lg p-2.5 w-full focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
              <option value="draft" {{ old('status', 'draft') == 'draft' ? 'selected' : '' }}>Draft</option>
              <option value="aktif" {{ old('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
              <option value="selesai" {{ old('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
            </select>
          </div>
        </div>
        <div class="mt-4">
          <label for="add_keterangan" class="block text-sm font-medium text-gray-700 mb-1">Keterangan</label>
          <textarea id="add_keterangan" name="keterangan" rows="2" placeholder="Opsional"
            class="border border-gray-300 rounded-lg p-2.5 w-full focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('keterangan') }}</textarea>
        </div>
        <div class="flex flex-wrap justify-end gap-2 mt-4">
          <button type="button" onclick="closeAddForm()" class="px-4 py-2.5 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors font-medium">
            Batal
          </button>
          <button type="submit" id="btnSubmitTambah" class="px-4 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-medium inline-flex items-center gap-2">
            <span class="btn-text">Simpan</span>
            <span class="btn-loading hidden"><i class="fas fa-spinner fa-spin"></i> Menyimpan...</span>
          </button>
        </div>
      </form>
    </div>

    <!-- ================= TABEL ================= -->
    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm">
      @if($periodes->isEmpty())
        <div class="p-8 md:p-12 text-center">
          <div class="inline-flex w-16 h-16 rounded-full bg-gray-100 items-center justify-center mb-4">
            <i class="fas fa-calendar-alt text-3xl text-gray-400"></i>
          </div>
          <h3 class="text-lg font-semibold text-gray-700 mb-1">Belum ada periode seleksi</h3>
          <p class="text-gray-500 text-sm mb-6 max-w-sm mx-auto">Tambahkan periode pertama untuk mengelola penerimaan siswa baru.</p>
          <button type="button" onclick="document.getElementById('btnTambahPeriode').click();"
            class="bg-blue-600 text-white px-5 py-2.5 rounded-lg hover:bg-blue-700 transition-colors text-sm font-medium inline-flex items-center gap-2">
            <i class="fas fa-plus"></i> Tambah Periode
          </button>
        </div>
      @else
        <div class="overflow-x-auto">
          <table class="w-full text-sm min-w-[600px]">
            <thead class="bg-gray-50 border-b border-gray-200">
              <tr>
                <th class="p-3 text-left font-semibold text-gray-700">No</th>
                <th class="p-3 text-left font-semibold text-gray-700">Nama</th>
                <th class="p-3 text-left font-semibold text-gray-700">Tanggal</th>
                <th class="p-3 text-center font-semibold text-gray-700">Kuota</th>
                <th class="p-3 text-center font-semibold text-gray-700">Status</th>
                <th class="p-3 text-center font-semibold text-gray-700">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach($periodes as $i => $p)
                <tr class="border-t border-gray-100 hover:bg-gray-50/50 transition-colors">
                  <td class="p-3 text-gray-600">{{ $i + 1 }}</td>
                  <td class="p-3 font-medium text-gray-800">{{ $p->nama_periode }}</td>
                  <td class="p-3 text-gray-600">
                    {{ $p->tanggal_mulai->format('d/m/Y') }} – {{ $p->tanggal_selesai->format('d/m/Y') }}
                  </td>
                  <td class="p-3 text-center">{{ number_format($p->kuota) }}</td>
                  <td class="p-3 text-center">
                    @php $statusReal = $p->getStatusReal(); @endphp
                    <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-medium
                      {{ $statusReal == 'aktif' ? 'bg-green-100 text-green-800' : ($statusReal == 'selesai' ? 'bg-gray-200 text-gray-700' : 'bg-amber-100 text-amber-800') }}">
                      {{ ucfirst($statusReal) }}
                    </span>
                  </td>
                  <td class="p-3">
                    <div class="flex flex-wrap items-center justify-center gap-1">
                      <button type="button"
                        onclick="openEditPeriodeModal(this)"
                        data-id="{{ $p->id }}"
                        data-nama="{{ e($p->nama_periode) }}"
                        data-kuota="{{ $p->kuota }}"
                        data-mulai="{{ $p->tanggal_mulai->format('Y-m-d') }}"
                        data-selesai="{{ $p->tanggal_selesai->format('Y-m-d') }}"
                        data-batas="{{ $p->batas_lulus }}"
                        data-status="{{ $p->status }}"
                        data-keterangan="{{ e($p->keterangan ?? '') }}"
                        class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors"
                        title="Edit">
                        <i class="fas fa-edit"></i>
                      </button>
                      @if($p->status != 'aktif')
                        <form method="POST" action="{{ route('admin.periode.activate', $p->id) }}" class="inline periode-action-form">
                          @csrf
                          <button type="submit" class="p-2 text-green-600 hover:bg-green-50 rounded-lg transition-colors" title="Aktifkan">
                            <i class="fas fa-check"></i>
                          </button>
                        </form>
                      @endif
                      @if($p->getStatusReal() == 'aktif')
                        <form method="POST" action="{{ route('admin.periode.close', $p->id) }}" class="inline periode-close-form">
                          @csrf
                          <button type="button" class="periode-close-btn p-2 text-amber-600 hover:bg-amber-50 rounded-lg transition-colors" title="Tutup periode">
                            <i class="fas fa-lock"></i>
                          </button>
                        </form>
                      @endif
                      <form method="POST" action="{{ route('admin.periode.destroy', $p->id) }}" class="inline periode-delete-form">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="periode-delete-btn p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Hapus">
                          <i class="fas fa-trash"></i>
                        </button>
                      </form>
                    </div>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      @endif
    </div>

  </div>
</div>

<!-- ================= MODAL EDIT (ID sesuai dashboard: editPeriodeModal / editPeriodeForm) ================= -->
<div id="editPeriodeModal" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50 p-4">
  <div class="bg-white rounded-xl shadow-xl w-full max-w-lg max-h-[90vh] overflow-y-auto">
    <div class="p-6">
      <h3 class="text-xl font-bold text-gray-800 mb-4">Edit Periode</h3>
      <form id="editPeriodeForm" method="POST">
        @csrf
        @method('PUT')
        <div class="space-y-3">
          <div>
            <label for="edit_nama" class="block text-sm font-medium text-gray-700 mb-1">Nama Periode</label>
            <input id="edit_nama" name="nama_periode" class="border border-gray-300 rounded-lg p-2.5 w-full focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
          </div>
          <div>
            <label for="edit_kuota" class="block text-sm font-medium text-gray-700 mb-1">Kuota</label>
            <input id="edit_kuota" name="kuota" type="number" min="1" class="border border-gray-300 rounded-lg p-2.5 w-full focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
          </div>
          <div class="grid grid-cols-2 gap-3">
            <div>
              <label for="edit_mulai" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Mulai</label>
              <input id="edit_mulai" name="tanggal_mulai" type="date" class="border border-gray-300 rounded-lg p-2.5 w-full focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div>
              <label for="edit_selesai" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Selesai</label>
              <input id="edit_selesai" name="tanggal_selesai" type="date" class="border border-gray-300 rounded-lg p-2.5 w-full focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>
          </div>
          <div>
            <label for="edit_batas" class="block text-sm font-medium text-gray-700 mb-1">Batas Nilai Lulus (0–100)</label>
            <input id="edit_batas" name="batas_lulus" type="number" step="0.01" min="0" max="100" class="border border-gray-300 rounded-lg p-2.5 w-full focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
          </div>
          <div>
            <label for="edit_status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
            <select id="edit_status" name="status" class="border border-gray-300 rounded-lg p-2.5 w-full focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
              <option value="draft">Draft</option>
              <option value="aktif">Aktif</option>
              <option value="selesai">Selesai</option>
            </select>
          </div>
          <div>
            <label for="edit_keterangan" class="block text-sm font-medium text-gray-700 mb-1">Keterangan</label>
            <textarea id="edit_keterangan" name="keterangan" rows="2" class="border border-gray-300 rounded-lg p-2.5 w-full focus:ring-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
          </div>
        </div>
        <div class="flex flex-wrap justify-end gap-2 mt-5">
          <button type="button" onclick="closeEditPeriodeModal()" class="px-4 py-2.5 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors font-medium">Batal</button>
          <button type="submit" id="btnSubmitEdit" class="px-4 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-medium inline-flex items-center gap-2">
            <span class="edit-btn-text">Update</span>
            <span class="edit-btn-loading hidden"><i class="fas fa-spinner fa-spin"></i> Memperbarui...</span>
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
(function() {
  var addForm = document.getElementById('addFormPeriode');
  var btnTambah = document.getElementById('btnTambahPeriode');
  var formTambah = document.getElementById('formTambahPeriode');
  var btnSubmitTambah = document.getElementById('btnSubmitTambah');

  function closeAddForm() {
    if (addForm) {
      addForm.classList.add('hidden');
    }
  }

  if (btnTambah && addForm) {
    btnTambah.addEventListener('click', function() {
      addForm.classList.toggle('hidden');
    });
  }

  if (formTambah && btnSubmitTambah) {
    formTambah.addEventListener('submit', function() {
      var loading = btnSubmitTambah.querySelector('.btn-loading');
      var text = btnSubmitTambah.querySelector('.btn-text');
      if (loading && text) {
        text.classList.add('hidden');
        loading.classList.remove('hidden');
        btnSubmitTambah.disabled = true;
      }
    });
  }

  window.closeAddForm = closeAddForm;

  var editForm = document.getElementById('editPeriodeForm');
  var btnSubmitEdit = document.getElementById('btnSubmitEdit');
  if (editForm && btnSubmitEdit) {
    editForm.addEventListener('submit', function() {
      var loading = btnSubmitEdit.querySelector('.edit-btn-loading');
      var text = btnSubmitEdit.querySelector('.edit-btn-text');
      if (loading && text) {
        text.classList.add('hidden');
        loading.classList.remove('hidden');
        btnSubmitEdit.disabled = true;
      }
    });
  }

  document.querySelectorAll('.periode-delete-btn').forEach(function(btn) {
    btn.addEventListener('click', function(e) {
      e.preventDefault();
      var form = this.closest('form');
      if (typeof Swal !== 'undefined') {
        Swal.fire({
          title: 'Hapus periode?',
          text: 'Data periode akan dihapus permanen. Anda tidak dapat membatalkan ini.',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#dc2626',
          cancelButtonColor: '#6b7280',
          confirmButtonText: 'Ya, hapus'
        }).then(function(result) {
          if (result.isConfirmed && form) form.submit();
        });
      } else {
        if (confirm('Hapus periode ini?')) form.submit();
      }
    });
  });

  document.querySelectorAll('.periode-close-btn').forEach(function(btn) {
    btn.addEventListener('click', function(e) {
      e.preventDefault();
      var form = this.closest('form');
      if (typeof Swal !== 'undefined') {
        Swal.fire({
          title: 'Tutup periode?',
          text: 'Periode aktif akan ditutup. Status akan berubah menjadi Selesai.',
          icon: 'question',
          showCancelButton: true,
          confirmButtonColor: '#d97706',
          cancelButtonColor: '#6b7280',
          confirmButtonText: 'Ya, tutup'
        }).then(function(result) {
          if (result.isConfirmed && form) form.submit();
        });
      } else {
        if (confirm('Tutup periode ini sekarang?')) form.submit();
      }
    });
  });
})();
</script>
