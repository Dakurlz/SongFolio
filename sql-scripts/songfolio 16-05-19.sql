-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : database
-- Généré le :  mer. 15 mai 2019 à 22:03
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
  `slug` int(11) NOT NULL,
  `date_published` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cover` varchar(255) NOT NULL,
  `deezer` varchar(100) DEFAULT NULL,
  `spotify` varchar(100) DEFAULT NULL,
  `likes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(44, 'categ_1', 'categ_1', 'article'),
(45, 'categ_2', 'categ_2', 'article'),
(46, 'Concert', NULL, 'event'),
(47, 'Festival', NULL, 'event');

-- --------------------------------------------------------

--
-- Structure de la table `Comments`
--

CREATE TABLE `Comments` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `typeId` int(11) NOT NULL,
  `confirm` tinyint(1) NOT NULL,
  `message` longtext CHARACTER SET utf8 NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `like` int(11) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Comments`
--

INSERT INTO `Comments` (`id`, `user`, `typeId`, `confirm`, `message`, `date_created`, `like`, `type`) VALUES
(1, 1, 19, 0, 'un comment ', '2019-05-04 23:16:43', 0, 'article');

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
(20, 'article', 'test', 44, 'Comment faife le *****', 'my seo description', '<p>sdfsdfsdfsd</p>\r\n\r\n<p>sdfsdf<img alt=\"heart\" src=\"https://cdn.ckeditor.com/4.11.3/full/plugins/smiley/images/heart.png\" style=\"height:20px; width:20px\" title=\"heart\" /></p>\r\n\r\n<p><strong>fsd<span style=\"font-family:Arial,Helvetica,sans-serif\">&nbsp;sfdfsfs</span></strong></p>\r\n\r\n<p><strong><span style=\"font-family:Arial,Helvetica,sans-serif\">je croi pas mais quan mem&nbsp;</span></strong></p>', '2019-05-08 13:19:58', NULL, 1, 'public/uploads/contents/screeshot7.jpg', 1, 1, 0),
(27, 'article', 'lolol', 45, 'xcvxvc', 'cxvxv', '<p>fghdgdfg</p>', '2019-05-08 15:40:32', '2019-05-08 17:21:35', 1, 'public/uploads/contents/Screenshot_8.png', 1, 0, 1),
(28, 'page', 'page', NULL, 'Pge test', 'cvxcvbx', '<p>zerzerze</p>\r\n\r\n<p>zer</p>\r\n\r\n<p>ze</p>\r\n\r\n<p>rs</p>\r\n\r\n<p>dfs</p>', '2019-05-08 17:30:21', '2019-05-08 17:33:39', 1, 'public/uploads/contents/screeshot7.jpg', 1, 0, 1);

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
  `ticketing` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Events`
--

INSERT INTO `Events` (`id`, `displayName`, `type`, `status`, `start_date`, `end_date`, `img_dir`, `details`, `rate`, `nbr_place`, `address`, `city`, `postal_code`, `slug`, `ticketing`) VALUES
(1, 'un nouveau events ', '46', 'ok', '2019-05-15 00:56:00', '2019-05-18 01:58:00', 'public/uploads/events/screeshot7.jpg', '    qdqsdqsdqsdqd', 123, 400, '15 rue du Docteur Pesque', 'Aubervilliers', '93300', 'event1', 'https://www.billetweb.fr/apocalypse-caf&src=agenda'),
(2, 'un nouveau events 2', '47', 'ok', '2019-05-14 22:59:00', '2019-05-07 00:59:00', 'public/uploads/events/Screenshot_7.png', 'this is my description blaaaaaaaaaaa aaaaaaaaaaaaaaaaaaaaaaaaaaa\r\naaaaaaaaaaaaa aaaaaaaaaaaaaaaaaaaaaaaaaaa aaaaaaaaaaaaaa', 92, 360, '15 rue du Docteur Pesque', 'Aubervilliers', '93300', 'event2', 'https://www.billetweb.fr/apocalypse-caf&src=agenda');

-- --------------------------------------------------------

--
-- Structure de la table `Lyrics`
--

