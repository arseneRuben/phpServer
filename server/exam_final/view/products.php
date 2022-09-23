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


        $tbHtml = "";
        foreach ($products as $product) {
            $tbHtml .= products::presentation(($product));
        }
        $pageData['content'] .= <<<HTML
            {$tbHtml}
         HTML;
        webpage::render($pageData);
        return;
    }

    /**
     * Present product in a DIV
     * @param array $product The product to be presented as an associative array.
     * @return string HTML representation of the product
     */
    public static function presentation($product)
    {
        $div = '<div class="product">';
        $div .= '<img src="  ' . IMAGE_FOLDER . '/' . $product["pic"] . ' " alt="' . $product["name"] . '"/>';
        $div .= '<h3 class="name">' . $product["name"] . '</h3>';
        $div .= '<p class="description">' . $product["description"] . '</p>';
        $div .= '<p class="price">' . $product["price"] . '</p>';
        $div .= "</div>";
        return $div;
    }
}
