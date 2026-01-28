<!-- Floating Centered Navbar -->
<nav class="font-gabarito fixed top-4 left-1/2 transform -translate-x-1/2 z-50 bg-white backdrop-blur-sm shadow-sm border border-gray-100 rounded-2xl py-3.5 px-8 md:px-12 flex items-center justify-between transition-all duration-300 max-w-7xl w-[95%] md:w-auto">
  
  <!-- Logo -->
  <div class="flex items-center">
    <img src="{{ asset('image/icon/icon.png') }}" alt="PPDB 2025" class="w-10 h-10 object-contain">
  </div>

  <!-- Desktop Links -->
  <div class="hidden md:flex items-center space-x-1.5">
    <a href="#hero" class="nav-link text-gray-700 px-4 py-2 rounded-xl transition-all duration-200 hover:text-blue-600 hover:bg-gray-50 font-medium text-sm">Beranda</a>
    <a href="#about" class="nav-link text-gray-700 px-4 py-2 rounded-xl transition-all duration-200 hover:text-blue-600 hover:bg-gray-50 font-medium text-sm">Tentang</a>
    <a href="#alur" class="nav-link text-gray-700 px-4 py-2 rounded-xl transition-all duration-200 hover:text-blue-600 hover:bg-gray-50 font-medium text-sm">Alur Pendaftaran</a>
    <a href="#testimoni" class="nav-link text-gray-700 px-4 py-2 rounded-xl transition-all duration-200 hover:text-blue-600 hover:bg-gray-50 font-medium text-sm">Testimoni</a>

    @guest
      <a href="/login" class="text-gray-700 border border-gray-200 px-5 py-2 rounded-xl hover:border-gray-300 hover:bg-gray-50 transition-all duration-200 font-medium text-sm ml-2">Log in</a>
      <a href="/register" class="bg-blue-600 text-white px-5 py-2 rounded-xl hover:bg-blue-700 transition-all duration-200 font-medium text-sm ml-1.5 shadow-sm">Register</a>
    @endguest

    @auth
    <!-- Menu Dropdown -->
    <div class="relative group ml-2">
      <button class="flex items-center justify-center px-5 py-2 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition-all duration-200 font-medium text-sm shadow-sm">
        Menu
        <svg class="w-4 h-4 ml-1.5 transition-transform duration-200 group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
        </svg>
      </button>
      <div class="absolute right-0 mt-2 w-52 bg-white rounded-xl shadow-lg border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
        <div class="px-4 py-3 border-b border-gray-100">
          <p class="font-semibold text-gray-900 text-sm">{{ Auth::user()->username }}</p>
          <p class="text-xs text-gray-500 mt-0.5">{{ Auth::user()->role }}</p>
        </div>
        <a href="{{ Auth::user()->role === 'ADMIN' ? url('admin/dashboard') : url('pendaftar/dashboard') }}" class="block px-4 py-2.5 hover:bg-gray-50 transition-all duration-150 text-gray-700 text-sm font-medium">Dashboard</a>
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="w-full text-left px-4 py-2.5 hover:bg-red-50 text-red-600 transition-all duration-150 text-sm font-medium rounded-b-xl">Logout</button>
        </form>
      </div>
    </div>
    @endauth
  </div>

  <!-- Mobile Menu Button -->
  <div class="md:hidden flex items-center">
    <button id="mobile-menu-btn" class="text-gray-700 transition-transform duration-300 p-1.5 hover:bg-gray-50 rounded-lg">
      <svg id="menu-icon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
      </svg>
    </button>
  </div>

  <!-- Mobile Menu -->
  <div id="mobile-menu" class="hidden absolute top-full left-1/2 transform -translate-x-1/2 mt-2 w-[90%] max-w-sm bg-white rounded-2xl shadow-lg border border-gray-100 transition-all duration-300 opacity-0 scale-95">
    <div class="flex flex-col p-3 space-y-1">
      <a href="#hero" class="block px-4 py-2.5 text-gray-700 hover:bg-gray-50 rounded-xl font-medium text-sm transition-all duration-150">Beranda</a>
      <a href="#about" class="block px-4 py-2.5 text-gray-700 hover:bg-gray-50 rounded-xl font-medium text-sm transition-all duration-150">Tentang</a>
      <a href="#alur" class="block px-4 py-2.5 text-gray-700 hover:bg-gray-50 rounded-xl font-medium text-sm transition-all duration-150">Alur Pendaftaran</a>
      <a href="#testimoni" class="block px-4 py-2.5 text-gray-700 hover:bg-gray-50 rounded-xl font-medium text-sm transition-all duration-150">Testimoni</a>

      @guest
        <div class="pt-2 border-t border-gray-100 mt-2 space-y-1.5">
          <a href="/login" class="block px-4 py-2.5 text-gray-700 border border-gray-200 rounded-xl text-center hover:bg-gray-50 hover:border-gray-300 transition-all duration-150 font-medium text-sm">Log in</a>
          <a href="/register" class="block px-4 py-2.5 bg-blue-600 text-white rounded-xl text-center hover:bg-blue-700 transition-all duration-150 font-medium text-sm shadow-sm">Register</a>
        </div>
      @endguest

      @auth
        <div class="pt-2 border-t border-gray-100 mt-2 space-y-1.5">
          <a href="{{ Auth::user()->role === 'ADMIN' ? url('admin/dashboard') : url('pendaftar/dashboard') }}" class="block px-4 py-2.5 bg-blue-600 text-white rounded-xl text-center hover:bg-blue-700 transition-all duration-150 font-medium text-sm shadow-sm">Dashboard</a>
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full text-center px-4 py-2.5 bg-red-50 text-red-600 rounded-xl hover:bg-red-100 transition-all duration-150 font-medium text-sm border border-red-100">Logout</button>
          </form>
        </div>
      @endauth
    </div>  
  </div>
</nav>

<script>
const btn = document.getElementById('mobile-menu-btn');
const menu = document.getElementById('mobile-menu');
const icon = document.getElementById('menu-icon');

btn.addEventListener('click', () => {
  menu.classList.toggle('hidden');
  if(!menu.classList.contains('hidden')){
    menu.classList.add('opacity-100', 'scale-100');
    menu.classList.remove('opacity-0', 'scale-95');
    icon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>`;
  } else {
    menu.classList.add('opacity-0', 'scale-95');
    menu.classList.remove('opacity-100', 'scale-100');
    icon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>`;
  }
});

// Smooth scroll
document.querySelectorAll('a.nav-link, #mobile-menu a').forEach(link => {
  link.addEventListener('click', function(e){
    const href = this.getAttribute('href');
    if(href.startsWith('#')){
      e.preventDefault();
      const target = document.querySelector(href);
      if(target){
        const navbarHeight = 90;
        const elementPosition = target.getBoundingClientRect().top + window.pageYOffset;
        const offsetPosition = elementPosition - navbarHeight;
        window.scrollTo({ top: offsetPosition, behavior: 'smooth' });

        if(!menu.classList.contains('hidden')){
          menu.classList.add('hidden', 'opacity-0', 'scale-95');
          menu.classList.remove('opacity-100', 'scale-100');
          icon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>`;
        }
      }
    }
  });
});

// Close dropdown if clicked outside
document.addEventListener('click', function(e){
  const dropdown = document.querySelector('.group');
  if(dropdown && !dropdown.contains(e.target)){
    const dropdownContent = dropdown.querySelector('div.absolute');
    if(dropdownContent){
      dropdownContent.classList.remove('opacity-100', 'visible');
      dropdownContent.classList.add('opacity-0', 'invisible');
    }
  }
});
</script>