<?php
    include '/text/pairs.php';
    include '/text/pairs2.php';
    include '/text/pangrams.php';
    include '/text/yat.php';
    
    $textarea = $_POST ? htmlentities($_POST['txtcomment']) : "" ;
    $textarea = explode("\n", $textarea);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>::Maximovich</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <style>
            .panel {
                display: inline-block;
                width: 45%;
                float: left;
            }
        </style>
    </head>
    <body>
        <h1>Maximovich</h1>
        <div class="text_panels">
            <div class="input panel">
                <ol>
                    <?php 
                    foreach ($textarea as $item) {
                        echo "<li>" . $item . "</li>";
                    }
                    ?>
                </ol>
            </div>
            <div class="ouput panel">
                
                <ol>
                    <?php
                   
                    function non_empty($el) {
                        return(!($el == " " || $el == ""));
                    }
                    $textarea = array_filter($textarea, "non_empty");
                    //var_dump($textarea);
                    foreach ($textarea as $item) {
                        //$item = strtr($item, $pairs2);
                        $item = strtr($item, $pairs);
                        echo "<li>" . $item . "</li>";
                    }
                    ?>
                </ol>
            </div>
        </div>
        <div class="form">
            <form method="POST" action="/">
                <textarea name="txtcomment" style="width:100%; height: 70px;" maxlength="5000"></textarea><br /><br />
                <input type="submit" class="button" style="float: right; cursor:pointer;" value="Convert">
            </form>
        </div>
    </body>
</html>
