-- Configurações iniciais
CREATE DATABASE IF NOT EXISTS themis;
USE themis;

-- ==========================================
-- TABELAS
-- ==========================================

-- Tabela Clientes
CREATE TABLE IF NOT EXISTS clientes (
    cliente_id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    cpf VARCHAR(14) NOT NULL,
    telefone VARCHAR(20) DEFAULT NULL,
    email VARCHAR(50) NOT NULL,
    endereco VARCHAR(255) DEFAULT NULL,
    estado_civil ENUM('Solteiro','Casado','Divorciado','Viúvo','União Estável') DEFAULT 'Solteiro',
    data_cadastro DATE DEFAULT CURDATE(),
    UNIQUE KEY (cpf)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Tabela Processos
CREATE TABLE IF NOT EXISTS processos (
    processo_id INT AUTO_INCREMENT PRIMARY KEY,
    numero_processo VARCHAR(50) UNIQUE NOT NULL,
    cliente_id INT NOT NULL,
    valor_total DECIMAL(10, 2) DEFAULT 0.00,
    valor_pago DECIMAL(10, 2) DEFAULT 0.00,
    valor_a_pagar DECIMAL(10, 2) DEFAULT 0.00,
    pendencias DECIMAL(10, 2) DEFAULT 0.00,
    FOREIGN KEY (cliente_id) REFERENCES clientes(cliente_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Tabela FasesProcesso
CREATE TABLE IF NOT EXISTS fasesprocesso (
    fase_id INT AUTO_INCREMENT PRIMARY KEY,
    processo_id INT NOT NULL,
    tipo_fase ENUM('Conhecimento', 'Execucao') NOT NULL,
    etapa VARCHAR(255) NOT NULL,
    data_conclusao DATE DEFAULT NULL,
    FOREIGN KEY (processo_id) REFERENCES processos(processo_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Tabela DocumentosProcesso
CREATE TABLE IF NOT EXISTS documentosprocesso (
    documento_id INT AUTO_INCREMENT PRIMARY KEY,
    processo_id INT NOT NULL,
    nome_documento VARCHAR(255) NOT NULL,
    caminho_arquivo VARCHAR(255),
    data_upload DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (processo_id) REFERENCES processos(processo_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Tabela TransacoesFinanceiras
CREATE TABLE IF NOT EXISTS transacoesfinanceiras (
    transacao_id INT AUTO_INCREMENT PRIMARY KEY,
    processo_id INT NOT NULL,
    data_transacao DATE NOT NULL,
    tipo_transacao ENUM('Recebimento','Pagamento','Custo') NOT NULL,
    valor DECIMAL(10,2) NOT NULL,
    descricao VARCHAR(255) DEFAULT NULL,
    FOREIGN KEY (processo_id) REFERENCES processos(processo_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Tabela Agendamentos
CREATE TABLE IF NOT EXISTS agendamentos (
    agendamento_id INT AUTO_INCREMENT PRIMARY KEY,
    cliente_id INT,
    nome_cliente_agendamento VARCHAR(255) NOT NULL,
    data_agendamento DATE NOT NULL,
    hora_agendamento TIME NOT NULL,
    observacoes TEXT,
    FOREIGN KEY (cliente_id) REFERENCES clientes(cliente_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Tabela Usuarios
CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    senha_hash VARCHAR(255) NOT NULL,
    tipo ENUM('Advogado','Administrador','Cliente') NOT NULL,
    cliente_id INT DEFAULT NULL,
    FOREIGN KEY (cliente_id) REFERENCES clientes(cliente_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ==========================================
-- DADOS DE EXEMPLO
-- ==========================================

INSERT INTO clientes (cliente_id, nome, cpf, telefone, email, endereco, estado_civil, data_cadastro) VALUES
(1, 'João Silva', '000.000.000-00', '(00) 00000-0000', 'joao.silva@email.com', 'Rua Exemplo, 123 - Centro, Araras-SP', 'Solteiro', '2025-06-16'),
(2, 'Maria Souza', '111.111.111-11', '(11) 11111-1111', 'maria.souza@email.com', 'Rua B, 456', 'Solteiro', '2025-06-16'),
(3, 'Carlos Oliveira', '222.222.222-22', '(22) 22222-2222', 'carlos.oliveira@email.com', 'Rua C, 789', 'Solteiro', '2025-06-16'),
(4, 'Fernanda Lima', '333.333.333-99', '(33) 33333-3333', 'fernanda.lima@email.com', 'Rua D, 134', 'Solteiro', '2025-06-16');

INSERT INTO processos (processo_id, numero_processo, cliente_id, valor_total) VALUES
(1, '0001234-56.2023.8.26.0001', 1, 5000.00),
(2, '0009876-12.2023.8.26.0001', 2, 2500.00),
(3, '0005678-34.2023.8.26.0001', 3, 1200.00),
(4, '0001122-78.2023.8.26.0001', 4, 3000.00),
(5, '0001234-56.2023.8.26.1371', 1, 4000.00);

INSERT INTO fasesprocesso (fase_id, processo_id, tipo_fase, etapa) VALUES
(1, 1, 'Conhecimento', 'Petição inicial'),
(2, 1, 'Conhecimento', 'Defesa'),
(3, 1, 'Execucao', 'Liquidação da sentença'),
(4, 5, 'Execucao', 'Petição inicial'),
(5, 5, 'Execucao', 'Liquidação da sentença');

INSERT INTO documentosprocesso (documento_id, processo_id, nome_documento, caminho_arquivo) VALUES
(1, 1, 'Petição Inicial', '/docs/processo1/peticao_inicial.pdf');

INSERT INTO transacoesfinanceiras (transacao_id, processo_id, data_transacao, tipo_transacao, valor, descricao) VALUES
(1, 1, '2024-03-01', 'Recebimento', 5000.00, 'Pagamento integral'),
(2, 2, '2024-04-15', 'Recebimento', 2500.00, 'Pagamento total'),
(3, 3, '2024-05-10', 'Recebimento', 0.00, 'Nenhum pagamento inicial'),
(4, 4, '2024-05-22', 'Recebimento', 0.00, 'Nenhum pagamento inicial');

INSERT INTO agendamentos (agendamento_id, cliente_id, nome_cliente_agendamento, data_agendamento, hora_agendamento, observacoes) VALUES
(1, 1, 'João Silva', '2025-07-01', '09:00:00', 'Revisão do processo'),
(2, 3, 'Carlos Oliveira', '2025-06-18', '11:20:00', 'NA'),
(3, 4, 'Fernanda Lima', '2025-06-12', '16:35:00', 'NA'),
(4, 1, 'João Silva', '2025-06-18', '20:58:00', 'NA'),
(6, 1, 'João Silva', '2025-06-11', '20:26:00', 'tyu');

INSERT INTO usuarios (id, nome, email, senha_hash, tipo, cliente_id) VALUES
(1, 'João Silva', 'joao.silva@email.com', '$2y$12$ncRZa4/c46AXeMhCjy7tZueeMhhbxyZLE1KVzb4AFXU93g8tpfv92', 'Cliente', 1),
(2, 'Maria Souza', 'maria.souza@email.com', '$2y$12$ncRZa4/c46AXeMhCjy7tZueeMhhbxyZLE1KVzb4AFXU93g8tpfv92', 'Administrador', 2);

-- ==========================================
-- PROCEDURES
-- ==========================================

DELIMITER //

CREATE PROCEDURE AtualizarSaldosProcesso(IN p_processo_id INT)
BEGIN
    DECLARE v_valor_recebido DECIMAL(10, 2);
    DECLARE v_valor_total DECIMAL(10, 2);

    SELECT SUM(valor) INTO v_valor_recebido
    FROM transacoesfinanceiras
    WHERE processo_id = p_processo_id AND tipo_transacao = 'Recebimento';

    SELECT valor_total INTO v_valor_total
    FROM processos
    WHERE processo_id = p_processo_id;

    UPDATE processos
    SET valor_pago = IFNULL(v_valor_recebido, 0),
        valor_a_pagar = GREATEST(v_valor_total - IFNULL(v_valor_recebido, 0), 0),
        pendencias = GREATEST(v_valor_total - IFNULL(v_valor_recebido, 0), 0)
    WHERE processo_id = p_processo_id;

    SELECT 'Saldos financeiros atualizados com sucesso!' AS Mensagem;
END//

CREATE PROCEDURE AdicionarAgendamento(
    IN p_nome_cliente_agendamento VARCHAR(255),
    IN p_data_agendamento DATE,
    IN p_hora_agendamento TIME,
    IN p_observacoes TEXT
)
BEGIN
    DECLARE v_cliente_id INT DEFAULT NULL;
    SELECT cliente_id INTO v_cliente_id FROM clientes WHERE nome = p_nome_cliente_agendamento LIMIT 1;
    INSERT INTO agendamentos (cliente_id, nome_cliente_agendamento, data_agendamento, hora_agendamento, observacoes)
    VALUES (v_cliente_id, p_nome_cliente_agendamento, p_data_agendamento, p_hora_agendamento, p_observacoes);
    SELECT 'Agendamento adicionado com sucesso!' AS Mensagem;
END//

CREATE FUNCTION CalcularTotalPendenciasCliente(p_cliente_id INT) RETURNS DECIMAL(10,2)
READS SQL DATA
BEGIN
    DECLARE total_pendencias DECIMAL(10, 2);
    SELECT SUM(valor_a_pagar) INTO total_pendencias
    FROM processos
    WHERE cliente_id = p_cliente_id;
    RETURN IFNULL(total_pendencias, 0.00);
END//

CREATE PROCEDURE ListarProcessosETransacoesCliente(IN p_cliente_id INT)
BEGIN
    DECLARE done INT DEFAULT FALSE;
    DECLARE v_processo_id INT;
    DECLARE v_numero_processo VARCHAR(50);
    DECLARE v_data_transacao DATE;
    DECLARE v_tipo_transacao ENUM('Recebimento','Pagamento','Custo');
    DECLARE v_valor DECIMAL(10,2);
    DECLARE v_descricao VARCHAR(255);

    DECLARE cur_processos CURSOR FOR
        SELECT processo_id, numero_processo FROM processos WHERE cliente_id = p_cliente_id;
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;

    OPEN cur_processos;

    processo_loop: LOOP
        FETCH cur_processos INTO v_processo_id, v_numero_processo;
        IF done THEN LEAVE processo_loop; END IF;
        SELECT CONCAT('--- Processo: ', v_numero_processo, ' ---') AS InfoProcesso;

        BEGIN
            DECLARE done_transacao INT DEFAULT FALSE;
            DECLARE cur_transacoes CURSOR FOR
                SELECT data_transacao, tipo_transacao, valor, descricao
                FROM transacoesfinanceiras
                WHERE processo_id = v_processo_id;
            DECLARE CONTINUE HANDLER FOR NOT FOUND SET done_transacao = TRUE;

            OPEN cur_transacoes;

            transacao_loop: LOOP
                FETCH cur_transacoes INTO v_data_transacao, v_tipo_transacao, v_valor, v_descricao;
                IF done_transacao THEN LEAVE transacao_loop; END IF;
                SELECT CONCAT('  Data: ', v_data_transacao, ', Tipo: ', v_tipo_transacao, ', Valor: R$', v_valor, ', Descrição: ', IFNULL(v_descricao, '')) AS InfoTransacao;
            END LOOP;

            CLOSE cur_transacoes;
        END;
    END LOOP;

    CLOSE cur_processos;
END//

DELIMITER ;

-- ==========================================
-- TRIGGERS
-- ==========================================

DELIMITER //
CREATE TRIGGER after_insert_transacao_financeira
AFTER INSERT ON transacoesfinanceiras
FOR EACH ROW
BEGIN
    CALL AtualizarSaldosProcesso(NEW.processo_id);
END//

CREATE TRIGGER after_update_transacao_financeira
AFTER UPDATE ON transacoesfinanceiras
FOR EACH ROW
BEGIN
    IF OLD.valor <> NEW.valor OR OLD.tipo_transacao <> NEW.tipo_transacao THEN
        CALL AtualizarSaldosProcesso(NEW.processo_id);
    END IF;
END//

CREATE TRIGGER after_delete_transacao_financeira
AFTER DELETE ON transacoesfinanceiras
FOR EACH ROW
BEGIN
    CALL AtualizarSaldosProcesso(OLD.processo_id);
END//

CREATE TRIGGER before_insert_agendamento
BEFORE INSERT ON agendamentos
FOR EACH ROW
BEGIN
    IF NEW.cliente_id IS NULL AND NEW.nome_cliente_agendamento IS NOT NULL THEN
        SELECT cliente_id INTO @existing_client_id FROM clientes WHERE nome = NEW.nome_cliente_agendamento LIMIT 1;
        IF @existing_client_id IS NULL THEN
            INSERT INTO clientes (nome, cpf, telefone, endereco) VALUES (NEW.nome_cliente_agendamento, '000.000.000-00', '', '');
            SET NEW.cliente_id = LAST_INSERT_ID();
        ELSE
            SET NEW.cliente_id = @existing_client_id;
        END IF;
    END IF;
END//
DELIMITER ;
