<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

<div class="container mx-auto mt-5">
    <h1 class="text-3xl font-bold mb-5">Criar Fornecedor</h1>
    <form method="POST" action="{{ url('/suppliers') }}" enctype="multipart/form-data">
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
                <label for="event" class="block text-sm font-medium text-gray-700">Evento</label>
                <select name="event_id" id="event" class="mt-1 p-2 w-full border border-gray-300 rounded-md @error('event_id') border-red-500 @enderror" required>
                    <option value="">Selecione o Evento</option>
                    @foreach ($supplier_types as $supplier_type)
                        <option value="{{ $supplier_type->id }}" {{ old('supplier_type_id') == $supplier_type->id ? 'selected' : '' }}>{{ $supplier_type->name }}</option>
                    @endforeach
                </select>
                @error('event_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
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
