-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.1.10-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win32
-- HeidiSQL Versão:              9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Copiando estrutura do banco de dados para dw
CREATE DATABASE IF NOT EXISTS `dw` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `dw`;

-- Copiando estrutura para tabela dw.admin
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

-- Copiando dados para a tabela dw.admin: ~0 rows (aproximadamente)
DELETE FROM `admin`;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;

-- Copiando estrutura para tabela dw.contato
CREATE TABLE IF NOT EXISTS `contato` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `texto` text NOT NULL,
  `telefone` varchar(50) NOT NULL,
  `nome` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela dw.contato: ~0 rows (aproximadamente)
DELETE FROM `contato`;
/*!40000 ALTER TABLE `contato` DISABLE KEYS */;
/*!40000 ALTER TABLE `contato` ENABLE KEYS */;

-- Copiando estrutura para tabela dw.migration
CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela dw.migration: ~0 rows (aproximadamente)
DELETE FROM `migration`;
/*!40000 ALTER TABLE `migration` DISABLE KEYS */;
/*!40000 ALTER TABLE `migration` ENABLE KEYS */;

-- Copiando estrutura para tabela dw.pagseguro_assinatura
CREATE TABLE IF NOT EXISTS `pagseguro_assinatura` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_information_id` int(7) NOT NULL,
  `planos_id` int(4) NOT NULL,
  `ref` varchar(32) NOT NULL,
  `code` text,
  `create` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `tracker` varchar(15) NOT NULL,
  `status_id` int(3) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ref` (`ref`),
  KEY `FK_pagseguro_transacao_user_information` (`user_information_id`),
  KEY `FK_pagseguro_transacao_planos` (`planos_id`),
  KEY `FK_pagseguro_transacao_pagseguro_assinatura_status` (`status_id`),
  CONSTRAINT `FK_pagseguro_transacao_pagseguro_assinatura_status` FOREIGN KEY (`status_id`) REFERENCES `pagseguro_assinatura_status` (`id`),
  CONSTRAINT `FK_pagseguro_transacao_planos` FOREIGN KEY (`planos_id`) REFERENCES `planos` (`id`),
  CONSTRAINT `FK_pagseguro_transacao_user_information` FOREIGN KEY (`user_information_id`) REFERENCES `user_information` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela dw.pagseguro_assinatura: ~7 rows (aproximadamente)
DELETE FROM `pagseguro_assinatura`;
/*!40000 ALTER TABLE `pagseguro_assinatura` DISABLE KEYS */;
INSERT INTO `pagseguro_assinatura` (`id`, `user_information_id`, `planos_id`, `ref`, `code`, `create`, `updated`, `tracker`, `status_id`) VALUES
	(15, 9, 2, 'c16567c2c9dfe94a8b40eb11f8c741f2', 'C9AEB33CE9E96E1BB4C03FA5251FD1FA', '2017-04-10 12:53:15', '2017-04-10 14:24:09', 'AF436E', 2);
/*!40000 ALTER TABLE `pagseguro_assinatura` ENABLE KEYS */;

