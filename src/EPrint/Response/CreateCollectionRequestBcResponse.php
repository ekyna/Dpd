<?php

declare(strict_types=1);

namespace Ekyna\Component\Dpd\EPrint\Response;

use Ekyna\Component\Dpd\EPrint\Model\ArrayOfShipmentBc;
use Ekyna\Component\Dpd\OutputInterface;
use Ekyna\Component\Dpd\ResponseInterface;

/**
 * Class CreateCollectionRequestResponse
 * @package Ekyna\Component\Dpd\EPrint\Response
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
class CreateCollectionRequestBcResponse implements ResponseInterface, OutputInterface
{
    /**
     * @var ArrayOfShipmentBc
     */
    public $CreateCollectionRequestBcResult;


    /**
     * @inheritdoc
     */
    public function initialize(): void
    {
        if ($this->CreateCollectionRequestBcResult) {
            $this->CreateCollectionRequestBcResult->initialize();
        }
    }
}
