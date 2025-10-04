<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Terraria Adventurers</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: #0a0a0a;
            color: #e0e0e0;
            font-family: "Inter", sans-serif;
            min-height: 100vh;
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        h1 {
            text-align: center;
            color: #ff0066;
            margin-bottom: 3rem;
            font-family: "JetBrains Mono", monospace;
            font-weight: 600;
            font-size: 2.5rem;
            text-shadow: 0 0 15px rgba(255, 0, 102, 0.5);
            letter-spacing: 2px;
        }

        .actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            gap: 1rem;
        }

        .search-form {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .search-form input[type="text"] {
            padding: 0.75rem 1rem;
            border: 1px solid rgba(0, 255, 255, 0.3);
            background: rgba(10, 10, 10, 0.8);
            color: #e0e0e0;
            font-family: "Inter", sans-serif;
            font-size: 0.95rem;
            border-radius: 6px;
            width: 300px;
            transition: all 0.3s ease;
            outline: none;
        }

        .search-form input[type="text"]:focus {
            border-color: #00ffff;
            box-shadow: 0 0 0 2px rgba(0, 255, 255, 0.1), 0 0 10px rgba(0, 255, 255, 0.3);
        }

        .search-form input[type="text"]::placeholder {
            color: rgba(224, 224, 224, 0.5);
        }

        .btn {
            padding: 0.75rem 1.5rem;
            font-size: 0.9rem;
            font-weight: 500;
            border: none;
            cursor: pointer;
            text-decoration: none;
            font-family: "Inter", sans-serif;
            border-radius: 6px;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .btn-primary {
            background: rgba(0, 255, 255, 0.1);
            color: #00ffff;
            border: 1px solid rgba(0, 255, 255, 0.4);
            box-shadow: 0 0 10px rgba(0, 255, 255, 0.2);
        }

        .btn-primary:hover {
            background: rgba(0, 255, 255, 0.2);
            border-color: #00ffff;
            box-shadow: 0 0 20px rgba(0, 255, 255, 0.4);
            transform: translateY(-1px);
        }

        .btn-secondary {
            background: rgba(255, 0, 102, 0.1);
            color: #ff0066;
            border: 1px solid rgba(255, 0, 102, 0.4);
            box-shadow: 0 0 10px rgba(255, 0, 102, 0.2);
        }

        .btn-secondary:hover {
            background: rgba(255, 0, 102, 0.2);
            border-color: #ff0066;
            box-shadow: 0 0 20px rgba(255, 0, 102, 0.4);
            transform: translateY(-1px);
        }

        .table-container {
            background: rgba(15, 15, 15, 0.8);
            border: 1px solid rgba(0, 255, 255, 0.2);
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: transparent;
        }

        table th {
            background: rgba(0, 255, 255, 0.05);
            color: #00ffff;
            font-family: "JetBrains Mono", monospace;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 1.25rem 1.5rem;
            text-align: left;
            font-size: 0.85rem;
            border-bottom: 1px solid rgba(0, 255, 255, 0.2);
        }

        table td {
            padding: 1.25rem 1.5rem;
            color: #e0e0e0;
            font-size: 0.95rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            transition: all 0.3s ease;
        }

        table tbody tr:hover td {
            background: rgba(0, 255, 255, 0.05);
            border-color: rgba(0, 255, 255, 0.1);
        }

        table td a {
            color: #00ffff;
            text-decoration: none;
            font-weight: 500;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
        }

        table td a:hover {
            color: #ff0066;
            text-shadow: 0 0 8px rgba(255, 0, 102, 0.6);
        }

        .no-data {
            text-align: center;
            color: rgba(224, 224, 224, 0.6);
            font-style: italic;
            padding: 3rem 2rem;
            font-size: 1.1rem;
        }

        .pagination {
            margin-top: 2rem;
            display: flex;
            justify-content: center;
            gap: 0.5rem;
            flex-wrap: wrap;
        }

        .pagination a,
        .pagination strong {
            padding: 0.5rem 0.75rem;
            font-size: 0.9rem;
            text-decoration: none;
            border: 1px solid rgba(0, 255, 255, 0.3);
            background: rgba(0, 255, 255, 0.05);
            color: #00ffff;
            font-family: "JetBrains Mono", monospace;
            border-radius: 4px;
            transition: all 0.3s ease;
            min-width: 40px;
            text-align: center;
        }

        .pagination a:hover {
            background: rgba(0, 255, 255, 0.15);
            border-color: #00ffff;
            box-shadow: 0 0 10px rgba(0, 255, 255, 0.3);
        }

        .pagination strong {
            background: rgba(255, 0, 102, 0.15);
            border-color: #ff0066;
            color: #ff0066;
            box-shadow: 0 0 10px rgba(255, 0, 102, 0.3);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                padding: 1rem;
            }
            
            h1 {
                font-size: 2rem;
                margin-bottom: 2rem;
            }
            
            .actions {
                flex-direction: column;
                align-items: stretch;
                gap: 1rem;
            }
            
            .search-form {
                justify-content: center;
            }

            .search-form input[type="text"] {
                width: 100%;
                max-width: 300px;
            }
            
            table th,
            table td {
                padding: 0.75rem;
                font-size: 0.85rem;
            }

            table th {
                font-size: 0.75rem;
            }

            table td a {
                font-size: 0.75rem;
            }
        }

        @media (max-width: 480px) {
            .table-container {
                margin: 0 -1rem;
                border-radius: 0;
                border-left: none;
                border-right: none;
            }

            table th:first-child,
            table td:first-child {
                padding-left: 1rem;
            }

            table th:last-child,
            table td:last-child {
                padding-right: 1rem;
            }
        }

        /* Navigation Bar */
        .navbar {
            background: rgba(15, 15, 15, 0.95);
            border-bottom: 1px solid rgba(0, 255, 255, 0.2);
            padding: 1rem 0;
            margin-bottom: 2rem;
            position: sticky;
            top: 0;
            z-index: 100;
            backdrop-filter: blur(10px);
        }

        .navbar-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar-brand {
            font-family: "JetBrains Mono", monospace;
            font-size: 1.5rem;
            font-weight: 600;
            color: #ff0066;
            text-shadow: 0 0 15px rgba(255, 0, 102, 0.5);
            text-decoration: none;
        }

        .navbar-menu {
            display: flex;
            gap: 2rem;
            align-items: center;
        }

        .navbar-menu a {
            color: #00ffff;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .navbar-menu a:hover {
            color: #ff0066;
            text-shadow: 0 0 8px rgba(255, 0, 102, 0.6);
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding-left: 2rem;
            border-left: 1px solid rgba(0, 255, 255, 0.2);
        }

        .user-info .username {
            font-family: "JetBrains Mono", monospace;
            font-weight: 500;
            color: #00ffff;
        }

        .user-info .role-badge {
            background: rgba(255, 215, 0, 0.2);
            color: #ffd700;
            padding: 0.25rem 0.75rem;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border: 1px solid rgba(255, 215, 0, 0.4);
        }
    </style>
</head>
<body>
    <?php
    // current_user is provided by controller: $data['current_user']
    $current_user = isset($current_user) ? $current_user : null;
    ?>
    
    <nav class="navbar">
        <div class="navbar-content">
            <a href="<?= site_url('dashboard') ?>" class="navbar-brand">⚔️ TERRARIA</a>
            
            <div class="navbar-menu">
                <a href="<?= site_url('dashboard') ?>">📊 Dashboard</a>
                <a href="<?= site_url('users/view') ?>">👥 Users</a>
                <?php if ($current_user && $current_user['role'] === 'admin'): ?>
                    <a href="<?= site_url('users/create') ?>">➕ New User</a>
                <?php endif; ?>
                
                <div class="user-info">
                    <span>👤</span>
                    <span class="username"><?= htmlspecialchars($current_user['username'] ?? 'Guest') ?></span>
                    <?php if (!empty($current_user['role']) && $current_user['role'] === 'admin'): ?>
                        <span class="role-badge">Admin</span>
                    <?php endif; ?>
                    <a href="<?= site_url('auth/profile') ?>">⚙️</a>
                    <a href="<?= site_url('auth/logout') ?>">🚪 Logout</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container">
        <h1>🌍 Terraria Adventurers</h1>

        <div class="actions">
            <form method="get" action="<?= site_url('users/view'); ?>" class="search-form">
                <input type="text" name="q" 
                       value="<?= isset($_GET['q']) ? htmlspecialchars($_GET['q']) : '' ?>"
                       placeholder="🔍 Search adventurers...">
                <button type="submit" class="btn btn-primary">Search</button>
            </form>

            <?php if (!empty($_GET['q'])): ?>
                <a href="<?= site_url('users/view'); ?>" class="btn btn-secondary">
                    ⬅️ Show All
                </a>
            <?php else: ?>
                <a href="<?= site_url('users/create'); ?>" class="btn btn-primary">
                    ⚡ New Adventurer
                </a>
            <?php endif; ?>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Avatar</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Class</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($users)): ?>
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td><strong>#<?= htmlspecialchars($user['id']); ?></strong></td>
                                <td>
                                    <?php if (!empty($user['avatar'])): ?>
                                        <img src="<?= base_url('public/avatars/' . $user['avatar']); ?>" 
                                             alt="<?= htmlspecialchars($user['username']); ?>" 
                                             class="avatar"
                                             onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                        <div class="no-avatar" style="display:none;">
                                            <?= strtoupper(substr($user['username'], 0, 1)); ?>
                                        </div>
                                    <?php else: ?>
                                        <div class="no-avatar">
                                            <?= strtoupper(substr($user['username'], 0, 1)); ?>
                                        </div>
                                    <?php endif; ?>
                                </td>
                                <td><strong><?= htmlspecialchars($user['username']); ?></strong></td>
                                <td><?= htmlspecialchars($user['email']); ?></td>
                                <td>
                                    <?php if (isset($user['class']) && !empty($user['class'])): ?>
                                        <span class="class-badge"><?= htmlspecialchars($user['class']); ?></span>
                                    <?php else: ?>
                                        <span style="color: rgba(255,255,255,0.5);">—</span>
                                    <?php endif; ?>
                                </td>
                                <td class="action-links">
                                    <a href="<?= site_url('users/update/' . $user['id']); ?>">
                                        ✏️ Edit
                                    </a>
                                    <a href="<?= site_url('users/delete/' . $user['id']); ?>" 
                                       class="delete"
                                       onclick="return confirm('⚠️ Are you sure you want to remove <?= htmlspecialchars($user['username']); ?> from the world? This cannot be undone!');">
                                        🗑️ Delete
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="no-data">
                                🌌 No adventurers found in this world
                                <?php if (!empty($_GET['q'])): ?>
                                    <br><small>Try a different search term</small>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>


        <?php if (!empty($page)): ?>
            <div class="pagination">
                <?= $page; ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>