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
    </style>
</head>
<body>
    <div class="container">
        <h1>Terraria Players</h1>

        <div class="actions">
            <form method="get" action="<?= site_url('users/view'); ?>" class="search-form">
                <input type="text" name="q"
                       value="<?= isset($_GET['q']) ? htmlspecialchars($_GET['q']) : '' ?>"
                       placeholder="Search users...">
                <button type="submit" class="btn btn-primary">Search</button>
            </form>

            <?php if (!empty($_GET['q'])): ?>
                <a href="<?= site_url('users/view'); ?>" class="btn btn-secondary">Back</a>
            <?php else: ?>
                <a href="<?= site_url('users/create'); ?>" class="btn btn-primary">New Player</a>
            <?php endif; ?>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($users)): ?>
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td><?= htmlspecialchars($user['id']); ?></td>
                                <td><?= htmlspecialchars($user['username']); ?></td>
                                <td><?= htmlspecialchars($user['email']); ?></td>
                                <td>
                                    <a href="<?= site_url('users/update/' . $user['id']); ?>">Edit</a>
                                    <span style="color: rgba(224, 224, 224, 0.3); margin: 0 0.5rem;">|</span>
                                    <a href="<?= site_url('users/delete/' . $user['id']); ?>">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="no-data">No adventurers found in this world 🌍</td>
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