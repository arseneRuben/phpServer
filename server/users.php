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

        $pageData = DEFAULT_PAGE_DATA;
        $pageData['title'] = COMPANY_NAME . "-Sign in";
        $pageData['content'] = <<<HTML
            <h2  class="error"> {$msg} </h2>
                <form   class="form"  action="index.php?op=4" class="register" method="POST" id="form_register">
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

                     <select name="pays"  class="rounded-input">
                     <option>Selectionner votre pays</option>

                            <option value="Afghanistan">Afghanistan </option>
                            <option value="Afrique_Centrale">Afrique_Centrale </option>
                            <option value="Afrique_du_sud">Afrique_du_Sud </option>
                            <option value="Albanie">Albanie </option>
                            <option value="Algerie">Algerie </option>
                            <option value="Allemagne">Allemagne </option>
                            <option value="Andorre">Andorre </option>
                        <option value="Angola">Angola </option>
                        <option value="Anguilla">Anguilla </option>
                        <option value="Arabie_Saoudite">Arabie_Saoudite </option>
                        <option value="Argentine">Argentine </option>
                        <option value="Armenie">Armenie </option>
                        <option value="Australie">Australie </option>
                        <option value="Autriche">Autriche </option>
                        <option value="Azerbaidjan">Azerbaidjan </option>

                        <option value="Bahamas">Bahamas </option>
                        <option value="Bangladesh">Bangladesh </option>
                        <option value="Barbade">Barbade </option>
                        <option value="Bahrein">Bahrein </option>
                        <option value="Belgique">Belgique </option>
                        <option value="Belize">Belize </option>
                        <option value="Benin">Benin </option>
                        <option value="Bermudes">Bermudes </option>
                        <option value="Bielorussie">Bielorussie </option>
                        <option value="Bolivie">Bolivie </option>
                        <option value="Botswana">Botswana </option>
                        <option value="Bhoutan">Bhoutan </option>
                        <option value="Boznie_Herzegovine">Boznie_Herzegovine </option>
                        <option value="Bresil">Bresil </option>
                        <option value="Brunei">Brunei </option>
                        <option value="Bulgarie">Bulgarie </option>
                        <option value="Burkina_Faso">Burkina_Faso </option>
                        <option value="Burundi">Burundi </option>

                        <option value="Caiman">Caiman </option>
                        <option value="Cambodge">Cambodge </option>
                        <option value="Cameroun">Cameroun </option>
                        <option value="Canada">Canada </option>
                        <option value="Canaries">Canaries </option>
                        <option value="Cap_vert">Cap_Vert </option>
                        <option value="Chili">Chili </option>
                        <option value="Chine">Chine </option>
                        <option value="Chypre">Chypre </option>
                        <option value="Colombie">Colombie </option>
                        <option value="Comores">Colombie </option>
                        <option value="Congo">Congo </option>
                        <option value="Congo_democratique">Congo_democratique </option>
                        <option value="Cook">Cook </option>
                        <option value="Coree_du_Nord">Coree_du_Nord </option>
                        <option value="Coree_du_Sud">Coree_du_Sud </option>
                        <option value="Costa_Rica">Costa_Rica </option>
                        <option value="Cote_d_Ivoire">Côte_d_Ivoire </option>
                        <option value="Croatie">Croatie </option>
                        <option value="Cuba">Cuba </option>
                    </select>
                    <select id="languages" name="languages" class="rounded-input">
                        <option>Selectionner votre Language</option>
                        <option value="af">Afrikaans</option>
                        <option value="sq">Albanian - shqip</option>
                        <option value="am">Amharic - አማርኛ</option>
                        <option value="ar">Arabic - العربية</option>
                        <option value="an">Aragonese - aragonés</option>
                        <option value="hy">Armenian - հայերեն</option>
                        <option value="ast">Asturian - asturianu</option>
                        <option value="az">Azerbaijani - azərbaycan dili</option>
                        <option value="eu">Basque - euskara</option>
                        <option value="be">Belarusian - беларуская</option>
                        <option value="bn">Bengali - বাংলা</option>
                        <option value="bs">Bosnian - bosanski</option>
                        <option value="br">Breton - brezhoneg</option>
                        <option value="bg">Bulgarian - български</option>
                        <option value="ca">Catalan - català</option>
                        <option value="ckb">Central Kurdish - کوردی (دەستنوسی عەرەبی)</option>
                        <option value="zh">Chinese - 中文</option>
                        <option value="zh-HK">Chinese (Hong Kong) - 中文（香港）</option>
                        <option value="zh-CN">Chinese (Simplified) - 中文（简体）</option>
                        <option value="zh-TW">Chinese (Traditional) - 中文（繁體）</option>
                        <option value="co">Corsican</option>
                        <option value="hr">Croatian - hrvatski</option>
                        <option value="cs">Czech - čeština</option>
                        <option value="da">Danish - dansk</option>
                        <option value="nl">Dutch - Nederlands</option>
                        <option value="en">English</option>
                        <option value="en-AU">English (Australia)</option>
                        <option value="en-CA">English (Canada)</option>
                        <option value="en-IN">English (India)</option>
                        <option value="en-NZ">English (New Zealand)</option>
                        <option value="en-ZA">English (South Africa)</option>
                        <option value="en-GB">English (United Kingdom)</option>
                        <option value="en-US">English (United States)</option>
                        <option value="eo">Esperanto - esperanto</option>
                        <option value="et">Estonian - eesti</option>
                        <option value="fo">Faroese - føroyskt</option>
                        <option value="fil">Filipino</option>
                        <option value="fi">Finnish - suomi</option>
                        <option value="fr">French - français</option>
                        <option value="fr-CA">French (Canada) - français (Canada)</option>
                        <option value="fr-FR">French (France) - français (France)</option>
                        <option value="fr-CH">French (Switzerland) - français (Suisse)</option>
                        <option value="gl">Galician - galego</option>
                        <option value="ka">Georgian - ქართული</option>
                        <option value="de">German - Deutsch</option>
                        <option value="de-AT">German (Austria) - Deutsch (Österreich)</option>
                        <option value="de-DE">German (Germany) - Deutsch (Deutschland)</option>
                        <option value="de-LI">German (Liechtenstein) - Deutsch (Liechtenstein)</option>
                        <option value="de-CH">German (Switzerland) - Deutsch (Schweiz)</option>
                        <option value="el">Greek - Ελληνικά</option>
                        <option value="gn">Guarani</option>
                        <option value="gu">Gujarati - ગુજરાતી</option>
                        <option value="ha">Hausa</option>
                        <option value="haw">Hawaiian - ʻŌlelo Hawaiʻi</option>
                        <option value="he">Hebrew - עברית</option>
                        <option value="hi">Hindi - हिन्दी</option>
                        <option value="hu">Hungarian - magyar</option>
                        <option value="is">Icelandic - íslenska</option>
                        <option value="id">Indonesian - Indonesia</option>
                        <option value="ia">Interlingua</option>
                        <option value="ga">Irish - Gaeilge</option>
                        <option value="it">Italian - italiano</option>
                        <option value="it-IT">Italian (Italy) - italiano (Italia)</option>
                        <option value="it-CH">Italian (Switzerland) - italiano (Svizzera)</option>
                        <option value="ja">Japanese - 日本語</option>
                        <option value="kn">Kannada - ಕನ್ನಡ</option>
                        <option value="kk">Kazakh - қазақ тілі</option>
                        <option value="km">Khmer - ខ្មែរ</option>
                        <option value="ko">Korean - 한국어</option>
                        <option value="ku">Kurdish - Kurdî</option>
                        <option value="ky">Kyrgyz - кыргызча</option>
                        <option value="lo">Lao - ລາວ</option>
                        <option value="la">Latin</option>
                        <option value="lv">Latvian - latviešu</option>
                        <option value="ln">Lingala - lingála</option>
                        <option value="lt">Lithuanian - lietuvių</option>
                        <option value="mk">Macedonian - македонски</option>
                        <option value="ms">Malay - Bahasa Melayu</option>
                        <option value="ml">Malayalam - മലയാളം</option>
                        <option value="mt">Maltese - Malti</option>
                        <option value="mr">Marathi - मराठी</option>
                        <option value="mn">Mongolian - монгол</option>
                        <option value="ne">Nepali - नेपाली</option>
                        <option value="no">Norwegian - norsk</option>
                        <option value="nb">Norwegian Bokmål - norsk bokmål</option>
                        <option value="nn">Norwegian Nynorsk - nynorsk</option>
                        <option value="oc">Occitan</option>
                        <option value="or">Oriya - ଓଡ଼ିଆ</option>
                        <option value="om">Oromo - Oromoo</option>
                        <option value="ps">Pashto - پښتو</option>
                        <option value="fa">Persian - فارسی</option>
                        <option value="pl">Polish - polski</option>
                        <option value="pt">Portuguese - português</option>
                        <option value="pt-BR">Portuguese (Brazil) - português (Brasil)</option>
                        <option value="pt-PT">Portuguese (Portugal) - português (Portugal)</option>
                        <option value="pa">Punjabi - ਪੰਜਾਬੀ</option>
                        <option value="qu">Quechua</option>
                        <option value="ro">Romanian - română</option>
                        <option value="mo">Romanian (Moldova) - română (Moldova)</option>
                        <option value="rm">Romansh - rumantsch</option>
                        <option value="ru">Russian - русский</option>
                        <option value="gd">Scottish Gaelic</option>
                        <option value="sr">Serbian - српски</option>
                        <option value="sh">Serbo-Croatian - Srpskohrvatski</option>
                        <option value="sn">Shona - chiShona</option>
                        <option value="sd">Sindhi</option>
                        <option value="si">Sinhala - සිංහල</option>
                        <option value="sk">Slovak - slovenčina</option>
                        <option value="sl">Slovenian - slovenščina</option>
                        <option value="so">Somali - Soomaali</option>
                        <option value="st">Southern Sotho</option>
                        <option value="es">Spanish - español</option>
                        <option value="es-AR">Spanish (Argentina) - español (Argentina)</option>
                        <option value="es-419">Spanish (Latin America) - español (Latinoamérica)</option>
                        <option value="es-MX">Spanish (Mexico) - español (México)</option>
                        <option value="es-ES">Spanish (Spain) - español (España)</option>
                        <option value="es-US">Spanish (United States) - español (Estados Unidos)</option>
                        <option value="su">Sundanese</option>
                        <option value="sw">Swahili - Kiswahili</option>
                        <option value="sv">Swedish - svenska</option>
                        <option value="tg">Tajik - тоҷикӣ</option>
                        <option value="ta">Tamil - தமிழ்</option>
                        <option value="tt">Tatar</option>
                        <option value="te">Telugu - తెలుగు</option>
                        <option value="th">Thai - ไทย</option>
                        <option value="ti">Tigrinya - ትግርኛ</option>
                        <option value="to">Tongan - lea fakatonga</option>
                        <option value="tr">Turkish - Türkçe</option>
                        <option value="tk">Turkmen</option>
                        <option value="tw">Twi</option>
                        <option value="uk">Ukrainian - українська</option>
                        <option value="ur">Urdu - اردو</option>
                        <option value="ug">Uyghur</option>
                        <option value="uz">Uzbek - o‘zbek</option>
                        <option value="vi">Vietnamese - Tiếng Việt</option>
                        <option value="wa">Walloon - wa</option>
                        <option value="cy">Welsh - Cymraeg</option>
                        <option value="fy">Western Frisian</option>
                        <option value="xh">Xhosa</option>
                        <option value="yi">Yiddish</option>
                        <option value="yo">Yoruba - Èdè Yorùbá</option>
                        <option value="zu">Zulu - isiZulu</option>
                    </select>
                    <div>

                     <label for="info">J'ai lu et j'accepte les condition d'utilisation
                     </label>


                         <input type="checkbox" name="info" type="info"  checked="checked" id="info"  class="rounded-input" />
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


        users::register(users::$errors, $previousData);
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
