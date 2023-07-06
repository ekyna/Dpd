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
    public const REVERSE            = 'REVERSE';          // Expédition Retour
    public const PROOF              = 'PROOF';            // Preuve de dépôt
    public const EPRINT             = 'EPRINT';           // Etiquette DPD
    public const EPRINT_ATTACHMENT  = 'EPRINTATTACHMENT'; // Récapitulatif d’envoi
    public const MASTER             = 'MASTER';
    public const COLLECTION_REQUEST = 'COLLECTIONREQUEST';
    public const BIC3               = 'BIC3';


    /**
     * @inheritdoc
     */
    public static function getValues(): array
    {
        return [
            EType::REVERSE,
            EType::PROOF,
            EType::EPRINT,
            EType::EPRINT_ATTACHMENT,
            EType::MASTER,
            EType::COLLECTION_REQUEST,
            EType::BIC3,
        ];
    }

    /**
     * Disabled Constructor.
     */
    private function __construct()
    {
    }
}
