-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 23-Abr-2021 às 00:19
-- Versão do servidor: 10.4.16-MariaDB
-- versão do PHP: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `vocati29_vocationalbd`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `area`
--

CREATE TABLE `area` (
  `id_area` int(5) NOT NULL,
  `nome_area` varchar(50) NOT NULL,
  `descricao` text NOT NULL,
  `num_favorite` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `area`
--

INSERT INTO `area` (`id_area`, `nome_area`, `descricao`, `num_favorite`) VALUES
(0, 'segurança da Informação', 'É o ramo da tecnologia da informação (TI) que busca manter a segurança e integridade dos dados que navegam pela principalmente pela internet e pelos sistemas de armazenamentos em nuvens, de forma que os dados fiquem disponíveis apenas para usuários autorizados de forma que não sofram manipulações por parte de pessoas indevidas e que estejam disponíveis apenas quando for necessário.\r\nUma das formas de se entrar nessa área é procurando um curso tecnólogo de segurança da informação, para os que já possuem algum tipo de graduação em TI, é possível fazer uma Pós-Graduação ou especialização em segurança.\r\nO profissional de segurança da informação tem uma média salarial de R$ 9.500,00.', 10),
(1, 'programação', 'É um processo de escrita de códigos com o intuito de se obter um sistema usando as linguagens adequadas.', 15);

-- --------------------------------------------------------

--
-- Estrutura da tabela `curso`
--

CREATE TABLE `curso` (
  `id_curso` int(5) NOT NULL,
  `nome_curso` varchar(50) NOT NULL,
  `preco` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `favorito_usuario`
--

CREATE TABLE `favorito_usuario` (
  `id_favorito` int(20) NOT NULL,
  `id_usuario` int(10) NOT NULL,
  `id_area` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `favorito_usuario`
--

INSERT INTO `favorito_usuario` (`id_favorito`, `id_usuario`, `id_area`) VALUES
(5, 2, 0),
(6, 2, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `profissao`
--

CREATE TABLE `profissao` (
  `id_profissao` int(5) NOT NULL,
  `nome_profissao` varchar(50) NOT NULL,
  `salario` decimal(10,2) NOT NULL,
  `id_area` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `profissao`
--

INSERT INTO `profissao` (`id_profissao`, `nome_profissao`, `salario`, `id_area`) VALUES
(1, 'analista de segurança', '3145.00', 0),
(2, 'Desenvolvedor Java', '3350.00', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(10) NOT NULL,
  `nome_usuario` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(32) NOT NULL,
  `administrador` int(1) NOT NULL DEFAULT 0,
  `areas` varchar(300) DEFAULT NULL,
  `verificacao` int(1) DEFAULT 0,
  `token` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nome_usuario`, `email`, `senha`, `administrador`, `areas`, `verificacao`, `token`) VALUES
(1, 'Diogemaz', 'diogemaz@gmail.com', '202cb962ac59075b964b07152d234b70', 1, NULL, 0, 'fb4102f6e16fe9931ddcfe0a8ec80614'),
(2, 'Felipe', 'felipe@hotmail.com', '202cb962ac59075b964b07152d234b70', 0, NULL, 0, '8fe863573a42ae1ec12c4d3c1d591c6d');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`id_area`);

--
-- Índices para tabela `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`id_curso`);

--
-- Índices para tabela `favorito_usuario`
--
ALTER TABLE `favorito_usuario`
  ADD PRIMARY KEY (`id_favorito`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_area` (`id_area`);

--
-- Índices para tabela `profissao`
--
ALTER TABLE `profissao`
  ADD PRIMARY KEY (`id_profissao`),
  ADD KEY `id_area` (`id_area`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `area`
--
ALTER TABLE `area`
  MODIFY `id_area` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `curso`
--
ALTER TABLE `curso`
  MODIFY `id_curso` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `favorito_usuario`
--
ALTER TABLE `favorito_usuario`
  MODIFY `id_favorito` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `profissao`
--
ALTER TABLE `profissao`
  MODIFY `id_profissao` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `favorito_usuario`
--
ALTER TABLE `favorito_usuario`
  ADD CONSTRAINT `favorito_usuario_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `favorito_usuario_ibfk_2` FOREIGN KEY (`id_area`) REFERENCES `area` (`id_area`);

--
-- Limitadores para a tabela `profissao`
--
ALTER TABLE `profissao`
  ADD CONSTRAINT `profissao_ibfk_1` FOREIGN KEY (`id_area`) REFERENCES `area` (`id_area`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
