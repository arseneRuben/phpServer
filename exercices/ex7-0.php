<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="icon.jpg">
    <title>Document</title>
    <style>
        body {
            width: 40%;
            margin: auto;
        }

        table,
        th,
        td {
            margin-top: 60px;
            border: 1px solid black;
        }
    </style>
</head>

<body>
    <?php
    // typiquement résultat d'une requête dans la BD
    $produits = [
        [
            'id' => 'td1234',
            'nom' => 'tondeuse',
            'prix' => 199.99,
            'poidsKg' => 50,
        ],
        [
            'id' => 'ra9xfg',
            'nom' => 'râteau',
            'prix' => 19.99,
            'poidsKg' => 5,
        ],
        [
            'id' => 'pe4532',
            'nom' => 'pelle',
            'prix' => 19.99,
            'poidsKg' => 5,
        ],
    ];
    ?>

</body>

</html>

<table>
    <thead>
        <th>Nom</th>
        <th>No</th>
        <th>Prix</th>
        <th>Poids Kg</th>
    </thead>
    <?php
    foreach ($produits as $produit) {
        echo "<tr><td>" . $produit['nom'] . "</td><td>" . $produit['id'] . "</td><td>" . $produit['prix'] . "</td><td>" . $produit['poidsKg'] . "</td></tr>";
    }
    ?>

</table>

<?php
function  tableAffiche($table)
{
    echo "<table><thead>";
    foreach (array_keys($table[0]) as $key) {
        echo "<th>" . $key . "</th>";
    }

    echo  "</thead><tbody>";


    foreach ($table as $produit) {
        echo "<tr>";
        foreach (array_keys($table[0]) as $key) {
            echo "<td>" . $produit[$key] . "</td>";
        }
        echo "</tr>";
    }

    echo  "</tbody></table>";
}

function  tableToHtml($table)
{
    if ($table === []) {
        $html = "tableau vide";
    } else {
        $html = "<table><thead>";
        foreach (array_keys($table[0]) as $key) {
            $html .= "<th>" . $key . "</th>";
        }

        $html .=  "</thead><tbody>";


        foreach ($table as $produit) {
            $html .= "<tr>";
            foreach (array_keys($table[0]) as $key) {
                $html .= "<td>" . $produit[$key] . "</td>";
            }
            $html .= "</tr>";
        }

        $html .=  "</tbody></table>";
    }
    return $html;
}
tableAffiche($produits);
$users = [
    ['id' => 0, 'email' => 'Yannick@gmail.com', 'pw' => '12345678'],
    ['id' => 1, 'email' => 'Victor@test.com', 'pw' => '11111111'],
    ['id' => 2, 'email' => 'Christian@victoire.ca', 'pw' => '22222222'],
];
echo tableToHtml($users);

?>