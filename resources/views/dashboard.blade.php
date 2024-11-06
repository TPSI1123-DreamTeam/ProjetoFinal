<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @include('master.header')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid gap-6 grid-cols-1 md:grid-cols-2">
            
            <!-- Boas-vindas e Resumo do Perfil -->
            <div class="bg-white shadow-sm rounded-lg p-6">
                <h3 class="text-xl font-bold text-gray-800 mb-2">Bem-vindo, {{ Auth::user()->name }}!</h3>
                <p class="text-gray-600">Aqui está o resumo da sua conta e histórico recente.</p>
                <a href="{{ route('profile.edit') }}" class="text-blue-500 hover:text-blue-700 mt-4 inline-block">
                    Editar Perfil
                </a>
            </div>
            
            <!-- Histórico de Pagamentos -->
            <div class="bg-white shadow-sm rounded-lg p-6">
                <h3 class="text-xl font-bold text-gray-800 mb-4">Histórico de Pagamentos</h3>
                <div class="bg-gray-100 p-4 rounded-lg shadow-inner">
                    <ul>
                        @foreach($payments as $payment)
                            <li class="flex justify-between items-center py-2 border-b border-gray-200">
                                <span>{{ $payment->date }}</span>
                                <span>{{ $payment->amount }} €</span>
                            </li>
                        @endforeach
                    </ul>

                </div>
            </div>

            <!-- Eventos Comprados -->
            <div class="col-span-1 md:col-span-2 bg-white shadow-sm rounded-lg p-6">
                <h3 class="text-xl font-bold text-gray-800 mb-4">Eventos Comprados</h3>
                <div class="bg-gray-100 p-4 rounded-lg shadow-inner">
                    <ul>
                        @foreach($events as $event)
                            <li class="flex justify-between items-center py-2 border-b border-gray-200">
                                <span>{{ $event->name }}</span>
                                <span>{{ $event->start_date }} - {{ $event->end_date }}</span>
                            </li>
                        @endforeach
                    </ul>
            </div>
        </div>
    </div>
</x-app-layout>
