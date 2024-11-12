<div class="max-w-xl w-full bg-white shadow-lg rounded-lg p-8 mx-4">
    <!-- Alert Header -->
    <h1 class="text-2xl font-bold text-green-600 mb-6 text-center">Vaccination Alert</h1>

    <!-- Message Section -->
    <p class="text-center mb-6">
        Dear Parent, this is a reminder about your child's upcoming vaccination. Please listen to the audio below for more details.
    </p>

    <!-- Audio Section -->
    <div class="mb-6">
        <audio controls class="w-full">
            <source src="https://www.example.com/audio/vaccine-alert.mp3" type="audio/mpeg">
            Your browser does not support the audio element.
        </audio>
    </div>

    <!-- Language Select Section -->
    <div class="mb-6">
        <label for="language" class="block text-sm font-medium text-gray-700 mb-2 text-center">Select Audio Language:</label>
        <select id="language" name="language" class="block px-4 py-2 w-full border border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring-green-500">
            <option value="en">English</option>
            <option value="fr">French</option>
            <option value="es">Spanish</option>
            <option value="tw">Twi</option>
        </select>
    </div>

    <!-- Footer Section -->
</div>