-- Copiando estrutura para tabela dw.pagseguro_assinatura_status
CREATE TABLE IF NOT EXISTS `pagseguro_assinatura_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(25) NOT NULL,
  `significado` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela dw.pagseguro_assinatura_status: ~9 rows (aproximadamente)
DELETE FROM `pagseguro_assinatura_status`;
/*!40000 ALTER TABLE `pagseguro_assinatura_status` DISABLE KEYS */;
INSERT INTO `pagseguro_assinatura_status` (`id`, `status`, `significado`) VALUES
	(0, 'INITIATED', 'O comprador iniciou o processo de pagamento, mas abandonou o checkout e não concluiu a compra.'),
	(1, 'PENDING', 'O processo de pagamento foi concluído e transação está em análise ou aguardando a confirmação da operadora.'),
	(2, 'ACTIVE', 'A criação da recorrência, transação validadora ou transação recorrente foi aprovada.'),
	(3, 'PAYMENT_METHOD_CHANGE', 'Uma transação retornou como "Cartão Expirado, Cancelado ou Bloqueado" e o cartão da recorrência precisa ser substituído pelo comprador.'),
	(4, 'SUSPENDED', 'A recorrência foi suspensa pelo vendedor.'),
	(5, 'CANCELLED', 'A criação da recorrência foi cancelada pelo PagSeguro.'),
	(6, 'EXPIRED', 'A recorrência expirou por atingir a data limite da vigência ou por ter atingido o valor máximo de cobrança definido na cobrança do plano.'),
	(7, 'CANCELLED_BY_RECEIVER', 'A recorrência foi cancelada a pedido do vendedor.'),
	(8, 'CANCELLED_BY_SENDER', 'A recorrência foi cancelada a pedido do comprador.'),
	(99, 'INVALID_PARAMS', 'O parametro passado é invalido');
/*!40000 ALTER TABLE `pagseguro_assinatura_status` ENABLE KEYS */;

-- Copiando estrutura para tabela dw.pagseguro_erro
CREATE TABLE IF NOT EXISTS `pagseguro_erro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` int(2) NOT NULL,
  `resolvido` int(2) NOT NULL DEFAULT '0',
  `noticacao_codigo` text NOT NULL,
  `localizacao_erro` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela dw.pagseguro_erro: ~3 rows (aproximadamente)
DELETE FROM `pagseguro_erro`;
/*!40000 ALTER TABLE `pagseguro_erro` DISABLE KEYS */;
INSERT INTO `pagseguro_erro` (`id`, `tipo`, `resolvido`, `noticacao_codigo`, `localizacao_erro`) VALUES
	(1, 2, 0, '0A230FF6C9DCC9DC92A004376FAA76EF94FE', 'Não localizado a assinatura atraves da referencia'),
	(2, 2, 0, '0A230FF6C9DCC9DC92A004376FAA76EF94FE', 'Não localizado a assinatura atraves da referencia'),
	(3, 2, 0, '0A230FF6C9DCC9DC92A004376FAA76EF94FE', 'Não localizado a assinatura atraves da referencia');
/*!40000 ALTER TABLE `pagseguro_erro` ENABLE KEYS */;

-- Copiando estrutura para tabela dw.pagseguro_transacao_pagamento
CREATE TABLE IF NOT EXISTS `pagseguro_transacao_pagamento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` text NOT NULL,
  `ref` varchar(32) NOT NULL,
  `status` int(3) NOT NULL,
  `create` datetime NOT NULL,
  `last_update` datetime NOT NULL,
  `valor_pago` decimal(4,2) NOT NULL,
  `valor_recebimento` decimal(4,2) NOT NULL,
  `tempo_adicionado` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_pagseguro_transacao_pagamento_pagseguro_transacao_status` (`status`),
  KEY `FK_pagseguro_transacao_pagamento_pagseguro_assinatura` (`ref`),
  CONSTRAINT `FK_pagseguro_transacao_pagamento_pagseguro_assinatura` FOREIGN KEY (`ref`) REFERENCES `pagseguro_assinatura` (`ref`),
  CONSTRAINT `FK_pagseguro_transacao_pagamento_pagseguro_transacao_status` FOREIGN KEY (`status`) REFERENCES `pagseguro_transacao_status` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Aqui vai ficar registrado o pagamento de cada transação ';

-- Copiando dados para a tabela dw.pagseguro_transacao_pagamento: ~0 rows (aproximadamente)
DELETE FROM `pagseguro_transacao_pagamento`;
/*!40000 ALTER TABLE `pagseguro_transacao_pagamento` DISABLE KEYS */;
/*!40000 ALTER TABLE `pagseguro_transacao_pagamento` ENABLE KEYS */;

