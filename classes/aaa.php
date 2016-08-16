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
    
    /**
     * Get array of speech parts from text file
     * @global string $path
     * @param array $ary
     * @return array
     */
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
    
    /**
     * 
     * @param type $el
     * @return boolean
     */
    function filled($el) {
        $el = trim($el);
        $retval = (isset($el) AND ( !empty($el)));
        return $retval;
    }
    
    /**
     * display the input sentences
     */
    function input() {
        foreach ($this->textarea as $item) {
            echo "<li>" . trim($item) . "</li>";
        }
    }
    /**
     * Checks whether a string starts with an uppercase character
     * @param type $str a string to check
     * @return type
     */
    function starts_with_upper($str) {
        $chr = mb_substr ($str, 0, 1, "UTF-8");
        return mb_strtolower($chr, "UTF-8") != $chr;
    }
    
    /**
     * Capitalizes the string (make the first char uppercase)
     * @param type $string
     * @param type $encoding
     * @return type capitalized word
     */
    function mb_ucfirst($string, $encoding){
        $strlen = mb_strlen($string, $encoding);
        $firstChar = mb_substr($string, 0, 1, $encoding);
        $then = mb_substr($string, 1, $strlen - 1, $encoding);
        return mb_strtoupper($firstChar, $encoding) . $then;
    }
    
    /**
     * De-capitalize the string (make the first char lowercase)
     * @param type $string
     * @param type $encoding
     * @return type
     */
    function mb_lcfirst($string, $encoding){
        $strlen = mb_strlen($string, $encoding);
        $firstChar = mb_substr($string, 0, 1, $encoding);
        $then = mb_substr($string, 1, $strlen - 1, $encoding);
        return mb_strtolower($firstChar, $encoding) . $then;
    }
    
    /**
     * Process the word, make character replacements if needed
     * @param type $word
     * @return type
     */
    function process_word($word){
        // if the word is capitalized
        if($this->starts_with_upper($word)) {
            // de-capitalize the word
            $word = $this->mb_lcfirst($word, "utf8");
            // run the word through speech part arrays
            foreach ($this->speech_parts as $part) {
                $word = strtr($word, $this->getAry($part));
            }
            // capitalize the word again
            $word = $this->mb_ucfirst($word, "utf8");
            }
            else {
                foreach ($this->speech_parts as $part) {
                    $word = strtr($word, $this->getAry($part));
                }
            }
        return $word;
    }
    
    /**
     * output the processed sentences 
     */
    function output() {
        // take each sentence from textarea
        foreach ($this->textarea as $sentence) {
            // "explode" the sentence into words (breaking it at delimiter)
            $words = explode(" ", $sentence);
            //var_dump($words);
            $ready_to_implode = [];
            // take each word
            foreach($words as $word) {
                
                // run the word through each string in the part of speech
                $word = $this->process_word($word);
                // push the processed word to the ready-to-implode array
                array_push($ready_to_implode, $word);
            }
            // implode the ready-to-implode array of processed words into a ready-to-print sentence
            $ready_to_print = implode(" ", $ready_to_implode);
            // print out the ready sentence
            echo "<li>" . $ready_to_print . "</li>";
        }
    }
}
