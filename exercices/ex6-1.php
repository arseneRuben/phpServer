<?php

const HOME = 'Accueil';
const PRODUCT = 'Nos produits';
const ABOUT = 'À propos';
const IDEA = 'Idées cadeaux';



// Le nom de l'item de menu qui doit être actif
$selected = IDEA;

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Exercice 6-1</title>
    <style>
        nav ul li {
            display: inline-block;
            width: 150px;
            padding: 4px;
            margin: 4px;
            text-align: center;
        }

        /* style pour les item non-selectionnés dans la liste */
        nav .menu-item {
            background-color: #e1f4f3;
            color: #0000cc;
        }

        /* style l'item selectionné dans la liste */
        nav .selected {
            background-color: #fea799;
        }
    </style>
</head>

<body>
    <h1>Affichage d'un item actif dans le menu</h1>
    <nav>
        <ul>
            <!-- CI DESSOUS AJOUTEZ VOTRE CODE PHP et HTML -->
            <li class=<?php echo HOME == $selected ? "\"menu-item selected\"" : "\"menu-item\"" ?>> <a href=""><?= HOME ?></a></li>
            <li class=<?php echo PRODUCT == $selected ? "\"menu-item selected\"" : "\"menu-item\"" ?>> <a href=""><?= PRODUCT ?></a></li>
            <li class=<?php echo ABOUT == $selected ? "\"menu-item selected\"" : "\"menu-item\"" ?>> <a href=""><?= ABOUT ?></a></li>
            <li class=<?php echo IDEA == $selected ? "\"menu-item selected\"" : "\"menu-item\"" ?>> <a href=""><?= IDEA ?></a></li>
        </ul>
    </nav>
</body>

</html>