<?php
declare (strict_types=1);

namespace Ekyna\Component\Dpd\Model;

use Ekyna\Component\Dpd\Definition;

/**
 * Class AddressInfo
 * @package Ekyna\Component\Dpd
 * @author  Etienne Dauvergne <contact@ekyna.com>
 *
 * @property string $contact    Nom du contact
 * @property string $name2
 * @property string $name3
 * @property string $name4
 * @property string $digicode1
 * @property string $digicode2
 * @property string $intercomid
 * @property string $vinfo1     Commentaire de livraison 1
 * @property string $vinfo2     Commentaire de livraison 2
 */
class AddressInfo extends AbstractModel
{
    /**
     * @inheritdoc
     */
    protected function buildDefinition(Definition\Definition $definition): void
    {
        $definition
            ->addField(new Definition\AlphaNumeric('contact', false, 35))
            ->addField(new Definition\AlphaNumeric('name1', false, 35))
            ->addField(new Definition\AlphaNumeric('name2', false, 35))
            ->addField(new Definition\AlphaNumeric('name3', false, 35))
            ->addField(new Definition\AlphaNumeric('digicode1', false, 35))
            ->addField(new Definition\AlphaNumeric('digicode2', false, 35))
            ->addField(new Definition\AlphaNumeric('intercomid', false, 10))
            ->addField(new Definition\AlphaNumeric('vinfo1', false, 35))
            ->addField(new Definition\AlphaNumeric('vinfo2', false, 35));
    }
}
