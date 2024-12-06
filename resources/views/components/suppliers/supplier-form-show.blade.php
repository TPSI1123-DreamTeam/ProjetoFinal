<form>
  <div class="">
    <label for="first-name" class="">Nome</label>
      <input type="text" name="first-name" value="{{ $supplier->name }}" id="first-name" readonly disabled
        autocomplete="given-name"
        class="">
  </div>

  <div class="">
    <label for="last-name">Telefone</label>
      <input type="text" name="last-name" id="last-name" value="{{ $supplier->contact }}" readonly disabled
        autocomplete="family-name"
        class="">
  </div>

  <div class="">
    <label for="email" class="">Email</label>
      <input id="email" name="email" type="email" value="{{ $supplier->email }}" readonly disabled
        autocomplete="email"
        class="">
  </div>

  <div class="">
    <a href="{{ url('/suppliers') }}" class="">Voltar à Lista</a>
  </div>
</form>