-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 22-Ago-2021 às 14:56
-- Versão do servidor: 10.4.20-MariaDB
-- versão do PHP: 7.4.22

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
(1, 'Segurança da informação', 'É o ramo da tecnologia da informação (TI) que busca manter a segurança e integridade dos dados que navegam pela principalmente pela internet e pelos sistemas de armazenamentos em nuvens, de forma que os dados fiquem disponíveis apenas para usuários autorizados de forma que não sofram manipulações por parte de pessoas indevidas e que estejam disponíveis apenas quando for necessário.\r\nUma das formas de se entrar nessa área é procurando um curso tecnólogo de segurança da informação, para os que já possuem algum tipo de graduação em TI, é possível fazer uma Pós-Graduação ou especialização em segurança.\r\nO profissional de segurança da informação tem uma média salarial de R$ 9.500,00.', 0),
(3, 'Desenvolvimento', 'É um processo de escrita de códigos com o intuito de se obter um sistema usando as linguagens adequadas.', 0),
(4, 'BI', 'Utiliza ferramentas para analise e predição de dados ', 0),
(5, 'DevOps', 'Área que aproxima o desenvolvimento e o cliente, melhorando as entregas', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `avaliacao_area`
--

CREATE TABLE `avaliacao_area` (
  `id_avaliacaoArea` int(100) NOT NULL,
  `id_area` int(10) NOT NULL,
  `id_usuario` int(10) NOT NULL,
  `like_deslike` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `avaliacao_area`
--

INSERT INTO `avaliacao_area` (`id_avaliacaoArea`, `id_area`, `id_usuario`, `like_deslike`) VALUES
(1, 1, 2, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `avaliacao_profissao`
--

CREATE TABLE `avaliacao_profissao` (
  `id_avaliacaoProfissao` int(100) NOT NULL,
  `id_profissao` int(10) NOT NULL,
  `id_usuario` int(10) NOT NULL,
  `like_deslike` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `avaliacao_profissao`
--

INSERT INTO `avaliacao_profissao` (`id_avaliacaoProfissao`, `id_profissao`, `id_usuario`, `like_deslike`) VALUES
(1, 4, 2, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `comentario_area`
--

CREATE TABLE `comentario_area` (
  `id_comentarioArea` int(10) NOT NULL,
  `comentario` text NOT NULL,
  `id_usuario` int(10) NOT NULL,
  `id_area` int(10) NOT NULL,
  `data_comentario` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `comentario_profissao`
--

CREATE TABLE `comentario_profissao` (
  `id_comentarioProfissao` int(10) NOT NULL,
  `comentario` text NOT NULL,
  `id_usuario` int(10) NOT NULL,
  `id_profissao` int(10) NOT NULL,
  `data_comentario` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `curso`
--

CREATE TABLE `curso` (
  `id_curso` int(5) NOT NULL,
  `nome_curso` varchar(50) NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `link` varchar(120) NOT NULL,
  `id_profissao` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `curso`
--

INSERT INTO `curso` (`id_curso`, `nome_curso`, `preco`, `link`, `id_profissao`) VALUES
(3, 'cisco - cyberops associate', '0.00', 'https://www.cisco.com/c/en/us/training-events/training-certifications/certifications/associate/cyberops-associate.html', 4),
(4, 'Microsserviços Java com Spring Boot e Spring Cloud', '209.90', 'https://www.udemy.com/course/microsservicos-java-spring-cloud/', 3);

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
(1, 2, 1),
(2, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `notificacao`
--

CREATE TABLE `notificacao` (
  `id_notificacao` int(100) NOT NULL,
  `id_area` int(10) NOT NULL,
  `item` text NOT NULL,
  `id_usuario` int(10) NOT NULL,
  `link` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `notificacao`
--

INSERT INTO `notificacao` (`id_notificacao`, `id_area`, `item`, `id_usuario`, `link`) VALUES
(1, 1, 'Nova Profissão', 1, 'view/areas.php');

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
(3, 'Programador java junior', '3200.00', 3),
(4, 'analista de segurança ', '2600.00', 1);

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
  `token` varchar(32) NOT NULL,
  `foto` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nome_usuario`, `email`, `senha`, `administrador`, `areas`, `verificacao`, `token`, `foto`) VALUES
(1, 'Diogenes P', 'diogemaz@gmail.com', '202cb962ac59075b964b07152d234b70', 1, NULL, 1, 'fb4102f6e16fe9931ddcfe0a8ec80614', NULL),
(2, 'Felipe N', 'felipe@hotmail.com', '202cb962ac59075b964b07152d234b70', 0, NULL, 0, '8fe863573a42ae1ec12c4d3c1d591c6d', NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`id_area`);

--
-- Índices para tabela `avaliacao_area`
--
ALTER TABLE `avaliacao_area`
  ADD PRIMARY KEY (`id_avaliacaoArea`),
  ADD KEY `FK_avaliacao_area` (`id_area`),
  ADD KEY `FK_avaliacao_area_usuario` (`id_usuario`);

--
-- Índices para tabela `avaliacao_profissao`
--
ALTER TABLE `avaliacao_profissao`
  ADD PRIMARY KEY (`id_avaliacaoProfissao`),
  ADD KEY `FK_avaliacao_profissao` (`id_profissao`),
  ADD KEY `FK_avaliacao_profissao_usuario` (`id_usuario`);

--
-- Índices para tabela `comentario_area`
--
ALTER TABLE `comentario_area`
  ADD PRIMARY KEY (`id_comentarioArea`),
  ADD KEY `fk_comentario_area` (`id_area`),
  ADD KEY `fk_comentario_usuario` (`id_usuario`);

--
-- Índices para tabela `comentario_profissao`
--
ALTER TABLE `comentario_profissao`
  ADD PRIMARY KEY (`id_comentarioProfissao`),
  ADD KEY `fk_comentario_prof_usuario` (`id_usuario`),
  ADD KEY `fk_comentario_profissao` (`id_profissao`);

--
-- Índices para tabela `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`id_curso`),
  ADD KEY `fk_Profissao_Curso` (`id_profissao`);

--
-- Índices para tabela `favorito_usuario`
--
ALTER TABLE `favorito_usuario`
  ADD PRIMARY KEY (`id_favorito`),
  ADD KEY `favorito_usuario_ibfk_1` (`id_usuario`),
  ADD KEY `favorito_usuario_ibfk_2` (`id_area`);

--
-- Índices para tabela `notificacao`
--
ALTER TABLE `notificacao`
  ADD PRIMARY KEY (`id_notificacao`),
  ADD KEY `fk_area_notificacao` (`id_area`),
  ADD KEY `fk_usuario_notificacao` (`id_usuario`);

--
-- Índices para tabela `profissao`
--
ALTER TABLE `profissao`
  ADD PRIMARY KEY (`id_profissao`),
  ADD KEY `profissao_ibfk_1` (`id_area`);

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
  MODIFY `id_area` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `avaliacao_area`
--
ALTER TABLE `avaliacao_area`
  MODIFY `id_avaliacaoArea` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `avaliacao_profissao`
--
ALTER TABLE `avaliacao_profissao`
  MODIFY `id_avaliacaoProfissao` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `comentario_area`
--
ALTER TABLE `comentario_area`
  MODIFY `id_comentarioArea` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `comentario_profissao`
--
ALTER TABLE `comentario_profissao`
  MODIFY `id_comentarioProfissao` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `curso`
--
ALTER TABLE `curso`
  MODIFY `id_curso` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `favorito_usuario`
--
ALTER TABLE `favorito_usuario`
  MODIFY `id_favorito` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `notificacao`
--
ALTER TABLE `notificacao`
  MODIFY `id_notificacao` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `profissao`
--
ALTER TABLE `profissao`
  MODIFY `id_profissao` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `avaliacao_area`
--
ALTER TABLE `avaliacao_area`
  ADD CONSTRAINT `FK_avaliacao_area` FOREIGN KEY (`id_area`) REFERENCES `area` (`id_area`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_avaliacao_area_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `avaliacao_profissao`
--
ALTER TABLE `avaliacao_profissao`
  ADD CONSTRAINT `FK_avaliacao_profissao` FOREIGN KEY (`id_profissao`) REFERENCES `profissao` (`id_profissao`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_avaliacao_profissao_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `comentario_area`
--
ALTER TABLE `comentario_area`
  ADD CONSTRAINT `fk_comentario_area` FOREIGN KEY (`id_area`) REFERENCES `area` (`id_area`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_comentario_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `comentario_profissao`
--
ALTER TABLE `comentario_profissao`
  ADD CONSTRAINT `fk_comentario_prof_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_comentario_profissao` FOREIGN KEY (`id_profissao`) REFERENCES `profissao` (`id_profissao`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `curso`
--
ALTER TABLE `curso`
  ADD CONSTRAINT `fk_ProfissaoCurso` FOREIGN KEY (`id_profissao`) REFERENCES `profissao` (`id_profissao`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_Profissao_Curso` FOREIGN KEY (`id_profissao`) REFERENCES `profissao` (`id_profissao`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `favorito_usuario`
--
ALTER TABLE `favorito_usuario`
  ADD CONSTRAINT `favorito_usuario_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `favorito_usuario_ibfk_2` FOREIGN KEY (`id_area`) REFERENCES `area` (`id_area`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `notificacao`
--
ALTER TABLE `notificacao`
  ADD CONSTRAINT `fk_area_notificacao` FOREIGN KEY (`id_area`) REFERENCES `area` (`id_area`),
  ADD CONSTRAINT `fk_usuario_notificacao` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);

--
-- Limitadores para a tabela `profissao`
--
ALTER TABLE `profissao`
  ADD CONSTRAINT `profissao_ibfk_1` FOREIGN KEY (`id_area`) REFERENCES `area` (`id_area`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
