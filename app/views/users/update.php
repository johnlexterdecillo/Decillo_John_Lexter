<!DOCTYPE html>
<html>
<head>
    <title>Update User Profile</title>
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
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .container {
            width: 100%;
            max-width: 500px;
        }

        .card {
            background: rgba(15, 15, 15, 0.9);
            border: 1px solid rgba(0, 255, 255, 0.3);
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.6);
        }

        .card-header {
            padding: 2rem 2rem 1rem;
            text-align: center;
            border-bottom: 1px solid rgba(0, 255, 255, 0.2);
            background: rgba(0, 255, 255, 0.02);
        }

        .card-title {
            color: #ff0066;
            font-family: "JetBrains Mono", monospace;
            font-weight: 600;
            font-size: 1.75rem;
            text-shadow: 0 0 15px rgba(255, 0, 102, 0.5);
            letter-spacing: 1px;
            margin: 0;
        }

        .card-body {
            padding: 2rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group:last-of-type {
            margin-bottom: 2rem;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            color: #00ffff;
            font-weight: 500;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        input[type="text"],
        input[type="email"] {
            width: 100%;
            padding: 1rem 1.25rem;
            border: 1px solid rgba(0, 255, 255, 0.3);
            background: rgba(10, 10, 10, 0.8);
            color: #e0e0e0;
            font-family: "Inter", sans-serif;
            font-size: 1rem;
            border-radius: 6px;
            transition: all 0.3s ease;
            outline: none;
        }

        input[type="text"]:focus,
        input[type="email"]:focus {
            border-color: #00ffff;
            box-shadow: 0 0 0 2px rgba(0, 255, 255, 0.1), 0 0 15px rgba(0, 255, 255, 0.3);
        }

        input[type="text"]::placeholder,
        input[type="email"]::placeholder {
            color: rgba(224, 224, 224, 0.4);
        }

        .actions {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.875rem 2rem;
            font-size: 0.95rem;
            font-weight: 500;
            font-family: "Inter", sans-serif;
            text-decoration: none;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            min-width: 140px;
            justify-content: center;
        }

        .btn-primary {
            background: rgba(0, 255, 255, 0.1);
            color: #00ffff;
            border: 1px solid rgba(0, 255, 255, 0.4);
            box-shadow: 0 0 15px rgba(0, 255, 255, 0.2);
        }

        .btn-primary:hover {
            background: rgba(0, 255, 255, 0.2);
            border-color: #00ffff;
            box-shadow: 0 0 25px rgba(0, 255, 255, 0.4);
            transform: translateY(-2px);
        }

        .btn-secondary {
            background: rgba(255, 0, 102, 0.1);
            color: #ff0066;
            border: 1px solid rgba(255, 0, 102, 0.4);
            box-shadow: 0 0 15px rgba(255, 0, 102, 0.2);
        }

        .btn-secondary:hover {
            background: rgba(255, 0, 102, 0.2);
            border-color: #ff0066;
            box-shadow: 0 0 25px rgba(255, 0, 102, 0.4);
            transform: translateY(-2px);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            body {
                padding: 1rem;
            }

            .card-title {
                font-size: 1.5rem;
            }

            .card-header,
            .card-body {
                padding: 1.5rem;
            }

            .actions {
                flex-direction: column;
                align-items: stretch;
            }

            .btn {
                min-width: auto;
            }
        }

        @media (max-width: 480px) {
            body {
                padding: 0.5rem;
            }

            .card {
                border-radius: 6px;
            }

            .card-header,
            .card-body {
                padding: 1rem;
            }

            .card-title {
                font-size: 1.25rem;
                letter-spacing: 0.5px;
            }
        }
   * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            background: #0a0a0a;
            color: #e0e0e0;
            font-family: "Inter", sans-serif;
            min-height: 100vh;
            line-height: 1.6;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }
        .container { width: 100%; max-width: 500px; }
        .card {
            background: rgba(15, 15, 15, 0.9);
            border: 1px solid rgba(0, 255, 255, 0.3);
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.6);
        }
        .card-header {
            padding: 2rem 2rem 1rem;
            text-align: center;
            border-bottom: 1px solid rgba(0, 255, 255, 0.2);
            background: rgba(0, 255, 255, 0.02);
        }
        .card-title {
            color: #ff0066;
            font-family: "JetBrains Mono", monospace;
            font-weight: 600;
            font-size: 1.75rem;
            text-shadow: 0 0 15px rgba(255, 0, 102, 0.5);
            letter-spacing: 1px;
            margin: 0;
        }
        .card-body { padding: 2rem; }
        .form-group { margin-bottom: 1.5rem; }
        .form-group:last-of-type { margin-bottom: 2rem; }
        label {
            display: block; margin-bottom: 0.5rem;
            color: #00ffff; font-weight: 500;
            font-size: 0.9rem; text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        input[type="text"], input[type="email"], select {
            width: 100%; padding: 1rem 1.25rem;
            border: 1px solid rgba(0, 255, 255, 0.3);
            background: rgba(10, 10, 10, 0.8);
            color: #e0e0e0; font-family: "Inter", sans-serif;
            font-size: 1rem; border-radius: 6px;
            transition: all 0.3s ease; outline: none;
        }
        input[type="text"]:focus, input[type="email"]:focus, select:focus {
            border-color: #00ffff;
            box-shadow: 0 0 0 2px rgba(0, 255, 255, 0.1), 0 0 15px rgba(0, 255, 255, 0.3);
        }
        /* avatar upload styles removed */
        .actions {
            display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;
        }
        .btn {
            display: inline-flex; align-items: center; gap: 0.5rem;
            padding: 0.875rem 2rem; font-size: 0.95rem; font-weight: 500;
            font-family: "Inter", sans-serif; text-decoration: none;
            border: none; border-radius: 6px; cursor: pointer;
            transition: all 0.3s ease; text-transform: uppercase;
            letter-spacing: 0.5px; min-width: 140px; justify-content: center;
        }
        .btn-primary {
            background: rgba(0, 255, 255, 0.1);
            color: #00ffff; border: 1px solid rgba(0, 255, 255, 0.4);
            box-shadow: 0 0 15px rgba(0, 255, 255, 0.2);
        }
        .btn-primary:hover {
            background: rgba(0, 255, 255, 0.2);
            border-color: #00ffff;
            box-shadow: 0 0 25px rgba(0, 255, 255, 0.4);
            transform: translateY(-2px);
        }
        .btn-secondary {
            background: rgba(255, 0, 102, 0.1);
            color: #ff0066; border: 1px solid rgba(255, 0, 102, 0.4);
            box-shadow: 0 0 15px rgba(255, 0, 102, 0.2);
        }
        .btn-secondary:hover {
            background: rgba(255, 0, 102, 0.2);
            border-color: #ff0066;
            box-shadow: 0 0 25px rgba(255, 0, 102, 0.4);
            transform: translateY(-2px);
        }
    </style>
</head>
<body>
<div class="container">
    <div class="card">
        <div class="card-header">
            <h1 class="card-title">⚙️ Update Adventurer Profile</h1>
        </div>
        <div class="card-body">
            <form action="<?= site_url('users/update/' . $user['id']) ?>" method="POST">
                <div class="form-group">
                    <label for="username">🏷️ Adventurer Name</label>
                    <input type="text" name="username" id="username" value="<?= $user['username'] ?>" required>
                </div>
                <div class="form-group">
                    <label for="email">📬 Contact Crystal</label>
                    <input type="email" name="email" id="email" value="<?= $user['email'] ?>" required>
                </div>
                <div class="form-group">
                    <label for="class">🧪 Class Type</label>
                    <select name="class" id="class" required>
                        <option value="Warrior" <?= $user['class']=='Warrior'?'selected':'' ?>>Warrior</option>
                        <option value="Mage" <?= $user['class']=='Mage'?'selected':'' ?>>Mage</option>
                        <option value="Rogue" <?= $user['class']=='Rogue'?'selected':'' ?>>Rogue</option>
                        <option value="Summoner" <?= $user['class']=='Summoner'?'selected':'' ?>>Summoner</option>
                        <option value="Tank" <?= $user['class']=='Tank'?'selected':'' ?>>Tank</option>
                        <option value="Scout" <?= $user['class']=='Scout'?'selected':'' ?>>Scout</option>
                        <option value="Paladin" <?= $user['class']=='Paladin'?'selected':'' ?>>Paladin</option>
                        <option value="Cryomancer" <?= $user['class']=='Cryomancer'?'selected':'' ?>>Cryomancer</option>
                        <option value="Technomancer" <?= $user['class']=='Technomancer'?'selected':'' ?>>Technomancer</option>
                        <option value="Berserker" <?= $user['class']=='Berserker'?'selected':'' ?>>Berserker</option>
                        <option value="Sniper" <?= $user['class']=='Sniper'?'selected':'' ?>>Sniper</option>
                    </select>
                </div>
                <div class="actions">
                    <button type="submit" class="btn btn-primary">💾 Save Profile</button>
                    <a href="<?= site_url('users/view') ?>" class="btn btn-secondary">⬅ Back to World</a>
                </div>
            </form>
        </div>
    </div>
</div>