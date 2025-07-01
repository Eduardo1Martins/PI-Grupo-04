<?php
declare(strict_types=1);
require_once __DIR__ . '/DB.php';

class Agendamento extends Database {
    private string $tabela = 'agendamentos';

    public function agendar(string $nome, string $data, string $hora, ?string $observacoes = null): bool {
        // Busca o ID do cliente pelo nome
        $sqlCliente = "SELECT cliente_id FROM clientes WHERE nome = :nome LIMIT 1";
        $stmtCliente = $this->conexao->prepare($sqlCliente);
        $stmtCliente->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmtCliente->execute();

       if ($stmtCliente->rowCount() === 0) {
    echo "<div style='
        padding: 20px;
        background-color: #f8d7da;
        color: #721c24;
        font-size: 24px;
        font-weight: bold;
        border: 2px solid #f5c6cb;
        border-radius: 8px;
        text-align: center;
        margin: 40px auto;
        max-width: 600px;
    '> Cliente não encontrado. Redirecionando...";
    header("Refresh: 1.5; url=../Site/agendamento.php");
    exit();
}

        $cliente = $stmtCliente->fetch(PDO::FETCH_ASSOC);
        $cliente_id = $cliente['cliente_id'];

        // Insere o agendamento
        $sql = "INSERT INTO {$this->tabela} (cliente_id, nome_cliente_agendamento, data_agendamento, hora_agendamento, observacoes) 
            VALUES (:cliente_id, :nome_cliente_agendamento, :data_agendamento, :hora_agendamento, :observacoes)";
        $stmt = $this->conexao->prepare($sql);

        $status = 'Agendado';

        $stmt->bindParam(':cliente_id', $cliente_id, PDO::PARAM_INT);
         $stmt->bindParam(':nome_cliente_agendamento', $nome, PDO::PARAM_STR);
        $stmt->bindParam(':data_agendamento', $data, PDO::PARAM_STR);
        $stmt->bindParam(':hora_agendamento', $hora, PDO::PARAM_STR);
        $stmt->bindParam(':observacoes', $observacoes);

        return $stmt->execute();
    }
}
?>
