<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#f6f6f8] text-[#111318] flex items-center justify-center min-h-screen">

<div id="loginForm" class="transform transition-all duration-700 opacity-100 w-full max-w-md bg-white p-8 rounded-lg shadow-lg">

  <h2 class="text-3xl font-bold mb-2">Welcome back</h2>
  <p class="text-gray-500 mb-8">Please enter your details to sign in.</p>

  <form class="space-y-5">
    <div>
      <label class="text-sm font-medium">Email Address</label>
      <input type="email" placeholder="name@company.com"
             class="w-full rounded-lg border p-3 mt-1 focus:ring-2 focus:ring-blue-600 outline-none">
    </div>

    <div>
      <label class="text-sm font-medium">Password</label>
      <input type="password" placeholder="Enter your password"
             class="w-full rounded-lg border p-3 mt-1 focus:ring-2 focus:ring-blue-600 outline-none">
    </div>

    <div class="flex justify-between items-center">
      <label class="flex items-center gap-2">
        <input type="checkbox">
        <span class="text-sm">Remember me</span>
      </label>
      <a href="#" class="text-blue-600 text-sm">Forgot password?</a>
    </div>

    <button type="submit" class="w-full bg-blue-600 text-white p-3 rounded-lg font-bold hover:bg-blue-700 transition">
      Se connecter
    </button>
  </form>

  <p class="mt-6 text-center text-sm">
    Don't have an account?
    <button id="showRegister" class="text-blue-600 font-bold hover:underline ml-1">S’inscrire</button>
  </p>
</div>

</body>
</html>
