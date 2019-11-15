<?php

namespace Ekyna\Component\Dpd\Shipment\Validator;

use Ekyna\Component\Dpd\Shipment\Model\Address as Model;
use Ekyna\Component\Dpd\Shipment\Model\AddressTypes;
use Ekyna\Component\Dpd\Shipment\Model\Products;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

/**
 * Class AddressValidator
 * @author Etienne Dauvergne <contact@ekyna.com>
 */
class AddressValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if (is_null($value)) {
            return;
        }

        if (!$value instanceof Model) {
            throw new UnexpectedTypeException($value, Model::class);
        }
        if (!$constraint instanceof Address) {
            throw new UnexpectedTypeException($constraint, Address::class);
        }

        AddressTypes::isValid($constraint->type);

        // Check required fields
        $mapping = AddressTypes::getMapping($constraint->type);
        $accessor = PropertyAccess::createPropertyAccessor();
        foreach ($mapping as $name => $config) {
            if (!$config[1]) { // Skip check for non required fields.
                continue;
            }

            if (empty($accessor->getValue($value, $name))) {
                $this->context
                    ->buildViolation($constraint->required_field, [
                        '{field}' => $name,
                    ])
                    ->atPath($name)
                    ->addViolation();

                return;
            }
        }

        if ($constraint->type !== AddressTypes::RECEIVER) {
            return;
        }

        // first AND last names required if relay
        if (in_array(Products::RELAY, $constraint->groups, true)) {
            if (empty($value->getFirstName()) || empty($value->getLastName())) {
                $this->context
                    ->buildViolation($constraint->first_and_last_name_required_for_relay)
                    ->addViolation();

                return;
            }
        } // Firm or (first and last) names must be defined
        elseif (empty($value->getName()) && (empty($value->getFirstName()) || empty($value->getLastName()))) {
            $this->context
                ->buildViolation($constraint->firm_or_name_required)
                ->addViolation();
        }

        // Mobile phone required for predict
        if (in_array(Products::PREDICT, $constraint->groups, true)) {
            if (empty($value->getMobileNumber())) {
                $this->context
                    ->buildViolation($constraint->mobile_number_required_for_predict)
                    ->addViolation();
            }
        }
    }
}