-- Copiando estrutura para tabela dw.pagseguro_transacao_status
CREATE TABLE IF NOT EXISTS `pagseguro_transacao_status` (
  `id` int(3) NOT NULL,
  `nome` varchar(20) NOT NULL,
  `significado` text NOT NULL,
  `nome_ficticio` varchar(20) NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela dw.pagseguro_transacao_status: ~7 rows (aproximadamente)
DELETE FROM `pagseguro_transacao_status`;
/*!40000 ALTER TABLE `pagseguro_transacao_status` DISABLE KEYS */;
INSERT INTO `pagseguro_transacao_status` (`id`, `nome`, `significado`, `nome_ficticio`) VALUES
	(1, 'Agendada', '', ''),
	(2, 'Processando', '', ''),
	(3, 'Não Processada', '', ''),
	(4, 'Suspensa', '', ''),
	(5, 'Paga', '', ''),
	(6, 'Não Paga', '', ''),
	(9, 'nao pago', '', 'sem dinheiro');
/*!40000 ALTER TABLE `pagseguro_transacao_status` ENABLE KEYS */;

-- Copiando estrutura para tabela dw.planos
CREATE TABLE IF NOT EXISTS `planos` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `active` tinyint(2) NOT NULL DEFAULT '0',
  `title` varchar(25) NOT NULL,
  `price` decimal(4,2) NOT NULL,
  `list_info` text NOT NULL,
  `day` int(5) NOT NULL DEFAULT '30',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela dw.planos: ~3 rows (aproximadamente)
DELETE FROM `planos`;
/*!40000 ALTER TABLE `planos` DISABLE KEYS */;
INSERT INTO `planos` (`id`, `active`, `title`, `price`, `list_info`, `day`, `create_at`, `update_at`) VALUES
	(1, 1, 'Exemplo save ', 15.50, '', 60, '2017-03-23 16:02:35', '2017-02-08 20:22:23'),
	(2, 1, 'Exemplo 122', 30.00, '["Dados : 100000","Teste"]', 90, '2017-03-29 14:45:46', '2017-02-08 20:25:42'),
	(3, 1, 'Exemplo 1', 24.00, '["Dados : 100000","Teste"]', 30, '2017-02-08 20:51:44', '2017-02-08 20:51:21');
/*!40000 ALTER TABLE `planos` ENABLE KEYS */;

-- Copiando estrutura para tabela dw.session
CREATE TABLE IF NOT EXISTS `session` (
  `id` char(40) NOT NULL,
  `expire` int(11) DEFAULT NULL,
  `data` blob,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela dw.session: ~16 rows (aproximadamente)
DELETE FROM `session`;
/*!40000 ALTER TABLE `session` DISABLE KEYS */;
INSERT INTO `session` (`id`, `expire`, `data`) VALUES
	('07lg842nkbpqm6ka0g3rmtal85', 1489855364, _binary 0x5F5F666C6173687C613A303A7B7D5F5F69647C693A32383B),
	('4qrbblj9d90tk1v1cvip77hsj2', 1490217635, _binary 0x5F5F666C6173687C613A303A7B7D5F5F69647C693A32383B),
	('68kcumhqnmvj0l0m6uhftcehl6', 1491344151, _binary 0x5F5F666C6173687C613A303A7B7D5F5F69647C693A32383B),
	('6j5p62g14kd5g39tsmc9rnate4', 1488553434, _binary 0x5F5F666C6173687C613A303A7B7D5F5F69647C693A32383B),
	('6m43r1i28md2cgtkuvujkt65i1', 1489666118, _binary 0x5F5F666C6173687C613A303A7B7D5F5F69647C693A32383B),
	('6u0dr6mm5do8ll52op5rcle025', 1491401942, _binary 0x5F5F666C6173687C613A303A7B7D5F5F69647C693A32383B),
	('7vh9ge4i9s54jr6q8r9vrimq86', 1490461745, _binary 0x5F5F666C6173687C613A303A7B7D5F5F69647C693A32383B),
	('9esgvbbdb8bj6sjkba5tarart0', 1491401957, _binary 0x5F5F666C6173687C613A303A7B7D5F5F69647C693A32383B),
	('b5qa4442vdorgih5kvql3gci56', 1490455607, _binary 0x5F5F666C6173687C613A303A7B7D5F5F69647C693A32383B),
	('bq3qqjmpa015jihvscvbnfvcj3', 1491584628, _binary 0x5F5F666C6173687C613A303A7B7D),
	('ctua2ajhu4a4p1k8cnu43t6rn0', 1490987498, _binary 0x5F5F666C6173687C613A303A7B7D5F5F69647C693A32383B),
	('fnm37tlvuo45js6ku28a62svp5', 1491841791, _binary 0x5F5F666C6173687C613A303A7B7D5F5F72657475726E55726C7C733A32323A222F626C756562692F736974652F706167616D656E746F223B5F5F69647C693A32383B),
	('ik06c4h2auev8lr0s2drc50c62', 1490819651, _binary 0x5F5F666C6173687C613A303A7B7D5F5F69647C693A32383B),
	('ls6evn3q2f9hri4019e8s27t50', 1490141649, _binary 0x5F5F666C6173687C613A303A7B7D),
	('ncg05agi7t7ijb95ghjmfra851', 1490214828, _binary 0x5F5F666C6173687C613A303A7B7D),
	('v38vara3bqfch3sm78vvl93qr3', 1491351450, _binary 0x5F5F666C6173687C613A303A7B7D5F5F69647C693A32383B);
/*!40000 ALTER TABLE `session` ENABLE KEYS */;

-- Copiando estrutura para tabela dw.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Copiando dados para a tabela dw.user: ~7 rows (aproximadamente)
DELETE FROM `user`;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`) VALUES
	(20, 'teste', 'RmRRn3SpAn_a5p-kzxLat2EaRuOWjORI', '$2y$13$ZusWuDxFAuHHrHUeNicJQ.YlDN2FbflQZc/fm2kbG./PVcjj8L712', NULL, 'juniogro10@hotmail.com', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(21, 'teste1', 'xTK9sgUgDXw_QrlYfP4UbMQcALMsx9-1', '$2y$13$d4w1JCzpMzsi2/SzW0JX0eI1HasDL3ktB3Ofjg2YI6iZAx5fpAv3m', NULL, 'teste@hotmail.com', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(23, 'teste2', 'hubCo0wNZgeyjnJdbgzqZblOjw7I6VOH', '$2y$13$uJQO3hwCN4VnGeyhh83Ws.38qTTGUM8GyyxgzQcm8sHpphcyk7zt.', NULL, 'juniro10@hotmail.com', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(24, 'teste3', 'TAblaodkfilDs6D-KIcTmqw8896ZJ1Z5', '$2y$13$Vs4uarYDZUVDtZV6twckt.D21ZKj4A9lt3EltB/Z52Xpzj2MaFWa2', NULL, 'juniogro@hotmail.com', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(25, 'teste10', 'T5Do-pFQujE1oNGqiJtqldnzHRNyNPW9', '$2y$13$bKOofGek2LP9hpUDjZhQr.6slFzMRW9c/8gIYewgawMYUIfbY8HC.', NULL, 'teste10@hotmail.com', 10, '2017-02-15 12:01:20', '0000-00-00 00:00:00'),
	(27, 'teste222', 's8og9Ot1MC51t0z-Mo37Spb7t8P7Lbqv', '$2y$13$MbYj2Ujx8N7y51Z6aKqlMOm2ZsxXsHvVjfQziGNDSljn0NgjXpk2q', NULL, 'juniogro2sada@hotmail.com', 5, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(28, 'teste99', '3-ArXPHojHLOzrEu0RZT1z4iBl7Pw5kI', '$2y$13$T2KCwWRLrCksGY4nowe8muw3vWPrJAtaHac9KEtLrjDEy7q8bcBTq', NULL, 'juniogro122@hotmail.com', 10, '2017-03-03 14:39:50', '0000-00-00 00:00:00');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

-- Copiando estrutura para tabela dw.user_information
CREATE TABLE IF NOT EXISTS `user_information` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `id_user` int(10) NOT NULL,
  `cpf` bigint(20) NOT NULL,
  `nome` text NOT NULL,
  `sobrenome` text NOT NULL,
  `telefone` text NOT NULL,
  `id_pagamento_tipo` int(3) DEFAULT NULL,
  `cartao_truncado` text,
  `token_cielo` text,
  `bandeira` text,
  `licenca_limite` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cpf` (`cpf`),
  KEY `FK_user_information_user` (`id_user`),
  KEY `FK_user_information_pagamento_tipo` (`id_pagamento_tipo`),
  CONSTRAINT `FK_user_information_pagamento_tipo` FOREIGN KEY (`id_pagamento_tipo`) REFERENCES `pagamento_tipo` (`id`),
  CONSTRAINT `FK_user_information_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela dw.user_information: ~6 rows (aproximadamente)
DELETE FROM `user_information`;
/*!40000 ALTER TABLE `user_information` DISABLE KEYS */;
INSERT INTO `user_information` (`id`, `id_user`, `cpf`, `nome`, `sobrenome`, `telefone`, `id_pagamento_tipo`, `cartao_truncado`, `token_cielo`, `bandeira`, `licenca_limite`, `created_at`, `updated_at`) VALUES
	(2, 20, 13725757742, 'Mauricio Vicente', 'Vicente', '(21) 25019-666_', NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', '2017-02-10 11:04:36', '2017-02-10 11:04:36'),
	(3, 21, 13725752222, 'Mauricio', 'Vicente', '(21) 25019-666', NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', '2017-02-10 11:09:09', '2017-02-10 11:09:09'),
	(5, 24, 13333333333, 'Mauricio', 'Vicente', '(21) 25019-666', NULL, NULL, NULL, NULL, '2017-03-12 12:26:51', '2017-04-04 22:38:34', '2017-04-04 22:38:34'),
	(6, 25, 13725757741, 'amsdadsa', 'dsada', '(21) 25019-666', NULL, NULL, NULL, NULL, '2017-03-10 13:01:06', '2017-03-03 14:19:00', '2017-03-03 14:19:00'),
	(8, 27, 13725757711, 'Mauricio Eu mesmo', 'Mesmo mesmo mesmo', '(21) 97205-9393', NULL, NULL, NULL, NULL, '2017-04-02 14:23:38', '2017-03-03 14:25:03', '2017-03-03 14:25:03'),
	(9, 28, 13725757747, 'Mauricio ', 'Eu mesmo', '(21) 97205-9393', NULL, NULL, NULL, NULL, '2017-04-02 14:26:47', '2017-03-03 14:26:47', '2017-03-03 14:26:47');
/*!40000 ALTER TABLE `user_information` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
