
<div class="flex-1 flex flex-col min-h-screen pt-4">
<div class="p-6">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
      <div>
        <h1 class="text-3xl font-bold text-gray-800">Seleksi Pendaftar</h1>
        <p class="text-gray-600 mt-1">Kelola hasil seleksi siswa baru</p>
      </div>
    </div>

    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4">
      {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4">
      {{ session('error') }}
    </div>
    @endif

    @if($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4">
      <ul class="list-disc list-inside">
        @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
    @endif

    <!-- Informasi Periode Aktif -->
    <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl shadow-lg p-6 mb-6 text-white">
      <div class="flex items-center justify-between">
        <div>
          <h2 class="text-xl font-semibold mb-2">Periode Aktif</h2>
          <p class="text-blue-100 text-lg">{{ $periodeAktif->nama_periode ?? 'Tidak ada periode aktif' }}</p>
          @if($periodeAktif)
          <div class="flex gap-4 mt-3 text-sm">
            <div>
              <i class="fas fa-calendar-check mr-2"></i>
              {{ $periodeAktif->tanggal_mulai->format('d/m/Y') }} - {{ $periodeAktif->tanggal_selesai->format('d/m/Y') }}
            </div>
            <div>
              <i class="fas fa-users mr-2"></i>
              Kuota: {{ $periodeAktif->kuota }}
            </div>
            <div>
              <i class="fas fa-graduation-cap mr-2"></i>
              Batas Lulus: {{ $periodeAktif->batas_lulus }}
            </div>
          </div>
          @endif
        </div>
        @if($periodeAktif)
        <div class="text-right">
          <div class="text-3xl font-bold">{{ $periodeAktif->jumlahPeserta() }}</div>
          <div class="text-blue-100">Total Pendaftar</div>
        </div>
        @endif
      </div>
    </div>

   <!-- Kontrol Seleksi -->
<div class="bg-white rounded-xl shadow-sm p-6 mb-6 border">
  <h2 class="text-xl font-semibold mb-4 flex items-center gap-2">
    <i class="fas fa-cogs text-blue-500"></i>
    Kontrol Seleksi
  </h2>
  
  @if($periodeAktif)
  <form action="{{ route('admin.seleksi.proses') }}" method="POST" class="flex flex-wrap gap-4 items-end">
    @csrf
    
    <!-- ✅ INPUT HIDDEN UNTUK PERIODE_ID -->
    <input type="hidden" name="periode_id" value="{{ $periodeAktif->id }}">
    
    <div>
      <label class="block text-sm font-medium text-gray-700 mb-2">
        <i class="fas fa-trophy text-yellow-500 mr-1"></i>
        Batas Nilai Lulus
      </label>
      <input type="number" name="batas_lulus" 
             value="{{ $periodeAktif->batas_lulus }}" 
             min="0" max="100" step="0.01" 
             class="border border-gray-300 rounded-lg px-4 py-2 w-32 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
             required>
    </div>
    
    <div>
      <label class="block text-sm font-medium text-gray-700 mb-2">
        <i class="fas fa-users text-green-500 mr-1"></i>
        Kuota Siswa
      </label>
      <input type="number" name="kuota" 
             value="{{ $periodeAktif->kuota }}" 
             min="1" 
             class="border border-gray-300 rounded-lg px-4 py-2 w-32 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
             required>
    </div>
    
    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg transition duration-200 shadow-md hover:shadow-lg">
      <i class="fas fa-robot mr-2"></i>Proses Otomatis
    </button>
    
    <a href="{{ route('admin.seleksi.pdf', ['periode_id' => $periodeAktif->id]) }}" 
       target="_blank"
       class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded-lg transition duration-200 shadow-md hover:shadow-lg inline-block text-center">
      <i class="fas fa-file-pdf mr-2"></i>Export PDF
    </a>
    
    <button type="button" onclick="confirmReset({{ $periodeAktif->id }})" 
            class="bg-red-500 hover:bg-red-600 text-white px-6 py-2 rounded-lg transition duration-200 shadow-md hover:shadow-lg">
      <i class="fas fa-redo mr-2"></i>Reset Seleksi
    </button>
  </form>
  @else
  <div class="text-center text-gray-500 py-4">
    <i class="fas fa-exclamation-triangle text-3xl mb-2"></i>
    <p>Tidak ada periode aktif. Silakan aktifkan periode terlebih dahulu.</p>
  </div>
  @endif
</div>

    <!-- Statistik -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
      @php
        $totalPendaftar = $pendaftar->count();
        $lulus = $pendaftar->where('status_seleksi', 'Lulus')->count();
        $tidakLulus = $pendaftar->where('status_seleksi', 'Tidak Lulus')->count();
        $belumDiproses = $pendaftar->where('status_seleksi', 'Belum Diseleksi')->count();
      @endphp
      
      <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-lg shadow-md p-6 border border-gray-200">
        <div class="flex items-center justify-between">
          <div>
            <div class="text-sm text-gray-600 mb-1">Total Pendaftar</div>
            <div class="text-3xl font-bold text-gray-800">{{ $totalPendaftar }}</div>
          </div>
          <div class="bg-gray-200 rounded-full p-4">
            <i class="fas fa-users text-2xl text-gray-600"></i>
          </div>
        </div>
      </div>
      
      <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-lg shadow-md p-6 border border-green-200">
        <div class="flex items-center justify-between">
          <div>
            <div class="text-sm text-green-600 mb-1">Lulus</div>
            <div class="text-3xl font-bold text-green-700">{{ $lulus }}</div>
          </div>
          <div class="bg-green-200 rounded-full p-4">
            <i class="fas fa-check-circle text-2xl text-green-600"></i>
          </div>
        </div>
      </div>
      
      <div class="bg-gradient-to-br from-red-50 to-red-100 rounded-lg shadow-md p-6 border border-red-200">
        <div class="flex items-center justify-between">
          <div>
            <div class="text-sm text-red-600 mb-1">Tidak Lulus</div>
            <div class="text-3xl font-bold text-red-700">{{ $tidakLulus }}</div>
          </div>
          <div class="bg-red-200 rounded-full p-4">
            <i class="fas fa-times-circle text-2xl text-red-600"></i>
          </div>
        </div>
      </div>
      
      <div class="bg-gradient-to-br from-yellow-50 to-yellow-100 rounded-lg shadow-md p-6 border border-yellow-200">
        <div class="flex items-center justify-between">
          <div>
            <div class="text-sm text-yellow-600 mb-1">Belum Diproses</div>
            <div class="text-3xl font-bold text-yellow-700">{{ $belumDiproses }}</div>
          </div>
          <div class="bg-yellow-200 rounded-full p-4">
            <i class="fas fa-clock text-2xl text-yellow-600"></i>
          </div>
        </div>
      </div>
    </div>

      <!-- Tabel Data -->
    <div class="bg-white rounded-xl shadow-sm overflow-hidden border">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase">No</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Nama</th>
                        <th class="px-4 py-3 text-center text-xs font-semibold text-gray-700 uppercase">NISN</th>
                        <th class="px-4 py-3 text-center text-xs font-semibold text-gray-700 uppercase">Rata-rata</th>
                        <th class="px-4 py-3 text-center text-xs font-semibold text-gray-700 uppercase">Poin Prestasi</th>
                        <th class="px-4 py-3 text-center text-xs font-semibold text-gray-700 uppercase">Nilai Total</th>
                        <th class="px-4 py-3 text-center text-xs font-semibold text-gray-700 uppercase">Status</th>
                        <th class="px-4 py-3 text-center text-xs font-semibold text-gray-700 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($pendaftar as $index => $user)
                    @php
                        $avg = round(($user->nilai_smt1 + $user->nilai_smt2 + $user->nilai_smt3 + $user->nilai_smt4 + $user->nilai_smt5)/5, 2);
                        
                        // Hitung poin prestasi
                        $poinPrestasi = 0;
                        foreach($user->prestasis as $p) {
                            $poinPrestasi += match(strtolower($p->tingkat)) {
                                'internasional' => 10,
                                'nasional' => 7,
                                'provinsi' => 5,
                                'kota', 'kabupaten' => 3,
                                'sekolah' => 1,
                                default => 0,
                            };
                        }
                        
                        $nilaiTotal = $avg + $poinPrestasi;
                    @endphp
                    <tr class="hover:bg-gray-50 transition duration-150">
                        <td class="px-4 py-3 text-sm font-semibold">{{ $index + 1 }}</td>
                        <td class="px-4 py-3 text-sm">
                            <div class="font-medium text-gray-900">{{ $user->nama_pendaftar ?? '-' }}</div>
                            <div class="text-xs text-gray-500">{{ $user->email ?? '-' }}</div>
                        </td>
                        <td class="px-4 py-3 text-sm text-center font-mono">{{ $user->nisn_pendaftar ?? '-' }}</td>
                        <td class="px-4 py-3 text-sm text-center">
                            <span class="font-semibold text-blue-600">{{ $avg }}</span>
                        </td>
                        <td class="px-4 py-3 text-sm text-center">
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                +{{ $poinPrestasi }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-sm text-center">
                            <span class="text-lg font-bold text-indigo-600">{{ $nilaiTotal }}</span>
                        </td>
                        <td class="px-4 py-3 text-center">
                            @php
  $status = optional($user->seleksi)->status ?? 'Belum Diseleksi';
@endphp

<span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
    {{ $status === 'Lulus' ? 'bg-green-100 text-green-800' : 
       ($status === 'Tidak Lulus' ? 'bg-red-100 text-red-800' : 
       'bg-gray-100 text-gray-800') }}">
    
    @if($status === 'Lulus')
        <i class="fas fa-check-circle mr-1"></i>
    @elseif($status === 'Tidak Lulus')
        <i class="fas fa-times-circle mr-1"></i>
    @else
        <i class="fas fa-clock mr-1"></i>
    @endif
    
    {{ $status }}
</span>

                        </td>
                        <td class="px-4 py-3 text-center">
                            <button onclick="openStatusModal({{ $user->id }}, '{{ $user->nama_pendaftar }}', '{{ $user->status_seleksi }}')" 
                                    class="bg-indigo-500 hover:bg-indigo-600 text-white px-3 py-1 rounded text-xs transition duration-200">
                                <i class="fas fa-edit"></i> Ubah Status
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="px-4 py-12 text-center text-gray-500">
                            <i class="fas fa-inbox text-5xl mb-4 text-gray-300"></i>
                            <p class="text-lg font-medium">Belum ada pendaftar</p>
                            <p class="text-sm mt-1">Pendaftar akan muncul di sini setelah mendaftar</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>

<!-- Modal Ubah Status - FIXED VERSION -->
<div id="statusModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
  <div class="bg-white rounded-lg p-6 w-96 max-w-full mx-4">
    <h3 class="text-xl font-bold mb-4">Ubah Status Seleksi</h3>
    
    <!-- ✅ FORM DENGAN METHOD POST + @method('PUT') -->
    <form id="statusForm" method="POST">
      @csrf
      <input type="hidden" name="_method" value="PUT" id="formMethod">
      
      @if($periodeAktif)
      <input type="hidden" name="periode_id" value="{{ $periodeAktif->id }}">
      @endif
      
      <div class="mb-4">
        <label class="block text-sm font-medium mb-2">Nama Pendaftar</label>
        <input type="text" id="modalNama" readonly class="w-full border rounded px-3 py-2 bg-gray-100">
      </div>
      
      <div class="mb-4">
        <label class="block text-sm font-medium mb-2">Status <span class="text-red-500">*</span></label>
        <select name="status" id="modalStatus" class="w-full border rounded px-3 py-2" required>
          <option value="">-- Pilih Status --</option>
          <option value="Lulus">Lulus</option>
          <option value="Tidak Lulus">Tidak Lulus</option>
          <option value="Dipertimbangkan">Dipertimbangkan</option>
        </select>
      </div>
      
      <div class="mb-4">
        <label class="block text-sm font-medium mb-2">Catatan (Opsional)</label>
        <textarea name="catatan" id="modalCatatan" rows="3" class="w-full border rounded px-3 py-2" placeholder="Tambahkan catatan jika diperlukan..."></textarea>
      </div>
      
      <div class="flex gap-2">
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
          <i class="fas fa-save mr-1"></i> Simpan
        </button>
        <button type="button" onclick="closeStatusModal()" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition">
          <i class="fas fa-times mr-1"></i> Batal
        </button>
      </div>
    </form>
  </div>
</div>

</document_content>