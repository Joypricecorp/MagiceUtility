<?php
namespace Magice\Utility {

    class String
    {
        /**
         * Camel to underscore.
         *
         * @param string $id The string to underscore
         *
         * @return string The underscored string
         */
        public static function underscore($id)
        {
            return strtolower(preg_replace(array('/([A-Z]+)([A-Z][a-z])/', '/([a-z\d])([A-Z])/'), array('\\1_\\2', '\\1_\\2'), strtr($id, '_', '.')));
        }

        /**
         * Camelizes a string.
         *
         * @param string $id A string to camelize
         *
         * @return string The camelized string
         */
        public static function camelize($id)
        {
            return strtr(ucwords(strtr($id, array('_' => ' ', '.' => '_ ', '-' => ' '))), array(' ' => ''));
        }

        public static function dotToCamelize($id, $separate = '\\')
        {
            return strtr(ucwords(strtr($id, array('_' => ' ', '.' => $separate . ' ', '-' => ' '))), array(' ' => ''));
        }

        public static function isJson($string)
        {
            if (!is_string($string)) {
                return false;
            }

            try {
                // try to decode string
                json_decode($string);
            } catch (\ErrorException $e) {
                // exception has been caught which means argument wasn't a string and thus is definitely no json.
                return false;
            }

            // check if error occured
            return (json_last_error() == JSON_ERROR_NONE);
        }

        /**
         * Extract emails form text
         *
         * @param string $text
         *
         * @return null|array
         */
        public static function extractEmail($text)
        {
            $pattern = "/(?:[a-z0-9!#$%&'*+=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+=?^_`{|}~-]+)*|\"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*\")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])/";

            if (preg_match_all($pattern, strip_tags($text), $match)) {
                return $match[0];
            } else {
                return null;
            }
        }
    }
}