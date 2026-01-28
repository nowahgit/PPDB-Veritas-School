<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Dashboard Admin - PPDB</title>
  <link rel="icon" type="image/x-icon" href="{{ asset('image/icon/icon.png') }}">
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: {
            hubot: ['"Hubot Sans"', 'sans-serif'],
            gabarito: ['"Gabarito"', 'sans-serif'],
            dmserif: ['"DM Serif Text"', 'serif'],
          },
          animation: {
            'fade-in': 'fadeIn 0.3s ease-in-out',
            'slide-in': 'slideIn 0.3s ease-out',
            'pulse-slow': 'pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite',
          },
          keyframes: {
            fadeIn: {
              '0%': { opacity: '0' },
              '100%': { opacity: '1' },
            },
            slideIn: {
              '0%': { transform: 'translateY(-10px)', opacity: '0' },
              '100%': { transform: 'translateY(0)', opacity: '1' },
            },
          },
        },
      },
    }
  </script>
  <link href="https://fonts.googleapis.com/css2?family=Gabarito:wght@400..900&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Hubot+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Text:ital@0;1&display=swap" rel="stylesheet">
</head>

<body class="bg-gradient-to-br from-gray-50 to-gray-100 font-hubot overflow-hidden">

  <div class="fixed top-0 left-0 right-0 bg-white shadow-md px-4 py-3 flex justify-between items-center md:hidden z-40">
    <div class="flex items-center gap-3">
      <img src="{{ asset('image/icon/icon.png') }}" alt="Logo" class="w-8 h-8">
      <h2 class="text-lg font-bold text-gray-800">Dashboard Admin</h2>
    </div>
    <button id="menuBtn" class="p-2 hover:bg-gray-100 rounded-lg transition-colors">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
      </svg>
    </button>
  </div>

  <div id="overlay" class="hidden fixed inset-0 bg-black bg-opacity-50 z-30 md:hidden transition-opacity"></div>

  <div class="flex h-screen">
    <aside id="sidebar" class="fixed md:static top-0 left-0 w-64 bg-white h-screen shadow-xl flex flex-col transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out z-50">
      
      <div class="flex flex-col items-center justify-center py-6 border-b border-gray-100">
        <img src="{{ asset('image/icon/icon.png') }}" alt="Logo Sekolah" class="w-20 h-20 mb-3 drop-shadow-md">
        <h1 class="text-lg font-bold text-gray-800">PPDB System</h1>
        <p class="text-xs text-gray-500">Admin Panel</p>
      </div>

      <div class="px-4 py-4 border-b border-gray-100">
        <div class="flex items-center gap-3 p-3 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-lg">
          <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-full flex items-center justify-center text-white font-bold shadow-md">
            {{ strtoupper(substr(Auth::user()->username ?? 'A', 0, 1)) }}
          </div>
          <div class="flex-1 min-w-0">
            <p class="text-sm font-semibold text-gray-800 truncate">{{ Auth::user()->username ?? 'Admin' }}</p>
            <p class="text-xs text-gray-500">Administrator</p>
          </div>
        </div>
      </div>

      <nav class="flex-1 p-4 overflow-y-auto">
        <ul class="space-y-2 text-gray-700 font-medium">

          <li>
            <a href="#" onclick="showPage('home')" class="nav-link flex items-center px-4 py-3 rounded-lg bg-gradient-to-r from-blue-50 to-indigo-50 hover:from-blue-100 hover:to-indigo-100 transition-all duration-200 group">
              <div class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center mr-3 group-hover:scale-110 transition-transform">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M10.707 1.293a1 1 0 00-1.414 0L2 8.586V18a2 2 0 002 2h4a1 1 0 001-1v-5h2v5a1 1 0 001 1h4a2 2 0 002-2V8.586l-7.293-7.293z"/>
                </svg>
              </div>
              <span class="font-semibold">Home</span>
            </a>
          </li>

          <li>
            <button class="w-full flex items-center justify-between px-4 py-3 rounded-lg hover:bg-gray-50 transition-all duration-200 group" onclick="toggleSubMenu('dataMenu')">
              <div class="flex items-center">
                <div class="w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center mr-3 group-hover:bg-gray-200 transition-colors">
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M3 4a1 1 0 100 2h14a1 1 0 100-2H3zM3 9a1 1 0 100 2h14a1 1 0 100-2H3zM3 14a1 1 0 100 2h14a1 1 0 100-2H3z"/>
                  </svg>
                </div>
                <span>Data</span>
              </div>
              <svg id="dataMenuIcon" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400 transition-transform duration-200" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 011.08 1.04l-4.25 4.25a.75.75 0 01-1.08 0L5.25 8.27a.75.75 0 01-.02-1.06z" clip-rule="evenodd"/>
              </svg>
            </button>

            <ul id="dataMenu" class="ml-8 mt-2 space-y-1 hidden">
              <li>
                <a href="#" onclick="showPage('dataPendaftar')" class="flex items-center px-4 py-2 rounded-lg hover:bg-gray-50 text-gray-700 transition-colors">
                  <div class="w-2 h-2 bg-blue-500 rounded-full mr-3"></div>
                  Data Pendaftar
                  <span class="ml-auto bg-blue-100 text-blue-600 text-xs px-2 py-1 rounded-full font-semibold">{{ $totalPendaftar }}</span>
                </a>
              </li>
              <li>
                <a href="#" onclick="showPage('dataAdmin')" class="flex items-center px-4 py-2 rounded-lg hover:bg-gray-50 text-gray-700 transition-colors">
                  <div class="w-2 h-2 bg-indigo-500 rounded-full mr-3"></div>
                  Data Admin
                  <span class="ml-auto bg-indigo-100 text-indigo-600 text-xs px-2 py-1 rounded-full font-semibold">{{ $totalAdmins }}</span>
                </a>
              </li>
            </ul>
          </li>

          <li>
            <button class="w-full flex items-center justify-between px-4 py-3 rounded-lg hover:bg-gray-50 transition-all duration-200 group" onclick="toggleSubMenu('seleksiMenu')">
              <div class="flex items-center">
                <div class="w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center mr-3 group-hover:bg-gray-200 transition-colors">
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                    <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"/>
                  </svg>
                </div>
                <span>Seleksi</span>
              </div>
              <svg id="seleksiMenuIcon" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400 transition-transform duration-200" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 011.08 1.04l-4.25 4.25a.75.75 0 01-1.08 0L5.25 8.27a.75.75 0 01-.02-1.06z" clip-rule="evenodd"/>
              </svg>
            </button>

            <ul id="seleksiMenu" class="ml-8 mt-2 space-y-1 hidden">
              <li>
                <a href="#" onclick="showPage('seleksiPeserta')" class="flex items-center px-4 py-2 rounded-lg hover:bg-gray-50 text-gray-700 transition-colors">
                  <div class="w-2 h-2 bg-green-500 rounded-full mr-3"></div>
                  Seleksi Peserta
                </a>
              </li>
              <li>
                <a href="#" onclick="showPage('periodeSeleksi')" class="flex items-center px-4 py-2 rounded-lg hover:bg-gray-50 text-gray-700 transition-colors">
                  <div class="w-2 h-2 bg-purple-500 rounded-full mr-3"></div>
                  Periode Seleksi
                </a>
              </li>
            </ul>
          </li>

          <li>
            <a href="#" onclick="showPage('settings')" class="nav-link flex items-center px-4 py-3 rounded-lg hover:bg-gray-50 transition-all duration-200 group">
              <div class="w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center mr-3 group-hover:bg-gray-200 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M11.3 1.046a1 1 0 00-2.6 0l-.374 1.17a1 1 0 01-.95.684H5.136a1 1 0 00-.707.293l-.829.829a1 1 0 00-.293.707v2.24a1 1 0 01-.684.95L1.453 8.7a1 1 0 000 2.6l1.17.374a1 1 0 01.684.95v2.24a1 1 0 00.293.707l.829.829a1 1 0 00.707.293h2.24a1 1 0 01.95.684l.374 1.17a1 1 0 002.6 0l.374-1.17a1 1 0 01.95-.684h2.24a1 1 0 00.707-.293l.829-.829a1 1 0 00.293-.707v-2.24a1 1 0 01.684-.95l1.17-.374a1 1 0 000-2.6l-1.17-.374a1 1 0 01-.684-.95v-2.24a1 1 0 00-.293-.707l-.829-.829a1 1 0 00-.707-.293h-2.24a1 1 0 01-.95-.684l-.374-1.17zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"/>
                </svg>
              </div>
              <span>Settings</span>
            </a>
          </li>

        </ul>
      </nav>

      <div class="p-4 border-t border-gray-100">
        <button type="button" onclick="showLogoutModal()" class="w-full flex items-center justify-center bg-gradient-to-r from-red-500 to-red-600 text-white py-3 px-4 rounded-lg hover:from-red-600 hover:to-red-700 transition-all duration-200 font-medium shadow-md hover:shadow-lg group">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 group-hover:translate-x-1 transition-transform" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h6a1 1 0 010 2H5v10h5a1 1 0 110 2H4a1 1 0 01-1-1V4zm11.293 5.293a1 1 0 011.414 0L18 11.586l-2.293 2.293a1 1 0 01-1.414-1.414L14.586 12H9a1 1 0 110-2h5.586l-1.293-1.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
          </svg>
          Logout
        </button>
      </div>
    </aside>

    <div class="flex-1 flex flex-col h-screen overflow-hidden pt-16 md:pt-0 md:ml-12">

      <div class="flex-1 overflow-y-auto">
        <div class="p-4 md:p-6 lg:p-8">
          
          <div id="homePage" class="page-content animate-fade-in">
            <header class="mb-8">
              <h1 class="text-2xl md:text-3xl lg:text-4xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent mb-2">
                Selamat Datang, <span id="usernameDisplay">{{ Auth::user()->username ?? 'Admin' }}</span>
              </h1>
              <p class="text-gray-500 text-sm md:text-base">Kelola sistem PPDB dengan mudah dan efisien</p>
            </header>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 mb-8">
              <div class="bg-gradient-to-br from-blue-500 to-blue-600 p-6 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 text-white relative overflow-hidden group">
                <div class="absolute top-0 right-0 w-24 h-24 bg-white opacity-10 rounded-full -mr-12 -mt-12 group-hover:scale-150 transition-transform duration-500"></div>
                <div class="relative z-10">
                  <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-white bg-opacity-20 rounded-xl flex items-center justify-center backdrop-blur-sm">
                      <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 3a3 3 0 100 6 3 3 0 000-6zM2 17a8 8 0 1116 0H2z"/>
                      </svg>
                    </div>
                  </div>
                  <h2 class="text-sm font-medium mb-1 opacity-90">Total Admin</h2>
                  <p class="text-4xl font-bold">{{ $totalAdmins }}</p>
                  <p class="text-xs mt-2 opacity-75">Administrator terdaftar</p>
                </div>
              </div>

              <div class="bg-gradient-to-br from-indigo-500 to-indigo-600 p-6 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 text-white relative overflow-hidden group">
                <div class="absolute top-0 right-0 w-24 h-24 bg-white opacity-10 rounded-full -mr-12 -mt-12 group-hover:scale-150 transition-transform duration-500"></div>
                <div class="relative z-10">
                  <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-white bg-opacity-20 rounded-xl flex items-center justify-center backdrop-blur-sm">
                      <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 3a3 3 0 100 6 3 3 0 000-6zM4 15a6 6 0 1112 0H4z"/>
                      </svg>
                    </div>
                  </div>
                  <h2 class="text-sm font-medium mb-1 opacity-90">Total Pendaftar</h2>
                  <p class="text-4xl font-bold">{{ $totalPendaftar }}</p>
                  <p class="text-xs mt-2 opacity-75">Calon siswa terdaftar</p>
                </div>
              </div>

              <div class="bg-gradient-to-br from-amber-500 to-orange-600 p-6 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 text-white relative overflow-hidden group">
                <div class="absolute top-0 right-0 w-24 h-24 bg-white opacity-10 rounded-full -mr-12 -mt-12 group-hover:scale-150 transition-transform duration-500"></div>
                <div class="relative z-10">
                  <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-white bg-opacity-20 rounded-xl flex items-center justify-center backdrop-blur-sm">
                      <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                      </svg>
                    </div>
                  </div>
                  <h2 class="text-sm font-medium mb-1 opacity-90">Menunggu Verifikasi</h2>
                  <p class="text-4xl font-bold">{{ $pendaftar->where('status_seleksi', 'Belum Diseleksi')->count() }}</p>
                  <p class="text-xs mt-2 opacity-75">Perlu ditindaklanjuti</p>
                </div>
              </div>

              <div class="bg-gradient-to-br from-green-500 to-emerald-600 p-6 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 text-white relative overflow-hidden group">
                <div class="absolute top-0 right-0 w-24 h-24 bg-white opacity-10 rounded-full -mr-12 -mt-12 group-hover:scale-150 transition-transform duration-500"></div>
                <div class="relative z-10">
                  <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-white bg-opacity-20 rounded-xl flex items-center justify-center backdrop-blur-sm">
                      <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                      </svg>
                    </div>
                  </div>
                  <h2 class="text-sm font-medium mb-1 opacity-90">Diterima</h2>
                  <p class="text-4xl font-bold">{{ $pendaftar->where('status_seleksi', 'Diterima')->count() }}</p>
                  <p class="text-xs mt-2 opacity-75">Calon siswa diterima</p>
                </div>
              </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
              <div class="bg-white rounded-2xl shadow-md border border-gray-100 p-6 hover:shadow-lg transition-shadow">
                <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-2 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M11 3a1 1 0 100 2h2.586l-6.293 6.293a1 1 0 101.414 1.414L15 6.414V9a1 1 0 102 0V4a1 1 0 00-1-1h-5z"/>
                    <path d="M5 5a2 2 0 00-2 2v8a2 2 0 002 2h8a2 2 0 002-2v-3a1 1 0 10-2 0v3H5V7h3a1 1 0 000-2H5z"/>
                  </svg>
                  Akses Cepat
                </h2>
                <div class="grid grid-cols-2 gap-3">
                  <button onclick="showPage('dataPendaftar')" class="p-4 bg-gradient-to-br from-blue-50 to-indigo-50 hover:from-blue-100 hover:to-indigo-100 rounded-xl transition-all duration-200 transform hover:scale-105 group">
                    <div class="flex flex-col items-center text-center">
                      <div class="w-12 h-12 bg-blue-500 rounded-xl flex items-center justify-center mb-2 group-hover:bg-blue-600 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                          <path d="M10 3a3 3 0 100 6 3 3 0 000-6zM4 15a6 6 0 1112 0H4z"/>
                        </svg>
                      </div>
                      <span class="text-sm font-semibold text-gray-700">Data Pendaftar</span>
                    </div>
                  </button>
                  
                  <button onclick="showPage('seleksiPeserta')" class="p-4 bg-gradient-to-br from-green-50 to-emerald-50 hover:from-green-100 hover:to-emerald-100 rounded-xl transition-all duration-200 transform hover:scale-105 group">
                    <div class="flex flex-col items-center text-center">
                      <div class="w-12 h-12 bg-green-500 rounded-xl flex items-center justify-center mb-2 group-hover:bg-green-600 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                          <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                          <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"/>
                        </svg>
                      </div>
                      <span class="text-sm font-semibold text-gray-700">Seleksi Peserta</span>
                    </div>
                  </button>
                  
                  <button onclick="showPage('periodeSeleksi')" class="p-4 bg-gradient-to-br from-purple-50 to-pink-50 hover:from-purple-100 hover:to-pink-100 rounded-xl transition-all duration-200 transform hover:scale-105 group">
                    <div class="flex flex-col items-center text-center">
                      <div class="w-12 h-12 bg-purple-500 rounded-xl flex items-center justify-center mb-2 group-hover:bg-purple-600 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                          <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                        </svg>
                      </div>
                      <span class="text-sm font-semibold text-gray-700">Periode Seleksi</span>
                    </div>
                  </button>
                  
                  <button onclick="showPage('dataAdmin')" class="p-4 bg-gradient-to-br from-orange-50 to-red-50 hover:from-orange-100 hover:to-red-100 rounded-xl transition-all duration-200 transform hover:scale-105 group">
                    <div class="flex flex-col items-center text-center">
                      <div class="w-12 h-12 bg-orange-500 rounded-xl flex items-center justify-center mb-2 group-hover:bg-orange-600 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                          <path d="M10 3a3 3 0 100 6 3 3 0 000-6zM2 17a8 8 0 1116 0H2z"/>
                        </svg>
                      </div>
                      <span class="text-sm font-semibold text-gray-700">Data Admin</span>
                    </div>
                  </button>
                </div>
              </div>

              <div class="bg-gradient-to-br from-blue-500 to-indigo-600 rounded-2xl shadow-md p-6 text-white">
                <h2 class="text-xl font-semibold mb-4 flex items-center">
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                  </svg>
                  Informasi Penting
                </h2>
                <div class="space-y-4">
                  <div class="flex items-start gap-3 p-3 bg-white bg-opacity-10 rounded-lg backdrop-blur-sm hover:bg-opacity-20 transition-all">
                    <div class="w-2 h-2 bg-white rounded-full mt-2 flex-shrink-0 animate-pulse"></div>
                    <p class="text-sm">Sistem pendaftaran siswa baru telah dibuka dan siap menerima pendaftar</p>
                  </div>
                  <div class="flex items-start gap-3 p-3 bg-white bg-opacity-10 rounded-lg backdrop-blur-sm hover:bg-opacity-20 transition-all">
                    <div class="w-2 h-2 bg-white rounded-full mt-2 flex-shrink-0 animate-pulse"></div>
                    <p class="text-sm">Periksa dan verifikasi data pendaftar secara berkala untuk kelancaran proses</p>
                  </div>
                  <div class="flex items-start gap-3 p-3 bg-white bg-opacity-10 rounded-lg backdrop-blur-sm hover:bg-opacity-20 transition-all">
                    <div class="w-2 h-2 bg-white rounded-full mt-2 flex-shrink-0 animate-pulse"></div>
                    <p class="text-sm">Hubungi administrator sistem jika mengalami kendala teknis atau memerlukan bantuan</p>
                  </div>
                </div>
              </div>
            </div>

            <div class="bg-white rounded-2xl shadow-md border border-gray-100 p-6">
              <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center justify-between">
                <span class="flex items-center">
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-2 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                  </svg>
                  Aktivitas Terbaru
                </span>
                <span class="text-xs text-gray-500 font-normal">{{ now()->format('d M Y, H:i') }}</span>
              </h2>
              <div class="space-y-3">
                @forelse($pendaftar->take(5) as $index => $p)
                <div class="flex items-center gap-4 p-3 hover:bg-gray-50 rounded-lg transition-colors border border-gray-100">
                  <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-full flex items-center justify-center text-white font-bold flex-shrink-0 shadow-md">
                    {{ strtoupper(substr($p->nama_pendaftar ?? 'U', 0, 1)) }}
                  </div>
                  <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold text-gray-800 truncate">{{ $p->nama_pendaftar ?? 'Nama tidak tersedia' }}</p>
                    <p class="text-xs text-gray-500">Pendaftar baru • NISN: {{ $p->nisn_pendaftar ?? '-' }}</p>
                  </div>
                  <div class="flex-shrink-0">
                    @if($p->status_seleksi == 'Diterima')
                      <span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-full">Diterima</span>
                    @elseif($p->status_seleksi == 'Ditolak')
                      <span class="px-3 py-1 bg-red-100 text-red-700 text-xs font-semibold rounded-full">Ditolak</span>
                    @else
                      <span class="px-3 py-1 bg-amber-100 text-amber-700 text-xs font-semibold rounded-full">Pending</span>
                    @endif
                  </div>
                </div>
                @empty
                <div class="text-center py-8 text-gray-500">
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 mx-auto mb-3 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                  </svg>
                  <p class="text-sm">Belum ada aktivitas terbaru</p>
                </div>
                @endforelse
              </div>
            </div>
          </div>

          <div id="dataPendaftarPage" class="page-content hidden">
            @include('admin.datapendaftar')
          </div>

          <div id="dataAdminPage" class="page-content hidden">
            @include('admin.dataadmin')
          </div>

          <div id="seleksiPesertaPage" class="page-content hidden">
            @include('admin.seleksipeserta')
          </div>

          <div id="periodeSeleksiPage" class="page-content hidden">
            @include('admin.periodeseleksi')
          </div>

          <div id="settingsPage" class="page-content hidden">
            @include('admin.setting')    
          </div>

        </div>
      </div>
    </div>
  </div>

  <div id="logoutModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4 backdrop-blur-sm">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md transform transition-all animate-slide-in">
      <div class="p-6 md:p-8">
        <div class="flex justify-center mb-6">
          <div class="w-20 h-20 bg-gradient-to-br from-red-100 to-red-200 rounded-full flex items-center justify-center shadow-lg">
            <svg class="w-10 h-10 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
            </svg>
          </div>
        </div>

        <h3 class="text-2xl md:text-3xl font-bold text-gray-900 text-center mb-3">Konfirmasi Logout</h3>
        <p class="text-gray-600 text-center mb-8">
          Apakah Anda yakin ingin keluar dari sistem?
        </p>

        <div class="flex flex-col sm:flex-row gap-3">
          <button type="button" onclick="closeLogoutModal()" class="flex-1 px-6 py-3 border-2 border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 transition-all duration-200 font-semibold hover:border-gray-400">
            Batal
          </button>
          <form action="{{ route('logout') }}" method="POST" class="flex-1">
            @csrf
            <button type="submit" class="w-full px-6 py-3 bg-gradient-to-r from-red-500 to-red-600 text-white rounded-xl hover:from-red-600 hover:to-red-700 transition-all duration-200 font-semibold shadow-md hover:shadow-lg">
              Ya, Logout
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script src="{{ asset('js/admin-dashboard.js') }}"></script>
</body>
</html>

