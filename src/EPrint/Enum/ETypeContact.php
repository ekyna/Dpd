<?php

declare (strict_types=1);

namespace Ekyna\Component\Dpd\EPrint\Enum;

/**
 * Class ETypeContact
 * @package Ekyna\Component\Dpd
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
final class ETypeContact implements EnumInterface
{
    public const NO             = 'No';            // Désactive la notification
    public const PREDICT        = 'Predict';       // Expédition Predict
    public const AUTOMATIC_SMS  = 'AutomaticSMS'; // Notification SMS
    public const AUTOMATIC_MAIL = 'AutomaticMail'; // Notification E-Mail


    /**
     * @inheritdoc
     */
    public static function getValues(): array
    {
        return [
            ETypeContact::NO,
            ETypeContact::PREDICT,
            ETypeContact::AUTOMATIC_SMS,
            ETypeContact::AUTOMATIC_MAIL,
        ];
    }

    /**
     * Disabled Constructor.
     */
    private function __construct()
    {
    }
}
