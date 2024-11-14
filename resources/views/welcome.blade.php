<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Vaccination Information</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-green-50 font-sans">

  <!-- Navbar -->
  <nav class="bg-green-600 text-white py-4">
    <div class="container mx-auto px-4 flex justify-between items-center">
      <!-- Logo / Brand -->
      <a href="#" class="text-2xl font-bold">Vaccination Schedule Generator</a>
      <div>
        <a href="{{route('login')}}" class="bg-white text-green-600 font-semibold py-2 px-4 rounded hover:bg-green-100 transition duration-300">
          Login
        </a>
      </div>
    </div>
  </nav>

  <!-- Hero Section -->
  <section id="home" class="bg-green-600 text-white py-20 h-screen">
    <div class="container mx-auto px-4 text-center">
      <h1 class="text-4xl font-bold mb-4">Stay Protected with Vaccination</h1>
      <p class="text-lg mb-6">Schedule Mothers for vaccination of their Babies</p>
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-green-700 text-white py-6">
    <div class="container mx-auto px-4 text-center">
      <p>&copy; 2024 Vaccination Info. All Rights Reserved.</p>
    </div>
  </footer>

</body>
</html>
