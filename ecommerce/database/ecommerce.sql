

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- base de données: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `marques` (
  `id_marque` int(100) NOT NULL,
  `titre_marque` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brands`
--

INSERT INTO `marques` (`id_marque`, `titre_marque`) VALUES
  (1, 'HP'),
  (2, 'Samsung'),
  (3, 'Apple'),
  (4, 'Sony'),
  (5, 'LG'),
  (6, 'Philips'),
  (7, 'Autres');

-- --------------------------------------------------------

--
-- structure de la table 'panier'
--

CREATE TABLE `panier`(
  `id` int(10) NOT NULL,
  `id_prod` int(10) NOT NULL,
  `ajout_ip` varchar(250) NOT NULL,
  `id_utilisateur` int(10) NOT NULL,
  `titre_produit` varchar(200) NOT NULL,
  `image_produit` varchar(200) NOT NULL,
  `quantite` int(10) NOT NULL,
  `prix` int(10) NOT NULL,
  `total` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- insertion dans la table 'panier'
--

INSERT INTO `panier` (`id`, `id_prod`, `ajout_ip`, `id_utilisateur`, `titre_produit`, `image_produit`, `quantite`, `prix`, `total`) VALUES
(1, 1, '0', 0, 'apple-ipad-9-7-2017-32gb-wifi-space-gray', 'apple-ipad-9-7-2017-32gb-wifi-space-gray.jpg', 1, 5000, 5000),
(2, 2, '0', 0, 'pc-portable-hp-stream-x360-11-y000nk-2go-tactile', 'pc-portable-hp-stream-x360-11-y000nk-2go-tactile.jpg', 1, 25000, 25000);

-- --------------------------------------------------------

--
-- structure de la table `categories`
--

CREATE TABLE `categories` (
  `id_cat` int(100) NOT NULL,
  `titre_cat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- insertion dans la table 'categories'
--

INSERT INTO `categories` (`id_cat`, `titre_cat`) VALUES
(1, 'smartphones'),
(2, 'electromenagers'),
(3, 'consoles'),
(4, 'Televisions'),
(5, 'objets connectes'),
(6, 'ordinateurs'),
(7, 'autres');

-- --------------------------------------------------------

--
-- structure de la table 'produits'
--

CREATE TABLE `produits` (
  `id_produit` int(100) NOT NULL,
  `cat_produit` int(100) NOT NULL,
  `marque_produit` int(100) NOT NULL,
  `titre_produit` varchar(255) NOT NULL,
  `prix_produit` int(100) NOT NULL,
  `desc_produit` text NOT NULL,
  `image_produit` text NOT NULL,
  `cle_produit` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- insertion de la table `produits`
--

INSERT INTO `produits` (`id_produit`, `cat_produit`, `marque_produit`, `titre_produit`,`prix_produit`, `desc_produit`, `image_produit`, `cle_produit`) VALUES
(1, 1, 3, 'Apple ipad', 400, 'apple ipad 32gb gray ', 'apple-ipad-9-7-2017-32gb-wifi-space-gray.jpg', 'apple telephone smartphone'),
(2, 1, 3, 'Apple iphone 6s', 600, 'apple iphone 6s gray ', 'apple-iphone-6s-comme-neuf.jpg', 'apple telephone smartphone'),
(3, 1, 3, 'Apple iphone X', 1329, 'apple iphone X black ', 'apple-iphone-x-256gb-space-grey.jpg', 'apple telephone smartphone'),
(4, 1, 3, 'Apple iphone 7 plus', 489.79, 'apple iphone 7 plus black ', 'Apple-iPhone-7-Plus-catches-on-fire-inches-from-sleeping-womans-head.jpg', 'apple telephone smartphone'),
(5, 1, 4, 'Sony xperia z2', 600, 'sony xperia z2 ', 'sony-tlphone-portable-sony-xperia-z2-android-phone_pas_cher.jpg', 'sony telephone smartphone'),
(6, 1, 4, 'Sony xperia e5', 400, 'sony xperia e5 ', 'sony-xperia-e5-debloque.jpg', 'sony telephone smartphone'),
(7, 1, 4, 'Sony xperia XZ premium', 315, 'sony xperia XZ premium', 'sony_xperia.jpg', 'sony telephone smartphone'),
(8, 1, 4, 'Sony', 400, 'sony mobile ', 'sony mobile.jpg', 'sony telephone smartphone'),
(9, 1, 5, 'LG K10', 284.07, 'LG K10 White', 'LG_K10.jpg', 'LG telephone smartphone'),
(10, 1, 5, 'LG X', 112.99, 'LG X Fast ', 'LG_X.jpg', 'lg telephone smartphone'),
(11, 1, 5, 'LG G5', 794.11, 'LG G5 (H850) ', 'LG_G5.jpg', 'lg telephone smartphone'),
(12, 1, 5, 'LG K580', 170, 'LG K580 Xcam', 'Smartphone_LG_K580.jpg', 'lg telephone smartphone'),
(13, 1, 5, 'LG V30', 899, 'LG V30 Bleu ', 'Smartphone_LG_V30.jpg', 'lg telephone smartphone'),
(14, 1, 2,'SAMSUNG Galaxy S6 32Go or',460.59,'SAMSUNG Galaxy S6 32Go','samsung_s6.jpg','samsung telephone smartphone'),
(15,1,2,'samsung galaxy s7 edge',855,'samsung galaxy s7 edge','samsung_s7.jpg','samsung telephone smartphone'),
(16,1,2,'samsung note 8',900,'samsung note 8','note8_64gb.jpg','samsung telephone smartphone'),
(17,1,2,'samsung j3',135.47,'samsung j3','Samsung_j3.jpg','samsung telephone smartphone'),
(18,6,1,'hp x360',2000,'hp x360 tactile','pc-portable-hp.jpg','ordinateur'),
(19,6,1,'hp 15',1500,'hp 15','pc-portable-hp-15.jpg','ordinateur'),
(20,6,1,'hp pc',1000,'hp pc','hp.jpg','ordinateur'),
(21,6,1,'hp elitebook',1300,'hp elitebook','hp-elitebook.jpg','ordinateur'),
(22,2,6,'philips',400,'philips','philips-dsr3031f.jpg','philips'),
(23,2,5,'Refrigerateur americain LG',1194.16,'refigerateur','Refrigerateur_LG.jpg','refrigerateur'),
(24,4,5,'TV LG OLED 65B7',3490,'TV LG OLED 65B7','TV_LG.jpg','television'),
(25,4,6,'TV philips',34800,'TV philips','televiseur-ecran-plat-philips-.jpg','television'),
(26,3,4,'Ps3',200,'sony console ps3','ps3.jpg','ps3'),
(27,3,4,'Ps4',399,'sony console ps4','ps4.jpg','ps4'),
(28,3,4,'PsP',90,'sony console psp','psp.jpg','psp'),
(29,3,7,'Xbonx one',380,'Microsoft console','xbox_one','xbox'),
(30,5,3,'Apple watch 2',300,'apple watch 2','Apple_watch_2.jpg','apple'),
(31,5,3,'Apple watch 3',482,'apple watch 3','Apple_watch_3.jpg','apple'),
(32,7,7,'enceinte',2000,'enceinte','enceinte.jpg','enceinte'),
(33,7,5,'projecteur LG',1349,'projecteur lg','Projecteur_LG.jpg','LG'),
(34,7,2,'Samsung Gear 360',290,'samsung gear 360','Samsung_Gear.jpg','samsung');
-- --------------------------------------------------------

--
-- structure de la table 'utilisateurs'
--

CREATE TABLE `utilisateurs` (
  `id_utilisateur` int(10) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `email` varchar(300) NOT NULL,
  `mot_de_passe` varchar(300) NOT NULL,
  `telephone` varchar(10) NOT NULL,
  `adresse1` varchar(300) NOT NULL,
  `adresse2` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- insertion de la table 'utilisateurs'
--

INSERT INTO `utilisateurs` (`id_utilisateur`, `prenom`, `nom`, `email`, `mot_de_passe`, `telephone`, `adresse1`, `adresse2`) VALUES
(1, 'ilias', 'souidi', 'ilias@gmal.com', '12345', '123456789', 'NY', 'new york'),
(2, 'ousti', 'ousmane', 'ousti@gmail.com', 'ousti', '45678', 'LA', 'Los Angoles'),
(3,'joe', 'jordy', 'joe@gmail.com', '246810', '666', 'boston', 'city');

--
-- index des clé étrangeres tables
--

--
-- Indexes de la table 'marques'
--
ALTER TABLE `marques`
  ADD PRIMARY KEY (`id_marque`);

--
-- Indexes de la table 'panier'
--
ALTER TABLE `panier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes de la table 'categories'
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id_cat`);

--
-- Indexes de la table 'produits'
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`id_produit`);

--
-- Indexes de la table 'utilisateurs'
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id_utilisateur`);

--
-- AUTO_INCREMENT des insertions des tables
--

--
-- AUTO_INCREMENT de la table 'marques'
--
ALTER TABLE `marques`
  MODIFY `id_marque` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la table 'panier'
--
ALTER TABLE `panier`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la table 'categories'
--
ALTER TABLE `categories`
  MODIFY `id_cat` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la table 'products'
--
ALTER TABLE `produits`
  MODIFY `id_produit` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT de la table 'utilisateur'
--
ALTER TABLE `utilisateurs`
  MODIFY `id_utilisateur` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
