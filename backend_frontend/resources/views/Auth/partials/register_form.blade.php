<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    .primary { --tw-text-opacity: 1; color: rgba(25,93,230,var(--tw-text-opacity)); }
    .bg-primary { background-color: #195de6; }
  </style>
</head>
<body class="bg-[#f6f6f8] text-[#111318] flex items-center justify-center min-h-screen">

<div id="registerForm" class="hidden transform translate-x-full opacity-0 transition-all duration-700 w-full max-w-md bg-white p-4 rounded-lg shadow-lg">

  <h2 class="text-3xl font-bold mb-2">Créer un compte</h2>
  <p class="text-gray-500 mb-8">Entrez vos informations pour vous inscrire.</p>

  <form class="space-y-5">
    <div>
      <label class="text-sm font-medium">Nom complet</label>
      <input type="text" placeholder="John Doe"
             class="w-full rounded-lg border p-3 mt-1 focus:ring-2 focus:ring-blue-600 outline-none">
    </div>

    <div>
      <label class="text-sm font-medium">Email</label>
      <input type="email" placeholder="name@company.com"
             class="w-full rounded-lg border p-3 mt-1 focus:ring-2 focus:ring-blue-600 outline-none">
    </div>

    <div>
      <label class="text-sm font-medium">Mot de passe</label>
      <input type="password" placeholder="Enter your password"
             class="w-full rounded-lg border p-3 mt-1 focus:ring-2 focus:ring-blue-600 outline-none">
    </div>

    <div>
      <label class="text-sm font-medium">Ville</label>
      <input type="text" placeholder="Casablanca"
             class="w-full rounded-lg border p-3 mt-1 focus:ring-2 focus:ring-blue-600 outline-none">
    </div>

    <button type="submit" class="w-full bg-blue-600 text-white p-3 rounded-lg font-bold hover:bg-blue-700 transition">
      S’inscrire
    </button>
  </form>

  <p class="mt-6 text-center text-sm">
    Déjà un compte?
    <button id="showLogin" class="text-blue-600 font-bold hover:underline ml-1">Se connecter</button>
  </p>
</div>

</body>
</html>
