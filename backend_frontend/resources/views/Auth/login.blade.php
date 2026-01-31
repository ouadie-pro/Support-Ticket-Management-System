<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gestion des Réclamations | Login / Register</title>

  @vite('resources/css/app.css')
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
</head>
<body class="bg-[#f6f6f8] text-[#111318] transition-colors duration-200">

<div class="flex min-h-screen">

  <!-- ================= LEFT PANEL ================= -->
  <div id="leftPanel" class="hidden lg:flex lg:w-1/2 relative overflow-hidden bg-primary items-center justify-center p-12 transition-all duration-700">

    <div class="absolute inset-0 opacity-20"
         style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 40px 40px;">
    </div>
    <div class="absolute inset-0 bg-gradient-to-br from-primary via-primary/80 to-indigo-900 transition-all duration-700"></div>

    <div id="panelContent" class="relative z-10 max-w-xl text-white transition-all duration-700">
      <div class="flex items-center gap-2 mb-12">
        <div class="bg-white p-2 rounded-lg">
          <span class="material-symbols-outlined text-primary text-3xl">
            shield_person
          </span>
        </div>
        <span id="panelTitle" class="text-2xl font-bold">SupportDesk</span>
      </div>

      <h1 id="panelHeading" class="text-5xl font-black mb-6 leading-tight transition-all duration-700">
        Centralisez la gestion des réclamations et des tickets de support.
      </h1>

      <p id="panelText" class="text-white/80 text-lg max-w-md transition-all duration-700">
        Une plateforme professionnelle dédiée à la gestion des réclamations et des tickets de support, assurant un suivi efficace et une communication fluide.
      </p>
    </div>
  </div>

  <!-- ================= RIGHT PANEL ================= -->
  <div class="w-full lg:w-1/2 flex items-center justify-center p-6 sm:p-12 bg-white">

    <div class="w-full max-w-[440px]">

      <!-- Login Form -->
      @include('auth.partials.login_form')

      <!-- Register Form -->
      @include('auth.partials.register_form')

    </div>

  </div>

</div>

<script @vite('resources/js/auth_toggle.js')></script>

</body>
</html>
