-- AS COLUNAS DE UPDATED_AT E CREATED_AT SÓ FORAM USADAS PORQUE SÃO COLUNAS OBRIGATÓRIAS PARA FAZER REQUISIÇÕES COM O FRAMEWORK LARAVEL
CREATE DATABASE `demo_unimanage`;
USE `demo_unimanage`;

CREATE TABLE IF NOT EXISTS `user` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
    `email` varchar(200) NOT NULL,
    `username` varchar(100) NOT NULL,
    `password` varchar(100) NOT NULL,
    `role` varchar(20) NOT NULL,
    `updated_at` timestamp NULL,
    `created_at` timestamp NULL,
    PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `institution` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(200) NOT NULL,
    `address` varchar(200) NOT NULL,
    `updated_at` timestamp NULL,
    `created_at` timestamp NULL,
    PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `instructor` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(200) NOT NULL,
    `cpf` varchar(20) NOT NULL,
    `user_fk` int(11) NOT NULL,
    `institution_fk` int(11) NOT NULL,
    `updated_at` timestamp NULL,
    `created_at` timestamp NULL,
    PRIMARY KEY (`id`),
    CONSTRAINT `user_fk_instructor` FOREIGN KEY (`user_fk`) REFERENCES `user` (`id`),
    CONSTRAINT `institution_fk_instructor` FOREIGN KEY (`institution_fk`) REFERENCES `institution` (`id`)
);

CREATE TABLE IF NOT EXISTS `student` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(200) NOT NULL,
    `cpf` varchar(20) NOT NULL,
    `user_fk` int(11) NOT NULL,
    `institution_fk` int(11) NOT NULL,
    `updated_at` timestamp NULL,
    `created_at` timestamp NULL,
    PRIMARY KEY (`id`),
    CONSTRAINT `user_fk_student` FOREIGN KEY (`user_fk`) REFERENCES `user` (`id`),
    CONSTRAINT `institution_fk_student` FOREIGN KEY (`institution_fk`) REFERENCES `institution` (`id`)
);

CREATE TABLE IF NOT EXISTS `project` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `project_cod` varchar(20) NOT NULL,
    `name` varchar(200) NOT NULL,
    `description` varchar(200) NOT NULL,
    `delivery_date` date NOT NULL,
    `updated_at` timestamp NULL,
    `created_at` timestamp NULL,
    PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `team` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(200) NOT NULL,
    `project_fk` int(11) NOT NULL,
    `updated_at` timestamp NULL,
    `created_at` timestamp NULL,
    PRIMARY KEY (`id`),
    CONSTRAINT `project_fk_team` FOREIGN KEY (`project_fk`) REFERENCES `project` (`id`)
);

CREATE TABLE IF NOT EXISTS `task` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(200) NOT NULL,
    `project_fk` int(11) NOT NULL,
    `updated_at` timestamp NULL,
    `created_at` timestamp NULL,
    PRIMARY KEY (`id`),
    CONSTRAINT `project_fk_task` FOREIGN KEY (`project_fk`) REFERENCES `project` (`id`)
);

CREATE TABLE IF NOT EXISTS `document` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `title` varchar(200) NOT NULL,
    `file` varchar(200) NOT NULL,
    `project_fk` int(11) NOT NULL,
    `updated_at` timestamp NULL,
    `created_at` timestamp NULL,
    PRIMARY KEY (`id`),
    CONSTRAINT `project_fk_document` FOREIGN KEY (`project_fk`) REFERENCES `project` (`id`)
);

CREATE TABLE IF NOT EXISTS `event` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(200) NOT NULL,
    `date` date NOT NULL,
    `location` varchar(200) NOT NULL,
    `project_fk` int(11) NOT NULL,
    `updated_at` timestamp NULL,
    `created_at` timestamp NULL,
    PRIMARY KEY (`id`),
    CONSTRAINT `project_fk_event` FOREIGN KEY (`project_fk`) REFERENCES `project` (`id`)
);

