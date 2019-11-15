<?php

namespace Ekyna\Component\Dpd\Shipment\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * Class CreatePickupOrderRequest
 * @author Etienne Dauvergne <contact@ekyna.com>
 */
class CreatePickupOrderRequest extends Constraint
{
    public $dates_must_share_the_same_day = 'From et to dates must share the same day.';
    public $start_time_must_be_lower_than_end_time = 'Start time must be lower than end time.';

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}
