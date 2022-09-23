<?php
ini_set('session.gc_maxlifetime', 1600);

// each client should remember their session id for EXACTLY 1 hour
session_set_cookie_params(360);
session_start();
// server should keep session data for AT LEAST 1 hour


define("INDEX_LOADED", true); // Indique que l'entree du system a ete correctement franchis

require_once "globals.php";
require_once "tools.php";
require_once "view/webpage.php";
require_once "view/products.php";
function main()
{

    logVisitor(LOG_FILE);
    $pageData = DEFAULT_PAGE_DATA;
    if (isset($_REQUEST['op'])) {
        $op = $_REQUEST['op'];
    } else {
        $op = 0;
    }




    switch ($op) {
        case 0:
            $inFiveYears = 60 * 60 * 24 * 365 * 5 + time();
            setcookie('lastVisit', date("G:i - d/m/y"), $inFiveYears);
            $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
            if ($lang == 'en') {
                $pageData['content'] = "Discover and connect with trusted sellers on Whatsapp. And get the same experience as when shopping in a store.
                On Buyam, you can now interact with a seller the same way you would in a store: negotiate the price and get the best deal for the product; all this online!";
            }
            if ($lang == 'fr') {
                $pageData['content'] = "Découvrez et connectez-vous avec des vendeurs agréés sur Whatsapp. Et bénéficiez de la même expérience que lorsque vous effectuez vos achats dans un magasin.
                Sur Buyam, vous pouvez désormais interagir avec un vendeur de la même manière que vous le feriez dans un magasin : négocier le prix et obtenir la meilleure offre pour le produit ; tout cela en ligne !";
            }
            // HOME PAGE
            $pageData['title'] = COMPANY_NAME . "-Home page";

            // Affiche la page
            webpage::render($pageData);

            break;
        case 1:
            // Product list
            products::list();
            break;
        case 2:
            // Product list
            products::catalogue();
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
