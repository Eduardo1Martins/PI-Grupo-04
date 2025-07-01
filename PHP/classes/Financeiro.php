<?php
declare(strict_types=1);

require_once __DIR__ . '/DB.php';

class Financeiro extends Database {

    private string $tabela = 'transacoesfinanceiras';

   public function listarTodos(): array {
        $sql = "
            SELECT tf.*, p.numero_processo, c.nome AS nome_cliente
            FROM transacoesfinanceiras tf
            JOIN processos p ON tf.processo_id = p.processo_id
            JOIN clientes c ON p.cliente_id = c.cliente_id
        ";
        $stmt = $this->conexao->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorCliente($clienteId) {
        $sql = "
            SELECT tf.*, p.numero_processo
            FROM transacoesfinanceiras tf
            JOIN processos p ON tf.processo_id = p.processo_id
            WHERE p.cliente_id = :cliente_id
        ";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindParam(':cliente_id', $clienteId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>