<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

<form method="POST" action="{{ url('suppliers/'.$supplier->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="space-y-12">
        <div class="border-b border-gray-900/10 pb-12">
            <img class="h-12 w-12 rounded-full bg-gray-50" 
                 src="{{ filter_var($supplier->image, FILTER_VALIDATE_URL) 
                 ? $supplier->image : asset('images/suppliers/' . $supplier->id . '/' . $supplier->image) }}">
            <div class="border-b border-gray-900/10 pb-12">
                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-3">
                        <label for="name" class="block text-sm/6 font-medium text-gray-900">Nome</label>
                        <div class="mt-2">
                            <input type="text" name="name" value="{{ $supplier->name }}" id="name" autocomplete="given-name" 
                                   class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6">
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <label for="contact" class="block text-sm/6 font-medium text-gray-900">Telefone</label>
                        <div class="mt-2">
                            <input type="text" name="contact" id="contact" value="{{ $supplier->contact }}" autocomplete="family-name" 
                                   class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6">
                        </div>
                    </div>

                    <div class="sm:col-span-4">
                        <label for="email" class="block text-sm/6 font-medium text-gray-900">Email</label>
                        <div class="mt-2">
                            <input id="email" name="email" type="email" value="{{ $supplier->email }}" autocomplete="email" 
                                   class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6">
                        </div>
                    </div>

                    <div class="sm:col-span-4">
                        <label for="supplier_type_id" class="block text-sm/6 font-medium text-gray-900">Tipo de Fornecedor</label>
                        <div class="mt-2">
                            <select id="supplier_type_id" name="supplier_type_id" 
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6">
                                <option value="">Selecione o Tipo</option>
                                @foreach ($supplierTypes as $supplierType)
                                    <option value="{{ $supplierType->id }}" {{ $supplier->supplier_type_id == $supplierType->id ? 'selected' : '' }}>
                                        {{ $supplierType->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="sm:col-span-4">
                        <label for="image" class="block text-sm/6 font-medium text-gray-900">Imagem (opcional)</label>
                        <div class="mt-2">
                            <input id="image" name="image" type="file" 
                                   class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6">
                        </div>
                    </div>
                </div>

                <div class="border-b border-gray-900/10 pb-12">
                    <p class="mt-1 text-sm/6 text-gray-600">We'll always let you know about important changes, but you pick what else you want to hear about.</p>
                </div>
            </div>
        </div>

        <div class="mt-6 flex items-center justify-end gap-x-6">
            <a href="{{ url('/suppliers') }}" 
               class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Voltar à Lista</a>
            <button type="submit" 
                    class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Atualizar</button>
        </div>
    </div>
</form>