CREATE TABLE `Lyrics` (
  `id` int(11) NOT NULL,
  `date_published` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `content` varchar(350) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(2, 'Main Menu', '[{\"link\": \"http://3\", \"title\": \"SEO\"}, {\"link\": \"http://2\", \"title\": \"Support\"}, {\"link\": \"http://1\", \"title\": \"Index\"}, {\"link\": \"http://6\", \"title\": \"Contact\", \"children\": [{\"link\": \"http://5\", \"title\": \"Services\", \"children\": [{\"link\": \"http://4\", \"title\": \"Portfoion\"}]}]}, {\"link\": \"http://3\", \"title\": \"About Us\"}, {\"link\": \"http://1\", \"title\": \"Design\"}, {\"link\": \"http://5\", \"title\": \"Develope\"}]'),
(3, 'Main Menu 2', '[{\"link\": \"http://5\", \"title\": \"Services\", \"children\": [{\"link\": \"http://1\", \"title\": \"Design\"}, {\"link\": \"http://5\", \"title\": \"Develope\"}, {\"link\": \"http://3\", \"title\": \"SEO\"}, {\"link\": \"http://3\", \"title\": \"About Us\"}, {\"link\": \"http://4\", \"title\": \"Portfoion\"}, {\"link\": \"http://2\", \"title\": \"Support\", \"children\": [{\"link\": \"http://6\", \"title\": \"Contact\"}]}]}, {\"link\": \"http://1\", \"title\": \"Index\"}]');

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
(1, 'Admin', '{\"role_add\": \"1\", \"role_del\": \"1\", \"user_add\": \"1\", \"user_del\": \"1\", \"all_perms\": \"1\", \"role_edit\": \"1\", \"role_view\": \"1\", \"user_edit\": \"1\"}'),
(3, 'test role 2', '{\"all_perms\": \"1\"}');

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
(1, 'config', '{\"site_desc\": \"test\", \"site_name\": \"MAPAGE\", \"site_tags\": \"test\"}'),
(2, 'header', '[]');

-- --------------------------------------------------------

--
-- Structure de la table `Slugs`
--

CREATE TABLE `Slugs` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `Songs`
--

CREATE TABLE `Songs` (
  `id` int(11) NOT NULL,
  `album` int(11) NOT NULL,
  `slug` int(11) NOT NULL,
  `likes` int(11) NOT NULL,
  `visual` varchar(255) NOT NULL,
  `origin` varchar(50) NOT NULL,
  `source` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `Users`
--

CREATE TABLE `Users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(60) NOT NULL,
  `date_inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `role` varchar(50) NOT NULL DEFAULT '0',
  `role_id` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `date_update` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `login_token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Users`
--

INSERT INTO `Users` (`id`, `username`, `email`, `password`, `date_inserted`, `role`, `role_id`, `status`, `date_update`, `login_token`) VALUES
(1, 'Vexyos', '', '$2y$10$MyXBMxoUW8N/xUxoEQccfu5u8NuSnqxqg.T9C2bRoQmsGrpB62uIS', '2019-01-25 14:04:13', '0', 0, 1, NULL, ''),
(2, 'Vexyos', 'test@oot.fr', '$2y$10$uSCMkSR2CIyZxHuUi5og3OSX4Ayg7VTrKZ86UrJvxNpmREpeITw2W', '2019-01-25 14:04:37', '0', 0, 1, NULL, ''),
(3, 'Vexyos', 'test@oot.fr', '$2y$10$kbRUmCg.UO1/BjOPkz7twePermPri0y4MP4haPgy/dhThK151foPa', '2019-01-25 14:05:51', '0', 0, 1, NULL, ''),
(4, 'Vexyos', 'test@oot.fr', '$2y$10$HkSkTRRfl1qgnMYHRLJCOuUEMYz56dCepODayE76JqFhpLOj7KQBu', '2019-01-25 14:06:07', '0', 0, 1, NULL, ''),
(5, 'Vexyos', 'test@oot.fr', '$2y$10$u7ibfbwdjbbi7B5AEtHrQOMnmWVZGcrHu117tu94KE4BpprLkpuDy', '2019-01-25 14:07:09', '0', 0, 1, NULL, ''),
(6, 'Test', 'test@test.fr', '$2y$10$q3Jtbc5l9CXt.9GjI8Ix0OFeAfEVj..X.fwYU4U0b4jRGnnZrVIUS', '2019-01-25 14:11:06', '0', 0, 1, NULL, ''),
(7, 'Admin', 'test@hotmail.fr', '$2y$10$YcKTtIrDC.gnUMG6Vd0DG.VHSeErl9hHNJWL95GapzpzYWj8b07YK', '2019-04-01 08:26:33', 'admin', 1, 1, '2019-05-14 20:00:58', '093cbd86a462cd82b483240b54666bf6');

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
-- Index pour la table `Lyrics`
--
ALTER TABLE `Lyrics`
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
-- Index pour la table `Slugs`
--
ALTER TABLE `Slugs`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Categories`
--
ALTER TABLE `Categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT pour la table `Comments`
--
ALTER TABLE `Comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `Contents`
--
ALTER TABLE `Contents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT pour la table `Events`
--
ALTER TABLE `Events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `Lyrics`
--
ALTER TABLE `Lyrics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Menus`
--
ALTER TABLE `Menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `Permissions`
--
ALTER TABLE `Permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Roles`
--
ALTER TABLE `Roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `Settings`
--
ALTER TABLE `Settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `Slugs`
--
ALTER TABLE `Slugs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Songs`
--
ALTER TABLE `Songs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Users`
--
ALTER TABLE `Users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
