<?php

declare(strict_types=1);

namespace Ekyna\Component\Dpd\EPrint\Model;

use Ekyna\Component\Dpd\AbstractInput;
use Ekyna\Component\Dpd\Definition;
use Ekyna\Component\Dpd\EPrint\Enum\EReferenceType;

/**
 * Class ReferenceInBarcode
 * @package Ekyna\Component\Dpd\EPrint\Model
 * @author  Étienne Dauvergne <contact@ekyna.com>
 *
 * @property string $type
 */
class ReferenceInBarcode extends AbstractInput
{
    /**
     * @inheritdoc
     */
    protected function buildDefinition(Definition\Definition $definition): void
    {
        $definition->addField(new Definition\Enum('type', true, EReferenceType::class));
    }
}
