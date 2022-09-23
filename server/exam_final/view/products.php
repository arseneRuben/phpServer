<?php

/**
 * Product class
 */
class products
{
    //Constructor
    public function __construct()
    {
    }
    /**
     * @param int $search_id Research product ID. Is worth zero and indicates that there is no research to do
     */
    public static function list($search_id = 0)
    {
        $_SESSION['notification'] = null;
        $pageData = DEFAULT_PAGE_DATA;
        $pageData['title'] = COMPANY_NAME . "-Product list";
        $DB = new db_pdo();
        $DB->connect();

        if ($search_id === 0) { // Examines whether it is a request for a list or for a search for a product
            $products = $DB->querySelect("SELECT id, name, category, vendor, quantityInStock, cost,retailPrice FROM products");
        } else {
            $products = $DB->querySelectParams("SELECT  id, name, category, vendor, quantityInStock, cost,retailPrice FROM products WHERE id=?", [$search_id]);
        }
        $number = count($products);
        $tbHtml = tableToHtml($products);
        $pageData['content'] = "";
        $pageData['content'] .= <<<HTML
            <form  class="table" action="index.php"  >
            <input type="hidden" name="op" value="100"/>
            <p>Number of products : $number &nbsp;  &nbsp;  Search for id :<input  class="form-control" name="search_id" /> <button class="btn btn-primary">Go</button> <a  class="btn btn-info" href='index.php?op=100'>Show all</a> <a href="index.php?op=3" class="btn btn-secondary"><i class="fa fa-user-plus" aria-hidden="true"></i></a></p>
           </form>
           {$tbHtml}
        HTML;
        webpage::render($pageData);
        return;
    }

    /**
     * Print new product creation-edition form with the previous data eventually
     *  @param string $msg  The error message.
     *  @param array $previousData  The previous data.
     */

