<?php
$lang = 'fr-CA';
$title = 'ClassicModels.com - Acceuil';
$description = 'Le plus vaste de choix de modèles réduits - Voitures - Camions - Avions - Motos et plus';
$author = 'Votre nom ici';
$icon = 'icon.jpg';
$content = 'bla bla bla bla bla ceci est le contenu de la page';
define('COMPANY_NAME', 'ScooterElectrique.com');
define('COMPANY_STREET_ADDRESS', '5340 St-Laurent');
define('COMPANY_CITY', 'Montréal');
define('COMPANY_PROVINCE', 'QC');
define('COMPANY_COUNTRY', 'Canada');
define('COMPANY_POSTAL_CODE', 'J0P 1T0');
define('COMPANY_EMAIL', 'fopoar@gmail.com');
define('COMPANY_PHONE_NUMBER', '+145876598568');

?>
<!DOCTYPE html>
<html lang="<?= $lang ?>">

<head>
    <meta charset="UTF-8">
    <title><?= $lang; ?></title>
    <meta name="DESCRIPTION" content="<?= $description ?>">
    <meta name="author" content=" <?= $content ?>">
    <!-- web site icon -->
    <LINK REL="icon" href=" <?= $icon ?>">

    <!--IMPORTANT pour responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

</head>

<body>

    <!-- PAGE HEADER -->
    <header>
        <h2 style="background-color:black;color:white;padding:10px">
            <?= $lang ?>
        </h2>
    </header>

    <!-- BARRE DE NAVIGATION -->
    <nav style="background-color:blue;color:white;padding:10px">
        <a href='page.php'>Acceuil</a>
    </nav>

    <!-- CONTENT -->
    <?php echo $content ?>

    <!-- FOOTER -->
    <footer style="background-color:black;color:white;padding:10px">
        Exercice par <?= $author ?> &copy;
        <p><?php echo COMPANY_STREET_ADDRESS . ' ' . COMPANY_PROVINCE . ' ' . COMPANY_COUNTRY . ' ' . COMPANY_POSTAL_CODE . '</p><p>' . COMPANY_PHONE_NUMBER . '  <a href="mailto:name@rapidtables.com">' . COMPANY_EMAIL . '</a>

 </p>' ?></p>
    </footer>
    </div>
</body>

</html>