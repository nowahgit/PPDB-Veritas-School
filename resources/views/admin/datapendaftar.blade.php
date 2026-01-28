<div class="md:ml-12 md:mr-12 md:mb-10">
  <!-- Header Section dengan Icon -->
  <div class="bg-gradient-to-r from-indigo-500 to-purple-600 rounded-2xl shadow-lg p-6 mb-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
      <div class="text-white">
        <h2 class="text-2xl sm:text-3xl font-bold mb-2 flex items-center gap-3">
          <div class="w-12 h-12 bg-white bg-opacity-20 rounded-xl flex items-center justify-center backdrop-blur-sm">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
          </div>
          Data Pendaftar
        </h2>
        <p class="text-indigo-100 text-sm">Kelola data pendaftaran siswa baru</p>
      </div>
      <button
        onclick="openAddModal()"
        class="flex items-center justify-center gap-2 bg-white text-indigo-600 px-6 py-3 rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 font-semibold hover:scale-105 transform"
      >
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        <span>Tambah Pendaftar</span>
      </button>
    </div>
  </div>

  <!-- Statistics Cards -->
  <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
    <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl p-5 text-white shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-1">
      <div class="flex items-center justify-between">
        <div>
          <p class="text-blue-100 text-sm font-medium mb-1">Total Pendaftar</p>
          <p class="text-3xl font-bold">{{ count($pendaftar) }}</p>
        </div>
        <div class="w-14 h-14 bg-white bg-opacity-20 rounded-xl flex items-center justify-center backdrop-blur-sm">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
          </svg>
        </div>
      </div>
    </div>

    <div class="bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl p-5 text-white shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-1">
      <div class="flex items-center justify-between">
        <div>
          <p class="text-green-100 text-sm font-medium mb-1">Diterima</p>
          <p class="text-3xl font-bold">{{ $pendaftar->where('status', 'approved')->count() }}</p>
        </div>
        <div class="w-14 h-14 bg-white bg-opacity-20 rounded-xl flex items-center justify-center backdrop-blur-sm">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
        </div>
      </div>
    </div>

    <div class="bg-gradient-to-br from-yellow-500 to-orange-600 rounded-xl p-5 text-white shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-1">
      <div class="flex items-center justify-between">
        <div>
          <p class="text-yellow-100 text-sm font-medium mb-1">Menunggu</p>
          <p class="text-3xl font-bold">{{ $pendaftar->where('status', 'pending')->count() + $pendaftar->whereNull('status')->count() }}</p>
        </div>
        <div class="w-14 h-14 bg-white bg-opacity-20 rounded-xl flex items-center justify-center backdrop-blur-sm">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
        </div>
      </div>
    </div>
  </div>

  <!-- Main Content Card -->
  <div class="bg-white rounded-2xl shadow-lg border border-gray-100">
    <!-- Search Bar -->
    <div class="p-6 border-b border-gray-100">
      <div class="relative">
        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
          </svg>
        </div>
        <input 
          type="text" 
          id="searchInput"
          placeholder="Cari berdasarkan nama, NISN, atau alamat..."
          class="w-full pl-12 pr-4 py-3.5 border-2 border-gray-200 rounded-xl shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all text-gray-700 placeholder-gray-400"
        >
      </div>
    </div>

    <!-- Content Section -->
    <div class="p-6">
      @if(session('success'))
        <div class="bg-green-50 border-l-4 border-green-500 text-green-800 px-5 py-4 rounded-lg mb-6 flex items-start shadow-sm">
          <svg class="w-5 h-5 mr-3 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
          </svg>
          <span class="font-medium">{{ session('success') }}</span>
        </div>
      @endif

      @if($pendaftar->isEmpty())
        <div class="text-center py-20 text-gray-500">
          <div class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-gray-100 mb-6">
            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
            </svg>
          </div>
          <p class="text-lg font-semibold text-gray-700 mb-2">Belum ada pendaftar</p>
          <p class="text-sm text-gray-500">Silakan tambahkan pendaftar baru untuk memulai</p>
        </div>
      @else
        <div class="overflow-x-auto -mx-6 md:mx-0 rounded-xl">
          <div class="inline-block min-w-full align-middle">
            <div class="overflow-hidden rounded-xl border border-gray-200">
              <table class="min-w-full divide-y divide-gray-200" id="dataTable">
                <thead class="bg-gray-50">
                  <tr>
                    <th class="px-4 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider whitespace-nowrap">No</th>
                    <th class="px-4 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider whitespace-nowrap">Username</th>
                    <th class="px-4 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider whitespace-nowrap">Nama</th>
                    <th class="px-4 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider whitespace-nowrap">NISN</th>
                    <th class="px-4 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider whitespace-nowrap">Tanggal Lahir</th>
                    <th class="px-4 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider whitespace-nowrap">Alamat</th>
                    <th class="px-4 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider whitespace-nowrap">Agama</th>
                    <th class="px-4 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider whitespace-nowrap">Nama Ortu</th>
                    <th class="px-4 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider whitespace-nowrap">Pekerjaan Ortu</th>
                    <th class="px-4 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider whitespace-nowrap">No HP Ortu</th>
                    <th class="px-4 py-4 text-center text-xs font-bold text-gray-700 uppercase tracking-wider whitespace-nowrap">SMT 1</th>
                    <th class="px-4 py-4 text-center text-xs font-bold text-gray-700 uppercase tracking-wider whitespace-nowrap">SMT 2</th>
                    <th class="px-4 py-4 text-center text-xs font-bold text-gray-700 uppercase tracking-wider whitespace-nowrap">SMT 3</th>
                    <th class="px-4 py-4 text-center text-xs font-bold text-gray-700 uppercase tracking-wider whitespace-nowrap">SMT 4</th>
                    <th class="px-4 py-4 text-center text-xs font-bold text-gray-700 uppercase tracking-wider whitespace-nowrap">SMT 5</th>
                    <th class="px-4 py-4 text-center text-xs font-bold text-gray-700 uppercase tracking-wider whitespace-nowrap">Rata-rata</th>
                    <th class="px-4 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider whitespace-nowrap">Prestasi</th>
                    <th class="px-4 py-4 text-center text-xs font-bold text-gray-700 uppercase tracking-wider whitespace-nowrap">Berkas</th>
                    <th class="px-4 py-4 text-center text-xs font-bold text-gray-700 uppercase tracking-wider whitespace-nowrap">Status</th>
                    <th class="px-4 py-4 text-center text-xs font-bold text-gray-700 uppercase tracking-wider whitespace-nowrap">Aksi</th>
                  </tr>
                </thead>
                <tbody id="tableBody" class="bg-white divide-y divide-gray-200">
                  @foreach($pendaftar as $index => $user)
                    @php
                      $avg = round(($user->nilai_smt1 + $user->nilai_smt2 + $user->nilai_smt3 + $user->nilai_smt4 + $user->nilai_smt5)/5,2);
                    @endphp
                    <tr class="hover:bg-gray-50 transition-colors data-row">
                      <td class="px-4 py-4 text-sm font-semibold text-gray-900">{{ $index +1 }}</td>
                      <td class="px-4 py-4 text-sm font-medium text-gray-900">{{ $user->username ?? '-' }}</td>
                      <td class="px-4 py-4 text-sm text-gray-700 whitespace-nowrap">{{ $user->nama_pendaftar ?? '-' }}</td>
                      <td class="px-4 py-4 text-sm text-gray-600 whitespace-nowrap">{{ $user->nisn_pendaftar ?? '-' }}</td>
                      <td class="px-4 py-4 text-sm text-gray-600 whitespace-nowrap">{{ $user->tanggallahir_pendaftar ?? '-' }}</td>
                      <td class="px-4 py-4 text-sm text-gray-600 max-w-[200px] truncate" title="{{ $user->alamat_pendaftar }}">{{ $user->alamat_pendaftar ?? '-' }}</td>
                      <td class="px-4 py-4 text-sm text-gray-600 whitespace-nowrap">{{ $user->agama ?? '-' }}</td>
                      <td class="px-4 py-4 text-sm text-gray-600 whitespace-nowrap">{{ $user->nama_ortu ?? '-' }}</td>
                      <td class="px-4 py-4 text-sm text-gray-600 whitespace-nowrap">{{ $user->pekerjaan_ortu ?? '-' }}</td>
                      <td class="px-4 py-4 text-sm text-gray-600 whitespace-nowrap">{{ $user->no_hp_ortu ?? '-' }}</td>
                      <td class="px-4 py-4 text-sm font-medium text-gray-700 text-center">{{ $user->nilai_smt1 ?? '-' }}</td>
                      <td class="px-4 py-4 text-sm font-medium text-gray-700 text-center">{{ $user->nilai_smt2 ?? '-' }}</td>
                      <td class="px-4 py-4 text-sm font-medium text-gray-700 text-center">{{ $user->nilai_smt3 ?? '-' }}</td>
                      <td class="px-4 py-4 text-sm font-medium text-gray-700 text-center">{{ $user->nilai_smt4 ?? '-' }}</td>
                      <td class="px-4 py-4 text-sm font-medium text-gray-700 text-center">{{ $user->nilai_smt5 ?? '-' }}</td>
                      <td class="px-4 py-4 text-sm font-bold text-indigo-600 text-center">{{ $avg }}</td>
                      <td class="px-4 py-4 text-sm text-gray-600 whitespace-nowrap">
                        @if($user->prestasis->count() > 0)
                          <ul class="list-disc ml-4 space-y-1">
                            @foreach($user->prestasis as $p)
                              <li class="text-xs">{{ $p->nama_kejuaraan }} <span class="text-indigo-600 font-medium">({{ $p->tingkat }})</span></li>
                            @endforeach
                          </ul>
                        @else
                          <span class="text-gray-400 text-xs italic">Tidak ada</span>
                        @endif
                      </td>
                      <td class="px-4 py-4 text-sm text-center">
                        @if($user->berkas)
                          <button onclick="showBerkas({{ $user->id }})" class="inline-flex items-center px-4 py-2 bg-indigo-500 text-white text-xs font-semibold rounded-lg hover:bg-indigo-600 transition-all shadow-sm hover:shadow-md">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            Lihat
                          </button>
                        @else
                          <span class="text-gray-400 text-xs italic">Tidak ada</span>
                        @endif
                      </td>
                      <td class="px-4 py-4 text-sm text-center">
                        <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-semibold
                          {{ $user->status === 'approved' ? 'bg-green-100 text-green-700 border border-green-200' :
                            ($user->status === 'rejected' ? 'bg-red-100 text-red-700 border border-red-200' : 'bg-yellow-100 text-yellow-700 border border-yellow-200') }}">
                          {{ ucfirst($user->status ?? 'pending') }}
                        </span>
                      </td>
                      <td class="px-4 py-4 text-sm">
                        <div class="flex gap-2 justify-center">
                          <button onclick="openEditModal({{ $user->id }})" class="bg-yellow-500 hover:bg-yellow-600 text-white p-2.5 rounded-lg shadow-sm hover:shadow-md transition-all flex items-center justify-center" title="Edit">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2v-5M16.5 3.5a2.121 2.121 0 013 3L12 14l-4 1 1-4 7.5-7.5z"/>
                            </svg>
                          </button>

                          @if(!$user->status || $user->status === 'pending')
                          <button onclick="openConfirmModal(this, '{{ route('admin.approve', $user->id) }}')" class="bg-green-500 hover:bg-green-600 text-white p-2.5 rounded-lg shadow-sm hover:shadow-md transition-all flex items-center justify-center" title="Terima">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                          </button>
                          <button onclick="openConfirmModal(this, '{{ route('admin.reject', $user->id) }}', 'DELETE')" class="bg-red-500 hover:bg-red-600 text-white p-2.5 rounded-lg shadow-sm hover:shadow-md transition-all flex items-center justify-center" title="Tolak">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                          </button>
                          @endif

                          <button onclick="openConfirmModal(this, '{{ route('admin.delete', $user->id) }}', 'DELETE')" class="bg-gray-500 hover:bg-gray-600 text-white p-2.5 rounded-lg shadow-sm hover:shadow-md transition-all flex items-center justify-center" title="Hapus">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5-4h4m-4 0a1 1 0 00-1 1v1h6V4a1 1 0 00-1-1m-4 0h4"/>
                            </svg>
                          </button>
                        </div>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <!-- Pagination -->
        <div class="mt-8 flex flex-col sm:flex-row items-center justify-between gap-4 px-2">
          <div class="text-sm text-gray-600 font-medium">
            Menampilkan <span id="showingStart" class="font-semibold text-gray-900">1</span> - <span id="showingEnd" class="font-semibold text-gray-900">25</span> dari <span id="totalData" class="font-semibold text-indigo-600">{{ count($pendaftar) }}</span> data
          </div>
          <div class="flex gap-3">
            <button id="prevBtn" class="px-5 py-2.5 bg-white border-2 border-gray-300 text-gray-700 font-medium rounded-xl hover:bg-gray-50 hover:border-gray-400 transition-all disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:bg-white">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
              </svg>
              Previous
            </button>
            <button id="nextBtn" class="px-5 py-2.5 bg-indigo-600 text-white font-medium rounded-xl hover:bg-indigo-700 transition-all shadow-sm hover:shadow-md disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:bg-indigo-600">
              Next
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
              </svg>
            </button>
          </div>
        </div>
      @endif
    </div>
  </div>
