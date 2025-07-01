<?php
declare(strict_types=1);

require_once __DIR__ . '/DB.php';

class Usuario extends Database {
    private string $tabela = 'usuarios';

    public function autenticar($email, $senha) {
        $sql = "SELECT * FROM " . $this->tabela . " WHERE email = :email LIMIT 1";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() === 1) {
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
            if (password_verify($senha, $usuario['senha_hash'])) {
                return $usuario;  // Retorna dados do usuário
            }
        }
        return false;
    }
}
