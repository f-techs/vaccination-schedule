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
$credit = \App\Models\CreditTransaction::where('code', $code)->first();
@endphp
<body class="bg-gray-100 font-sans">
<div class="max-w-2xl mx-auto bg-white rounded-lg shadow-md overflow-hidden my-10">
    <div class="bg-blue-600 p-4 text-center">
        <h2 class="text-2xl font-bold text-white">Data Credits Purchase</h2>
    </div>
    <div class="p-6">

        <p class="mt-4 text-gray-700">
            <strong>Your request for data credits for: {{$credit->credit_type}} of Credit(s): {{ $credit->credits_requested }} is confirmed </strong>
        </p>
{{--        <div class="mt-6 text-center">--}}
{{--            <p class="mt-4 text-gray-700">--}}
{{--                Click or tap on this link for more information--}}
{{--                <a href="{{route('credit', ['code'=>$code])}}" class="bg-blue-600 text-white font-bold py-2 px-4 rounded hover:bg-green-900">Get More details</a>.--}}
{{--            </p>--}}
{{--        </div>--}}
    </div>

</div>
</body>
</html>
