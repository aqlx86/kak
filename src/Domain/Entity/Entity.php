<?php

namespace Domain\Entity;

abstract class Entity
{
    public function to_array()
    {
        $reflection = new \ReflectionClass(get_called_class());

        $properties = array();

        foreach ($reflection->getProperties(\ReflectionProperty::IS_PUBLIC) as $property)
        {
            if (isset($this->{$property->getName()}))
                $properties[$property->getName()] = $this->{$property->getName()};
        }

        return $properties;
    }

    public function validator()
    {
        return $this->validator;
    }
}
