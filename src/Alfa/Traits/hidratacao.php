<?php
namespace Alfa\Traits;
trait Hidratacao
{
    public function hidrata(array $dados)
    {
        foreach( $dados as $key => $val ) {
                $this->$key = $val;
         }
    }
}