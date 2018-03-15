<?php
declare (strict_types=1);

namespace Ekyna\Component\DpdWs\Model;

use Ekyna\Component\DpdWs\Definition;

/**
 * Class UserCredentials
 * @package Ekyna\Component\DpdWs
 * @author  Etienne Dauvergne <contact@ekyna.com>
 *
 * @property string $userid
 * @property string $password
 */
class UserCredentials extends AbstractModel
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
