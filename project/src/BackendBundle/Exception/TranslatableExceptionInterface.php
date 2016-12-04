<?php

namespace BackendBundle\Exception;

interface TranslatableExceptionInterface
{
    public function getMessage();
    public function getParams();
    public function getCode();
}
