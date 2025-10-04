<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Terraria Adventurers</title>
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
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .register-container {
            background: rgba(15, 15, 15, 0.95);
            border: 1px solid rgba(0, 255, 255, 0.2);
            border-radius: 10px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.5);
            overflow: hidden;
            width: 100%;
            max-width: 500px;
        }
        
        .register-header {
            background: rgba(0, 255, 255, 0.05);
            border-bottom: 1px solid rgba(0, 255, 255, 0.2);
            color: #00ffff;
            padding: 30px;
            text-align: center;
        }
        
        .register-header h1 {
            font-family: "JetBrains Mono", monospace;
            font-size: 28px;
            margin-bottom: 10px;
            text-shadow: 0 0 15px rgba(0, 255, 255, 0.5);
            letter-spacing: 2px;
        }
        
        .register-header p {
            opacity: 0.8;
            font-size: 14px;
            color: #e0e0e0;
        }
        
        .register-body {
            padding: 30px;
            max-height: 500px;
            overflow-y: auto;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #00ffff;
            font-weight: 500;
            font-size: 14px;
        }
        
        .form-group input, .form-group select {
            width: 100%;
            padding: 12px;
            border: 1px solid rgba(0, 255, 255, 0.3);
            background: rgba(10, 10, 10, 0.8);
            color: #e0e0e0;
            border-radius: 6px;
            font-size: 14px;
            font-family: "Inter", sans-serif;
            transition: all 0.3s ease;
        }
        
        .form-group input:focus, .form-group select:focus {
            outline: none;
            border-color: #00ffff;
            box-shadow: 0 0 0 2px rgba(0, 255, 255, 0.1), 0 0 10px rgba(0, 255, 255, 0.3);
        }
        
        .form-group small {
            color: rgba(224, 224, 224, 0.6);
            font-size: 12px;
            display: block;
            margin-top: 5px;
        }
        
        .error-message {
            background: rgba(255, 0, 102, 0.1);
            color: #ff0066;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 20px;
            border-left: 4px solid #ff0066;
            font-size: 14px;
        }
        
        .btn {
            width: 100%;
            padding: 12px;
            background: rgba(0, 255, 255, 0.1);
            color: #00ffff;
            border: 1px solid rgba(0, 255, 255, 0.4);
            border-radius: 6px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            box-shadow: 0 0 10px rgba(0, 255, 255, 0.2);
        }
        
        .btn:hover {
            background: rgba(0, 255, 255, 0.2);
            border-color: #00ffff;
            box-shadow: 0 0 20px rgba(0, 255, 255, 0.4);
            transform: translateY(-2px);
        }
        
        .register-footer {
            text-align: center;
            padding: 20px 30px 30px;
            color: rgba(224, 224, 224, 0.6);
            background: rgba(0, 0, 0, 0.3);
            border-top: 1px solid rgba(0, 255, 255, 0.1);
        }
        
        .register-footer a {
            color: #00ffff;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .register-footer a:hover {
            color: #ff0066;
            text-shadow: 0 0 8px rgba(255, 0, 102, 0.6);
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="register-header">
            <h1>🎮 Join the Adventure!</h1>
            <p>Create your account to get started</p>
        </div>
        
        <div class="register-body">
            <?php if (isset($error)): ?>
                <div class="error-message">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>
            
            <form method="POST" action="<?= site_url('auth/register') ?>">
                <div class="form-group">
                    <label for="username">⚔️ Username *</label>
                    <input type="text" id="username" name="username" required autofocus placeholder="Enter your username">
                </div>
                
                <div class="form-group">
                    <label for="email">📧 Email *</label>
                    <input type="email" id="email" name="email" required placeholder="your@email.com">
                </div>
                
                <div class="form-group">
                    <label for="password">🔒 Password *</label>
                    <input type="password" id="password" name="password" required minlength="6" placeholder="At least 6 characters">
                    <small>At least 6 characters</small>
                </div>
                
                <div class="form-group">
                    <label for="confirm_password">🔐 Confirm Password *</label>
                    <input type="password" id="confirm_password" name="confirm_password" required minlength="6" placeholder="Re-enter your password">
                </div>
                
                <div class="form-group">
                    <label for="class">🎯 Class</label>
                    <select id="class" name="class">
                        <option value="warrior">⚔️ Warrior</option>
                        <option value="ranger">🏹 Ranger</option>
                        <option value="mage">🔮 Mage</option>
                        <option value="summoner">✨ Summoner</option>
                        <option value="adventurer" selected>🌟 Adventurer</option>
                    </select>
                </div>
                
                <button type="submit" class="btn">⚡ Create Account</button>
            </form>
        </div>
        
        <div class="register-footer">
            Already have an account? <a href="<?= site_url('auth/login') ?>">Login here</a>
        </div>
    </div>
</body>
</html>
