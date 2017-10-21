<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>La magnifique ville de <?=$ville['v_nom']; ?></title>
            <link rel="stylesheet" type="text/css" href="./assets/css/VilleStyle.css">
</head>
<body>
    <main class="main">
    <span>
<?php
echo $ville['v_nom'] . ': ' . $ville['v_superficie'] . 'km²<br>';
?>
</span>
Habitants : <br>
<ul>
    <?php
    foreach ($nains as $nain)
    {
        echo '<li><a href="?controler=nain&action=description&id=' . $nain['n_id'] . '">' . $nain['n_nom'] . '</a></li>';
    }
    ?>
</ul>
Tavernes locales : <br>
<ul>
    <?php
    foreach ($tavernes as $taverne)
    {
        echo '<li><a href="?controler=taverne&action=description&id=' . $taverne['t_id'] . '">' . $taverne['t_nom'] . '</a></li>';
    }
    ?>
</ul>
État des tunnels : <br>
<ul>
    <?php
    foreach ($tunnels as $tunnel)
    {
        $idVille = $tunnel['t_villedepart_fk'];
        $nomVille = $tunnel['v_dep'];
        if($id==$tunnel['t_villedepart_fk'])
        {
            $idVille = $tunnel['t_villearrivee_fk'];
            $nomVille = $tunnel['v_ar'];
        }
        $progres = $tunnel['t_progres'];
        if($progres >= 100)
        {
            $progres = 'Ouvert';
        }
        else
        {
            $progres .= '%';
        }

        echo '<li>Tunnel vers <a href="?controler=ville&action=description&id=' . $idVille . '">' . $nomVille . '</a> : ' . $progres . '</li>';
    }
    ?>
</ul>
</main>
</body>
</html>