    public static function form($msg = "", $previousData = [])
    {

        // Database connection
        $DB = new db_pdo();
        $DB->connect();

        //Product catagories taken from database
        $categories = $DB->table("productcategories");
        //Build select element
        $selectCategories = '<SELECT name="category"   class="form-select form-control">';

        if ($previousData === []) {
            if (isset($_REQUEST['id'])) {
                // Update Mode
                $pageData['title'] = COMPANY_NAME . "-Product edition";

                $selectCategories .= '<option value=""> Affecter une categorie </option>';

                $id = $_REQUEST['id'];
                $inputId = '<label>' . $id . '</label><input type="hidden" name="id"     value="' . $id . '" >';
                // product to edit
                $product = $DB->querySelect("Select * from products where id='$id'  ;", PDO::FETCH_OBJ);

                foreach ($categories as $p) {
                    if ($p->name ==  $product[0]->category)
                        $selectCategories .= '<option value="' . $p->name . '" selected>' . $p->name . '</option>';
                    else
                        $selectCategories .= '<option value="' . $p->name . '" >' . $p->name . '</option>';
                }

                $previousData = [
                    'id' => $id,
                    'name' => $product[0]->name,
                    'scale' => $product[0]->scale,
                    'stock' => $product[0]->quantityInStock,
                    'cost' => $product[0]->cost,
                    'retailPrice' => $product[0]->retailPrice,
                    'vendor' => $product[0]->vendor,
                    'category' => $product[0]->category,
                    'description' => $product[0]->description
                ];
                //Help to check if it-is CREATION or UPDATE
                $form_id = "product_edition";

                $button = <<<HTML
                <button type="submit" class="btn btn-warning">Update </button>
                HTML;
            } else {

                // Creation Mode
                $pageData['title'] = COMPANY_NAME . "-Product creation";

                $previousData = [
                    'id' => '',
                    'name' => '',
                    'scale' => '',
                    'stock' => '',
                    'cost' => '',
                    'category' => '',
                    'retailPrice' => '',
                    'description' => '',
                    'vendor' => ''
                ];

                $inputId = '<input type="text" class="form-control" id="id"  name="id" placeholder="Identifiant" autofocus    value="' . $previousData['id'] . '"  required>';
                $selectCategories .= '<option value="" selected> Affecter une categorie </option>';

                foreach ($categories as $p) {
                    $selectCategories .= '<option value="' . $p->name . '" >' . $p->name . '</option>';
                }

                //Help to check if it-is CREATION or UPDATE
                $form_id = "product_creation";
                $banner_tittle = "Create product";
                $button = <<<HTML
                <button type="submit" class="btn btn-primary">Create </button>
                HTML;
            }
        }

        // Create or update
        $selectCategories .= '</SELECT>';

        $pageData = DEFAULT_PAGE_DATA;
        $pageData['title'] = COMPANY_NAME . "-New product";
        $pageData['content'] = <<<HTML
         <div class="card content">

            <form class="needs-validation" action="index.php" method="POST" id="{$form_id}" novalidate>


                <input type="hidden" name="form_id" value="{$form_id}">
                    <input type="hidden" name="op" value="104"/>
                <fieldset  class="line-form">
                <div class="row mb-3">
                    <label for="id" class="col-sm-3 col-form-label">Identifiant</label>
                    <div class="col-sm-9">
                        {$inputId}
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="name" class="col-sm-3 col-form-label">Commercial name</label>
                    <div class="col-sm-9">
                    <input type="text" class="form-control" id="name"  name="name" placeholder="Comercial name" autofocus    value="{$previousData['name']}"  required>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Categorie</label>
                    <div class="col-sm-9">
                    <div class="d-flex flex-row justify-content-between align-items-center">
                       {$selectCategories}
                    </div>
                </div>
                </fieldset>
                <div class="row mb-3">
                    <label for="scale" class="col-sm-3 col-form-label">Scale</label>
                    <div class="col-sm-9">
                    <input type="text" class="form-control"  name="scale" id="scale" placeholder="Scale"  value="{$previousData['scale']}" required>

                    </div>
                </div>

                <div class="row mb-3">
                    <label for="vendor" class="col-sm-3 col-form-label">Vendor</label>
                    <div class="col-sm-9">
                    <input type="text" class="form-control" id="vendor" placeholder="Vendor" name="vendor"    value="{$previousData['vendor']}" >

                    </div>
                </div>
                <div class="row mb-3">
                    <label for="stock" class="col-sm-3 col-form-label">Stock</label>
                    <div class="col-sm-9">
                    <input type="number"  min="0" class="form-control" value="{$previousData['stock']}" name="stock" id="stock" placeholder="Quantity in stock" required>

                    </div>
                </div>
                <div class="row mb-3">
                    <label for="stock" class="col-sm-3 col-form-label">Cost</label>
                    <div class="col-sm-9">
                    <input type="number"  min="0" class="form-control" value="{$previousData['cost']}" step="0.01"  name="cost" id="cost" placeholder="Cost" required>

                    </div>
                </div>
                <div class="row mb-3">
                    <label for="stock" class="col-sm-3 col-form-label">Retail price</label>
                    <div class="col-sm-9">
                    <input type="number"  min="0" class="form-control" value="{$previousData['retailPrice']}"  name="retailPrice" id="stock" placeholder="RetailPrice" required>

                    </div>
                </div>

                <div class="row mb-3">
                    <label for="description" class="col-sm-3 col-form-label">Description</label>
                    <div class="col-sm-9">
                        <textarea id="description"  name="description"  class="form-control"  name="story" rows="5" cols="33" placeholder="Short description of the product" >
                            {$previousData['description']}
                        </textarea>
                    </div>
                </div>
                <div class="row mb-0">
                    <div class="col-sm-9 offset-sm-3">
                    {$button}
                    <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
        HTML;
        webpage::render($pageData);
        $_SESSION['notification'] = null;
    }

    /**
     * present a product
     *  @param int $id The product id.
     */

