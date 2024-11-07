@extends('master.main')

@section('content')

    <header

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid gap-6 grid-cols-1 md:grid-cols-2">

            <!-- Boas-vindas e Resumo do Perfil -->
            <div class="bg-white shadow-md rounded-lg p-6">
                <h3 class="text-2xl font-semibold text-gray-900 mb-2">Bem-vindo, {{ Auth::user()->name }}!</h3>
                <a href="{{ route('profile.edit') }}" class="text-indigo-600 hover:text-indigo-800 font-semibold">
                    Editar Perfil
                </a>
                <p class="text-gray-700 mb-4">Aqui está o resumo da sua conta e histórico recente.</p>
            </div>

            <!-- Histórico de Pagamentos -->
            <div class="bg-white shadow-md rounded-lg p-6">
            <h3 class="text-2xl font-semibold text-gray-900 mb-4">Histórico de Pagamentos</h3>
            <div class="bg-gray-100 p-4 rounded-lg shadow-inner overflow-y-auto max-h-80">
            <table class="w-full text-left table-auto">
                <thead>
                    <tr class="border-b border-gray-300">
                    <th class="px-4 py-2 text-gray-800">Data</th>
                    <th class="px-4 py-2 text-gray-800">Nome</th>
                    <th class="px-4 py-2 text-gray-800">Montante (€)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($payments as $payment)
                    <tr class="border-b border-gray-300">
                        <td class="px-4 py-2 text-gray-800">{{ $payment->date }}</td>
                        <td class="px-4 py-2 text-gray-500">{{ $payment->name }}</td>
                        <td class="px-4 py-2 font-bold text-gray-900">{{ $payment->amount }} €</td>
                        
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

        </div>
    </div>
@endsection