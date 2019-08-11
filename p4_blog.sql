-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le :  Dim 11 août 2019 à 06:45
-- Version du serveur :  5.7.25
-- Version de PHP :  7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `p4_blog`
--

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `com_id` int(11) NOT NULL,
  `com_date` datetime NOT NULL,
  `com_auteur` varchar(100) NOT NULL,
  `com_contenu` varchar(500) NOT NULL,
  `com_signaler` tinyint(1) DEFAULT '0',
  `com_modere` tinyint(4) NOT NULL DEFAULT '0',
  `bil_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`com_id`, `com_date`, `com_auteur`, `com_contenu`, `com_signaler`, `com_modere`, `bil_id`) VALUES
(19, '2019-08-11 08:01:54', 'jm78', '<p>Excellent début d\'histoire avec une belle preuve d\'amour pour son enfant !</p>', 0, 0, 49),
(20, '2019-08-11 08:03:30', 'floflo56', '<p>Il me tarde la suite de l\'aventure. Bon courage Mr Forteroche !</p>', 0, 0, 49),
(21, '2019-08-11 08:05:46', 'coco45', '<p>Un peu ennuyeux, ce n\'est que le début de l\'histoire sans doute... J\'attends la suite avec impatience...</p>', 0, 0, 49),
(22, '2019-08-11 08:08:53', 'sophie12', '<p> Dommage qu\'il n\'y ait pas davantage de détails.</p>', 0, 0, 50),
(23, '2019-08-11 08:10:25', 'melissa21', '<p>Je suis tombée par hasard sur votre livre en surfant sur le net et je l\'ai commencé en me disant que ça me faisait de la lecture.<br />Je l\'ai commencé et là j\'ai été complètement séduite !                        </p>', 0, 0, 50),
(24, '2019-08-11 08:11:47', 'quentin66', '<p>Pour un livre gratuit, il est super. Vivement la version papier                        </p>', 0, 0, 51),
(25, '2019-08-11 08:12:55', 'GilbertB', '<p>Désolé je n\'aime pas du tout cet écrivain...                        </p>', 0, 0, 51),
(26, '2019-08-11 08:14:50', 'Florie78', '<p>Mr Forteroche, j\'adore vos livres, je les ai tous lus. Continuez à écrire et à poursuivre votre passion pour les voyages !</p>', 0, 0, 51),
(27, '2019-08-11 08:19:22', 'steven08', '<p>Beaucoup de suspenses. Vous savez interpeller vos lecteurs qui sont impatients de lire les prochains épisodes.</p>', 0, 0, 50);

-- --------------------------------------------------------

--
-- Structure de la table `groupes`
--

CREATE TABLE `groupes` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `groupes`
--

INSERT INTO `groupes` (`id`, `nom`) VALUES
(1, 'Administrateur'),
(2, 'Modérateur'),
(3, 'Membre');

-- --------------------------------------------------------

--
-- Structure de la table `logs`
--

CREATE TABLE `logs` (
  `log_id` int(10) NOT NULL,
  `com_id` int(11) NOT NULL,
  `com_date` datetime NOT NULL,
  `com_author` varchar(255) NOT NULL,
  `com_content` varchar(500) NOT NULL,
  `post_id` int(11) NOT NULL,
  `mod_type` enum('deleted','validated') DEFAULT NULL,
  `log_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `id_group` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `members`
--

INSERT INTO `members` (`id`, `name`, `pass`, `id_group`) VALUES
(12, 'jean.forteroche', '$argon2i$v=19$m=1024,t=2,p=2$bUl6eDl0RHMwbTBLaEVnYw$y2GMFBarWMX9depxs0+Kzc1khbdHflWQPCGteiwryeI', 1);

-- --------------------------------------------------------

--
-- Structure de la table `posts`
--

