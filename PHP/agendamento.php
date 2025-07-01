<?php
declare(strict_types=1);

require_once __DIR__ . '/classes/Agendamento.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'] ?? '';
    $data = $_POST['data'] ?? '';
    $hora = $_POST['hora'] ?? '';
    $observacoes = $_POST['observacoes'] ?? '';

    if (empty($nome) || empty($data) || empty($hora)) {
        die('Todos os campos obrigatórios devem ser preenchidos.');
    }

    $agendamento = new Agendamento();

    if ($agendamento->agendar($nome, $data, $hora, $observacoes)) {
        header('Location: ../Site/index.php');
        exit;
    } else {
        echo 'Erro ao realizar o agendamento.';
    }
}
?>