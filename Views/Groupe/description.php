<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Groupe n°<?php echo $groupe['g_id'] ?></title>
    <link rel="stylesheet" type="text/css" href="./assets/css/GroupeStyle.css">
</head>
<body>
<main class="main">
    <?php
    if($error)
    {
        die($error);
    }
    ?>

    <p>Groupe n°<?=$groupe['g_id']?></p>

   <p> Les membres sont : </p>
    <ul>
        <?php
        foreach ($nains as $nain)
        {
            echo '<li><a href="?controler=nain&action=description&id=' . $nain['n_id'] . '">' . $nain['n_nom'] . '</a></li>';
        }
        ?>
    </ul>
    
    <?php
    if(isset($groupe['g_taverne_fk']))
    {
        echo 'Ils vont boire une petite bière chez <a href="?controler=taverne&action=description&id=' . $groupe['g_taverne_fk'] . '">' . $groupe['t_nom'] . '</a><br>';
    }
    else
    {
        echo 'OH MON DIEU ILS SONT SOBRES!!! Tavernes libres :<ul>';

        foreach ($tavernesLibres as $taverne)
        {
            $conseil = '';
            if(isset($groupe['g_tunnel_fk']) && ($taverne['t_ville_fk'] == $groupe['t_villedepart_fk'] || ($taverne['t_ville_fk'] == $groupe['t_villearrivee_fk'] && $groupe['t_progres'] >= 100) ))
            {
                $conseil = '(conseillée)';
            }

            echo '<li><a href="?controler=taverne&action=description&id=' . $taverne['t_id'] . '">' . $taverne['t_nom'] . $conseil . '</a></li>';
        }

        echo '</ul>';
    }
    if(isset($groupe['g_tunnel_fk']))
    {
        echo ($groupe['t_progres'] >= 100 ? 'Ils entretiennent' : 'Creusent') . ' de ' . $groupe['g_debuttravail'] . ' à ' . $groupe['g_fintravail'] . ' le tunnel de 
            <a href="?controler=ville&action=description&id=' . $groupe['t_villedepart_fk'] . '">' . $groupe['v_dep'] . '</a> à 
            <a href="?controler=ville&action=description&id=' . $groupe['t_villearrivee_fk'] . '">' . $groupe['v_ar'] . '</a> ' . ($groupe['t_progres'] < 100 ? '('.$groupe['t_progres'].'%)' : '');
    }
    ?>


    Changement attributions :
    <form action="" method="post">
        <input type="hidden" name="controler" value="groupe" />
        <input type="hidden" name="action" value="update" />
        <input type="time" name="debut" step=1 value="<?php echo $groupe['g_debuttravail']; ?>"/>
        <input type="time" name="fin" step=1 value="<?php echo $groupe['g_fintravail']; ?>"/>

        <select name="taverne">
            <option value="" <?php if(!isset($groupe['g_taverne_fk'])) echo 'selected'; ?>>Aucune</option>
            <?php
            foreach ($tavernesLibres as $taverne)
            {
                echo '<option value="' . $taverne['t_id'] . '"' . ($groupe['g_taverne_fk'] == $taverne['t_id'] ? ' selected' : '') . '>' . $taverne['t_nom'] . '</option>';
            }
            ?>
        </select>
        <select name="tunnel">
            <option value="" <?php if(!isset($groupe['g_tunnel_fk'])) echo 'selected'; ?>>Aucun</option>
            <?php
            foreach ($tunnels as $tunnel)
            {
                echo '<option value="' . $tunnel['t_id'] . '"' . ($groupe['g_tunnel_fk'] == $tunnel['t_id'] ? ' selected' : '') . '>' . $tunnel['v_dep'] . ' -> ' . $tunnel['v_ar'] . '(' . $tunnel['t_progres'] . '%)</option>';
            }
            ?>
        </select>
        <input class="submit" type="submit" />
    </form>
</main>
</body>
</html>