<script>
const sidebar = document.getElementById('sidebar');
const overlay = document.getElementById('overlay');
const menuBtn = document.getElementById('menuBtn');

if (menuBtn && sidebar && overlay) {
  menuBtn.addEventListener('click', function() {
    sidebar.classList.toggle('-translate-x-full');
    overlay.classList.toggle('hidden');
    document.body.style.overflow = sidebar.classList.contains('-translate-x-full') ? 'auto' : 'hidden';
  });

  overlay.addEventListener('click', function() {
    sidebar.classList.add('-translate-x-full');
    overlay.classList.add('hidden');
    document.body.style.overflow = 'auto';
  });
}

function showPage(pageName) {
  document.querySelectorAll('.page-content').forEach(page => {
    page.classList.add('hidden');
    page.classList.remove('animate-fade-in');
  });

  document.querySelectorAll('.nav-link').forEach(link => {
    link.classList.remove('bg-gradient-to-r', 'from-blue-50', 'to-indigo-50');
    link.classList.add('hover:bg-gray-50');
  });

  const pageMap = {
    home: 'homePage',
    dataPendaftar: 'dataPendaftarPage',
    dataAdmin: 'dataAdminPage',
    seleksiPeserta: 'seleksiPesertaPage',
    periodeSeleksi: 'periodeSeleksiPage',
    settings: 'settingsPage'
  };

  const pageId = pageMap[pageName];
  if (pageId) {
    const page = document.getElementById(pageId);
    if (page) {
      page.classList.remove('hidden');
      page.classList.add('animate-fade-in');
    }
  }

  const activeLink = event?.target?.closest('.nav-link');
  if (activeLink) {
    activeLink.classList.remove('hover:bg-gray-50');
    activeLink.classList.add('bg-gradient-to-r', 'from-blue-50', 'to-indigo-50');
  }

  if (window.innerWidth < 768 && sidebar && overlay) {
    sidebar.classList.add('-translate-x-full');
    overlay.classList.add('hidden');
    document.body.style.overflow = 'auto';
  }

  window.scrollTo({ top: 0, behavior: 'smooth' });
}

