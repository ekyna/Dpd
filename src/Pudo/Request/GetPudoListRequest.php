<?php

namespace Ekyna\Component\Dpd\Pudo\Request;

use Ekyna\Component\Dpd\AbstractInput;
use Ekyna\Component\Dpd\Definition;
use Ekyna\Component\Dpd\RequestInterface;

/**
 * Class GetPudoListRequest
 * @package Ekyna\Component\Dpd\Pudo
 * @author  Etienne Dauvergne <contact@ekyna.com>
 *
 * @property string $address
 * @property string $zipCode
 * @property string $city
 * @property string $countrycode
 * @property string $requestID
 * @property string $date_from
 * @property string $max_pudo_number
 * @property string $max_distance_search
 * @property string $weight
 * @property string $category
 * @property string $holiday_tolerant
 */
class GetPudoListRequest extends AbstractInput implements RequestInterface
{
    protected function buildDefinition(Definition\Definition $definition): void
    {
        $definition
            ->addField(new Definition\AlphaNumeric('address', true, 200))
            ->addField(new Definition\AlphaNumeric('zipCode', true, 5))
            ->addField(new Definition\AlphaNumeric('city', true, 50))
            ->addField(new Definition\AlphaNumeric('countrycode', false, 2)) // Default to FR
            ->addField(new Definition\AlphaNumeric('requestID', true, 30))
            ->addField(new Definition\Date('date_from', true))
            ->addField(new Definition\AlphaNumeric('max_pudo_number', true, 255))
            ->addField(new Definition\AlphaNumeric('max_distance_search', true, 255))
            ->addField(new Definition\AlphaNumeric('weight', true, 255))
            ->addField(new Definition\AlphaNumeric('category', false, 255))
            ->addField(new Definition\AlphaNumeric('holiday_tolerant', false, 255))
        ;
    }
}
