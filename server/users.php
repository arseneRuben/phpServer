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

    public static function register($msg = "")
    {
        $pageData = DEFAULT_PAGE_DATA;
        $pageData['title'] = COMPANY_NAME . "-Sign in";
        $pageData['content'] = <<<HTML

            <form class="form" action="index.php?op=2" method="POST">
            <h3  class="error"> {$msg} </h3>

                <input type="hidden" name="form_id" value="login_form"/>
                <input type="hidden" name="op" value="2"/>
                <fieldset>
                <label>email</label> <input class = "rounded-input"  type="email" placeholder="email"  name="email" maxlength="126" required/> <br>
                </fieldset>
                <fieldset>
                <label>password</label> <input class = "rounded-input"  placeholder="mot de passe" type="password" name="pwd" maxlength="126" required/> <br>
                </fieldset>
                <button> submit </button>
                <input type="reset" value="annuler"/>
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
            //   if ( strlen($_REQUEST['pwd']) > 126) {
            $password = htmlspecialchars($_REQUEST['pwd']);

            // if (isset($_REQUEST['pwd']) and strlen($_REQUEST['pwd']) <= 126 and filter_var($_REQUEST['pwd'], FILTER_VALIDATE_EMAIL)) {
            $email = htmlspecialchars($_REQUEST['email']);
            foreach ($users as $user) {
                if (($user['email'] === $email) && ($user['pw'] === $password)) {
                    $pageData = DEFAULT_PAGE_DATA;
                    $pageData['title'] = "Welcome!";
                    $pageData['content'] = "Vous etes connecte";
                    webpage::render($pageData);
                    return;
                }
            }
            users::$errors .= "Parametre de connextion invalides";
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

    public static function registerVerify($msg = "")
    {
        $pageData = DEFAULT_PAGE_DATA;
        $pageData['title'] = COMPANY_NAME . "-Sign in";
        $users = [
            ['id' => 0, 'email' => 'Yannick@gmail.com', 'pw' => '12345678'],
            ['id' => 1, 'email' => 'Victor@test.com', 'pw' => '11111111'],
            ['id' => 2, 'email' => 'Christian@victoire.ca', 'pw' => '22222222'],
        ];
        //   webpage::render($pageData);
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