function toggleSubMenu(menuId) {
  const menu = document.getElementById(menuId);
  const icon = document.getElementById(menuId + 'Icon');
  
  if (menu && icon) {
    menu.classList.toggle('hidden');
    icon.classList.toggle('rotate-180');
  }
}

function showLogoutModal() {
  const modal = document.getElementById('logoutModal');
  if (modal) {
    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
  }
}

function closeLogoutModal() {
  const modal = document.getElementById('logoutModal');
  if (modal) {
    modal.classList.add('hidden');
    document.body.style.overflow = 'auto';
  }
}

function openAddAdminModal() {
  const modal = document.getElementById('addAdminModal');
  if (modal) {
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    document.body.style.overflow = 'hidden';
  }
}

function closeAddAdminModal() {
  const modal = document.getElementById('addAdminModal');
  if (modal) {
    modal.classList.add('hidden');
    modal.classList.remove('flex');
    document.body.style.overflow = 'auto';
    
    const form = modal.querySelector('form');
    if (form) form.reset();
  }
}

function openEditAdminModal(id, username, nama_panitia, email) {
  const modal = document.getElementById('editAdminModal');
  const form = document.getElementById('editAdminForm');
  
  if (modal && form) {
    form.action = `/admin/admin/${id}/update`;
    
    const usernameField = document.getElementById('editAdminUsername');
    const namaPanitiaField = document.getElementById('editAdminNamaPanitia');
    const emailField = document.getElementById('editAdminEmail');
    
    if (usernameField) usernameField.value = username || '';
    if (namaPanitiaField) namaPanitiaField.value = nama_panitia || '';
    if (emailField) emailField.value = email || '';
    
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    document.body.style.overflow = 'hidden';
  }
}

