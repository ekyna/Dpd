<?php

namespace Ekyna\Component\Dpd\Relay;

use Ekyna\Component\Dpd\Exception\InvalidArgumentException;
use Ekyna\Component\Dpd\Relay\Request as Req;
use Ekyna\Component\Dpd\Relay\Response as Res;
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
     * @var ValidatorInterface
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
     * @param ValidatorInterface $validator
     * @param Serializer         $serializer
     */
    public function __construct(Client $client, ValidatorInterface $validator, Serializer $serializer)
    {
        $this->client = $client;
        $this->validator = $validator;
        $this->serializer = $serializer;
    }

    /**
     * Lists the available relay points.
     *
     * @param Req\ListRequest $request
     *
     * @return Res\ListResponse
     */
    public function getList(Req\ListRequest $request): Res\ListResponse
    {
        /** @noinspection PhpIncompatibleReturnTypeInspection */
        return $this->request($request, 'GetPudoList', Res\ListResponse::class);
    }

    /**
     * Get the relay point details.
     *
     * @param Req\DetailRequest $request
     *
     * @return Res\DetailResponse
     */
    public function getDetails(Req\DetailRequest $request): Res\DetailResponse
    {
        /** @noinspection PhpIncompatibleReturnTypeInspection */
        return $this->request($request, 'GetPudoDetails', Res\DetailResponse::class);
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
        $this->validate($request);

        $req = $this->serializer->normalize($request, 'json');

        $data = $this->client->call($path, $req);

        /** @noinspection PhpIncompatibleReturnTypeInspection */
        return $this->serializer->deserialize($data, $responseClass, 'xml');
    }

    /**
     * Validates the request model.
     *
     * @param Req\RequestInterface $request
     */
    private function validate(Req\RequestInterface $request): void
    {
        $violations = $this->validator->validate($request, null);

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
