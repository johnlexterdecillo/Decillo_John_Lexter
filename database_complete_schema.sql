-- Complete Database Schema for Terraria Adventurers
-- Separates authentication (users) from game characters (adventurers)

-- =====================================================
-- USERS TABLE (Authentication)
-- For login, registration, and user management
-- =====================================================
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `class` varchar(50) DEFAULT 'adventurer',
  `avatar` varchar(255) DEFAULT NULL,
  `role` enum('user','admin','moderator') DEFAULT 'user',
  `is_active` tinyint(1) DEFAULT 1,
  `last_login` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `idx_role` (`role`),
  KEY `idx_active` (`is_active`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- ADVENTURERS TABLE (Game Characters)
-- For managing in-game adventurer characters
-- =====================================================
DROP TABLE IF EXISTS `adventurers`;
CREATE TABLE `adventurers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `character_name` varchar(100) NOT NULL,
  `class` enum('warrior','ranger','mage','summoner','adventurer') DEFAULT 'adventurer',
  `level` int(11) DEFAULT 1,
  `health` int(11) DEFAULT 100,
  `mana` int(11) DEFAULT 20,
  `defense` int(11) DEFAULT 0,
  `avatar` varchar(255) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `gold` int(11) DEFAULT 0,
  `is_active` tinyint(1) DEFAULT 1,
  `last_played` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_user_id` (`user_id`),
  KEY `idx_class` (`class`),
  KEY `idx_level` (`level`),
  KEY `idx_active` (`is_active`),
  CONSTRAINT `fk_adventurers_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- INSERT DEFAULT USERS
-- =====================================================

-- Admin User (username: admin, password: admin123)
INSERT INTO `users` (`username`, `email`, `password`, `role`, `is_active`) VALUES
('admin', 'admin@terraria.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin', 1);

-- Test User (username: testuser, password: user123)
INSERT INTO `users` (`username`, `email`, `password`, `role`, `is_active`) VALUES
('testuser', 'user@terraria.com', '$2y$10$6rZ5tK4Z0M/EaJOiJKU5GOx3cF5VxPYhRCm5y5xJ0bVzN7kV6kDWO', 'user', 1);

-- Demo User (username: demo, password: demo123)
INSERT INTO `users` (`username`, `email`, `password`, `role`, `is_active`) VALUES
('demo', 'demo@terraria.com', '$2y$10$YJGz7oPjN5d5B5O5C5x5xOx5xOx5xOx5xOx5xOx5xOx5xOx5xOx5x', 'user', 1);

-- Fallback: if your database already has `users` without class/avatar, add them
-- Note: MySQL 5.7 does NOT support IF NOT EXISTS on ADD COLUMN.
-- Run these manually; if the column already exists you'll get an error (safe to ignore).
ALTER TABLE `users` ADD COLUMN `class` varchar(50) DEFAULT 'adventurer' AFTER `password`;
ALTER TABLE `users` ADD COLUMN `avatar` varchar(255) DEFAULT NULL AFTER `class`;

-- =====================================================
-- INSERT SAMPLE ADVENTURERS
-- =====================================================

-- Admin's adventurer characters
INSERT INTO `adventurers` (`user_id`, `character_name`, `class`, `level`, `health`, `mana`, `defense`, `gold`, `bio`) VALUES
(1, 'Terra Knight', 'warrior', 10, 400, 20, 25, 5000, 'A legendary warrior who has conquered the Corruption.'),
(1, 'Crimson Mage', 'mage', 8, 200, 200, 10, 3500, 'Master of arcane arts and elemental magic.');

-- Test user's adventurer characters
INSERT INTO `adventurers` (`user_id`, `character_name`, `class`, `level`, `health`, `mana`, `defense`, `gold`, `bio`) VALUES
(2, 'Shadow Ranger', 'ranger', 5, 250, 50, 15, 1200, 'Swift archer with deadly precision.'),
(2, 'Mystic Summoner', 'summoner', 6, 220, 150, 12, 1800, 'Commands powerful minions to fight.');

-- Demo user's adventurer character
INSERT INTO `adventurers` (`user_id`, `character_name`, `class`, `level`, `health`, `mana`, `defense`, `gold`, `bio`) VALUES
(3, 'New Adventurer', 'adventurer', 1, 100, 20, 0, 50, 'Just starting their journey in Terraria.');

-- =====================================================
-- VIEWS (Optional - for easy data retrieval)
-- =====================================================

-- View to get adventurers with their user info
CREATE OR REPLACE VIEW `vw_adventurers_with_users` AS
SELECT 
    a.id AS adventurer_id,
    a.character_name,
    a.class,
    a.level,
    a.health,
    a.mana,
    a.defense,
    a.avatar,
    a.bio,
    a.gold,
    a.last_played,
    a.created_at AS adventurer_created_at,
    u.id AS user_id,
    u.username,
    u.email,
    u.role AS user_role
FROM adventurers a
INNER JOIN users u ON a.user_id = u.id
WHERE a.is_active = 1 AND u.is_active = 1;

-- =====================================================
-- INDEXES FOR PERFORMANCE
-- =====================================================

-- Additional indexes for common queries
ALTER TABLE `adventurers` ADD INDEX `idx_character_name` (`character_name`);
ALTER TABLE `adventurers` ADD INDEX `idx_user_class` (`user_id`, `class`);
ALTER TABLE `users` ADD INDEX `idx_email_password` (`email`, `password`);

-- =====================================================
-- STORED PROCEDURES (Optional)
-- =====================================================

DELIMITER $$

-- Procedure to create a new adventurer for a user
CREATE PROCEDURE `sp_create_adventurer`(
    IN p_user_id INT,
    IN p_character_name VARCHAR(100),
    IN p_class VARCHAR(50)
)
BEGIN
    INSERT INTO adventurers (user_id, character_name, class)
    VALUES (p_user_id, p_character_name, p_class);
    
    SELECT LAST_INSERT_ID() AS adventurer_id;
END$$

-- Procedure to get user's adventurers
CREATE PROCEDURE `sp_get_user_adventurers`(
    IN p_user_id INT
)
BEGIN
    SELECT * FROM adventurers 
    WHERE user_id = p_user_id AND is_active = 1
    ORDER BY created_at DESC;
END$$

-- Procedure to update adventurer stats
CREATE PROCEDURE `sp_update_adventurer_stats`(
    IN p_adventurer_id INT,
    IN p_level INT,
    IN p_health INT,
    IN p_mana INT,
    IN p_defense INT,
    IN p_gold INT
)
BEGIN
    UPDATE adventurers 
    SET 
        level = p_level,
        health = p_health,
        mana = p_mana,
        defense = p_defense,
        gold = p_gold,
        last_played = NOW()
    WHERE id = p_adventurer_id;
END$$

DELIMITER ;

-- =====================================================
-- SAMPLE QUERIES
-- =====================================================

-- Get all adventurers with their owners
-- SELECT * FROM vw_adventurers_with_users;

-- Get all adventurers for a specific user
-- SELECT * FROM adventurers WHERE user_id = 1;

-- Get top level adventurers
-- SELECT character_name, class, level FROM adventurers ORDER BY level DESC LIMIT 10;

-- Count adventurers by class
-- SELECT class, COUNT(*) as count FROM adventurers GROUP BY class;

-- Get user with their adventurer count
-- SELECT u.username, COUNT(a.id) as adventurer_count 
-- FROM users u 
-- LEFT JOIN adventurers a ON u.id = a.user_id 
-- GROUP BY u.id;