function closeEditAdminModal() {
  const modal = document.getElementById('editAdminModal');
  if (modal) {
    modal.classList.add('hidden');
    modal.classList.remove('flex');
    document.body.style.overflow = 'auto';
    
    const form = document.getElementById('editAdminForm');
    if (form) form.reset();
  }
}

function openConfirmModal(element, url, method) {
  if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = url;
    
    const csrfToken = document.querySelector('meta[name="csrf-token"]');
    if (csrfToken) {
      const csrfInput = document.createElement('input');
      csrfInput.type = 'hidden';
      csrfInput.name = '_token';
      csrfInput.value = csrfToken.content;
      form.appendChild(csrfInput);
    }
    
    if (method === 'DELETE') {
      const methodInput = document.createElement('input');
      methodInput.type = 'hidden';
      methodInput.name = '_method';
      methodInput.value = 'DELETE';
      form.appendChild(methodInput);
    }
    
    document.body.appendChild(form);
    form.submit();
  }
}

function openStatusModal(userId, namaPendaftar, currentStatus) {
  const modal = document.getElementById('statusModal');
  const form = document.getElementById('statusForm');
  const modalNama = document.getElementById('modalNama');
  const modalStatus = document.getElementById('modalStatus');
  const modalCatatan = document.getElementById('modalCatatan');
  
  if (modal && form) {
    form.action = `/admin/seleksi/${userId}/update-status`;
    
    const methodInput = document.getElementById('formMethod');
    if (methodInput) methodInput.value = 'PUT';
    
    if (modalNama) modalNama.value = namaPendaftar;
    if (modalStatus) modalStatus.value = currentStatus !== 'Belum Diseleksi' ? currentStatus : '';
    if (modalCatatan) modalCatatan.value = '';
    
    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
  }
}

