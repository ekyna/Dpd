<?php

namespace Ekyna\Component\Dpd\Test\Relay\Serializer;

use Ekyna\Component\Dpd\Relay\Request\ListRequest;
use Ekyna\Component\Dpd\Relay\Serializer\ListRequestNormalizer;
use PHPUnit\Framework\TestCase;

/**
 * Class ListRequestNormalizerTest
 * @author Etienne Dauvergne <contact@ekyna.com>
 */
class ListRequestNormalizerTest extends TestCase
{
    public function testNormalize(): void
    {
        $model = new ListRequest();
        $model
            ->setAddress('32 rue de rennes')
            ->setZipCode('35230')
            ->setCity('Noyal-Châtillon-sur-Seiche')
            ->setCountryCode('fr')
            ->setRequestId('foo')
            ->setDate(new \DateTime('2020-01-01'))
            ->setWeight(2)
            ->setMaxDistance(10)
            ->setMaxNumber(10)
            ->setCategory('test')
            ->setHoliday(false)
        ;

        $expected = [
            'address'             => '32 rue de rennes',
            'zipCode'             => '35230',
            'city'                => 'Noyal-Châtillon-sur-Seiche',
            'requestID'           => 'foo',
            'date_from'           => '01/01/2020',
            'countrycode'         => 'fr',
            'max_pudo_number'     => '10',
            'max_distance_search' => '10',
            'weight'              => '2',
            'category'            => 'test',
            'holiday_tolerant'    => false,
        ];

        $actual = (new ListRequestNormalizer())->normalize($model, 'json');

        $this->assertEquals($expected, $actual);
    }
}
