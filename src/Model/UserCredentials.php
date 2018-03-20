<?php
declare (strict_types=1);

namespace Ekyna\Component\Dpd\Model;

use Ekyna\Component\Dpd\Definition;

/**
 * Class UserCredentials
 * @package Ekyna\Component\Dpd
 * @author  Etienne Dauvergne <contact@ekyna.com>
 *
 * @property string $userid
 * @property string $password
 *
 * @TODO remove as not used
 */
class UserCredentials extends AbstractInput
{
    /**
     * @inheritdoc
     */
    protected function buildDefinition(Definition\Definition $definition): void
    {
        parent::buildDefinition($definition);

        $definition
            ->addField(new Definition\AlphaNumeric('userid', true, 35))
            ->addField(new Definition\AlphaNumeric('password', true, 35));
    }
}
