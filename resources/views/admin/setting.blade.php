<!-- PENGATURAN PAGE -->
<div class="max-w-6xl mx-auto">
  
  <!-- HEADER -->
  <header class="mb-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-2">Pengaturan</h1>
    <p class="text-gray-600">Kelola pengaturan akun dan sistem</p>
  </header>

  <!-- GRID SETTINGS -->
  <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">

    <!-- PROFILE SETTINGS -->
    <div class="bg-white border border-gray-200 rounded-lg shadow-sm hover:shadow-md transition-shadow">
      <div class="px-6 py-4 border-b border-gray-200">
        <h2 class="text-xl font-semibold text-gray-800">Profil Admin</h2>
        <p class="text-sm text-gray-500 mt-1">Perbarui informasi profil Anda</p>
      </div>
      <div class="p-6">
        <form method="POST" action="{{ route('admin.updateProfile') }}" class="space-y-5">
          @csrf
          @method('PUT')

          <div>
            <label for="profile_username" class="block text-sm font-medium text-gray-700 mb-2">
              Username
            </label>
            <input 
              type="text" 
              id="profile_username"
              name="username"
              value="{{ old('username', auth()->user()->username) }}"
              class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('username') border-red-500 @enderror"
              required>
            @error('username')
              <p class="text-red-600 text-xs mt-1.5">{{ $message }}</p>
            @enderror
          </div>

          <div>
            <label for="profile_email" class="block text-sm font-medium text-gray-700 mb-2">
              Email
            </label>
            <input 
              type="email" 
              id="profile_email"
              name="email"
              value="{{ old('email', auth()->user()->email) }}"
              class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('email') border-red-500 @enderror"
              required>
            @error('email')
              <p class="text-red-600 text-xs mt-1.5">{{ $message }}</p>
            @enderror
          </div>

          <div class="pt-2">
            <button 
              type="submit"
              class="px-6 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors font-medium">
              Perbarui Profil
            </button>
          </div>
        </form>
      </div>
    </div>

    <!-- CHANGE PASSWORD -->
    <div class="bg-white border border-gray-200 rounded-lg shadow-sm hover:shadow-md transition-shadow">
      <div class="px-6 py-4 border-b border-gray-200">
        <h2 class="text-xl font-semibold text-gray-800">Ubah Password</h2>
        <p class="text-sm text-gray-500 mt-1">Ganti password akun Anda</p>
      </div>
      <div class="p-6">
        <form method="POST" action="{{ route('admin.updatePassword') }}" class="space-y-5">
          @csrf

          <div>
            <label for="current_password" class="block text-sm font-medium text-gray-700 mb-2">
              Password Lama
            </label>
            <input 
              type="password" 
              id="current_password"
              name="current_password" 
              required
              class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('current_password') border-red-500 @enderror">
            @error('current_password')
              <p class="text-red-600 text-xs mt-1.5">{{ $message }}</p>
            @enderror
          </div>

          <div>
            <label for="new_password" class="block text-sm font-medium text-gray-700 mb-2">
              Password Baru
            </label>
            <input 
              type="password" 
              id="new_password"
              name="new_password" 
              required
              class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('new_password') border-red-500 @enderror">
            @error('new_password')
              <p class="text-red-600 text-xs mt-1.5">{{ $message }}</p>
            @enderror
          </div>

          <div>
            <label for="new_password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
              Konfirmasi Password Baru
            </label>
            <input 
              type="password" 
              id="new_password_confirmation"
              name="new_password_confirmation" 
              required
              class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
          </div>

          <div class="pt-2">
            <button 
              type="submit"
              class="px-6 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors font-medium">
              Ubah Password
            </button>
          </div>
        </form>
      </div>
    </div>

  </div>

  <!-- SYSTEM SETTINGS -->
  <div class="bg-white border border-gray-200 rounded-lg shadow-sm hover:shadow-md transition-shadow">
    <div class="px-6 py-4 border-b border-gray-200">
      <h2 class="text-xl font-semibold text-gray-800">Pengaturan Sistem</h2>
      <p class="text-sm text-gray-500 mt-1">Konfigurasi pengaturan sistem</p>
    </div>
    <div class="p-6">
      <div class="space-y-4">

        <!-- ITEM -->
        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
          <div class="flex-1">
            <h3 class="font-medium text-gray-800 mb-1">Notifikasi Email</h3>
            <p class="text-sm text-gray-600">Notifikasi saat ada pendaftar baru</p>
          </div>
          <label class="relative inline-flex items-center cursor-pointer ml-4">
            <input type="checkbox" class="sr-only peer" checked>
            <div class="w-11 h-6 bg-gray-300 rounded-full peer peer-checked:bg-blue-600 transition-colors after:content-[''] after:absolute after:top-0.5 after:left-0.5 after:bg-white after:h-5 after:w-5 after:rounded-full after:transition-all peer-checked:after:translate-x-5"></div>
          </label>
        </div>

        <!-- ITEM -->
        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
          <div class="flex-1">
            <h3 class="font-medium text-gray-800 mb-1">Auto Approval</h3>
            <p class="text-sm text-gray-600">Terima pendaftar otomatis</p>
          </div>
          <label class="relative inline-flex items-center cursor-pointer ml-4">
            <input type="checkbox" class="sr-only peer">
            <div class="w-11 h-6 bg-gray-300 rounded-full peer peer-checked:bg-blue-600 transition-colors after:content-[''] after:absolute after:top-0.5 after:left-0.5 after:bg-white after:h-5 after:w-5 after:rounded-full after:transition-all peer-checked:after:translate-x-5"></div>
          </label>
        </div>

      </div>
    </div>
  </div>

</div>

