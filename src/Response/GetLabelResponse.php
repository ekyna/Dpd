<?php
declare (strict_types=1);

namespace Ekyna\Component\Dpd\Response;

use Ekyna\Component\Dpd\Model;

/**
 * Class GetLabelResponse
 * @package Ekyna\Component\Dpd
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
class GetLabelResponse implements ResponseInterface, Model\OutputInterface
{
    /**
     * @var Model\LabelResponse
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
