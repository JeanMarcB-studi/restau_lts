
INSERT INTO `user` (`id`, `email`, `roles`, `password`, `first_name`, `last_name`, `comment`, `phone`) VALUES
(1, 'admin@test.com', '[\"ROLE_ADMIN\"]', '$2y$13$9VkebWBtoyqC2OjSwG0.c.JbJa3JkdG8I4PbsrhdjVmie.oy6d6iq', 'Mi', 'Chang', 'chef Restaurateur', ''),


INSERT INTO `open_hour` (`id`, `week_day`, `lunch_start`, `lunch_end`, `lunch_max`, `dinner_start`, `dinner_end`, `dinner_max`, `day_num`) VALUES
(1, 'Lundi', '11:45:00', '14:00:00', 50, '19:00:00', '22:00:00', 40, 1),
(2, 'Mardi', '11:45:00', '14:00:00', 45, '19:00:00', '22:00:00', 45, 2),
(3, 'Mercredi', '11:45:00', '14:00:00', 45, '19:00:00', '22:00:00', 45, 3),
(4, 'Jeudi', '11:45:00', '14:00:00', 0, '19:00:00', '22:00:00', 0, 4),
(5, 'Vendredi', '12:00:00', '14:30:00', 0, '19:00:00', '22:00:00', 50, 5),
(6, 'Samedi', '12:00:00', '15:00:00', 60, '18:45:00', '23:00:00', 60, 6),
(7, 'Dimanche', '12:00:00', '15:00:00', 60, '18:45:00', '23:00:00', 60, 7);

INSERT INTO `menu` (`id`, `title`, `type`, `valid_when`, `detail`, `price`) VALUES
(1, 'le Menu du jour', NULL, 'En semaine', 'Entrée + plat + dessert', '45.00'),
(2, 'Menu enfants', NULL, 'En semaine, le midi', 'Entrée + plat + dessert (enfants jusqu\'à 12 ans)', '20.00'),
(3, 'Menu montagnard', NULL, 'Tous les jours', 'Purs produits de la montagne', '46.00'),
(4, 'Menu fraîcheur', NULL, 'En semaine uniquement', 'Des fruits et des légumes frais', '35.00'),
(5, 'Menu retour de marché', NULL, 'Le Vendredi', 'Nos produits en direct du marché', '48.00');

INSERT INTO `category` (`id`, `category_name`, `sub_category`, `range_num`) VALUES
(1, 'nos Entrées', 'Entrées froides', 10),
(2, 'nos Plats', 'Viande', 20),
(3, 'nos Desserts', NULL, 45),
(4, 'nos Boissons', 'Sans Alcool', 80),
(5, 'nos Mises en bouche', NULL, 0),
(6, 'nos Entrées', 'Entrées chaudes', 11),
(7, 'nos Boissons', 'Apéritifs', 90),
(8, 'nos Fondues', NULL, 40),
(9, 'nos Plats', 'Poisson', 24),
(10, 'nos Plats', 'Végétarien', 28),
(11, 'nos Spécialités', NULL, 52),
(12, 'nos Boissons', 'Boissons chaudes', 100),
(13, 'nos Boissons', 'Vin', 91);


INSERT INTO `meal` (`id`, `category_id`, `meal_name`, `description`, `price`) VALUES
(1, 6, 'Pizza du chef', 'Une délicieuse pizza aux agrumes', '24.00'),
(2, 6, 'Pizza montagnarde', 'Des lardons, mais pas que...', '18.00'),
(3, 5, 'Cacahouètes au Wasabi', 'Mélange très épicé', '4.50'),
(4, 1, 'Salade de concombres', 'Concombres de mer', '12.00'),
(5, 1, 'Méli-melo de tomates au gingembre', 'Rafraîchissant', '13.50'),
(6, 6, 'Poulpe au combawa', 'Délicieusement citronné', '19.00'),
(7, 6, 'Rôtis de banane', 'Finement cannelées', '16.00'),
(8, 2, 'Jambon à l\'étouffée', 'Cuit sur lit d\'algues', '26.00'),
(9, 2, 'Rôti de Dinde', 'Accompagné de noix du brésil', '26.00'),
(10, 2, 'Sanglier à la broche', 'Délicieux par Toutatis', '45.00'),
(11, 5, 'Espuma d\'asperges vertes', 'Un goût printanier', '5.00'),
(12, 5, 'Makis épinard, truite, fromage aux fines herbes', 'Notre mise en bouche signature', '5.50'),
(13, 1, 'Betterave au fromage de chèvre', 'Un délice de nos montagnes', '13.00'),
(14, 1, 'Rouleaux de printemps à la truite de nos montagnes', 'Entre Asie et Savoie', '16.00'),
(15, 9, 'Truite aux amandes', 'Savoureuse', '20.00'),
(16, 9, 'La Saint-Jacques poêlée aux morilles', 'Un réveil gustatif', '25.00'),
(17, 10, 'Lentilles Beluga aux légumes croquants de saison', 'Un plat végétarien plein de fraîcheur', '14.00'),
(18, 8, 'La véritable fondue de nos montagnes', 'Beaufort, comté et abondance dans votre assiette', '27.00'),
(19, 8, 'Fondue au chèvre miel et thym', 'Notre recette de fondue originale', '25.00'),
(20, 11, 'Omble chevalier à la fondue de poireaux', 'Notre poisson signature', '31.00'),
(21, 11, 'Mille-feuilles de truite et fenouil au fromage frais persillé', 'Notre entrée originale', '16.00'),
(22, 11, 'Trio de chocolat noir en mousse aux noisettes et amandes grillées', 'Une recette de chocolat unique', '12.00'),
(23, 3, 'Riz au lait à la cannelle', 'Saveur d\'enfance, réconfortante', '8.00'),
(24, 3, 'Salade de fruits exotiques frais avec sa madeleine moelleuse', 'Saveur d\'ailleurs, rafraîchissante', '9.00'),
(25, 3, 'Tarte tatin aux pommes et aux poires', 'Saveur d\'autrefois, revisitée', '11.00'),
(26, 12, 'Café', 'Servi comme vous le souhaitez:  expresso, allongé, avec un nuage de lait', '3.00'),
(27, 12, 'Thé', 'A choisir parmi notre sélection de thés noirs, verts, blancs', '4.00'),
(28, 12, 'Infusion', 'A choisir parmi notre sélection', '4.00'),
(29, 13, 'Vin rouge de Savoie', 'Au verre', '7.00'),
(30, 13, 'Vin rouge de Savoie', 'La bouteille', '21.00'),
(31, 13, 'Vin blanc de Savoie', 'Au verre', '8.00'),
(32, 13, 'Vin blanc de Savoie', 'La bouteille', '22.00'),
(33, 7, 'Kir', 'A la cerise et au vin blanc de notre région', '8.50'),
(34, 7, 'Spritz', 'Un petit voyage de l\'autre côté des Alpes', '10.00'),
(35, 7, 'Whisky', 'A choisir parmi notre sélection de whisky japonais', '14.50'),
(36, 4, 'Jus de fruits', 'Au choix: orange, ananas, pomme, pamplemousse, fraise, melon', '6.00'),
(37, 4, 'Eau plate', '50 cl', '4.00'),
(38, 4, 'Eau gazeuse', '50 cl', '4.00'),
(39, 4, 'Eau plate', '1l', '7.00'),
(40, 4, 'Eau gazeuse', '1l', '7.00');