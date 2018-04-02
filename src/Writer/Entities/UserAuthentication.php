<?php

namespace Mobly\LinxMicrovix\Writer\Entities;

/**
 * Class UserAuthentication
 * @package Mobly\LinxMicrovix\Writer\Entities
 */
class UserAuthentication
{

    /**
     * @var string $Pass
     * @access public
     */
    protected $Pass = null;

    /**
     * @var string $User
     * @access public
     */
    protected $User = null;

    /**
     * @access public
     */
    public function __construct()
    {
    
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->Pass;
    }

    /**
     * @param string $Pass
     * @return UserAuthentication
     */
    public function setPassword($Pass)
    {
        $this->Pass = $Pass;
        return $this;
    }

    /**
     * @return string
     */
    public function getUser()
    {
        return $this->User;
    }

    /**
     * @param string $User
     * @return UserAuthentication
     */
    public function setUser($User)
    {
        $this->User = $User;
        return $this;
    }

}
