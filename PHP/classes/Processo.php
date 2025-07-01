<?php
declare(strict_types=1);

require_once __DIR__ . '/DB.php';

class Processo extends Database {
    private string $tabela = 'processos';

    public function listarTodos(): array {
        $sql = "SELECT p.*, c.nome 
                FROM {$this->tabela} p
                JOIN clientes c ON p.cliente_id = c.cliente_id";
        $stmt = $this->conexao->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorCliente(int $clienteId): array {
        $sql = "SELECT * FROM {$this->tabela} WHERE cliente_id = :cliente_id";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindParam(':cliente_id', $clienteId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
