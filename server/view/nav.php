 <!-- BARRE DE NAVIGATION -->
 <?php
    if (INDEX_LOADED == NULL) {
        http_response_code(403);
        exit("Direct access forbidden on this file");
    }
    ?>
 <div class="content">
     <nav style="background-color:pink;color:blue;padding:10px; font: 16px/18px sans-serif;">
         <a href='index.php?op=0'><i class="fa fa-home" aria-hidden="true"></i>
         </a>
         &#124;
         <a href='index.php?op=10'>About</a>
         &#124;
         <a href='index.php?op=50'><i class="fa fa-download" aria-hidden="true"></i>
         </a>
         &#124;
         <a href='index.php?op=51'>Follow us on <i class="fa fa-facebook-square" aria-hidden="true"></i>
         </a>
         &#124;
         <?php
            /*   echo '<span>loged in as </span> <i class="fa fa-user-circle" aria-hidden="true"></i>'; */
            if (isset($_SESSION['email'])) {
                echo '<span>loged in as </span>      <img class="logo" src="' . USER_IMAGE_FOLDER . $_SESSION["picture"] . '" alt="' . $_SESSION["email"] . '">';

                echo '<a href="index.php?op=5"><i class="fa fa-sign-out" aria-hidden="true"></i></a>  &#124;';
                echo '<a href="index.php?op=400">Clients</a>&#124;';
                echo '<a href="index.php?op=100">Produits</a> &#124; <a   href="index.php?op=140" class="btn btn-light"><i class="fa fa-plus-circle" aria-hidden="true"></i></a ></h2>';
            } else {
                echo ' <a href="index.php?op=1"><i class="fa fa-sign-in" aria-hidden="true"></i></a>  &#124;

       ';
            }
            ?>

     </nav>
     <?php
        if (isset($_SESSION['notification'])) {
            //Loop through it like any other array.
            $divAlert = '';
            foreach ($_SESSION['notification'] as $msg => $classAlert) {
                $divAlert .= <<<HTML
              <div class="alert alert-{$classAlert} d-none">{$msg}</div>
         HTML;
                echo $divAlert;
            }
        }
        ?>