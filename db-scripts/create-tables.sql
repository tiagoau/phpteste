CREATE DATABASE 'financas';

CREATE TABLE `pessoa` (
  `id` int NOT NULL AUTO_INCREMENT,
  `cpf` bigint NOT NULL,
  `nome` varchar(60) NOT NULL,
  `sexo` char(1) DEFAULT NULL,
  `criado_em` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cpf_UNIQUE` (`cpf`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='Proprietário de uma conta';

CREATE TABLE `conta_pesssoa` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_pessoa_fk` int NOT NULL,
  `operacao` char(1) NOT NULL,
  `transferencia` tinyint NOT NULL DEFAULT '0',
  `valor` decimal(15,2) NOT NULL,
  `saldo` decimal(15,2) NOT NULL DEFAULT '0.00',
  `id_conta_pessoa_transferencia` int DEFAULT NULL COMMENT 'informa a conta relacionada a transferencia',
  `gerado_em` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`,`transferencia`),
  KEY `id_pessoa_fk_idx` (`id_pessoa_fk`),
  CONSTRAINT `id_pessoa_fk` FOREIGN KEY (`id_pessoa_fk`) REFERENCES `pessoa` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='Conta de uma pessoa, onde são realizadas as operações financeiras';