function closeStatusModal() {
  const modal = document.getElementById('statusModal');
  if (modal) {
    modal.classList.add('hidden');
    document.body.style.overflow = 'auto';
  }
}

function openAddModal() {
  const modal = document.getElementById('addModal');
  const form = document.getElementById('addForm');
  
  if (modal && form) {
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    form.reset();
    document.body.style.overflow = 'hidden';
  }
}

function closeAddModal() {
  const modal = document.getElementById('addModal');
  if (modal) {
    modal.classList.add('hidden');
    modal.classList.remove('flex');
    document.body.style.overflow = 'auto';
  }
}

function openEditPeriodeModal(btn) {
  const modal = document.getElementById('editPeriodeModal');
  const form = document.getElementById('editPeriodeForm');
  
  if (modal && form) {
    modal.classList.remove('hidden');
    modal.classList.add('flex');

    document.getElementById('edit_nama').value = btn.dataset.nama;
    document.getElementById('edit_kuota').value = btn.dataset.kuota;
    document.getElementById('edit_mulai').value = btn.dataset.mulai;
    document.getElementById('edit_selesai').value = btn.dataset.selesai;
    document.getElementById('edit_batas').value = btn.dataset.batas;
    document.getElementById('edit_status').value = btn.dataset.status;
    document.getElementById('edit_keterangan').value = btn.dataset.keterangan ?? '';

    form.action = `/admin/periode/${btn.dataset.id}`;
    document.body.style.overflow = 'hidden';
  }
}

