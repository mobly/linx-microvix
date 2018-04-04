<?php

namespace Mobly\LinxMicrovix\Reader;

use Mobly\LinxMicrovix\Reader\Response\ParseResult;

/**
 * Class Configuration
 * @package Mobly\LinxMicrovix\Reader
 */
class Response
{

    /**
     * @var array
     */
    protected $errors;

    /**
     * @var boolean
     */
    protected $success = true;

    /**
     * @var string
     */
    protected $result;

    /**
     * @var array
     */
    protected $data;

    /**
     * @var ParseResult
     */
    protected $parseResult;

    /**
     * Response constructor.
     * @param $result
     */
    public function __construct($result)
    {
        $this->parseResult = new ParseResult();
        $this->result = $result;
        $this->parseXml();
    }

    /**
     * @return bool
     */
    protected function parseXml()
    {
        if (empty($this->result)) {
            $this->addError('Empty result');

            return true;
        }

        try {
            $result  = simplexml_load_string($this->result);
            if (
                empty($result->ResponseResult->ResponseSuccess) ||
                $result->ResponseResult->ResponseSuccess == 'False'
            ) {
                foreach ($result->ResponseResult->ResponseError->Message as $errorMessage) {
                    $this->addError($errorMessage);
                }

                return true;
            }

            $this->data = $this->parseResult->parse($result->ResponseData);

        } catch (\Exception $e) {
            $this->addError($e->getMessage());
        }
    }

    /**
     * @param $message
     */
    protected function addError($message)
    {
        $this->success = false;
        $this->errors[] = (string) $message;
    }

    /**
     * @return bool
     */
    public function isSuccess()
    {
        return $this->success;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }
}