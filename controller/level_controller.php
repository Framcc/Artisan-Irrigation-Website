<?php
    include_once('level.php');
    include_once('../model/level_db.php');

    class LevelController {
        public static function getAllLevels() {
            $queryRes = LevelDB::getLevel();

            if($queryRes) {
                $roles = array();
                foreach ($queryRes as $row) {
                    $roles[] = new Level($row['UserLevelNo'], $row['LevelName']);
                }

                return $roles;
            }
            else {
                return false;
            }
        }
    }
?>