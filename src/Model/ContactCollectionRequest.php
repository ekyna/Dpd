<?php
declare (strict_types=1);

namespace Ekyna\Component\DpdWs\Model;

use Ekyna\Component\DpdWs\Definition;

/**
 * Class ContactCollectionRequest
 * @package Ekyna\Component\DpdWs
 * @author  Etienne Dauvergne <contact@ekyna.com>
 *
 * @property string $shipper_email
 * @property string $shipper_mobil
 */
class ContactCollectionRequest extends AbstractModel
{
    /**
     * @inheritdoc
     */
    protected function buildDefinition(Definition\Definition $definition): void
    {
        $definition
            ->addField(new Definition\AlphaNumeric('shipper_email', false, 255))
            ->addField(new Definition\AlphaNumeric('shipper_mobil', false, 30));
    }
}
