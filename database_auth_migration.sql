-- Authentication Migration SQL
-- Run this to add authentication fields to users table

-- If users table doesn't exist, create it
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `class` varchar(50) DEFAULT 'adventurer',
  `avatar` varchar(255) DEFAULT NULL,
  `role` enum('user','admin','moderator') DEFAULT 'user',
  `last_login` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- If users table already exists, add missing columns
-- (These will fail if columns already exist, which is fine)
ALTER TABLE `users` 
ADD COLUMN `password` varchar(255) NOT NULL AFTER `email`;

ALTER TABLE `users` 
ADD COLUMN `role` enum('user','admin','moderator') DEFAULT 'user' AFTER `avatar`;

ALTER TABLE `users` 
ADD COLUMN `last_login` datetime DEFAULT NULL AFTER `role`;

ALTER TABLE `users` 
ADD COLUMN `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `last_login`;

ALTER TABLE `users` 
ADD COLUMN `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP AFTER `created_at`;

-- Add unique constraints if they don't exist
ALTER TABLE `users` 
ADD UNIQUE KEY `username` (`username`);

ALTER TABLE `users` 
ADD UNIQUE KEY `email` (`email`);

-- Create a default admin user (password: admin123)
-- Password hash for 'admin123'
INSERT INTO `users` (`username`, `email`, `password`, `class`, `role`) 
VALUES ('admin', 'admin@terraria.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'warrior', 'admin')
ON DUPLICATE KEY UPDATE `username` = `username`;

-- Sample user (password: user123)
-- Password hash for 'user123'
INSERT INTO `users` (`username`, `email`, `password`, `class`, `role`) 
VALUES ('testuser', 'user@terraria.com', '$2y$10$6rZ5tK4Z0M/EaJOiJKU5GOx3cF5VxPYhRCm5y5xJ0bVzN7kV6kDWO', 'mage', 'user')
ON DUPLICATE KEY UPDATE `username` = `username`;
