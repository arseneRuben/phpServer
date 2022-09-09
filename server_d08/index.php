<?php
define("INDEX_LOADED", true); // Indique que l'entree du system a ete correctement franchis

require_once "globals.php";
require_once "tools.php";
require_once "view/webpage.php";

function main()
{


    $pageData = DEFAULT_PAGE_DATA;
    $pageData['compteVues'] = viewCount(VIEW_COUNT_FILE);
    if (isset($_GET['op'])) {
        $op = $_GET['op'];
    } else {
        $op = 60;
    }
    switch ($op) {
        case 60:

            // HOME PAGE
            $pageData['content'] = file_get_contents('view/index.html');
            $pageData['class'] = 'home';
            $pageData['title'] = COMPANY_NAME . "-Home page";
            // Affiche la page
            webpage::render($pageData);

            break;
        case 61:
            // CATALOGUE
            $pageData['class'] = 'catalogue';
            $pageData['content'] = file_get_contents('view/catalogue/index.html');
            $pageData['title'] = COMPANY_NAME . "-catalogue";
            // Affiche la page
            webpage::render($pageData);

            break;
        case 62:
            // DETAIL
            $pageData['class'] = 'detail';
            $pageData['content'] = file_get_contents('view/detail/index.html');
            $pageData['title'] = COMPANY_NAME . "-En detail";
            // Affiche la page
            webpage::render($pageData);
            break;


        case 63:
            // COMPARAISON
            $pageData['class'] = 'tableau';
            $pageData['content'] = file_get_contents('view/tableau/index.html');
            $pageData['title'] = COMPANY_NAME . "-Comparaison";
            // Affiche la page
            webpage::render($pageData);
            break;
        case 64:
            // CONTACT
            $pageData['class'] = 'contact';
            $pageData['content'] = file_get_contents('view/contact/index.html');
            $pageData['title'] = COMPANY_NAME . "-Reservation";
            // Affiche la page
            webpage::render($pageData);
            break;
        case 65:
            // GALERIE
            $pageData['class'] = 'galerie';
            $pageData['content'] = file_get_contents('view/galerie/index.html');
            $pageData['title'] = COMPANY_NAME . "-Galerie";
            // Affiche la page
            webpage::render($pageData);
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
