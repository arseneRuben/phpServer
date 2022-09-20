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
            echo '<span>Connecte entant que </span> <img class="logo" src="' . USER_IMAGE_FOLDER . $_SESSION["picture"] . '" alt="' . $_SESSION["email"] . '">';
            echo '<a href="index.php?op=5">Log out</a>  &#124;';
            echo '<a href="index.php?op=400">Clients</a>&#124;';
            echo '<a href="index.php?op=100">Produits</a> <a   href="index.php?op=130" class="btn btn-light"><i class="fa fa-plus-circle" aria-hidden="true"></i></a ></h2>';
        } else {
            echo ' <a href="index.php?op=1">Sign In</a>  &#124;
            <a href="index.php?op=3">Sign Up</a>
       ';
        }
        ?>

 </nav>