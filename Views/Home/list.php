<!DOCTYPE html>
<html>
<head>
	<title>Dwarf Town</title>
	<link rel="stylesheet" type="text/css" href="./assets/css/HomeStyle.css">

</head>
<body>

<h1>Bienvenue à Dwarf City</h1>
    <main class="main">
        	<form method="get" action="">
                <select name="id">
                    <?php
                    foreach ($nains as $nain)
                    {
                        echo '<option value=' . $nain['n_id'] . '>' . $nain['n_nom'] . '</option>';
                    }
                    ?>
                </select>

                <input type="hidden" name="action" value="description" />
                <input type="hidden" name="controler" value="nain"/>
                <input class="submit" type="submit" value="Valider"/>
        </form>
        <form method="get" action="">
            <select name="id">
                <?php
                foreach ($villes as $ville)
                {
                    echo '<option value=' . $ville['v_id'] . '>' . $ville['v_nom'] . '</option>';
                }
                ?>
            </select>

            <input type="hidden" name="action" value="description" />
            <input type="hidden" name="controler" value="ville"/>
            <input class="submit" type="submit" value="Valider"/>
        </form>
        <form method="get" action="">
            <select name="id">
                <?php
                foreach ($tavernes as $taverne)
                {
                    echo '<option value=' . $taverne['t_id'] . '>' . $taverne['t_nom'] . '</option>';
                }
                ?>
            </select>

            <input type="hidden" name="action" value="description" />
            <input type="hidden" name="controler" value="taverne" />
            <input class="submit" type="submit" value="Valider"/>
        </form>
        <form method="get" action="">
            <select name="id">
                <?php
                foreach ($groupes as $groupe)
                {
                    echo '<option>' . $groupe . '</option>';	//Used PDO::FETCH_COLUMN, not associative
                }
                ?>
            </select>

            <input type="hidden" name="action" value="description" />
            <input type="hidden" name="controler" value="groupe" />
            <input class="submit" type="submit" value="Valider"/>
        </form>
	</main>
</body>
</html>