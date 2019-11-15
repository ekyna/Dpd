# ekyna/Dpd

PHP component for DPD shipment.

[![Build Status](https://travis-ci.org/ekyna/Dpd.svg?branch=master)](https://travis-ci.org/ekyna/Dpd)

## Installation

    composer require ekyna/dpd

## Usage

Create __examples/config.php__ (based on _examples/config.php.dist_) to configure examples.

_You will need credentials and IP address authorization. Please refer to your DPD contact to get access granted._ 

### Shipment

* [Create shipment and get label](https://github.com/ekyna/Dpd/blob/master/examples/create-shipment-and-get-label.php)
* [Create shipment with label](https://github.com/ekyna/Dpd/blob/master/examples/create-shipment-with-label.php)
* [Reprint label](https://github.com/ekyna/Dpd/blob/master/examples/reprint-label.php)
* [Return on demand](https://github.com/ekyna/Dpd/blob/master/examples/return-on-demand.php)

### Pickup order

* [Create pickup order](https://github.com/ekyna/Dpd/blob/master/examples/create-pickup-order.php)
* [Cancel pickup order](https://github.com/ekyna/Dpd/blob/master/examples/cancel-pickup-order.php)

### Collection request

* [Create collection request](https://github.com/ekyna/Dpd/blob/master/examples/create-collection-request.php)
* [Cancel pickup order](https://github.com/ekyna/Dpd/blob/master/examples/cancel-collection-request.php)

### Relay point

* [List relay point](https://github.com/ekyna/Dpd/blob/master/examples/get-pudo-list.php)
* [Relay point details](https://github.com/ekyna/Dpd/blob/master/examples/get-pudo-details.php)
