<?php

namespace Ekyna\Component\Dpd\Shipment;

use Ekyna\Component\Dpd\Exception\InvalidArgumentException;
use Ekyna\Component\Dpd\Shipment\Model\Credentials;
use Ekyna\Component\Dpd\Shipment\Request as Req;
use Ekyna\Component\Dpd\Shipment\Response as Res;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class Api
 * @author Etienne Dauvergne <contact@ekyna.com>
 */
class Api
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @var Credentials
     */
    private $credentials;

    /**
     * @var ValidatorInterface;
     */
    private $validator;

    /**
     * @var Serializer
     */
    private $serializer;


    /**
     * Constructor.
     *
     * @param Client             $client
     * @param Credentials        $credentials
     * @param ValidatorInterface $validator
     * @param Serializer         $serializer
     */
    public function __construct(
        Client $client,
        Credentials $credentials,
        ValidatorInterface $validator,
        Serializer $serializer
    ) {
        $this->client = $client;
        $this->credentials = $credentials;
        $this->validator = $validator;
        $this->serializer = $serializer;
    }

    /**
     * Creates a shipment and generates its label.
     *
     * @param Req\ShipmentWithLabelRequest $request
     *
     * @return Res\ShipmentWithLabelResponse
     */
    public function createShipmentWithLabel(Req\ShipmentWithLabelRequest $request): Res\ShipmentWithLabelResponse
    {
        /** @noinspection PhpIncompatibleReturnTypeInspection */
        return $this->request($request, 'shipment/save/print', Res\ShipmentWithLabelResponse::class);
    }

    /**
     * Creates a shipment for future label generation.
     *
     * @param Req\ShipmentRequest $request
     *
     * @return Res\ShipmentResponse
     */
    public function createShipment(Req\ShipmentRequest $request): Res\ShipmentResponse
    {
        /** @noinspection PhpIncompatibleReturnTypeInspection */
        return $this->request($request, 'shipment/save/ext', Res\ShipmentResponse::class);
    }

    /**
     * Close shipment and download its label.
     *
     * Confirms shipment creation and start multiple label generation, merged inside a single PDF file.
     *
     * @param Req\GetLabelRequest $request
     *
     * @return Res\ShipmentWithLabelResponse
     */
    public function getLabel(Req\GetLabelRequest $request): Res\ShipmentWithLabelResponse
    {
        /** @noinspection PhpIncompatibleReturnTypeInspection */
        return $this->request($request, 'manifest/label4web/print/close/download',
            Res\ShipmentWithLabelResponse::class);
    }

    /**
     * Reprint a previously generated label.
     *
     * @param Req\ReprintLabelRequest $request
     *
     * @return Res\ReprintLabelResponse
     */
    public function reprintLabel(Req\ReprintLabelRequest $request): Res\ReprintLabelResponse
    {
        /** @noinspection PhpIncompatibleReturnTypeInspection */
        return $this->request($request, 'manifest/label4web/reprint/download', Res\ReprintLabelResponse::class);
    }

    /**
     * Generates a « Return on demand » label.
     *
     * This type of return labels is linked to an initial shipment for which a return option was enabled.
     *
     * @param Req\ReturnOnDemandRequest $request
     *
     * @return Res\ReturnOnDemandResponse
     */
    public function returnOnDemand(Req\ReturnOnDemandRequest $request): Res\ReturnOnDemandResponse
    {
        /** @noinspection PhpIncompatibleReturnTypeInspection */
        return $this->request($request, 'shipment/print/return-on-demand', Res\ReturnOnDemandResponse::class);
    }

    /**
     * Creates a pickup order.
     *
     * If there isn’t already a scheduled parcel pickup at your company, you can trigger a one-off pickup order.
     * Please note that it is not possible to trigger a pickup order for the current day, and the pickup times are
     * subject to approval upon DPD France operational services.
     *
     * @param Req\CreatePickupOrderRequest $request
     *
     * @return Res\PickupOrderResponse
     */
    public function createPickupOrder(Req\CreatePickupOrderRequest $request): Res\PickupOrderResponse
    {
        /** @noinspection PhpIncompatibleReturnTypeInspection */
        return $this->request($request, 'call-pools/save', Res\PickupOrderResponse::class);
    }

    /**
     * Cancels a pickup order.
     *
     * Please note that it is not possible to cancel a pickup order programmed on the current day.
     *
     * @param Req\CancelPickupOrderRequest $request
     *
     * @return Res\PickupOrderResponse
     */
    public function cancelPickupOrder(Req\CancelPickupOrderRequest $request): Res\PickupOrderResponse
    {
        /** @noinspection PhpIncompatibleReturnTypeInspection */
        return $this->request(
            $request,
            'deletion-shipments/pickup-orders-with-related-shipments',
            Res\PickupOrderResponse::class
        );
    }

    /**
     * Creates a collection request.
     *
     * A Collection Request represents a request for picking goods from a third party,
     * to return at your warehouses or to be delivered to another third party.
     * This service is subject to availability according to the country of removal and delivery.
     * Please note that it is not possible to program a Collection Request for the current day.
     *
     * @param Req\CreateCollectionRequest $request
     *
     * @return Res\CreateCollectionResponse
     */
    public function createCollectionRequest(Req\CreateCollectionRequest $request): Res\CreateCollectionResponse
    {
        if (empty($request->getCustref())) {
            $request->setCustref($this->credentials->getPayerId());
        }

        /** @noinspection PhpIncompatibleReturnTypeInspection */
        return $this->request($request, 'collection-request/save/ext', Res\CreateCollectionResponse::class);
    }

    /**
     * Cancels a collection request.
     *
     * Please note that it is not possible to cancel a Collection Request programmed on the current day.
     *
     * @param Req\CancelCollectionRequest $request
     *
     * @return Res\CancelCollectionResponse
     */
    public function cancelCollectionRequest(Req\CancelCollectionRequest $request): Res\CancelCollectionResponse
    {
        /** @noinspection PhpIncompatibleReturnTypeInspection */
        return $this->request($request, 'collection-request/cancel', Res\CancelCollectionResponse::class);
    }

    /**
     * Performs the request.
     *
     * @param Req\RequestInterface $request
     * @param string               $path
     * @param string               $responseClass
     *
     * @return Res\ResponseInterface
     */
    private function request(Req\RequestInterface $request, string $path, string $responseClass): Res\ResponseInterface
    {
        if ($request instanceof Req\AbstractCredentialRequest) {
            $request->setCredentials($this->credentials);
        }

        $this->validate($request);

        $req = $this->serializer->serialize($request, 'json');

        $data = $this->client->call($path, $req);

        return $this->serializer->denormalize($data, $responseClass, 'json');
    }

    /**
     * Validates the request model.
     *
     * @param Req\RequestInterface $request
     */
    private function validate(Req\RequestInterface $request): void
    {
        $violations = $this->validator->validate($request, null, $request->getValidationGroups());

        if (0 === $violations->count()) {
            return;
        }

        $message = "Invalid request:\n";

        /** @var \Symfony\Component\Validator\ConstraintViolationInterface $violation */
        foreach ($violations as $violation) {
            $message .= sprintf("- [%s] %s\n", $violation->getPropertyPath(), $violation->getMessage());
        }

        throw new InvalidArgumentException($message);
    }
}
