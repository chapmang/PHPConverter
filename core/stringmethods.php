<?php

namespace PHPConverter\Core {

    class StringMethods {

        /**
         * Cache application encoding locally to save expensive calls to Config::get().
         *
         * @var string
         */
        public static $encoding = null;

        /**
         * Get the appliction.encoding without needing to request it from Config::get() each time.
         *
         * @return string
         */
        protected static function encoding()
        {
            return static::$encoding ?: static::$encoding = Configuration::get('application.encoding');
        }


        public static function length($value) {
            return (MB_STRING) ? mb_strlen($value, static::encoding()):strlen($value);
        }

        private static $_delimiter = "#";
        
        private static $_singular = array(
            "(matr)ices$" => "\\1ix",
            "(vert|ind)ices$" => "\\1ex",
            "^(ox)en" => "\\1",
            "(alias)es$" => "\\1",
            "([octop|vir])i$" => "\\1us",
            "(cris|ax|test)es$" => "\\1is",
            "(shoe)s$" => "\\1",
            "(o)es$" => "\\1",
            "(bus|campus)es$" => "\\1",
            "([m|l])ice$" => "\\1ouse",
            "(x|ch|ss|sh)es$" => "\\1",
            "(m)ovies$" => "\\1\\2ovie",
            "(s)eries$" => "\\1\\2eries",
            "([^aeiouy]|qu)ies$" => "\\1y",
            "([lr])ves$" => "\\1f",
            "(tive)s$" => "\\1",
            "(hive)s$" => "\\1",
            "([^f])ves$" => "\\1fe",
            "(^analy)ses$" => "\\1sis",
            "((a)naly|(b)a|(d)iagno|(p)arenthe|(p)rogno|(s)ynop|(t)he)ses$" => "\\1\\2sis",
            "([ti])a$" => "\\1um",
            "(p)eople$" => "\\1\\2erson",
            "(m)en$" => "\\1an",
            "(s)tatuses$" => "\\1\\2tatus",
            "(c)hildren$" => "\\1\\2hild",
            "(n)ews$" => "\\1\\2ews",
            "([^u])s$" => "\\1"
        );
        
        private static $_plural = array(
            "^(ox)$" => "\\1\\2en",
            "([m|l])ouse$" => "\\1ice",
            "(matr|vert|ind)ix|ex$" => "\\1ices",
            "(x|ch|ss|sh)$" => "\\1es",
            "([^aeiouy]|qu)y$" => "\\1ies",
            "(hive)$" => "\\1s",
            "(?:([^f])fe|([lr])f)$" => "\\1\\2ves",
            "sis$" => "ses",
            "([ti])um$" => "\\1a",
            "(p)erson$" => "\\1eople",
            "(m)an$" => "\\1en",
            "(c)hild$" => "\\1hildren",
            "(buffal|tomat)o$" => "\\1\\2oes",
            "(bu|campu)s$" => "\\1\\2ses",
            "(alias|status|virus)" => "\\1es",
            "(octop)us$" => "\\1i",
            "(ax|cris|test)is$" => "\\1es",
            "s$" => "s",
            "$" => "s"
        );
        
        private function __construct()
        {
            // do nothing
        }
        
        private function __clone()
        {
            // do nothing
        }
        
        private static function _normalize($pattern)
        {
            return self::$_delimiter.trim($pattern, self::$_delimiter).self::$_delimiter;
        }
        
        public static function getDelimiter()
        {
            return self::$_delimiter;
        }
        
        public static function setDelimiter($delimiter)
        {
            self::$_delimiter = $delimiter;
        }
        
        public static function match($string, $pattern)
        {
            preg_match_all(self::_normalize($pattern), $string, $matches, PREG_PATTERN_ORDER);
            
            if (!empty($matches[1]))
            {
                return $matches[1];
            }
            
            if (!empty($matches[0]))
            {
                return $matches[0];
            }
            
            return null;
        }
        
        public static function split($string, $pattern, $limit = null)
        {
            $flags = PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE;
            return preg_split(self::_normalize($pattern), $string, $limit, $flags);
        }
        
        public static function sanitize($string, $mask)
        {
            if (is_array($mask))
            {
                $parts = $mask;
            }
            else if (is_string($mask))
            {
                $parts = str_split($mask);
            }
            else
            {
                return $string;
            }
            
            foreach ($parts as $part)
            {
                $normalized = self::_normalize("\\{$part}");
                $string = preg_replace(
                    "{$normalized}m",
                    "\\{$part}",
                    $string
                );
            }
            
            return $string;
        }
        
