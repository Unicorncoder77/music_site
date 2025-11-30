<?php 
//session_start();

if (session_status() === PHP_SESSION_NONE){
    session_start();
}
?>

<header>
    
            <h1> The Experience</h1>
<!-- Navigation bars must be linked properly-->
            <nav class="homeNav" id="navigation-bar">
                <a href="index.php">Home</a>
                <a href="#">About</a>
                <a href="articles.php">Articles</a>
                <a href="review.php">Reviews</a>
                <a href="#">Contact</a>
                <?php if (isset($_SESSION['user'])): ?>
                    <a href="dashboard.php">Dashboard </a>
                    <a href="logout.php">Logout</a>
                <?php elseif(isset($_SESSION['creator'])): ?>
                    <a href="creatorDashboard.php">Dashboard </a>
                    <a href="logout.php">Logout</a>
                <?php else: ?>
                    <a href="loginPage.php">Login</a>
                <?php endif; ?>
                
             
                <div class="search">
<!-- Add actual action to the form-->
                        <form action="#">
                                <input type="text" placeholder="Search" name="search">
                                <button type="submit">
                                        <i class="fa fa-search"></i>
                                </button>
                        </form>
                </div>
<!-- Add a search feature soon-->


                <div class="settings">
                <button class="darkModeToggle" onclick="darkModeToggle()">
                        <i class="fa fa-moon-o fa-2x"></i>
                </button>
                </div>
            </nav>

        </header>