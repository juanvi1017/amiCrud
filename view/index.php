<!DOCTYPE html>
<html lang="es">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../static/css/style.css">
    <title>Suscripciones</title>
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
    <!-- Navbar -->
    <a href="create.php" class="btn btn-primary mb-3 addButton">+</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Tipo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include_once '../controller/SubscriptionController.php';
            $subscriptions = $model->getAllSubscriptions();
            foreach ($subscriptions as $sub) {
                echo "<tr>
                    <td>{$sub['id']}</td>
                    <td>{$sub['name']}</td>
                    <td>{$sub['email']}</td>
                    <td>{$sub['subscription_type']}</td>
                    <td>
                        <a href='edit.php?id={$sub['id']}' class='btn btn-warning btn-sm'>Editar</a>
                        <form method='POST' action='../controller/SubscriptionController.php' style='display:inline'>
                            <input type='hidden' name='id' value='{$sub['id']}'>
                            <input type='hidden' name='action' value='delete'>
                            <button class='btn btn-danger btn-sm'>Eliminar</button>
                        </form>
                    </td>
                </tr>";
            }
            ?>
        </tbody>
    </table>
</body>

</html>