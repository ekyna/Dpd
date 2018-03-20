<?php
declare (strict_types=1);

namespace Ekyna\Component\Dpd\Model;

use Ekyna\Component\Dpd\Definition;
use Ekyna\Component\Dpd\Enum\ELabelType;

/**
 * Class LabelType
 * @package Ekyna\Component\Dpd
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
class LabelType extends AbstractInput
{
    /**
     * PNG / PDF / PDF_A6
     *
     * @var string
     *
     * @see ELabelType
     */
    public $type = ELabelType::PNG;


    /**
     * @inheritdoc
     */
    protected function buildDefinition(Definition\Definition $definition): void
    {
        $definition->addField(new Definition\Enum('type', true, ELabelType::class));
    }
}
