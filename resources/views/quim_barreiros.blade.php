<!-- resources/views/quim_barreiros.blade.php -->
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
                <h2>Concerto: Quim Barreiros</h2>
            </div>
            <div class="card-body">
                <form action="{{ url('/checkout') }}" method="GET">
                    @csrf
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
