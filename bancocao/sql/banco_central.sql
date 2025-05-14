CREATE DATABASE IF NOT EXISTS banco_central;
USE banco_central;

CREATE TABLE IF NOT EXISTS transacoes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    conta_origem VARCHAR(20) NOT NULL,
    banco_origem VARCHAR(50) NOT NULL,
    conta_destino VARCHAR(20) NOT NULL,
    banco_destino VARCHAR(50) NOT NULL,
    valor DECIMAL(10,2) NOT NULL,
    status ENUM('pendente', 'processada', 'erro') DEFAULT 'pendente',
    data DATETIME DEFAULT CURRENT_TIMESTAMP
);