</div>

<!-- Edit Modal -->
<div id="editModal" class="fixed inset-0 bg-black bg-opacity-60 hidden items-center justify-center z-50 p-4">
  <div class="bg-white rounded-2xl shadow-2xl w-full max-w-3xl max-h-[90vh] overflow-y-auto">
    <div class="sticky top-0 bg-white border-b border-gray-200 px-6 py-5 rounded-t-2xl">
      <div class="flex items-center justify-between">
        <h2 class="text-2xl font-bold text-gray-900">Edit Data Pendaftar</h2>
        <button onclick="closeEditModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
          </svg>
        </button>
      </div>
    </div>
    
    <form id="editForm" method="POST" action="">
      @csrf
      @method('PUT')
      <div class="px-6 py-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
          <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap</label>
            <input type="text" name="nama_pendaftar" id="editNama" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all">
          </div>
          <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">NISN</label>
            <input type="text" name="nisn_pendaftar" id="editNISN" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all">
          </div>
          <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Lahir</label>
            <input type="date" name="tanggallahir_pendaftar" id="editTanggal" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all">
          </div>
          <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Alamat</label>
            <input type="text" name="alamat_pendaftar" id="editAlamat" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all">
          </div>
          <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Agama</label>
            <input type="text" name="agama" id="editAgama" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all">
          </div>
          <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Orang Tua</label>
            <input type="text" name="nama_ortu" id="editOrtu" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all">
          </div>
          <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Pekerjaan Orang Tua</label>
            <input type="text" name="pekerjaan_ortu" id="editPekerjaan" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all">
          </div>
          <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">No HP Orang Tua</label>
            <input type="text" name="no_hp_ortu" id="editHP" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all">
          </div>
        </div>
      </div>
      
      <div class="sticky bottom-0 bg-gray-50 border-t border-gray-200 px-6 py-5 rounded-b-2xl flex justify-end gap-3">
        <button type="button" onclick="closeEditModal()" class="px-6 py-3 bg-white border-2 border-gray-300 text-gray-700 font-semibold rounded-xl hover:bg-gray-50 transition-all">Batal</button>
        <button type="submit" class="px-6 py-3 bg-indigo-600 text-white font-semibold rounded-xl hover:bg-indigo-700 transition-all shadow-md hover:shadow-lg">Simpan Perubahan</button>
      </div>
    </form>
  </div>
