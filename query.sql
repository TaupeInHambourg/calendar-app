INSERT INTO grade (name, description, created_at, created_by)
VALUES
('B1', 'Bachelor première année', NOW(), 'admin'),
('B2', 'Bachelor deuxième année', NOW(), 'admin'),
('B3', 'Bachelor troisième année', NOW(), 'admin'),
('M1', 'Master première année', NOW(), 'admin'),
('M2', 'Master deuxième année', NOW(), 'admin'),
('BTS1', 'BTS première année', NOW(), 'admin'),
('BTS2', 'BTS deuxième année', NOW(), 'admin');

INSERT INTO class (id_grade, nom, description, created_at, created_by)
VALUES (1, 'Cycle Web et Multimédia', 'Bachelor Cycle Web et Multimédia 1', NOW(), 'admin'),
(2, 'Cycle Web et Multimédia', 'Bachelor Cycle Web et Multimédia 2', NOW(), 'admin'),
(3, 'Digital', "A l’issue de son cursus en Bachelor Digital, l’étudiant devient le premier maillon de la chaîne de la digitalisation au sein de son organisation : il est en capacité de suggérer et d’accompagner l’intégration d’outils numériques, de les utiliser à des fins marketing ou commerciale et de sensibiliser ses collaborateurs aux bonnes pratiques du web.", NOW(), 'admin'),
(3, 'Webmarketing & Social Media', "A l’issue de son cursus en Bachelor Webmarketing & Social media, l’étudiant est en capacité de réaliser et de coordonner les actions de marketing digital pour son organisation. Ce programme de formation a été conçu pour répondre au besoin des entreprises concernant le web et les opportunités de croissance qu’il offre. Cela se traduit par des compétences approfondies en marketing digital et ses différents leviers, ainsi qu’en  production de contenus.", NOW(), 'admin'),
(3, 'Webdesign', "A l’issue de son cursus en Bachelor Webdesign, l’apprenant est en capacité d’analyser les besoins du client. Il est capable d’élaborer le concept graphique et l’expérience utilisateur du produit web en tenant compte de  la demande et de l’univers graphique. Il est en mesure de réaliser l’intégration web de ce produit à l’aide des technologies adaptées, et en coordonnant les interventions de l’équipe de collaborateurs et de prestataires en fonction des besoins en compétences complémentaires : équipes marketing et éditoriales, professionnels de l’image, développeurs…", NOW(), 'admin'),
(3, 'Création Numérique', "A l’issue de son cursus en Bachelor Création Numérique, l’apprenant est en capacité de répondre à un projet de communication visuelle et à le gérer dans son ensemble. Le designer graphique apporte des solutions concrètes aux besoins en communication visuelle orientée supports numériques à travers 3 grandes phases : Analyse de la demande, Conception graphique menée par une méthodologie de projet de design, et Production graphique.", NOW(), 'admin'),
(3, 'E-Commerce', "A l’issue de son cursus en Bachelor E-commerce, l’étudiant est capable de réaliser et de coordonner les actions marketing pour proposer une offre cohérente de produits par rapport à son environnement concurrentiel, de maîtriser les interactions avec ses clients et prospects sur les réseaux sociaux, d’utiliser les outils adéquats pour la gestion d’un site e-commerce, y compris dans des aspects pratiques comme la prise  de vues des produits, et de réajuster l’offre et les campagnes publicitaires afin d’obtenir de meilleurs  résultats.", NOW(), 'admin'),
(3, 'Développeur Web', "Véritable moteur de la création, le Développeur web est le garant du bon fonctionnement technique du projet, de sa pérennité mais également force de proposition pour traduire les besoins clients en solutions techniques.", NOW(), 'admin'),
(3, 'Cybersécurité et Administrateur Réseau', "Le parcours du Bachelor en Cybersécurité et administrateur réseaux positionne l'étudiant en tant que pionnier de la transformation numérique au sein de toute organisation. Doté de compétences de pointe, il devient l'élément clé de la sécurité des données de son entreprise. Il est prêt à relever les défis de la cyberdéfense et de la gestion d'infrastructures réseau, tout en contribuant de manière significative au succès numérique de son entreprise.", NOW(), 'admin'),
(4, 'Chief Digital Officer', "La formation CDO développe les compétences essentielles pour diriger la transformation numérique d'une entreprise. Elle permet d'acquérir une compréhension approfondie des technologies émergentes, des stratégies numériques et de la gestion du changement. En suivant cette formation, les professionnels peuvent renforcer leur employabilité et répondre à la demande croissante de spécialistes de la transformation numérique sur le marché de l'emploi.", NOW(), 'admin'),
(4, 'Expert Marketing Digital', "En deux ans, vous accéderez à des métiers tels que chef de projet web, spécialiste en marketing digital, responsable de la stratégie digitale, expert en référencement SEO/SEM, et bien d'autres. La demande croissante en professionnels qualifiés dans le domaine est indéniable. ", NOW(), 'admin'),
(4, 'Expert UI/UX Design', "La formation vous permet de vous spécialiser dans le domaine de l'UX UI Design en vous fournissant les connaissances et les compétences nécessaires pour devenir un professionnel hautement qualifié. Vous aurez l'occasion d'approfondir vos connaissances en matière de conception d'expérience utilisateur et d'interface utilisateur, en vous concentrant sur des aspects spécifiques tels que la conception mobile, la conception d'applications web ou la conception d'e-commerce.", NOW(), 'admin'),
(4, 'Direction Artistique Digitale', "La formation MBA vous enseigne l'utilisation des différents outils pour répondre aux attentes créatives des entreprises. Vous apprenez également quelles sont les tendances graphiques actuelles afin de pouvoir les réaliser et vous projeter sur les tendances futures. Pour répondre aux exigences des recruteurs, votre formation aborde un volet pratique plutôt que théorique.", NOW(), 'admin'),
(4, 'Entrepreunariat et Digital Business', "La formation Entrepreneuriat et Digital Business développe les compétences essentielles pour diriger le développement d'une entreprise. Elle permet d'acquérir une compréhension approfondie des technologies émergentes, des stratégies numériques et de la gestion du changement. En suivant cette formation, les professionnels peuvent renforcer leur employabilité et répondre à la demande croissante de spécialistes de la transformation numérique sur le marché de l'emploi.", NOW(), 'admin'),
(4, 'Big Data & Intelligence Artificielle', "La formation MBA vous permet de vous spécialiser dans le traitement et l'utilisation de la donnée dans un intérêt stratégique et décisionnel.. Afin de répondre à toutes les exigences des recruteurs, votre formation ne traite pas uniquement la théorie.", NOW(), 'admin'),
(4, 'Développeur Full-Stack', "La formation vous permet de vous spécialiser dans le développement de site web et d'applications. Afin de répondre à toutes les exigences des recruteurs, votre formation ne traite pas uniquement la théorie. MyDigitalSchool vous professionnalise avec de la pratique et de la préparation réels aux métiers du développement.", NOW(), 'admin'),
(4, 'Cybersécurité et Architecture Réseau', "La formation MBA Cybersécurité et Architecture réseaux développe une expertise multidisciplinaire essentielle pour sécuriser les infrastructures numériques des entreprises. Les étudiants acquièrent une compréhension approfondie des concepts de sécurité informatique, des stratégies de défense contre les cybermenaces et des meilleures pratiques de protection des données sensibles.", NOW(), 'admin'),
(5, 'Chief Digital Officer', "La formation CDO développe les compétences essentielles pour diriger la transformation numérique d'une entreprise. Elle permet d'acquérir une compréhension approfondie des technologies émergentes, des stratégies numériques et de la gestion du changement. En suivant cette formation, les professionnels peuvent renforcer leur employabilité et répondre à la demande croissante de spécialistes de la transformation numérique sur le marché de l'emploi.", NOW(), 'admin'),
(5, 'Expert Marketing Digital', "En deux ans, vous accéderez à des métiers tels que chef de projet web, spécialiste en marketing digital, responsable de la stratégie digitale, expert en référencement SEO/SEM, et bien d'autres. La demande croissante en professionnels qualifiés dans le domaine est indéniable. ", NOW(), 'admin'),
(5, 'Expert UI/UX Design', "La formation vous permet de vous spécialiser dans le domaine de l'UX UI Design en vous fournissant les connaissances et les compétences nécessaires pour devenir un professionnel hautement qualifié. Vous aurez l'occasion d'approfondir vos connaissances en matière de conception d'expérience utilisateur et d'interface utilisateur, en vous concentrant sur des aspects spécifiques tels que la conception mobile, la conception d'applications web ou la conception d'e-commerce.", NOW(), 'admin'),
(5, 'Direction Artistique Digitale', "La formation MBA vous enseigne l'utilisation des différents outils pour répondre aux attentes créatives des entreprises. Vous apprenez également quelles sont les tendances graphiques actuelles afin de pouvoir les réaliser et vous projeter sur les tendances futures. Pour répondre aux exigences des recruteurs, votre formation aborde un volet pratique plutôt que théorique.", NOW(), 'admin'),
(5, 'Entrepreunariat et Digital Business', "La formation Entrepreneuriat et Digital Business développe les compétences essentielles pour diriger le développement d'une entreprise. Elle permet d'acquérir une compréhension approfondie des technologies émergentes, des stratégies numériques et de la gestion du changement. En suivant cette formation, les professionnels peuvent renforcer leur employabilité et répondre à la demande croissante de spécialistes de la transformation numérique sur le marché de l'emploi.", NOW(), 'admin'),
(5, 'Big Data & Intelligence Artificielle', "La formation MBA vous permet de vous spécialiser dans le traitement et l'utilisation de la donnée dans un intérêt stratégique et décisionnel.. Afin de répondre à toutes les exigences des recruteurs, votre formation ne traite pas uniquement la théorie.", NOW(), 'admin'),
(5, 'Développeur Full-Stack', "La formation vous permet de vous spécialiser dans le développement de site web et d'applications. Afin de répondre à toutes les exigences des recruteurs, votre formation ne traite pas uniquement la théorie. MyDigitalSchool vous professionnalise avec de la pratique et de la préparation réels aux métiers du développement.", NOW(), 'admin'),
(5, 'Cybersécurité et Architecture Réseau', "La formation MBA Cybersécurité et Architecture réseaux développe une expertise multidisciplinaire essentielle pour sécuriser les infrastructures numériques des entreprises. Les étudiants acquièrent une compréhension approfondie des concepts de sécurité informatique, des stratégies de défense contre les cybermenaces et des meilleures pratiques de protection des données sensibles.", NOW(), "admin"),
(6, 'Services Informatiques aux Organisation', "À l’issue de ton cursus en BTS SIO, tu es capable de gérer de A à Z les problèmes techniques de l’informatique grâce à ton esprit analytique. Le BTS SIO te forme pour répondre aux besoins d’optimisation et de sécurisation des entreprises à travers trois grandes phases : Gestion de réseaux, Support aux utilisateurs, Développement d’applications. Tu acquerras des compétences en administration systèmes et réseaux, programmation, gestion de projet, bases de données ou encore culture digitale.", NOW(), 'admin'),
(7, 'Services Informatiques aux Organisation', "À l’issue de ton cursus en BTS SIO, tu es capable de gérer de A à Z les problèmes techniques de l’informatique grâce à ton esprit analytique. Le BTS SIO te forme pour répondre aux besoins d’optimisation et de sécurisation des entreprises à travers trois grandes phases : Gestion de réseaux, Support aux utilisateurs, Développement d’applications. Tu acquerras des compétences en administration systèmes et réseaux, programmation, gestion de projet, bases de données ou encore culture digitale.", NOW(), 'admin');

