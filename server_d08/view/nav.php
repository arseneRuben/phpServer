 <!-- BARRE DE NAVIGATION -->
 <?php
    if (INDEX_LOADED == NULL) {
        http_response_code(403);
        exit("Direct access forbidden on this file");
    }
    ?>
 <div class=" <?= $pageData['class'] ?> ">

     <header>
         <nav>
             <img src="./images/icons_nav/LogoBonjourMontrealVille.svg" alt="Logo Bonjour Montreal">
             <span><a href="./index.php?op=60"><img src="./images/icons_nav/house-solid.svg" alt="Accueil"><span>Accueil</span></a></span>
             <span><a href="./index.php?op=61"><img src="./images/icons_nav/images-solid.svg" alt="Catalogue"><span>Visites</span></a></span>
             <span><a href="./index.php?op=62"><img src="./images/icons_nav/camera-retro-solid.svg" alt="Galerie"><span>Galerie</span></a></span>
             <span><a href="./index.php?op=63"><img src="./images/icons_nav/scale-balanced-solid.svg" alt="Comparer"><span>Comparer</span></a></span>
             <span><a href="./index.php?op=64"><img src="./images/icons_nav/pen-to-square-regular.svg" alt="Réserver"><span>Réserver</span></a></span>
             <div><input type="search" placeholder="Rechercher"><img src="./images/icons_nav/searchengin-brands.svg" alt="Recherche"></div>
         </nav>
         <?php require_once 'view/banner.php'; ?>
     </header>