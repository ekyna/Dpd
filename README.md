# ekyna/Dpd

PHP component for DPD shipment.

[![Build](https://github.com/ekyna/dpd/actions/workflows/build.yml/badge.svg?branch=master)](https://github.com/ekyna/dpd/actions/workflows/build.yml)


## Installation

    composer require ekyna/dpd
    
## Usage

### EPrint

_You will need credentials and IP address authorization. Please refer to your DPD contact to get access granted._ 

Copy ./examples/config.php.dist into ./examples/config.php and fill credentials.

* [CreateShipmentWithLabelsBc](https://github.com/ekyna/Dpd/blob/master/examples/create-shipment-with-labels-bc_classic.php)
* [CreateMultiShipmentBc](https://github.com/ekyna/Dpd/blob/master/examples/create-multi-shipment-bc.php)
* [GetShipmentBc](https://github.com/ekyna/Dpd/blob/master/examples/get-shipment-bc.php)
* [GetLabelBc](https://github.com/ekyna/Dpd/blob/master/examples/get-label-bc.php)

## Testing with Docker

    docker build . -t dpd-test
    docker run -it --rm dpd-test php examples/create-multi-shipment-bc.php
