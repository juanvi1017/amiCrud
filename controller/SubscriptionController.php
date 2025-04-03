<?php
include_once '../db.php';
include_once '../model/SubscriptionModel.php';

$model = new SubscriptionModel($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] === 'create') {
        // Verificar si el correo ya existe
        if ($model->emailExists($_POST['email'])) {
            echo "Error: El correo electrónico ya está registrado.";
            exit(); // Detiene la ejecución
        }
        // Crear suscripción
        $model->createSubscription($_POST['name'], $_POST['email'], $_POST['subscription_type']);
        header("Location: ../view/index.php");
    } elseif ($_POST['action'] === 'update') {
        // Verificar si el correo ya existe para otro usuario
        if ($model->emailExists($_POST['email'], $_POST['id'])) {
            echo "Error: El correo electrónico ya está registrado por otro usuario.";
            exit(); // Detiene la ejecución
        }
        // Actualizar suscripción
        $model->updateSubscription($_POST['id'], $_POST['name'], $_POST['email'], $_POST['subscription_type']);
        header("Location: ../view/index.php");
    }
}
