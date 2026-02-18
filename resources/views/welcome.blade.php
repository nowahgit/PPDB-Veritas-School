<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PPDB {{ date('Y') }}/{{ date('Y') + 1 }} — Veritas School</title>
  <link rel="icon" type="image/x-icon" href="{{ asset('image/icon/icon.png') }}">
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: {
            sans: ['Outfit', 'Inter', 'system-ui', 'sans-serif'],
            display: ['Outfit', 'Inter', 'system-ui', 'sans-serif']
          },
          colors: {
            brand: {
              50: '#eff6ff',
              100: '#dbeafe',
              200: '#bfdbfe',
              300: '#93c5fd',
              400: '#60a5fa',
              500: '#3b82f6',
              600: '#2563eb',
              700: '#1d4ed8',
              800: '#1e40af',
              900: '#1e3a8a',
            }
          },
          animation: {
            'fade-in-up': 'fadeInUp 0.8s ease-out forwards',
            'fade-in': 'fadeIn 1s ease-out forwards',
            'float': 'float 6s ease-in-out infinite',
          },
          keyframes: {
            fadeInUp: {
              '0%': { opacity: '0', transform: 'translateY(20px)' },
              '100%': { opacity: '1', transform: 'translateY(0)' },
            },
            fadeIn: {
              '0%': { opacity: '0' },
              '100%': { opacity: '1' },
            },
            float: {
              '0%, 100%': { transform: 'translateY(0)' },
              '50%': { transform: 'translateY(-20px)' },
            }
          }
        },
      },
    }
  </script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap"
    rel="stylesheet">
  <style>
    html {
      scroll-behavior: smooth;
    }

    body {
      font-family: 'Outfit', sans-serif;
    }

    .glass {
      background: rgba(255, 255, 255, 0.7);
      backdrop-filter: blur(12px);
      -webkit-backdrop-filter: blur(12px);
    }

    .text-gradient {
      background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    .bg-mesh {
      background-color: #ffffff;
      background-image:
        radial-gradient(at 0% 0%, rgba(59, 130, 246, 0.05) 0px, transparent 50%),
        radial-gradient(at 100% 0%, rgba(30, 64, 175, 0.05) 0px, transparent 50%);
    }

    ::-webkit-scrollbar {
      width: 8px;
    }

    ::-webkit-scrollbar-track {
      background: #f1f1f1;
    }

    ::-webkit-scrollbar-thumb {
      background: #cbd5e1;
      border-radius: 10px;
    }

    ::-webkit-scrollbar-thumb:hover {
      background: #94a3b8;
    }

    .reveal {
      opacity: 0;
      transform: translateY(30px);
      transition: all 0.8s ease-out;
    }

    .reveal.active {
      opacity: 1;
      transform: translateY(0);
    }
  </style>
</head>

<body class="bg-white text-gray-800 antialiased overflow-x-hidden">

  @include('landing.partials.navbar')

  @if(session('error'))
    <div class="bg-red-50 border-b border-red-200 px-4 py-3 text-center text-sm text-red-800">
      {{ session('error') }}
    </div>
  @endif

  <main>
    @include('landing.hero-section')
    @include('landing.about-section')
    @include('landing.alur-section')
    @include('landing.info-section')
    @include('landing.news-section')
    @include('landing.testminoials')
  </main>

  @include('landing.partials.footer')

  <script>
    function reveal() {
      var reveals = document.querySelectorAll(".reveal");
      for (var i = 0; i < reveals.length; i++) {
        var windowHeight = window.innerHeight;
        var elementTop = reveals[i].getBoundingClientRect().top;
        var elementVisible = 150;
        if (elementTop < windowHeight - elementVisible) {
          reveals[i].classList.add("active");
        }
      }
    }
    window.addEventListener("scroll", reveal);
    // To check the scroll position on page load
    reveal();
  </script>
</body>

</html>