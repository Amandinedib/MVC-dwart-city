<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Page de <?=$nain['n_nom']; ?></title>
    	<link rel="stylesheet" type="text/css" href="./assets/css/NainStyle.css">
</head>
<body>

    <main class="main">
        <?php
        if($error != '')
        {
            echo $error . '<br><br>';
        }
        ?>

        Le nain <?=$nain['n_nom']?> a une barbe de <?=$nain['n_barbe']?> cm<br />
        Il est originaire de <a href="?controler=ville&action=description&id=<?=$nain['n_ville_fk']?>"><?=$nain['v_natale']?></a><br />

        <?php
        if(isset($nain['g_taverne_fk']))
        {
            echo 'Bois dans <a href="?controler=taverne&action=description&id=' . $nain['g_taverne_fk'] . '">' . $nain['t_nom'] . '</a><br />';
        }

        if(isset($nain['n_groupe_fk']))
        {
            echo 'Membre du <a href="?controler=groupe&action=description&id=' . $nain['n_groupe_fk'] . '">groupe ' . $nain['n_groupe_fk'] . '</a><br />';
            if(isset($nain['t_villedepart_fk']))	//If these are present, all needed data is present
            {
                echo 'Travaille de ' . $nain['g_debuttravail'] . ' à ' . $nain['g_fintravail'] . ' dans le tunnel de 
                    <a href="?controler=ville&action=description&id=' . $nain['t_villedepart_fk'] . '">' . $nain['v_depart'] . '</a> à 
                    <a href="?controler=ville&action=description&id=' . $nain['t_villearrivee_fk'] . '">' . $nain['v_arrivee'] . '</a><br>';
            }
        }
        ?>

        <form method="post" action="">
            <label for="groupSelect">Lui choisir un ouveau groupe :</label>
            <select id="groupSelect" name="new_group">
                <option value="" <?php if(!isset($nain['n_groupe_fk'])) echo 'selected'; ?>>Aucun</option>
                <?php
                foreach ($groupes as $idGroupe)
                {
                    echo '<option' . ($idGroupe == $nain['n_groupe_fk'] ? ' selected' : '') . '>' . $idGroupe . '</option>';
                }
                ?>
            </select>

            <input type="hidden" name="action" value="update" />
            <input type="hidden" name="controler" value="groupe"/>
            <input class="submit" type="submit" value="Valider" />
        </form>
    </main>
</body>
</html>