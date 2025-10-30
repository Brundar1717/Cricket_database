
<!-- navbar.php -->
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Reset and main styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        /* Header and navigation styles */
        .site-header {
            background: linear-gradient(90deg, #0a192f, #172a46);
            color: white;
            padding: 15px 0;
            box-shadow: 0 2px 15px rgba(0,0,0,0.2);
            position: sticky;
            top: 0;
            z-index: 100;
        }
        
        .header-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
        }
        
        .logo {
            display: flex;
            align-items: center;
            font-size: 24px;
            font-weight: 700;
        }
        
        .logo span {
            margin-left: 8px;
        }
        
        .nav-links {
            display: flex;
            list-style: none;
        }
        
        .nav-links li {
            margin: 0 5px;
        }
        
        .nav-links a {
            color: #ecf0f1;
            text-decoration: none;
            font-size: 16px;
            font-weight: 500;
            padding: 8px 15px;
            border-radius: 6px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
        }
        
        .nav-links a:hover {
            background-color: #3498db;
            color: white;
            transform: translateY(-2px);
        }
        
        .nav-links a.active {
            background-color: #3498db;
            color: white;
        }
        
        .icon {
            margin-right: 8px;
        }
        
        /* Mobile menu button */
        .menu-btn {
            display: none;
            background: none;
            border: none;
            font-size: 24px;
            color: white;
            cursor: pointer;
        }
        
        /* Responsive styles */
        @media screen and (max-width: 768px) {
            .menu-btn {
                display: block;
            }
            
            .nav-links {
                position: absolute;
                top: 70px;
                left: 0;
                width: 100%;
                background: #0a192f;
                flex-direction: column;
                align-items: center;
                padding: 20px 0;
                box-shadow: 0 10px 15px rgba(0,0,0,0.1);
                clip-path: polygon(0 0, 100% 0, 100% 0, 0 0);
                transition: clip-path 0.4s ease;
            }
            
            .nav-links.show {
                clip-path: polygon(0 0, 100% 0, 100% 100%, 0 100%);
            }
            
            .nav-links li {
                margin: 15px 0;
                width: 80%;
            }
            
            .nav-links a {
                width: 100%;
                text-align: center;
                padding: 12px;
            }
        }
    </style>
</head>
<body>
    <header class="site-header">
        <div class="header-container">
            <div class="logo">
                🏏 <span>Cricket Tracker</span>
            </div>
            
            <button class="menu-btn">☰</button>
            
            <ul class="nav-links" id="navLinks">
                <li><a href="teams.php" <?php echo basename($_SERVER['PHP_SELF']) == 'teams.php' ? 'class="active"' : ''; ?>>
                    <span class="icon">🏠</span> Home
                </a></li>
                <li><a href="points_table.php" <?php echo basename($_SERVER['PHP_SELF']) == 'points_table.php' ? 'class="active"' : ''; ?>>
                    <span class="icon">📊</span> Points Table
                </a></li>
                <li><a href="matches.php" <?php echo basename($_SERVER['PHP_SELF']) == 'matches.php' ? 'class="active"' : ''; ?>>
                    <span class="icon">🗓️</span> Matches
                </a></li>
            </ul>
        </div>
    </header>
    
    <script>
        // Mobile menu functionality
        const menuBtn = document.querySelector('.menu-btn');
        const navLinks = document.querySelector('.nav-links');
        
        menuBtn.addEventListener('click', () => {
            navLinks.classList.toggle('show');
        });
    </script>
</body>
</html>