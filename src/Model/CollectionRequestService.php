<?php
declare (strict_types=1);

namespace Ekyna\Component\DpdWs\Model;

use Ekyna\Component\DpdWs\Definition;

/**
 * Class CollectionRequestService
 * @package Ekyna\Component\DpdWs
 * @author  Etienne Dauvergne <contact@ekyna.com>
 *
 * @property ExtraInsurance           $extraInsurance
 * @property ContactCollectionRequest $contact
 */
class CollectionRequestService extends AbstractModel
{
    /**
     * @inheritdoc
     */
    protected function buildDefinition(Definition\Definition $definition): void
    {
        $definition
            ->addField(new Definition\Object('extraInsurance', false, ExtraInsurance::class))
            ->addField(new Definition\Object('contact', false, ContactCollectionRequest::class));
    }
}
