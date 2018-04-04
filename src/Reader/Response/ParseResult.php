<?php

namespace Mobly\LinxMicrovix\Reader\Response;

/**
 * Class ParseResult
 * @package Mobly\LinxMicrovix\Reader\Response
 */
class ParseResult
{
    /**
     * @var array
     */
    protected $columns = [];

    /**
     * @var array
     */
    protected $result;

    /**
     * @param \SimpleXMLElement $resultXml
     * @return array
     */
    public function parse(\SimpleXMLElement $resultXml)
    {
        $this->extractColumns($resultXml);
        $this->extractData($resultXml);

        return $this->result;
    }

    /**
     * @param \SimpleXMLElement $resultXml
     */
    protected function extractColumns(\SimpleXMLElement $resultXml)
    {
        foreach ($resultXml->C->D as $column) {
            $this->columns[] = (string) $column;
        }
    }

    /**
     * @param \SimpleXMLElement $resultXml
     */
    protected function extractData(\SimpleXMLElement $resultXml)
    {
        $results = [];
        foreach ($resultXml->R as $record) {
            $result = [];
            $count = 0;
            foreach ($record->D as $value) {
                $result[$this->columns[$count]] = (string) $value;
                $count ++;
            }

            $results[] = $result;
        }

        $this->result = $results;
    }
}