<!-- resources/views/edad.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Clasificación por Edad</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">

                <div class="card shadow rounded">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0 text-center">Clasificación por Edad</h4>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('procesar.edad') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="edad" class="form-label">Ingresa tu edad</label>
                                <input type="number" name="edad" id="edad" class="form-control" min="0" max="120" required>
                            </div>

                            @if($errors->any())
                                <div class="alert alert-danger">
                                    {{ $errors->first() }}
                                </div>
                            @endif

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Enviar</button>
                            </div>
                        </form>
                    </div>

                </div>

            </div>
        </div>
    </div>

</body>
</html>
