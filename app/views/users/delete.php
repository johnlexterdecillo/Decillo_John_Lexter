<!DOCTYPE html>
<html>
<head>
    <title>Delete Terraria User - LavaLust</title>
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
            max-width: 600px; 
            margin: 4rem auto; 
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
        
        h1 { 
            margin: 0; 
            font-size: 1.2rem; 
            color: #ffffff; 
            font-weight: 700; 
            text-shadow: 2px 2px 0px #2c3e50;
            position: relative;
            z-index: 1;
        }
        
        .card-body { 
            padding: 30px; 
            animation: fadeIn .6s ease .15s both; 
            text-align: center; 
            background: #0f0f23; 
        }
        
        p { 
            color: #ecf0f1; 
            font-size: 0.7rem; 
            line-height: 1.8; 
            margin-bottom: 2rem;
        }
        
        strong { 
            color: #f39c12; 
            font-weight: 600; 
            text-shadow: 1px 1px 0px #8e44ad;
        }
        
        .actions { 
            display: flex; 
            justify-content: center; 
            gap: 16px; 
            margin-top: 24px; 
        }
        
        .btn { 
            padding: 16px 24px; 
            text-decoration: none; 
            border-radius: 0; 
            border: 3px solid #f39c12; 
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
        
        .btn-confirm { 
            background: linear-gradient(135deg, #8e44ad 0%, #9b59b6 100%); 
            color: white; 
            border-color: #e94560; 
        }
        
        .btn-confirm:hover { 
            background: linear-gradient(135deg, #9b59b6 0%, #8e44ad 100%); 
            transform: translateY(-2px);
            box-shadow: 0 6px 0px #8e44ad;
        }
        
        .btn-cancel { 
            background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%); 
            color: #f39c12; 
            border-color: #e94560; 
        }
        
        .btn-cancel:hover { 
            background: linear-gradient(135deg, #34495e 0%, #2c3e50 100%); 
            transform: translateY(-2px);
            box-shadow: 0 6px 0px #8e44ad;
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
                <h1>🗑️ Delete Terraria User</h1>
            </div>
            <div class="card-body">
                <p>Are you sure you want to banish <strong><?= $user['username'] ?></strong> (<?= $user['email'] ?>) from this Terraria world?</p>
                <form action="<?= site_url('users/delete/' . $user['id']) ?>" method="POST">
                    <div class="actions">
                        <button type="submit" class="btn btn-confirm">💀 Yes, Banish</button>
                        <a href="<?= site_url('users/view') ?>" class="btn btn-cancel">🔙 Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>