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