function closeEditPeriodeModal() {
  const modal = document.getElementById('editPeriodeModal');
  if (modal) {
    modal.classList.add('hidden');
    modal.classList.remove('flex');
    document.body.style.overflow = 'auto';
  }
}

function confirmReset(periodeId) {
  if (confirm('⚠️ PERINGATAN!\n\nAnda akan mereset semua hasil seleksi periode ini.\nSemua status akan kembali ke "Belum Diseleksi".\n\nApakah Anda yakin?')) {
    const resetForm = document.getElementById('resetForm');
    const resetPeriodeId = document.getElementById('resetPeriodeId');
    
    if (resetForm && resetPeriodeId) {
      resetPeriodeId.value = periodeId;
      resetForm.submit();
    }
  }
}

let currentPage = 1;
const rowsPerPage = 25;
let filteredRows = [];

function updatePagination() {
  const rows = document.querySelectorAll('#tableBody .data-row');
  const searchInput = document.getElementById('searchInput');
  const searchValue = searchInput ? searchInput.value.toLowerCase() : '';
  
  filteredRows = Array.from(rows).filter(row => {
    const text = row.textContent.toLowerCase();
    return text.includes(searchValue);
  });

  const totalRows = filteredRows.length;
  const totalPages = Math.ceil(totalRows / rowsPerPage);
  
  rows.forEach(row => row.style.display = 'none');
  
  const start = (currentPage - 1) * rowsPerPage;
  const end = start + rowsPerPage;
  
  filteredRows.slice(start, end).forEach(row => {
    row.style.display = '';
  });
  
  const showingStart = document.getElementById('showingStart');
  const showingEnd = document.getElementById('showingEnd');
  const totalData = document.getElementById('totalData');
  
  if (showingStart) showingStart.textContent = totalRows > 0 ? start + 1 : 0;
  if (showingEnd) showingEnd.textContent = Math.min(end, totalRows);
  if (totalData) totalData.textContent = totalRows;
  
  const prevBtn = document.getElementById('prevBtn');
  const nextBtn = document.getElementById('nextBtn');
  
  if (prevBtn) prevBtn.disabled = currentPage === 1;
  if (nextBtn) nextBtn.disabled = currentPage >= totalPages || totalRows === 0;
  
  filteredRows.forEach((row, index) => {
    const numberCell = row.querySelector('td:first-child');
    if (numberCell) {
      numberCell.textContent = index + 1;
    }
  });
}

