<div class="form-group">
    <label for="{{ $name . '_id' }}" style="display: {{ $display ?? 'block' }};">{{ $label }}</label>
    <input type="{{ $type ?? 'text' }}" name="{{ $name }}" id="{{ $name . '_id' }}" @if(isset($mask))
        data-mask="{{ $mask }}" @endif style="display: {{ $display ?? 'block' }};">
</div>