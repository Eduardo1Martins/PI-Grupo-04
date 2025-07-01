<?php
declare(strict_types=1);

require_once __DIR__ . '/DB.php';

class FaseProcesso extends Database {
    private string $tabela = 'fasesprocesso';

    public function listarPorProcesso(int $processoId): array {
        $sql = "SELECT * FROM {$this->tabela} WHERE processo_id = :processo_id";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindParam(':processo_id', $processoId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
