<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Registreeri konto</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>

<body style="background-color:lightgray;">
    <h1 align="center">Registreeri konto</h1>

    <form method="post" action="<?= $_SERVER['PHP_SELF'];?>">

        <input type="hidden" name="action" value="register">
        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">

        <table align="center">
            <tr>

                <td>Kasutajanimi</td>
                <td>
                    <input type="text" class="form-control" name="kasutajanimi" required>
                </td>
            </tr>
            <tr>
                <td>Parool</td>
                <td>
                    <input type="password" class="form-control" name="parool" required>
                </td>
            </tr>
        </table>

        <p align="center">
            <button type="submit" class="btn btn-success">Registreeri konto</button> või
            <a href="<?= $_SERVER['PHP_SELF'];?>?view=login">
					Logi sisse
				</a>
        </p>

    </form>

</body>

</html>
