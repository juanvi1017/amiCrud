<?php
class SubscriptionModel
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAllSubscriptions()
    {
        $sql = "SELECT * FROM subscriptions";
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getSubscriptionById($id)
    {
        $sql = "SELECT * FROM subscriptions WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createSubscription($name, $email, $subscription_type)
    {
        $sql = "INSERT INTO subscriptions (name, email, subscription_type) VALUES (:name, :email, :subscription_type)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['name' => $name, 'email' => $email, 'subscription_type' => $subscription_type]);
    }

    public function updateSubscription($id, $name, $email, $subscription_type)
    {
        $sql = "UPDATE subscriptions SET name = :name, email = :email, subscription_type = :subscription_type WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id, 'name' => $name, 'email' => $email, 'subscription_type' => $subscription_type]);
    }

    public function deleteSubscription($id)
    {
        $sql = "DELETE FROM subscriptions WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
    }

    public function emailExists($email, $id = null)
    {
        // Si se pasa un ID, excluye ese registro de la verificación (para editar)
        $sql = "SELECT COUNT(*) FROM subscriptions WHERE email = :email";
        if ($id !== null) {
            $sql .= " AND id != :id";
        }
        $stmt = $this->pdo->prepare($sql);

        // Parámetros de la consulta
        $params = ['email' => $email];
        if ($id !== null) {
            $params['id'] = $id;
        }

        $stmt->execute($params);
        return $stmt->fetchColumn() > 0; // Retorna true si el email ya existe
    }
}
