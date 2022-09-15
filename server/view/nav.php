 <!-- BARRE DE NAVIGATION -->
 <?php
    if (INDEX_LOADED == NULL) {
        http_response_code(403);
        exit("Direct access forbidden on this file");
    }
    ?>
 <nav style="background-color:pink;color:blue;padding:10px; font: 16px/18px sans-serif;">
     <a href='index.php?op=0'>Home</a>
     &#124;
     <a href='index.php?op=10'>About</a>
     &#124;
     <a href='index.php?op=50'>Download Manual</a>
     &#124;
     <a href='index.php?op=51'>Suivez nous sur facebook</a>
     &#124;
     <?php
        if (isset($_SESSION['email'])) {

            echo '<span>Connecte entant que ' . $_SESSION["email"] . '</span>';
            echo '<a href="index.php?op=5">Log out</a>  &#124;';
            echo "<a href='index.php?op=400'>Clients</a>
     &#124;";
        } else {
            echo ' <a href="index.php?op=1">Sign In</a>  &#124;
            <a href="index.php?op=3">Sign Up</a>
       ';
        }

        // last visit
        if (isset($_COOKIE['lastVisit'])) {
            $visite = $_COOKIE['lastVisit'];
            echo "<span>Dernière visite: " . $visite . "</span>";
        } else {
            echo "<span> Bienvenue, c'est votre première visite</span>";
        }
        $inFiveYears = 60 * 60 * 24 * 365 * 5 + time();
        setcookie('lastVisit', date("G:i - d/m/y"), $inFiveYears);



        ?>

 </nav>