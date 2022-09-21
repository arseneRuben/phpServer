<?php
require_once "db_pdo.php";
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
        $_SESSION['picture'] = null;
        $_SESSION['notification'] = null;
        header("location:index.php");
    }
    /**
     * print login form
     */

    public static function login($msg = "", $previousData = [])
    {
        $_SESSION['notification'] = null;
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

        if ($previousData === ['op' => '3']) {
            $previousData = array_merge($previousData, [
                'password' => '',   // C'est dans ce champ que l'on va memoriser les erreur liees au mot de passe
                'password_repeated' => '',   // C'est dans ce champ que l'on va memoriser les erreur liees au mot de passe
                'email' => '',
                'fullname' => '',
                'country' => '',
                'spam_ok' => '',
                "language" => ''
            ]);
        }


        $radioLanguage = ' ';
        if ($previousData["language"] ==  'fr') {

            $radioLanguage .= '  <div>
                <input type="radio" id="fr" name="language" value="fr"   class="" checked />
                <label for="fr">Francais</label>
                </div>';
        } else {
            $radioLanguage .= '  <div>
            <input type="radio" id="fr" name="language" value="fr"  class="" checked />
            <label for="fr">Francais</label>
            </div>';
        }
        if ($previousData['language'] ==  'en') {

            $radioLanguage .= '  <div>
                <input type="radio" id="en" name="language" value="en"  class="" checked />
                <label for="en">English</label>
                </div>';
        } else {
            $radioLanguage .= '  <div>
            <input type="radio" id="en" name="language" value="en"  class=""  />
            <label for="en">English</label>
            </div>';
        }

        if ($previousData['language'] ==  'other') {

            $radioLanguage .= '  <div>
                <input type="radio" id="other" name="language" value="other"  class="" checked />
                <label for="other">Autre</label>
                </div>';
        } else {
            $radioLanguage .= '  <div>
            <input type="radio" id="other" name="language" value="other"  class=""/>
            <label for="other">Autre</label>
            </div>';
        }


        $DB = new db_pdo();
        $DB->connect();
        $pays = $DB->table("countries");

        $selectPays = '<SELECT name="country" class="rounded-input">';
        $selectPays .= '<option value=""> Votre nationalite </option>';
        foreach ($pays as $p) {
            $selectPays .= '<option value="' . $p->code . '" >' . $p->name . '</option>';
        }
        $selectPays .= '</SELECT>';

        $pageData = DEFAULT_PAGE_DATA;
        $pageData['title'] = COMPANY_NAME . "-Sign in";
        $pageData['content'] = <<<HTML
            <h2  class="error"> {$msg} </h2>
                <form   class="form"  action="index.php" class="register" method="POST" id="form_register" enctype="multipart/form-data">
                    <input type="hidden" name="form_id" value="form_register">
                    <input type="hidden" name="op" value="4"/>
                <fieldset class="line-form">
                 <input type="text" maxlenght="50" name="fullname" placeholder= "nom complet" class="rounded-input"  value="{$previousData['fullname']}"/>
                 <input id="email"  type="email"  name="email" maxlenght="126" size="30" autofocus    value="{$previousData['email']}" placeholder="Email"  class="rounded-input"><br>

                </fieldset>
                <fieldset class="line-form password">



                <input type="password" id="password" name="password" maxlength="8"  placeholder="mot de passe - max 8 car." size = "30"  value="{$previousData['password_repeated']}" class="rounded-input"><br>

            <input  type="password" id="password_repeated" name="password_repeated" maxlength="8"  placeholder="repetez le mot de passe" size="30"  value="{$previousData['password_repeated']}" class="rounded-input"><br>
        </fieldset>
        <fieldset class="line-form">
                    <div>
                        {$selectPays}
                    </div>
                    <br/>
                    <div>
                     <label for="info">Je desire recevoir les informations sur les produits
                     </label>
                        <input type="checkbox" name="spam_ok"  checked="checked" id="info"  class="rounded-input" />
                    </div>
                    <br/>
                 <div>
                    {$radioLanguage}
                </div>
         </fieldset>
         <fieldset class="line-form">
         <div>
         <label for="avatar">Image de profil
                     </label>
                 <input id="avatar"  type="file"  name="avatar"  placeholder="Ma photo de profil"  class="rounded-input"><br>
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
        $DB = new db_pdo();
        $DB->connect();


        //recuperer les valeurs du formulaire
        if (checkInput("pwd",   8, 0, 1, true) && checkInput("email", 126, 0, 1, true)) {
            $password = htmlspecialchars($_REQUEST['pwd']);
            $email = htmlspecialchars($_REQUEST['email']);
            $users = $DB->querySelect("Select * from users where email='$email'  ;");
            // $users = $results->fetchAll();
            /* foreach ($users as $user) {
                if (($user['email'] === $email) && ($user['pw'] === $password)) {
                    $pageData = DEFAULT_PAGE_DATA;
                    $pageData['title'] = "Welcome!";
                    $pageData['content'] = "Vous etes connecte";
                    $_SESSION["email"] = $email;

                    webpage::render($pageData);
                    return;
                }
            }*/

            if ((count($users) === 1) && password_verify($password, $users[0]['pw'])) {

                $pageData = DEFAULT_PAGE_DATA;
                $pageData['title'] = "Welcome!";
                $pageData['content'] = "Vous etes connecte";
                $_SESSION["email"] = $email;
                $_SESSION["picture"] = $users[0]["picture"];
                $_SESSION['notification'] = array('Bienvenue     ' . $email => "success");
                webpage::render($pageData);
                return;
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
     * Verify register form and submit
     */

    public static function registerVerify($msg = "", $previousData = [])
    {

        if (!isset($_REQUEST['form_id']) || $_REQUEST['form_id'] != "form_register") {
            crash(400, "Mauvais formulaire recu");
        }
        if (($_REQUEST["password"] != $_REQUEST["password_repeated"])) {
            $msg .= " Le mot de passe et sa verification ne concordent pas! <br/>";
        }

        /*
        Monsieur, j'aurai aime affichier les messages d'erreur de la page de register en meme temps que le formulaire contenant les donnees memomrisees
        C'est pourquoi j'ai reecrit la fonction check Input. */

        if (
            ($fullname = checkInput("fullname", 50, 1, true, $msg)) &&
            ($email = checkInput("email",  126, 1, true, $msg)) &&
            ($password = checkInput("password", 8, 0, true, $msg)) &&
            ($password_repeated = checkInput("password_repeated",  8, 0, true, $msg)) &&
            ($country = checkInput("country", 2, 2, true, $msg)) &&
            ($language = checkInput("language", 25, true, $msg))

        ) {

            $DB = new db_pdo();
            $DB->connect();

            $results = $DB->query("Select * from users where email='$email';");
            $users = $results->fetchAll();
            if ($_REQUEST["spam_ok"]) {
                $spam_ok = 1;
            } else {
                $spam_ok = 0;
            }
            if (count($users) >= 1)
                $msg .= "Cet email est deja pris </br>";
            if (strlen($msg) == 0) {
                $params = [
                    'fullname' => $fullname,
                    'email' => $email,
                    'pw' => password_hash($password, PASSWORD_DEFAULT), // Encodage du mot de passe
                    'country' => $country,
                    'language' => $language,
                    'spam_ok' => $spam_ok,
                    'picture' => basename($_FILES["avatar"]['name'])
                ];
                //Upload de l'avatar
                Picture_Uploaded_Save_File("avatar", "users_images/");
                if ($msg != "ok") {
                }

                if ($DB->queryParams("INSERT INTO users(email, fullname,    pw, country, language, spam_ok, picture) VALUES
                                                (:email, :fullname, :pw, :country, :language, :spam_ok, :picture)", $params))
                    users::login("Votre inscription a reussit!. Vous pouvez a present vous connecter!");
            } else {
                users::register($msg, $_REQUEST);
            }
        } else {

            users::register($msg, $previousData);
        }
    }
}

// CLIENT(default), EMPLOYEE,  ADMIN