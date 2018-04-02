<?php

namespace Mobly\LinxMicrovix\Reader;

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


    protected $data;


    public function __construct($result)
    {
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

}