<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
/**
 * ------------------------------------------------------------------
 * LavaLust - an opensource lightweight PHP MVC Framework
 * ------------------------------------------------------------------
 *
 * MIT License
 * 
 * Copyright (c) 2020 Ronald M. Marasigan
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package LavaLust
 * @author Ronald M. Marasigan <ronald.marasigan@yahoo.com>
 * @copyright Copyright 2020 (https://techron.info)
 * @since Version 1
 * @link https://lavalust.com
 * @license https://opensource.org/licenses/MIT MIT License
 */

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Error Encountered - Terraria World</title>
	<style type="text/css">
		@import url('https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap');

		*{
		    transition: all 0.6s;
		    box-sizing: border-box;
		}

		html {
		    height: 100%;
		}

		body{
		    font-family: 'Press Start 2P', monospace;
		    color: #e94560;
		    margin: 0;
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

		#main{
		    display: table;
		    width: 100%;
		    height: 100vh;
		    text-align: center;
		}

		.fof{
			  display: table-cell;
			  vertical-align: middle;
			  position: relative;
		}

		.fof h1{
			  font-size: 2.5rem;
			  display: inline-block;
			  padding: 20px;
			  margin: 20px;
			  color: #f39c12;
			  text-shadow: 
			      3px 3px 0px #8e44ad, 
			      6px 6px 0px #2c3e50,
			      0 0 20px rgba(243, 156, 18, 0.5);
			  animation: type .5s alternate infinite, glow 2s ease-in-out infinite alternate;
			  border: 4px solid #e94560;
			  background: #0f0f23;
			  box-shadow: 
			      0 0 0 2px #f39c12,
			      0 0 0 6px #e94560,
			      0 0 20px rgba(233, 69, 96, 0.3);
		}

		.fof p {
		    color: #ecf0f1;
		    font-size: 0.7rem;
		    margin-top: 2rem;
		    text-shadow: 1px 1px 0px #8e44ad;
		    max-width: 600px;
		    margin-left: auto;
		    margin-right: auto;
		}

		.terraria-button {
		    display: inline-block;
		    padding: 16px 32px;
		    margin-top: 2rem;
		    background: linear-gradient(135deg, #e94560 0%, #c0392b 100%);
		    color: white;
		    text-decoration: none;
		    border: 3px solid #f39c12;
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

		@keyframes type{
			  from{box-shadow: 
			      0 0 0 2px #f39c12,
			      0 0 0 6px #e94560,
			      0 0 20px rgba(233, 69, 96, 0.3),
			      inset -3px 0px 0px #f39c12;}
			  to{box-shadow: 
			      0 0 0 2px #f39c12,
			      0 0 0 6px #e94560,
			      0 0 20px rgba(233, 69, 96, 0.3),
			      inset -3px 0px 0px transparent;}
		}

		@keyframes glow {
		    0% { 
		        text-shadow: 
		            3px 3px 0px #8e44ad, 
		            6px 6px 0px #2c3e50,
		            0 0 20px rgba(243, 156, 18, 0.5);
		    }
		    100% { 
		        text-shadow: 
		            3px 3px 0px #8e44ad, 
		            6px 6px 0px #2c3e50,
		            0 0 30px rgba(243, 156, 18, 0.8),
		            0 0 40px rgba(233, 69, 96, 0.3);
		    }
		}
	</style>
</head>
<body>
	<div class="terraria-bg"></div>
	<div id="main">
    	<div class="fof">
	        <h1>💥 <?php echo $heading; ?></h1>
	        <p><?php echo $message; ?></p>
	        <p>Something went wrong in the Terraria world!</p>
	        <a href="<?= site_url() ?>" class="terraria-button">🏠 Return to Base</a>
    	</div>
	</div>
</body>
</html>