<?php

class users
{

    private static $errors = "";
    public function __construct()
    {
    }


    public function __destruct()
    {
    }


    public static function logout()
    {
        $_SESSION['email'] = null;
        header("location:index.php");
    }
    /**
     * print login form
     */

    public static function login($msg = "", $previousData = [])
    {
        if ($previousData === []) {
            $previousData = [
                'email' => '',
                'pwd' => ''
            ];
        }
        $pageData = DEFAULT_PAGE_DATA;
        $pageData['title'] = COMPANY_NAME . "-Sign in";
        $pageData['content'] = <<<HTML
            <h2  class="error"> {$msg} </h2>
            <form class="form" action="index.php" method="POST">
                <input type="hidden" name="form_id" value="login_form"/>
                <input type="hidden" name="op" value="2"/>
                <label>email</label> <input class = "rounded-input"  type="email" placeholder="email"  name="email" maxlength="126" value="{$previousData['email']}" required/> <br>
                <label>password</label> <input class = "rounded-input"  placeholder="mot de passe" type="password" name="pwd"  value="{$previousData['pwd']}" maxlength="126" required/> <br>
                <button> submit </button>
                <input type="reset" value="annuler"/>
            </form>
        HTML;
        webpage::render($pageData);
    }

    /**
     * print login form
     */

    public static function register($msg = "", $previousData = [])
    {
        if ($previousData === []) {
            $previousData = [
                'password' => '',   // C'est dans ce champ que l'on va memoriser les erreur liees au mot de passe
                'password_repeated' => '',   // C'est dans ce champ que l'on va memoriser les erreur liees au mot de passe
                'email' => '',
                'firstname' => '',
                'lastname' => '',
                'legacy' => '',
                'info' => ''

            ];
        }


        $radioLanguage = ' ';
        if ($previousData['language'] ==  'fr') {

            $radioLanguage .= '  <div>
                <input type="radio" id="fr" name="language" value="fr"  checked class="rounded-input">
                <label for="fr">English</label>
                </div>';
        } else {
            $radioLanguage .= '  <div>
            <input type="radio" id="fr" name="language" value="fr"  class="rounded-input">
            <label for="fr">English</label>
            </div>';
        }
        if ($previousData['language'] ==  'en') {

            $radioLanguage .= '  <div>
                <input type="radio" id="en" name="language" value="en"  checked class="rounded-input">
                <label for="en">English</label>
                </div>';
        } else {
            $radioLanguage .= '  <div>
            <input type="radio" id="en" name="language" value="en"  class="rounded-input">
            <label for="en">English</label>
            </div>';
        }

        if ($previousData['language'] ==  'other') {

            $radioLanguage .= '  <div>
                <input type="radio" id="other" name="language" value="other"  checked class="rounded-input">
                <label for="other">Autre</label>
                </div>';
        } else {
            $radioLanguage .= '  <div>
            <input type="radio" id="other" name="language" value="other"  class="rounded-input">
            <label for="other">Autre</label>
            </div>';
        }


        $pays = [
            [1, 'CA', 'Canada'],
            [2, 'US', 'États-Unis'],
            [3, 'MX', 'Mexique'],
            [4, 'FR', 'France'],
            [5, 'AU', 'Autre']
        ];
        $selectPays = '<SELECT name="country" class="rounded-input">';
        $selectPays .= '<option> Votre nationalite </option>';
        foreach ($pays as $p) {
            $selectPays .= '<option value="' . $p[1] . '" >' . $p[2] . '</option>';
        }
        $selectPays .= '</SELECT>';

        $pageData = DEFAULT_PAGE_DATA;
        $pageData['title'] = COMPANY_NAME . "-Sign in";
        $pageData['content'] = <<<HTML
            <h2  class="error"> {$msg} </h2>
                <form   class="form"  action="index.php" class="register" method="POST" id="form_register">
                    <input type="hidden" name="form_id" value="form_register">
                    <input type="hidden" name="op" value="4"/>
                <fieldset class="line-form">
                 <input type="text" maxlenght="50" name="firstname" placeholder= "nom prenom" class="rounded-input"  value="{$previousData['firstname']}"/>
                 <input type="text" maxlenght="50" name="lastname" placeholder= "nom nom" class="rounded-input"  value="{$previousData['lastname']}"/>
                 </fieldset>
                <fieldset class="line-form password">


            <input id="email"  type="email"  name="email" maxlenght="126" size="30" autofocus    value="{$previousData['email']}" placeholder="Email"  class="rounded-input"><br>

                <input type="password" id="password" name="password" maxlength="8"  placeholder="mot de passe - max 8 car." size = "30"  value="{$previousData['password_repeated']}" class="rounded-input"><br>

            <input  type="password" id="password_repeated" name="password_repeated" maxlength="8"  placeholder="repetez le mot de passe" size="30"  value="{$previousData['password_repeated']}" class="rounded-input"><br>



        </fieldset>
        <fieldset class="line-form">

                    <div>
                        {$selectPays}
                    </div>

                    <div>

                     <label for="info">Je desire recevoir les informations sur les produits
                     </label>
                        <input type="checkbox" name="info" type="info"  checked="checked" id="info"  class="rounded-input" />
                    </div>
                    <div>


                 <div>
                    {$radioLanguage}
                </div>


             </fieldset>
             <fieldset class="line-form">
             <input button type="submit" value="Soumettre"  class="rounded-input"/><input type="reset"  class="rounded-input" value="Annuler"/>
             </fieldset>

        </form>
    HTML;
        webpage::render($pageData);
    }


