<?php
    Class FileUtilities {
        public static function GetFileList($dir) {
            $files = array();
            foreach(scandir($dir) as $file) {
                if(is_file($dir . $file)) {
                    $files[] = $file;
                }
            }
            return $files;
        }

        public static function GetFileContents($file) {
            return file_get_contents($file) ? file_get_contents($file) : '';
        }

        public static function WriteFile($file, $content) {
            $wFile = fopen($file, 'w');
            fwrite($wFile, $content);
            fclose($wFile);
        }

        public static function DeleteFile($file) {
            if(file_exists($file)) {
                unlink($file);
                return true;
            }
            return false;
        }
    }
?>