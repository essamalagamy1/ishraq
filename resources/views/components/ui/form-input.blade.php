@props([
    'name',
    'label' => null,
    'type' => 'text',
    'icon' => null,
    'placeholder' => '',
    'required' => false,
    'value' => null,
    'rows' => 4,
])

<div>
    @if($label)
        <label for="{{ $name }}" class="flex text-gray-700 font-bold mb-3 items-center gap-2 text-lg">
            @if($icon)
                <i class="{{ $icon }} text-accent-500"></i>
            @endif
            {{ $label }}
            @if($required)
                <span class="text-red-500">*</span>
            @endif
        </label>
    @endif
    
    @if($type === 'textarea')
        <textarea 
            name="{{ $name }}" 
            id="{{ $name }}" 
            rows="{{ $rows }}"
            class="w-full px-5 py-4 border-2 border-gray-200 rounded-xl focus:border-accent-500 focus:ring-4 focus:ring-accent-100 focus:outline-none transition-all duration-300 text-lg resize-none"
            placeholder="{{ $placeholder }}"
            {{ $required ? 'required' : '' }}
            {{ $attributes }}
        >{{ $value ?? old($name) }}</textarea>
    @elseif($type === 'select')
        <select 
            name="{{ $name }}" 
            id="{{ $name }}"
            class="w-full px-5 py-4 border-2 border-gray-200 rounded-xl focus:border-accent-500 focus:ring-4 focus:ring-accent-100 focus:outline-none transition-all duration-300 text-lg bg-white"
            {{ $required ? 'required' : '' }}
            {{ $attributes }}
        >
            {{ $slot }}
        </select>
    @else
        <input 
            type="{{ $type }}" 
            name="{{ $name }}" 
            id="{{ $name }}"
            value="{{ $value ?? old($name) }}"
            class="w-full px-5 py-4 border-2 border-gray-200 rounded-xl focus:border-accent-500 focus:ring-4 focus:ring-accent-100 focus:outline-none transition-all duration-300 text-lg"
            placeholder="{{ $placeholder }}"
            {{ $required ? 'required' : '' }}
            {{ $attributes }}
        >
    @endif
    
    @error($name)
        <p class="text-red-500 text-sm mt-2 flex items-center gap-1">
            <i class="fas fa-exclamation-circle"></i>
            {{ $message }}
        </p>
    @enderror
</div>
