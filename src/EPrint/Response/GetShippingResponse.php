<?php

declare (strict_types=1);

namespace Ekyna\Component\Dpd\EPrint\Response;

use Ekyna\Component\Dpd\ResponseInterface;

/**
 * Class GetShippingResponse
 * @package Ekyna\Component\Dpd
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
class GetShippingResponse implements ResponseInterface
{
    /**
     * @var \Ekyna\Component\Dpd\EPrint\Model\GetShippingResult
     */
    public $GetShippingResult;
}
