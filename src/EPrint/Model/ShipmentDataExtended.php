<?php
declare (strict_types=1);

namespace Ekyna\Component\Dpd\EPrint\Model;

/**
 * Class ShipmentDataExtended
 * @package Ekyna\Component\Dpd\Model
 * @author  Etienne Dauvergne <contact@ekyna.com>
 *
 * @property string $countrycode
 * @property string $centernumber
 * @property string $parcelnumber
 * @property string $customer_centernumber
 * @property string $customernumber
 * @property string $weight
 * @property string $shipping_date
 * @property string $referencenumber
 * @property string $reference2
 * @property string $reference3
 * @property Address $shipperaddress
 * @property Address $customeraddress
 * @property Address $receiveraddress
 * @property Contact $receiver_contact
 * @property string $pickup_remark // TODO missing from ws response.
 * @property string $deliver_remark // TODO missing from ws response.
 */
class ShipmentDataExtended
{

}