    public static function loginVerifiy()
    {
        if (!isset($_REQUEST['form_id']) || $_REQUEST['form_id'] != "login_form") {
            crash(400, "Mauvais formulaire recu");
        }
        // Supose that it comes from a bd
        $users = [
            ['id' => 0, 'email' => 'Yannick@gmail.com', 'pw' => '12345678'],
            ['id' => 1, 'email' => 'Victor@test.com', 'pw' => '11111111'],
            ['id' => 2, 'email' => 'Christian@victoire.ca', 'pw' => '22222222'],
        ];
        //recuperer les valeurs du formulaire
        if (users::checkInput("pwd",   126, 8, true) && users::checkInput("email", 126, 0, true)) {
            $password = htmlspecialchars($_REQUEST['pwd']);

            $email = htmlspecialchars($_REQUEST['email']);

            foreach ($users as $user) {
                if (($user['email'] === $email) && ($user['pw'] === $password)) {
                    $pageData = DEFAULT_PAGE_DATA;
                    $pageData['title'] = "Welcome!";
                    $pageData['content'] = "Vous etes connecte";
                    $_SESSION["email"] = $email;

                    webpage::render($pageData);
                    return;
                }
            }

            if (isset($_SESSION['tentatives'])) {
                $_SESSION['tentatives']--;
                $count = $_SESSION['tentatives'];
                users::$errors .= "Il vous reste  $count  tentatives de connexion<br/>";
            } else {
                $_SESSION['tentatives'] = MAX_LOGIN_ATEMPT;
            }

            if ($_SESSION['tentatives'] <= 0) {
                users::$errors .= "Le nombre de tentatives de connexion atteint! </br>  Vueillz reassayer plus tard!<br/>";
                $_SESSION['tentatives'] = MAX_LOGIN_ATEMPT;
            }

            users::$errors .= "Parametre de connextion invalides! <br/>";
            $previousData = [
                'email' => $email,
                'pwd' => $password,
            ];
            users::login(users::$errors, $previousData);
        } else {
            //crash(400, "Erreur dans users.php loginVerify(), email non recu oi trop long , max 126 caracteres");
            users::login(users::$errors);
        }
        //recuperer les valeurs du formulaire
    }

    /**
     * print login form
     */

