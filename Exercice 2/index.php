<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>On part en voyage</title>
    </head>
    <body align="center">
        <h1>Convertisseur de monnaie</h1>
        <form action="./index.php" method="GET">
            Entrez la valeur à convertir: <input type="text" name="input">
            Selectionnez la devise:
            <select name="currency" id="currency">
                <option value="usd">$ US Dollar</option>
                <option value="euro">€ Euro</option>
            </select>
            <input type="submit" name="convertir" value="Convertir">
        </form>
    </body>
</html>

<?php
    if(isset($_GET['convertir'])) {
        $cc_input = $_GET['input'];
        $cc_currency = $_GET['currency'];

        if ($cc_currency == 'usd') {
            $output = $cc_input * 0.814902945;
            echo "<h3>Cela vous fait $output Euro.<h3>";
        }
        elseif ($cc_currency == 'euro') {
            $output = $cc_input * 1.22714;
            echo "<h3>Cela vous fait" . $output . "USD.</h3>";
        }
    }
?>