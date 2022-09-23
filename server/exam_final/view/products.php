<?php
require_once "db_pdo.php";
/**
 * Product class
 */
class products
{
    //Constructor
    public function __construct()
    {
    }
    // Simple list of product in a table
    public static function list()
    {

        $pageData = DEFAULT_PAGE_DATA;
        $pageData['title'] =  "-Product list- " . COMPANY_NAME;
        $DB = new db_pdo();
        $DB->connect();

        $products = $DB->querySelect("SELECT id, name, description, price, pic, qty_in_stock FROM products");

        $number = count($products);
        $tbHtml = tableToHtml($products);
        $pageData['content'] = "";
        $pageData['content'] .= <<<HTML

            <h2>Product List</h2>

           {$tbHtml}
        HTML;
        webpage::render($pageData);
        return;
    }


    // Simple list of product in a table
    public static function catalogue()
    {

        $pageData = DEFAULT_PAGE_DATA;
        $pageData['title'] =  "-Product catalogue- " . COMPANY_NAME;
        $DB = new db_pdo();
        $DB->connect();

        $products = $DB->querySelect("SELECT id, name, description, price, pic, qty_in_stock FROM products");

        $number = count($products);
        $tbHtml = tableToHtml($products);
        $pageData['content'] = "";
        $pageData['content'] .= <<<HTML

             <h2>Product List</h2>

            {$tbHtml}
         HTML;
        webpage::render($pageData);
        return;
    }
}
