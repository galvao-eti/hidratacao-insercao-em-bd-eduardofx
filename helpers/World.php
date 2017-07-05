<?php

trait World
{
    public function sayWorld()
    {
        //$hello = parent::hello();
        $hello = $this->hello();
        return $hello.' world!';
    }
    abstract public function hello();
}
