<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Akun - Veritas School</title>
  
  <link rel="icon" type="image/x-icon" href="{{ asset('image/icon/icon.png') }}">
  
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  
  <script src="https://cdn.tailwindcss.com"></script>
  
  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: {
            hubot: ['"Hubot Sans"', 'sans-serif'],
            gabarito: ['"Gabarito"', 'sans-serif'],
            dmserif: ['"DM Serif Text"', 'serif'],
          },
        },
      },
    }
  </script>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Gabarito:wght@400..900&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Hubot+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Text:ital@0;1&display=swap" rel="stylesheet">

  <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
  
  <style>
    body {
      font-family: 'Hubot Sans', sans-serif;
    }
  </style>
</head>

<body class="bg-[#fafbfc] overflow-hidden">

<!-- Preloader -->
<div 
    x-data="{ loading: true }" 
    x-init="window.addEventListener('load', () => setTimeout(() => loading = false, 300))" 
    x-show="loading"
    x-transition.opacity.duration.700ms
    class="fixed inset-0 bg-white flex flex-col items-center justify-center z-[9999]"
>
    <img src="{{ asset('image/icon/icon.png') }}" alt="Logo" class="w-28 h-28 mb-8">
    <div class="w-16 h-16 border-4 border-t-blue-600 border-b-blue-300 border-l-blue-200 border-r-blue-400 rounded-full animate-spin"></div>
</div>

