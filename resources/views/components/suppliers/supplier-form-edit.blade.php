<div class="event-wrapper">
    <div class="title-hidder-div">
        <h1>Editar {{ $supplier->name }}</h1>
    </div>
</div>
<div class="linha-divisoria-event-manager"></div>

<form method="POST" action="{{ url('suppliers/'.$supplier->id) }}" enctype="multipart/form-data" class="supplier-show-form">
    @csrf
    @method('PUT')
    <div class="input-supplier-show">
        <label for="name" class="">Nome</label>
        <input type="text" name="name" value="{{ $supplier->name }}" id="name" autocomplete="given-name">
    </div>

    <div class="input-supplier-show">
        <label for="last-name">Telefone</label>
        <input type="text" name="last-name" id="last-name" value="{{ $supplier->contact }}" autocomplete="family-name">
    </div>

    <div class="input-supplier-show">
        <label for="email-text" class="">Email</label>
        <input id="email-text" name="email" type="text" value="{{ $supplier->email }}" autocomplete="email">
    </div>

    <div class="input-supplier-show">
    <label for="supplier-type" class="">Tipo de Fornecedor</label>
        <select id="supplier_type_id" name="supplier_type_id" >
            @foreach ($supplierTypes as $supplierType)
                <option value="{{ $supplierType->id }}" {{ $supplier->supplier_type_id == $supplierType->id ? 'selected' : '' }}>
                    {{ $supplierType->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="show-sup-update-btn">
        <button type="submit" >Atualizar</button>
    </div>
    <div class="show-sup-go-back-btn">
        <a href="{{ url('/suppliers') }}">Voltar</a>
    </div>
</form>