CREATE TABLE `posts` (
  `bil_id` int(11) NOT NULL,
  `bil_date` datetime NOT NULL,
  `bil_titre` varchar(100) NOT NULL,
  `bil_contenu` longtext NOT NULL,
  `auteur_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `posts`
--

INSERT INTO `posts` (`bil_id`, `bil_date`, `bil_titre`, `bil_contenu`, `auteur_id`) VALUES
(49, '2019-08-07 05:46:46', 'Chapitre : 1 - L’arrivée à Baie-Comeau ', '<p class=\"p1\"><span class=\"s1\">Ma chère petite Elodie,<br />Je griffonne ces quelques lignes sur le magnifique carnet que tu m’as offert avant mon départ. Tu ne les découvriras qu’à mon retour car nous ne pouvons communiquer dans le grand nord.<br />Malgré le froid et la rudesse de nos conditions de vie, je demeure résolument optimiste. Figure-toi que le célèbre explorateur Elott Schonfeld en personne est venu hier passer un moment avec moi. Quelle fière allure il avait avec sa chemise à carreaux et son bandana! Il nous a assuré le soutien inconditionnel des explorateurs. Ah, si tu pouvais me voir avec mon anorak, nul doute que tu me trouverais flamboyant et majestueux, bien loin du papa que tu connais et qui aimerait tant te couvrir de baisers.<br />Nous sommes installés à quelques dizaines de kilomètres de la fin de la route, près d’une ville nommée Baie Comeau. <br />Je dois te confesser que mon enthousiasme vacille parfois à l’écoute des récits des « anciens », qui ont connu le parc de Denali.<br />Il me tarde de te serrer dans mes bras, ceux d’un vainqueur, ma belle Elodie.<br />Ton papa<span class=\"Apple-converted-space\"> </span></span></p>', 12),
(50, '2019-08-09 14:48:20', 'Chapitre : 2 - La motoneige ', '<p class=\"p1\"><span class=\"s1\">La veille de mon vol pour Fairbanks, j’appelle mon vieil Ami Wilson, chasseur de la région de Healy, pour lui demander s’il serait prêt à m’aider pour accéder à Denali.<br />« Bien sûr Jean ! Tu as déjà conduit une motoneige ? […] »<br />L’aventure pouvait commencer.<br />A 7 heures du matin, je rencontre un couple sympathique Oliver et Allyson dans le petit aéroport international de Fairbanks, d’où ils acceptent de me conduire en direction de Healy dans un roadtrip de trois heures dans l’obscurité : la nuit est encore bien installée.<br />Ainsi arrivé, je retrouve avec joies et bonheurs Wilson en excellente forme. « Je peux t’offrir un café ? », dit-il. Cette phrase résonne en moi avec bonheur. La caféine me réveille avant le soleil ; je peux désormais m’assurer que la voiture est en bonne posture en dépit de l’état de la route gelée en épaisseur et de la présence régulière d’élans .<br />« Tu vois cette forêt là-bas ? » dit mon ami. Il me montre une énorme masse d’arbres sur une colline.<br />« Nous allons traverser la forêt puis franchir un lac gelé, et avancer encore. C’est parti ! »<span class=\"Apple-converted-space\"> </span></span></p>', 12),
(51, '2019-08-11 07:49:13', 'Chapitre : 3 - Le nombre 142, les deux lits, la valise... ', '<p class=\"p2\"><span class=\"s1\"> Il est 10h30 quand je me précipite sur ma motoneige. Je dois me dépêcher si je veux atteindre le bus avant que le soleil n’ait son prochain rendez-vous avec la lune, prévu pour 15h30.<br />Après quatre heures de conduite dans les magnifiques étendues polaires de l’Alaska, je n’ai toujours pas vu une seule personne, si ce n’est, au loin, la minuscule silhouette de Wilson. Tout au long du chemin.<br />Sur place, mon camarade me laisse seul pendant une heure et demie dans l’intimité de mes pensées. Il part plus loin pour couper du bois.<br />Je peux enfin vivre et ressentir au présent ce que mon père vécut et ressentit il y a vingt-deux ans. Je photographie tous les détails que j’avais pu voir sur d’anciennes photos : le nombre 142, la chaise à l’extérieur, les deux lits, la valise...<br />« Dans la vie, le plus important n’est pas nécessairement d’être fort, mais de se sentir fort, et de se mettre à l’effort au moins une fois, de se retrouver au moins une fois dans la condition humaine la plus archaïque. Affronter seul la nature aveugle et sourde sans rien pour vous aider ; si ce n’est vos mains et votre tête ... »<span class=\"Apple-converted-space\"> </span></span></p>', 12);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`com_id`);

--
-- Index pour la table `groupes`
--
ALTER TABLE `groupes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`log_id`);

--
-- Index pour la table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`bil_id`) USING BTREE,
  ADD KEY `auteur_id` (`auteur_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `com_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT pour la table `groupes`
--
ALTER TABLE `groupes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `logs`
--
ALTER TABLE `logs`
  MODIFY `log_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT pour la table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `posts`
--
ALTER TABLE `posts`
  MODIFY `bil_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`auteur_id`) REFERENCES `members` (`id`);
