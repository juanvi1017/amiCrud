<?php
$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include_once '../controller/SubscriptionController.php';

    // Verificar si el correo ya existe
    if ($model->emailExists($_POST['email'])) {
        $error = "El correo electrónico ya está registrado.";
    } else {
        // Crear suscripción
        $model->createSubscription($_POST['name'], $_POST['email'], $_POST['subscription_type']);
        header("Location: index.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../static/css/style.css">
    <title>Crear Suscripción</title>
</head>

<body class="container mt-4">
    <nav class="navbar navbar-expand-lg bg-primary nav-css" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">
                JVC Muisic
            </a>
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="#">Team</a>
                </li>
            </ul>
        </div>
    </nav>
    <h3>Crear Suscripción</h3>
    <?php if ($error): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>
    <form method="POST" action="">
        <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="subscription_type" class="form-label">Tipo de Suscripción</label>
            <select class="form-select" id="subscription_type" name="subscription_type">
                <option>Mensual</option>
                <option>Anual</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Crear</button>
    </form>
</body>

</html>