    public static function show($id)
    {
        //DB connecion
        $DB = new db_pdo();
        $DB->connect();

        // Product search from database
        $product = $DB->querySelect("Select * from products where id='$id'  ;", PDO::FETCH_OBJ);
        $params = ['id' => $id];
        // Search for Orders associated with this product from the database
        $commandLines = $DB->querySelectParams('SELECT   orders.id as "Facture",orders.date as "Date", orderdetails.quantity as "Qte", orderdetails.priceEach  as "Price", orderdetails.quantity*orderdetails.priceEach as "Price*Qte" FROM orders INNER JOIN orderdetails ON  orders.id = orderdetails.orderId
        INNER JOIN products ON orderdetails.productId = products.id WHERE products.id=:id ORDER BY orders.date DESC LIMIT 5;',  $params);
        $commandLines = tableToHtml($commandLines);

        $pageData = DEFAULT_PAGE_DATA;
        $pageData['title'] = COMPANY_NAME . "-Show product";
        $pageData['content'] = <<<HTML

            <h2  class="error"> {$product[0]->name} </h2>
            <div class="card content" >
                <img src="images/vehicle.jpg" class="card-img-top rounded mx-auto d-block" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Stock:{$product[0]->quantityInStock}</h5>
                    <p class="card-text">{$product[0]->description}</p>
                    <div>
                    <p class="card-text"><span>Category:</span>{$product[0]->category}</p>
                    <p class="card-text"><span>Unit price:</span>{$product[0]->cost} CAD</p>
                    <p class="card-text"><span>Retail price:</span>{$product[0]->retailPrice} CAD</p>
                    <p class="card-text"><span>Quantity in stock:</span>{$product[0]->quantityInStock}</p>
                    <p class="card-text"><span>Vendor:</span>{$product[0]->vendor}</p>
                    </div>
                    <div>
                    <a   href="index.php?op=100" class="btn btn-primary"><i class="fa fa-list" aria-hidden="true"></i></i></a >
                    <a   href="index.php?op=140&id={$product[0]->id}" class="btn btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i></a >
                    <a   href="index.php?op=190&id={$product[0]->id}" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a >
                    </div>
                    <div>
                       <p> <strong> Liste des dernieres factures</strong>
                        </p>
                        {$commandLines}
                    <div>

                </div>
            </div>
        HTML;

        webpage::render($pageData);
    }
    /**
     * Deletion of the product whose identifier is passed as a parameter
     *  @param int $id Product id.
     */

    public static function delete($id)
    {
        $DB = new db_pdo();
        $DB->connect();
        $DB->query("DELETE  FROM products WHERE id='$id'  ;");
        products::list();
    }


    /**
     * Send to the client the JSON's format of the list of products
     */
    public static function listJson()
    {
        $DB = new db_pdo();
        $DB->connect();
        $products = $DB->table("products");
        $productJson = json_encode($products, JSON_PRETTY_PRINT);
        header("Content-Type: application/json; charset=UTF-8");
        http_response_code(200); // ou autre au besoin
        echo $productJson;
    }

    /**
     * Verify product form and submit
     */

    public static function formVerify($msg = "", $previousData = [])
    {

        if (!isset($_REQUEST['form_id']) || (($_REQUEST['form_id'] != "product_creation") && ($_REQUEST['form_id'] != "product_edition"))) {
            crash(400, "Mauvais formulaire recu");
        }

        if (
            ($id = checkInput("id", 50, 0, true, $msg)) &&
            ($name = checkInput("name", 50, 0, true, $msg)) &&
            ($description = checkInput("description",  1300, 0, true, $msg)) &&
            ($vendor = checkInput("vendor", 140, 0, true, $msg)) &&
            ($scale = checkInput("scale", 140, 0, true, $msg))
        ) {
            $DB = new db_pdo();
            $DB->connect();


            // Check wether data comes from Creation Form  or Edition Form
            if ($_REQUEST['form_id'] == "product_creation") {

                $products = $DB->querySelect("Select * from products where id='$id'  ;");

                if (count($products) > 0) {
                    $msg .= "Cet identifiant est deja pris </br>";
                }
                if (strlen($msg) == 0) {
                    $params = [
                        'id' => $id,
                        'name' => $name,
                        'description' => $description,
                        'retailPrice' => floatval($_REQUEST['retailPrice']),
                        'vendor' => $vendor,
                        'category' => $_REQUEST['category'],
                        'scale' => $scale,
                        'quantityInStock' => intval($_REQUEST['stock']),
                        'cost' => floatval($_REQUEST['cost'])
                    ];

                    if ($DB->queryParams("INSERT INTO products(id, name, category, scale, vendor, description, quantityInStock, cost, retailPrice) VALUES
                    (:id, :name, :category, :scale, :vendor, :description, :quantityInStock, :cost, :retailPrice)", $params)) {

                        //  products::list("Votre inscription a reussit!. Vous pouvez a present vous connecter!");
                        $_SESSION['notification'] = array('Produit enregistre avec success     '  => "success");
                        products::show($id);
                    }
                } else {
                    products::form($previousData, "Echec de l'operation");
                }
            } else {
                //  Data comes from Edition Form
                if (strlen($msg) == 0) {
                    $params = [
                        'id' => $id,
                        'name' => $name,
                        'description' => $description,
                        'retailPrice' => floatval($_REQUEST['retailPrice']),
                        'vendor' => $vendor,
                        'category' => $_REQUEST['category'],
                        'scale' => $scale,
                        'quantityInStock' => intval($_REQUEST['stock']),
                        'cost' => floatval($_REQUEST['cost'])
                    ];


                    if ($DB->queryParams("UPDATE products SET name= :name, category=:category, scale=:scale, vendor=:vendor, description=:description, quantityInStock=:quantityInStock, cost=:cost, retailPrice=:retailPrice WHERE id=:id
                    ", $params)) {

                        $_SESSION['notification'] = array('Produit mis a jour avec success     '  => "success");
                        products::show($id);
                    }
                }
            }
        }
    }
}
