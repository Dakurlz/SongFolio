-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : database
-- Généré le :  lun. 07 jan. 2019 à 10:55
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
-- Structure de la table `album`
--

CREATE TABLE `album` (
  `abm_id` int(11) NOT NULL,
  `abm_title` varchar(100) NOT NULL,
  `abm_description` varchar(300) NOT NULL,
  `abm_slug` int(11) NOT NULL,
  `abm_date_published` date NOT NULL,
  `abm_cover` varchar(255) NOT NULL,
  `abm_deezer` varchar(100) DEFAULT NULL,
  `abm_spotify` varchar(100) DEFAULT NULL,
  `abm_like` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `cat_name` varchar(100) NOT NULL,
  `cat_description` int(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

CREATE TABLE `comment` (
  `comment_id` int(11) NOT NULL,
  `comment_user` int(11) NOT NULL,
  `comment_page` int(11) NOT NULL,
  `comment_subject` varchar(200) NOT NULL,
  `comment_status` varchar(50) NOT NULL,
  `comment_message` varchar(300) NOT NULL,
  `comment_date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `group`
--

CREATE TABLE `group` (
  `group_id` int(11) NOT NULL,
  `group_name` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `lyric`
--

CREATE TABLE `lyric` (
  `lys_id` int(11) NOT NULL,
  `lys_date_published` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lys_content` varchar(350) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `page`
--

CREATE TABLE `page` (
  `page_id` int(11) NOT NULL,
  `page_type` varchar(100) NOT NULL,
  `page_slug` int(50) NOT NULL,
  `page_cat_id` int(11) NOT NULL,
  `page_title` varchar(100) NOT NULL,
  `page_description` varchar(200) NOT NULL,
  `page_content` varchar(600) DEFAULT NULL,
  `page_header` varchar(150) NOT NULL,
  `page_date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `page_date_modif` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `page_author` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `permission`
--

CREATE TABLE `permission` (
  `permission_id` int(11) NOT NULL,
  `permission_name` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `setting`
--

CREATE TABLE `setting` (
  `set_id` int(11) NOT NULL,
  `set_type` varchar(100) NOT NULL,
  `set_name` varchar(150) NOT NULL,
  `set_value` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `slug`
--

CREATE TABLE `slug` (
  `slug_id` int(11) NOT NULL,
  `slug_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `song`
--

CREATE TABLE `song` (
  `song_id` int(11) NOT NULL,
  `song_album` int(11) NOT NULL,
  `song_slug` int(11) NOT NULL,
  `song_like` int(11) NOT NULL,
  `song_visual` varchar(255) NOT NULL,
  `song_origin` varchar(50) NOT NULL,
  `song_source` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_username` varchar(50) NOT NULL,
  `user_firstname` varchar(50) NOT NULL,
  `user_lastname` varchar(100) NOT NULL,
  `user_email` varchar(250) NOT NULL,
  `user_password` char(60) NOT NULL,
  `user_date_inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_date_visit` timestamp NULL DEFAULT NULL,
  `user_role` int(11) NOT NULL,
  `user_status` tinyint(4) NOT NULL,
  `user_date_update` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`abm_id`);

--
-- Index pour la table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Index pour la table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`comment_id`);

--
-- Index pour la table `group`
--
ALTER TABLE `group`
  ADD PRIMARY KEY (`group_id`);

--
-- Index pour la table `lyric`
--
ALTER TABLE `lyric`
  ADD PRIMARY KEY (`lys_id`);

--
-- Index pour la table `page`
--
ALTER TABLE `page`
  ADD PRIMARY KEY (`page_id`);

--
-- Index pour la table `permission`
--
ALTER TABLE `permission`
  ADD PRIMARY KEY (`permission_id`);

--
-- Index pour la table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`set_id`);

--
-- Index pour la table `slug`
--
ALTER TABLE `slug`
  ADD PRIMARY KEY (`slug_id`);

--
-- Index pour la table `song`
--
ALTER TABLE `song`
  ADD PRIMARY KEY (`song_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `album`
--
ALTER TABLE `album`
  MODIFY `abm_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `comment`
--
ALTER TABLE `comment`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `group`
--
ALTER TABLE `group`
  MODIFY `group_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `lyric`
--
ALTER TABLE `lyric`
  MODIFY `lys_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `page`
--
ALTER TABLE `page`
  MODIFY `page_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `permission`
--
ALTER TABLE `permission`
  MODIFY `permission_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `setting`
--
ALTER TABLE `setting`
  MODIFY `set_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `slug`
--
ALTER TABLE `slug`
  MODIFY `slug_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `song`
--
ALTER TABLE `song`
  MODIFY `song_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
