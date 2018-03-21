<?php
declare (strict_types=1);

namespace Ekyna\Component\Dpd\EPrint\Request;

use Ekyna\Component\Dpd\AbstractInput;
use Ekyna\Component\Dpd\Definition;
use Ekyna\Component\Dpd\EPrint\Model;
use Ekyna\Component\Dpd\RequestInterface;

/**
 * Class CollectionRequestRequest
 * @package Ekyna\Component\Dpd
 * @author  Etienne Dauvergne <contact@ekyna.com>
 *
 * @property Model\Address $receiveraddress       Adresse destinataire
 * @property Model\Address $shipperaddress        Adresse expéditeur
 * @property string        $customer_countrycode  Code pays 250 = France
 * @property string        $customer_centernumber Code agence
 * @property string        $customer_number       N° de compte
 * @property string        $parcel_count          Nombre de colis
 * @property string        $pick_date             Date d’enlèvement jj.mm.aaaa
 * @property string        $time_from             Optionnel (par défaut : 08:00)
 * @property string        $time_to               Optionnel (par défaut : 18:00)
 * @property string        $remark                Commentaire
 * @property string        $pick_remark           Instruction d’enlèvement
 * @property string        $delivery_remark       Instruction de livraison
 * @property string        $referencenumber       Référence interne 1
 * @property string        $reference2            Référence interne 2
 * @property string        $reference3            Référence interne 3
 */
class CollectionRequestRequest extends AbstractInput implements RequestInterface
{
    /**
     * @inheritdoc
     */
    protected function buildDefinition(Definition\Definition $definition): void
    {
        $definition
            ->addField(new Definition\Numeric('customer_countrycode', true, 3))
            ->addField(new Definition\Numeric('customer_centernumber', true, 3))
            ->addField(new Definition\Numeric('customer_number', true, 6))
            ->addField(new Definition\Model('receiveraddress', true, Model\Address::class))// optional in WSDL / required in doc
            ->addField(new Definition\Model('shipperaddress', true, Model\Address::class))// optional in WSDL / required in doc
            ->addField(new Definition\Model('services', true, Model\CollectionRequestService::class))
            ->addField(new Definition\Numeric('parcel_count', true, 2))
            ->addField(new Definition\Date('pick_date', false))
            ->addField(new Definition\Time('time_from', false))
            ->addField(new Definition\Time('time_to', false))
            ->addField(new Definition\AlphaNumeric('remark', false, 35))
            ->addField(new Definition\AlphaNumeric('pick_remark', false, 35))
            ->addField(new Definition\AlphaNumeric('delivery_remark', false, 35))
            ->addField(new Definition\AlphaNumeric('referencenumber', false, 35))
            ->addField(new Definition\AlphaNumeric('reference2', false, 35))
            ->addField(new Definition\AlphaNumeric('reference3', false, 35))
            ->addField(new Definition\Boolean('dayCheckDone', false)); // TODO nullable
    }
}
