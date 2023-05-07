CREATE DATABASE `demo_unimanage`;
USE `demo_unimanage`;

CREATE TABLE IF NOT EXISTS `user` (
	`id` int(11) NOT NULL,
    `email` varchar(200) NOT NULL,
    `username` varchar(100) NOT NULL,
    `password` varchar(100) NOT NULL,
    `role` varchar(20) NOT NULL,
    PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `institution` (
    `id` int(11) NOT NULL,
    `name` varchar(200) NOT NULL,
    `address` varchar(200) NOT NULL,
    PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `instructor` (
    `id` int(11) NOT NULL,
    `name` varchar(200) NOT NULL,
    `cpf` varchar(20) NOT NULL,
    `user_fk` int(11) NOT NULL,
    `institution_fk` int(11) NOT NULL,
    PRIMARY KEY (`id`),
    CONSTRAINT `user_fk_instructor` FOREIGN KEY (`user_fk`) REFERENCES `user` (`id`),
    CONSTRAINT `institution_fk_instructor` FOREIGN KEY (`institution_fk`) REFERENCES `institution` (`id`)
);

CREATE TABLE IF NOT EXISTS `student` (
    `id` int(11) NOT NULL,
    `name` varchar(200) NOT NULL,
    `cpf` varchar(20) NOT NULL,
    `user_fk` int(11) NOT NULL,
    `institution_fk` int(11) NOT NULL,
    PRIMARY KEY (`id`),
    CONSTRAINT `user_fk_student` FOREIGN KEY (`user_fk`) REFERENCES `user` (`id`),
    CONSTRAINT `institution_fk_student` FOREIGN KEY (`institution_fk`) REFERENCES `institution` (`id`)
);

CREATE TABLE IF NOT EXISTS `project` (
    `id` int(11) NOT NULL,
    `project_cod` varchar(20) NOT NULL,
    `name` varchar(200) NOT NULL,
    `description` varchar(200) NOT NULL,
    `delivery_date` date NOT NULL,
    PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `team` (
    `id` int(11) NOT NULL,
    `name` varchar(200) NOT NULL,
    `orientador_fk` int(11) NOT NULL,
    `project_fk` int(11) NOT NULL,
    PRIMARY KEY (`id`),
    CONSTRAINT `orientador_fk_team` FOREIGN KEY (`orientador_fk`) REFERENCES `instructor` (`id`),
    CONSTRAINT `project_fk_team` FOREIGN KEY (`project_fk`) REFERENCES `project` (`id`)
);

CREATE TABLE IF NOT EXISTS `task` (
    `id` int(11) NOT NULL,
    `name` varchar(200) NOT NULL,
    `project_fk` int(11) NOT NULL,
    PRIMARY KEY (`id`),
    CONSTRAINT `project_fk_task` FOREIGN KEY (`project_fk`) REFERENCES `project` (`id`)
);

CREATE TABLE IF NOT EXISTS `documents` (
    `id` int(11) NOT NULL,
    `title` varchar(200) NOT NULL,
    `file` varchar(200) NOT NULL,
    `project_fk` int(11) NOT NULL,
    PRIMARY KEY (`id`),
    CONSTRAINT `project_fk_documents` FOREIGN KEY (`project_fk`) REFERENCES `project` (`id`)
);

CREATE TABLE IF NOT EXISTS `event` (
    `id` int(11) NOT NULL,
    `name` varchar(200) NOT NULL,
    `data` date NOT NULL,
    `location` varchar(200) NOT NULL,
    `project_fk` int(11) NOT NULL,
    PRIMARY KEY (`id`),
    CONSTRAINT `project_fk_event` FOREIGN KEY (`project_fk`) REFERENCES `project` (`id`)
);

CREATE TABLE IF NOT EXISTS `meeting` (
    `id` int(11) NOT NULL,
    `date` date NOT NULL,
    `project_fk` int(11) NOT NULL,
    `location` varchar(200) NULL,
    `link` varchar(200) NULL,
    `modality` tinyint NOT NULL,
    `team_fk` int(11) NOT NULL,
    `instructor_fk` int(11) NOT NULL,
    PRIMARY KEY (`id`),
    CONSTRAINT `project_fk_meeting` FOREIGN KEY (`project_fk`) REFERENCES `project` (`id`),
    CONSTRAINT `team_fk_meeting` FOREIGN KEY (`team_fk`) REFERENCES `team` (`id`),
    CONSTRAINT `instructor_fk_meeting` FOREIGN KEY (`instructor_fk`) REFERENCES `instructor` (`id`)
);

CREATE TABLE IF NOT EXISTS `student_team` (
    `team_fk` int(11) NOT NULL,
    `student_fk` int(11) NOT NULL,
    CONSTRAINT `team_fk_student_team` FOREIGN KEY (`team_fk`) REFERENCES `team` (`id`),
    CONSTRAINT `student_fk_student_team` FOREIGN KEY (`student_fk`) REFERENCES `student` (`id`)
);

CREATE TABLE IF NOT EXISTS `instructor_team` (
    `team_fk` int(11) NOT NULL,
    `instructor_fk` int(11) NOT NULL,
    `task_fk` int(11) NOT NULL,
    CONSTRAINT `team_fk_instructor_team` FOREIGN KEY (`team_fk`) REFERENCES `team` (`id`),
    CONSTRAINT `task_fk_instructor_team` FOREIGN KEY (`task_fk`) REFERENCES `task` (`id`),
    CONSTRAINT `instructor_fk_instructor_team` FOREIGN KEY (`instructor_fk`) REFERENCES `instructor` (`id`)
);

INSERT INTO `project` (id, project_cod, name, description, delivery_date) VALUES(1, 'Código Teste', 'Nome Projeto Teste', 'Descrição Teste', '2023-04-05');
INSERT INTO `event` (id, name, `data`, location, project_fk) VALUES(1, 'Evento Teste', '2023-05-06', 'Local Teste', 1);
INSERT INTO `institution` (id, name, address) VALUES(1, 'Instituição Teste', 'Local Teste');
INSERT INTO `user` (id, email, username, password, `role`) VALUES(1, 'teste@email.com', 'teste123', '32132142', 'admin');
INSERT INTO `instructor` (id, name, cpf, user_fk, institution_fk) VALUES(1, 'André', '31230928321', 1, 1);
INSERT INTO `task` (id, name, project_fk) VALUES(1, 'Tarefa Teste', 1);
INSERT INTO `team` (id, name, orientador_fk, project_fk) VALUES(1, 'Time Teste', 1, 1);

INSERT INTO `project` (id, project_cod, name, description, delivery_date) VALUES(2, 'Código Teste2', 'Nome Projeto Teste2', 'Descrição Teste2', '2023-04-05');
INSERT INTO `event` (id, name, `data`, location, project_fk) VALUES(2, 'Evento Teste2', '2023-05-06', 'Local Teste2', 2);
INSERT INTO `institution` (id, name, address) VALUES(2, 'Instituição Teste2', 'Local Teste2');
INSERT INTO `user` (id, email, username, password, `role`) VALUES(2, 'teste2@email.com', 'teste2123', '32132142', 'admin');
INSERT INTO `instructor` (id, name, cpf, user_fk, institution_fk) VALUES(2, 'André', '31230928321', 2, 2);
INSERT INTO `task` (id, name, project_fk) VALUES(2, 'Tarefa Teste2', 2);
INSERT INTO `team` (id, name, orientador_fk, project_fk) VALUES(2, 'Time Teste2', 2, 2);

INSERT INTO `project` (id, project_cod, name, description, delivery_date) VALUES(3, 'Código Teste3', 'Nome Projeto Teste3', 'Descrição Teste3', '2023-04-05');
INSERT INTO `event` (id, name, `data`, location, project_fk) VALUES(3, 'Evento Teste3', '2023-05-06', 'Local Teste3', 3);
INSERT INTO `institution` (id, name, address) VALUES(3, 'Instituição Teste3', 'Local Teste3');
INSERT INTO `user` (id, email, username, password, `role`) VALUES(3, 'teste3@email.com', 'teste3123', '32132142', 'admin');
INSERT INTO `instructor` (id, name, cpf, user_fk, institution_fk) VALUES(3, 'André', '31230928321', 3, 3);
INSERT INTO `task` (id, name, project_fk) VALUES(3, 'Tarefa Teste3', 3);
INSERT INTO `team` (id, name, orientador_fk, project_fk) VALUES(3, 'Time Teste3', 3, 3);