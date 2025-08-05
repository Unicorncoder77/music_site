<?php


session_start();
//$user = $_SESSION['user'];



/*if(isset($_SESSION['user'])){
    print ("Welcome back ");
}
else {
    print("Hey you're not logged in!");
}*/
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> The Experience Home </title>
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">

   </head>
    <body>
        <script src="script.js"> </script>
        <header>
            <h1> The Experience</h1>
<!-- Navigation bars must be linked properly-->
            <nav class="homeNav" id="navigation-bar">
                <a href="index.php">Home</a>
                <a href="#">About</a>
                <a href="#">Articles</a>
                <a href="#">Reviews</a>
                <a href="#">Contact</a>
                <?php if (isset($_SESSION['user'])): ?>
                    <a href="dashboard.php">Dashboard </a>
                    <a href="logout.php">Logout</a>
                <?php else: ?>
                    <a href="loginPage.php">Login</a>
                <?php endif; ?>
                <?php if (isset($_SESSION['creator'])): ?>
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

<!-- If I still like the vine idea, add vines here-->

    <section class="mission">
        <h2> Are you Experienced? - Jimi Hendrix</h2>
        <p> Do you wish to have access to a site where you can read reviews on different songs?
            Well, welcome to The Experience! The Experience is a site that allows those to create, read,
            or learn something new about your favorite music!
        </p>
    </section>

    <section class="articles">
        <h2> Our Featured Articles</h2>
        <div class="article-grid">
          <div class="article-card">
                <h3> From The Grammy's To Gag City </h3>
                <p>
                    Nicki Minaj is often seen as a legend in her own right.
                    She kicked in the door that was unlocked for her to open by her predecessors.
                    Her creativity and flow within the scene was something new and exciting that many could endorse and support.
                </p>


<!-- Links will not work for read more-->

                    <div class="article-card-read">
                    <p>
                        Female rappers like Doja Cat have stated Nicki Minaj as her direct inspiration with many songs paying homage to her in some capacity.
                        Especially in “Get into it Yuh” where she emulates a flow Nicki Minaj had used in the past with the song “Massive Attack” (Chris Mench, 2021).
                    </p>
                <!-- Make a button to go to the article page -->

                    </div>
                    <button class="readMore">Read More</button>
                </div>
                <div class="article-card">
                <h3> The Evolution of the 808 Beat</h3>
                <p>
                    It is a beat nearly as old as hip-hop itself.
                    The 808 beat is a beat that is as classic as the songs that they are tied to.
                    The 808 has been transformed into something that many different genres use to convey a specific sound but it has stayed overall synonymous with Hip-Hop.
                </p>
                <a href="#"> Read More </a>
            </div>
            <div class="article-card">
                <h3> Cuco: LA’s trippy Latin lover</h3>
                <p>


                </p>
                <a href="#"> Read More </a>
            </div>
        </div>
    </section>

<!-- Add a want to create button?-->
        <section class="creator">
                <h2> Want to Create? </h2>
                <a href="creatorLoginPage.php"><button>Click Here!</button></a>
        </section>
    <!-- May add this part back if it looks odd
    <section class="about">
        <h2> About Us</h2>

    </section> -->

    <footer>
        <p>&copy; The Experience. All rights reserved :p</p>
    </footer>
    <script>

        const articleCard = document.querySelector('.article-card-read')
        const btn = document.querySelector('.readMore')

        btn.addEventListener('click', () => {
            articleCard.classList.toggle('toggle')
        })
        function darkModeToggle () {
                var body = document.body;
                body.classList.toggle("darkMode");
        }


    </script>
    </body>
</html>