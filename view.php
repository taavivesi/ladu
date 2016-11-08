<!doctype HTML>
<html>

<head>
    <title>Ladu</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <meta charset="utf-8">

    <style>
        #lisa-vorm {
            display: none;
        }

        * {
            text-align: -moz-center;
        }

        table {
            table-layout: fixed;
        }

        td {
            word-wrap: break-word
        }
    </style>

</head>

<body align="center" style="background-color:lightgray;">

    <?php foreach (message_list() as $message): ?>

    <p style="border: 1px solid red; background: #ff7070; color: #000000;" align="center" ;>
        <?= $message; ?>
    </p>

    <?php endforeach; ?>


    <div style="float: right">
        <form method="post" action="<?= $_SERVER['PHP_SELF'];?>">
            <input type="hidden" name="action" value="logout">
            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">
            <button type="submit" class="btn btn-danger btn-xs">Logi välja</button>
        </form>
    </div>

    <h1>Ladu</h1>

    <p id="kuva-nupp">
        <button type="button" class="btn btn-info">Kuva lisamise vorm</button>
    </p>

    <form id="lisa-vorm" method="post" action="<?= $_SERVER['PHP_SELF'];?>">

        <input type="hidden" name="action" value="add">
        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">

        <p id="peida-nupp">
            <button type="button" class="btn btn-info">Peida lisamise vorm</button>
        </p>

        <p>&nbsp;</p>

        <table align="center">
            <tr>
                <td>Nimetus</td>
                <td>
                    <input type="text" class="form-control" id="nimetus" name="nimetus">
                </td>
            </tr>
            <tr>
                <td>Kogus</td>
                <td>
                    <input type="number" class="form-control" id="kogus" name="kogus">
                </td>
            </tr>
        </table>

        <p>&nbsp;</p>

        <p>
            <button type="submit" class="btn btn-info">Lisa kirje</button>
        </p>

    </form>

    <table id="ladu" align: "left"; class="table table-condensed" style="color:black; background-color:lightgray;">
        <thead>
            <tr>
                <th>Nimetus</th>
                <th>Kogus</th>
                <th>Tegevused</th>
            </tr>
        </thead>

        <tbody style="color:black; background-color:lightgray;">

            <?php

        foreach ( model_load($page) as $rida): ?>

                <tr style="color:black; background-color:lightgray;">
                    <td>
                        <?=
                        htmlspecialchars($rida['Nimetus']);
                    ?>
                    </td>
                    <td>
                        <form method="post" action="<?= $_SERVER['PHP_SELF'];?>">
                            <input type="hidden" name="action" value="update">
                            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'];?>">
                            <input type="hidden" name="id" value="<?= $rida['id']; ?>">
                            <input type="number" name="kogus" value="<?= $rida['Kogus']; ?>" style="width: 6em; text-align: right;">
                            <button type="submit" class="btn btn-success">Uuenda</button>
                        </form>

                    </td>
                    <td>

                        <form method="post" action="<?= $_SERVER['PHP_SELF'];?>">
                            <input type="hidden" name="action" value="delete">
                            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'];?>">
                            <input type="hidden" name="id" value="<?= $rida['id']; ?>">
                            <button type="submit" class="btn btn-primary ">Kustuta rida</button>
                        </form>

                    </td>
                </tr>

                <?php endforeach; ?>

        </tbody style="background-color:lightgray;">
    </table>

    <p>
        <?php
    	if(isset($_GET['page'])):
    		if($_GET['page'] != 0): ?>

            <a href="<?= $_SERVER['PHP_SELF']?>?page=<?= $page - 1 ?>">
		    		eelmisele lehele
		    	</a>
            <?php
    	 	endif;
    	endif;
    	if (next_page($page)): ?>
                |
                <a href="<?= $_SERVER['PHP_SELF']?>?page=<?= $page + 1 ?>">
	    		järgmisele lehele
	    	</a>

                <?php
    	endif; ?>
    </p>

    <script src="ladu.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>

</html>
