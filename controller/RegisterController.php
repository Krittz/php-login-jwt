<?php
require_once '../dao/Database.php';
class RegisterController
{
    private $db;

    public function __construct($database_file)
    {
        $this->db = Database::getInstance($database_file);
    }
    public function registerUserFromJSON($json_data)
    {
        $data = json_decode($json_data, true);
        if ($data === null) {
            return "Erro ao decodificar JSON.";
        }
        $name = $data['name'];
        $email = $data['email'];
        $password = $data['password'];
        $checkPassword = $data['checkPassword'];

        return $this->registeruser($name, $email, $password, $checkPassword);
    }

    public function registeruser($name, $email, $password, $checkpassword)
    {
        if (empty($name) || empty($email) || empty($password) || empty($checkpassword)) {
            return "Por favor, preencha todos os campos.";
        }
        if ($password !== $checkpassword) {
            return "As senhas não coincidem.";
        }
        $connection = $this->db->getConnection();
        $query = $connection->prepare("SELECT * FROM usuarios WHERE email = :email");
        $query->bindValue(':email', $email);
        $result = $query->execute()->fetchArray(SQLITE3_ASSOC);
        if ($result) {
            return "Este email já está em uso.";
        }
        $hashedPassword = password_hash($password, PASSWORD_ARGON2I);

        $insertQuery = $connection->prepare("INSERT INTO usuarios (name, email, password) VALUES(:name, :email, :password);");
        $insertQuery->bindValue(':name', $name);
        $insertQuery->bindValue(':email', $email);
        $insertQuery->bindValue(':password', $hashedPassword);
        $insertResult = $insertQuery->execute();

        if ($insertResult) {
            return "Usuário cadastrado com sucesso!";
        } else {
            return "Erro ao cadastrar usuário.";
        }
    }
}
$json_data = file_get_contents('php://input');

if (!empty($json_data)) {
    $database_file = '../dao/usuarios.db';
    $registerController = new RegisterController($database_file);
    $result = $registerController->registerUserFromJSON($json_data);
    echo json_encode(['message' => $result]);
} else {
    echo json_encode(['message' => $result]);
}


if (isset($_POST['name'], $_POST['email'], $_POST['password'], $_POST['checkPassword'])) {
    $database_file = '../dao/usuarios.db';
    $registerController = new RegisterController($database_file);
    $result = $registerController->registeruser($_POST['name'], $_POST['email'], $_POST['password'], $_POST['checkPassword']);
}
echo $result;
