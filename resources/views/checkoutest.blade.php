<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Concerto Quim Barreiros</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <!-- Passar o nome do evento -->
                <input type="hidden" name="event" value="Concerto: Quim Barreiros">
                <h2>Concerto: Quim Barreiros</h2>
            </div>
            <div class="card-body">
                <p class="card-text">
                    Venha assistir ao concerto do grande Quim Barreiros! Prepare-se para uma noite de música e diversão.
                </p>
                <p><strong>Preço do bilhete:</strong> 30€</p>
                <form action="{{ url('/checkout') }}" method="GET">
                    @csrf
                    <!-- Nome do evento -->
                    <input type="hidden" name="event" value="Concerto: Quim Barreiros">
                    <input type="hidden" name="amount" value="3000">
                    <button type="submit" class="btn btn-success">
                        Comprar Bilhete
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
