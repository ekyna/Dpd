<?php

declare (strict_types=1);

namespace Ekyna\Component\Dpd\EPrint\Response;

use Ekyna\Component\Dpd\EPrint\Model\LabelBcResponse;
use Ekyna\Component\Dpd\OutputInterface;
use Ekyna\Component\Dpd\ResponseInterface;

/**
 * Class GetLabelBcResponse
 * @package Ekyna\Component\Dpd
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
class GetLabelBcResponse implements ResponseInterface, OutputInterface
{
    /**
     * @var LabelBcResponse
     */
    public $GetLabelBcResult;


    /**
     * @inheritdoc
     */
    public function initialize(): void
    {
        if ($this->GetLabelBcResult) {
            $this->GetLabelBcResult->initialize();
        }
    }
}
