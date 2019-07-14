-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : database
-- Généré le :  sam. 13 juil. 2019 à 19:59
-- Version du serveur :  5.7.24
-- Version de PHP :  7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `songfolio`
--

-- --------------------------------------------------------

--
-- Structure de la table `Albums`
--

DROP TABLE IF EXISTS `Albums`;
CREATE TABLE `Albums` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(300) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `date_published` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cover_dir` varchar(255) DEFAULT NULL,
  `deezer` varchar(100) DEFAULT NULL,
  `spotify` varchar(100) DEFAULT NULL,
  `likes` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `comment_active` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Albums`
--

INSERT INTO `Albums` (`id`, `title`, `description`, `slug`, `date_published`, `cover_dir`, `deezer`, `spotify`, `likes`, `category_id`, `comment_active`) VALUES
(3, 'Album ESGI', 'L\'album de l\'ESGI', 'album-esgi', '2019-07-13 19:56:10', 'public/uploads/albums/logo-esgi.png', '', '', NULL, 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `Categories`
--

DROP TABLE IF EXISTS `Categories`;
CREATE TABLE `Categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Categories`
--

INSERT INTO `Categories` (`id`, `name`, `slug`, `type`) VALUES
(1, 'Hip-hop', NULL, 'album'),
(3, 'Festival', NULL, 'event'),
(4, 'Concert', NULL, 'event'),
(5, 'CatÃ©gorie Test', NULL, 'article');

-- --------------------------------------------------------

--
-- Structure de la table `Comments`
--

DROP TABLE IF EXISTS `Comments`;
CREATE TABLE `Comments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `confirm` tinyint(1) NOT NULL DEFAULT '0',
  `message` longtext CHARACTER SET utf8 NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Comments`
--

INSERT INTO `Comments` (`id`, `user_id`, `type_id`, `confirm`, `message`, `date_created`, `type`) VALUES
(5, 7, 9, 1, 'Test commentaire :) Salut Ã  tous !!!', '2019-07-13 19:34:41', 'article'),
(6, 7, 9, 1, 'Comment allez vous ?\r\nMoi plutÃ´t bien !', '2019-07-13 19:34:50', 'article');

-- --------------------------------------------------------

--
-- Structure de la table `Contents`
--

DROP TABLE IF EXISTS `Contents`;
CREATE TABLE `Contents` (
  `id` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  `slug` text NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `content` longtext NOT NULL,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_edit` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `author` int(11) NOT NULL,
  `img_dir` text,
  `published` tinyint(1) NOT NULL DEFAULT '1',
  `comment_active` tinyint(1) NOT NULL DEFAULT '1',
  `indexed` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Contents`
--

INSERT INTO `Contents` (`id`, `type`, `slug`, `category_id`, `title`, `description`, `content`, `date_create`, `date_edit`, `author`, `img_dir`, `published`, `comment_active`, `indexed`) VALUES
(3, 'page', 'ma-page-de-test', NULL, 'Ma page de test', 'Ma page de test ici description', '<p>Ceci est ma page de test !</p>\r\n\r\n<p>Je peux modifier le contenu comme bon me semble.</p>\r\n\r\n<p><em>Avec </em>une <strong>tonne </strong>de <u>possibilit&eacute;s</u>!</p>\r\n\r\n<h1>Mon titre dans ma page</h1>\r\n\r\n<p>Voici ce que donne mon titre dans ma page :)</p>\r\n\r\n<p><img alt=\"\" class=\"img-left\" src=\"http://www.marianne-waquier.com/wp-content/uploads/2014/12/Capture-d%E2%80%99%C3%A9cran-2014-12-18-%C3%A0-15.48.02.png\" style=\"height:419px; width:537px\" />Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', '2019-07-13 17:51:51', '2019-07-13 18:20:46', 7, 'public/uploads/contents/page_test.jpg', 1, 0, 0),
(9, 'article', 'mon-article-de-test!', 5, 'Mon article de test!', 'Mon article de test', '<p>Voici mon article de test !</p>\r\n\r\n<p>On peux y mettre tout pleins d&#39;informations !</p>\r\n\r\n<h1>ATTENTION VOICI UNE NOUVELLE</h1>\r\n\r\n<h2>NOTRE NOUVEAU SITE</h2>\r\n\r\n<p>Voici notre nouveau site!</p>\r\n\r\n<p><a href=\"/\">Page d&#39;accueil</a></p>', '2019-07-13 19:03:25', '2019-07-13 19:36:14', 7, 'public/uploads/contents/album.jpg', 1, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `Events`
--

DROP TABLE IF EXISTS `Events`;
CREATE TABLE `Events` (
  `id` int(11) NOT NULL,
  `displayName` varchar(500) NOT NULL,
  `type` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'ok',
  `start_date` timestamp NULL DEFAULT NULL,
  `end_date` timestamp NULL DEFAULT NULL,
  `img_dir` varchar(255) DEFAULT NULL,
  `details` longtext NOT NULL,
  `rate` float NOT NULL,
  `nbr_place` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `postal_code` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `ticketing` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Events`
--

INSERT INTO `Events` (`id`, `displayName`, `type`, `status`, `start_date`, `end_date`, `img_dir`, `details`, `rate`, `nbr_place`, `address`, `city`, `postal_code`, `slug`, `description`, `ticketing`) VALUES
(1, 'un nouveau events ', '3', 'ok', '2019-08-14 00:03:00', '2019-09-12 01:57:00', 'public/uploads/events/event.jpg', 'qsdfsdqdq', 1, 450, '36 RUE CLAUDE TERRASSE', 'Paris 16', '75016', 'un-nouveau-events', 'adaeazeaze', 'non');

-- --------------------------------------------------------

--
-- Structure de la table `Likes`
--

DROP TABLE IF EXISTS `Likes`;
CREATE TABLE `Likes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Likes`
--

INSERT INTO `Likes` (`id`, `user_id`, `type`, `type_id`) VALUES
(58, 5, 'songs', 22),
(83, 5, 'songs', 20),
(93, 6, 'songs', 20),
(96, 7, 'albums', 2),
(97, 7, 'songs', 21),
(99, 7, 'songs', 22),
(100, 7, 'songs', 23);

-- --------------------------------------------------------

--
-- Structure de la table `Menus`
--

DROP TABLE IF EXISTS `Menus`;
CREATE TABLE `Menus` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `data` LONGTEXT DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Menus`
--

INSERT INTO `Menus` (`id`, `title`, `data`) VALUES
(1, 'Exemple Menu header', '[{\"link\": \"http://localhost/\", \"title\": \"Accueil\"}, {\"link\": \"/evenement\", \"title\": \"Evenements\"}]'),
(2, 'Exemple Menu Footer', '[{\"link\": \"http://localhost/\", \"title\": \"Accueil\"}, {\"link\": \"http://localhost/\", \"title\": \"Nous contacter\"}, {\"link\": \"http://localhost/\", \"title\": \"Notre histoire\"}]');

-- --------------------------------------------------------

--
-- Structure de la table `Permissions`
--

DROP TABLE IF EXISTS `Permissions`;
CREATE TABLE `Permissions` (
  `id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `Roles`
--

DROP TABLE IF EXISTS `Roles`;
CREATE TABLE `Roles` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `perms` LONGTEXT DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Roles`
--

INSERT INTO `Roles` (`id`, `name`, `perms`) VALUES
(1, 'SuperAdmin', '{\"all_perms\": \"1\"}');

-- --------------------------------------------------------

--
-- Structure de la table `Settings`
--

DROP TABLE IF EXISTS `Settings`;
CREATE TABLE `Settings` (
  `id` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  `data` LONGTEXT DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Settings`
--

INSERT INTO `Settings` (`id`, `type`, `data`) VALUES
(1, 'header', '{\"header_menu\": \"1\"}'),
(2, 'footer', '{\"copyright\": \"Copyright Songfolio 2019\", \"footer_menu\": {\"1\": \"2\", \"2\": \"2\"}, \"footer_menu_nb\": \"2\"}'),
(4, 'template', '{\"link_color\": \"#a80000\", \"text_color\": \"#555555\", \"title_color\": \"#444444\", \"text_font_name\": \"Lato\", \"title_font_name\": \"Questrial\", \"footer_background\": \"#555555\", \"footer_link_color\": \"#c8c8c8\", \"header_background\": \"#ffffff\", \"header_link_color\": \"#717171\", \"footer_title_color\": \"#808080\"}'),
(6, 'config', '{\"site_desc\": \"test description \", \"site_name\": \"Mon super site\", \"site_tags\": \"music, album, song\"}');

-- --------------------------------------------------------

--
-- Structure de la table `Songs`
--

DROP TABLE IF EXISTS `Songs`;
CREATE TABLE `Songs` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `album_id` int(11) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `likes` int(11) NOT NULL DEFAULT '0',
  `text` longtext NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `img_dir` varchar(255) DEFAULT NULL,
  `youtube` varchar(255) DEFAULT NULL,
  `deezer` varchar(255) DEFAULT NULL,
  `spotify` varchar(255) DEFAULT NULL,
  `date_published` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Songs`
--

INSERT INTO `Songs` (`id`, `name`, `album_id`, `slug`, `likes`, `text`, `description`, `img_dir`, `youtube`, `deezer`, `spotify`, `date_published`) VALUES
(23, 'Le son des dÃ©veloppeurs', 3, 'le-son-des-developpeurs', 0, '<p>Le son des d&eacute;veloppeurs,</p>\r\n\r\n<p>Chantons tous ensemble,</p>\r\n\r\n<p>Hip Hip, Houra!</p>', 'Mon album ahah', 'public/uploads/songs/album-cover-template-design-aba57eeb6ca8278a5373d09737938a42.jpg', '', '', '', '2019-07-13 19:57:48');

-- --------------------------------------------------------

--
-- Structure de la table `Users`
--

DROP TABLE IF EXISTS `Users`;
CREATE TABLE `Users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(60) DEFAULT NULL,
  `date_inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `role_id` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '0',
  `date_update` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `login_token` varchar(255) DEFAULT NULL,
  `id_facebook` bigint(20) DEFAULT NULL,
  `pwd_token` varchar(30) DEFAULT NULL,
  `undeletable` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Users`
--

INSERT INTO `Users` (`id`, `first_name`, `last_name`, `email`, `password`, `date_inserted`, `role_id`, `status`, `date_update`, `login_token`, `id_facebook`, `pwd_token`, `undeletable`) VALUES
(7, 'Admin', 'Admin', 'admintest@hotmail.fr', '$2y$10$n6RywGQxMQo7efq2htDB4.7CH/t3HJEny/5WqGKkTIaRQvJZVEqLu', '2019-07-13 17:17:20', 1, 0, NULL, '59a14ea9bbe3f6c079681b247eb3b807', NULL, NULL, 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Albums`
--
ALTER TABLE `Albums`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Categories`
--
ALTER TABLE `Categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Comments`
--
ALTER TABLE `Comments`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Contents`
--
ALTER TABLE `Contents`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Events`
--
ALTER TABLE `Events`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Likes`
--
ALTER TABLE `Likes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Menus`
--
ALTER TABLE `Menus`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Permissions`
--
ALTER TABLE `Permissions`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Roles`
--
ALTER TABLE `Roles`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Settings`
--
ALTER TABLE `Settings`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Songs`
--
ALTER TABLE `Songs`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Albums`
--
ALTER TABLE `Albums`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `Categories`
--
ALTER TABLE `Categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `Comments`
--
ALTER TABLE `Comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `Contents`
--
ALTER TABLE `Contents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `Events`
--
ALTER TABLE `Events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `Likes`
--
ALTER TABLE `Likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT pour la table `Menus`
--
ALTER TABLE `Menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `Permissions`
--
ALTER TABLE `Permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Roles`
--
ALTER TABLE `Roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `Settings`
--
ALTER TABLE `Settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `Songs`
--
ALTER TABLE `Songs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT pour la table `Users`
--
ALTER TABLE `Users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
