<h1>Create Supplier</h1>
<form method="POST" action="{{ url('/suppliers') }}">
    @csrf

    {{-- INPUTS --}}
    @component('ui.components.form.input', [
        'input_type' => 'text',
        'input_name' => 'name',
        'required' => true
    ])
    @endcomponent

    @component('ui.components.form.input', [
        'input_type' => 'text',
        'input_name' => 'email',
        'required' => true
    ])
    @endcomponent

    @component('ui.components.form.input', [
        'input_type' => 'number',
        'input_name' => 'phone',
        'required' => true
    ])
    @endcomponent
    {{-- .INPUTS --}}

    <button type="submit" class="mt-2 mb-5 btn btn-primary">Submit</button>
</form>
