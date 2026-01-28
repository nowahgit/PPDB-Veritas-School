<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Veritas School - Sekolah Unggulan</title>
  <script src="https://unpkg.com/heroicons@2.0.18/dist/heroicons.min.js"></script>

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


  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Gabarito:wght@400..900&display=swap" rel="stylesheet">

  <!-- ✅ Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Hubot+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=DM+Serif+Text:ital@0;1&display=swap" rel="stylesheet">

<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

</head>
<body class="bg-white scroll-smooth">



   
@include('landing.partials.navbar')

@include('landing.hero-section')

@include('landing.about-section')

@include('landing.alur-section')

@include('landing.testminoials')

@include('landing.news-section')

@include('landing.partials.footer')