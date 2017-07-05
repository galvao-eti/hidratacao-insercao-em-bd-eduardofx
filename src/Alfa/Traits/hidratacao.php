<?php
namespace Alfa\Traits;
trait Hidratacao
{
    public function hidrata(array $dados)
    {
        foreach ($dados as $col => $val) {
            if ($val) 
            {
                continue;
            }else
            {
                break;
            }
         }
    }
}