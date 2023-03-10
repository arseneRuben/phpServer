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
require_once "users.php";
require_once "view/customers.php";
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
            // LOGIN PAGE
            // $pageData['content'] = "<h1>Sign In</h1>";
            $pageData['title'] = COMPANY_NAME . "-Login page";
            // Affiche la page
            users::login();
            break;
        case 2:
            // VERIFICATION
            $pageData['title'] = COMPANY_NAME . "-Welcome page";
            users::loginVerifiy();
            break;
        case 3:
            // SIGN UP

            users::register("", $_REQUEST);
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
            $pageData['content'] = "Buyam is a local e-commerce platform whose sole objective is to provide buyers with the same experience and feeling that they often experience in direct sales (face to face) in a market or in a store by allowing them to chat with the seller, allowing them to negotiate the price of the product and reach a mutual agreement. This functionality that allows buyers to negotiate the price of items as they normally do in a marketplace is what sets Buyam apart from all other e-commerce apps out there.";

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
        case 100:
            // Product list
            if (isset($_SESSION['email'])) {
                $pageData['title'] = COMPANY_NAME . "-Product list";

                if (isset($_REQUEST['search_id']))
                    products::list($_REQUEST['search_id']);
                else
                    products::list();
            } else {
                crash(401, "Vous devez etre connectes a <a href='index.php?op=1'>page de connexion </a> ");
            }
            break;
        case 104:
            // VERIFICATION
            if (isset($_SESSION['email'])) {
                products::formVerify();
            } else {
                crash(401, "Vous devez etre connectes a <a href='index.php?op=1'>page de connexion </a> ");
            }
            break;
        case 110:

            // Show product
            if (isset($_SESSION['email'])) {
                $pageData['title'] = COMPANY_NAME . "-Show presentation ";
                products::show($_REQUEST['id']);
            } else {
                crash(401, "Vous devez etre connectes a <a href='index.php?op=1'>page de connexion </a> ");
            }
            break;

        case 140:
            // Edit product
            if (isset($_SESSION['email'])) {
                //$pageData['title'] = COMPANY_NAME . "-Edit Product ";
                products::form();
            } else {
                crash(401, "Vous devez etre connectes a <a href='index.php?op=1'>page de connexion </a> ");
            }
            break;

        case 190:
            // delete product
            if (isset($_SESSION['email'])) {
                $pageData['title'] = COMPANY_NAME . "-Delete product ";
                products::delete($_REQUEST['id']);
            } else {
                crash(401, "Vous devez etre connectes a <a href='index.php?op=1'>page de connexion </a> ");
            }
            break;

        case 400:
            if (isset($_SESSION['email'])) {
                $pageData['title'] = COMPANY_NAME . "-Customer list";


                if (isset($_REQUEST['search_id']))
                    customers::list(intval($_REQUEST['search_id']));
                else
                    customers::list();
            } else {
                crash(401, "Vous devez etre connectes a <a href='index.php?op=1'>page de connexion </a> ");
            }
            break;
        case 420:
            if (isset($_SESSION['email'])) {
                $pageData['title'] = COMPANY_NAME . "-Product list(json) ";
                products::listJson();
            } else {
                crash(401, "Vous devez etre connectes a <a href='index.php?op=1'>page de connexion </a> ");
            }
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
