<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile - Terraria Adventurers</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: "Inter", sans-serif;
            background: #0a0a0a;
            color: #e0e0e0;
            min-height: 100vh;
            padding: 20px;
        }
        
        .container {
            max-width: 800px;
            margin: 0 auto;
        }
        
        .nav {
            background: rgba(15, 15, 15, 0.9);
            border: 1px solid rgba(0, 255, 255, 0.2);
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .nav a {
            color: #00ffff;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .nav a:hover {
            color: #ff0066;
            text-shadow: 0 0 8px rgba(255, 0, 102, 0.6);
        }
        
        .profile-card {
            background: rgba(15, 15, 15, 0.9);
            border: 1px solid rgba(0, 255, 255, 0.2);
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
            overflow: hidden;
        }
        
        .profile-header {
            background: rgba(0, 255, 255, 0.05);
            border-bottom: 1px solid rgba(0, 255, 255, 0.2);
            color: #00ffff;
            padding: 40px 30px;
            text-align: center;
        }
        
        .profile-header h1 {
            font-family: "JetBrains Mono", monospace;
            font-size: 32px;
            text-shadow: 0 0 15px rgba(0, 255, 255, 0.5);
            letter-spacing: 2px;
            margin-top: 15px;
        }
        
        .avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 3px solid #00ffff;
            margin: 0 auto 15px;
            object-fit: cover;
            box-shadow: 0 0 20px rgba(0, 255, 255, 0.4);
        }
        
        .no-avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 3px solid #00ffff;
            margin: 0 auto 15px;
            background: rgba(0, 255, 255, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 48px;
            font-weight: 600;
            color: #00ffff;
            box-shadow: 0 0 20px rgba(0, 255, 255, 0.4);
        }
        
        .profile-body {
            padding: 30px;
        }
        
        .info-group {
            margin-bottom: 25px;
            padding-bottom: 25px;
            border-bottom: 1px solid rgba(0, 255, 255, 0.1);
        }
        
        .info-group:last-child {
            border-bottom: none;
        }
        
        .info-label {
            color: #00ffff;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 8px;
            font-weight: 600;
        }
        
        .info-value {
            color: #e0e0e0;
            font-size: 20px;
            font-weight: 500;
        }
        
        .badge {
            display: inline-block;
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .badge-admin {
            background: rgba(255, 215, 0, 0.2);
            color: #ffd700;
            border: 1px solid rgba(255, 215, 0, 0.4);
            box-shadow: 0 0 10px rgba(255, 215, 0, 0.3);
        }
        
        .badge-user {
            background: rgba(0, 255, 255, 0.1);
            color: #00ffff;
            border: 1px solid rgba(0, 255, 255, 0.4);
            box-shadow: 0 0 10px rgba(0, 255, 255, 0.2);
        }
        
        .btn {
            display: inline-block;
            padding: 12px 24px;
            background: rgba(0, 255, 255, 0.1);
            color: #00ffff;
            text-decoration: none;
            border: 1px solid rgba(0, 255, 255, 0.4);
            border-radius: 6px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            margin-right: 10px;
            margin-top: 10px;
            box-shadow: 0 0 10px rgba(0, 255, 255, 0.2);
        }
        
        .btn:hover {
            background: rgba(0, 255, 255, 0.2);
            border-color: #00ffff;
            box-shadow: 0 0 20px rgba(0, 255, 255, 0.4);
            transform: translateY(-2px);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="nav">
            <a href="<?= site_url('users/view') ?>">← Back to Users</a>
            <a href="<?= site_url('auth/logout') ?>">Logout</a>
        </div>
        
        <div class="profile-card">
            <div class="profile-header">
                <?php if (!empty($user['avatar'])): ?>
                    <img src="<?= base_url('public/avatars/' . $user['avatar']) ?>" alt="Avatar" class="avatar">
                <?php else: ?>
                    <div class="avatar" style="background: #ddd; display: flex; align-items: center; justify-content: center; font-size: 48px;">
                        👤
                    </div>
                <?php endif; ?>
                <h1><?= htmlspecialchars($user['username']) ?></h1>
            </div>
            
            <div class="profile-body">
                <div class="info-group">
                    <div class="info-label">Email</div>
                    <div class="info-value"><?= htmlspecialchars($user['email']) ?></div>
                </div>
                
                <div class="info-group">
                    <div class="info-label">Class</div>
                    <div class="info-value"><?= htmlspecialchars($user['class'] ?? 'Not set') ?></div>
                </div>
                
                <div class="info-group">
                    <div class="info-label">Role</div>
                    <div class="info-value">
                        <span class="badge <?= $user['role'] == 'admin' ? 'badge-admin' : 'badge-user' ?>">
                            <?= htmlspecialchars(ucfirst($user['role'] ?? 'user')) ?>
                        </span>
                    </div>
                </div>
                
                <div style="margin-top: 30px;">
                    <a href="<?= site_url('auth/change_password') ?>" class="btn">Change Password</a>
                    <a href="<?= site_url('users/update/' . $user['id']) ?>" class="btn">Edit Profile</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
