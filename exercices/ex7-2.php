<?php
/* Tableau des mois de l'année */
$moisCouleurs = [
    'Janvier' => 'blue',
    'Février' => 'white',
    'Mars' => 'Red',
    'Avril' => 'Yellow',
    'Mai' => 'Grey',
    'Juin' => 'Lime',
    'Juillet' => 'lightblue',
    'Août' => 'fuchsia',
    'Septembre' => 'lightgrey',
    'Octobre' => 'olive',
    'Novembre' => 'pink',
    'Décembre' => 'purple',
];
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <title>Exercice 7-2 Tableau mois</title>
    <style>
        .container {
            width: 80%;
            border: 1px solid brown;
            margin: 10px;
            padding: 20px;
        }
    </style>
</head>

<body>
    <div id="wrapper">
        <header>
            <h1>Tableau mois</h1>
        </header>
        <main>
            <div class="container">
                <!--Première table -->
                <table>
                    <?php
                    $content = "";
                    foreach ($moisCouleurs as $key => $value) {
                        $content .= '<tr><td bgcolor="' . $value . '">' . $key . '</td></tr>';
                    }
                    echo $content;
                    ?>
                </table>
            </div>
            <div class="container">
                <!--Seconde table -->
                <table>
                    <?php
                    $content = "<tr>";
                    foreach ($moisCouleurs as $key => $value) {
                        $content .= '<td bgcolor="' . $value . '">' . $key . '</td>';
                    }
                    $content .= "</tr>";
                    echo $content;
                    ?>
                </table>
            </div>
        </main>
        <footer>
        </footer>
    </div>
</body>

</html>