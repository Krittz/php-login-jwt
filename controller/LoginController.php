<?php

require_once '../dao/Database.php';
require_once '../vendor/autoload.php';

use Firebase\JWT\JWT;

class LoginController
{
    private $db;
    public function __construct($database_file)
    {
        $this->db = Database::getInstance($database_file);
    }

    public function loginUser($email, $password)
    {
        $connection = $this->db->getConnection();
        $query = $connection->prepare("SELECT * FROM usuarios WHERE email = :email");
        $query->bindValue(':email', $email);
        $result = $query->execute()->fetchArray(SQLITE3_ASSOC);

        if (!$result) {
            return "Email não encontrado.";
        }
        if (password_verify($password, $result['password'])) {
            $jwt_secret = 'seu_segredo_secreto';
            $payload = array(
                "id" => $result['id'],
                "name" => $result['name'],
                "email" => $result['email']
            );
            $jwt = JWT::encode($payload, $jwt_secret, 'HS256');
            return $jwt;
        } else {
            return "Senha incorreta.";
        }
    }
}
if (isset($_POST['email'], $_POST['password'])) {
    $database_file = '../dao/usuarios.db';
    $loginController = new LoginController($database_file);
    $result = $loginController->loginUser($_POST['email'], $_POST['password']);
    echo $result;
}
