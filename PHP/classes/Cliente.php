<?php
declare(strict_types=1);

require_once __DIR__ . '/DB.php';

class Cliente extends Database {
    private string $tabela = 'clientes';

    public function cadastrar(array $dados): int|false {
        $sql = "INSERT INTO {$this->tabela} (nome, cpf, email, telefone, endereco, estado_civil) 
                VALUES (:nome, :cpf, :email, :telefone, :endereco, :estado_civil)";
        $stmt = $this->conexao->prepare($sql);

        $stmt->bindParam(':nome', $dados['nome']);
        $stmt->bindParam(':cpf', $dados['cpf']);
        $stmt->bindParam(':email', $dados['email']);
        $stmt->bindParam(':telefone', $dados['telefone']);
        $stmt->bindParam(':endereco', $dados['endereco']);
        $stmt->bindParam(':estado_civil', $dados['estado_civil']);

        if ($stmt->execute()) {
            return (int) $this->conexao->lastInsertId();
        }

        return false;
    }
}
