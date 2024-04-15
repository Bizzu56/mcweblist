CREATE TABLE IF NOT EXISTS `exemple` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
    `title` TEXT, 
    `isActive` BOOLEAN DEFAULT FALSE
) ENGINE=InnoDB;


CREATE TABLE IF NOT EXISTS `users` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `nickName` VARCHAR(15) NOT NULL UNIQUE,
    `email` VARCHAR(35) NOT NULL UNIQUE,
    `password` TEXT NOT NULL,
    `isAdmin` BOOLEAN DEFAULT FALSE,
    `isBanned` BOOLEAN DEFAULT FALSE
) ENGINE=InnoDB;


CREATE TABLE IF NOT EXISTS `servers` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `server_ip` VARCHAR(25),
    `name` VARCHAR(15),
    `description` TEXT,
    `userId` INT,
    FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB;


CREATE TABLE IF NOT EXISTS `events` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `event_start_at` VARCHAR(12),
    `title` VARCHAR(35),
    `description` TEXT,
    `serverId` INT,
    FOREIGN KEY (`serverId`) REFERENCES `servers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB;


CREATE TABLE IF NOT EXISTS `messages` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
    `content` TEXT, 
    `create_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `serverId` INT,
    `authorId` INT,
    FOREIGN KEY (`serverId`) REFERENCES `servers` (`id`) ON DELETE CASCADE,
    FOREIGN KEY (`authorId`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB;

INSERT INTO `users` (`nickName`, `email`, `password`) VALUES ("test", "test@test.com", "$argon2i$v=19$m=65536,t=4,p=1$NVd2dHRBRW1QWm11bGRzZw$81dL5FMn2TFT8X3mURmuY6eQpViQMhDDkuQMkG90o0A");
INSERT INTO `servers` (`server_ip`, `name`, `description`, `userId`) VALUES ("hypixel.net", "hypixel", "Serveur Multi GAmes", 1);
INSERT INTO `messages` (`content`, `authorId`, `serverId`) VALUES ("très bon serveur ! je connais pas mieux !", 1, 1);
INSERT INTO `events` (`event_start_at`, `title`, `description`, `serverId`) VALUES ("11-04-2024", "Give All", "On va give une tonnes d'item a tous le monde !", 1);