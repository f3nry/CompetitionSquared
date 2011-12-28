<?php

namespace app\models\importers;

use li3_messy_data\CsvFile;

use app\models\TeamTypes;
use app\models\School;
use app\models\Team;

/**
 * JOTImporter
 *
 * @author Paul Henry <paulhenry@mphwebsystems.com>
 */
class JOTImporter extends \lithium\core\Object {
    private $_file;
    
    public function _init() {
        $target_path = LITHIUM_APP_PATH . "/resources/uploads/jot/" . $this->randomizeFileName($this->_config['data']['jotfile']['name']);

        move_uploaded_file($this->_config['data']['jotfile']['tmp_name'], $target_path) or die("Error moving file.");

        $this->_file = new CsvFile($target_path);
    }

    public function run() {
        TeamTypes::load();
        $type = $this->_config['data']['event'];

        if(is_numeric($type) && $type != -1) {
            while($this->_file->getNext()) {
                $school_name = trim($this->_file->getSchool());
                $student_name = explode(" ", trim($this->_file->getStudent()));

                $student_fname = $student_name[0];
                $student_lname = $student_name[1];
                
                if(!$school = School::find(array('conditions' => array('name = ?', $school_name)))) {
                    $school = School::create(array('name' => $school_name));
                    $school->save();
                    $school->id = School::connection()->insert_id();
                }

                Team::add(array('first_name' => $student_fname, 'last_name' => $student_lname, 'type' => $type, 'school_id' => $school->id));
            }
        }

        $this->_file->delete();
    }

    private function randomizeFileName($name) {
        return time() . str_replace(" ", "", $name);
    }
}