<?php

namespace Mobly\LinxMicrovix\Reader;

/**
 * Class Configuration
 * @package Mobly\LinxMicrovix\Reader
 */
class Configuration
{

    /**
     * @var string
     */
    protected $user;

    /**
     * @var string
     */
    protected $password;

    /**
     * @var string
     */
    protected $cnpj;

    /**
     * @var string
     */
    protected $keyPortal;

    /**
     * @var boolean
     */
    protected $url;

    /**
     * @var string
     */
    protected $idPortal;

    /**
     * @var array
     */
    protected $required = [
        'user',
        'password',
        'cnpj',
        'url',
        'keyPortal',
    ];

    /**
     * Configuration constructor.
     * @param array $options
     */
    public function __construct(array $options)
    {
        $this->validateRequired($options);
        $this->setData($options);
    }

    /**
     * @param array $options
     */
    protected function setData(array $options)
    {
        foreach ($options as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }

    /**
     * @param array|object $data
     *
     * @throws \Exception
     */
    protected function validateRequired($data)
    {
        if (is_object($data)) {
            $data = get_object_vars($data);
        }

        foreach ($this->required as $attribute) {
            if (!isset($data[$attribute])) {
                throw new \Exception('Required param "' . $attribute . '" missing');
            }
        }
    }

    /**
     * @return string
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param string $user
     * @return Configuration
     */
    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return Configuration
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return string
     */
    public function getCnpj()
    {
        return $this->cnpj;
    }

    /**
     * @param string $cnpj
     * @return Configuration
     */
    public function setCnpj($cnpj)
    {
        $this->cnpj = $cnpj;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param boolean $url
     * @return Configuration
     */
    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @return string
     */
    public function getKeyPortal()
    {
        return $this->keyPortal;
    }

    /**
     * @param string $keyPortal
     * @return Configuration
     */
    public function setKeyPortal($keyPortal)
    {
        $this->keyPortal = $keyPortal;
        return $this;
    }

    /**
     * @return string
     */
    public function getIdPortal()
    {
        return $this->idPortal;
    }

    /**
     * @param string $idPortal
     * @return Configuration
     */
    public function setIdPortal($idPortal)
    {
        $this->idPortal = $idPortal;
        return $this;
    }
}
