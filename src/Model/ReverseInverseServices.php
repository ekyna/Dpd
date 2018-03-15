<?php

namespace Ekyna\Component\Dpd\Model;

use Ekyna\Component\Dpd\Definition;

/**
 * Class ReverseInverseServices
 * @package Ekyna\Component\Dpd\Model
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
            ->addField(new Definition\Model('extraInsurance', false, ExtraInsurance::class))
            ->addField(new Definition\Model('contact', false, Contact::class));
    }
}
