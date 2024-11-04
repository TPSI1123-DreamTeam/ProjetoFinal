<div class="form-group">
    <label for="{{ $input_name }}">{{ Str::ucfirst($input_name) }}</label>
    <input
        type="{{$input_type}}"
        id="{{ $input_name }}"
        name="{{ $input_name }}"
        autocomplete="{{ $input_name }}"
        placeholder="Type your {{ $input_name }}"
        class="form-control @error($input_name) is-invalid @enderror"
        @isset($input_start_value)
        value="{{ old($input_name, $input_start_value) }}"
        @else
        value="{{ old($input_name) }}"
        @endisset
        @isset($input_required)
        required
        @endisset
        @isset($disabled)
        disabled
        @endisset
        aria-describedby="{{ $input_name }}Help">

    <small id="{{ $input_name }}Help" class="form-text text-muted">We'll never share your data with anyone else.</small>
    @error($input_name)
    <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
    @enderror
</div>