function openEditModal(userId) {
  fetch(`/admin/pendaftar/${userId}/edit`)
    .then(response => response.json())
    .then(data => {
      const fields = {
        'editNama': data.nama_pendaftar,
        'editNISN': data.nisn_pendaftar,
        'editTanggal': data.tanggallahir_pendaftar,
        'editAlamat': data.alamat_pendaftar,
        'editAgama': data.agama,
        'editOrtu': data.nama_ortu,
        'editPekerjaan': data.pekerjaan_ortu,
        'editHP': data.no_hp_ortu
      };
      
      Object.keys(fields).forEach(key => {
        const element = document.getElementById(key);
        if (element) element.value = fields[key] || '';
      });
      
      const form = document.getElementById('editForm');
      if (form) form.action = `/admin/pendaftar/${userId}/update`;
      
      const modal = document.getElementById('editModal');
      if (modal) {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.style.overflow = 'hidden';
      }
    })
    .catch(error => {
      console.error('Error:', error);
      alert('Gagal memuat data pendaftar');
    });
}

function closeEditModal() {
  const modal = document.getElementById('editModal');
  if (modal) {
    modal.classList.add('hidden');
    modal.classList.remove('flex');
    document.body.style.overflow = 'auto';
  }
}

function showBerkas(userId) {
  fetch(`/admin/pendaftar/${userId}/berkas`)
    .then(response => response.json())
    .then(data => {
      if (data.berkas && (data.berkas.kartu_keluarga || data.berkas.akta_kelahiran || data.berkas.ijazah)) {
        let berkasContent = '<div class="grid grid-cols-1 gap-4">';
        
        const berkasTypes = [
          { key: 'kartu_keluarga', label: 'Kartu Keluarga' },
          { key: 'akta_kelahiran', label: 'Akta Kelahiran' },
          { key: 'ijazah', label: 'Ijazah' }
        ];
        
        berkasTypes.forEach(type => {
          if (data.berkas[type.key]) {
            berkasContent += `
              <div class="border rounded-xl p-4 hover:shadow-md transition-shadow">
                <h3 class="font-semibold mb-3 text-gray-800">${type.label}</h3>
                <a href="${data.berkas[type.key]}" target="_blank" 
                   class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-500 to-indigo-600 text-white rounded-lg hover:from-blue-600 hover:to-indigo-700 transition-all shadow-md hover:shadow-lg">
                  <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                  </svg>
                  Lihat Berkas
                </a>
              </div>
            `;
          }
        });
        
        berkasContent += '</div>';
        
        const modal = document.createElement('div');
        modal.id = 'berkasModal';
        modal.className = 'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 backdrop-blur-sm p-4';
        modal.innerHTML = `
          <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl p-6 relative max-h-[90vh] overflow-y-auto animate-slide-in">
            <button onclick="closeBerkasModal()" class="absolute top-4 right-4 w-10 h-10 flex items-center justify-center text-gray-400 hover:text-gray-700 hover:bg-gray-100 rounded-full transition-all">&times;</button>
            <h2 class="text-2xl font-bold mb-6 text-gray-800">Berkas Pendaftar</h2>
            ${berkasContent}
          </div>
        `;
        
        document.body.appendChild(modal);
        document.body.style.overflow = 'hidden';
      } else {
        alert('Berkas tidak ditemukan');
      }
    })
    .catch(error => {
      console.error('Error:', error);
      alert('Gagal memuat berkas');
    });
}

