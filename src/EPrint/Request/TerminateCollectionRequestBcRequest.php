<?php

declare (strict_types=1);

namespace Ekyna\Component\Dpd\EPrint\Request;

use Ekyna\Component\Dpd\AbstractInput;
use Ekyna\Component\Dpd\Definition;
use Ekyna\Component\Dpd\EPrint\Model;
use Ekyna\Component\Dpd\RequestInterface;

/**
 * Class TerminateCollectionRequestBcRequest
 * @package Ekyna\Component\Dpd
 * @author  Etienne Dauvergne <contact@ekyna.com>
 *
 * @property string         $barcode
 * @property Model\Customer $customer
 */
class TerminateCollectionRequestBcRequest extends AbstractInput implements RequestInterface
{
    /**
     * @inheritdoc
     */
    protected function buildDefinition(Definition\Definition $definition): void
    {
        $definition
            ->addField(new Definition\AlphaNumeric('barcode', true, null))
            ->addField(new Definition\Model('customer', true, Model\Customer::class));
    }
}
