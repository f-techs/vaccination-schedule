@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-300 focus:border-green-900 focus:ring-green-900 rounded-md shadow-sm']) }}>