<?php

declare(strict_types=1);

namespace Ekyna\Component\Dpd\EPrint\Response;

use Ekyna\Component\Dpd\OutputInterface;
use Ekyna\Component\Dpd\ResponseInterface;

/**
 * Class CreateCollectionRequestResponse
 * @package Ekyna\Component\Dpd\EPrint\Response
 * @author  Etienne Dauvergne <contact@ekyna.com>
 *
 * @deprecated
 */
class CreateCollectionRequestResponse implements ResponseInterface, OutputInterface
{
    /**
     * @var \Ekyna\Component\Dpd\EPrint\Model\ArrayOfShipment
     */
    public $CreateCollectionRequestResult;


    /**
     * @inheritdoc
     */
    public function initialize(): void
    {
        if ($this->CreateCollectionRequestResult) {
            $this->CreateCollectionRequestResult->initialize();
        }
    }
}
