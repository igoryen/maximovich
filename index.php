<?php
//include 'config.php';
include $_SERVER['DOCUMENT_ROOT'] . '/classes/aaa.php';

$explanation = "A converter from the modern Ukrainian orthography to the system that is inspired by the system made by the Russian scientist Mikhail Maximovich (1804 — 1873), who wanted to use the traditional spelling but use diacritics to show the changed pronunciation. The goal is to help the Russian speakers to read Ukrainian.";
$use = "Paste a modern Ukrainian text into the text area and press 'Convert'";
$textarea_string = (isset($_POST['txtcomment'])) ? htmlentities($_POST['txtcomment']) : "";
$textarea_string = trim($textarea_string);
$textarea = preg_split('@(?<=\.|!|\?)@', $textarea_string);

$path = $_SERVER['DOCUMENT_ROOT'] . "/text/";

$speech_parts = [
    "prepositions",
    "adverbs",
    "stems",
    "endings",
    "numerals",
    "prefixes",
    "pronouns",
    "suffixes",
    "chars"
];

$aaa = new Aaa($path, $textarea, $speech_parts);
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
        <script src="/css/style.css"></script>
        <link rel="stylesheet" href="/css/style.css">
    </head>
    <body>
        <div class="body_container">
            <a href="http://www.igoryen.com">Back</a>
            <h1>Maximovich</h1>
            <div class="explanation">
                <p><?php echo $explanation; ?></p>
                <p><?php echo $use; ?></p>
            </div>

            <?php if (strlen($textarea_string) > 0) { ?>
                <div class="text_panels_container">
                    <div class="panel incoming">
                        <ol><?php $aaa->input(); ?></ol>
                    </div>
                    <div class="panel outcoming">
                        <ol><?php $aaa->output(); ?></ol>
                    </div>
                </div>
            <?php } ?>

            <div class="form_container">
                <div class="form">
                    <form method="POST">
                        <input type="submit" class="button" value="Convert">
                        <textarea name="txtcomment" maxlength="5000"><?php //var_dump($pangrams); ?></textarea>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>

