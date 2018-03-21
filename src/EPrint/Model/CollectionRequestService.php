<?php
declare (strict_types=1);

namespace Ekyna\Component\Dpd\EPrint\Model;

use Ekyna\Component\Dpd\AbstractInput;
use Ekyna\Component\Dpd\Definition;

/**
 * Class CollectionRequestService
 * @package Ekyna\Component\Dpd
 * @author  Etienne Dauvergne <contact@ekyna.com>
 *
 * @property ExtraInsurance           $extraInsurance
 * @property ContactCollectionRequest $contact
 */
class CollectionRequestService extends AbstractInput
{
    /**
     * @inheritdoc
     */
    protected function buildDefinition(Definition\Definition $definition): void
    {
        $definition
            ->addField(new Definition\Model('extraInsurance', false, ExtraInsurance::class))
            ->addField(new Definition\Model('contact', false, ContactCollectionRequest::class));
    }
}
