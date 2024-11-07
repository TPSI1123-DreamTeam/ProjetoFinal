<h1>Update Supplier</h1>
<form method="POST" action="{{ url('suppliers/'.$supplier->id) }}">
    @csrf
    @method('PUT')

    {{-- INPUTS --}}
    @component('ui.components.form.input', [
        'input_name' => 'name',
        'input_type' => 'text',
        'input_start_value' => $supplier->name
    ])
    @endcomponent

    @component('ui.components.form.input', [
        'input_name' => 'email',
        'input_type' => 'email',
        'input_start_value' => $supplier->email
    ])
    @endcomponent

    @component('ui.components.form.input', [
        'input_name' => 'phone',
        'input_type' => 'number',
        'input_start_value' => $supplier->birth_date
    ])
    @endcomponent
    {{-- .INPUTS --}}

    <button type="submit" class="mt-2 mb-5 btn btn-primary">Submit</button>
</form>
