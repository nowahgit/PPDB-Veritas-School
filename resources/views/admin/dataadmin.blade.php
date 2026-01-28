<div class="md:ml-12 md:mr-12 md:mb-10 animate-fade-in">
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-indigo-500 to-purple-600 rounded-2xl shadow-lg p-6 mb-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div class="text-white">
                <h2 class="text-2xl sm:text-3xl font-bold mb-2 flex items-center gap-3">
                    <div class="w-12 h-12 bg-white bg-opacity-20 rounded-xl flex items-center justify-center backdrop-blur-sm">
                        <i class="fa fa-users-cog text-2xl"></i>
                    </div>
                    Data Admin
                </h2>
                <p class="text-indigo-100 text-sm">Kelola akun administrator sistem PPDB</p>
            </div>
            <button
                onclick="openAddAdminModal()"
                class="flex items-center justify-center gap-2 bg-white text-indigo-600 px-6 py-3 rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 font-semibold hover:scale-105 transform"
            >
                <i class="fa fa-plus-circle text-lg"></i> 
                <span>Tambah Admin</span>
            </button>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl p-5 text-white shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-1">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-100 text-sm font-medium mb-1">Total Admin</p>
                    <p class="text-3xl font-bold">{{ $admins->total() }}</p>
                </div>
                <div class="w-14 h-14 bg-white bg-opacity-20 rounded-xl flex items-center justify-center backdrop-blur-sm">
                    <i class="fa fa-user-shield text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl p-5 text-white shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-1">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-green-100 text-sm font-medium mb-1">Aktif Hari Ini</p>
                    <p class="text-3xl font-bold">{{ $admins->where('last_login', '>=', now()->startOfDay())->count() }}</p>
                </div>
                <div class="w-14 h-14 bg-white bg-opacity-20 rounded-xl flex items-center justify-center backdrop-blur-sm">
                    <i class="fa fa-check-circle text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-purple-500 to-pink-600 rounded-xl p-5 text-white shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-1">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-purple-100 text-sm font-medium mb-1">Admin Baru</p>
                    <p class="text-3xl font-bold">{{ $admins->where('created_at', '>=', now()->subDays(7))->count() }}</p>
                </div>
                <div class="w-14 h-14 bg-white bg-opacity-20 rounded-xl flex items-center justify-center backdrop-blur-sm">
                    <i class="fa fa-user-plus text-2xl"></i>
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
                    <i class="fa fa-search text-gray-400"></i>
                </div>
                <input 
                    type="text" 
                    id="searchInput"
                    placeholder="Cari berdasarkan username, nama panitia, atau email..."
                    class="w-full pl-12 pr-4 py-3.5 border-2 border-gray-200 rounded-xl shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all text-gray-700 placeholder-gray-400"
                >
            </div>
        </div>

        <!-- Desktop Table View -->
        <div class="hidden lg:block overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                    <tr class="border-b border-gray-200">
                        <th class="px-6 py-4 text-left font-bold text-gray-700 uppercase tracking-wider text-xs">
                            <div class="flex items-center gap-2">
                                <span class="w-8 h-8 bg-indigo-100 rounded-lg flex items-center justify-center text-indigo-600">
                                    #
                                </span>
                            </div>
                        </th>
                        <th class="px-6 py-4 text-left font-bold text-gray-700 uppercase tracking-wider text-xs">
                            <i class="fa fa-user mr-2 text-indigo-500"></i>Username
                        </th>
                        <th class="px-6 py-4 text-left font-bold text-gray-700 uppercase tracking-wider text-xs">
                            <i class="fa fa-id-card mr-2 text-indigo-500"></i>Nama Panitia
                        </th>
                        <th class="px-6 py-4 text-left font-bold text-gray-700 uppercase tracking-wider text-xs">
                            <i class="fa fa-envelope mr-2 text-indigo-500"></i>Email
                        </th>
                        <th class="px-6 py-4 text-left font-bold text-gray-700 uppercase tracking-wider text-xs">
                            <i class="fa fa-clock mr-2 text-indigo-500"></i>Terdaftar
                        </th>
                        <th class="px-6 py-4 text-center font-bold text-gray-700 uppercase tracking-wider text-xs">
                            <i class="fa fa-cog mr-2 text-indigo-500"></i>Aksi
                        </th>
                    </tr>
                </thead>
                <tbody id="adminTableBody" class="divide-y divide-gray-100">
                    @forelse ($admins as $index => $admin)
                    <tr class="hover:bg-gradient-to-r hover:from-indigo-50 hover:to-purple-50 transition-all duration-200 admin-row" 
                        data-username="{{ strtolower($admin->username) }}" 
                        data-nama="{{ strtolower($admin->admin->nama_panitia ?? '') }}" 
                        data-email="{{ strtolower($admin->email ?? '') }}">
                        <td class="px-6 py-4">
                            <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center text-white font-bold shadow-md">
                                {{ $admins->firstItem() + $index }}
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-gradient-to-br from-blue-400 to-indigo-500 rounded-full flex items-center justify-center text-white font-bold shadow-md">
                                    {{ strtoupper(substr($admin->username, 0, 1)) }}
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-800">{{ $admin->username }}</p>
                                    <p class="text-xs text-gray-500">@{{ $admin->username }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                @if($admin->admin->nama_panitia ?? false)
                                    <span class="px-3 py-1 bg-green-100 text-green-700 rounded-lg text-xs font-medium">
                                        {{ $admin->admin->nama_panitia }}
                                    </span>
                                @else
                                    <span class="px-3 py-1 bg-gray-100 text-gray-500 rounded-lg text-xs italic">
                                        Belum diisi
                                    </span>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            @if($admin->email)
                                <div class="flex items-center gap-2 text-gray-700">
                                    <i class="fa fa-envelope text-indigo-400 text-xs"></i>
                                    <span class="text-sm">{{ $admin->email }}</span>
                                </div>
                            @else
                                <span class="text-gray-400 text-sm italic">Tidak ada email</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-xs">
                                <p class="text-gray-600">{{ $admin->created_at->format('d M Y') }}</p>
                                <p class="text-gray-400">{{ $admin->created_at->diffForHumans() }}</p>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-2">
                                <button
                                    onclick="openEditAdminModal({{ $admin->id }}, '{{ $admin->username }}', '{{ $admin->admin->nama_panitia ?? '' }}', '{{ $admin->email }}')"
                                    class="group relative inline-flex items-center gap-2 bg-gradient-to-r from-amber-400 to-orange-500 hover:from-amber-500 hover:to-orange-600 text-white px-4 py-2 rounded-lg transition-all duration-200 shadow-md hover:shadow-lg transform hover:scale-105"
                                    title="Edit Admin"
                                >
                                    <i class="fa fa-edit"></i>
                                    <span class="font-medium">Edit</span>
                                </button>
                                <button
                                    onclick="openConfirmModal(this, '{{ route('admin.delete', $admin->id) }}', 'DELETE')"
                                    class="group relative inline-flex items-center gap-2 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white px-4 py-2 rounded-lg transition-all duration-200 shadow-md hover:shadow-lg transform hover:scale-105"
                                    title="Hapus Admin"
                                >
                                    <i class="fa fa-trash"></i>
                                    <span class="font-medium">Hapus</span>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr id="emptyRow">
                        <td colspan="6" class="text-center py-16">
                            <div class="flex flex-col items-center justify-center">
                                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                    <i class="fa fa-user-slash text-4xl text-gray-300"></i>
                                </div>
                                <p class="text-gray-500 font-semibold text-lg mb-1">Belum ada admin</p>
                                <p class="text-gray-400 text-sm">Klik tombol "Tambah Admin" untuk menambahkan administrator baru</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Mobile/Tablet Card View -->
        <div id="adminCardView" class="lg:hidden p-4 space-y-4">
            @forelse ($admins as $index => $admin)
            <div class="bg-gradient-to-br from-white to-gray-50 border-2 border-gray-100 rounded-xl p-5 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 admin-card" 
                 data-username="{{ strtolower($admin->username) }}" 
                 data-nama="{{ strtolower($admin->admin->nama_panitia ?? '') }}" 
                 data-email="{{ strtolower($admin->email ?? '') }}">
                
                <!-- Header -->
                <div class="flex items-start justify-between mb-4">
                    <div class="flex items-center gap-3 flex-1">
                        <div class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center text-white font-bold shadow-lg text-sm">
                            {{ $admins->firstItem() + $index }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <h3 class="font-bold text-gray-800 text-lg truncate">{{ $admin->username }}</h3>
                            <p class="text-xs text-gray-500">@{{ $admin->username }}</p>
                        </div>
                    </div>
                    <div class="flex-shrink-0">
                        <span class="px-3 py-1 bg-gradient-to-r from-green-400 to-emerald-500 text-white rounded-full text-xs font-semibold shadow-sm">
                            Admin
                        </span>
                    </div>
                </div>

                <!-- Info Grid -->
                <div class="space-y-3 mb-4">
                    <div class="flex items-start gap-3 p-3 bg-white rounded-lg border border-gray-100">
                        <div class="w-8 h-8 bg-indigo-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <i class="fa fa-id-card text-indigo-600"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-xs text-gray-500 font-medium mb-1">Nama Panitia</p>
                            @if($admin->admin->nama_panitia ?? false)
                                <p class="text-sm text-gray-800 font-semibold">{{ $admin->admin->nama_panitia }}</p>
                            @else
                                <p class="text-sm text-gray-400 italic">Belum diisi</p>
                            @endif
                        </div>
                    </div>

                    <div class="flex items-start gap-3 p-3 bg-white rounded-lg border border-gray-100">
                        <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <i class="fa fa-envelope text-blue-600"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-xs text-gray-500 font-medium mb-1">Email</p>
                            @if($admin->email)
                                <p class="text-sm text-gray-800 truncate">{{ $admin->email }}</p>
                            @else
                                <p class="text-sm text-gray-400 italic">Tidak ada email</p>
                            @endif
                        </div>
                    </div>

                    <div class="flex items-start gap-3 p-3 bg-white rounded-lg border border-gray-100">
                        <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <i class="fa fa-clock text-purple-600"></i>
                        </div>
                        <div class="flex-1">
                            <p class="text-xs text-gray-500 font-medium mb-1">Terdaftar</p>
                            <p class="text-sm text-gray-800 font-semibold">{{ $admin->created_at->format('d M Y') }}</p>
                            <p class="text-xs text-gray-400">{{ $admin->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                </div>
                
                <!-- Action Buttons -->
                <div class="flex gap-2 pt-4 border-t-2 border-gray-100">
                    <button
                        onclick="openEditAdminModal({{ $admin->id }}, '{{ $admin->username }}', '{{ $admin->admin->nama_panitia ?? '' }}', '{{ $admin->email }}')"
                        class="flex-1 inline-flex items-center justify-center gap-2 bg-gradient-to-r from-amber-400 to-orange-500 hover:from-amber-500 hover:to-orange-600 text-white px-4 py-3 rounded-xl transition-all duration-200 font-semibold shadow-md hover:shadow-lg transform hover:scale-105"
                    >
                        <i class="fa fa-edit"></i> Edit
                    </button>
                    <button
                        onclick="openConfirmModal(this, '{{ route('admin.delete', $admin->id) }}', 'DELETE')"
                        class="flex-1 inline-flex items-center justify-center gap-2 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white px-4 py-3 rounded-xl transition-all duration-200 font-semibold shadow-md hover:shadow-lg transform hover:scale-105"
                    >
                        <i class="fa fa-trash"></i> Hapus
                    </button>
                </div>
            </div>
            @empty
            <div id="emptyCard" class="text-center py-16 border-2 border-dashed border-gray-200 rounded-xl">
                <div class="flex flex-col items-center">
                    <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                        <i class="fa fa-user-slash text-4xl text-gray-300"></i>
                    </div>
                    <p class="text-gray-500 font-semibold text-lg mb-1">Belum ada admin</p>
                    <p class="text-gray-400 text-sm px-4">Klik tombol "Tambah Admin" untuk menambahkan administrator baru</p>
                </div>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($admins->hasPages())
        <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                <div class="text-sm text-gray-600">
                    Menampilkan <span class="font-semibold text-indigo-600">{{ $admins->firstItem() }}</span> 
                    sampai <span class="font-semibold text-indigo-600">{{ $admins->lastItem() }}</span> 
                    dari <span class="font-semibold text-indigo-600">{{ $admins->total() }}</span> admin
                </div>
                <div>
                    {{ $admins->links() }}
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

<!-- ========================================================= -->
<!-- ==== MODALS ==== -->
<!-- ========================================================= -->

<!-- Modal Tambah Admin -->
<div id="addAdminModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 p-4 backdrop-blur-sm">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg p-6 sm:p-8 relative max-h-[90vh] overflow-y-auto animate-slide-in">
        <button onclick="closeAddAdminModal()" class="absolute top-4 right-4 w-10 h-10 flex items-center justify-center text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-full transition-all text-2xl">
            &times;
        </button>
        
        <!-- Modal Header -->
        <div class="mb-6">
            <div class="w-16 h-16 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-2xl flex items-center justify-center mb-4 shadow-lg">
                <i class="fa fa-user-plus text-2xl text-white"></i>
            </div>
            <h2 class="text-2xl font-bold text-gray-800 mb-2">Tambah Admin Baru</h2>
            <p class="text-gray-500 text-sm">Lengkapi formulir di bawah untuk menambahkan administrator baru</p>
        </div>

        <form method="POST" action="{{ route('admin.store') }}" class="space-y-5">
            @csrf
            
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fa fa-user text-indigo-500 mr-2"></i>Username 
                    <span class="text-red-500">*</span>
                </label>
                <input 
                    type="text" 
                    name="username" 
                    required 
                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all"
                    placeholder="Masukkan username"
                >
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fa fa-id-card text-indigo-500 mr-2"></i>Nama Panitia
                </label>
                <input 
                    type="text" 
                    name="nama_panitia" 
                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all"
                    placeholder="Masukkan nama lengkap panitia"
                >
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fa fa-envelope text-indigo-500 mr-2"></i>Email
                </label>
                <input 
                    type="email" 
                    name="email" 
                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all"
                    placeholder="admin@example.com"
                >
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fa fa-lock text-indigo-500 mr-2"></i>Password 
                    <span class="text-red-500">*</span>
                </label>
                <input 
                    type="password" 
                    name="password" 
                    required 
                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all"
                    placeholder="Minimal 8 karakter"
                >
                <p class="mt-2 text-xs text-gray-500">
                    <i class="fa fa-info-circle mr-1"></i>Password minimal 8 karakter
                </p>
            </div>

            <div class="pt-6 flex flex-col-reverse sm:flex-row justify-end gap-3">
                <button 
                    type="button" 
                    onclick="closeAddAdminModal()" 
                    class="w-full sm:w-auto px-6 py-3 border-2 border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 transition-all font-semibold"
                >
                    Batal
                </button>
                <button 
                    type="submit" 
                    class="w-full sm:w-auto px-6 py-3 bg-gradient-to-r from-indigo-500 to-purple-600 text-white rounded-xl hover:from-indigo-600 hover:to-purple-700 transition-all font-semibold shadow-lg hover:shadow-xl transform hover:scale-105"
                >
                    <i class="fa fa-save mr-2"></i>Simpan Admin
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit Admin -->
<div id="editAdminModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 p-4 backdrop-blur-sm">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg p-6 sm:p-8 relative max-h-[90vh] overflow-y-auto animate-slide-in">
        <button onclick="closeEditAdminModal()" class="absolute top-4 right-4 w-10 h-10 flex items-center justify-center text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-full transition-all text-2xl">
            &times;
        </button>
        
        <!-- Modal Header -->
        <div class="mb-6">
            <div class="w-16 h-16 bg-gradient-to-br from-amber-400 to-orange-500 rounded-2xl flex items-center justify-center mb-4 shadow-lg">
                <i class="fa fa-user-edit text-2xl text-white"></i>
            </div>
            <h2 class="text-2xl font-bold text-gray-800 mb-2">Edit Data Admin</h2>
            <p class="text-gray-500 text-sm">Perbarui informasi administrator</p>
        </div>

        <form id="editAdminForm" method="POST" class="space-y-5">
            @csrf
            @method('PUT')
            
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fa fa-user text-amber-500 mr-2"></i>Username
                    <span class="text-red-500">*</span>
                </label>
                <input 
                    type="text" 
                    name="username" 
                    id="editAdminUsername" 
                    required
                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl shadow-sm focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-all"
                    placeholder="Username"
                >
            </div>
            
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fa fa-id-card text-amber-500 mr-2"></i>Nama Panitia
                </label>
                <input 
                    type="text" 
                    name="nama_panitia" 
                    id="editAdminNamaPanitia" 
                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl shadow-sm focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-all"
                    placeholder="Nama lengkap panitia"
                >
            </div>
            
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fa fa-envelope text-amber-500 mr-2"></i>Email
                </label>
                <input 
                    type="email" 
                    name="email" 
                    id="editAdminEmail" 
                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl shadow-sm focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-all"
                    placeholder="Email admin"
                >
            </div>

            <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded-lg">
                <div class="flex items-start">
                    <i class="fa fa-info-circle text-blue-500 mt-0.5 mr-3"></i>
                    <p class="text-sm text-blue-700">
                        Biarkan kosong jika tidak ingin mengubah password
                    </p>
                </div>
            </div>

            <div class="pt-6 flex flex-col-reverse sm:flex-row justify-end gap-3">
                <button 
                    type="button" 
                    onclick="closeEditAdminModal()" 
                    class="w-full sm:w-auto px-6 py-3 border-2 border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 transition-all font-semibold"
                >
                    Batal
                </button>
                <button 
                    type="submit" 
                    class="w-full sm:w-auto px-6 py-3 bg-gradient-to-r from-amber-400 to-orange-500 text-white rounded-xl hover:from-amber-500 hover:to-orange-600 transition-all font-semibold shadow-lg hover:shadow-xl transform hover:scale-105"
                >
                    <i class="fa fa-save mr-2"></i>Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
// Live Search Function
document.getElementById('searchInput')?.addEventListener('input', function(e) {
    const searchTerm = e.target.value.toLowerCase();
    
    // Desktop table rows
    document.querySelectorAll('.admin-row').forEach(row => {
        const username = row.dataset.username || '';
        const nama = row.dataset.nama || '';
        const email = row.dataset.email || '';
        
        const matches = username.includes(searchTerm) || 
                       nama.includes(searchTerm) || 
                       email.includes(searchTerm);
        
        row.style.display = matches ? '' : 'none';
    });
    
    // Mobile cards
    document.querySelectorAll('.admin-card').forEach(card => {
        const username = card.dataset.username || '';
        const nama = card.dataset.nama || '';
        const email = card.dataset.email || '';
        
        const matches = username.includes(searchTerm) || 
                       nama.includes(searchTerm) || 
                       email.includes(searchTerm);
        
        card.style.display = matches ? '' : 'none';
    });
    
    // Show/hide empty states
    const visibleRows = document.querySelectorAll('.admin-row[style=""]').length;
    const visibleCards = document.querySelectorAll('.admin-card[style=""]').length;
    
    const emptyRow = document.getElementById('emptyRow');
    const emptyCard = document.getElementById('emptyCard');
    
    if (emptyRow) emptyRow.style.display = visibleRows === 0 ? '' : 'none';
    if (emptyCard) emptyCard.style.display = visibleCards === 0 ? '' : 'none';
});
</script>