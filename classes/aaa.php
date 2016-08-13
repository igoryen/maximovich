<?php


class Aaa {

    var $path;
    var $textarea;
    var $speech_parts;

    function __construct($path, $ta, $sp) {
        $this->path = $path;
        $this->textarea = $ta;
        $this->speech_parts = $sp;
        $this->textarea = array_filter($this->textarea, [$this, "filled"]);
        //echo "path: " . $this->path;
    }

    function getAry($ary) {
        global $path;
        $myFile = $path . $ary . ".txt";
        $array = array();
        foreach (file($myFile) as $line) {
            list($key, $value) = explode(' ', $line, 2) + array(NULL, NULL);

            if ($value !== NULL) {
                $array[$key] = trim($value);
            }
        }
        return $array;
    }

    function filled($el) {
        $el = trim($el);
        $retval = (isset($el) AND ( !empty($el)));
        return $retval;
    }

    function input() {
        foreach ($this->textarea as $item) {
            echo "<li>" . trim($item) . "</li>";
        }
    }

    function output() {
        // for each sentence from textarea
        foreach ($this->textarea as $item) {
            // for each word of part of speech class
            foreach ($this->speech_parts as $part) {
                // run one textarea sentence through all speech parts
                $item = strtr($item, $this->getAry($part));
            }
            // print out a ready sentence
            echo "<li>" . $item . "</li>";
        }
    }
}
