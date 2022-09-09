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
     <a href='index.php?op=1'>Sign In</a>
     &#124;
 </nav>