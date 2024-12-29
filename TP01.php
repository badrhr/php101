<?php
$etudiants[] = array("Moujtahid", "Moujidd", "IAGI", 18);
$etudiants[] = ["Karimi", "Karima", "IAGI", 16];
$etudiants[] = ["Omari", "Omar", "IAGI", 15];
$etudiants[] = ["Kaddouri", "Kaddour", "GSI", 15];
$etudiants[] = ["Brahimi", "Brahim", "GSI", 16];
$etudiants[] = array("Dahmani", "Dahmane", "GM", 15);
$etudiants[] = ["Jallouli", "Jalloul", "GSI", 16];
$etudiants[] = ["Khldouni", "Khalid", "GM", 14];
$etudiants[] = ["Aissaoui", "Aissa", "GSI", 13];
$etudiants[] = ["Kaslani", "Kassoul", "IAGI", 3];
$etudiants[] = ["Kaslani", "Kaslana", "GM", 4];

function getListeEtudiants($filiere){
    global $etudiants ;
    $liste = array();
    for ($i = 0; $i < count($etudiants); $i++) {
        if (strtoupper($etudiants[$i][2]) == strtoupper($filiere)
                            and $etudiants[$i][3] >= MOY)
            $liste[] = $etudiants[$i];
    }
    return $liste;
}

function getNotes($filiere)
{
    $liste = getListeEtudiants($filiere);
    $notes = array();

    $i = 0;
    while ($i < count($liste)) {
        $notes[] = $liste[$i][3];
        $i++;
    }
    return $notes;
}

function getMax(array $t)
{
    $max = $t[0];
    for ($i = 1; $i < count($t); $i++) {
        if ($max < $t[$i]) $max = $t[$i];
    }
    return $max;
}

function getMention($n)
{
    if (0 <= $n and $n < MOY)
        return "Ajourné!";
    elseif (MOY <= $n && $n < 12)
        return "PASSABLE";
    elseif (12 <= $n && $n < 14)
        return "ASSEZ BIEN";
    elseif (14 <= $n && $n < 16)
        return "BIEN";
    elseif (16 <= $n && $n <= 20)
        return "TRES BIEN";
    else
        return "Note non valide!";
}

define("MOY", 10);

$filiere = isset($_GET["f"]) ? $_GET["f"] : "IAGI";
$liste = getListeEtudiants($filiere);
$nombre = count($liste);
$max = getMax(getNotes($filiere));
?>

<h1>Liste des étudiants réussis de la filière: <?= $filiere ?></h1>
<hr/>
<b>Nombre des étudiants réussis de cette filière : <?= $nombre ?> </b><br/>
<b>Meilleure note de cette filière : <?= $max ?></b> <br/>
<hr/>
<table border="1" align="center" width="60%">
    <tr>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Note</th>
        <th>Mention</th>
    </tr>
    <?php
    foreach ($liste as $e) { ?>
        <tr>
            <td> <?= $e[0] ?> </td>
            <td> <?= $e[1] ?> </td>
            <td> <?= $e[3] ?> </td>
            <td> <?= getMention($e[3]) ?> </td>
        </tr>
    <?php } ?>
</table>
