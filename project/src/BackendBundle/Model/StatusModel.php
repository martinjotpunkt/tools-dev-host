<?php

namespace BackendBundle\Model;

class StatusModel
{
    /** @var int */
    private $status;

    /** @var string */
    private $message;


    public function __construct($status, $message)
    {
        $this->status = $status;
        $this->message = $message;
    }
}
