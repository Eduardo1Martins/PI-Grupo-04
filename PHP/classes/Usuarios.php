<?php
declare(strict_types=1);

require_once __DIR__ . '/DB.php';

class Usuarios extends Database {
    private string $tabela = 'Clientes';

    public function listarUsuarios() {
        $sql = "SELECT * FROM Clientes";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    
public function excluirUsuario($id, $redirecionar = true) {
    try {
        // Verifica se há processos vinculados ao cliente
        $sqlVerifica = "SELECT COUNT(*) FROM processos WHERE cliente_id = :id";
        $stmtVerifica = $this->conexao->prepare($sqlVerifica);
        $stmtVerifica->bindParam(':id', $id, PDO::PARAM_INT);
        $stmtVerifica->execute();
        $total = $stmtVerifica->fetchColumn();

if ($total > 0) {
            echo "<script>alert('Não é possível excluir o cliente. Existem $total processo(s) vinculados.');</script>";
            if ($redirecionar) {
                echo "<script>window.location.href='../Site/usuario.php';</script>";
            }
            return;
        }

        // Excluir cliente
        $sqlExcluir = "DELETE FROM clientes WHERE cliente_id = :id";
        $stmtExcluir = $this->conexao->prepare($sqlExcluir);
        $stmtExcluir->bindParam(':id', $id, PDO::PARAM_INT);
        $stmtExcluir->execute();

        if ($redirecionar) {
            header('Location: ../Site/usuario.php');
            exit();
        }

    } catch (PDOException $e) {
        echo "<p>Erro ao tentar excluir o cliente: " . $e->getMessage() . "</p>";
    }
}

public function buscarId($id)
{
    $sql = "SELECT * FROM Clientes WHERE cliente_id = :cliente_id";
    $stmt = $this->conexao->prepare($sql);
    $stmt->bindParam(':cliente_id', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

public function alterarUsuario($id, $nome, $telefone, $cpf, $email, $endereco, $estado_civil)
{
    $sql = "UPDATE Clientes SET nome = :nome, telefone = :telefone, cpf = :cpf, email = :email, endereco = :endereco, estado_civil = :estado_civil WHERE cliente_id = :id";
    $stmt = $this->conexao->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':telefone', $telefone);
    $stmt->bindParam(':cpf', $cpf);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':endereco', $endereco);
    $stmt->bindParam(':estado_civil', $estado_civil);
    $stmt->execute();
}

}