INSERT INTO session (name, description, is_active, created_at, created_by)
VALUES
('2021-2022', 'Promotion 2021-2022', FALSE, NOW(), 'admin'),
('2022-2023', 'Promotion 2022-2023', FALSE, NOW(), 'admin'),
('2023-2024', 'Promotion 2023-2024', TRUE, NOW(), 'admin'),
('2024-2025', 'Promotion 2024-2025', FALSE, NOW(), 'admin'),
('2025-2026', 'Promotion 2025-2026', FALSE, NOW(), 'admin');

INSERT INTO module (id_class, id_session, nom, duration, color, is_option, created_at, created_by)
VALUES
(8, 3, 'Conception logicielle', 14, '#ADE1D0', FALSE, NOW(), 'admin'),
(8, 3, 'Versionnage & inté. continue', 21, '#BFEAD9', FALSE, NOW(), 'admin'),
(8, 3, 'Ergo. & framework CSS', 14, '#C7F0D3', FALSE, NOW(), 'admin'),
(8, 3, 'Conteneurisation', 14, '#D2F7DC', FALSE, NOW(), 'admin'),
(8, 3, 'Qualité logicielle & tests', 21, '#E3FADC', FALSE, NOW(), 'admin'),
(8, 3, 'Secure Programming', 14, '#CDF5E5', FALSE, NOW(), 'admin'),
(8, 3, 'Infrastructure', 14, '#A7E4C8', FALSE, NOW(), 'admin'),
(8, 3, 'Algo. avancé & revue code', 21, '#BBEED5', FALSE, NOW(), 'admin'),
(8, 3, 'Dev. SQL & NoSQL', 42, '#99DCC0', FALSE, NOW(), 'admin'),
(8, 3, 'Dev. API', 42, '#83D3B5', FALSE, NOW(), 'admin'),
(8, 3, 'Framework PHP', 35, '#A9E4CB', FALSE, NOW(), 'admin'),
(8, 3, 'Application web', 35, '#8CD8BE', FALSE, NOW(), 'admin'),
(8, 3, 'Application mobile', 35, '#92DBC2', FALSE, NOW(), 'admin'),
(8, 3, 'Gestion de projet', 21, '#ADE4CF', FALSE, NOW(), 'admin'),
(8, 3, 'Rentrée', 7, '#B7E9D4', FALSE, NOW(), 'admin'),
(8, 3, 'WS - Crazy dev', 24.5, '#C3F0DC', FALSE, NOW(), 'admin'),
(8, 3, 'Forum inter-filières', 3.5, '#D1F4E4', FALSE, NOW(), 'admin'),
(8, 3, 'English Game', 35, '#A3DEC6', FALSE, NOW(), 'admin'),
(8, 3, 'MDP', 63, '#91D8BE', FALSE, NOW(), 'admin'),
(8, 3, 'Expérience pro.', 28, '#B1E5D1', FALSE, NOW(), 'admin'),
(8, 3, 'Anglais', 14, '#9CDAC1', FALSE, NOW(), 'admin'),
(8, 3, 'Préparation TOIC', 7, '#8ED7BB', FALSE, NOW(), 'admin');