        public static function unique($string)
        {
            $unique = "";
            $parts = str_split($string);
            
            foreach ($parts as $part)
            {
                if (!strstr($unique, $part))
                {
                    $unique .= $part;
                }
            }
            
            return $unique;
        }
            
        public static function indexOf($string, $substring, $offset = null)
        {
            $position = strpos($string, $substring, $offset);
            if (!is_int($position))
            {
                return -1;
            }
            return $position;
        }
        
        public static function lastIndexOf($string, $substring, $offset = null)
        {
            $position = strrpos($string, $substring, $offset);
            if (!is_int($position))
            {
                return -1;
            }
            return $position;
        }
        
        public static function singular($string)
        {
            $result = $string;
            
            foreach (self::$_singular as $rule => $replacement)
            {
                $rule = self::_normalize($rule);
            
                if (preg_match($rule, $string))
                {
                    $result = preg_replace($rule, $replacement, $string);
                    break;
                }
            }
            
            return $result;
        }
        
        public static function plural($string)
        {
            $result = $string;
            
            foreach (self::$_plural as $rule => $replacement)
            {
                $rule = self::_normalize($rule);
            
                if (preg_match($rule, $string))
                {
                    $result = preg_replace($rule, $replacement, $string);
                    break;
                }
            }
            
            return $result;
        }

        /**
         * Generate a string made up of randomized
         * letters (lower and upper case) and digits and returns
         * the md5 hash of it to be used as a userauth.
         */
        public static function randomNumber($length = 16) {

                return md5(self::randomString($length));
        }

        public static function randomString($length = 16) {

            $randomStr = "";

            if (function_exists('openssl_random_pseudo_bytes')) {
                $randomStr = openssl_random_pseudo_bytes($length);
            } else {
                for ($i = 0; $i < $length; $i++) {
                    $randomNum = mt_rand(0, 61);
                    if ($randomNum < 10) {
                        $randomStr .= chr($randomNum + 48);
                    } else if($randnum < 36) {
                        $randomStr .= chr($randomNum + 55);
                    } else {
                        $randomStr .= chr($randomNum + 61);
                    }
                }
            }       
            return $randomStr;
        }

        /**
         * Convert a number into its textual form
         * For example, how to convert the number 123 
         * to the string “one hundred and twenty-three”.
         * @author Karl Rixon
         * @link http://www.karlrixon.co.uk/writing/convert-numbers-to-words-with-php/
         */
        public static function numberToWords($number) {
        
            $hyphen      = '-';
            $conjunction = ' and ';
            $separator   = ', ';
            $negative    = 'negative ';
            $decimal     = ' point ';
            $dictionary  = array(
                0                   => 'zero',
                1                   => 'one',
                2                   => 'two',
                3                   => 'three',
                4                   => 'four',
                5                   => 'five',
                6                   => 'six',
                7                   => 'seven',
                8                   => 'eight',
                9                   => 'nine',
                10                  => 'ten',
                11                  => 'eleven',
                12                  => 'twelve',
                13                  => 'thirteen',
                14                  => 'fourteen',
                15                  => 'fifteen',
                16                  => 'sixteen',
                17                  => 'seventeen',
                18                  => 'eighteen',
                19                  => 'nineteen',
                20                  => 'twenty',
                30                  => 'thirty',
                40                  => 'fourty',
                50                  => 'fifty',
                60                  => 'sixty',
                70                  => 'seventy',
                80                  => 'eighty',
                90                  => 'ninety',
                100                 => 'hundred',
                1000                => 'thousand',
                1000000             => 'million',
                1000000000          => 'billion',
                1000000000000       => 'trillion',
                1000000000000000    => 'quadrillion',
                1000000000000000000 => 'quintillion'
            );

            if (!is_numeric($number)) {
                return false;
            }

            if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
                // overflow
                trigger_error(
                    'numberToWords only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
                    E_USER_WARNING
                );
                return false;
            }

            if ($number < 0) {
                return $negative . numberToWords(abs($number));
            }

            $string = $fraction = null;

            if (strpos($number, '.') !== false) {
                list($number, $fraction) = explode('.', $number);
            }

