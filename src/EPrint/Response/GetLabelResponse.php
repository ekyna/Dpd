<?php
declare (strict_types=1);

namespace Ekyna\Component\Dpd\EPrint\Response;

use Ekyna\Component\Dpd\OutputInterface;
use Ekyna\Component\Dpd\ResponseInterface;

/**
 * Class GetLabelResponse
 * @package Ekyna\Component\Dpd
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
class GetLabelResponse implements ResponseInterface, OutputInterface
{
    /**
     * @var \Ekyna\Component\Dpd\EPrint\Model\LabelResponse
     */
    public $GetLabelResult;


    /**
     * @inheritdoc
     */
    public function initialize(): void
    {
        if ($this->GetLabelResult) {
            $this->GetLabelResult->initialize();
        }
    }
}
