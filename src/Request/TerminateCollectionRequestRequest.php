<?php
declare (strict_types=1);

namespace Ekyna\Component\Dpd\Request;

use Ekyna\Component\Dpd\Definition;
use Ekyna\Component\Dpd\Model;

/**
 * Class TerminateCollectionRequestRequest
 * @package Ekyna\Component\Dpd
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
class TerminateCollectionRequestRequest extends Model\AbstractInput implements RequestInterface
{
    /**
     * @inheritdoc
     */
    protected function buildDefinition(Definition\Definition $definition): void
    {
        $definition
            ->addField(new Definition\Model('parcel', false, Model\Parcel::class))
            ->addField(new Definition\Model('customer', true, Model\Customer::class));
    }
}
