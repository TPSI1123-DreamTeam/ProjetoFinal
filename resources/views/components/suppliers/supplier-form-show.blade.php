<h1>Supplier Details</h1>
<form>

{{-- INPUTS --}}
    @component('ui.components.form.input', [
        'input_name' => 'name',
        'disabled' => true,
        'input_type' => 'text',
        'input_start_value' => $supplier->name
    ])
    @endcomponent

    @component('ui.components.form.input', [
        'input_name' => 'email',
        'disabled' => true,
        'input_type' => 'email',
        'input_start_value' => $supplier->email
    ])
    @endcomponent

    @component('ui.components.form.input', [
        'input_name' => 'phone',
        'disabled' => true,
        'input_type' => 'number',
        'input_start_value' => $supplier->phone
    ])
    @endcomponent
    {{-- .INPUTS --}}
</form>
