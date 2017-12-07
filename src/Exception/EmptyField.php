<?php

namespace CallbackHunterAPIv2\Exception;

class EmptyField extends InvalidArgumentException
{
    public function __construct($fieldName)
    {
        parent::__construct(sprintf('Field "%s" is empty', $fieldName));
    }
}
