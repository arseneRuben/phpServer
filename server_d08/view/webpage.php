<?php

if (INDEX_LOADED == NULL) {
    http_response_code(403);
    exit("Direct access forbidden on this file");
}
class webpage
{

    /**
     * Envoie une page web au client
     */
    public static function render($pageData)
    {

        logVisitor(VISITOR_LOG_FILE);
        require_once 'view/head.php';
        require_once 'view/header.php';
        require_once 'view/nav.php';
        require_once 'view/aside.php';
        echo $pageData['content'];
        require_once 'view/footer.php';
    }
} // Fin de la fonction render