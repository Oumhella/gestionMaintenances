<div>
    <label>{{ $name }}</label>
    <div>
        @foreach($options as $value => $label)
            <input type="checkbox" name="{{ $name }}[]" value="{{ $value }}" id="{{ $name }}_{{ $value }}">
            <label for="{{ $name }}_{{ $value }}">{{ $label }}</label>
        @endforeach
    </div>
</div>
