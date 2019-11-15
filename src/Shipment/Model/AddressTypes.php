<?php

namespace Ekyna\Component\Dpd\Shipment\Model;

use Ekyna\Component\Dpd\Exception\InvalidArgumentException;

/**
 * Class AddressTypes
 * @author Etienne Dauvergne <contact@ekyna.com>
 */
final class AddressTypes
{
    public const RECEIVER = 'receiver';
    public const SENDER   = 'sender';
    public const RETURN   = 'return';
    public const PICKUP   = 'pickup';
    public const DELIVERY = 'delivery';


    /**
     * Returns the available address types.
     *
     * @return array
     */
    public static function getConstants(): array
    {
        return [
            self::RECEIVER,
            self::SENDER,
            self::RETURN,
            self::PICKUP,
            self::DELIVERY,
        ];
    }

    /**
     * Checks whether the given address type is valid.
     *
     * @param string $type
     */
    public static function isValid(string $type): void
    {
        if (!in_array($type, self::getConstants(), true)) {
            throw new InvalidArgumentException("Unknown address type '$type'.");
        }
    }

    /**
     * @param string $type
     *
     * @return array
     */
    public static function getMapping(string $type): array
    {
        if ($type === self::RECEIVER) {
            return [
                'name'           => ['receiverFirmName', false],
                'firstName'      => ['receiverFirstName', false],
                'lastName'       => ['receiverLastName', false],
                'houseNumber'    => ['receiverHouseNo', false],
                'street'         => ['receiverStreet', true],
                'streetInfo'     => ['receiverStreetInfo', false],
                'zipCode'        => ['receiverZipCode', true],
                'city'           => ['receiverCity', true],
                'countryCode'    => ['receiverCountryCode', true],
                'phoneNumber'    => ['receiverLandlineNumber', false],
                'mobileNumber'   => ['receiverMobileNumber', false],
                'email'          => ['receiverEmailAddress', false],
                'code1'          => ['receiverCode1', false],
                'code2'          => ['receiverCode2', false],
                'intercom'       => ['receiverIntercom', false],
                'additionalInfo' => ['receiverAdditionalAdrInfo', false],
            ];
        }

        if (in_array($type, [self::SENDER, self::RETURN], true)) {
            return [
                'name'        => ['name', true],
                'houseNumber' => ['buildingNo', false],
                'street'      => ['street', true],
                'streetInfo'  => ['streetInfo', false],
                'zipCode'     => ['zipCode', true],
                'city'        => ['cityName', true],
                'countryCode' => ['countryCode', true],
                'phoneNumber' => ['telNo', false],
            ];
        }

        if (in_array($type, [self::PICKUP, self::DELIVERY], true)) {
            $prefix = $type === self::PICKUP ? 'c' : 'r';

            return [
                'name'           => [$prefix . 'name', true],
                'firstName'      => [$prefix . 'name2', true],
                'lastName'       => [$prefix . 'name2', true],
                'houseNumber'    => [$prefix . 'houseNo', false],
                'street'         => [$prefix . 'street', true],
                'streetInfo'     => [$prefix . 'streetInfo', false],
                'zipCode'        => [$prefix . 'postal', true],
                'city'           => [$prefix . 'city', true],
                'countryCode'    => [$prefix . 'country', true],
                'phoneNumber'    => [$prefix . 'phone', true],
                'mobileNumber'   => [$prefix . 'phone2', false],
                'email'          => [$prefix . 'email', false],
                'code1'          => [$prefix . 'code1', false],
                'code2'          => [$prefix . 'code2', false],
                'intercom'       => [$prefix . 'intercom', false],
                'additionalInfo' => [$prefix . 'additionalAddressText', false],
            ];
        }

        throw new InvalidArgumentException("Unexpected address type '$type'.");
    }

    /** Disabled constructor */
    private function __construct()
    {
    }
}
