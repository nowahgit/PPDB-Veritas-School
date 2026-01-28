<!-- CONTENT WRAPPER -->
<div class="flex-1 min-h-screen bg-gray-50 px-4 md:px-6 lg:px-8 py-6">
  <div class="max-w-7xl mx-auto space-y-8">

    <!-- HEADER -->
    <header>
      <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Settings</h1>
      <p class="text-gray-600 mt-1">Kelola pengaturan akun dan sistem</p>
    </header>

    <!-- GRID SETTINGS -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

      <!-- PROFILE SETTINGS -->
      <div class="bg-white rounded-xl shadow-sm border border-gray-100">
        <div class="px-6 py-4 border-b">
          <h2 class="text-lg font-semibold text-gray-800">Profil Admin</h2>
        </div>
        <div class="p-6">
          <form method="POST" action="{{ route('admin.updateProfile') }}" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Username</label>
              <input type="text" name="username"
                value="{{ auth()->user()->username }}"
                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none">
            </div>

            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
              <input type="email" name="email"
                value="{{ auth()->user()->email }}"
                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none">
            </div>

            <button type="submit"
              class="w-full md:w-auto px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
              Update Profil
            </button>
          </form>
        </div>
      </div>

      <!-- CHANGE PASSWORD -->
      <div class="bg-white rounded-xl shadow-sm border border-gray-100">
        <div class="px-6 py-4 border-b">
          <h2 class="text-lg font-semibold text-gray-800">Ubah Password</h2>
        </div>
        <div class="p-6">
          <form method="POST" action="{{ route('admin.updatePassword') }}" class="space-y-4">
            @csrf

            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Password Lama</label>
              <input type="password" name="current_password" required
                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none">
            </div>

            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Password Baru</label>
              <input type="password" name="new_password" required
                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none">
            </div>

            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password Baru</label>
              <input type="password" name="new_password_confirmation" required
                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none">
            </div>

            <button type="submit"
              class="w-full md:w-auto px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
              Ubah Password
            </button>
          </form>
        </div>
      </div>

    </div>

    <!-- SYSTEM SETTINGS -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100">
      <div class="px-6 py-4 border-b">
        <h2 class="text-lg font-semibold text-gray-800">Pengaturan Sistem</h2>
      </div>
      <div class="p-6 space-y-4">

        <!-- ITEM -->
        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
          <div>
            <h3 class="font-medium text-gray-800">Notifikasi Email</h3>
            <p class="text-sm text-gray-600">Notifikasi saat ada pendaftar baru</p>
          </div>
          <label class="relative inline-flex cursor-pointer">
            <input type="checkbox" class="sr-only peer" checked>
            <div
              class="w-11 h-6 bg-gray-200 rounded-full peer-checked:bg-indigo-600
              after:content-[''] after:absolute after:top-0.5 after:left-0.5
              after:bg-white after:h-5 after:w-5 after:rounded-full after:transition
              peer-checked:after:translate-x-5">
            </div>
          </label>
        </div>

        <!-- ITEM -->
        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
          <div>
            <h3 class="font-medium text-gray-800">Auto Approval</h3>
            <p class="text-sm text-gray-600">Terima pendaftar otomatis</p>
          </div>
          <label class="relative inline-flex cursor-pointer">
            <input type="checkbox" class="sr-only peer">
            <div
              class="w-11 h-6 bg-gray-200 rounded-full peer-checked:bg-indigo-600
              after:content-[''] after:absolute after:top-0.5 after:left-0.5
              after:bg-white after:h-5 after:w-5 after:rounded-full after:transition
              peer-checked:after:translate-x-5">
            </div>
          </label>
        </div>

      </div>
    </div>

  </div>
</div>
