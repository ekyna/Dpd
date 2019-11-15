<?php

namespace Ekyna\Component\Dpd\Test\Relay\Serializer;

use Ekyna\Component\Dpd\Relay\Request\DetailRequest;
use Ekyna\Component\Dpd\Relay\Serializer\DetailRequestNormalizer;
use PHPUnit\Framework\TestCase;

/**
 * Class DetailRequestNormalizerTest
 * @author Etienne Dauvergne <contact@ekyna.com>
 */
class DetailRequestNormalizerTest extends TestCase
{
    public function testNormalize(): void
    {
        $model = new DetailRequest('foo');

        $expected = [
            'pudo_id' => 'foo',
        ];

        $actual = (new DetailRequestNormalizer())->normalize($model, 'json');

        $this->assertEquals($expected, $actual);
    }
}
