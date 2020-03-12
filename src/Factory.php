<?php

namespace Ekyna\Component\Dpd;

use Ekyna\Component\Dpd\Relay;
use Ekyna\Component\Dpd\Relay\Serializer as R;
use Ekyna\Component\Dpd\Shipment;
use Ekyna\Component\Dpd\Shipment\Serializer as S;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class Factory
 * @author Etienne Dauvergne <contact@ekyna.com>
 */
final class Factory
{
    /**
     * @var array array
     */
    private $config = [];

    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * @var Serializer
     */
    private $serializer;

    /**
     * @var Shipment\Api
     */
    private $shipmentApi;

    /**
     * @var Relay\Api
     */
    private $relayApi;


    /**
     * Constructor.
     *
     * @param array              $config
     * @param ValidatorInterface $validator
     * @param Serializer         $serializer
     */
    public function __construct(array $config, ValidatorInterface $validator = null, Serializer $serializer = null)
    {
        // TODO Validate
        $this->config = array_replace([
            "carrier"             => null,
            "key"                 => null,
            "login"               => null,
            "password"            => null,
            "payer_id"            => null,
            "payer_address_id"    => null,
            "sender_id"           => null,
            "sender_address_id"   => null,
            "departure_unit_id"   => null,
            "sender_zip_code"     => null,
            "sender_country_code" => null,
        ], $config);

        $this->validator = $validator;
        $this->serializer = $serializer;
    }

    /**
     * Returns the config.
     *
     * @return array
     */
    public function getConfig(): array
    {
        return $this->config;
    }

    /**
     * Returns the relay API.
     *
     * @return Relay\Api
     */
    public function getRelayApi(array $config = null): Relay\Api
    {
        if (is_null($config) && $this->relayApi) {
            return $this->relayApi;
        }

        return $this->relayApi = new Relay\Api(
            $this->createRelayClient($config),
            $this->getValidator(),
            $this->getSerializer()
        );
    }

    /**
     * Returns the shipment API.
     *
     * @param array|null $config
     *
     * @return Shipment\Api
     */
    public function getShipmentApi(array $config = null): Shipment\Api
    {
        if (is_null($config) && $this->shipmentApi) {
            return $this->shipmentApi;
        }

        return $this->shipmentApi = new Shipment\Api(
            $this->createShipmentClient($config),
            $this->getCredentials($config),
            $this->getValidator(),
            $this->getSerializer()
        );
    }

    /**
     * Creates the shipment client.
     *
     * @param array|null $config
     *
     * @return Shipment\Client
     */
    protected function createShipmentClient(array $config = null): Shipment\Client
    {
        $config = array_replace($this->config, (array)$config);

        return new Shipment\Client($config['login'], $config['password']);
    }

    /**
     * Creates the relay client.
     *
     * @param array|null $config
     *
     * @return Relay\Client
     */
    protected function createRelayClient(array $config = null): Relay\Client
    {
        $config = array_replace($this->config, (array)$config);

        return new Relay\Client($config['carrier'], $config['key']);
    }

    /**
     * Returns the credentials model.
     *
     * @param array|null $config
     *
     * @return Shipment\Model\Credentials
     */
    protected function getCredentials(array $config = null): Shipment\Model\Credentials
    {
        $config = array_replace($this->config, (array)$config);

        return (new Shipment\Model\Credentials())
            ->setPayerId($config['payer_id'])
            ->setPayerAddressId($config['payer_address_id'])
            ->setSenderId($config['sender_id'])
            ->setSenderAddressId($config['sender_address_id'])
            ->setDepartureUnitId($config['departure_unit_id'])
            ->setSenderZipCode($config['sender_zip_code'])
            ->setSenderCountryCode($config['sender_country_code']);
    }

    /**
     * Returns the validator.
     *
     * @return ValidatorInterface
     */
    protected function getValidator(): ValidatorInterface
    {
        if ($this->validator) {
            return $this->validator;
        }

        return $this->validator = self::createValidator();
    }

    /**
     * Returns the serializer.
     *
     * @return Serializer
     */
    protected function getSerializer(): Serializer
    {
        if ($this->serializer) {
            return $this->serializer;
        }

        return $this->serializer = self::createSerializer();
    }

    /**
     * Creates the validator.
     *
     * @return ValidatorInterface
     */
    public static function createValidator(): ValidatorInterface
    {
        return Validation::createValidatorBuilder()
            // TODO Metadata cache or factory ?
            ->addXmlMapping(__DIR__ . '/Shipment/Resources/validation.xml')
            ->addXmlMapping(__DIR__ . '/Relay/Resources/validation.xml')
            ->getValidator();
    }

    /**
     * Creates the serializer.
     *
     * @return Serializer
     */
    public static function createSerializer(): Serializer
    {
        return new Serializer([
            // Relay responses
            new R\DetailResponseDenormalizer(),
            new R\ListResponseDenormalizer(),
            // Shipment responses
            new S\CancelCollectionResponseDenormalizer(),
            new S\CreateCollectionResponseDenormalizer(),
            new S\PickupOrderResponseDenormalizer(),
            new S\ReprintLabelResponseDenormalizer(),
            new S\ReturnOnDemandResponseDenormalizer(),
            new S\ShipmentResponseDenormalizer(),
            new S\ShipmentWithLabelResponseDenormalizer(),
            // Relay requests
            new R\DetailRequestNormalizer(),
            new R\ListRequestNormalizer(),
            // Shipment requests
            new S\CancelCollectionRequestNormalizer(),
            new S\CancelPickupOrderRequestNormalizer(),
            new S\CreateCollectionRequestNormalizer(),
            new S\CreatePickupOrderRequestNormalizer(),
            new S\GetLabelRequestNormalizer(),
            new S\ReprintLabelRequestNormalizer(),
            new S\ReturnOnDemandRequestNormalizer(),
            new S\ShipmentWithLabelRequestNormalizer(),
            new S\ShipmentRequestNormalizer(),
            // Relay models
            new R\ItemDenormalizer(),
            // Shipment models
            new S\AddressNormalizer(),
            new S\CredentialsNormalizer(),
            new S\ParcelNormalizer(),
            new S\LabelDenormalizer(),
            new S\ManifestNormalizer(),
            new S\ShipmentDenormalizer(),
        ], [new JsonEncoder(), new XmlEncoder()]);
    }
}
