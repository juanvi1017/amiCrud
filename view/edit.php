
<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Editar Suscripción</title>
</head>
<body class="container mt-4">
    <h1>Editar Suscripción</h1>
    <?php
    include_once '../db.php';
    include_once '../model/SubscriptionModel.php';

    $model = new SubscriptionModel($pdo);

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $subscription = $model->getSubscriptionById($id);

        if (!$subscription) {
            echo "<div class='alert alert-danger'>No se encontró la suscripción.</div>";
            exit();
        }
    } else {
        echo "<div class='alert alert-danger'>ID no proporcionado.</div>";
        exit();
    }
    ?>
    <form method="POST" action="../controller/SubscriptionController.php">
        <input type="hidden" name="action" value="update">
        <input type="hidden" name="id" value="<?php echo $subscription['id']; ?>">
        <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($subscription['name']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($subscription['email']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="subscription_type" class="form-label">Tipo de Suscripción</label>
            <select class="form-select" id="subscription_type" name="subscription_type">
                <option <?php echo $subscription['subscription_type'] === 'Mensual' ? 'selected' : ''; ?>>Mensual</option>
                <option <?php echo $subscription['subscription_type'] === 'Anual' ? 'selected' : ''; ?>>Anual</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Guardar cambios</button>
    </form>
</body>
</html>
