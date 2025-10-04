<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Terraria Adventurers</title>
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

        /* Navigation */
        .navbar {
            background: rgba(15, 15, 15, 0.95);
            border-bottom: 1px solid rgba(0, 255, 255, 0.2);
            padding: 1rem 0;
            position: sticky;
            top: 0;
            z-index: 100;
            backdrop-filter: blur(10px);
        }

        .navbar-content {
            max-width: 1400px;
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

        .username {
            font-family: "JetBrains Mono", monospace;
            color: #00ffff;
        }

        .role-badge {
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

        /* Container */
        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 2rem;
        }

        /* Page Header */
        .page-header {
            margin-bottom: 2rem;
        }

        .page-title {
            font-family: "JetBrains Mono", monospace;
            font-size: 2.5rem;
            color: #ff0066;
            text-shadow: 0 0 15px rgba(255, 0, 102, 0.5);
            letter-spacing: 2px;
            margin-bottom: 0.5rem;
        }

        .page-subtitle {
            color: rgba(224, 224, 224, 0.7);
            font-size: 1.1rem;
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: rgba(15, 15, 15, 0.9);
            border: 1px solid rgba(0, 255, 255, 0.2);
            border-radius: 8px;
            padding: 1.5rem;
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            border-color: #00ffff;
            box-shadow: 0 0 20px rgba(0, 255, 255, 0.3);
            transform: translateY(-2px);
        }

        .stat-icon {
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }

        .stat-label {
            color: #00ffff;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 0.5rem;
        }

        .stat-value {
            font-family: "JetBrains Mono", monospace;
            font-size: 2.5rem;
            font-weight: 600;
            color: #e0e0e0;
        }

        /* Content Grid */
        .content-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 1.5rem;
        }

        .card {
            background: rgba(15, 15, 15, 0.9);
            border: 1px solid rgba(0, 255, 255, 0.2);
            border-radius: 8px;
            overflow: hidden;
        }

        .card-header {
            background: rgba(0, 255, 255, 0.05);
            border-bottom: 1px solid rgba(0, 255, 255, 0.2);
            padding: 1.25rem 1.5rem;
        }

        .card-title {
            font-family: "JetBrains Mono", monospace;
            color: #00ffff;
            font-size: 1.1rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .card-body {
            padding: 1.5rem;
        }

        /* List Items */
        .list-item {
            padding: 1rem;
            border-bottom: 1px solid rgba(0, 255, 255, 0.1);
            transition: all 0.3s ease;
        }

        .list-item:last-child {
            border-bottom: none;
        }

        .list-item:hover {
            background: rgba(0, 255, 255, 0.05);
        }

        .list-item-title {
            color: #e0e0e0;
            font-weight: 600;
            margin-bottom: 0.25rem;
        }

        .list-item-meta {
            color: rgba(224, 224, 224, 0.6);
            font-size: 0.85rem;
        }

        .empty-state {
            text-align: center;
            padding: 2rem;
            color: rgba(224, 224, 224, 0.5);
        }

        /* Class Badge */
        .class-badge {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            background: rgba(0, 255, 255, 0.1);
            color: #00ffff;
            border: 1px solid rgba(0, 255, 255, 0.3);
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .navbar-menu {
                gap: 1rem;
            }

            .user-info {
                padding-left: 1rem;
            }

            .page-title {
                font-size: 2rem;
            }

            .stats-grid,
            .content-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="navbar-content">
            <a href="<?= site_url('dashboard') ?>" class="navbar-brand">⚔️ TERRARIA</a>
            
            <div class="navbar-menu">
                <a href="<?= site_url('dashboard') ?>">📊 Dashboard</a>
                <a href="<?= site_url('users/view') ?>">👥 Users</a>
                <?php if ($current_user['role'] === 'admin'): ?>
                    <a href="<?= site_url('users/create') ?>">➕ New User</a>
                <?php endif; ?>
                
                <div class="user-info">
                    <span>👤</span>
                    <span class="username"><?= htmlspecialchars($current_user['username']) ?></span>
                    <?php if ($current_user['role'] === 'admin'): ?>
                        <span class="role-badge">Admin</span>
                    <?php endif; ?>
                    <a href="<?= site_url('auth/profile') ?>">⚙️</a>
                    <a href="<?= site_url('auth/logout') ?>">🚪 Logout</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-title">🌍 Dashboard</h1>
            <p class="page-subtitle">Welcome back, <?= htmlspecialchars($current_user['username']) ?>! Here's what's happening in your world.</p>
        </div>

        <!-- Stats Grid -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon">👥</div>
                <div class="stat-label">Total Users</div>
                <div class="stat-value"><?= $total_users ?></div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">⚔️</div>
                <div class="stat-label">Adventurers</div>
                <div class="stat-value"><?= $total_adventurers ?></div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">🎯</div>
                <div class="stat-label">Your Class</div>
                <div class="stat-value" style="font-size: 1.5rem;"><?= htmlspecialchars(ucfirst($current_user['class'] ?? 'None')) ?></div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">🏆</div>
                <div class="stat-label">Your Role</div>
                <div class="stat-value" style="font-size: 1.5rem;"><?= htmlspecialchars(ucfirst($current_user['role'])) ?></div>
            </div>
        </div>

        <!-- Content Grid -->
        <div class="content-grid">
            <!-- Recent Users -->
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">📋 Recent Users</h2>
                </div>
                <div class="card-body">
                    <?php if (!empty($recent_users)): ?>
                        <?php foreach ($recent_users as $user): ?>
                            <div class="list-item">
                                <div class="list-item-title">
                                    <?= htmlspecialchars($user['username']) ?>
                                    <?php if (!empty($user['class'])): ?>
                                        <span class="class-badge"><?= htmlspecialchars($user['class']) ?></span>
                                    <?php endif; ?>
                                </div>
                                <div class="list-item-meta">
                                    <?= htmlspecialchars($user['email']) ?> • 
                                    Joined <?= date('M d, Y', strtotime($user['created_at'])) ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="empty-state">No users found</div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Class Distribution -->
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">🎯 Class Distribution</h2>
                </div>
                <div class="card-body">
                    <?php if (!empty($class_stats)): ?>
                        <?php foreach ($class_stats as $stat): ?>
                            <div class="list-item">
                                <div class="list-item-title">
                                    <span class="class-badge"><?= htmlspecialchars(ucfirst($stat['class'])) ?></span>
                                </div>
                                <div class="list-item-meta">
                                    <?= $stat['count'] ?> <?= $stat['count'] == 1 ? 'user' : 'users' ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="empty-state">No class data available</div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- My Adventurers -->
            <?php if (!empty($my_adventurers)): ?>
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">⚔️ My Adventurers</h2>
                </div>
                <div class="card-body">
                    <?php foreach ($my_adventurers as $adventurer): ?>
                        <div class="list-item">
                            <div class="list-item-title">
                                <?= htmlspecialchars($adventurer['character_name']) ?>
                                <span class="class-badge"><?= htmlspecialchars($adventurer['class']) ?></span>
                            </div>
                            <div class="list-item-meta">
                                Level <?= $adventurer['level'] ?> • 
                                <?= $adventurer['health'] ?> HP • 
                                <?= $adventurer['gold'] ?> Gold
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
