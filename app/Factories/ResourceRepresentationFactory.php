<?php

namespace App\Factories;

use App\Representations\CustomerRepresentation;
use Exception;

/**
 * Class ResourceRepresentationFactory to map entity to responding representation
 * So we remove coupling between entity and representation layer
 * @package App\Factories
 */
class ResourceRepresentationFactory
{
    public static function make($key, $entities)
    {
        switch ($key) {
            case 'customer':
                return new CustomerRepresentation($entities);
                break;
            default:
                throw new Exception('No defined entity');
        }
    }
}