CREATE TABLE IF NOT EXISTS `meeting` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `date` date NOT NULL,
    `project_fk` int(11) NOT NULL,
    `location` varchar(200) NULL,
    `link` varchar(200) NULL,
    `modality` tinyint NOT NULL,
    `team_fk` int(11) NOT NULL,
    `instructor_fk` int(11) NOT NULL,
    `updated_at` timestamp NULL,
    `created_at` timestamp NULL,
    PRIMARY KEY (`id`),
    CONSTRAINT `project_fk_meeting` FOREIGN KEY (`project_fk`) REFERENCES `project` (`id`),
    CONSTRAINT `team_fk_meeting` FOREIGN KEY (`team_fk`) REFERENCES `team` (`id`),
    CONSTRAINT `instructor_fk_meeting` FOREIGN KEY (`instructor_fk`) REFERENCES `instructor` (`id`)
);

CREATE TABLE IF NOT EXISTS `student_team` (
    `team_fk` int(11) NOT NULL,
    `student_fk` int(11) NOT NULL,
    `updated_at` timestamp NULL,
    `created_at` timestamp NULL,
    CONSTRAINT `team_fk_student_team` FOREIGN KEY (`team_fk`) REFERENCES `team` (`id`),
    CONSTRAINT `student_fk_student_team` FOREIGN KEY (`student_fk`) REFERENCES `student` (`id`)
);

CREATE TABLE IF NOT EXISTS `instructor_team` (
    `team_fk` int(11) NOT NULL,
    `instructor_fk` int(11) NOT NULL,
    `updated_at` timestamp NULL,
    `created_at` timestamp NULL,
    CONSTRAINT `team_fk_instructor_team` FOREIGN KEY (`team_fk`) REFERENCES `team` (`id`),
    CONSTRAINT `instructor_fk_instructor_team` FOREIGN KEY (`instructor_fk`) REFERENCES `instructor` (`id`)
);

INSERT INTO `project` (project_cod, name, description, delivery_date) VALUES('Código Teste', 'Nome Projeto Teste', 'Descrição Teste', '2023-04-05');
INSERT INTO `event` (name, `date`, location, project_fk) VALUES('Evento Teste', '2023-05-06', 'Local Teste', 1);
INSERT INTO `institution` (name, address) VALUES('Instituição Teste', 'Local Teste');
INSERT INTO `user` (email, username, password, `role`) VALUES('teste@email.com', 'teste123', '32132142', 'admin');
INSERT INTO `instructor` (name, cpf, user_fk, institution_fk) VALUES('André', '31230928321', 1, 1);
INSERT INTO `task` (name, project_fk) VALUES('Tarefa Teste', 1);
INSERT INTO `team` (name, project_fk) VALUES('Time Teste', 1);
INSERT INTO `instructor_team` (team_fk, instructor_fk) VALUES(1, 1);

INSERT INTO `project` (project_cod, name, description, delivery_date) VALUES('Código Teste2', 'Nome Projeto Teste2', 'Descrição Teste2', '2023-04-05');
INSERT INTO `event` (name, `date`, location, project_fk) VALUES('Evento Teste2', '2023-05-06', 'Local Teste2', 2);
INSERT INTO `institution` (name, address) VALUES('Instituição Teste2', 'Local Teste2');
INSERT INTO `user` (email, username, password, `role`) VALUES('teste2@email.com', 'teste2123', '32132142', 'admin');
INSERT INTO `instructor` (name, cpf, user_fk, institution_fk) VALUES('Adicineia', '31230928321', 2, 2);
INSERT INTO `task` (name, project_fk) VALUES('Tarefa Teste2', 2);
INSERT INTO `team` (name, project_fk) VALUES('Time Teste2', 2);
INSERT INTO `instructor_team` (team_fk, instructor_fk) VALUES(2, 2);

INSERT INTO `project` (project_cod, name, description, delivery_date) VALUES('Código Teste3', 'Nome Projeto Teste3', 'Descrição Teste3', '2023-04-05');
INSERT INTO `event` (name, `date`, location, project_fk) VALUES('Evento Teste3', '2023-05-06', 'Local Teste3', 3);
INSERT INTO `institution` (name, address) VALUES('Instituição Teste3', 'Local Teste3');
INSERT INTO `user` (email, username, password, `role`) VALUES('teste3@email.com', 'teste3123', '32132142', 'admin');
INSERT INTO `instructor` (name, cpf, user_fk, institution_fk) VALUES('Breno', '31230928321', 3, 3);
INSERT INTO `task` (name, project_fk) VALUES('Tarefa Teste3', 3);
INSERT INTO `team` (name, project_fk) VALUES('Time Teste3', 3);
INSERT INTO `instructor_team` (team_fk, instructor_fk) VALUES(3, 3);