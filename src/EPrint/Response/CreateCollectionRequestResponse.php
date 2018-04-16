<?php

namespace Ekyna\Component\Dpd\EPrint\Response;

use Ekyna\Component\Dpd\OutputInterface;
use Ekyna\Component\Dpd\ResponseInterface;

/**
 * Class CreateCollectionRequestResponse
 * @package Ekyna\Component\Dpd\EPrint\Response
 * @author  Etienne Dauvergne <contact@ekyna.com>
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
