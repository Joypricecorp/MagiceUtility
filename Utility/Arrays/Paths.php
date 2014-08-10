<?php
namespace Magice\Utility\Arrays {

    class Paths
    {
        /**
         * @param array  $array
         * @param string $separate
         *
         * @return array
         */
        public static function run(array $array, $separate = '.')
        {
            return self::_buildPaths($array, $separate);
        }

        /**
         * @param array  $array
         * @param string $separate
         * @param array  $path
         *
         * @return array
         */
        private static function _buildPaths(array $array, $separate = '.', array $path = array())
        {
            $result = array();
            foreach ($array as $key => $val) {
                $currentPath = array_merge($path, array($key));
                if (is_array($val) || is_object($val)) {
                    $result = array_merge($result, self::_buildPaths((array) $val, $separate, $currentPath));
                } else {
                    $result[join($separate, $currentPath)] = $val;
                }
            }

            return $result;
        }
    }
}