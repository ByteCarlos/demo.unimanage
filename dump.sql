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