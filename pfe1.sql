-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Sam 21 Juillet 2018 à 14:25
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `pfe1`
--

-- --------------------------------------------------------

--
-- Structure de la table `attribute`
--

CREATE TABLE IF NOT EXISTS `attribute` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Contenu de la table `attribute`
--

INSERT INTO `attribute` (`id`, `nom`) VALUES
(1, 'couleur'),
(2, 'volume'),
(3, 'taille');

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE IF NOT EXISTS `categorie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `promotion_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_497DD634139DF194` (`promotion_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=17 ;

--
-- Contenu de la table `categorie`
--

INSERT INTO `categorie` (`id`, `nom`, `promotion_id`) VALUES
(1, 'femme', 1),
(3, 'homme', NULL),
(4, 'enfant', NULL),
(5, 'art', NULL),
(6, 'livre', NULL),
(7, 'electronique', NULL),
(8, 'electronique1', NULL),
(9, 'caméras et photo', NULL),
(10, 'maison et jardin', NULL),
(11, 'maison et jardin', NULL),
(12, 'moteurs', NULL),
(13, 'bébé', NULL),
(14, 'DVD et film', NULL),
(15, 'pc', NULL),
(16, 'robe', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `fos_user`
--

CREATE TABLE IF NOT EXISTS `fos_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `confirmation_token` varchar(180) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_957A647992FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_957A6479A0D96FBF` (`email_canonical`),
  UNIQUE KEY `UNIQ_957A6479C05FB297` (`confirmation_token`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=22 ;

--
-- Contenu de la table `fos_user`
--

INSERT INTO `fos_user` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `confirmation_token`, `password_requested_at`, `roles`) VALUES
(1, 'maha', '', 'maha.maha@gmail.com', '', 1, 'null', '123456', NULL, NULL, NULL, ''),
(6, 'maha23', 'maha23', 'maha.maha23@gmail.com', 'maha.maha23@gmail.com', 1, NULL, '$2y$13$yKYt.dHxGRjatDYzlVHOPOIjDtphz4XOWac1bbqvknQ0z8zGhYXqW', '2018-04-10 16:03:35', NULL, NULL, 'a:0:{}'),
(13, 'maha24', 'maha24', 'maha.test24@gmail.com', 'maha.test24@gmail.com', 1, NULL, '$2y$13$TLjXlcS6OFb5P8hrr4epd.T99Z5ZL8TA/XMZ5xDjb3SO.SS1.azsm', '2018-04-18 09:27:26', NULL, NULL, 'a:0:{}'),
(14, 'mahamechri', 'mahamechri', 'maha.mechri@gmail.com', 'maha.mechri@gmail.com', 1, NULL, '$2y$13$6jTWjca2X3XEQ1RTeJ7KHuj2g4WpRTTm5Go.qNRb8IAPCu0oQ7K5e', '2018-04-19 13:54:38', NULL, NULL, 'a:0:{}'),
(15, 'maha11', 'maha11', 'mahamaha11@gmail.com', 'mahamaha11@gmail.com', 1, NULL, '$2y$13$lSWO4RXuKvh08d9nfgO1WeElEWH9Ki8O5Ka82zo0u4SOtJPjqRU6i', '2018-04-20 08:09:39', NULL, NULL, 'a:0:{}'),
(16, 'mechri', 'mechri', 'mechri.maha@gmail.com', 'mechri.maha@gmail.com', 1, NULL, '$2y$13$ARqxVzrrmyWrXchm6lmVz.jz8uf0pqYU3L/xZwvgIv4P40KCnbj/a', '2018-07-04 17:11:17', NULL, NULL, 'a:1:{i:0;s:10:"ROLE_ADMIN";}'),
(17, 'mechriTest', 'mechritest', 'mechri.mechri@gmail.com', 'mechri.mechri@gmail.com', 1, NULL, '$2y$13$VzrkKRsRPADURH8mtC/lY./1oF0QHf.Vl56gXHyiXtz7ywHbE77oK', '2018-07-10 16:17:36', NULL, NULL, 'a:1:{i:0;s:12:"ROLE_VENDEUR";}'),
(18, 'mahatest', 'mahatest', 'maha.test@gmail.com', 'maha.test@gmail.com', 1, NULL, '$2y$13$XMeDuO12xDDlrAh4IbhY4uHmDmjOQRZIXR6ATDM0qfPGQzKH30.n6', '2018-07-04 17:13:38', NULL, NULL, 'a:1:{i:0;s:12:"ROLE_VENDEUR";}'),
(19, 'mahatest1', 'mahatest1', 'maha.test1@gmail.com', 'maha.test1@gmail.com', 1, NULL, '$2y$13$YKCJR6chr9wj1WYRrLGJpe1pjhYsTI8Gp9i2sOzpdHZ4nV1hx4N3S', '2018-05-15 22:00:38', NULL, NULL, 'a:0:{}'),
(20, 'test1', 'test1', 'test1@gmail.com', 'test1@gmail.com', 1, NULL, '$2y$13$M8rs.OuzXbVflqHdq6Y6COjLefC7dfMJseLZrwTeaSoLYpyLZs1J6', '2018-05-31 14:15:23', NULL, NULL, 'a:0:{}'),
(21, 'aaaa', 'aaaa', 'mahatest@gmail.com', 'mahatest@gmail.com', 1, NULL, '$2y$13$BDnL99bukV72lANtEDwaLeZwLNbLGN44PQup/59GBWq1ZAELJqU2.', '2018-06-06 08:36:18', NULL, NULL, 'a:0:{}');

-- --------------------------------------------------------

--
-- Structure de la table `image`
--

CREATE TABLE IF NOT EXISTS `image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE IF NOT EXISTS `produit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prix` decimal(10,3) NOT NULL,
  `file` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `shop_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_29A5EC274D16C4DD` (`shop_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=46 ;

--
-- Contenu de la table `produit`
--

INSERT INTO `produit` (`id`, `nom`, `prix`, `file`, `description`, `shop_id`) VALUES
(2, 'ggggg', '2.556', 'C:\\wamp64\\tmp\\phpC54C.tmp', 'gggg', NULL),
(5, 'telephone', '250.500', 'c1b4c352c9c036e7af1a8af21813d112.jpeg', 'smart', NULL),
(6, 'hgyuh', '520.333', 'a6a9186f4fd519129dff0402cb1e5280.jpeg', 'ihihkl', NULL),
(7, 'ghjfj', '556.000', 'ed3cea41bb0469adeaeb19419f566ffe.jpeg', 'jhkj', NULL),
(8, 'vdscd', '589.222', '027f91a6a291618e648dc1b736e49232.jpeg', 'vervcvedc', NULL),
(9, 'gfff', '589.000', '9efd6f899704a79b702bc10cadece7c9.jpeg', 'fvdfds', NULL),
(10, 'iuyhkuh', '259.000', '48dc5ebd34988381de4df3b97cf0e5be.jpeg', 'hykiiihkol', NULL),
(11, 'hkjkj', '580.333', 'f14ba646fb7e29ad8df0e961f0c541bd.jpeg', 'kjkk', NULL),
(12, 'gfgfg', '520.333', '79c7f86e86ee63de36af664719707e36.jpeg', 'fgfg', NULL),
(13, 'ssssssss', '580.000', '48cf19bccd550010c5060c9152632a45.jpeg', 'sssssssss', NULL),
(14, 'gujhj', '555.000', 'd112d2cb0134848f13debfb847de3c36.jpeg', 'hjyhyj', NULL),
(15, 'gujhj', '555.000', 'b353791da539e6074d98a93ec9972582.jpeg', 'hjyhyj', NULL),
(16, 'fffff', '250.333', 's:37:"7264869d8d3783d6e177c9aba2a50790.jpeg";', 'fffffffffffffff', NULL),
(17, 'vvvvvv', '253.000', 's:37:"37b40708b054d72d7ef96b402d132aef.jpeg";', 'vvvvvvvvv', NULL),
(18, 'luna', '150.000', 's:37:"61247d0568d3b4aeda4675ce05325ba6.jpeg";', 'parfum haut gamme', NULL),
(19, 'tel', '250.333', 's:37:"67c15081ef1c45aea588da2817d8746f.jpeg";', 'smart', NULL),
(20, 'teleph', '250.000', 's:37:"57f16b956488fa0f27e9e5c08a343d5d.jpeg";', 'smart', NULL),
(21, 'telm', '850.000', 's:37:"b0681cd06bf74855966cf4c4ed3f476d.jpeg";', 'smartm', NULL),
(22, 'tttttt', '250.000', 's:37:"53077410a4eb7189154162763ae828d9.jpeg";', 'ttttttt', NULL),
(23, 'produitm', '550.000', 's:37:"63f3ad51137fcff6fbc8b5cda361813a.jpeg";', 'mmmm', NULL),
(24, 'fixe', '250.000', 's:37:"69168be13557d6e514844f4c81558b0b.jpeg";', 'pfix', NULL),
(25, 'fixe', '250.000', 's:37:"6419118fa4ac8f3ba4b9d5ea5106abf1.jpeg";', 'pfix', NULL),
(26, 'produitTest', '250.000', 's:37:"1cf4b6df4106187aa2319f00fd76e57f.jpeg";', 'test', NULL),
(27, 'produitTest1', '250.000', 's:37:"fa9ba590faf73032088a98fc0702428c.jpeg";', 'test1', NULL),
(29, 'produitTest11', '250.000', 's:37:"17607bb18158b1549b880b22baeae2f2.jpeg";', 'test11', NULL),
(30, 'produitTest11', '250.000', 's:37:"5ec79820de86862781505d1a7e97523c.jpeg";', 'test11', NULL),
(31, 'produitTest11', '250.000', 's:37:"99c0cdc66436852fdb2bdbcd50cb33f8.jpeg";', 'test11', NULL),
(32, 'produitTest11', '250.000', 's:37:"9e4a4571ef793741489b5770daacf4a8.jpeg";', 'test11', NULL),
(33, 'produitt', '550.000', 's:37:"7fce4df3ceba6e15195e10ab30428b36.jpeg";', 'produittDesc', NULL),
(34, 'produitt', '550.000', 's:37:"57cf6c99ac6f754ef686174968f11e59.jpeg";', 'produittDesc', NULL),
(35, 'jnkjn', '253.000', 's:37:"ef752778c468ca3b20ecb7783cc61f0a.jpeg";', 'jjhjkjk', NULL),
(36, 'llmhj', '582.000', 's:37:"0c8d3cdb797f4e5e16a95029dc0d5f5a.jpeg";', 'hghj', NULL),
(37, 'telephoni', '850.000', 's:37:"c05c3aaa5c4f5441ef2e6de3f9943051.jpeg";', 'smartii', NULL),
(39, 'telephoniiiii', '250.000', 'c5bd7a0e214e098be9246d4fe8b1931c.jpeg', 'smart', 20),
(40, 'kgukj', '20000.000', '465f6317d137d35e71edf13464f8d7c8.jpeg', 'khgjhkj,', 20),
(41, 'port', '520.000', 'cee890a760b2df84498c8a3116d5b282.jpeg', 'smart', 20),
(42, 'port', '520.000', '4ee44001ad55abc672a74974413fd9ed.jpeg', 'smart', 20),
(43, 'pt', '650.000', '7186c0f5e5e49ada9602e3377016e295.jpeg', 'kfjlkffv', 20),
(44, 'portable', '520.000', 'e40d53853466ca5fee57eea2cf0bf8d9.jpeg', 'smart', 20),
(45, 'robe', '20.350', 'C:\\wamp\\tmp\\php8F96.tmp', 'robe pour femme couleur rouge', 21);

-- --------------------------------------------------------

--
-- Structure de la table `produit_categorie`
--

CREATE TABLE IF NOT EXISTS `produit_categorie` (
  `produit_id` int(11) NOT NULL,
  `categorie_id` int(11) NOT NULL,
  PRIMARY KEY (`produit_id`,`categorie_id`),
  KEY `IDX_CDEA88D8F347EFB` (`produit_id`),
  KEY `IDX_CDEA88D8BCF5E72D` (`categorie_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `produit_categorie`
--

INSERT INTO `produit_categorie` (`produit_id`, `categorie_id`) VALUES
(13, 1),
(13, 3),
(14, 1),
(14, 3),
(15, 1),
(15, 3),
(16, 3),
(17, 3),
(18, 1),
(19, 7),
(20, 8),
(21, 8),
(22, 8),
(23, 7),
(24, 8),
(25, 8),
(26, 5),
(27, 5),
(32, 7),
(33, 8),
(34, 8),
(35, 8),
(36, 7),
(37, 5),
(39, 5),
(40, 9),
(41, 5),
(42, 5),
(43, 7),
(43, 9),
(44, 7),
(45, 1),
(45, 16);

-- --------------------------------------------------------

--
-- Structure de la table `produit__attribute`
--

CREATE TABLE IF NOT EXISTS `produit__attribute` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `valeur` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `produit_id` int(11) DEFAULT NULL,
  `attribute_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_1EDE77EBF347EFB` (`produit_id`),
  KEY `IDX_1EDE77EBB6E62EFA` (`attribute_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=21 ;

--
-- Contenu de la table `produit__attribute`
--

INSERT INTO `produit__attribute` (`id`, `valeur`, `produit_id`, `attribute_id`) VALUES
(1, 'bleu', NULL, 1),
(2, 'bleu', NULL, 1),
(3, 'rouge', NULL, 1),
(4, 's', 24, 3),
(5, 'bleu', 25, 1),
(6, 'small', 25, 3),
(7, 'bleuuuuu', 26, 1),
(8, '150', 27, 2),
(13, 'bleu', 32, 1),
(14, 'bleu', 33, 1),
(15, 'rose', 34, 1),
(16, 'blue', 35, 1),
(17, 'rose', 36, 1),
(18, 'bleu', 37, 1),
(19, 'blue', 39, 1),
(20, 'bleu', 41, 1);

-- --------------------------------------------------------

--
-- Structure de la table `promotion`
--

CREATE TABLE IF NOT EXISTS `promotion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dateDebut` date NOT NULL,
  `dateFin` date NOT NULL,
  `nouveauPrix` decimal(10,3) DEFAULT NULL,
  `pourcentage` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Contenu de la table `promotion`
--

INSERT INTO `promotion` (`id`, `dateDebut`, `dateFin`, `nouveauPrix`, `pourcentage`) VALUES
(1, '2018-05-02', '2018-05-16', NULL, '0.2');

-- --------------------------------------------------------

--
-- Structure de la table `shop`
--

CREATE TABLE IF NOT EXISTS `shop` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Activite` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Telephone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Adresse` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `statut` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_AC6A4CA2A76ED395` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=22 ;

--
-- Contenu de la table `shop`
--

INSERT INTO `shop` (`id`, `nom`, `description`, `Activite`, `Telephone`, `Adresse`, `logo`, `user_id`, `statut`) VALUES
(1, 'Nom du Shop', 'Description', '', '', '', '', NULL, 0),
(2, 'shop maha', 'shop shop', '', '', '', '', NULL, 0),
(3, 'test', 'text', '', '', '', '', NULL, 0),
(8, 'marwashop', 'shopmarwa', 'vetement', '55555555', 'sousse', '', NULL, 0),
(9, 'marwashop1', 'shopshop', 'vetement', '22222222', 'sousse', '', NULL, 0),
(10, 'sdeesdfc', 'sdcsc', 'cdsfsef', 'dqzsfrez', 'zrfzef', '', NULL, 0),
(11, 'uihiugjh', 'uiuhiugiu', 'lkihjliugjk', 'liljioih', 'ihiuguk', '', NULL, 0),
(12, 'mahamaha', 'aaaaaaaa', 'bbbbbbb', '94643513136546', 'dvv<wdcv<dsvv', '', NULL, 0),
(13, 'shopmechri', 'vvvvvvv', 'aaaaaaaa', 'bbbbbbbb', 'bbbbbbbbb', '', NULL, 0),
(14, 'shopMechriTest', 'shop', 'vente', '5555555', 'sousse', 'C:\\wamp64\\tmp\\phpBBE2.tmp', NULL, 0),
(15, 'ShopShop', 'vente', 'vente', '55555555', 'sousse', '2026030df2e11534875987f869f17d08.png', NULL, 0),
(16, 'testlogo', 'logo', 'test', '25845117', 'test@test.com', 'logo-shopme.png', NULL, 0),
(17, 'xxxxx', 'eeeeee', 'gfgfg', '222222', 'aaaaaaaaa', '111.jpg', 6, 0),
(20, 'aaaa', 'AAAA', 'AAAA', '222', 'AAAAA', 'logo-shopme.png', 17, 1),
(21, 'fashion mode', 'notre boutique offre la vente en ligne des vêtement prêt a porter pour tout la génération (Hommes ,Femme et Enfant )', 'vente en ligne et en locale', '54061519', 'sousse', 'shopme.png', 18, 1);

-- --------------------------------------------------------

--
-- Structure de la table `slider`
--

CREATE TABLE IF NOT EXISTS `slider` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shop_id` int(11) DEFAULT NULL,
  `imaslider` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_CFC710074D16C4DD` (`shop_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Contenu de la table `slider`
--

INSERT INTO `slider` (`id`, `shop_id`, `imaslider`) VALUES
(8, 20, 'C:\\wamp64\\tmp\\php8A76.tmp'),
(9, 20, 'banner-02.jpg'),
(10, 20, 'banner-01.jpg');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD CONSTRAINT `FK_497DD634139DF194` FOREIGN KEY (`promotion_id`) REFERENCES `promotion` (`id`);

--
-- Contraintes pour la table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `FK_29A5EC274D16C4DD` FOREIGN KEY (`shop_id`) REFERENCES `shop` (`id`);

--
-- Contraintes pour la table `produit_categorie`
--
ALTER TABLE `produit_categorie`
  ADD CONSTRAINT `FK_CDEA88D8BCF5E72D` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_CDEA88D8F347EFB` FOREIGN KEY (`produit_id`) REFERENCES `produit` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `produit__attribute`
--
ALTER TABLE `produit__attribute`
  ADD CONSTRAINT `FK_1EDE77EBB6E62EFA` FOREIGN KEY (`attribute_id`) REFERENCES `attribute` (`id`),
  ADD CONSTRAINT `FK_1EDE77EBF347EFB` FOREIGN KEY (`produit_id`) REFERENCES `produit` (`id`);

--
-- Contraintes pour la table `shop`
--
ALTER TABLE `shop`
  ADD CONSTRAINT `FK_AC6A4CA2A76ED395` FOREIGN KEY (`user_id`) REFERENCES `fos_user` (`id`);

--
-- Contraintes pour la table `slider`
--
ALTER TABLE `slider`
  ADD CONSTRAINT `FK_CFC710074D16C4DD` FOREIGN KEY (`shop_id`) REFERENCES `shop` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
