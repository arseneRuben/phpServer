<?php

function dataToTd($data)
{
    return '<td>' . $data . '</td>';
}

function keyToTh($key)
{
    return  '<th>' . $key . '</th>';
}

// IN $keys = ['id', 'nom', 'prenom']
// OUT <tr><th>id</th><th>nom</th><th>prenom</th>
function keysToTr($keys)
{
    $result = '<tr><td>';

    $result .= implode('</td><td>', $keys);
    $result .= '</td></tr>';
    return $result;
}

$keys = ['id', 'nom', 'prenom'];
var_dump(keysToTr($keys));
