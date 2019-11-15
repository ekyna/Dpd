<?php

namespace Ekyna\Component\Dpd\Shipment\Request;

use Ekyna\Component\Dpd\Shipment\Model\Credentials;

/**
 * Class AbstractCredentialRequest
 * @author Etienne Dauvergne <contact@ekyna.com>
 */
abstract class AbstractCredentialRequest implements RequestInterface
{
    /** @var Credentials */
    protected $credentials;


    /**
     * Returns the credentials.
     *
     * @return Credentials
     */
    public function getCredentials(): ?Credentials
    {
        return $this->credentials;
    }

    /**
     * Sets the credentials.
     *
     * @param Credentials $credentials
     *
     * @return AbstractCredentialRequest
     */
    public function setCredentials(Credentials $credentials): self
    {
        $this->credentials = $credentials;

        return $this;
    }
}
