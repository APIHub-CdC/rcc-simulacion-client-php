<?php

namespace RccClientSimulacion\Client\Model;
use \RccClientSimulacion\Client\ObjectSerializer;

class CatalogoSexo
{
    
    const F = 'F';
    const M = 'M';
    
    
    public static function getAllowableEnumValues()
    {
        return [
            self::F,
            self::M,
        ];
    }
}
