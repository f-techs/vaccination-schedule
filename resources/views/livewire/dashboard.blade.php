<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold text-center text-indigo-600 mb-8">Vaccination Message Dashboard</h1>

    <!-- Stats and Graph Section -->
    <div class="bg-gray-100 shadow-lg rounded-lg p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-gradient-to-r from-green-400 to-green-500 text-white shadow-md rounded-lg p-4">
                <h2 class="text-lg font-semibold">Parent Records</h2>
                <p class="text-4xl font-bold">{{ $parentRecords }}</p>
            </div>
            <div class="bg-gradient-to-r from-blue-400 to-blue-500 text-white shadow-md rounded-lg p-4">
                <h2 class="text-lg font-semibold">SMS Sent</h2>
                <p class="text-4xl font-bold">{{ $smsCount }}</p>
            </div>
            <div class="bg-gradient-to-r from-pink-400 to-pink-500 text-white shadow-md rounded-lg p-4">
                <h2 class="text-lg font-semibold">Emails Sent</h2>
                <p class="text-4xl font-bold">{{ $emailCount }}</p>
            </div>
            <div class="bg-gradient-to-r from-purple-400 to-purple-500 text-white shadow-md rounded-lg p-4">
                <h2 class="text-lg font-semibold">Total Messages Sent</h2>
                <p class="text-4xl font-bold">{{ $totalMessagesSent }}</p>
            </div>
        </div>
    </div>
    <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-xl font-bold text-gray-700 mb-4">Message Statistics</h2>
        <canvas id="messageGraph" style="width: 100%;"></canvas>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('messageGraph').getContext('2d');

        // Define the data
        const chartData = {
            labels: ['Total Sent', 'Read', 'Unread'],
            datasets: [{
                label: 'Messages',
                data: [{{ $totalMessagesSent }}, {{ $messagesRead }}, {{ $messagesUnread }}],
                backgroundColor: ['#4CAF50', '#2196F3', '#FF5722'],
                borderColor: ['#388E3C', '#1976D2', '#D84315'],
                borderWidth: 1
            }]
        };

        // Configure the chart
        const config = {
            type: 'bar',
            data: chartData,
            options: {
                responsive: false,
                width:100,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        };

        // Initialize the chart
        new Chart(ctx, config);
    });
</script>

