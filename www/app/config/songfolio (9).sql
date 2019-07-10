-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : database
-- Généré le :  mar. 09 juil. 2019 à 21:50
-- Version du serveur :  5.7.25
-- Version de PHP :  7.2.14

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
(1, '?', 'qsdqsdfsdf', '?', '2019-07-07 12:41:17', 'public/uploads/albums/screeshot7.jpg', '', '', NULL, 1, 1),
(2, '17 cent', 'qsdqdq', '17-cent', '2019-07-07 16:11:43', 'public/uploads/albums/futurama-fr-memologie-2011.jpg', 'https://www.deezer.com/fr/playlist/3540765226', 'https://open.spotify.com/artist/4cOnXPSZlgiY4NkRws9KPa', NULL, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `Categories`
--

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
(2, 'Adventure', NULL, 'article'),
(3, 'Festival', NULL, 'event'),
(4, 'Concert', NULL, 'event');

-- --------------------------------------------------------

--
-- Structure de la table `Comments`
--

CREATE TABLE `Comments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `confirm` tinyint(1) NOT NULL DEFAULT '0',
  `message` longtext CHARACTER SET utf8 NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `Contents`
--

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
(1, 'page', 'info', NULL, 'info', 'thththyhytyhth', '<p>tests de my page&nbsp;</p>', '2019-07-07 18:07:16', NULL, 6, 'Format n\'est pas bon.', 1, 0, 1),
(2, 'article', 'mo-article-de-test', 2, 'mo article de test', 'qsdqsdsd', '<p>qsdqsdqsdqsdqs</p>', '2019-07-09 18:50:00', NULL, 6, 'public/uploads/contents/screeshot7.jpg', 1, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `Events`
--

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
(1, 'un nouveau events ', '3', 'ok', '2019-07-04 00:03:00', '2019-07-28 01:57:00', 'public/uploads/events/screeshot7.jpg', 'qsdfsdqdq', 1, 450, '36 RUE CLAUDE TERRASSE', 'Paris 16', '75016', 'un-nouveau-events', 'adaeazeaze', 'non');

-- --------------------------------------------------------

--
-- Structure de la table `Likes`
--

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
(93, 6, 'songs', 20);

-- --------------------------------------------------------

--
-- Structure de la table `Menus`
--

CREATE TABLE `Menus` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `data` json DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Menus`
--

INSERT INTO `Menus` (`id`, `title`, `data`) VALUES
(1, 'Exemple Menu header', '[{\"link\": \"http://localhost/\", \"title\": \"Accueil\"}, {\"link\": \"/evenement\", \"title\": \"Evenements\"}, {\"link\": \"/connexion\", \"title\": \"Mon compte\"}, {\"link\": \"/admin\", \"title\": \"Admin\"}]'),
(2, 'Exemple Menu Footer', '[{\"link\": \"http://localhost/\", \"title\": \"Accueil\"}, {\"link\": \"http://localhost/\", \"title\": \"Nous contacter\"}, {\"link\": \"http://localhost/\", \"title\": \"Notre histoire\"}]');

-- --------------------------------------------------------

--
-- Structure de la table `Permissions`
--

CREATE TABLE `Permissions` (
  `id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `Roles`
--

CREATE TABLE `Roles` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `perms` json DEFAULT NULL
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

CREATE TABLE `Settings` (
  `id` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  `data` json DEFAULT NULL
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
(20, 'Moonlight', NULL, 'moonlight', 0, '<p>fbf</p>', 'my btrain new song', NULL, '', '', '', '2019-07-07 10:37:01'),
(21, 'Numb', 2, 'numb', 0, '<p>f</p>', 'sqdfqsfds', NULL, '', '', '', '2019-07-07 10:40:02'),
(22, 'SAD!', 2, 'sad!', 0, '<p>dfsdf</p>', 'sqdfqsdfdqsfd', 'public/uploads/songs/screeshot7.jpg', 'https://www.youtube.com/watch?v=pgN-vvVVxMA', '', '', '2019-07-07 10:57:25');

-- --------------------------------------------------------

--
-- Structure de la table `Users`
--

CREATE TABLE `Users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
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
  `undeletable` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Users`
--

INSERT INTO `Users` (`id`, `username`, `first_name`, `last_name`, `email`, `password`, `date_inserted`, `role_id`, `status`, `date_update`, `login_token`, `id_facebook`, `undeletable`) VALUES
(5, NULL, 'Ivan', 'Naluzhnyi', 'ivan.naluzhnyi@gmail.com', '$2y$10$fOFbj9qsPBd75etkDunsXewLsxSKVCjij67cCSGaKEanMf/yRisXu', '2019-07-07 10:16:29', 1, 0, NULL, '5268b48edde7defcfdb801f149307079', NULL, 1),
(6, NULL, 'John', 'Doe', 'ivan.naluzhnyi@uppli.fr', '$2y$10$5mEkk07W4ksm0VvpObeOd.A/dCeVqRDLQ4FVHEFDAy9PFPxu7Umj6', '2019-07-07 17:46:12', 1, 0, NULL, 'a9790485a5122b823f18a856d061f319', NULL, 0);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `Categories`
--
ALTER TABLE `Categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `Comments`
--
ALTER TABLE `Comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Contents`
--
ALTER TABLE `Contents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `Events`
--
ALTER TABLE `Events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `Likes`
--
ALTER TABLE `Likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT pour la table `Menus`
--
ALTER TABLE `Menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `Permissions`
--
ALTER TABLE `Permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Roles`
--
ALTER TABLE `Roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `Settings`
--
ALTER TABLE `Settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `Songs`
--
ALTER TABLE `Songs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT pour la table `Users`
--
ALTER TABLE `Users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
