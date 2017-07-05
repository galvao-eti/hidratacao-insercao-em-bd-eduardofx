<?php

abstract class ModelAbstract
{
    public function findAll()
    {
        var_dump(get_called_class());
    }

  /*  public function hello()
    {
        return 'Hello';
    }*/
}
