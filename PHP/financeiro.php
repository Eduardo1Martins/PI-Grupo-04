<?php

require_once __DIR__ . '/classes/Financeiro.php';

$usuario = $_SESSION['usuario'];
$tipoUsuario = $usuario['tipo'];
$financeiroObj = new Financeiro();

if ($usuario) {
    if (in_array($usuario['tipo'], ['Administrador', 'Advogado'])) {
        $processos = $financeiroObj->listarTodos();
    } elseif ($usuario['tipo'] === 'Cliente') {
        $processos = $financeiroObj->buscarPorCliente((int)$usuario['id']);
    }
}
?>