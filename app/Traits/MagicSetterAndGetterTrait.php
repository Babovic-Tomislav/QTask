<?php

namespace App\Traits;

trait MagicSetterAndGetterTrait
{
    public function __get(string $name)
    {
        if (property_exists($this, $name) && isset($this->$name)) {
            return $this->$name;
        }

        if (property_exists($this, $name) && isset(static::$$name)) {
            return static::$$name;
        }
    }

    public function __set(string $name, $value): void
    {
        if (property_exists($this, $name) && isset($this->$name)) {
            $this->$name = $value;
        }

        if (property_exists($this, $name) && isset(static::$$name)) {
            static::$$name = $value;
        }
    }

    public function __call(string $name, array $arguments)
    {
        if (method_exists($this, $name)) {
            return call_user_func_array(array($this, $name), $arguments);
        } else if (property_exists($this, $name = lcfirst(ltrim($name, 'get')))) {
            return $this->$name;
        } else if (property_exists($this, $name = lcfirst(ltrim($name, 'set')))) {
            $this->$name = $arguments[0];
        }
    }
}