<!DOCTYPE html>
<html>
<head>
    <title>Delete User Profile</title>
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
            border: 1px solid rgba(255, 0, 102, 0.4);
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 8px 32px rgba(255, 0, 102, 0.15);
        }

        .card-header {
            padding: 2rem 2rem 1rem;
            text-align: center;
            border-bottom: 1px solid rgba(255, 0, 102, 0.2);
            background: rgba(255, 0, 102, 0.03);
        }

        .card-title {
            color: #ff0066;
            font-family: "JetBrains Mono", monospace;
            font-weight: 600;
            font-size: 1.75rem;
            text-shadow: 0 0 15px rgba(255, 0, 102, 0.6);
            letter-spacing: 1px;
            margin: 0;
        }

        .card-body {
            padding: 2rem;
            text-align: center;
        }

        .warning-message {
            background: rgba(255, 0, 102, 0.08);
            border: 1px solid rgba(255, 0, 102, 0.3);
            border-radius: 6px;
            padding: 1.5rem;
            margin-bottom: 2rem;
        }

        .warning-text {
            color: #e0e0e0;
            font-size: 1.1rem;
            line-height: 1.6;
            margin-bottom: 1rem;
        }

        .user-details {
            color: #ff0066;
            font-family: "JetBrains Mono", monospace;
            font-weight: 500;
            font-size: 1rem;
            text-shadow: 0 0 8px rgba(255, 0, 102, 0.4);
            margin: 0.5rem 0;
        }

        .warning-note {
            color: rgba(224, 224, 224, 0.7);
            font-size: 0.9rem;
            font-style: italic;
            margin-top: 1rem;
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

        .btn-danger {
            background: rgba(255, 0, 102, 0.15);
            color: #ff0066;
            border: 1px solid rgba(255, 0, 102, 0.5);
            box-shadow: 0 0 15px rgba(255, 0, 102, 0.2);
        }

        .btn-danger:hover {
            background: rgba(255, 0, 102, 0.25);
            border-color: #ff0066;
            box-shadow: 0 0 25px rgba(255, 0, 102, 0.4);
            transform: translateY(-2px);
        }

        .btn-secondary {
            background: rgba(0, 255, 255, 0.1);
            color: #00ffff;
            border: 1px solid rgba(0, 255, 255, 0.4);
            box-shadow: 0 0 15px rgba(0, 255, 255, 0.2);
        }

        .btn-secondary:hover {
            background: rgba(0, 255, 255, 0.2);
            border-color: #00ffff;
            box-shadow: 0 0 25px rgba(0, 255, 255, 0.4);
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

            .warning-message {
                padding: 1.25rem;
            }

            .warning-text {
                font-size: 1rem;
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

            .warning-message {
                padding: 1rem;
            }

            .warning-text {
                font-size: 0.95rem;
            }

            .user-details {
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h1 class="card-title">🗑️ Remove Adventurer</h1>
            </div>
            <div class="card-body">
                <div class="warning-message">
                    <div class="warning-text">
                        You are about to permanently remove this adventurer from the world:
                    </div>
                    <div class="user-details">
                        🏷️ <?= htmlspecialchars($user['username']); ?>
                    </div>
                    <div class="user-details" style="font-size: 0.9rem; opacity: 0.8;">
                        📬 <?= htmlspecialchars($user['email']); ?>
                    </div>
                    <div class="warning-note">
                        This action cannot be undone. The adventurer will be lost forever.
                    </div>
                </div>
                <form action="<?= site_url('users/delete/' . $user['id']) ?>" method="POST">
                    <div class="actions">
                        <button type="submit" class="btn btn-danger">💀 Remove from World</button>
                        <a href="<?= site_url('users/view') ?>" class="btn btn-secondary">⬅ Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>