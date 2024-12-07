<div class="event-wrapper">
    <div class="title-hidder-div">
        <h1>{{ $supplier->name }}</h1>
    </div>
</div>
<div class="linha-divisoria-event-manager"></div>

<form class="supplier-show-form">
  <div class="input-supplier-show">
    <label for="first-name" class="">Nome</label>
      <input type="text" name="first-name" value="{{ $supplier->name }}" id="first-name" readonly disabled
        autocomplete="given-name"
        class="">
  </div>

  <div class="input-supplier-show">
    <label for="last-name">Telefone</label>
      <input type="text" name="last-name" id="last-name" value="{{ $supplier->contact }}" readonly disabled
        autocomplete="family-name"
        class="">
  </div>

  <div class="input-supplier-show">
    <label for="email-text" class="">Email</label>
      <input id="email-text" name="email" type="text" value="{{ $supplier->email }}" readonly disabled
        autocomplete="email"
        class="">
  </div>

  <div class="input-supplier-show">
    <label for="supplier-type" class="">Tipo de Fornecedor</label>
      <input id="supplier-type" name="supplier-type" type="text" value="{{ $supplier->supplierType->name}}" readonly disabled
        autocomplete="supplier-type"
        class="">
  </div>

  <div class="show-sup-go-back-btn">
    <a href="{{ url('/suppliers') }}" class="">Voltar à Lista</a>
  </div>
</form>