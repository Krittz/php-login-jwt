<?php

$database_file = 'usuarios.db';
try {
    $db = new SQLite3($database_file);

    $create_table_query = "
    CREATE TABLE IF NOT EXISTS usuarios(
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        name TEXT NOT NULL,
        email TEXT NOT NULL UNIQUE,
        password TEXT NOT NULL
        )
    ";

    $db->exec($create_table_query);
    echo "Tablea de usuários criada com sucesso!";
} catch (Exception $e) {
    echo "Erro ao criar tabela de usuários: " . $e->getMessage();
}
$db->close();
