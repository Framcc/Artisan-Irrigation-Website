<?php
    class Level {
        private $levelNo;
        private $levelName;

        public function __construct($levelNo, $levelName) {
            $this->levelNo = $levelNo;
            $this->levelName = $levelName;
        }

    public function getLevelNo() {
        return $this->levelNo;
    }
    public function setLevelNo($value) {
        $this->levelNo = $value;
    }

    public function getLevelName() {
        return $this->levelName;
    }

    public function setLevelName($value) {
        $this->levelName = $value;
    }
}
?>