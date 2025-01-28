<div class="form-group">
    <label for="{{ $name . '_id' }}">{{ $label }}</label>
    <select name="{{ $name }}" id="{{ $name . '_id' }}">
        {{ $slot }}
    </select>
</div>