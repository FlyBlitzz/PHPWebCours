<?php
function convertirDuree($minutes)
{
    $heures = floor($minutes / 60);
    $min = $minutes % 60;
    return $heures . "h " . $min . "min";
}

function afficherErreurChamp($nomChamp, $erreurs)
{
    if (isset($erreurs[$nomChamp])) {
        return '<span class="erreur-champ">' . htmlspecialchars($erreurs[$nomChamp]) . '</span>';
    }
    return '';
}