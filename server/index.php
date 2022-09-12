<?php
ini_set('session.gc_maxlifetime', 60);

// each client should remember their session id for EXACTLY 1 hour
session_set_cookie_params(60);
session_start();
// server should keep session data for AT LEAST 1 hour


define("INDEX_LOADED", true); // Indique que l'entree du system a ete correctement franchis

require_once "globals.php";
require_once "tools.php";
require_once "view/webpage.php";
require_once "users.php";

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
            // LOGIN PAGE
            // $pageData['content'] = "<h1>Sign In</h1>";
            $pageData['title'] = COMPANY_NAME . "-Login page";
            // Affiche la page
            users::login();
            break;
        case 2:
            // VERIFICATION

            users::loginVerifiy();
            break;
        case 3:
            // SIGN UP

            users::register();
            break;
        case 4:
            // VERIFICATION

            users::registerVerify();
            break;
        case 5:
            // VERIFICATION

            users::logout();
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
