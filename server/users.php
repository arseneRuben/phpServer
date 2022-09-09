<?php

class users
{

    public function __construct()
    {
    }


    public function __destruct()
    {
    }
    /**
     * print login form
     */

    public static function login($msg = "")
    {
        $pageData = DEFAULT_PAGE_DATA;
        $pageData['title'] = COMPANY_NAME . "-Sign in";
        $pageData['content'] = <<<HTML
            <h2  class="error"> {$msg} </h2>
            <form action="index.php" method="POST">
                <input type="hidden" name="op" value="2"/>
            <label>email</label> <input type="email" name="email" maxlength="126" required/> <br>
            <label>password</label> <input type="password" name="pwd" maxlength="8" required/> <br>
            <button> submit </button>
                <input type="reset" value="annuler"/>
            </form>
        HTML;
        webpage::render($pageData);
    }

    public static function loginVerifiy()
    {
        // Supose that it comes from a bd
        $users = [
            ['id' => 0, 'email' => 'Yannick@gmail.com', 'pw' => '12345678'],
            ['id' => 1, 'email' => 'Victor@test.com', 'pw' => '11111111'],
            ['id' => 2, 'email' => 'Christian@victoire.ca', 'pw' => '22222222'],
        ];
        //recuperer les valeurs du formulaire
        if (checkInput("pwd",  $_REQUEST['pwd'], 126, 0, true)) {
            // if (isset($_REQUEST['pwd']) and strlen($_REQUEST['pwd']) <= 126 and filter_var($_REQUEST['pwd'], FILTER_VALIDATE_EMAIL)) {
            $pwd = htmlspecialchars($_REQUEST['pwd']);
        } else {
            if (filter_var(!filter_var($_REQUEST['pwd'], FILTER_VALIDATE_EMAIL)))
                echo "email eronne";
            crash(400, "Erreur dans users.php loginVerify(), mot de passe non recu oi trop long , max 8 caracteres");
        }
        //recuperer les valeurs du formulaire
        if (isset($_REQUEST['email']) and strlen($_REQUEST['pwd']) <= 126) {
            $email = htmlspecialchars($_REQUEST['email']);
        } else {
            crash(400, "Erreur dans users.php loginVerify(), email non recu oi trop long , max 126 caracteres");
        }



        $password = $_POST['pwd'];
        foreach ($users as $user) {
            if (($user['email'] === $email) && ($user['pw'] === $password)) {
                $pageData = DEFAULT_PAGE_DATA;
                $pageData['title'] = "Welcome!";
                $pageData['content'] = "Vous etes connecte";
                webpage::render($pageData);
            }
        }
        users::login("Erreur , mauvais mot de passe et/ou email invalide");
    }


    /**
     * $name : The name of the input
     * $input : the value oh that input
     * $maxLength : the max lenght of the input if it exists
     * $minLength : the max lenght of the input if it exists
     * $required : specifies if the input is requered
     */
    //  ecrire une fonction de verification
    public static function checkInput($name, $input, $maxLength = 0, $minLength = -1, $required)
    {
        $errors = "";
        if (!isset($input)) {
            if ($required) {
                $errors .= $name . " is required \n";
            }
        } else {
            $input = trim($input);
            if ($required && ($input === '')) {
                $errors .= $name . " is required\n";
            }
            if (($maxLength != 0) && (strlen($input) < $maxLength)) {
                $errors .= $name . " must have at must " . $maxLength . "characters\n";
            }
            if (($minLength > 0) && (strlen($input) < $minLength)) {
                $errors .= $name . " must have at least " . $minLength . "characters\n";
            }
            $pattern = "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^";
            if (!preg_match($pattern, $input)) {
                $errors .= $input . "is an  invalid Email\n";
            }
        }
        if (strlen($errors) > 0) {
            echo $errors;
            return false;
        } else {
            return true;
        }
    }
}
