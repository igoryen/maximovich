<?php
include 'config.php';
include $_SERVER['DOCUMENT_ROOT'] . "/text/pairs.php";
include $_SERVER['DOCUMENT_ROOT'] . "/text/pairs2.php";
include $_SERVER['DOCUMENT_ROOT'] . "/text/pangrams.php";
include $_SERVER['DOCUMENT_ROOT'] . "/text/yat.php";
include $_SERVER['DOCUMENT_ROOT'] . '/text/pairs.php';

$explanation = "A converter from the modern Ukrainian orthography to the system that is inspired by the system made by the Russian scientist Mikhail Maximovich (1804 — 1873), who wanted to use the traditional spelling but use diacritics to show the changed pronunciation. The goal is to help the Russian speakers to read Ukrainian.";
$use = "Paste a modern Ukrainian text into the text area and press 'Convert'";
$textarea = (isset($_POST['txtcomment'])) ? htmlentities($_POST['txtcomment']) : "";
$textarea = explode("\n", $textarea);

// macros

function filled($el) {
    $el = trim($el);
    $retval = (isset($el) AND ( !empty($el)));
    return $retval;
}

$textarea = array_filter($textarea, "filled");

function input($items) {
    foreach ($items as $item) {
        echo "<li>" . trim($item) . "</li>";
    }
}

function output($items) {
   
    foreach ($items as $item) {
        global $pairs;
        $item = strtr($item, $pairs);
        echo "<li>" . $item . "</li>";
    }
}
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
            .body_container {
                margin: 2em;
                padding-bottom: 3em;
            }
            .explanation {
                width: 90%;
                margin-left: auto;
                margin-right: auto;
                color: gray;
            }
            .text_panels_container {
                width: 90%; 
                margin-left: auto;
                margin-right: auto;
            }
            .panel {
                display: inline-block;
                width: 45%;
                float: left;
            }
            .input.panel {
                color: lightgray;
            }
        </style>
    </head>
    <body>
        <div class="body_container">
            <a href="http://www.igoryen.com">Back</a>
            <h1>Maximovich</h1>
            <div class="explanation">
                <p><?php echo $explanation; ?></p>
                <p><?php echo $use; ?></p>
            </div>
            
            <?php if (sizeof($textarea) > 0) { ?>
            <div class="text_panels_container">
                <div class="input panel">
                    <ol><?php input($textarea); ?></ol>
                </div>
                <div class="ouput panel">
                    <ol><?php output($textarea); ?></ol>
                </div>
            </div>
            <?php } ?>
            
            <div class="form_container">
                <div class="form">
                    <form method="POST">
                        <textarea name="txtcomment" style="width:100%; height: 70px;" maxlength="5000"><?php //var_dump($pangrams);?></textarea><br /><br />
                        <input type="submit" class="button" style="float: right; cursor:pointer;" value="Convert">
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>

