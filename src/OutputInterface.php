<?php
declare (strict_types=1);

namespace Ekyna\Component\Dpd;

/**
 * Interface OutputInterface
 * @package Ekyna\Component\Dpd\Model
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
interface OutputInterface
{
    /**
     * Initializes the output object.
     *
     * @return void
     */
    public function initialize(): void;
}
