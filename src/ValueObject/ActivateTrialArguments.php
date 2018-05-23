<?php

namespace CallbackHunterAPIv2\ValueObject;

class ActivateTrialArguments implements \ArrayAccess
{
    /** @var array */
    private $arguments = [];

    /**
     * @param mixed $offset
     * @param mixed $value
     */
    public function offsetSet($offset, $value)
    {
        if (null === $offset) {
            $this->arguments[] = $value;
        } else {
            $this->arguments[$offset] = $value;
        }
    }

    /**
     * @param mixed $offset
     *
     * @return bool
     */
    public function offsetExists($offset)
    {
        return isset($this->container[$offset]);
    }

    /**
     * @param mixed $offset
     */
    public function offsetUnset($offset)
    {
        unset($this->arguments[$offset]);
    }

    /**
     * @param mixed $offset
     *
     * @return mixed|null
     */
    public function offsetGet($offset)
    {
        return isset($this->arguments[$offset]) ? $this->arguments[$offset] : null;
    }
}
