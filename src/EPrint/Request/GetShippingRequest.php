<?php

declare(strict_types=1);

namespace Ekyna\Component\Dpd\EPrint\Request;

use Ekyna\Component\Dpd\AbstractInput;
use Ekyna\Component\Dpd\Definition;
use Ekyna\Component\Dpd\EPrint\Model;
use Ekyna\Component\Dpd\RequestInterface;

/**
 * Class GetShippingRequest
 * @package Ekyna\Component\Dpd\EPrint\Request
 * @author  Étienne Dauvergne <contact@ekyna.com>
 *
 * @property string         $date     Date d'expédition ('d/m/Y' or 'd.m.Y')
 * @property Model\Customer $customer Client
 */
class GetShippingRequest extends AbstractInput implements RequestInterface
{
    /**
     * @inheritdoc
     */
    protected function buildDefinition(Definition\Definition $definition): void
    {
        $definition
            ->addField(new Definition\Date('date', true))
            ->addField(new Definition\Model('customer', true, Model\Customer::class));
    }
}
