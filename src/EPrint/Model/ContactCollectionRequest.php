<?php

declare (strict_types=1);

namespace Ekyna\Component\Dpd\EPrint\Model;

use Ekyna\Component\Dpd\Definition;

/**
 * Class ContactCollectionRequest
 * @package Ekyna\Component\Dpd
 * @author  Etienne Dauvergne <contact@ekyna.com>
 *
 * @property string $shipper_email
 * @property string $shipper_mobil
 */
class ContactCollectionRequest extends Contact
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
