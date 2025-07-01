<?php
session_start();

require_once __DIR__ . '/classes/Login.php';

$usuario = $_POST['username'];
$senha = $_POST['password'];

$user = new Usuario();
$dados = $user->autenticar($usuario, $senha);

if ($dados) {
    $_SESSION['usuario'] = [
        'id' => $dados['id'],
        'nome' => $dados['nome'],
        'tipo' => $dados['tipo']
    ];

    if ($dados['tipo'] === 'Cliente') {
        header("Location: ../Site/cliente.php");
    } elseif ($dados['tipo'] === 'Advogado' || $dados['tipo'] === 'Administrador') {
        header("Location: ../Site/usuario.php");
    }
    exit();
} else {
    header("Location: index.html?erro=1");
    exit();
}
