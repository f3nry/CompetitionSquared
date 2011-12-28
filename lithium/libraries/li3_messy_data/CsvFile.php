<?php

namespace li3_messy_data;

/**
 * CsvFile
 *
 * @author Paul Henry <paulhenry@mphwebsystems.com>
 */
class CsvFile extends File {
    protected $_header;
    protected $_file;
    protected $_currentRecord;

    public function _init() {
        parent::_init();

        $header_row = $this->readLineAsCsv();

        $i = 0;

        foreach($header_row as $header_column) {
            $this->_header[$i++] = trim(
                    strtoupper(
                        preg_replace('/[^A-Za-z0-9]/', '', $header_column)
                    )
                );
        }
    }

    public function __call($name, $params) {
        if(preg_match("/[sg]et(.*)/", $name, $found)) {
            $columnName = strtoupper($found[1]);
            $index      = \array_search($columnName, $this->_header);

            if($index !== false) {
                if($name[0] == 'g') {
                    return $this->currentRecord[$index];
                } else {
                    $this->currentRecord[$index] = $params[0];
                    return true;
                }
            }
        }

        return false;
    }

    public function getNext() {
        $record = $this->readLineAsCsv();

        if($record !== false) {
            $this->currentRecord = $record;
            return true;
        }
        return false;
    }
}