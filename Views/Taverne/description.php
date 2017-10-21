<!DOCTYPE html>
<html>
<head>
    <meta charset="utf8"/>
    <title><?php echo $taverne['t_nom']; ?></title>
        	<link rel="stylesheet" type="text/css" href="./assets/css/TaverneStyle.css">
</head>
<body>
	<main class="main">
		<?php
		echo $taverne['t_nom'] . ', <a href="?controler=ville&action=description&id=' . $taverne['t_ville_fk'] . '">' . $taverne['v_nom'] . '</a><br>';
		$bieres = array();
		if($taverne['t_blonde'])	//Mais?
		{
		    $bieres[] = 'blonde';
		}
		if($taverne['t_brune'])		//C'est pas des booléens?!
		{
		    $bieres[] = 'brune';
		}
		if($taverne['t_rousse'])	//Comment ça marche?
		{
		    $bieres[] = 'rousse';
		}

		echo 'Nous possédons de la bière ';
		$last = array_pop($bieres);
		if(count($bieres) > 0)
		    echo implode(', ', $bieres) . ' et ';
		echo $last . '.';

		echo '<br>' . $taverne['t_chambres'] . ' chambres, dont ' . $taverne['chambresLibres'] . ' libres';
		?>
</main>
</body>
</html>