<?php
define("INDEX_LOADED", true); // Indique que l'entree du system a ete correctement franchis

require_once "globals.php";
require_once "tools.php";
require_once "view/webpage.php";

function main()
{
    logVisitor(LOG_FILE);
    $pageData = DEFAULT_PAGE_DATA;
    if (isset($_GET['op'])) {
        $op = $_GET['op'];
    } else {
        $op = 0;
    }
    switch ($op) {
        case 0:

            // HOME PAGE
            $pageData['content'] = "Découvrez et connectez-vous avec des vendeurs agréés sur Whatsapp. Et bénéficiez de la même expérience que lorsque vous effectuez vos achats dans un magasin.
Sur Buyam, vous pouvez désormais interagir avec un vendeur de la même manière que vous le feriez dans un magasin : négocier le prix et obtenir la meilleure offre pour le produit ; tout cela en ligne !";


            $pageData['title'] = COMPANY_NAME . "-Home page";
            // Affiche la page
            webpage::render($pageData);

            break;
        case 10:
            // ABOUT
            $pageData['content'] = "Buyam est une plateforme locale de commerce en ligne dont le seul objectif est de procurer aux acheteurs la même expérience et sensation qu’ils vivent souvent en vente directe (face à face) dans un marché ou dans un magasin en leur permettant de discuter avec le vendeur, ce qui leur permet de négocier le prix du produit et de parvenir à un accord mutuel. Cette fonctionnalité qui permet aux acheteurs de négocier le prix des articles comme ils le font normalement dans un marché est ce qui différencie Buyam de toutes les autres applications de commerce en ligne existantes.";

            $pageData['title'] = COMPANY_NAME . "-About";
            // Affiche la page
            webpage::render($pageData);

            break;
        case 50:
            download($pageData["manual"]);
            break;
        case 51:
            redirect("https://www.facebook.com/Rubenpkfokam");
            break;
        default:
            //http_response_code(404);
            crash(404, "Invalid operation dans index.php");
            $pageData['title'] = "Invalid operation";

            $pageData['content'] = "<b>Invalid operation</b>";
            //  webpage::render($pageData);

            break;
    }
}

main();
