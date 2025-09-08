<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome to LavaLust - Terraria Edition</title>
    <link rel="shortcut icon" href="data:image/x-icon;," type="image/x-icon">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap');
        
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Press Start 2P', monospace;
            background: #1a1a2e;
            background-image: 
                radial-gradient(circle at 20% 80%, #16213e 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, #0f3460 0%, transparent 50%),
                radial-gradient(circle at 40% 40%, #533483 0%, transparent 50%);
            color: #e94560;
            image-rendering: pixelated;
            image-rendering: -moz-crisp-edges;
            image-rendering: crisp-edges;
        }

        .terraria-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
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
            pointer-events: none;
            z-index: -1;
        }

        .container {
            max-width: 1000px;
            margin: 2rem auto;
            background: #0f0f23;
            border: 4px solid #e94560;
            border-radius: 0;
            box-shadow: 
                0 0 0 2px #f39c12,
                0 0 0 6px #e94560,
                0 0 20px rgba(233, 69, 96, 0.3);
            overflow: hidden;
            position: relative;
        }

        .container::before {
            content: '';
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            background: linear-gradient(45deg, #e94560, #f39c12, #e94560, #f39c12);
            z-index: -1;
            animation: borderGlow 3s ease-in-out infinite alternate;
        }

        .header {
            background: linear-gradient(135deg, #e94560 0%, #c0392b 50%, #8e44ad 100%);
            color: #ffffff;
            padding: 2rem;
            text-align: center;
            position: relative;
            border-bottom: 4px solid #f39c12;
        }

        .header::before {
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

        .header h1 {
            margin: 0;
            font-size: 2rem;
            text-shadow: 3px 3px 0px #8e44ad, 6px 6px 0px #2c3e50;
            animation: titleGlow 2s ease-in-out infinite alternate;
        }

        .header p {
            margin: 1rem 0 0 0;
            font-size: 0.8rem;
            text-shadow: 2px 2px 0px #2c3e50;
        }

        .main {
            padding: 2rem;
            background: #0f0f23;
        }

        h2 {
            color: #f39c12;
            margin-top: 2rem;
            font-size: 1.2rem;
            text-shadow: 2px 2px 0px #8e44ad;
            border-bottom: 2px solid #e94560;
            padding-bottom: 0.5rem;
        }

        p {
            line-height: 1.8;
            margin-bottom: 1.5rem;
            font-size: 0.7rem;
            color: #ecf0f1;
        }

        code, pre {
            display: block;
            background: #2c3e50;
            padding: 1rem;
            border: 2px solid #e94560;
            margin-bottom: 1rem;
            font-size: 0.6rem;
            color: #f39c12;
            overflow-x: auto;
            font-family: 'Press Start 2P', monospace;
            box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.5);
        }

        ul {
            padding-left: 1.5rem;
            margin-bottom: 1rem;
        }

        li {
            margin-bottom: 0.8rem;
            font-size: 0.7rem;
            color: #ecf0f1;
        }

        a {
            color: #f39c12;
            text-decoration: none;
            transition: all 0.3s ease;
            text-shadow: 1px 1px 0px #8e44ad;
        }

        a:hover {
            color: #e94560;
            text-shadow: 2px 2px 0px #8e44ad;
            transform: translateY(-1px);
        }

        .footer {
            font-size: 0.6rem;
            text-align: center;
            padding: 1rem;
            background: #2c3e50;
            border-top: 4px solid #e94560;
            color: #ecf0f1;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
            margin: 2rem 0;
        }

        .card {
            background: #2c3e50;
            padding: 1.5rem;
            border: 2px solid #e94560;
            border-radius: 0;
            position: relative;
            transition: all 0.3s ease;
            box-shadow: 0 4px 0px #8e44ad;
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 0px #8e44ad, 0 0 15px rgba(233, 69, 96, 0.3);
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
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .card:hover::before {
            opacity: 1;
        }

        .card h3 {
            margin-top: 0;
            color: #f39c12;
            font-size: 0.8rem;
            text-shadow: 1px 1px 0px #8e44ad;
        }

        .pixel-border {
            border-style: solid;
            border-width: 2px;
            border-image: 
                linear-gradient(45deg, #e94560, #f39c12, #8e44ad) 1;
        }

        @keyframes borderGlow {
            0% { opacity: 0.7; }
            100% { opacity: 1; }
        }

        @keyframes titleGlow {
            0% { text-shadow: 3px 3px 0px #8e44ad, 6px 6px 0px #2c3e50; }
            100% { text-shadow: 3px 3px 0px #8e44ad, 6px 6px 0px #2c3e50, 0 0 10px #f39c12; }
        }

        .terraria-button {
            display: inline-block;
            padding: 12px 24px;
            background: linear-gradient(135deg, #e94560 0%, #c0392b 100%);
            color: white;
            text-decoration: none;
            border: 2px solid #f39c12;
            font-family: 'Press Start 2P', monospace;
            font-size: 0.6rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 0px #8e44ad;
            text-shadow: 1px 1px 0px #2c3e50;
        }

        .terraria-button:hover {
            background: linear-gradient(135deg, #c0392b 0%, #a93226 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 0px #8e44ad;
        }

        .terraria-button:active {
            transform: translateY(0);
            box-shadow: 0 2px 0px #8e44ad;
        }
    </style>
</head>
<body>
    <div class="terraria-bg"></div>
    <div class="container">
        <div class="header">
            <h1>⚔️ LavaLust Framework</h1>
            <p>Pixel Perfect • Blocky • MVC for Terraria Developers</p>
        </div>

        <div class="main">
            <h2>What is LavaLust?</h2>
            <p><strong>LavaLust</strong> is a pixelated PHP framework that follows the MVC (Model–View–Controller) pattern. It's designed for developers who want a structured yet blocky PHP development experience, just like building in Terraria!</p>

            <h2>⚔️ Key Features</h2>
            <div class="grid">
                <div class="card">
                    <h3>🧠 MVC Architecture</h3>
                    <p>Clear separation of concerns with Models, Views, and Controllers - like organizing your Terraria inventory!</p>
                </div>
                <div class="card">
                    <h3>⚙️ Built-in Routing</h3>
                    <p>Clean and flexible routing system - navigate your app like exploring Terraria biomes!</p>
                </div>
                <div class="card">
                    <h3>📦 Libraries & Helpers</h3>
                    <p>Includes utilities for sessions, forms, database, validation - your digital Terraria toolbox!</p>
                </div>
                <div class="card">
                    <h3>📁 Organized Structure</h3>
                    <p>Modular folder structure for scalable app development - build your code like a Terraria base!</p>
                </div>
                <div class="card">
                    <h3>🔗 REST API Support</h3>
                    <p>Build robust RESTful APIs easily - connect your Terraria world to the digital realm!</p>
                </div>
                <div class="card">
                    <h3>📘 ORM-like Models</h3>
                    <p>Use LavaLust's model layer for structured database operations - manage data like Terraria items!</p>
                </div>
            </div>

            <h2>🏗️ Project Structure</h2>
            <pre><code>
/app
  /config      // Your world settings
  /controllers // Your NPCs and bosses
  /helpers     // Your tools and weapons
  /language    // Your dialogue system
  /libraries   // Your magic spells
  /models      // Your items and blocks
  /views       // Your world tiles
/console       // Your command center
/public        // Your public area
/runtime       // Your temporary storage
/scheme        // Your world generation
            </code></pre>

            <h2>⚡ Quick Example</h2>
                <p>Route in <code>app/config/routes.php</code></p>
<pre><code>
$router->get('/', 'Welcome::index');
</code></pre>
            <p>Controller method in <code>app/controllers/Welcome.php</code>:</p>
            <pre><code>
class Welcome extends Controller {
    public function index() {
        $this->call->view('welcome_page');
    }
}
            </code></pre>

            <p>View file at: <code>app/Views/welcome_page.php</code></p>

            <h2>📚 Learn More</h2>
            <ul>
                <li><a href="https://github.com/ronmarasigan/LavaLust" class="terraria-button">GitHub Repository</a></li>
                <li><a href="https://lavalust.netlify.app/" class="terraria-button">Official Documentation</a></li>
            </ul>
        </div>

        <div class="footer">
            Page rendered in <strong><?php echo lava_instance()->performance->elapsed_time('lavalust'); ?></strong> seconds.
            Memory usage: <?php echo lava_instance()->performance->memory_usage(); ?>.
            <?php if(config_item('ENVIRONMENT') === 'development'): ?>
                <br>LavaLust Version <strong><?php echo config_item('VERSION'); ?></strong>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
