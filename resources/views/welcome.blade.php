<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Veritas School - Nurturing Future Changemakers</title>

  <link rel="icon" type="image/x-icon" href="{{ asset('image/icon/icon.png') }}">

  <!-- ✅ Tailwind CDN -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- ✅ Konfigurasi Tailwind inline -->
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

  <!-- ✅ Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Gabarito:wght@400..900&family=Hubot+Sans:wght@400;500;600;700&family=DM+Serif+Text:ital@0;1&display=swap"
    rel="stylesheet">

  <!-- Alpine JS -->
  <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

  <style>
    /* Global Smooth Scrolling */
    html {
      scroll-behavior: smooth;
    }

    /* Custom Scrollbar for modern look */
    ::-webkit-scrollbar {
      width: 10px;
    }

    ::-webkit-scrollbar-track {
      background: #f8fafc;
    }

    ::-webkit-scrollbar-thumb {
      background: #cbd5e1;
      border-radius: 5px;
    }

    ::-webkit-scrollbar-thumb:hover {
      background: #94a3b8;
    }
  </style>
</head>

<body class="bg-white text-slate-900 overflow-x-hidden selection:bg-blue-100 selection:text-blue-600">

  @include('landing.partials.navbar')

  <main>
    @include('landing.hero-section')
    @include('landing.about-section')
    @include('landing.alur-section')
    @include('landing.testminoials')
    @include('landing.news-section')
  </main>

  @include('landing.partials.footer')

</body>

</html>