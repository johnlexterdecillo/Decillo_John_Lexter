<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Terraria Adventurers</title>
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
        
        .login-container {
            background: rgba(15, 15, 15, 0.95);
            border: 1px solid rgba(0, 255, 255, 0.2);
            border-radius: 10px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.5);
            overflow: hidden;
            width: 100%;
            max-width: 400px;
        }
        
        .login-header {
            background: rgba(0, 255, 255, 0.05);
            border-bottom: 1px solid rgba(0, 255, 255, 0.2);
            color: #00ffff;
            padding: 30px;
            text-align: center;
        }
        
        .login-header h1 {
            font-family: "JetBrains Mono", monospace;
            font-size: 28px;
            margin-bottom: 10px;
            text-shadow: 0 0 15px rgba(0, 255, 255, 0.5);
            letter-spacing: 2px;
        }
        
        .login-header p {
            opacity: 0.8;
            font-size: 14px;
            color: #e0e0e0;
        }
        
        .login-body {
            padding: 30px;
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
        
        .form-group input {
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
        
        .form-group input:focus {
            outline: none;
            border-color: #00ffff;
            box-shadow: 0 0 0 2px rgba(0, 255, 255, 0.1), 0 0 10px rgba(0, 255, 255, 0.3);
        }
        
        .remember-me {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            color: rgba(224, 224, 224, 0.8);
        }
        
        .remember-me input[type="checkbox"] {
            width: auto;
            margin-right: 8px;
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
        
        .success-message {
            background: rgba(0, 255, 102, 0.1);
            color: #00ff66;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 20px;
            border-left: 4px solid #00ff66;
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
        
        .login-footer {
            text-align: center;
            padding: 20px 30px 30px;
            color: rgba(224, 224, 224, 0.6);
            background: rgba(0, 0, 0, 0.3);
            border-top: 1px solid rgba(0, 255, 255, 0.1);
        }
        
        .login-footer a {
            color: #00ffff;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .login-footer a:hover {
            color: #ff0066;
            text-shadow: 0 0 8px rgba(255, 0, 102, 0.6);
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <h1>⚔️ Welcome Back!</h1>
            <p>Login to continue your adventure</p>
        </div>
        
        <div class="login-body">
            <?php if (isset($error)): ?>
                <div class="error-message">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>
            
            <?php if (isset($success)): ?>
                <div class="success-message">
                    <?= htmlspecialchars($success) ?>
                </div>
            <?php endif; ?>
            
            <form method="POST" action="<?= site_url('auth/login') ?>">
                <div class="form-group">
                    <label for="username">👤 Username or Email</label>
                    <input type="text" id="username" name="username" required autofocus placeholder="Enter your username or email">
                </div>
                
                <div class="form-group">
                    <label for="password">🔒 Password</label>
                    <input type="password" id="password" name="password" required placeholder="Enter your password">
                </div>
                
                <div class="remember-me">
                    <input type="checkbox" id="remember" name="remember" value="1">
                    <label for="remember">Remember me</label>
                </div>
                
                <button type="submit" class="btn">⚡ Login</button>
            </form>
        </div>
        
        <div class="login-footer">
            Don't have an account? <a href="<?= site_url('auth/register') ?>">Register here</a>
        </div>
    </div>
</body>
</html>
