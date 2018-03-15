<?php

namespace Ekyna\Component\DpdWs\Model;

use Ekyna\Component\DpdWs\Definition;

/**
 * Class ReverseInverseServices
 * @package Ekyna\Component\DpdWs\Model
 * @author  Etienne Dauvergne <contact@ekyna.com>
 *
 * @property ExtraInsurance $extraInsurance Valeur déclarée
 * @property Contact        $contact        Nom du contact
 */
class ReverseInverseServices extends AbstractModel
{
    /**
     * @inheritdoc
     */
    protected function buildDefinition(Definition\Definition $definition): void
    {
        $definition
            ->addField(new Definition\Object('extraInsurance', false, ExtraInsurance::class))
            ->addField(new Definition\Object('contact', false, Contact::class));
    }
}
