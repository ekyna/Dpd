<?php

namespace Ekyna\Component\Dpd\Shipment\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * Class Address
 * @author Etienne Dauvergne <contact@ekyna.com>
 */
class Address extends Constraint
{
    public $required_field = 'Field is required.';
    public $first_and_last_name_required_for_relay = 'First and last names required for relay.';
    public $mobile_number_required_for_predict = 'Mobile number is required for predict.';
    public $firm_or_name_required = 'Either firm name or first and last names must be set.';

    public $type;

    /**
     * {@inheritdoc}
     */
    public function getDefaultOption()
    {
        return 'type';
    }

    /**
     * {@inheritdoc}
     */
    public function getRequiredOptions()
    {
        return ['type'];
    }

    public function getTargets()
    {
        return self::PROPERTY_CONSTRAINT;
    }
}