    public static function registerVerify($msg = "", $previousData = [])
    {


        if (!isset($_REQUEST['form_id']) || $_REQUEST['form_id'] != "form_register") {
            crash(400, "Mauvais formulaire recu");
        }




        $previousData = users::checkInputText("lastname", $previousData);
        $previousData = users::checkInputText("password", $previousData);
        $previousData = users::checkInputText("password_repeated", $previousData);
        $previousData = users::checkInputText("firstname", $previousData);
        $previousData = users::checkInputText("email", $previousData);



        if (isset($_POST['info']) && $_POST['info'] != '')
            $previousData['info'] = $_POST['info'];

        else
            users::$errors .= "Champ manquant : les condition d'utilisation  <br/>";


        if (isset($_POST["password"]) && isset($_POST["password_repeated"]) && ($_POST["password"] !== $_POST["password_repeated"])) {
            users::$errors .= " Le mot de passe et sa verification ne sont pas equivalents <br/>";
        }


        //recuperer les valeurs du formulaire
        if (
            users::checkInput("password",   126, 8, true) &&
            users::checkInput("password_repeated", 126, 0, true)  &&
            users::checkInput("firstname",   40, 8, true) &&
            users::checkInput("lastname", 40, 0, true)  &&
            users::checkInput("email", 40, 0, true)
        ) {
            $password = htmlspecialchars($_REQUEST['password']);

            //Verifion si l'email n'est pas deja utilise
            $users = [
                ['id' => 0, 'email' => 'Yannick@gmail.com', 'pw' => '12345678'],
                ['id' => 1, 'email' => 'Victor@test.com', 'pw' => '11111111'],
                ['id' => 2, 'email' => 'Christian@victoire.ca', 'pw' => '22222222'],
            ];
            foreach ($users as $user) {
                if ($_POST['email'] == $user['email']) {
                    users::$errors .= "Cet email est deja pris </br>";
                    break;
                }
            }


            users::register(users::$errors, $previousData);
        } else {
            //crash(400, "Erreur dans users.php loginVerify(), email non recu oi trop long , max 126 caracteres");
            users::register(users::$errors);
        }
    }



    private static function checkInputText($name, $previousData)
    {
        if (strlen($_POST[$name]) != 0)



            $previousData[$name] = $_POST[$name];
        else {
            switch ($name) {
                case "email":
                    users::$errors .= "Veuillez indiquer votre adresse email !<br/>";
                    break;
                case "firstname":
                    users::$errors .= "Veuiller indiquer votre nom complet ! <br/>";
                    break;
                case "pw1":
                    users::$errors .= "Veuiller indiquer votre mot de passe de verificagtion !<br/>";
                    break;
                case "pw":
                    users::$errors .= "Veuiller indiquer votre mot de passe !<br/>";
                    break;
            }
            $previousData[$name] = "";
        }




        return $previousData;
    }


    /**
     * $name : The name of the input
     * $maxLength : the max lenght of the input if it exists
     * $minLength : the max lenght of the input if it exists
     * $required : specifies if the input is requered
     */
    //  ecrire une fonction de verification
    public static function checkInput($name,  $maxLength = 0, $required)
    {


        if (!isset($_REQUEST[$name])) {

            users::$errors .= $name . " is required <br/>";
            crash(400,  users::$errors);
        } else {
            $input = trim($_REQUEST[$name]);
            if ($required && ($input === '')) {
                users::$errors .= $name . " is required<br/>";
                crash(400,  users::$errors);
            }
            if (($maxLength != 0) && (strlen($input) > $maxLength)) {
                users::$errors  .= $name . " must have at must " . $maxLength . "characters<br/>";
                crash(400,    users::$errors);
            }

            $pattern = "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^";
            if ($name === "email" && !preg_match($pattern, $input)) {
                users::$errors .= $input . "is an  invalid Email\n";
                crash(400,    users::$errors);
            }
        }

        return htmlspecialchars($input);
    }
}
