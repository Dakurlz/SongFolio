-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : database
-- Généré le :  mer. 03 juil. 2019 à 17:34
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
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Albums`
--

INSERT INTO `Albums` (`id`, `title`, `description`, `slug`, `date_published`, `cover_dir`, `deezer`, `spotify`, `likes`, `category_id`) VALUES
(2, 'aaaaaa', 'sdfsdfsdf', 'aaaaaa', '2019-06-26 19:29:10', 'public/uploads/albums/screeshot7.jpg', 'qsdqsd', 'qsdqsd', NULL, 51),
(3, 'qsdqsdqsdqsd', 'qsdqsd', 'qsdqsdqsdqsd', '2019-07-03 12:22:50', 'public/uploads/albums/screeshot7.jpg', 'qsdqs', 'qsdqsd', NULL, 53),
(7, 'test-albums-lol', 'SQDFQSDF', 'test-albums-lol', '2019-07-03 12:29:40', NULL, 'qsdqsdqsdqsd', '', NULL, 51);

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
(47, 'Festival', NULL, 'event'),
(48, 'sdfsdf', NULL, 'album'),
(51, 'aaaa', NULL, 'album'),
(52, 'test', NULL, 'article'),
(53, 'sqdqsdqdqsdqsdqd', NULL, 'album');

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

--
-- Déchargement des données de la table `Comments`
--

INSERT INTO `Comments` (`id`, `user_id`, `type_id`, `confirm`, `message`, `date_created`, `type`) VALUES
(1, 1, 19, 1, 'un comment wxfdbgezdesdfgdfsdfsd\r\nf\r\nsdfs\r\ndfsdfsdfsdfsdfsdfsdfsdfsdf\r\nsd\r\nfs\r\ndf\r\nsdf\r\nsdfsdfsdfsddddddddddddddddd', '2019-05-04 23:16:43', 'article'),
(3, 10, 27, 1, 'un autre comment', '2019-05-31 21:11:55', 'article'),
(4, 10, 27, 1, 'qsdqsdq', '2019-05-31 21:30:06', 'article'),
(5, 10, 27, 1, 'qSDFGHJ', '2019-05-31 21:31:11', 'article'),
(8, 10, 27, 1, 'dazdazd', '2019-06-01 11:59:13', 'article'),
(9, 10, 27, 1, 'efzedfzsfd', '2019-06-01 11:59:30', 'article'),
(10, 10, 20, 1, 'qsdqsd', '2019-07-03 15:43:45', 'article'),
(11, 10, 20, 0, 'test comment + alert', '2019-07-03 15:59:23', 'article'),
(12, 10, 20, 0, 'qsdqsd', '2019-07-03 16:05:20', 'article'),
(13, 10, 20, 0, 'qsdqsdqs', '2019-07-03 16:06:10', 'article'),
(14, 10, 20, 0, 'qsdqsdqs', '2019-07-03 16:06:45', 'article'),
(15, 10, 20, 0, 'qsdqsd', '2019-07-03 16:06:47', 'article'),
(16, 10, 20, 0, 'qsdqsdqsdq', '2019-07-03 16:10:35', 'article'),
(17, 10, 20, 0, 'qsdqsdqsd', '2019-07-03 16:10:58', 'article'),
(18, 10, 20, 0, 'qsdqsdqsd', '2019-07-03 16:28:42', 'article');

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
(20, 'article', 'test', 44, 'Comment ? ah ? ', 'my seo description', '<p>sdfsdfsdfsd</p>\r\n\r\n<p>sdfsdf<img alt=\"heart\" src=\"https://cdn.ckeditor.com/4.11.3/full/plugins/smiley/images/heart.png\" style=\"height:20px; width:20px\" title=\"heart\" /></p>\r\n\r\n<p><strong>fsd<span style=\"font-family:Arial,Helvetica,sans-serif\">&nbsp;sfdfsfs</span></strong></p>\r\n\r\n<p><strong><span style=\"font-family:Arial,Helvetica,sans-serif\">je croi pas mais quan mem&nbsp;</span></strong></p>', '2019-05-08 13:19:58', '2019-07-03 16:09:29', 1, 'public/uploads/contents/screeshot7.jpg', 1, 1, 0),
(27, 'article', 'lolol', 45, 'xcvxvc', 'cxvxv', '<p>fghdgdfg</p>', '2019-05-08 15:40:32', '2019-05-30 13:11:41', 1, 'public/uploads/contents/Screenshot_8.png', 1, 1, 1),
(28, 'page', 'page', NULL, 'Pge test', 'cvxcvbx', '<p>zerzerze</p>\r\n\r\n<p>zer</p>\r\n\r\n<p>ze</p>\r\n\r\n<p>rs</p>\r\n\r\n<p>dfs</p>', '2019-05-08 17:30:21', '2019-05-08 17:33:39', 1, 'public/uploads/contents/screeshot7.jpg', 1, 0, 1),
(29, 'page', 'aaa', NULL, 'ayu', 'aaa', 'sdfsdf', '2019-05-16 19:10:53', NULL, 1, NULL, 1, 0, 0),
(30, 'page', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', NULL, 'aaaaaaaaaaaaaaaaa', 'aaa', 'sdfsdf', '2019-05-16 19:11:18', NULL, 1, NULL, 1, 0, 0),
(31, 'article', 'test-pub', 52, 'test pub', 'azdadz', '<p>qsdqsdqs</p>\r\n\r\n<p>dqs</p>\r\n\r\n<p>dqs</p>\r\n\r\n<p>d</p>\r\n\r\n<p>qs</p>\r\n\r\n<p>d</p>', '2019-06-02 15:16:21', NULL, 13, NULL, 0, 1, 1);

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
(2, 'un nouveau events 2', '47', 'ok', '2019-05-14 22:59:00', '2019-05-07 00:59:00', 'public/uploads/events/Screenshot_7.png', 'this is my description blaaaa', 92, 360, '15 rue du Docteur Pesque', 'Aubervilliers', '93300', 'event2', 'azeaze', 'https://www.billetweb.fr/apocalypse-caf&src=agenda'),
(3, 'qsd qsd qs q d', '47', 'ok', '2019-05-30 00:57:00', '2019-05-14 23:58:00', 'public/uploads/events/Screenshot_6.png', 'qsdq qs d', 4, 100, '36 RUE CLAUDE TERRASSE', 'Paris 16', '75016', 'qsd-qsd-qs-q-d', 'qsdd qd q', 'non');

-- --------------------------------------------------------

--
-- Structure de la table `Likes`
--

CREATE TABLE `Likes` (
  `id` int(11) NOT NULL,
  `nb_like` int(11) NOT NULL DEFAULT '0',
  `type` varchar(255) NOT NULL,
  `type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(2, 'Main Menu', '[{\"link\": \"http://localhost/\", \"title\": \"Accueil\"}, {\"link\": \"/evenement\", \"title\": \"Evenements\"}, {\"link\": \"/connexion\", \"title\": \"Mon compte\"}, {\"link\": \"/admin\", \"title\": \"Admin\"}]'),
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
(3, 'test role 2', '{\"all_perms\": \"1\"}'),
(4, 'test rol', '{\"role_add\": \"1\", \"role_del\": \"1\", \"user_add\": \"1\", \"user_del\": \"1\"}'),
(5, 'test comment rol', '{\"user_add\": \"1\", \"user_del\": \"1\", \"event_add\": \"1\", \"event_del\": \"1\", \"user_edit\": \"1\", \"event_edit\": \"1\"}'),
(6, 'test perm pub', '{\"user_add\": \"1\", \"user_del\": \"1\", \"album_add\": \"1\", \"album_del\": \"1\", \"page_view\": \"1\", \"role_view\": \"1\", \"user_edit\": \"1\", \"album_edit\": \"1\", \"content_add\": \"1\", \"content_del\": \"1\", \"article_view\": \"1\", \"comment_perm\": \"1\", \"content_edit\": \"1\"}');

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
(1, 'config', '{\"fb_url\": \"qsdqs\", \"insta_url\": \"link\", \"site_desc\": \"test\", \"site_name\": \"MAPAGE\", \"site_tags\": \"test\", \"twitter_url\": \"link/instagram\", \"oauth_id_Facebook\": \"2232449167069840\", \"oauth_secret_Facebook\": \"ec07adea3bce25a26d3fdcb3b5baa5f2\"}'),
(2, 'header', '{\"header_menu\": \"2\"}'),
(3, 'footer', '{\"copyright\": \"Test\", \"footer_menu\": {\"1\": \"3\", \"2\": \"2\"}, \"footer_menu_nb\": \"2\"}');

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
(1, 'moonlight', 2, 'moonlight', 0, '<p>qsdqsdqsdqsd</p>\r\n\r\n<p>qsd</p>\r\n\r\n<p>qs</p>\r\n\r\n<p>d</p>\r\n\r\n<p>qsdqsdqsdqsdqsdqsdqdqsd</p>', 'qsdqsdqsd', NULL, '', '', '', '2019-07-02 14:35:06'),
(19, 'Roockstra', 7, 'roockstra', 0, '<p>sdfgdgdgdfgsgf</p>', 'sdfgdgf', NULL, '', 'sdfgdgdgf', '', '2019-07-02 15:00:58');

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
  `id_facebook` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Users`
--

INSERT INTO `Users` (`id`, `username`, `first_name`, `last_name`, `email`, `password`, `date_inserted`, `role_id`, `status`, `date_update`, `login_token`, `id_facebook`) VALUES
(8, 'Test', 'qsd', 'qsd', 'ivan.naluzhnyi@gmail.com', '$2y$10$4cyg2G11ZL8rnzj253VnleSSevdZeCk4h96n8pOP/XOPDqkN.jWAS', '2019-05-21 17:20:08', 4, 0, NULL, '227de67949fef05edf1aaffc492ffc9b', NULL),
(10, 'Admin', 'Ivan', 'Naluzhnyi', 'ivan.naluzhnyi@gmail.com', '$2y$10$o3RVvIqVK79u6elgBego0Ol0MbY3HX7h/z1YxBm/EXhGFtNDcV08G', '2019-05-21 17:20:08', 1, 0, NULL, '8ba9c475f7aa632bb3dcdb9c9c21c770', NULL),
(11, 'Adminssdffsfqsdsd', 'Ivanqsdqds', 'Naluzhnyiqsdqds', 'ivan.naluzhnyi@gmail.com', '$2y$10$UtxDzLtbmfAS/j9DnKa50OV5.PpPgoJmmHsDwD2sz4NcK2yEi88A6', '2019-05-21 17:20:08', 1, 0, NULL, '377855b244ab32cd7ceb960bd8166cd5', NULL),
(12, 'Comm', 'azer', 'azer', 'ivan.naluzhnyi@gmail.com', '$2y$10$19zDWeebOgnx7XglWiSCW.7ymAawXmQKmKtF7.0N4e70kfeMqjUju', '2019-05-21 17:20:08', 5, 0, NULL, '6631f03ca5a047345a528baf047e8abf', NULL),
(13, 'Perm', 'aaaaaaaaa', 'aaaaaaaaa', 'ivan.naluzhnyi@gmail.com', '$2y$10$Iw.SDrMxaedI/CqESV76deaFYjH/GInN0hUcHxMkP3fxM3IDsUGL6', '2019-05-21 17:20:08', 6, 0, NULL, '3a371a122e5c51ae8fcf5f7026ef90e2', NULL),
(17, NULL, 'Kilian', 'Diogo', 'kiliandu95360@hotmail.fr', NULL, '2019-06-19 12:26:43', NULL, 0, NULL, 'afa53277a0a0f8eb0700f1ad07cefa03', 3058477917510505);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `Categories`
--
ALTER TABLE `Categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT pour la table `Comments`
--
ALTER TABLE `Comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `Contents`
--
ALTER TABLE `Contents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT pour la table `Events`
--
ALTER TABLE `Events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `Likes`
--
ALTER TABLE `Likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `Settings`
--
ALTER TABLE `Settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `Slugs`
--
ALTER TABLE `Slugs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Songs`
--
ALTER TABLE `Songs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pour la table `Users`
--
ALTER TABLE `Users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
