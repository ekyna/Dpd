<?php
declare (strict_types=1);

namespace Ekyna\Component\Dpd\EPrint\Enum;

/**
 * Class EType
 * @package Ekyna\Component\Dpd
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
final class EType implements EnumInterface
{
    const REVERSE            = 'REVERSE';          // Expédition Retour
    const PROOF              = 'PROOF';            // Preuve de dépôt
    const EPRINT             = 'EPRINT';           // Etiquette DPD
    const EPRINT_ATTACHMENT  = 'EPRINTATTACHMENT'; // Récapitulatif d’envoi
    const MASTER             = 'MASTER';
    const COLLECTION_REQUEST = 'COLLECTIONREQUEST';
    const BIC3               = 'BIC3';


    /**
     * @inheritdoc
     */
    public static function getValues(): array
    {
        return [
            static::REVERSE,
            static::PROOF,
            static::EPRINT,
            static::EPRINT_ATTACHMENT,
            static::MASTER,
            static::COLLECTION_REQUEST,
            static::BIC3,
        ];
    }

    /**
     * Disabled Constructor.
     */
    private function __construct()
    {
    }
}
