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
  <section id="home" class="bg-green-600 text-white py-20">
    <div class="container mx-auto px-4 text-center">
      <h1 class="text-4xl font-bold mb-4">Stay Protected with Vaccination</h1>
      <p class="text-lg mb-6">Schedule Mothers for vaccination of their Babies</p>
    </div>
  </section>

  <!-- Schedule Table Section -->
{{--  <section id="schedule" class="py-16 bg-green-100">--}}
{{--    <div class="container mx-auto px-4">--}}
{{--      <div class="text-center mb-8">--}}
{{--        <h2 class="text-3xl font-bold text-green-800">Vaccination Schedule</h2>--}}
{{--        <p class="text-gray-700 mt-2">View the schedule information shared with mothers for their baby's vaccinations.</p>--}}
{{--      </div>--}}
{{--      --}}
{{--      <div class="overflow-x-auto">--}}
{{--        <table class="min-w-full bg-white rounded-lg shadow-lg">--}}
{{--          <thead class="bg-green-600 text-white">--}}
{{--            <tr>--}}
{{--              <th class="py-3 px-4 text-left font-semibold">Mother's Name</th>--}}
{{--              <th class="py-3 px-4 text-left font-semibold">Baby's Name</th>--}}
{{--              <th class="py-3 px-4 text-left font-semibold">Vaccination Date</th>--}}
{{--              <th class="py-3 px-4 text-left font-semibold">Vaccination Type</th>--}}
{{--              <th class="py-3 px-4 text-left font-semibold">Location</th>--}}
{{--            </tr>--}}
{{--          </thead>--}}
{{--          <tbody class="text-gray-700">--}}
{{--            <!-- Sample Row 1 -->--}}
{{--            <tr class="border-b">--}}
{{--              <td class="py-3 px-4">Jane Doe</td>--}}
{{--              <td class="py-3 px-4">Baby John</td>--}}
{{--              <td class="py-3 px-4">2024-11-10</td>--}}
{{--              <td class="py-3 px-4">Polio</td>--}}
{{--              <td class="py-3 px-4">Community Health Center</td>--}}
{{--            </tr>--}}
{{--            <!-- Sample Row 2 -->--}}
{{--            <tr class="bg-gray-50 border-b">--}}
{{--              <td class="py-3 px-4">Mary Smith</td>--}}
{{--              <td class="py-3 px-4">Baby Anna</td>--}}
{{--              <td class="py-3 px-4">2024-11-15</td>--}}
{{--              <td class="py-3 px-4">Measles</td>--}}
{{--              <td class="py-3 px-4">Downtown Clinic</td>--}}
{{--            </tr>--}}
{{--            <!-- Sample Row 3 -->--}}
{{--            <tr class="border-b">--}}
{{--              <td class="py-3 px-4">Linda Brown</td>--}}
{{--              <td class="py-3 px-4">Baby Liam</td>--}}
{{--              <td class="py-3 px-4">2024-11-20</td>--}}
{{--              <td class="py-3 px-4">Hepatitis B</td>--}}
{{--              <td class="py-3 px-4">Health Center 3</td>--}}
{{--            </tr>--}}
{{--            <!-- Add more rows as needed -->--}}
{{--          </tbody>--}}
{{--        </table>--}}
{{--      </div>--}}
{{--    </div>--}}
{{--  </section>--}}

  <!-- Footer -->
  <footer class="bg-green-700 text-white py-6">
    <div class="container mx-auto px-4 text-center">
      <p>&copy; 2024 Vaccination Info. All Rights Reserved.</p>
    </div>
  </footer>

</body>
</html>
