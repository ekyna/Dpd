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
    const NO             = 'No';            // Désactive la notification
    const PREDICT        = 'Predict';       // Expédition Predict
    const AUTOMATIC_SMS  = 'AutomaticSMS '; // Notification SMS
    const AUTOMATIC_MAIL = 'AutomaticMail'; // Notification E-Mail


    /**
     * @inheritdoc
     */
    public static function getValues(): array
    {
        return [
            static::NO,
            static::PREDICT,
            static::AUTOMATIC_SMS,
            static::AUTOMATIC_MAIL,
        ];
    }

    /**
     * Disabled Constructor.
     */
    private function __construct()
    {
    }
}
