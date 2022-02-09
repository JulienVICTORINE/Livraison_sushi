-- phpMyAdmin SQL Dump
-- version 4.6.6deb5ubuntu0.5
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:3306
-- Généré le :  Mer 07 Avril 2021 à 15:14
-- Version du serveur :  5.7.32-0ubuntu0.18.04.1
-- Version de PHP :  7.2.24-0ubuntu0.18.04.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `sushi`
--

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `id` int(11) NOT NULL,
  `date_commande` date NOT NULL,
  `statut` varchar(100) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `id_sushi` int(11) NOT NULL,
  `id_ligne_commande` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `ligne_commande`
--

CREATE TABLE `ligne_commande` (
  `id` int(11) NOT NULL,
  `quantite` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `livraison`
--

CREATE TABLE `livraison` (
  `id` int(11) NOT NULL,
  `date_livraison` date NOT NULL,
  `id_mode_livraison` int(11) NOT NULL,
  `id_commande` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `mode_livraison`
--

CREATE TABLE `mode_livraison` (
  `id` int(11) NOT NULL,
  `designation` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `mode_livraison`
--

INSERT INTO `mode_livraison` (`id`, `designation`) VALUES
(1, 'Livraison à domicile');

-- --------------------------------------------------------

--
-- Structure de la table `mode_reglement`
--

CREATE TABLE `mode_reglement` (
  `id` int(11) NOT NULL,
  `designation` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `mode_reglement`
--

INSERT INTO `mode_reglement` (`id`, `designation`) VALUES
(1, 'Espèce'),
(2, 'Carte bancaire');

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

CREATE TABLE `panier` (
  `id` int(11) NOT NULL,
  `total` float NOT NULL,
  `id_mode_livraison` int(11) NOT NULL,
  `id_mode_reglement` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `reglement`
--

CREATE TABLE `reglement` (
  `id` int(11) NOT NULL,
  `montant` float NOT NULL,
  `date_reglement` date NOT NULL,
  `id_commande` int(11) NOT NULL,
  `id_mode_reglement` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `sushis`
--

CREATE TABLE `sushis` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `prix` float NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `sushis`
--

INSERT INTO `sushis` (`id`, `nom`, `description`, `prix`, `image`) VALUES
(2, 'Maki', 'Composé traditionnellement d’un seul ingrédient, une fois roulé il est découpé en 6 à 8 pièces égales avant de finir dans nos assiettes', 5, 'https://www.sushiprod.com/wp-content/uploads/2013/08/maki-300x182.jpg'),
(3, 'California Rolls', 'Il est généralement composé de 2 ou 3 ingrédients et se présente sous la forme d’un Maki inversé (la feuille de nori se trouve à l’intérieur) et le riz Sumeshi est recouvert en parti de sésame', 4, 'https://cuisine.land/upload/recettes/large/53_MQGWWFCAA400CKDU.jpg'),
(4, 'Nigiri', 'Ils sont principalement composés de poissons taillés dont la tranche est plus fine que pour le Sashimi, mais on en trouve également à l’omelette Japonaise (Tamago) maintenue par une lanière de feuille d’algue Nori', 3, 'https://www.marions-kochbuch.de/dru-pic/4425.jpg'),
(5, 'Gunkan', 'Dans sa conception, le Gunkan reprend le cylindre de riz Sumeshi du Nigiri dont il est le dérivé, que l’on entoure d’un morceau de Nori pour ensuite y déposer un ingrédient. Le plus usité étant les œufs de saumon, on y trouve également du corail d’oursin, du tartare de saumon, etc', 7, 'https://lh3.googleusercontent.com/proxy/V9PEduCuBk3eCDDQJyF3YYLUqx7UP5scZaqIMO1fUA4zlP0SPIOjizpmCGzFF9IRuoYLuVhGOvSP-cLG7KezNhm3CBrHAFWvgKUitciK8LIBEBqjebc'),
(6, 'Temaki', 'Il s’agit d’un maki dont l’aspect se rapproche d’un cône ou encore d’un cornet, rempli de riz et de deux ingrédients (généralement avocat et saumon ou crevette cuite) et souvent saupoudré de graines de sésame dorées', 4, 'https://cac.img.pmdstatic.net/fit/http.3A.2F.2Fprd2-bone-image.2Es3-website-eu-west-1.2Eamazonaws.2Ecom.2Fcac.2F2018.2F09.2F25.2F35f97a2f-3526-409a-9d96-867a21c55d99.2Ejpeg/750x562/quality/80/crop-from/center/cr/wqkgU3RvY2tmb29kL1N1Y3LDqSBzYWzDqSAvIEN1aXNpbmUgQWN0dWVsbGU%3D/temaki-sushi-au-saumon.jpeg'),
(7, 'Temari', 'Le Temari Sushi ou Temarizushi est le cousin direct du Nigiri Sushi, et est d’ailleurs très semblable à ce dernier, à cela près que le riz est formé en boule. Une fois la boule roulée à la main, on y dépose une tranche de poisson.', 4, 'https://media.istockphoto.com/photos/japanese-food-ball-shaped-sushi-temarizushi-picture-id1137715869?k=6&m=1137715869&s=612x612&w=0&h=rYxPZM46JHUgEC2I-YjGj3GbIjrlFvhUGlZdjwf-3T4='),
(8, 'Egg Roll', 'Toujours dans un souci de plaire à tout le monde, et notamment aux personnes que la feuille d’algue Nori rebute quelque peu, les rouleaux se sont vu affublé d’une fine couche de Tamagoyaki (Omelette Japonaise). La couleur est attrayante et le mélange légèrement sucré qui compose l’omelette donne un goût très intéressant à cette variante du maki', 4, 'https://lh3.googleusercontent.com/proxy/cflW6ATVcCVn80KgLAICNw-wLq4zF5mu3S64va6i69kCTz-FMNNV8jXk4LfdtIC97TgmhiL9CQD7GSa4f5xqN2c5ppp8VDpad3kwp6a3AWL7WxlcmIZ_1Ik'),
(9, 'Egg Roll', 'Toujours dans un souci de plaire à tout le monde, et notamment aux personnes que la feuille d’algue Nori rebute quelque peu, les rouleaux se sont vu affublé d’une fine couche de Tamagoyaki (Omelette Japonaise). La couleur est attrayante et le mélange légèrement sucré qui compose l’omelette donne un goût très intéressant à cette variante du maki', 4, 'https://lh3.googleusercontent.com/proxy/cflW6ATVcCVn80KgLAICNw-wLq4zF5mu3S64va6i69kCTz-FMNNV8jXk4LfdtIC97TgmhiL9CQD7GSa4f5xqN2c5ppp8VDpad3kwp6a3AWL7WxlcmIZ_1Ik'),
(10, 'Chirashi', 'Il se compose la plupart du temps de : Sashimi de saumon et de thon finement tranchés, des œufs de saumon Ikura (ou de truite), des tranches de tamagoyaki, des crevettes, du concombre, de l\'avocat, le tout couché délicatement sur sur un lit de riz à sushi.', 16, 'https://facefoodmag.com/fotos/galerias/plato-otaku-1024x683.jpg'),
(11, 'Sashimi', 'Il s’agit tout simplement de tranches de poissons crus, généralement servies sur un lit de Daikon. La tranche de poisson cru est coupée plus épaisse que pour la préparation des Nigiri.', 4, 'https://www.sushishop.fr/product-6403-zoom/Sashimi-Saumon.png');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `role` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `nom`, `prenom`, `role`, `email`, `mot_de_passe`, `created_at`) VALUES
(2, 'Vitry', 'Bryan', 'logisticien', 'bryan@gmail.com', '$2y$10$c6QaiDslNqaIt9Hlx.G14uGjhX1u3dcxyJtEFqHWtU6zgi/x6B8.6', '2021-04-01 14:34:28'),
(3, 'admin', 'admin', 'administrateur', 'admin@gmail.com', '$2y$10$Q0siI3/S7ZghtYvl346MJO0Sl.hHT0m6Sojv9Zp86N5BwAW9IXvS6', '2021-04-01 14:49:51'),
(4, 'Louise', 'Johan', 'logisticien', 'johan@gmail.com', '$2y$10$OrOza83w2gOW9vxI4tWWcuGZEZgmCGCSq.5V3.Q9ZNyOMKaGyDS6W', '2021-04-01 15:52:32'),
(5, 'rassaby', 'fabien', 'logisticien', 'fabien@gmail.com', '$2y$10$8WMNeFOdNIenf7VGg1yovOIh1.PW0akpHYaofFLNV/Byzvik2okBK', '2021-04-05 10:27:33'),
(6, 'VICTORINE', 'Julien', 'administrateur', 'julien.victorine440@gmail.com', '$2y$10$LjYY5.EeTn2sGeC6IzjPYeL.XJlVQiOF9Rxd6RLXSKnV7qtdja2aC', '2021-04-06 13:09:36');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_utilisateur` (`id_utilisateur`),
  ADD KEY `id_sushi` (`id_sushi`),
  ADD KEY `id_ligne_commande` (`id_ligne_commande`);

--
-- Index pour la table `ligne_commande`
--
ALTER TABLE `ligne_commande`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `livraison`
--
ALTER TABLE `livraison`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_mode_livraison` (`id_mode_livraison`),
  ADD KEY `id_commande` (`id_commande`);

--
-- Index pour la table `mode_livraison`
--
ALTER TABLE `mode_livraison`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `mode_reglement`
--
ALTER TABLE `mode_reglement`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `panier`
--
ALTER TABLE `panier`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_mode_livraison` (`id_mode_livraison`),
  ADD KEY `id_mode_reglement` (`id_mode_reglement`);

--
-- Index pour la table `reglement`
--
ALTER TABLE `reglement`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_commande` (`id_commande`),
  ADD KEY `id_mode_reglement` (`id_mode_reglement`);

--
-- Index pour la table `sushis`
--
ALTER TABLE `sushis`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `ligne_commande`
--
ALTER TABLE `ligne_commande`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `livraison`
--
ALTER TABLE `livraison`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `mode_livraison`
--
ALTER TABLE `mode_livraison`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `mode_reglement`
--
ALTER TABLE `mode_reglement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `panier`
--
ALTER TABLE `panier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `reglement`
--
ALTER TABLE `reglement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `sushis`
--
ALTER TABLE `sushis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `panier`
--
ALTER TABLE `panier`
  ADD CONSTRAINT `panier_ibfk_1` FOREIGN KEY (`id_mode_livraison`) REFERENCES `mode_livraison` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `panier_ibfk_2` FOREIGN KEY (`id_mode_reglement`) REFERENCES `mode_reglement` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `reglement`
--
ALTER TABLE `reglement`
  ADD CONSTRAINT `reglement_ibfk_1` FOREIGN KEY (`id_commande`) REFERENCES `commande` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `reglement_ibfk_2` FOREIGN KEY (`id_mode_reglement`) REFERENCES `mode_reglement` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