<!-- Main Container -->
<div class="h-screen w-screen overflow-hidden">

  
  <div class="w-full h-full bg-white overflow-hidden">
    
    <div class="grid lg:grid-cols-2 gap-0 h-full">
      
      <!-- Left Column - Registration Form -->
      <div class="p-8 sm:p-12 lg:p-16 flex flex-col justify-center overflow-y-auto">
        
        <!-- Logo -->
        <div class="mb-8">
          <img src="{{ asset('image/icon/icon.png') }}" alt="Logo Sekolah" class="h-14 w-14 object-contain">
        </div>
        
        <!-- Header -->
        <div class="mb-10">
          <h1 class="font-gabarito text-4xl font-bold text-gray-900 mb-3">
            Daftar Akun
          </h1>
          <p class="text-gray-600 text-base leading-relaxed">
            Bergabunglah dengan keluarga besar Veritas School dan mulai perjalanan pendidikan Anda bersama kami.
          </p>
        </div>

        <!-- Registration Form -->
        <form method="POST" action="{{ route('register') }}" class="space-y-6">
          @csrf
          
          <!-- Username Field -->
          <div>
            <label for="username" class="block text-sm font-medium text-gray-700 mb-2">
              Username
            </label>
            <input 
              id="username" 
              type="text" 
              name="username" 
              value="{{ old('username') }}" 
              required 
              autofocus
              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-transparent transition outline-none text-gray-900"
              placeholder="Pilih username Anda"
            >
            @error('username')
              <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
          </div>

          <!-- Email Field -->
          <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
              Email
            </label>
            <input 
              id="email" 
              type="email" 
              name="email" 
              value="{{ old('email') }}" 
              required
              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-transparent transition outline-none text-gray-900"
              placeholder="email@example.com"
            >
            @error('email')
              <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
          </div>

          <!-- Phone Number Field -->
          <div>
            <label for="no_hp" class="block text-sm font-medium text-gray-700 mb-2">
              Nomor HP
            </label>
            <input 
              id="no_hp" 
              type="text" 
              name="no_hp" 
              value="{{ old('no_hp') }}" 
              required
              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-transparent transition outline-none text-gray-900"
              placeholder="08xxxxxxxxxx"
            >
            @error('no_hp')
              <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
          </div>

          <!-- Password Field -->
          <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
              Password
            </label>
            <input 
              id="password" 
              type="password" 
              name="password" 
              required
              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-transparent transition outline-none text-gray-900"
              placeholder="Buat password yang kuat"
            >
            @error('password')
              <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
          </div>

          <!-- Password Confirmation Field -->
          <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
              Konfirmasi Password
            </label>
            <input 
              id="password_confirmation" 
              type="password" 
              name="password_confirmation" 
              required
              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-transparent transition outline-none text-gray-900"
              placeholder="Ketik ulang password Anda"
            >
            @error('password_confirmation')
              <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
          </div>

          <!-- Register Button -->
          <button 
            type="submit" 
            class="w-full py-3.5 px-4 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-200 transition duration-200 mt-2"
          >
            Daftar Sekarang
          </button>
        </form>

        <!-- Login Link -->
        <p class="text-center mt-8 text-gray-600 text-sm">
          Sudah memiliki akun? 
          <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-700 font-semibold transition">
            Masuk di sini
          </a>
        </p>

      </div>

      <!-- Right Column - Carousel -->
      <div 
        class="bg-blue-600 p-8 sm:p-12 lg:p-16 flex flex-col justify-center items-center relative"
        x-data="{
          currentSlide: 0,
          slides: [
            {
              title: 'Pembelajaran Berkualitas',
              description: 'Sistem pendidikan modern dengan fokus pada pengembangan karakter dan akademik siswa.',
              image: 'https://media.istockphoto.com/id/2172127765/photo/business-team-talking-during-break.webp?a=1&b=1&s=612x612&w=0&k=20&c=GJRtd5eDQTZClgu0NgkA70IdIOUXvuIBPGYay_1RNCA='
            },
            {
              title: 'Fasilitas Lengkap',
              description: 'Ruang kelas nyaman, laboratorium canggih, dan area olahraga yang mendukung kegiatan belajar.',
              image: 'https://images.unsplash.com/photo-1509062522246-3755977927d7?w=800&q=80'
            },
            {
              title: 'Komunitas Solid',
              description: 'Bergabunglah dengan keluarga besar Veritas School dan kembangkan potensi terbaik Anda.',
              image: 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=800&q=80'
            }
          ],
          autoplay: null,
          init() {
            this.startAutoplay();
          },
          startAutoplay() {
            this.autoplay = setInterval(() => {
              this.nextSlide();
            }, 5000);
          },
          stopAutoplay() {
            if (this.autoplay) {
              clearInterval(this.autoplay);
            }
          },
          nextSlide() {
            this.currentSlide = (this.currentSlide + 1) % this.slides.length;
          },
          goToSlide(index) {
            this.stopAutoplay();
            this.currentSlide = index;
            this.startAutoplay();
          }
        }"
      >
        
        <!-- Carousel Content -->
        <div class="w-full max-w-md">
          
          <!-- Image Container -->
          <div class="relative mb-8 rounded-2xl overflow-hidden shadow-lg" style="height: 320px;">
            <template x-for="(slide, index) in slides" :key="index">
              <div 
                x-show="currentSlide === index"
                x-transition:enter="transition ease-out duration-500"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-500"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="absolute inset-0"
              >
                <img 
                  :src="slide.image" 
                  :alt="slide.title"
                  class="w-full h-full object-cover"
                >
              </div>
            </template>
          </div>

          <!-- Indicators -->
          <div class="flex justify-center gap-2 mb-6">
            <template x-for="(slide, index) in slides" :key="index">
              <button
                @click="goToSlide(index)"
                class="transition-all duration-300 rounded-full"
                :class="currentSlide === index ? 'w-8 h-2 bg-white' : 'w-2 h-2 bg-white/40 hover:bg-white/60'"
                :aria-label="'Go to slide ' + (index + 1)"
              ></button>
            </template>
          </div>

          <!-- Text Content -->
          <div class="text-center">
            <template x-for="(slide, index) in slides" :key="index">
              <div 
                x-show="currentSlide === index"
                x-transition:enter="transition ease-out duration-500 delay-100"
                x-transition:enter-start="opacity-0 translate-y-4"
                x-transition:enter-end="opacity-100 translate-y-0"
              >
                <h3 
                  class="font-gabarito text-2xl font-bold text-white mb-3"
                  x-text="slide.title"
                ></h3>
                <p 
                  class="text-white/90 leading-relaxed"
                  x-text="slide.description"
                ></p>
              </div>
            </template>
          </div>

        </div>

      </div>

    </div>

  </div>

</div>

</body>
</html>