</div>

<!-- Confirm Modal -->
<div id="confirmModal" class="fixed inset-0 bg-black bg-opacity-60 hidden items-center justify-center z-50 p-4">
  <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md">
    <div class="px-6 py-5 border-b border-gray-200">
      <div class="flex items-center justify-between">
        <h2 class="text-xl font-bold text-gray-900">Konfirmasi Tindakan</h2>
        <button onclick="closeConfirmModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
          </svg>
        </button>
      </div>
    </div>
    
    <div class="px-6 py-6">
      <div class="flex items-start mb-6">
        <div class="flex-shrink-0 w-12 h-12 rounded-full bg-yellow-100 flex items-center justify-center mr-4">
          <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
          </svg>
        </div>
        <div>
          <p id="confirmMessage" class="text-gray-700 font-medium">Apakah Anda yakin ingin melanjutkan tindakan ini?</p>
          <p class="text-sm text-gray-500 mt-1">Tindakan ini tidak dapat dibatalkan.</p>
        </div>
      </div>
      
      <form id="confirmForm" method="POST" action="">
        @csrf
        <div class="flex justify-end gap-3">
          <button type="button" onclick="closeConfirmModal()" class="px-6 py-3 bg-white border-2 border-gray-300 text-gray-700 font-semibold rounded-xl hover:bg-gray-50 transition-all">Batal</button>
          <button type="submit" class="px-6 py-3 bg-red-600 text-white font-semibold rounded-xl hover:bg-red-700 transition-all shadow-md hover:shadow-lg">Ya, Lanjutkan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Add Modal -->
