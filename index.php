<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>::Maximovich</title>
    </head>
    <body>
        <h1>Maximovich</h1>
        <form method="POST" action="/">
            <textarea name="txtcomment" style="width:100%; height: 70px;" maxlength="300">бiлий</textarea><br /><br />
            <input type="submit" class="button" style="float: right; cursor:pointer;" value="Comment">
        </form>
        <?php
        $string =  $_POST['txtcomment'];
        $pairs = ["i" => "е", "и" => "ы"];
        $result = strtr($string, $pairs);
        echo $result;
        ?>
    </body>
</html>
