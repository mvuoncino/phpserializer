<?php

namespace MVuoncino\Helper;

class ArrayToken extends AbstractToken
{
    const TOKEN = 'a';

    private $keys = [];

    private $values = [];

    public function getType()
    {
        return self::TOKEN;
    }

    public function addToken(AbstractToken $key, AbstractToken $value)
    {
        $this->keys[] = $key;
        $this->values[] = $value;
    }

    public function toArray()
    {
        $array = [];
        foreach ($this->keys as $i => $key) {
            $array[] = [
                'key' => $key->toArray(),
                'value' => $this->values[$i]->toArray()
            ];
        }
       
        return ['members' => $array];
    }

    public function setMember($i, AbstractToken $key, AbstractToken $value)
    {
        $this->keys[$i] = $key;
        $this->values[$i] = $value;
    }

    public function getKeyValueCount()
    {
        return count($this->keys);
    }

    public function getKeyValuePairString()
    {
        $serialized = "";
        foreach ($this->keys as $i => $key) {
            $serialized .=
                $this->keys[$i]->__toString() .
                $this->values[$i]->__toString();
        }
        return $serialized;
    }

    public function __toString()
    {
        return sprintf(
            "%s:%d:{%s}",
            $this->getType(),
            count($this->keys),
            $this->getKeyValuePairString()
        );
    }
}