function closeBerkasModal() {
  const modal = document.getElementById('berkasModal');
  if (modal) {
    modal.remove();
    document.body.style.overflow = 'auto';
  }
}

document.addEventListener('DOMContentLoaded', function() {
  if (document.getElementById('tableBody')) {
    updatePagination();
  }
  
  const prevBtn = document.getElementById('prevBtn');
  const nextBtn = document.getElementById('nextBtn');
  
  if (prevBtn) {
    prevBtn.addEventListener('click', () => {
      if (currentPage > 1) {
        currentPage--;
        updatePagination();
      }
    });
  }
  
  if (nextBtn) {
    nextBtn.addEventListener('click', () => {
      const totalPages = Math.ceil(filteredRows.length / rowsPerPage);
      if (currentPage < totalPages) {
        currentPage++;
        updatePagination();
      }
    });
  }
  
  const searchInput = document.getElementById('searchInput');
  if (searchInput) {
    searchInput.addEventListener('input', () => {
      currentPage = 1;
      updatePagination();
    });
  }
  
  const editForm = document.getElementById('editForm');
  if (editForm) {
    editForm.addEventListener('submit', function(e) {
      e.preventDefault();
      
      const formData = new FormData(this);
      const url = this.action;
      
      fetch(url, {
        method: 'POST',
        body: formData,
        headers: {
          'X-Requested-With': 'XMLHttpRequest'
        }
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          alert('Data berhasil diperbarui!');
          location.reload();
        } else {
          alert(data.message || 'Gagal memperbarui data');
        }
      })
      .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat memperbarui data');
      });
    });
  }
  
  const modals = [
    'addAdminModal',
    'editAdminModal', 
    'editModal',
    'confirmModal',
    'statusModal',
    'logoutModal',
    'addModal',
    'editPeriodeModal'
  ];
  
  modals.forEach(modalId => {
    const modal = document.getElementById(modalId);
    if (modal) {
      modal.addEventListener('click', function(e) {
        if (e.target === this) {
          switch(modalId) {
            case 'addAdminModal': closeAddAdminModal(); break;
            case 'editAdminModal': closeEditAdminModal(); break;
            case 'editModal': closeEditModal(); break;
            case 'statusModal': closeStatusModal(); break;
            case 'logoutModal': closeLogoutModal(); break;
            case 'addModal': closeAddModal(); break;
            case 'editPeriodeModal': closeEditPeriodeModal(); break;
          }
        }
      });
    }
  });
  
  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
      closeAddAdminModal();
      closeEditAdminModal();
      closeEditModal();
      closeBerkasModal();
      closeStatusModal();
      closeLogoutModal();
      closeAddModal();
      closeEditPeriodeModal();
    }
  });

  const alerts = document.querySelectorAll('.alert-auto-hide');
  alerts.forEach(alert => {
    setTimeout(() => {
      alert.style.transition = 'opacity 0.5s';
      alert.style.opacity = '0';
      setTimeout(() => alert.remove(), 500);
    }, 5000);
  });
});

function formatDate(dateString) {
  const options = { year: 'numeric', month: 'long', day: 'numeric' };
  return new Date(dateString).toLocaleDateString('id-ID', options);
}

function formatCurrency(amount) {
  return new Intl.NumberFormat('id-ID', { 
    style: 'currency', 
    currency: 'IDR',
    minimumFractionDigits: 0
  }).format(amount);
}

window.showPage = showPage;
window.toggleSubMenu = toggleSubMenu;
window.showLogoutModal = showLogoutModal;
window.closeLogoutModal = closeLogoutModal;
window.openAddAdminModal = openAddAdminModal;
window.closeAddAdminModal = closeAddAdminModal;
window.openEditAdminModal = openEditAdminModal;
window.closeEditAdminModal = closeEditAdminModal;
window.openConfirmModal = openConfirmModal;
window.openStatusModal = openStatusModal;
window.closeStatusModal = closeStatusModal;
window.openAddModal = openAddModal;
window.closeAddModal = closeAddModal;
window.openEditPeriodeModal = openEditPeriodeModal;
window.closeEditPeriodeModal = closeEditPeriodeModal;
window.confirmReset = confirmReset;
window.updatePagination = updatePagination;
window.openEditModal = openEditModal;
window.closeEditModal = closeEditModal;
window.showBerkas = showBerkas;
window.closeBerkasModal = closeBerkasModal;
</script>