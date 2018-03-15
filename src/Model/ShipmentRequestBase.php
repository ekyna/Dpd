<?php
declare (strict_types=1);

namespace Ekyna\Component\DpdWs\Model;

use Ekyna\Component\DpdWs\Definition;

/**
 * Class ShipmentRequestBase
 * @package Ekyna\Component\DpdWs
 * @author  Etienne Dauvergne <contact@ekyna.com>
 *
 * @property Address     $receiveraddress       Adresse destinataire
 * @property AddressInfo $receiverinfo          Compléments d'adresse et commentaires
 * @property Address     $shipperaddress        Adresse expéditeur
 * @property Address     $retourAddress         Addresse retour
 * @property string      $customer_countrycode  Code pays 250 = France
 * @property string      $customer_centernumber Code agence
 * @property string      $customer_number       N° de compte
 * @property string      $shippingdate          Date d'expédition théorique JJ.MM.AAAA
 */
class ShipmentRequestBase extends AbstractModel
{
    /**
     * @inheritdoc
     */
    protected function buildDefinition(Definition\Definition $definition): void
    {
        $definition
            ->addField(new Definition\Object('receiveraddress', false, Address::class))
            ->addField(new Definition\Object('receiverinfo', false, AddressInfo::class))
            ->addField(new Definition\Object('shipperaddress', false, Address::class))
            ->addField(new Definition\Object('retourAddress', false, Address::class))
            ->addField(new Definition\Numeric('customer_countrycode', true, 3))
            ->addField(new Definition\Numeric('customer_centernumber', true, 3))
            ->addField(new Definition\Numeric('customer_number', true, 6))
            ->addField(new Definition\AlphaNumeric('shippingdate', false, 10));
    }
}
