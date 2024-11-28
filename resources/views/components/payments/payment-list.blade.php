<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

<div class="content-header">
<div class="title-hidder-div">
        <h1>Histórico de Pagamentos</h1>
        <button type="button" id="hidder"><i class='bx bx-help-circle bx-tada' ></i></button>
    </div>
        <p id="hidden">Bem-vindo ao seu histórico de pagamentos! Aqui pode consultar todas as transações realizadas no nosso site de eventos. 
            Verifique os detalhes dos eventos adquiridos, as datas de pagamento e os valores. 
            Este registo permite-lhe acompanhar as suas compras de forma simples e organizada, garantindo transparência e controlo sobre os seus gastos. 
            Caso tenha dúvidas sobre alguma transação, a nossa equipa está disponível para ajudar através da secção de contacto.</p>
</div>
<div class="linha-divisoria"></div>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome do Evento</th>
            <th>Preço</th>
            <th>Data</th>
            <th>Estado</th>
        </tr>
    </thead>
    <tbody>
        @foreach($payments as $payment)
        <tr>
            <td>{{ $payment->id }}</td>
            <td>{{ $payment->name }}</td>
            <td>{{ $payment->amount }}</td>
            <td>{{ $payment->date }}</td>
            <td>{{ $payment->status == 'paid' ? 'Pago' : 'Pendente' }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>

@vite('resources/js/hidder.js')