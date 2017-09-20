<?php

namespace AppBundle\Exception;

interface TranslatableExceptionInterface
{
    public function getMessage();
    public function getParams();
    public function getCode();
}
