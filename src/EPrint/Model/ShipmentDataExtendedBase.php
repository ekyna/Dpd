<?php

declare(strict_types=1);

namespace Ekyna\Component\Dpd\EPrint\Model;

use Ekyna\Component\Dpd\OutputInterface;

/**
 * Class ShipmentDataExtendedBase
 * @package Ekyna\Component\Dpd\EPrint\Model
 * @author  Étienne Dauvergne <contact@ekyna.com>
 *
 * @property string      $customer_centernumber
 * @property string      $customernumber
 * @property string      $weight
 * @property string      $shipping_date
 * @property string      $referencenumber
 * @property string      $reference2
 * @property string      $reference3
 * @property string      $reference4
 * @property string      $referenceInternational
 * @property Address     $shipperaddress
 * @property Address     $customeraddress
 * @property Address     $receiveraddress
 * @property Contact     $receiver_contact
 * @property string      $pickup_remark  // TODO missing from ws response.
 * @property string      $deliver_remark // TODO missing from ws response.
 * @property AddressInfo $receiverinfo
 * @property int         $shipperCenter
 * @property int         $receiverCenter
 * @property int         $receiverTourNumber
 */
class ShipmentDataExtendedBase implements OutputInterface
{
    /**
     * @inheritdoc
     */
    public function initialize(): void
    {

    }
}
