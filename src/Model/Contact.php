<?php
declare (strict_types=1);

namespace Ekyna\Component\Dpd\Model;

use Ekyna\Component\Dpd\Definition;
use Ekyna\Component\Dpd\Enum\ETypeContact;

/**
 * Class Contact
 * @package Ekyna\Component\Dpd
 * @author  Etienne Dauvergne <contact@ekyna.com>
 *
 * @property string $sms      Téléphone destinataire
 * @property string $email    E-Mail destinataire
 * @property string $type     Type de notification
 * @property string $autoText Instructions
 *
 * @see ETypeContact
 */
class Contact extends AbstractModel
{
    /**
     * @inheritdoc
     */
    protected function buildDefinition(Definition\Definition $definition): void
    {
        $definition
            ->addField(new Definition\AlphaNumeric('sms', false, 30))
            ->addField(new Definition\AlphaNumeric('email', false, 255))
            ->addField(new Definition\Enum('type', true, ETypeContact::class))
            ->addField(new Definition\AlphaNumeric('autoText', false, 255));
    }
}