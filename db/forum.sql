-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 01 nov. 2024 à 10:04
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `forum`
--

-- --------------------------------------------------------

--
-- Structure de la table `replies`
--

CREATE TABLE `replies` (
  `id` int(5) NOT NULL,
  `reply` varchar(255) NOT NULL,
  `user_id` int(5) NOT NULL,
  `topics_id` int(11) NOT NULL,
  `user_image` varchar(255) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `replies`
--

INSERT INTO `replies` (`id`, `reply`, `user_id`, `topics_id`, `user_image`, `create_at`) VALUES
(1, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Laudantium in voluptates saepe officia perferendis tenetur iure accusantium impedit obcaecati modi quae tempore, nostrum necessitatibus recusandae quis voluptatum libero reiciendis aliquam.', 1, 1, 'gravatar.png', '2024-08-29 08:31:44'),
(2, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Laudantium in voluptates saepe officia perferendis tenetur iure accusantium impedit obcaecati modi quae tempore, nostrum necessitatibus recusandae quis voluptatum libero reiciendis aliquam.', 1, 1, 'gravatar.png', '2024-11-01 08:31:37');

-- --------------------------------------------------------

--
-- Structure de la table `topics`
--

CREATE TABLE `topics` (
  `topics_id` int(11) NOT NULL,
  `user_name` varchar(200) NOT NULL,
  `title` varchar(200) NOT NULL,
  `category` varchar(200) NOT NULL,
  `body` text NOT NULL,
  `user_image` varchar(200) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `topics`
--

INSERT INTO `topics` (`topics_id`, `user_name`, `title`, `category`, `body`, `user_image`, `create_at`) VALUES
(1, 'nbv_v', 'aze', 'Development', 'aze', 'gravatar.jpg', '2024-08-26 09:29:29'),
(2, 'miloud', 'sec topic', 'SEO', 'sec topics ', 'gravatar.jpg', '2024-11-01 08:30:32'),
(3, 'miloud', 'thrd topics', 'Hosting', 'thrd topics', '', '2024-11-01 09:01:02');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(5) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` text NOT NULL,
  `about` text NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `username`, `password`, `about`, `avatar`, `created_at`) VALUES
(1, 'aze', 'aaze@gmail.com', 'aze', '$2y$10$F0I.7uWs3v5Il6a7.K4juO6D4rNmId6sQhHInflRNvw8.cjxahR8S', 'aze', 'gravatar.png', '2024-07-15 08:48:10'),
(4, 'miloud', 'qsd@gmail.com', 'miloud', '$2y$10$tkavG82LsLlNrNNJsQNVfeeU9kUPGxKeq6Q9.AEEwf4t/IWEAjYPa', 'qsd', 'gravatar.png', '2024-07-15 09:04:54'),
(5, 'aze', 'aze@email.com', 'aze', '$2y$10$m06nWkmCeIbFNPHdqh/oReWHZLsl5rQJXSXKaVjeM4PgA9XMzYgAy', 'aze', 'gravatar.png', '2024-07-20 03:37:50'),
(6, 'aaa', 'aaa@email.com', 'aaa', '$2y$10$B4AxAGkHCyb1JbBPtR3jO.0fhgo.OFtH41KP0OLwnQ3drVerTAXhm', 'aaa', 'gravatar.png', '2024-07-20 04:12:12'),
(7, 'nbv', 'nbv@email.com', 'nbv_v', '$2y$10$z72301qL6W7xNJUJlFRxkei3H1FHKnUpRcuTdI4MSqmr9Egdu3TeG', 'nothing', 'gravatar.jpg', '2024-08-26 09:29:07'),
(8, 'aaa', 'aaa@email.com', 'aaaa', '$2y$10$sSEapIF..zFz8KtXa3cyMOg/dzGnNVhl5Ep9iGBWQOdM3wwiT2DUS', 'aaa', 'gravatar.png', '2024-11-01 08:17:36'),
(9, 'miloud bendjedda', 'miloud@gmail.com', 'miloud', '$2y$10$sv/8JnxH987r7x9D8F7lTu76aPbWQm36lpxhI6JtbMVswsayzAAIK', 'aze', 'gravatar.jpg', '2024-11-01 08:20:26');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `replies`
--
ALTER TABLE `replies`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`topics_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `replies`
--
ALTER TABLE `replies`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `topics`
--
ALTER TABLE `topics`
  MODIFY `topics_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
