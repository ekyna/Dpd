<?php
declare (strict_types=1);

namespace Ekyna\Component\DpdWs\Request;

use Ekyna\Component\DpdWs\Definition;
use Ekyna\Component\DpdWs\Model;

/**
 * Class TerminateCollectionRequestRequest
 * @package Ekyna\Component\DpdWs
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
class TerminateCollectionRequestRequest extends Model\AbstractModel
{
    /**
     * @inheritdoc
     */
    protected function buildDefinition(Definition\Definition $definition): void
    {
        $definition
            ->addField(new Definition\Object('parcel', false, Model\Parcel::class))
            ->addField(new Definition\Object('customer', true, Model\Customer::class));
    }
}