INSERT INTO teacher (lastname, firstname, email, description, created_at, created_by)
VALUES
('Chandelier', 'Barbara', NULL, 'Responsible for multiple modules', NOW(), 'admin'),
('El Maknati', 'Abdellatif', NULL, 'Quality and Integration Specialist', NOW(), 'admin'),
('El Maknati', 'Ahmed', NULL, 'Software and Database Specialist', NOW(), 'admin'),
('Henry', 'Guillaume', NULL, 'Algorithm and Framework Expert', NOW(), 'admin'),
('Hermelin', 'Philippe', 'philippe.hermelin@eduservices.org', 'English Specialist', NOW(), 'admin'),
('Marionneau', 'Julien', NULL, 'English Game Instructor', NOW(), 'admin'),
('Rubeaud', 'Maud', NULL, 'Digital Project Supervisor', NOW(), 'admin'),
('Schumacher', 'Paul', 'paul.schuhmacher.ext@eduservices.org', 'API and PHP Development Specialist', NOW(), 'admin'),
('Sergent', 'Marius', 'marius.sergent.ext@eduservices.org', 'Mobile and Web Application Specialist', NOW(), 'admin'),
('Thaury', 'Anne', NULL, 'Project Management Supervisor', NOW(), 'admin'),
('Trancart', 'Carole', NULL, 'Digital Project Supervisor', NOW(), 'admin');

