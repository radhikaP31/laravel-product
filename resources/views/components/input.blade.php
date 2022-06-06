@props(['disabled' => false,'is_error' =>'false','message'=>''])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50']) !!}>

@if($is_error)
    <div class="text-red">{{ $message }}</div>
@endif