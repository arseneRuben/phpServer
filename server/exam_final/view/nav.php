 <!-- BARRE DE NAVIGATION -->
 <?php
    if (INDEX_LOADED == NULL) {
        http_response_code(403);
        exit("Direct access forbidden on this file");
    }
    ?>

 <nav>
     <a href="index.php?op=100">Product List</a> &#124; <a href="index.php?op=140" class="btn btn-light">Product Catalogue</a>
     &#124;
 </nav>