INSERT INTO module_teacher (id_teacher, id_module)
VALUES
(1, 8),
(1, 18),
(1, 19),
(2, 5),
(2, 4),
(3, 1),
(3, 9),
(3, 10),
(3, 6),
(4, 11),
(4, 12),
(5, 20),
(5, 21),
(6, 19),
(7, 14),
(7, 15),
(8, 10),
(8, 11),
(9, 12),
(9, 13),
(9, 16);

INSERT INTO lesson (id, id_module, description, is_hp, date_start, date_end, created_at, created_by)
VALUES
-- Module 1 (Conception logicielle, exemple avec 6 journées de cours)
(1, 1, 'Conception logicielle', TRUE, '2025-04-15 08:30:00', '2025-04-15 12:30:00', NOW(), 'admin'),
(2, 1, 'Conception logicielle', TRUE, '2025-04-15 13:30:00', '2025-04-15 16:30:00', NOW(), 'admin'),
(3, 1, 'Conception logicielle', TRUE, '2025-04-16 08:30:00', '2025-04-16 12:30:00', NOW(), 'admin'),
(4, 1, 'Conception logicielle', TRUE, '2025-04-16 13:30:00', '2025-04-16 16:30:00', NOW(), 'admin'),
(5, 1, 'Conception logicielle', TRUE, '2025-04-17 08:30:00', '2025-04-17 12:30:00', NOW(), 'admin'),
(6, 1, 'Conception logicielle', TRUE, '2025-04-17 13:30:00', '2025-04-17 16:30:00', NOW(), 'admin'),
-- Module 2 (Versionnage & inté. continue, exemple avec 3 sessions)
(7, 2, 'Versionnage & inté. continue', TRUE, '2025-04-18 08:30:00', '2025-04-18 12:30:00', NOW(), 'admin'),
(8, 2, 'Versionnage & inté. continue', TRUE, '2025-04-18 13:30:00', '2025-04-18 16:30:00', NOW(), 'admin'),
(9, 2, 'Versionnage & inté. continue', TRUE, '2025-04-19 08:30:00', '2025-04-19 12:30:00', NOW(), 'admin'),
-- Module 3 (Ergo. & framework CSS, exemple avec 4 sessions)
(10, 3, 'Ergo. & framework CSS', TRUE, '2025-04-20 08:30:00', '2025-04-20 12:30:00', NOW(), 'admin'),
(11, 3, 'Ergo. & framework CSS', TRUE, '2025-04-20 13:30:00', '2025-04-20 16:30:00', NOW(), 'admin'),
(12, 3, 'Ergo. & framework CSS', TRUE, '2025-04-21 08:30:00', '2025-04-21 12:30:00', NOW(), 'admin'),
(13, 3, 'Ergo. & framework CSS', TRUE, '2025-04-21 13:30:00', '2025-04-21 16:30:00', NOW(), 'admin'),
-- Module 4 (Conteneurisation, exemple avec 2 sessions)
(14, 4, 'Conteneurisation', TRUE, '2025-04-22 08:30:00', '2025-04-22 12:30:00', NOW(), 'admin'),
(15, 4, 'Conteneurisation', TRUE, '2025-04-22 13:30:00', '2025-04-22 17:30:00', NOW(), 'admin'),
-- Module 5 (Qualité logicielle & tests, exemple avec 12 sessions)
(16, 5, 'Qualité logicielle & tests', TRUE, '2025-04-23 08:30:00', '2025-04-23 12:30:00', NOW(), 'admin'),
(17, 5, 'Qualité logicielle & tests', TRUE, '2025-04-23 13:30:00', '2025-04-23 16:30:00', NOW(), 'admin'),
(18, 5, 'Qualité logicielle & tests', TRUE, '2025-04-24 08:30:00', '2025-04-24 12:30:00', NOW(), 'admin'),
(19, 5, 'Qualité logicielle & tests', TRUE, '2025-04-24 13:30:00', '2025-04-24 16:30:00', NOW(), 'admin'),
(20, 5, 'Qualité logicielle & tests', TRUE, '2025-04-25 08:30:00', '2025-04-25 12:30:00', NOW(), 'admin'),
(21, 5, 'Qualité logicielle & tests', TRUE, '2025-04-25 13:30:00', '2025-04-25 16:30:00', NOW(), 'admin'),
(22, 5, 'Qualité logicielle & tests', TRUE, '2025-04-26 08:30:00', '2025-04-26 12:30:00', NOW(), 'admin'),
(23, 5, 'Qualité logicielle & tests', TRUE, '2025-04-26 13:30:00', '2025-04-26 16:30:00', NOW(), 'admin'),
(24, 5, 'Qualité logicielle & tests', TRUE, '2025-04-27 08:30:00', '2025-04-27 12:30:00', NOW(), 'admin'),
(25, 5, 'Qualité logicielle & tests', TRUE, '2025-04-27 13:30:00', '2025-04-27 16:30:00', NOW(), 'admin'),
(26, 5, 'Qualité logicielle & tests', TRUE, '2025-04-28 08:30:00', '2025-04-28 12:30:00', NOW(), 'admin'),
(27, 5, 'Qualité logicielle & tests', TRUE, '2025-04-28 13:30:00', '2025-04-28 16:30:00', NOW(), 'admin'),
-- Module 7 (Infrastructure, journée partagée avec un autre module l'après-midi)
(28, 7, 'Infrastructure', TRUE, '2025-04-29 08:30:00', '2025-04-29 12:30:00', NOW(), 'admin'),
-- Module 8 (Algo. avancé & revue code, après-midi partagé avec le module 7)
(29, 8, 'Algo. avancé & revue code', TRUE, '2025-04-29 13:30:00', '2025-04-29 16:30:00', NOW(), 'admin'),
-- Module 9 (Dev. SQL & NoSQL, cours uniquement le matin)
(30, 9, 'Dev. SQL & NoSQL', TRUE, '2025-04-30 08:30:00', '2025-04-30 12:30:00', NOW(), 'admin'),
-- Module 10 (Dev. API, cours uniquement l'après-midi)
(31, 10, 'Dev. API', TRUE, '2025-04-31 13:30:00', '2025-04-31 16:30:00', NOW(), 'admin'),
-- Module 11 (Framework PHP, exemple avec 8 sessions)
(32, 11, 'Framework PHP', TRUE, '2025-05-04 08:30:00', '2025-05-04 12:30:00', NOW(), 'admin'),
(33, 11, 'Framework PHP', TRUE, '2025-05-04 13:30:00', '2025-05-04 16:30:00', NOW(), 'admin'),
(34, 11, 'Framework PHP', TRUE, '2025-05-05 08:30:00', '2025-05-05 12:30:00', NOW(), 'admin'),
(35, 11, 'Framework PHP', TRUE, '2025-05-05 13:30:00', '2025-05-05 16:30:00', NOW(), 'admin'),
(36, 11, 'Framework PHP', TRUE, '2025-05-03 08:30:00', '2025-05-03 12:30:00', NOW(), 'admin'),
(37, 11, 'Framework PHP', TRUE, '2025-05-03 13:30:00', '2025-05-03 16:30:00', NOW(), 'admin'),
(38, 11, 'Framework PHP', TRUE, '2025-05-04 08:30:00', '2025-05-04 12:30:00', NOW(), 'admin'),
(39, 11, 'Framework PHP', TRUE, '2025-05-04 13:30:00', '2025-05-04 16:30:00', NOW(), 'admin'),
-- Module 13 (Application mobile, journée complète)
(40, 13, 'Application mobile', TRUE, '2025-05-05 08:30:00', '2025-05-05 12:30:00', NOW(), 'admin'),
(41, 13, 'Application mobile', TRUE, '2025-05-05 13:30:00', '2025-05-05 16:30:00', NOW(), 'admin'),
-- Module 14 (Gestion de projet, cours d'une demi-journée le matin)
(42, 14, 'Gestion de projet', TRUE, '2025-05-06 08:30:00', '2025-05-06 12:30:00', NOW(), 'admin'),
-- Module 15 (Rentrée, journée complète avec "is_hp" à TRUE)
(43, 15, 'Rentrée', TRUE, '2025-05-07 08:30:00', '2025-05-07 12:30:00', NOW(), 'admin'),
(44, 15, 'Rentrée', TRUE, '2025-05-07 13:30:00', '2025-05-07 16:30:00', NOW(), 'admin'),
-- Module 16 (WS - Crazy dev, cours d'une demi-journée l'après-midi)
(45, 16, 'WS - Crazy dev', TRUE, '2025-05-08 13:30:00', '2025-05-08 16:30:00', NOW(), 'admin'),
-- Module 17 (Forum inter-filières, cours uniquement le matin)
(46, 17, 'Forum inter-filières', TRUE, '2025-05-09 08:30:00', '2025-05-09 12:30:00', NOW(), 'admin'),
-- Module 18 (English Game, journée complète)
(47, 18, 'English Game', TRUE, '2025-05-10 08:30:00', '2025-05-10 12:30:00', NOW(), 'admin'),
(48, 18, 'English Game', TRUE, '2025-05-10 13:30:00', '2025-05-10 16:30:00', NOW(), 'admin'),
-- Module 19 (MDP, cours d'une demi-journée le matin)
(49, 19, 'MDP', TRUE, '2025-05-11 08:30:00', '2025-05-11 12:30:00', NOW(), 'admin'),
-- Module 20 (Expérience pro., journée partagée avec un autre module l'après-midi)
(50, 20, 'Expérience pro.', TRUE, '2025-05-12 08:30:00', '2025-05-12 12:30:00', NOW(), 'admin'),
(51, 20, 'Expérience pro.', TRUE, '2025-05-12 13:30:00', '2025-05-12 16:30:00', NOW(), 'admin'),
-- Module 21 (Anglais, journée complète)
(52, 21, 'Anglais', TRUE, '2025-05-13 08:30:00', '2025-05-13 12:30:00', NOW(), 'admin'),
(53, 21, 'Anglais', TRUE, '2025-05-13 13:30:00', '2025-05-13 16:30:00', NOW(), 'admin');