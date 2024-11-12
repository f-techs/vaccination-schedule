<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vaccination Alert</title>
    <style>
        @import url('https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css');
    </style>
</head>
@php
$message = \App\Models\Message::with('parent')->where('code', $code)->first();
@endphp
<body class="bg-gray-100 font-sans">
<div class="max-w-2xl mx-auto bg-white rounded-lg shadow-md overflow-hidden my-10">
    <div class="bg-blue-600 p-4 text-center">
        <h2 class="text-2xl font-bold text-white">Vaccination Alert</h2>
    </div>
    <div class="p-6">
        <p class="text-lg">Dear <strong>{{ $message->parent->parent_name }}</strong>,</p>
        <p class="mt-4 text-gray-700">
            This is a reminder that your child <strong>{{ $message->parent->child_name }}</strong> is due for their next vaccination.
        </p>
        <div class="mt-6 text-center">
            <p class="mt-4 text-gray-700">
                Click or tap on this link for more information
                <a href="{{route('vaccine.alert', ['code'=>$code])}}" class="bg-blue-600 text-white font-bold py-2 px-4 rounded hover:bg-green-900">Get More details</a>.
            </p>
        </div>
    </div>

</div>
</body>
</html>
