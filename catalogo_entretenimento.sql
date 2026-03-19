-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 20/11/2025 às 05:50
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `catalogo_entretenimento`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `avaliacoes`
--

CREATE TABLE `avaliacoes` (
  `id` int(11) NOT NULL,
  `tipo` varchar(20) DEFAULT NULL,
  `id_item` int(11) DEFAULT NULL,
  `nota` int(11) DEFAULT NULL,
  `comentario` text DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `avaliacoes`
--

INSERT INTO `avaliacoes` (`id`, `tipo`, `id_item`, `nota`, `comentario`, `id_usuario`) VALUES
(18, 'filme', 29, 5, 'boa', 67),
(19, 'filme', 30, 5, 'Um dos melhores filmes que eu já assisti. Jackie Chan sempre lendário.', 71),
(20, 'filme', 28, 5, 'Ótimo filme!!!', 75),
(21, 'filme', 27, 5, 'Muito bom!', 75),
(22, 'anime', 39, 5, 'Muito Bom!', 1),
(23, 'anime', 39, 2, 'Até que é legal!', 75);

-- --------------------------------------------------------

--
-- Estrutura para tabela `generos`
--

CREATE TABLE `generos` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `generos`
--

INSERT INTO `generos` (`id`, `nome`) VALUES
(68, 'Ação'),
(69, 'Aventura'),
(70, 'Animação'),
(71, 'Apocalipse'),
(72, 'Artes Marciais'),
(73, 'Biografia'),
(74, 'Comédia'),
(75, 'Crime'),
(76, 'Cyberpunk'),
(77, 'Detetive'),
(78, 'Documentário'),
(79, 'Drama'),
(80, 'Esporte'),
(81, 'Fantasia'),
(82, 'Família'),
(83, 'Ficção Científica'),
(84, 'Guerra'),
(85, 'Histórico'),
(86, 'Horror'),
(87, 'Isekai'),
(88, 'Josei'),
(89, 'Magia'),
(90, 'Mecha'),
(91, 'Mistério'),
(92, 'Mitologia'),
(93, 'Musical'),
(94, 'Policial'),
(95, 'Política'),
(96, 'Psicológico'),
(97, 'Romance'),
(98, 'Seinen'),
(99, 'Shoujo'),
(100, 'Shounen'),
(101, 'Slice of Life'),
(102, 'Sobrenatural'),
(103, 'Steampunk'),
(104, 'Superpoder'),
(105, 'Suspense'),
(106, 'Sobrevivência'),
(107, 'Thriller'),
(108, 'Terror'),
(109, 'Western');

-- --------------------------------------------------------

--
-- Estrutura para tabela `midias`
--

CREATE TABLE `midias` (
  `id` int(11) NOT NULL,
  `tipo` enum('filme','serie','anime') NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `sinopse` text DEFAULT NULL,
  `trailer` text DEFAULT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  `ano` int(11) DEFAULT NULL,
  `destaque` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `midias`
--

INSERT INTO `midias` (`id`, `tipo`, `titulo`, `sinopse`, `trailer`, `imagem`, `ano`, `destaque`) VALUES
(27, 'filme', 'Matrix', 'Neo, um hacker insatisfeito com sua vida, descobre que o mundo em que vive é uma simulação criada por máquinas que escravizam a humanidade. Junto a Morpheus e Trinity, ele aprende habilidades sobre-humanas e enfrenta agentes poderosos para libertar a mente das pessoas.', 'https://www.youtube.com/watch?v=vKQi3bBA1y8&pp=ygUPdHJhaWxlciBtYXRyaXgg', 'https://br.web.img2.acsta.net/medias/nmedia/18/91/08/82/20128877.JPG', 2000, 1),
(28, 'filme', 'Homem-Aranha', 'Peter Parker, um adolescente comum, é mordido por uma aranha geneticamente modificada e ganha superpoderes. Ele precisa aprender a equilibrar sua vida pessoal e responsabilidades como herói, enfrentando o vilão Duende Verde para proteger Nova York.', 'https://www.youtube.com/watch?v=t06RUxPbp_c', 'https://upload.wikimedia.org/wikipedia/pt/1/14/Spide-Man_Poster.jpg', 2002, 1),
(29, 'filme', 'O Pequenino', 'Calvin, um ladrão pequeno e travesso, é colocado como “bebê” em uma família para recuperar um diamante roubado. Suas travessuras causam caos e muitas risadas enquanto tenta completar seu plano sem ser descoberto.', 'https://www.youtube.com/watch?v=n6ir-qPI2PU&pp=ygUbdHJhaWxlciBvIHBlcXVlbmlubyBkYnVsYWRv0gcJCQcKAYcqIYzv', 'https://br.web.img3.acsta.net/pictures/210/364/21036473_20130905212653924.jpg', 2006, 1),
(30, 'filme', 'Karate Kid', 'Dre Parker se muda da China para os Estados Unidos e sofre bullying na escola. Sob a orientação do mestre Li, ele aprende kung fu, disciplina e valores de perseverança, se preparando para um torneio de artes marciais que mudará sua vida.', 'https://www.youtube.com/watch?v=XY8amUImEu0&pp=ygUYdHJhaWxlciBrYXJ0YXRlIGtpZCAyMDEw', 'https://upload.wikimedia.org/wikipedia/pt/thumb/0/00/The_Karate_Kid_2010.jpg/250px-The_Karate_Kid_2010.jpg', 2010, 1),
(31, 'filme', 'Invocação do Mal', 'A família Perron é aterrorizada por uma entidade demoníaca em sua fazenda. Para ajudá-los, os investigadores paranormais Ed e Lorraine Warren enfrentam forças sobrenaturais poderosas, descobrindo segredos sombrios e colocando suas próprias vidas em risco.', 'https://www.youtube.com/watch?v=GQrrXceHn2E&pp=ygUZaW52b2NhY2FvIGRvIG1hbCAgdHJhaWxlcg%3D%3D', 'https://m.media-amazon.com/images/I/91UQCBxB+cL._AC_UF894,1000_QL80_.jpg', 2013, 1),
(32, 'serie', 'Supernatural', 'Os irmãos Sam e Dean Winchester caçam criaturas sobrenaturais como demônios, fantasmas e monstros, enquanto enfrentam desafios pessoais e segredos familiares sombrios ao longo de sua jornada por todo os EUA.', 'https://www.youtube.com/watch?v=apltEQy8RzQ&pp=ygUUc3VwZXJuYXR1cmFsIHRyYWlsZXI%3D', 'https://upload.wikimedia.org/wikipedia/pt/thumb/b/bb/Supernatural_temporada_15_poster.jpg/250px-Supernatural_temporada_15_poster.jpg', 2005, 1),
(33, 'serie', 'Cobra Kai', 'Décadas após os eventos de “Karate Kid”, Johnny Lawrence e Daniel LaRusso retomam suas rivalidades e ensinam novas gerações de lutadores, misturando amizade, rivalidade e lições de vida através do karatê.', 'https://www.youtube.com/watch?v=xCwwxNbtK6Y&pp=ygURY29icmEga2FpIHRyYWlsZXI%3D', 'https://m.media-amazon.com/images/M/MV5BYjA3NDkwNzktNjJkYi00ODNhLWFhYzQtYzk5NjU4MDM0OWZmXkEyXkFqcGc@._V1_FMjpg_UX1000_.jpg', 2018, 1),
(34, 'serie', 'Dark', 'Em uma pequena cidade alemã, o desaparecimento de crianças revela segredos familiares complexos e paradoxos temporais, conectando diferentes gerações em uma trama de mistério e viagens no tempo.', 'https://www.youtube.com/watch?v=ESEUoa-mz2c&pp=ygUMZGFyayB0cmFpbGVy', 'https://resizing.flixster.com/lpJkDxnEFNQT1OWJjnmYfvpAHJ0=/ems.cHJkLWVtcy1hc3NldHMvdHZzZXJpZXMvUlRUVjI2NjgyOS53ZWJw', 2017, 1),
(35, 'serie', 'Round 6', 'Pessoas endividadas participam de um mortal jogo de sobrevivência coreano, onde apenas um vencedor sai vivo, revelando a crueldade humana e a luta desesperada por dinheiro e sobrevivência.', 'https://www.youtube.com/watch?v=Ncra_hUVtMM&pp=ygUNcm91bmQgNnJhaWxlcg%3D%3D', 'https://www.quadrorama.com.br/wp-content/uploads/2021/11/Round-6-Capa-bd86b0c3.png', 2021, 1),
(36, 'serie', 'Dois Homens e Meio', 'Charlie, um solteirão rico, tem sua vida bagunçada quando seu irmão e sobrinho passam a morar com ele. Entre confusões, romances e situações engraçadas, a família improvisada aprende sobre amor e convivência.', 'https://www.youtube.com/watch?v=4U0JQzxY100&pp=ygUadHJhaWxlciBkb2lzIGhvbWVucyBlIG1laW8%3D', 'https://m.media-amazon.com/images/M/MV5BNmJjNzljZGMtYjBkOC00OWM5LThjZTctNDhmYjU2OWIxMjdkXkEyXkFqcGc@._V1_FMjpg_UX1000_.jpg', 2013, 1),
(37, 'anime', 'Naruto Shippuden', 'Naruto Uzumaki, um jovem ninja, luta para proteger sua vila e se tornar Hokage. Entre batalhas, amizades e inimigos poderosos, ele enfrenta desafios que testam sua coragem e determinação.', 'https://www.youtube.com/watch?v=22R0j8UKRzY&pp=ygUYdHJhaWxlciBuYXJ1dG8gc2hpcHB1ZGVu', 'https://m.media-amazon.com/images/M/MV5BNTk3MDA1ZjAtNTRhYS00YzNiLTgwOGEtYWRmYTQ3NjA0NTAwXkEyXkFqcGc@._V1_FMjpg_UX1000_.jpg', 2007, 1),
(38, 'anime', 'Dragon Ball Z', 'Goku e seus amigos defendem a Terra de ameaças cósmicas, lutando com inimigos poderosos, superando limites e conquistando novas formas de poder enquanto buscam as lendárias Esferas do Dragão.', 'https://www.youtube.com/watch?v=tloraopWVuk&pp=ygUaZHJhZ29uIGJhbGwgeiB0cmFpbGVyIDE5ODk%3D', 'https://preview.redd.it/was-dragon-ball-z-good-or-bad-v0-z9w9byr2d6pd1.png?width=640&crop=smart&auto=webp&s=5d90d86c5b142c3f7adbaebaf7601b1bb92790ec', 1989, 1),
(39, 'anime', 'Hunter X Hunter', 'Gon Freecss decide se tornar um Hunter para encontrar seu pai. Ele enfrenta perigos mortais, faz amizades e enfrenta desafios complexos, descobrindo o valor da coragem, inteligência e lealdade.', 'https://www.youtube.com/watch?v=d6kBeJjTGnY&pp=ygUXaHVudGVyIHggaHVudGVyIHRyYWlsZXI%3D', 'https://m.media-amazon.com/images/M/MV5BYzYxOTlkYzctNGY2MC00MjNjLWIxOWMtY2QwYjcxZWIwMmEwXkEyXkFqcGc@._V1_FMjpg_UX1000_.jpg', 2011, 1),
(40, 'anime', 'Jujutsu Kaisen', 'Yuji Itadori se junta a uma escola de feiticeiros para combater maldições perigosas, protegendo o mundo de forças sobrenaturais enquanto aprende a controlar seu poder extraordinário.', 'https://www.youtube.com/watch?v=ynr6gnyu9NE&pp=ygUWdHJhaWxlciBqdWp1dHN1IGthaXNlbg%3D%3D', 'https://br.web.img3.acsta.net/pictures/20/09/14/10/31/4875617.jpg', 2020, 1),
(41, 'anime', 'Kimetsu no Yaiba', 'Tanjiro Kamado, um garoto cuja família é brutalmente assassinada por um demônio, e sua irmã mais nova, Nezuko, é transformada em um demônio. Tanjiro parte em uma jornada para se tornar um matador de demônios para encontrar uma cura para sua irmã e vingar sua família. Ele se junta ao Esquadrão de Extermínio de Demônios e, ao lado de companheiros como Zenitsu e Inosuke, enfrenta demônios enquanto busca uma forma de reverter a transformação de Nezuko.', 'https://www.youtube.com/watch?v=VQGCKyvzIM4&pp=ygUYa2ltZXRzdSBubyB5YWliYSB0cmlhbGVy', 'https://br.web.img3.acsta.net/pictures/19/09/18/13/46/0198270.jpg', 2019, 1),
(48, 'filme', 'Interestellar', 'Em um futuro não muito distante, a Terra está enfrentando uma crise alimentar global, com tempestades de poeira e uma população em declínio. Cooper (Matthew McConaughey), um ex-piloto da NASA e engenheiro agrícola, é recrutado para liderar uma missão espacial para procurar um novo planeta habitável para a humanidade. Com a ajuda de uma equipe de cientistas, ele viaja através de um buraco de minhoca perto de Saturno, em busca de um novo lar. A missão os leva a planetas desconhecidos, onde as leis da física, incluindo o tempo e a gravidade, são desafiadas, e a jornada acaba por se tornar uma corrida contra o tempo — não apenas para salvar a Terra, mas para salvar sua própria família. O filme explora conceitos de amor, sacrifício, e as fronteiras do espaço e do tempo.', 'https://www.youtube.com/watch?v=i6avfCqKcQo', 'https://upload.wikimedia.org/wikipedia/pt/3/3a/Interstellar_Filme.png', 2014, 0),
(49, 'filme', 'Star Wars: Episódio IV', 'Luke Skywalker é um jovem que vive em Tatooine e sonha com aventuras além de seu planeta deserto. Quando encontra uma mensagem da Princesa Leia escondida no droide R2-D2, ele se junta ao Jedi Obi-Wan Kenobi, ao contrabandista Han Solo, Chewbacca e aos droides R2-D2 e C-3PO para resgatar Leia do Império Galáctico. No caminho, Luke descobre a Força, uma energia mística que conecta todos os seres vivos, e se envolve em uma luta épica para restaurar a liberdade na galáxia.', 'https://www.youtube.com/watch?v=vZ734NWnAHA', 'https://m.media-amazon.com/images/I/81CIXJxQ3TL.jpg', 1977, 0),
(50, 'filme', 'Truque de Mestre', 'Um grupo de ilusionistas chamado \"Os Quatro Cavaleiros\" realiza espetáculos espetaculares em que aparentemente roubam bancos durante suas apresentações, deixando o público maravilhado. Um agente do FBI e um detetive da Interpol começam a investigar os crimes, tentando desvendar como os truques são realizados e quem está por trás deles. À medida que a trama se desenrola, surgem reviravoltas inesperadas, segredos e estratégias engenhosas que mantêm tanto os personagens quanto o público em constante suspense.', 'https://www.youtube.com/watch?v=_vv523nEIcI', 'https://m.media-amazon.com/images/M/MV5BYjQwODEyYTYtN2EzOS00ZTE1LTg5M2UtMzcwN2ViMjVlNDlhXkEyXkFqcGc@._V1_.jpg', 2013, 0),
(51, 'filme', 'Pecadores', 'Dois irmãos gêmeos, interpretados por Michael B. Jordan, retornam à sua cidade natal com a intenção de recomeçar suas vidas e deixar para trás um passado conturbado. No entanto, ao chegar, eles descobrem que uma força maligna os aguarda — um mal sobrenatural que traz à tona medos antigos, lendas e mitos assustadores. Para sobreviver, eles precisarão enfrentar esse terror que ameaça tomar conta da cidade e de seus habitantes.', 'https://www.youtube.com/watch?v=vJ3i983GZs0', 'https://upload.wikimedia.org/wikipedia/pt/thumb/d/de/Pecadores.webp/400px-Pecadores.webp.png', 2025, 0),
(52, 'filme', 'Tropa de Elite', 'O filme acompanha o Capitão Nascimento, do Batalhão de Operações Especiais (BOPE) da Polícia Militar do Rio de Janeiro, enquanto ele lida com a violência crescente nas favelas cariocas e a pressão de um governo que exige resultados rápidos. Além de enfrentar traficantes de drogas e milícias, Nascimento também precisa lidar com a corrupção dentro da própria polícia. A trama mostra o cotidiano intenso e perigoso da elite policial, explorando dilemas morais, violência urbana e a luta entre justiça e sobrevivência.', 'https://www.youtube.com/watch?v=uZBiNJQxtGw', 'https://upload.wikimedia.org/wikipedia/pt/2/2a/TropaDeElitePoster.jpg', 2007, 0),
(53, 'serie', 'Stranger Things', 'A série se passa na década de 1980 na pequena cidade de Hawkins, Indiana. Quando o jovem Will Byers desaparece misteriosamente, seus amigos, familiares e a polícia local iniciam uma busca que revela segredos sobrenaturais e experiências governamentais secretas. Durante a investigação, eles encontram Eleven, uma menina com habilidades telecinéticas, que se torna peça-chave para enfrentar criaturas de outra dimensão, conhecida como \"O Mundo Invertido\". A série mistura aventura, mistério, amizade e elementos de terror, homenageando a cultura pop dos anos 80.', 'https://www.youtube.com/watch?v=mnd7sFt5c3A', 'https://m.media-amazon.com/images/I/81ScwNzmh0L._AC_UF1000,1000_QL80_.jpg', 2016, 0),
(54, 'serie', 'Breaking Bad', 'A série acompanha Walter White, um professor de química do ensino médio que é diagnosticado com câncer de pulmão. Para garantir o futuro financeiro de sua família, ele se envolve na produção e venda de metanfetamina, entrando no perigoso mundo do crime. Ao lado de seu ex-aluno Jesse Pinkman, Walter passa por transformações drásticas, explorando temas como moralidade, ambição, corrupção e as consequências de suas escolhas. A série é conhecida por sua narrativa tensa, personagens complexos e reviravoltas impactantes.', 'https://www.youtube.com/watch?v=HhesaQXLuRY', 'https://br.web.img3.acsta.net/pictures/14/03/31/19/28/462555.jpg', 2008, 0),
(55, 'serie', 'Game of Thrones', 'A série é ambientada nos Sete Reinos de Westeros, onde famílias nobres disputam o Trono de Ferro para governar o reino. Entre intrigas políticas, guerras e traições, personagens lutam pelo poder, mas também enfrentam ameaças sobrenaturais vindas do norte, como os White Walkers. A narrativa mostra um mundo complexo, repleto de alianças e conflitos, explorando temas como lealdade, ambição, honra e sobrevivência em uma sociedade medieval repleta de violência e intriga.', 'https://www.youtube.com/watch?v=bjqEWgDVPe0', 'https://m.media-amazon.com/images/M/MV5BMTNhMDJmNmYtNDQ5OS00ODdlLWE0ZDAtZTgyYTIwNDY3OTU3XkEyXkFqcGc@._V1_FMjpg_UX1000_.jpg', 2011, 0),
(56, 'serie', 'The Flash', 'A série acompanha Barry Allen, um jovem cientista forense que ganha supervelocidade após um acidente envolvendo uma explosão de acelerador de partículas. Usando seus poderes, ele combate criminosos e meta-humanos em Central City, enquanto tenta desvendar mistérios do seu passado e proteger a cidade de ameaças cada vez maiores. A narrativa mistura ação, aventura, drama e elementos de ficção científica e fantasia, explorando heróis, vilões e a complexidade de viajar no tempo.', 'https://www.youtube.com/watch?v=IgVyroQjZbE', 'https://upload.wikimedia.org/wikipedia/pt/b/b6/The_Flash_Temporada_1_Poster.jpg', 2014, 0),
(57, 'serie', 'Prison Break', 'A série acompanha Michael Scofield, um engenheiro estrutural que elabora um plano meticuloso para tirar seu irmão Lincoln Burrows da prisão, após Lincoln ser condenado à morte por um crime que não cometeu. Cada temporada mostra a execução de planos de fuga, conflitos com criminosos e autoridades, e a luta dos personagens para sobreviver e provar a inocência de Lincoln. A trama combina tensão, reviravoltas, estratégia e drama familiar.', 'https://www.youtube.com/watch?v=AL9zLctDJaU', 'https://i.pinimg.com/originals/37/0d/08/370d08e5a7053e297e8c6f3db0820cdd.jpg', 2005, 0),
(58, 'anime', 'Shingeki no Kyojin', 'A história se passa em um mundo onde a humanidade está à beira da extinção devido aos Titãs, gigantes humanoides que devoram pessoas. Eren Yeager, junto com seus amigos Mikasa e Armin, se junta à Tropa de Exploração para lutar contra os Titãs e desvendar os mistérios por trás de sua existência. Ao longo da série, são explorados temas como sobrevivência, liberdade, moralidade e os segredos sombrios da sociedade humana dentro das muralhas.', 'https://www.youtube.com/watch?v=MGRm4IzK1SQ', 'https://i0.wp.com/heroisx.com/wp-content/uploads/2013/12/Shingeki-no-Kyojin-poster.jpg', 2013, 0),
(59, 'anime', 'Fullmetal Alchemist: Brotherhood', 'A história acompanha os irmãos Edward e Alphonse Elric, que usam alquimia na tentativa de ressuscitar sua mãe, mas acabam pagando um preço alto: Edward perde um braço e uma perna, e Alphonse perde todo o seu corpo, ficando preso em uma armadura. Para recuperar o que perderam, eles partem em uma jornada em busca da Pedra Filosofal, enfrentando organizações secretas, homúnculos e descobrindo segredos sombrios sobre a alquimia e o governo de seu país. A série combina aventura, ação intensa e dilemas morais profundos, explorando temas de sacrifício, justiça e fraternidade.', 'https://www.youtube.com/watch?v=AYlksPeSXrs', 'https://m.media-amazon.com/images/M/MV5BMzNiODA5NjYtYWExZS00OTc4LTg3N2ItYWYwYTUyYmM5MWViXkEyXkFqcGc@._V1_.jpg', 2009, 0),
(60, 'anime', 'Cyberpunk: Mercenários', 'Em uma realidade distópica marcada pela corrupção e pelos implantes cibernéticos, David Martinez, um jovem impulsivo, decide se tornar um mercenário (um “edgerunner”) para sobreviver. Sua vida o leva para o submundo de Night City, onde a tecnologia e a violência andam juntas, e ele precisará enfrentar desafios extremos para continuar vivo', 'https://www.youtube.com/watch?v=25XGPHY1TMM', 'https://upload.wikimedia.org/wikipedia/pt/6/68/Cyberpunk_mercenarios.jpg', 2022, 0),
(61, 'anime', 'Death Note', 'Light Yagami, um estudante brilhante, encontra um caderno sobrenatural chamado “Death Note”, que permite matar qualquer pessoa cujo nome seja escrito nele, desde que o usuário conheça o rosto da vítima. Determinado a criar um mundo livre de criminosos, Light se torna o vigilante “Kira”. Entretanto, ele entra em um complexo jogo de gato e rato com L, um detetive genial que tenta capturá-lo. A série explora questões morais, justiça, poder absoluto e as consequências de brincar de deus.', 'https://www.youtube.com/watch?v=NlJZ-YgAt-c', 'https://br.web.img3.acsta.net/pictures/14/05/28/20/47/033239.jpg', 2006, 0),
(62, 'anime', '86: Eighty-Six', 'A história se passa em um futuro distópico onde a República de San Magnolia afirma lutar contra máquinas chamadas \"Legion\" sem sofrer baixas humanas. No entanto, a verdade é que a população marginalizada conhecida como \"Eighty-Six\" é enviada para combater na linha de frente. A série acompanha Shinei Nouzen, líder do esquadrão 86, e Lena, uma oficial que gerencia a guerra de forma estratégica. O anime explora temas como discriminação, sacrifício, guerra e humanidade em meio ao conflito.', 'https://www.youtube.com/watch?v=VSdS29SDvn4', 'https://m.media-amazon.com/images/M/MV5BOWNmY2IzOGItMmQyNy00ZTM0LThiNjItODM3YzdkYjRlNWU1XkEyXkFqcGc@._V1_FMjpg_UX1000_.jpg', 2021, 0),
(66, 'filme', 'As Branquelas', 'Dois irmãos agentes do FBI, Kevin e Marcus Copeland, são designados para proteger as socialites heiress das irmãs Wilson após uma tentativa de sequestro. Quando a situação se complica e as irmãs ficam gravemente feridas, os irmãos decidem se disfarçar delas, assumindo identidades femininas ricas e brancas. Entre festas luxuosas, encontros sociais e situações absurdamente hilárias, eles tentam manter a farsa enquanto investigam os criminosos, resultando em confusões cômicas e momentos inesperados.', 'https://www.youtube.com/watch?v=seoJIPLLWp0', 'https://upload.wikimedia.org/wikipedia/pt/thumb/d/de/White_chicks.jpeg/250px-White_chicks.jpeg', 2004, 0),
(67, 'filme', 'Batman: O Cavaleiro das Trevas', 'Batman, o vigilante mascarado de Gotham, continua sua luta contra o crime ao lado do delegado Gordon e do promotor Harvey Dent. No entanto, a cidade é abalada pelo surgimento do Coringa, um criminoso imprevisível e sádico que desafia a moralidade de todos ao seu redor. À medida que o caos aumenta, Batman enfrenta dilemas éticos e pessoais, questionando até onde pode ir para proteger Gotham e manter a justiça, enquanto o Coringa testa os limites da ordem e do caos.', 'https://www.youtube.com/watch?v=1it3Eqn2zNQ', 'https://upload.wikimedia.org/wikipedia/pt/d/d1/The_Dark_Knight.jpg', 2008, 0),
(68, 'filme', 'Toy Story', 'Woody, um boneco cowboy que é o favorito do garoto Andy, vê seu mundo virar de cabeça para baixo quando surge um novo brinquedo moderno: o astronauta Buzz Lightyear. Inseguro com a atenção que Buzz recebe, Woody trama um plano que acaba dando errado, e ambos acabam perdidos fora de casa. Para voltar, eles precisam aprender a confiar um no outro, enfrentando aventuras, perigos e descobrindo o verdadeiro valor da amizade.', 'https://www.youtube.com/watch?v=v-PjgYDrg70', 'https://br.web.img3.acsta.net/medias/nmedia/18/91/05/36/20127436.jpg', 1995, 0),
(69, 'filme', 'Creed: Nascido para Lutar', 'Adonis Johnson, filho do lendário boxeador Apollo Creed, busca forjar seu próprio caminho no mundo do boxe, apesar de nunca ter conhecido o pai. Determinado a provar seu talento, ele procura Rocky Balboa, agora aposentado, para ser seu treinador. Sob a orientação de Rocky, Adonis enfrenta desafios físicos e emocionais, aprendendo sobre disciplina, legado e perseverança enquanto luta para conquistar seu lugar no ringue e na vida.', 'https://www.youtube.com/watch?v=Uv554B7YHk4', 'https://m.media-amazon.com/images/M/MV5BNWM3NjY2ZDctMGZiYy00OGFlLThkMTktOTY2MDM2YjE2OTliXkEyXkFqcGc@._V1_FMjpg_UX1000_.jpg', 2015, 0),
(70, 'filme', 'Harry Potter e a Pedra Filosofal', 'Aos 11 anos, Harry Potter descobre que é um bruxo e recebe uma carta para estudar na Escola de Magia e Bruxaria de Hogwarts. Lá, ele faz amigos leais como Hermione Granger e Rony Weasley, aprende feitiços, enfrenta criaturas mágicas e desvenda os mistérios do castelo. Harry também descobre a existência da poderosa Pedra Filosofal e percebe que forças sombrias desejam roubá-la. Entre aventuras, desafios e descobertas, ele começa a entender seu passado e o destino que o aguarda.', 'https://www.youtube.com/watch?v=O7JVilOQdZ4', 'https://upload.wikimedia.org/wikipedia/pt/1/1d/Harry_Potter_Pedra_Filosofal_2001.jpg', 2001, 0),
(71, 'serie', 'La Casa de Papel', 'Um misterioso homem chamado “O Professor” recruta oito criminosos com habilidades especiais para realizar um ousado plano: assaltar a Casa da Moeda da Espanha e imprimir bilhões de euros. Cada membro do grupo adota um codinome baseado em cidades e segue regras rígidas dentro do assalto. Enquanto lidam com reféns, tensão policial e conflitos internos, o plano se desenrola com estratégia, reviravoltas e jogos psicológicos, mostrando que nada é tão simples quanto parece.', 'https://www.youtube.com/watch?v=iS5xXr-GOnM', 'https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEiYfkdn5CNPQZAi-crMfc4hd9QwK_kxCrJvT5-U7xSt_cUe5Ae2o_nu9nEb5AzJpLzHAz9hY07ia8PXDTeYR1iQgEKuydLlbrm3hAQrI8bZLFcFAEful5eyLmu848YQc7tO_FyxYaO-k7g/s1600/La+Casa+de+Papel+Primeira+Temporada.jpg', 2017, 0),
(72, 'serie', 'The Big Bang Theory', 'A série acompanha a vida de quatro amigos cientistas — Leonard, Sheldon, Howard e Raj — cujas habilidades intelectuais superam em muito suas habilidades sociais. A rotina deles muda quando a vizinha Penny, uma aspirante a atriz extrovertida e cheia de vida, entra em suas vidas. Entre experimentos científicos, nerdices, relacionamentos complicados e muitas piadas inteligentes, o grupo enfrenta situações cotidianas com muito humor, mostrando a mistura de genialidade e excentricidade na vida moderna.', 'https://www.youtube.com/watch?v=rCj-Fb1OmXg', 'https://upload.wikimedia.org/wikipedia/pt/thumb/9/9a/Big-bang-theory_Temporada_12_poster.jpg/250px-Big-bang-theory_Temporada_12_poster.jpg', 2007, 0),
(73, 'serie', 'The Boys', 'Em um mundo onde super-heróis são celebridades corporativas corruptas, um grupo chamado “The Boys” decide expor suas falhas e abusos de poder. Liderados por Billy Butcher, eles enfrentam os super-heróis, que usam seus poderes para interesses próprios, muitas vezes à custa de civis inocentes. Entre conspirações, violência extrema e moralidade questionável, a série mostra os bastidores sombrios da fama e do heroísmo, explorando até onde pessoas comuns podem ir para combater figuras aparentemente invencíveis.', 'https://www.youtube.com/watch?v=43YeHlEOUCw', 'https://m.media-amazon.com/images/M/MV5BMWJlN2U5MzItNjU4My00NTM2LWFjOWUtOWFiNjg3ZTMxZDY1XkEyXkFqcGc@._V1_FMjpg_UX1000_.jpg', 2019, 0),
(74, 'serie', 'Brooklyn Nine-Nine', 'A série acompanha o dia a dia da 99ª Delegacia de Polícia de Nova York, focando no detetive talentoso, mas irreverente, Jake Peralta. Entre resolver crimes, lidar com burocracia e conviver com colegas excêntricos como a capitã Raymond Holt, Jake e sua equipe enfrentam situações absurdas e hilárias. Com humor inteligente, camaradagem e situações imprevisíveis, a série mistura ação policial com comédia, mostrando que até os casos mais sérios podem render momentos cômicos e emocionantes.', 'https://www.youtube.com/watch?v=sEOuJ4z5aTc', 'https://upload.wikimedia.org/wikipedia/pt/7/71/Brooklyn_Nine-Nine-5.jpg', 2013, 0),
(75, 'serie', 'Vis a Vis', 'A jovem Macarena Ferreiro é presa por fraude financeira e enviada para a penitenciária Cruz del Sur, onde enfrenta um ambiente hostil e perigoso dominado por detentas experientes e violentas. Para sobreviver, Macarena precisa se adaptar rapidamente, fazendo alianças, enfrentando traições e descobrindo sua própria força interior. A série explora o cotidiano das prisões femininas, misturando tensão, intrigas e dramas pessoais enquanto revela o impacto do sistema carcerário na vida das detentas.', 'https://www.youtube.com/watch?v=N08KRAPzsHU', 'https://m.media-amazon.com/images/M/MV5BMWU2ZWE4NTktMTM4Ni00OTVkLTk3ZDAtMTc2YjY1NmZmYTlkXkEyXkFqcGc@._V1_.jpg', 2015, 0),
(76, 'anime', 'One Piece', 'Monkey D. Luffy, um jovem aventureiro com o corpo elástico após comer a Fruta do Diabo Gomu Gomu, parte em uma jornada pelos mares para se tornar o Rei dos Piratas e encontrar o lendário tesouro One Piece. Ele reúne uma tripulação diversa, cada membro com sonhos e habilidades únicas, enfrentando piratas rivais, marinhas poderosas e mistérios de ilhas fantásticas. A série mistura ação, amizade, humor e superações, explorando temas de coragem, lealdade e liberdade em um mundo vasto e cheio de perigos.', 'https://www.youtube.com/watch?v=1KMcoJBMWE4', 'https://m.media-amazon.com/images/M/MV5BMTNjNGU4NTUtYmVjMy00YjRiLTkxMWUtNzZkMDNiYjZhNmViXkEyXkFqcGc@._V1_FMjpg_UX1000_.jpg', 1999, 0),
(77, 'anime', 'Inazuma Eleven', 'Endou Mamoru, um jovem goleiro talentoso, lidera o time de futebol da escola Raimon em sua missão de se tornar o melhor do Japão. Com habilidades especiais, técnicas fantásticas e um espírito de equipe inabalável, Endou e seus companheiros enfrentam rivais cada vez mais fortes, participam de torneios emocionantes e superam desafios tanto dentro quanto fora do campo. A série mistura amizade, determinação e partidas épicas, mostrando que o trabalho em equipe e a paixão pelo esporte podem superar qualquer obstáculo.', 'https://www.youtube.com/watch?v=z-WnyPsSgLg', 'https://m.media-amazon.com/images/M/MV5BYzUzMWY3ZDEtZjc3My00YTk3LWJiYzYtYzg1NDg5MGIxOWM3XkEyXkFqcGc@._V1_FMjpg_UX1000_.jpg', 2008, 0),
(80, 'anime', 'Tokyo Ghoul', 'Ken Kaneki, um estudante universitário comum, sobrevive a um ataque de um ghoul — criaturas que se alimentam de carne humana —, mas acaba se tornando meio ghoul após um transplante de órgãos. Lutando para aceitar sua nova identidade, Kaneki precisa se adaptar ao mundo sombrio dos ghouls, equilibrando sua vida humana e suas novas necessidades. A série explora temas de sobrevivência, identidade, moralidade e os limites entre humanos e monstros, em meio a batalhas intensas e dilemas existenciais.', 'https://www.youtube.com/watch?v=vGuQeQsoRgU', 'https://m.media-amazon.com/images/I/71aIUtWoqHL._AC_UF1000,1000_QL80_.jpg', 2014, 0),
(81, 'anime', 'Solo Leveling', 'Em um mundo onde portais ligam a Terra a masmorras cheias de monstros, alguns humanos despertam como Hunters, guerreiros capazes de enfrentá-los. Sung Jinwoo, o mais fraco de todos, sobrevive a uma masmorra mortal e recebe acesso a um Sistema único que lhe permite evoluir sem limites. A partir desse momento, ele começa uma jornada para se tornar o caçador mais poderoso e descobrir os segredos por trás dos portais e das forças que ameaçam a humanidade.', 'https://www.youtube.com/watch?v=MWrsQmBIkhM', 'https://images.justwatch.com/poster/310154566/s718/temporada-1.jpg', 2024, 0),
(82, 'anime', 'Boku no Hero Academia', 'Em um mundo onde quase toda a população possui superpoderes chamados “Quirks”, Izuku Midoriya nasce sem nenhum poder, mas sonha em se tornar um grande herói. Sua vida muda quando ele conhece All Might, o maior herói de todos, que escolhe Izuku como seu sucessor e lhe transmite o poderoso Quirk One For All. A partir daí, Izuku entra na U.A. High School, uma escola de elite para futuros heróis, onde enfrenta vilões, desafios e cresce para se tornar um verdadeiro símbolo de esperança.', 'https://www.youtube.com/watch?v=EPVkcwyLQQ8', 'https://m.media-amazon.com/images/M/MV5BY2QzODA5OTQtYWJlNi00ZjIzLThhNTItMDMwODhlYzYzMjA2XkEyXkFqcGc@._V1_.jpg', 2016, 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `midias_generos`
--

CREATE TABLE `midias_generos` (
  `midia_id` int(11) NOT NULL,
  `genero_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `midias_generos`
--

INSERT INTO `midias_generos` (`midia_id`, `genero_id`) VALUES
(27, 68),
(27, 69),
(28, 68),
(28, 69),
(29, 74),
(30, 68),
(30, 79),
(31, 105),
(31, 108),
(32, 68),
(32, 69),
(32, 105),
(34, 105),
(35, 79),
(35, 105),
(35, 107),
(36, 74),
(37, 68),
(37, 69),
(37, 81),
(37, 100),
(38, 68),
(38, 69),
(38, 81),
(38, 100),
(39, 68),
(39, 69),
(39, 81),
(39, 100),
(40, 68),
(40, 69),
(40, 102),
(41, 68),
(41, 72),
(48, 69),
(48, 79),
(48, 83),
(49, 69),
(49, 81),
(49, 83),
(50, 75),
(50, 91),
(50, 105),
(51, 79),
(51, 105),
(51, 108),
(52, 68),
(52, 75),
(52, 79),
(53, 79),
(53, 83),
(53, 105),
(53, 108),
(54, 75),
(54, 79),
(54, 105),
(55, 68),
(55, 69),
(55, 79),
(55, 81),
(56, 68),
(56, 69),
(56, 79),
(56, 81),
(56, 83),
(57, 68),
(57, 75),
(57, 79),
(57, 105),
(58, 105),
(59, 68),
(59, 69),
(59, 79),
(59, 81),
(59, 83),
(60, 68),
(60, 83),
(61, 75),
(61, 79),
(61, 91),
(61, 105),
(61, 107),
(62, 68),
(62, 79),
(62, 83),
(62, 84),
(62, 105),
(66, 74),
(66, 75),
(67, 68),
(67, 75),
(67, 79),
(68, 69),
(68, 70),
(68, 82),
(69, 68),
(69, 79),
(69, 80),
(70, 69),
(70, 81),
(70, 82),
(71, 68),
(71, 75),
(71, 79),
(71, 105),
(72, 74),
(73, 68),
(73, 74),
(73, 75),
(73, 79),
(73, 81),
(74, 74),
(74, 94),
(75, 75),
(75, 79),
(75, 105),
(76, 68),
(76, 69),
(76, 74),
(76, 100),
(77, 80),
(80, 68),
(80, 79),
(80, 86),
(80, 102),
(81, 68),
(81, 69),
(81, 102),
(82, 68),
(82, 69),
(82, 104);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `tipo` enum('admin','usuario') DEFAULT 'usuario',
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `tipo`, `foto`) VALUES
(1, 'admin', 'admin@gmail.com', '$2a$12$kP0WzUHZEmQcTVDR.R/C2uHqQRQyKRlNKDgmTqhpygMm/fUMikEBC', 'admin', NULL),
(75, 'teste', 'teste@gmail.com', '$2y$10$X3RyFUVFFWPkcyL30jrCn.k7TbnwKuhJ.hyDfM4hhdO.1HusBKCpG', 'usuario', ''),
(76, 'Steve', 'don@gmail.com', '$2y$10$iy5Etg37j6uypLLCbiya6u87AieQ5rrv907SwOCo4HQrKOzNYcraO', 'usuario', ''),
(77, 'John', 'John@hotmail.com', '$2y$10$aUSekjFOIiyQB3ejq0ED7.YTbnARGcXkBf.56QEoceiJS6OspKUDe', 'usuario', NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `avaliacoes`
--
ALTER TABLE `avaliacoes`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `generos`
--
ALTER TABLE `generos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `midias`
--
ALTER TABLE `midias`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `midias_generos`
--
ALTER TABLE `midias_generos`
  ADD PRIMARY KEY (`midia_id`,`genero_id`),
  ADD KEY `genero_id` (`genero_id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `avaliacoes`
--
ALTER TABLE `avaliacoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de tabela `generos`
--
ALTER TABLE `generos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT de tabela `midias`
--
ALTER TABLE `midias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `midias_generos`
--
ALTER TABLE `midias_generos`
  ADD CONSTRAINT `midias_generos_ibfk_1` FOREIGN KEY (`midia_id`) REFERENCES `midias` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `midias_generos_ibfk_2` FOREIGN KEY (`genero_id`) REFERENCES `generos` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
