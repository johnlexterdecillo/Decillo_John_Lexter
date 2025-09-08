<!DOCTYPE html>
<html>
<head>
    <title>Terraria Users - LavaLust</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap');
        
        * { 
            box-sizing: border-box; 
        }
        
        body { 
            margin: 0; 
            font-family: 'Press Start 2P', monospace; 
            color: #e94560; 
            background: #1a1a2e;
            background-image: 
                radial-gradient(circle at 20% 80%, #16213e 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, #0f3460 0%, transparent 50%),
                radial-gradient(circle at 40% 40%, #533483 0%, transparent 50%);
            image-rendering: pixelated;
            image-rendering: -moz-crisp-edges;
            image-rendering: crisp-edges;
        }
        
        .terraria-bg { 
            position: fixed; 
            inset: 0; 
            z-index: -1; 
            pointer-events: none; 
            background:
                repeating-linear-gradient(
                    0deg,
                    transparent,
                    transparent 2px,
                    rgba(255, 255, 255, 0.03) 2px,
                    rgba(255, 255, 255, 0.03) 4px
                ),
                repeating-linear-gradient(
                    90deg,
                    transparent,
                    transparent 2px,
                    rgba(255, 255, 255, 0.03) 2px,
                    rgba(255, 255, 255, 0.03) 4px
                );
        }
        
        .container { 
            max-width: 1000px; 
            margin: 2rem auto; 
            padding: 0 16px; 
        }
        
        .card { 
            background: #0f0f23; 
            border: 4px solid #e94560; 
            border-radius: 0; 
            box-shadow: 
                0 0 0 2px #f39c12,
                0 0 0 6px #e94560,
                0 0 20px rgba(233, 69, 96, 0.3);
            overflow: hidden; 
            transform: translateY(8px); 
            opacity: 0; 
            animation: cardIn .6s ease-out forwards; 
            position: relative;
        }
        
        .card::before {
            content: '';
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            background: linear-gradient(45deg, #e94560, #f39c12, #8e44ad, #e94560);
            z-index: -1;
            animation: borderGlow 3s ease-in-out infinite alternate;
        }
        
        .card-header { 
            display: flex; 
            align-items: center; 
            justify-content: space-between; 
            padding: 20px; 
            border-bottom: 4px solid #f39c12; 
            background: linear-gradient(135deg, #e94560 0%, #c0392b 50%, #8e44ad 100%);
            position: relative;
        }
        
        .card-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                repeating-linear-gradient(
                    45deg,
                    transparent,
                    transparent 10px,
                    rgba(255, 255, 255, 0.1) 10px,
                    rgba(255, 255, 255, 0.1) 20px
                );
            pointer-events: none;
        }
        
        .title { 
            margin: 0; 
            font-size: 1.2rem; 
            color: #ffffff; 
            font-weight: 700; 
            text-shadow: 2px 2px 0px #2c3e50;
            position: relative;
            z-index: 1;
        }
        
        .actions { 
            display: flex; 
            gap: 12px; 
            position: relative;
            z-index: 1;
        }
        
        .table-wrapper { 
            overflow-x: auto; 
            animation: fadeIn .6s ease .15s both; 
            background: #0f0f23; 
        }
        
        table { 
            border-collapse: collapse; 
            width: 100%; 
        }
        
        th, td { 
            border-bottom: 2px solid #e94560; 
            padding: 16px; 
            text-align: left; 
        }
        
        th { 
            background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%); 
            font-weight: 600; 
            color: #f39c12; 
            font-size: 0.7rem;
            text-shadow: 1px 1px 0px #8e44ad;
        }
        
        tr { 
            transition: background .2s ease; 
        }
        
        tr:hover td { 
            background: #16213e; 
        }
        
        td {
            color: #ecf0f1;
            font-size: 0.6rem;
        }
        
        .btn { 
            display: inline-block; 
            padding: 12px 16px; 
            text-decoration: none; 
            border-radius: 0; 
            border: 2px solid #f39c12; 
            font-size: 0.6rem; 
            font-weight: 600; 
            box-shadow: 0 4px 0px #8e44ad; 
            transition: transform .08s ease, box-shadow .2s ease, background-color .2s ease; 
            cursor: pointer; 
            font-family: 'Press Start 2P', monospace;
            text-shadow: 1px 1px 0px #2c3e50;
        }
        
        .btn:active { 
            transform: translateY(2px); 
            box-shadow: 0 2px 0px #8e44ad; 
        }
        
        .btn-primary { 
            background: linear-gradient(135deg, #e94560 0%, #c0392b 100%); 
            color: white; 
            border-color: #f39c12; 
        }
        
        .btn-primary:hover { 
            background: linear-gradient(135deg, #c0392b 0%, #a93226 100%); 
            transform: translateY(-2px);
            box-shadow: 0 6px 0px #8e44ad;
        }
        
        .btn-edit { 
            background: linear-gradient(135deg, #f39c12 0%, #e67e22 100%); 
            color: white; 
            border-color: #e94560; 
        }
        
        .btn-edit:hover { 
            background: linear-gradient(135deg, #e67e22 0%, #d35400 100%); 
            transform: translateY(-2px);
            box-shadow: 0 6px 0px #8e44ad;
        }
        
        .btn-delete { 
            background: linear-gradient(135deg, #8e44ad 0%, #9b59b6 100%); 
            color: white; 
            border-color: #e94560; 
        }
        
        .btn-delete:hover { 
            background: linear-gradient(135deg, #9b59b6 0%, #8e44ad 100%); 
            transform: translateY(-2px);
            box-shadow: 0 6px 0px #8e44ad;
        }
        
        .empty { 
            padding: 40px; 
            text-align: center; 
            color: #8e44ad; 
            font-style: italic; 
            font-size: 0.7rem;
        }
        
        .action-buttons { 
            display: flex; 
            gap: 8px; 
            align-items: center; 
        }
        
        .delete-form { 
            display: inline; 
        }

        @keyframes cardIn { 
            to { 
                transform: translateY(0); 
                opacity: 1; 
            } 
        }
        
        @keyframes fadeIn { 
            from { 
                opacity: 0; 
            } 
            to { 
                opacity: 1; 
            } 
        }
        
        @keyframes borderGlow {
            0% { opacity: 0.7; }
            100% { opacity: 1; }
        }
    </style>
</head>
<body>
    <div class="terraria-bg"></div>
    <div class="container">
    <div class="card">
    <div class="card-header">
        <h1 class="title">👥 Terraria Users</h1>
        <div class="actions">
            <a href="<?= site_url('users/create') ?>" class="btn btn-primary">⚔️ Create User</a>
        </div>
    </div>
    <div class="table-wrapper">
    <table>
        <tr>
            <th>🆔 ID</th>
            <th>👤 Username</th>
            <th>📧 Email</th>
            <th>⚡ Actions</th>
        </tr>
        <?php if (!empty($users)): ?>
            <?php foreach($users as $user): ?>
            <tr>
                <td><?= $user['id'] ?></td>
                <td><?= $user['username'] ?></td>
                <td><?= $user['email'] ?></td>
                <td>
                    <div class="action-buttons">
                        <a href="<?= site_url('users/update/' . $user['id']) ?>" class="btn btn-edit">🔧 Edit</a>
                        
                        <!-- Navigate to delete confirmation page -->
                        <a href="<?= site_url('users/delete/' . $user['id']) ?>" class="btn btn-delete">🗑️ Delete</a>
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="4" class="empty">No Terraria players found in this world!</td>
            </tr>
        <?php endif; ?>
    </table>
    </div>
    </div>
    </div>
</body>
</html>