            switch (true) {
                case $number < 21:
                    $string = $dictionary[$number];
                    break;
                case $number < 100:
                    $tens   = ((int) ($number / 10)) * 10;
                    $units  = $number % 10;
                    $string = $dictionary[$tens];
                    if ($units) {
                        $string .= $hyphen . $dictionary[$units];
                    }
                    break;
                case $number < 1000:
                    $hundreds  = $number / 100;
                    $remainder = $number % 100;
                    $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
                    if ($remainder) {
                        $string .= $conjunction . numberToWords($remainder);
                    }
                    break;
                default:
                    $baseUnit = pow(1000, floor(log($number, 1000)));
                    $numBaseUnits = (int) ($number / $baseUnit);
                    $remainder = $number % $baseUnit;
                    $string = numberToWords($numBaseUnits) . ' ' . $dictionary[$baseUnit];
                    if ($remainder) {
                        $string .= $remainder < 100 ? $conjunction : $separator;
                        $string .= numberToWords($remainder);
                    }
                    break;
            }

            if (null !== $fraction && is_numeric($fraction)) {
                $string .= $decimal;
                $words = array();
                foreach (str_split((string) $fraction) as $number) {
                    $words[] = $dictionary[$number];
                }
                $string .= implode(' ', $words);
            }

            return $string;
        }

        /**
         * Convert a string to more accurate title case
         * taking into account 'small words' that should
         * not be capitalized
         * @author Kroc Camen 
         * @link http://camendesign.co.uk/code/title-case
         */
        public static function titleCase ($title) {
            //remove HTML, storing it for later
            //       HTML elements to ignore    | tags  | entities
            $regx = '/<(code|var)[^>]*>.*?<\/\1>|<[^>]+>|&\S+;/';
            preg_match_all ($regx, $title, $html, PREG_OFFSET_CAPTURE);
            $title = preg_replace ($regx, '', $title);
            
            //find each word (including punctuation attached)
            preg_match_all ('/[\w\p{L}&`\'‘’"“\.@:\/\{\(\[<>_]+-? */u', $title, $m1, PREG_OFFSET_CAPTURE);
            foreach ($m1[0] as &$m2) {
                //shorthand these- "match" and "index"
                list ($m, $i) = $m2;
                
                //correct offsets for multi-byte characters (`PREG_OFFSET_CAPTURE` returns *byte*-offset)
                //we fix this by recounting the text before the offset using multi-byte aware `strlen`
                $i = mb_strlen (substr ($title, 0, $i), 'UTF-8');
                
                //find words that should always be lowercase…
                //(never on the first word, and never if preceded by a colon)
                $m = $i>0 && mb_substr ($title, max (0, $i-2), 1, 'UTF-8') !== ':' && 
                    !preg_match ('/[\x{2014}\x{2013}] ?/u', mb_substr ($title, max (0, $i-2), 2, 'UTF-8')) && 
                     preg_match ('/^(a(nd?|s|t)?|b(ut|y)|en|for|i[fn]|o[fnr]|t(he|o)|vs?\.?|via)[ \-]/i', $m)
                ?   //…and convert them to lowercase
                    mb_strtolower ($m, 'UTF-8')
                    
                //else: brackets and other wrappers
                : ( preg_match ('/[\'"_{(\[‘“]/u', mb_substr ($title, max (0, $i-1), 3, 'UTF-8'))
                ?   //convert first letter within wrapper to uppercase
                    mb_substr ($m, 0, 1, 'UTF-8').
                    mb_strtoupper (mb_substr ($m, 1, 1, 'UTF-8'), 'UTF-8').
                    mb_substr ($m, 2, mb_strlen ($m, 'UTF-8')-2, 'UTF-8')
                    
                //else: do not uppercase these cases
                : ( preg_match ('/[\])}]/', mb_substr ($title, max (0, $i-1), 3, 'UTF-8')) ||
                    preg_match ('/[A-Z]+|&|\w+[._]\w+/u', mb_substr ($m, 1, mb_strlen ($m, 'UTF-8')-1, 'UTF-8'))
                ?   $m
                    //if all else fails, then no more fringe-cases; uppercase the word
                :   mb_strtoupper (mb_substr ($m, 0, 1, 'UTF-8'), 'UTF-8').
                    mb_substr ($m, 1, mb_strlen ($m, 'UTF-8'), 'UTF-8')
                ));
                
                //resplice the title with the change (`substr_replace` is not multi-byte aware)
                $title = mb_substr ($title, 0, $i, 'UTF-8').$m.
                     mb_substr ($title, $i+mb_strlen ($m, 'UTF-8'), mb_strlen ($title, 'UTF-8'), 'UTF-8')
                ;
            }
            
            //restore the HTML
            foreach ($html[0] as &$tag) $title = substr_replace ($title, $tag[0], $tag[1], 0);
            return $title;
        }
    }    
}