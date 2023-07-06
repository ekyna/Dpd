<?php

declare(strict_types=1);

namespace Ekyna\Component\Dpd\EPrint\Model;

use Ekyna\Component\Dpd\AbstractInput;
use Ekyna\Component\Dpd\Definition;

/**
 * Class ServiceEntry
 * @package Ekyna\Component\Dpd\EPrint\Model
 * @author  Étienne Dauvergne <contact@ekyna.com>
 */
class ServiceEntry extends AbstractInput
{
    /**
     * @inheritdoc
     */
    protected function buildDefinition(Definition\Definition $definition): void
    {
        $definition
            ->addField(new Definition\AlphaNumeric('Name', false, 32))
            ->addField(new Definition\AlphaNumeric('Type', false, 32))
            ->addField(new Definition\AlphaNumeric('Attribute', false, 32))
            ->addField(new Definition\AlphaNumeric('Value', false, 32))
            ->addField(new Definition\AlphaNumeric('Detail', false, 32))
            ->addField(new Definition\AlphaNumeric('Status', false, 32));
    }
}
