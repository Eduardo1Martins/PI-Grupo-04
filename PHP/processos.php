<?php
require_once __DIR__ . '/classes/Processo.php';
require_once __DIR__ . '/classes/FaseProcesso.php';

$usuario = $_SESSION['usuario'] ?? null;
$processoObj = new Processo();
$faseObj = new FaseProcesso();
$processos = [];

if ($usuario) {
    if (in_array($usuario['tipo'], ['Administrador', 'Advogado'])) {
        $processos = $processoObj->listarTodos();
    } elseif ($usuario['tipo'] === 'Cliente') {
        $processos = $processoObj->buscarPorCliente((int)$usuario['id']);
    }
}
?>
