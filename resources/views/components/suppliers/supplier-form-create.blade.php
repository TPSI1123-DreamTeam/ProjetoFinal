<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

<div class="container mx-auto mt-5">
    <h1 class="text-3xl font-bold mb-5">Criar Fornecedor</h1>
    <form method="POST" action="{{ route('suppliers.store') }}" enctype="multipart/form-data">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Nome do Fornecedor</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="Nome do Fornecedor" class="mt-1 p-2 w-full border rounded-md @error('name') border-red-500 @enderror" required>
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">E-mail</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="Email do Fornecedor" class="mt-1 p-2 w-full border rounded-md @error('email') border-red-500 @enderror" required>
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label for="contact" class="block text-sm font-medium text-gray-700">Contato</label>
                <input type="text" name="contact" id="contact" value="{{ old('contact') }}" placeholder="Telefone ou Contato" class="mt-1 p-2 w-full border border-gray-300 rounded-md @error('contact') border-red-500 @enderror" required>
                @error('contact')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="supplier_type_id" class="block text-sm font-medium text-gray-700">Tipo de Fornecedor</label>
                <select name="supplier_type_id" id="supplier_type_id" class="mt-1 p-2 w-full border border-gray-300 rounded-md @error('supplier_type_id') border-red-500 @enderror" required>
                    <option value="">Selecione o Tipo de Fornecedor</option>
                    @foreach ($supplierTypes as $supplierType)
                        <option value="{{ $supplierType->id }}" {{ old('supplier_type_id') == $supplierType->id ? 'selected' : '' }}>
                        {{ $supplierType->name }}
                        </option>
                    @endforeach
                </select>
                @error('supplier_type_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

        <div class="mb-6">
            <label for="logo" class="block text-sm font-medium text-gray-700">Logo do Fornecedor</label>
            <input type="file" name="image" id="image" class="mt-1 p-2 w-full border border-gray-300 rounded-md @error('logo') border-red-500 @enderror">
            @error('logo')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center justify-between">
            <a href="/suppliers" class="text-sm text-gray-500 hover:text-gray-700">Voltar</a>
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-md">Criar Fornecedor</button>
        </div>
    </form>
</div>
