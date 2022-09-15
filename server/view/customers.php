<?php
class customers
{
    public static function list($search_id = 0)
    {
        $pageData = DEFAULT_PAGE_DATA;

        $DB = new db_pdo();
        $DB->connect();
        if ($search_id == 0) {
            $clients = $DB->querySelect("SELECT id, name, country FROM customers");
        } else {
            $clients = $DB->querySelect("SELECT id, name, country FROM customers WHERE id=$search_id");
        }
        $number = count($clients);
        $tbHtml = tableToHtml($clients);

        $pageData['content'] = "";


        $pageData['content'] .= <<<HTML
        <h2  class="error"> Liste des clients </h2>
        <h3>Nombre de clients : $number </h3>
            <form  class="table" action="index.php"  >
            <input type="hidden" name="op" value="400"/>
            <p> Search for id :<input name="search_id" /> <button>Go</button> <a href='index.php?op=400'>Show all</a></p>
           </form>

                {$tbHtml}

        HTML;
        webpage::render($pageData);
        return;
    }
}