<div id="addModal" class="fixed inset-0 bg-black bg-opacity-60 hidden items-center justify-center z-50 p-4 overflow-y-auto">
  <div class="bg-white rounded-2xl shadow-2xl w-full max-w-5xl my-8 max-h-[90vh] overflow-y-auto">
    <div class="sticky top-0 bg-gradient-to-r from-green-600 to-green-700 px-6 py-6 rounded-t-2xl z-10">
      <div class="flex items-center justify-between">
        <div>
          <h2 class="text-2xl font-bold text-white">Tambah Pendaftar Baru</h2>
          <p class="text-green-100 text-sm mt-1">Lengkapi formulir di bawah ini dengan data yang benar</p>
        </div>
        <button onclick="closeAddModal()" class="text-white hover:text-green-100 transition-colors">
          <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
          </svg>
        </button>
      </div>
    </div>
    
    <form id="addForm" method="POST" action="{{ route('admin.pendaftar.store') }}">
      @csrf
      
      <!-- Data Akun Section -->
      <div class="px-6 py-6 border-b border-gray-200">
        <div class="flex items-center mb-5">
          <div class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center mr-3">
            <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
            </svg>
          </div>
          <h3 class="text-lg font-bold text-gray-900">Data Akun</h3>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
          <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Username <span class="text-red-500">*</span></label>
            <input type="text" name="username" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all">
          </div>
          <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Email <span class="text-red-500">*</span></label>
            <input type="email" name="email" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all">
          </div>
          <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Password <span class="text-red-500">*</span></label>
            <input type="password" name="password" required minlength="8" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all">
            <p class="text-xs text-gray-500 mt-2">Minimal 8 karakter</p>
          </div>
          <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Konfirmasi Password <span class="text-red-500">*</span></label>
            <input type="password" name="password_confirmation" required minlength="8" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all">
          </div>
        </div>
      </div>

      <!-- Data Pribadi Section -->
      <div class="px-6 py-6 border-b border-gray-200">
        <div class="flex items-center mb-5">
          <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center mr-3">
            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"/>
            </svg>
          </div>
          <h3 class="text-lg font-bold text-gray-900">Data Pribadi</h3>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
          <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
            <input type="text" name="nama_pendaftar" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all">
          </div>
          <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">NISN <span class="text-red-500">*</span></label>
            <input type="text" name="nisn_pendaftar" required maxlength="10" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all">
          </div>
          <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Lahir <span class="text-red-500">*</span></label>
            <input type="date" name="tanggallahir_pendaftar" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all">
          </div>
          <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Agama <span class="text-red-500">*</span></label>
            <select name="agama" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all">
              <option value="">Pilih Agama</option>
              <option value="Islam">Islam</option>
              <option value="Kristen">Kristen</option>
              <option value="Katolik">Katolik</option>
              <option value="Hindu">Hindu</option>
              <option value="Buddha">Buddha</option>
              <option value="Konghucu">Konghucu</option>
            </select>
          </div>
          <div class="md:col-span-2">
            <label class="block text-sm font-semibold text-gray-700 mb-2">Alamat <span class="text-red-500">*</span></label>
            <textarea name="alamat_pendaftar" required rows="3" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all"></textarea>
          </div>
        </div>
      </div>

      <!-- Data Orang Tua Section -->
      <div class="px-6 py-6 border-b border-gray-200">
        <div class="flex items-center mb-5">
          <div class="w-10 h-10 rounded-full bg-purple-100 flex items-center justify-center mr-3">
            <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
            </svg>
          </div>
          <h3 class="text-lg font-bold text-gray-900">Data Orang Tua</h3>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
          <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Orang Tua <span class="text-red-500">*</span></label>
            <input type="text" name="nama_ortu" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all">
          </div>
          <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Pekerjaan Orang Tua <span class="text-red-500">*</span></label>
            <input type="text" name="pekerjaan_ortu" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all">
          </div>
          <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">No HP Orang Tua <span class="text-red-500">*</span></label>
            <input type="text" name="no_hp_ortu" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all">
          </div>
        </div>
      </div>

      <!-- Nilai Semester Section -->
      <div class="px-6 py-6">
        <div class="flex items-center mb-5">
          <div class="w-10 h-10 rounded-full bg-yellow-100 flex items-center justify-center mr-3">
            <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
          </div>
          <h3 class="text-lg font-bold text-gray-900">Nilai Semester (Rata-rata Rapor)</h3>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-5">
          <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Semester 1 <span class="text-red-500">*</span></label>
            <input type="number" name="nilai_smt1" required min="0" max="100" step="0.01" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all">
          </div>
          <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Semester 2 <span class="text-red-500">*</span></label>
            <input type="number" name="nilai_smt2" required min="0" max="100" step="0.01" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all">
          </div>
          <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Semester 3 <span class="text-red-500">*</span></label>
            <input type="number" name="nilai_smt3" required min="0" max="100" step="0.01" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all">
          </div>
          <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Semester 4 <span class="text-red-500">*</span></label>
            <input type="number" name="nilai_smt4" required min="0" max="100" step="0.01" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all">
          </div>
          <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Semester 5 <span class="text-red-500">*</span></label>
            <input type="number" name="nilai_smt5" required min="0" max="100" step="0.01" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all">
          </div>
        </div>
      </div>

      <!-- Action Buttons -->
      <div class="sticky bottom-0 bg-gray-50 border-t border-gray-200 px-6 py-5 rounded-b-2xl flex justify-end gap-3">
        <button type="button" onclick="closeAddModal()" class="px-6 py-3 bg-white border-2 border-gray-300 text-gray-700 font-semibold rounded-xl hover:bg-gray-50 transition-all">Batal</button>
        <button type="submit" class="px-6 py-3 bg-green-600 text-white font-semibold rounded-xl hover:bg-green-700 transition-all shadow-md hover:shadow-lg">
          <span class="submit-text">Simpan Data</span>
        </button>
      </div>
    </form>
  </div>
</div>