<?php

namespace Ekyna\Component\Dpd\Shipment;

use Ekyna\Component\Dpd\Shipment\Model\Credentials;
use Ekyna\Component\Dpd\Shipment\Serializer as S;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
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
     * @var Api
     */
    private $api;

    /**
     * @var Credentials
     */
    private $credentials;


    /**
     * Constructor.
     *
     * @param array              $config
     * @param ValidatorInterface $validator
     * @param Serializer         $serializer
     */
    public function __construct(array $config, ValidatorInterface $validator = null, Serializer $serializer = null)
    {
        $this->config = array_replace([
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
     * Returns the API.
     *
     * @return Api
     */
    public function getApi(): Api
    {
        if ($this->api) {
            return $this->api;
        }

        return $this->api = new Api(
            $this->createClient(),
            $this->getCredentials(),
            $this->getValidator(),
            $this->getSerializer()
        );
    }

    /**
     * Returns the credentials model.
     *
     * @return Credentials
     */
    protected function getCredentials(): Credentials
    {
        if ($this->credentials) {
            return $this->credentials;
        }

        return $this->credentials = (new Credentials())
            ->setPayerId($this->config['payer_id'])
            ->setPayerAddressId($this->config['payer_address_id'])
            ->setSenderId($this->config['sender_id'])
            ->setSenderAddressId($this->config['sender_address_id'])
            ->setDepartureUnitId($this->config['departure_unit_id'])
            ->setSenderZipCode($this->config['sender_zip_code'])
            ->setSenderCountryCode($this->config['sender_country_code']);
    }

    /**
     * Creates the client.
     *
     *
     * @return Client
     */
    protected function createClient(): Client
    {
        return new Client($this->config['login'], $this->config['password']);
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
            ->addXmlMapping(__DIR__ . '/Resources/validation.xml')
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
            new S\CancelCollectionResponseDenormalizer(),
            new S\CreateCollectionResponseDenormalizer(),
            new S\PickupOrderResponseDenormalizer(),
            new S\ReprintLabelResponseDenormalizer(),
            new S\ReturnOnDemandResponseDenormalizer(),
            new S\ShipmentResponseDenormalizer(),
            new S\ShipmentWithLabelResponseDenormalizer(),

            new S\CancelCollectionRequestNormalizer(),
            new S\CancelPickupOrderRequestNormalizer(),
            new S\CreateCollectionRequestNormalizer(),
            new S\CreatePickupOrderRequestNormalizer(),
            new S\GetLabelRequestNormalizer(),
            new S\ReprintLabelRequestNormalizer(),
            new S\ReturnOnDemandRequestNormalizer(),
            new S\ShipmentWithLabelRequestNormalizer(),
            new S\ShipmentRequestNormalizer(),

            new S\AddressNormalizer(),
            new S\CredentialsNormalizer(),
            new S\ParcelNormalizer(),
            new S\LabelDenormalizer(),
            new S\ManifestNormalizer(),
            new S\ShipmentDenormalizer(),
        ], [new JsonEncoder()]);
    }
}
