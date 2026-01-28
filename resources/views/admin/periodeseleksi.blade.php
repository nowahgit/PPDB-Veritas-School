<!-- ================= MAIN CONTENT ================= -->
<div class="flex-1 flex flex-col min-h-screen pt-4">
<div class="p-6">

<!-- HEADER -->
<div class="flex justify-between items-center mb-6">
  <div>
    <h1 class="text-3xl font-bold text-gray-800">Manajemen Periode Seleksi</h1>
    <p class="text-gray-600">Kelola periode penerimaan siswa baru</p>
  </div>
  <button onclick="openAddForm()"
    class="bg-blue-600 text-white px-6 py-3 rounded-lg shadow">
    <i class="fas fa-plus"></i> Tambah Periode
  </button>
</div>

<!-- ================= FORM TAMBAH ================= -->
<div id="addForm" class="hidden bg-blue-50 border rounded-lg p-6 mb-6">
<form method="POST" action="{{ route('admin.periode.store') }}">
@csrf

<div class="grid grid-cols-2 gap-4">
  <input name="nama_periode" placeholder="Nama Periode" class="border p-2 rounded" required>
  <input name="kuota" type="number" placeholder="Kuota" class="border p-2 rounded" required>

  <input name="tanggal_mulai" type="date" class="border p-2 rounded" required>
  <input name="tanggal_selesai" type="date" class="border p-2 rounded" required>

  <input name="batas_lulus" type="number" step="0.01" placeholder="Batas Lulus" class="border p-2 rounded" required>

  <select name="status" class="border p-2 rounded">
    <option value="draft">Draft</option>
    <option value="aktif">Aktif</option>
    <option value="selesai">Selesai</option>
  </select>
</div>

<textarea name="keterangan" class="border p-2 rounded w-full mt-4" placeholder="Keterangan"></textarea>

<div class="flex justify-end mt-4 gap-2">
  <button type="button" onclick="closeAddForm()" class="px-4 py-2 bg-gray-300 rounded">Batal</button>
  <button class="px-4 py-2 bg-blue-600 text-white rounded">Simpan</button>
</div>
</form>
</div>

<!-- ================= TABEL ================= -->
<div class="bg-white rounded-lg border overflow-x-auto">
<table class="w-full text-sm">
<thead class="bg-gray-100">
<tr>
  <th class="p-3">No</th>
  <th>Nama</th>
  <th>Tanggal</th>
  <th>Kuota</th>
  <th>Status</th>
  <th>Aksi</th>
</tr>
</thead>

<tbody>
@foreach($periodes as $i => $p)
<tr class="border-t">
  <td class="p-3">{{ $i+1 }}</td>
  <td>{{ $p->nama_periode }}</td>
  <td>
    {{ $p->tanggal_mulai->format('d/m/Y') }} -
    {{ $p->tanggal_selesai->format('d/m/Y') }}
  </td>
  <td class="text-center">{{ $p->kuota }}</td>

  <td class="text-center">
    <span class="px-2 py-1 rounded text-xs
      {{ $p->getStatusReal()=='aktif' ? 'bg-green-100 text-green-800' :
         ($p->getStatusReal()=='selesai' ? 'bg-gray-200 text-gray-800' : 'bg-yellow-100 text-yellow-800') }}">
      {{ ucfirst($p->getStatusReal()) }}
    </span>
  </td>

  <td class="text-center space-x-2">

    <!-- EDIT -->
    <button
      onclick="openEditModal(this)"
      data-id="{{ $p->id }}"
      data-nama="{{ $p->nama_periode }}"
      data-kuota="{{ $p->kuota }}"
      data-mulai="{{ $p->tanggal_mulai->format('Y-m-d') }}"
      data-selesai="{{ $p->tanggal_selesai->format('Y-m-d') }}"
      data-batas="{{ $p->batas_lulus }}"
      data-status="{{ $p->status }}"
      data-keterangan="{{ $p->keterangan }}"
      class="text-blue-600">
      <i class="fas fa-edit"></i>
    </button>

    <!-- AKTIFKAN -->
    @if($p->status != 'aktif')
    <form method="POST" action="{{ route('admin.periode.activate', $p->id) }}" class="inline">
      @csrf
      <button class="text-green-600"><i class="fas fa-check"></i></button>
    </form>
    @endif

    <!-- HAPUS -->
    <form method="POST" action="{{ route('admin.periode.destroy', $p->id) }}" class="inline">
      @csrf
      @method('DELETE')
      <button onclick="return confirm('Hapus periode ini?')" class="text-red-600">
        <i class="fas fa-trash"></i>
      </button>
    </form>

  </td>
</tr>
@endforeach
</tbody>
</table>
</div>

</div>
</div>

<!-- ================= MODAL EDIT ================= -->
<div id="editModal" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">
<div class="bg-white w-[600px] rounded-lg p-6">

<h3 class="text-xl font-bold mb-4">Edit Periode</h3>

<form id="editForm" method="POST">
@csrf
@method('PUT')

<input id="e_nama" name="nama_periode" class="border p-2 rounded w-full mb-2">
<input id="e_kuota" name="kuota" type="number" class="border p-2 rounded w-full mb-2">

<input id="e_mulai" name="tanggal_mulai" type="date" class="border p-2 rounded w-full mb-2">
<input id="e_selesai" name="tanggal_selesai" type="date" class="border p-2 rounded w-full mb-2">

<input id="e_batas" name="batas_lulus" type="number" step="0.01" class="border p-2 rounded w-full mb-2">

<select id="e_status" name="status" class="border p-2 rounded w-full mb-2">
  <option value="draft">Draft</option>
  <option value="aktif">Aktif</option>
  <option value="selesai">Selesai</option>
</select>

<textarea id="e_ket" name="keterangan" class="border p-2 rounded w-full"></textarea>

<div class="flex justify-end gap-2 mt-4">
  <button type="button" onclick="closeEditModal()" class="px-4 py-2 bg-gray-300 rounded">Batal</button>
  <button class="px-4 py-2 bg-blue-600 text-white rounded">Update</button>
</div>

</form>
</div>
</div>

<!-- ================= JS ================= -->
<script>
function openAddForm(){
  document.getElementById('addForm').classList.remove('hidden')
}
function closeAddForm(){
  document.getElementById('addForm').classList.add('hidden')
}

function openEditModal(el){
  document.getElementById('editModal').classList.remove('hidden')
  document.getElementById('editModal').classList.add('flex')

  document.getElementById('editForm').action =
    `/admin/periode/${el.dataset.id}`

  e_nama.value    = el.dataset.nama
  e_kuota.value   = el.dataset.kuota
  e_mulai.value   = el.dataset.mulai
  e_selesai.value = el.dataset.selesai
  e_batas.value   = el.dataset.batas
  e_status.value  = el.dataset.status
  e_ket.value     = el.dataset.keterangan ?? ''
}

function closeEditModal(){
  document.getElementById('editModal').classList.add('hidden')
}
</script>
