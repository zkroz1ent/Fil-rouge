-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 06 juil. 2023 à 14:48
-- Version du serveur : 10.4.21-MariaDB
-- Version de PHP : 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `fil-rouge`
--

--
-- Déchargement des données de la table `adherent`
--

INSERT INTO `adherent` (`id_adherent`, `adresse1`, `adresse2`, `adresse3`, `adresse4`, `Pays`, `num_telephone`, `id_utilisateur`) VALUES
(33, '22 rue des genets', 'BATIMENT E Appartement 70', '31500', 'Toulouse', 'France', '0695370215', 1),
(37, '23 Rue Paul Cézanne', '11200', 'Lézignan-Corbières', '', 'France', '0695370215', 2),
(38, '22 rue des Genêts', '31500', 'Toulouse', '', 'France', '07 82 00 72 84', 51);

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id_cat`, `lib_cat`, `lib_cat_fr`) VALUES
(1, 'Chair', 'Chaise'),
(2, 'Sofa', 'Canape'),
(3, 'Table', 'Table'),
(4, 'Dishwasher', 'Lave-vaisselle');

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`id_adherent`, `id_produit`, `nombre`, `date`, `statut_commande`, `ID_commande`) VALUES
(33, 2, 1, '2023-07-01', 1, 37),
(33, 25, 1, '2023-07-01', 1, 37),
(33, 3, 1, '2023-07-04', 1, 38),
(33, 21, 1, '2023-07-04', 1, 38),
(33, 38, 1, '2023-07-04', 1, 38),
(33, 32, 1, '2023-07-05', 1, 39),
(33, 26, 2, '2023-07-05', 1, 40),
(33, 33, 1, '2023-07-05', 1, 40),
(33, 1, 1, '2023-07-05', 1, 41),
(38, 3, 1, '2023-07-06', 1, 42),
(38, 21, 1, '2023-07-06', 1, 42),
(38, 6, 1, '2023-07-06', 1, 43),
(38, 10, 1, '2023-07-06', 1, 43);

--
-- Déchargement des données de la table `information_banquaire`
--

INSERT INTO `information_banquaire` (`id_banquaire`, `num`, `date_expiration`, `id_adherent`) VALUES
(36, '4990231562537845', '0000-00-00', 33),
(37, '4990562341528754', '0000-00-00', 38),
(38, '4990456321457984', '2026-06', 38);

--
-- Déchargement des données de la table `materiaux_fr`
--

INSERT INTO `materiaux_fr` (`id_mat_fr`, `lib_mat_fr`) VALUES
(1, 'bois'),
(2, 'metal'),
(3, 'tissu'),
(4, 'cuir'),
(5, 'plastique'),
(6, 'pierre');

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id_produit`, `lib_produit_fr`, `lib_produit`, `prix_produit`, `stock`, `description`, `description_fr`, `id_mat_fr`, `id_cat`, `alt`, `actif`, `prix_ttc`) VALUES
(1, 'Fauteuil Lounge Eames', 'Eames Lounge Chair', 1200, 6, 'Classique intemporel du design pour tout espace de vie moderne.', 'Classique intemporel du design pour tout espace de vie moderne.', 4, 1, 'meuble1.jpg', 1, 1435.2),
(2, 'Chaise Ghost', 'Ghost Chair', 150, 10, 'Transparent modern design for an elegant touch.', 'Design moderne transparent pour une touche élégante.', 5, 1, 'meuble2.jpg', 1, 179.4),
(3, 'Fauteuil Wingback', 'Wingback Chair', 450, 1, 'Classic design for comfort and style.', 'Design classique pour le confort et le style.', 3, 1, 'meuble3.jpg', 1, 538.2),
(4, 'Chaise Tulipe', 'Tulip Chair', 300, 7, 'Modern and sleek design with a pop of color.', 'Design moderne et élégant avec une touche de couleur.', 2, 1, 'meuble4.jpg', 1, 358.8),
(5, 'Fauteuil Barcelona', 'Barcelona Chair', 900, 2, 'Timeless luxury and comfort.', 'Luxe et confort intemporels.', 4, 1, 'meuble5.jpg', 1, 1076.4),
(6, 'Chaise Wishbone', 'Wishbone Chair', 250, 8, 'Danish design classic for warmth and natural beauty.', 'Classique du design danois pour la chaleur et la beauté naturelle.', 1, 1, 'meuble6.jpg', 1, 299),
(7, 'Chaise Panton', 'Panton Chair', 200, 8, 'Futuristic design for striking visual impact.', 'Conception futuriste pour un impact visuel saisissant.', 5, 1, 'meuble7.jpg', 1, 239.2),
(8, 'Chaise Papillon', 'Butterfly Chair', 100, 6, 'Lightweight and versatile design for indoor or outdoor use.', 'Conception légère et polyvalente pour une utilisation en intérieur ou en extérieur.', 3, 1, 'meuble8.jpg', 1, 119.6),
(9, 'Chaise Emeco Navy', 'Emeco Navy Chair', 350, 4, 'Durable and stylish design for industrial or modern spaces.', 'Design robuste et élégant pour les espaces industriels ou modernes.', 2, 1, 'meuble9.jpg', 1, 418.6),
(10, 'Chaise Aeron', 'Aeron Chair', 800, 0, 'Modern and ergonomic design for superior comfort and support.', 'Design moderne et ergonomique pour un confort et un soutien supérieurs.', 3, 1, 'meuble10.jpg', 1, 956.8),
(11, 'Canapé en tissu gris', 'Grey Fabric Sofa', 499.99, 5, 'A comfortable and elegant sofa in grey fabric', 'Un canapé confortable et élégant en tissu gris', 3, 2, 'meuble11.jpg', 1, 597.988),
(12, 'Canapé en cuir noir', 'Black Leather Sofa', 799.99, 3, 'A high-quality black leather sofa', 'Un canapé en cuir noir de haute qualité', 4, 2, 'meuble12.jpg', 1, 956.788),
(13, 'Canapé d\'angle en cuir blanc', 'White Leather Corner Sofa', 1299.99, 2, 'A spacious and elegant white leather corner sofa', 'Un canapé d\'angle spacieux et élégant en cuir blanc', 4, 2, 'meuble13.jpg', 1, 1554.79),
(14, 'Canapé convertible en tissu beige', 'Beige Fabric Convertible Sofa', 599.99, 4, 'A practical and comfortable convertible sofa in beige fabric', 'Un canapé convertible pratique et confortable en tissu beige', 3, 2, 'meuble14.jpg', 1, 717.588),
(15, 'Canapé en cuir marron', 'Brown Leather Sofa', 899.99, 3, 'A premium quality brown leather sofa', 'Un canapé en cuir marron de qualité supérieure', 4, 2, 'meuble15.jpg', 1, 1076.39),
(16, 'Canapé d\'angle en tissu bleu', 'Blue Fabric Corner Sofa', 1199.99, 2, 'A spacious and comfortable blue fabric corner sofa', 'Un canapé d\'angle spacieux et confortable en tissu bleu', 3, 2, 'meuble16.jpg', 1, 1435.19),
(17, 'Canapé 3 places en cuir noir', 'Black Leather 3-Seater Sofa', 699.99, 4, 'A high-quality black leather sofa that can seat 3 people', 'Un canapé en cuir noir de haute qualité pouvant accueillir 3 personnes', 4, 2, 'meuble17.jpg', 1, 837.188),
(18, 'Canapé 2 places en tissu rouge', 'Red Fabric 2-Seater Sofa', 399.99, 6, 'A comfortable and elegant red fabric sofa that can seat 2 people', 'Un canapé en tissu rouge confortable et élégant pouvant accueillir 2 personnes', 3, 2, 'meuble18.jpg', 1, 478.388),
(19, 'Canapé d\'angle convertible en cuir noir', 'Black Leather Convertible Corner Sofa', 1499.99, 1, 'A high-quality black leather convertible corner sofa', 'Un canapé d\'angle convertible en cuir noir de haute qualité', 4, 2, 'meuble19.jpg', 1, 1793.99),
(20, 'Canapé 3 places en tissu gris', 'Grey Fabric 3-Seater Sofa', 599.99, 5, 'A comfortable and elegant grey fabric sofa that can seat', 'Un canapé en tissu gris confortable et élégant pouvant accueillir 3 personnes', 3, 2, 'meuble20.jpg', 1, 717.588),
(21, 'Table basse en chêne', 'Oak coffee table', 199.99, 8, 'This beautiful coffee table is made of high-quality oak wood and features a modern design.', 'Cette belle table basse est fabriquée en chêne de haute qualité et présente un design moderne.', 1, 3, 'meuble21.jpg', 1, 239.188),
(22, 'Table à manger en verre', 'Glass dining table', 499.99, 5, 'This elegant dining table is made of tempered glass and is perfect for family dinners or hosting guests.', 'Cette élégante table à manger est en verre trempé et convient parfaitement aux dîners de famille ou à la réception d\'invités.', 1, 3, 'meuble22.jpg', 1, 597.988),
(23, 'Table de chevet en pin', 'Pine bedside table', 99.99, 15, 'This charming bedside table is made of durable pine wood and features a convenient drawer for storage.', 'Cette charmante table de chevet est en pin durable et comporte un tiroir pratique pour le rangement.', 1, 3, 'meuble23.jpg', 1, 119.588),
(24, 'Table de bureau en acier', 'Steel office table', 349.99, 8, 'This sturdy office table is made of high-quality steel and is perfect for a modern workspace.', 'Cette solide table de bureau est en acier de haute qualité et convient parfaitement à un espace de travail moderne.', 2, 3, 'meuble24.jpg', 1, 418.588),
(25, 'Table pliante en plastique', 'Folding plastic table', 79.99, 19, 'This practical folding table is made of durable plastic and is perfect for outdoor gatherings or events.', 'Cette table pliante pratique est en plastique durable et convient parfaitement aux rassemblements ou événements en extérieur.', 5, 3, 'meuble25.jpg', 1, 95.668),
(26, 'Table d\'appoint en marbre', 'Marble side table', 299.99, 6, 'This luxurious side table features a beautiful marble top and is perfect for adding a touch of elegance to any room.', 'Cette luxueuse table d\'appoint est dotée d\'un magnifique plateau en marbre et convient parfaitement pour ajouter une touche d\'élégance à n\'importe quelle pièce.', 6, 3, 'meuble26.jpg', 1, 358.788),
(27, 'Table de jardin en aluminium', 'Aluminum garden table', 249.99, 6, 'This stylish garden table is made of lightweight aluminum and is perfect for outdoor dining or relaxing.', 'Cette élégante table de jardin est en aluminium léger et convient parfaitement pour les repas ou la détente en extérieur.', 2, 3, 'meuble27.jpg', 1, 298.988),
(28, 'Table pliante en bois', 'Wooden folding table', 149.99, 12, 'This versatile folding table is made of sturdy wood and is perfect for picnics, camping, or any outdoor activity.', 'Cette table pliante polyvalente est en bois robuste et convient parfaitement aux pique-niques, camping ou toute activité en extérieur.', 1, 3, 'meuble28.jpg', 1, 179.388),
(29, 'Table d\'appoint en acier inoxydable', 'Stainless steel side table', 199.99, 9, 'This sleek side table is made of high-quality stainless steel and is perfect for a modern living room.', 'Cette élégante table d\'appoint est en acier inoxydable de haute qualité et convient parfaitement dans peu importe la pièce de votre maison', 2, 3, 'meuble29.jpg', 1, 239.188),
(30, 'Table de nuit en bois', 'Wooden Nightstand', 129.99, 14, 'This sturdy wooden nightstand is perfect for your bedroom.', 'Cette table de nuit en bois robuste est parfaite pour votre chambre.', 1, 3, 'meuble30.jpg', 1, 155.468),
(31, 'Pichasse', 'Bitch', 9.99, 50, 'This mood is characterized by a feeling of bitch.', 'Cette humeur se caractérise par une sensation de poser pour des photos instas.', 1, 4, 'meuble31.jpg', 1, 11.948),
(32, 'Pichasse 2.0', 'Bitch 2.0', 9.99, 29, 'This mood is characterized by a feeling of bitch.', 'Cette humeur se caractérise par une sensation de poser pour des photos instas.', 1, 4, 'meuble32.jpg', 1, 11.948),
(33, 'Colérique/Dadou', 'Angry/Dadou', 9.99, 19, 'This mood is characterized by a feeling of anger and frustration.', 'Cette humeur se caractérise par une sensation de colère et de frustration.', 1, 4, 'meuble33.jpg', 1, 11.948),
(34, 'Apaisée', 'Calm', 9.99, 40, 'This mood is characterized by a feeling of calmness and relaxation.', 'Cette humeur se caractérise par une sensation de calme et de relaxation.', 1, 4, 'meuble34.jpg', 1, 11.948),
(35, 'Cracra', 'Cracra', 9.99, 25, 'Cette humeur se caractérise par une sensation DE MANQUE DE DOUCHE CA PUE', 'Cette humeur se caractérise par une sensation d ennui et de désintérêt.This mood is characterized by a feeling of stinky poop', 1, 4, 'meuble35.jpg', 1, 11.948),
(36, 'Amoureuse', 'In Love', 9.99, 35, 'This mood is characterized by a feeling of love and passion.', 'Cette humeur se caractérise par une sensation d amour et de passion.', 1, 4, 'meuble36.jpg', 1, 11.948),
(37, 'Boudine/Connasse', 'Boudine/Connasse', 9.99, 15, 'This mood is characterized by a feeling of being lazy and connasse', 'Cette humeur se caractérise par une sensation de bouder et être connasse', 1, 4, 'meuble37.jpg', 1, 11.948),
(38, 'Princesse', 'Princess', 9.99, 9, 'This mood is characterized by a feeling of wealth and power.', 'Cette humeur se caractérise par une sensation de richesse et de grand pouvoir.', 1, 4, 'meuble38.jpg', 1, 11.948),
(39, 'Enthousiaste', 'Excited', 11, 45, 'This mood is characterized by a feeling of enthusiasm and excitement.', 'Cette humeur se caractérise par une sensation d enthousiasme et d excitation.', 1, 4, 'meuble39.jpg', 1, 13.156),
(40, 'Déprimée', 'Depressed', 10, 5, 'This mood is characterized by a feeling of depression and despair.', 'Cette humeur se caractérise par une sensation de dépression et de désespoir.', 1, 4, 'meuble40.jpg', 1, 11.96),
(41, 'Lave-vaisselle de fou', '', 5432, 85, '', 'Il nettoie tout grâce à son turbo.', 5, 4, 'turbo.jpg', 1, 6496.67);

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id_utilisateur`, `pseudo`, `mdp`, `mail`, `nom`, `prenom`, `role`) VALUES
(1, 'Damsdutertre', '$2y$10$6FaAxd3ekPKI23LdOxW/P.NbAgUGzRRSglkbyxMbIYrXCJ8Cu12Ry', 'chefkebabier31@gmail.com', 'BROTO', 'JULES', 0),
(2, 'Julbroto', '$2y$10$OB3ZaIP9sCy2Ko/yAoOnfOe5e5QntCdgKbTbDoqXUXmIHMnj7XIOi', 'damien.dutertre@limayrac.fr', 'Dutertre', 'Damien', 1),
(51, 'Marysabatier', '$2y$10$ivz41a0xNgTeXlmJoDM8meI8mmYkljZa/Dj4aNHkM6pV4QMKeucpW', 'marylia.sabatier@gmail.com', 'Sabatier', 'Marylia', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
