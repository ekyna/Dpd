<?php

namespace Ekyna\Component\Dpd\Shipment\Validator;

use Ekyna\Component\Dpd\Shipment\Request\CreatePickupOrderRequest as Model;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

/**
 * Class CreatePickupOrderRequestValidator
 * @author Etienne Dauvergne <contact@ekyna.com>
 */
class CreatePickupOrderRequestValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if (!$value instanceof Model) {
            throw new UnexpectedTypeException($value, Model::class);
        }
        if (!$constraint instanceof CreatePickupOrderRequest) {
            throw new UnexpectedTypeException($constraint, CreatePickupOrderRequest::class);
        }

        if (null === $from = $value->getFromDate()) {
            return;
        }
        if (null === $to = $value->getToDate()) {
            return;
        }

        if ($from->format('Ymd') !== $to->format('Ymd')) {
            $this
                ->context
                ->buildViolation($constraint->dates_must_share_the_same_day)
                ->addViolation();

            return;
        }

        if ($from->format('His') > $to->format('His')) {
            $this
                ->context
                ->buildViolation($constraint->start_time_must_be_lower_than_end_time)
                ->addViolation();
        }
    }
}
