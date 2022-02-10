# ekyna/Dpd

PHP component for DPD shipment.

[![Build](https://github.com/ekyna/dpd/actions/workflows/build.yml/badge.svg?branch=master)](https://github.com/ekyna/dpd/actions/workflows/build.yml)


## Installation

    composer require ekyna/dpd
    
## Usage

### EPrint

_You will need credentials and IP address authorization. Please refer to your DPD contact to get access granted._ 

* [CreateShipment](https://github.com/ekyna/Dpd/blob/master/examples/create-shipment.php)
* [CreateShipmentWithLabels](https://github.com/ekyna/Dpd/blob/master/examples/create-shipment-with-labels.php)
* [CreateMultiShipment](https://github.com/ekyna/Dpd/blob/master/examples/create-multi-shipment.php)
* [GetShipment](https://github.com/ekyna/Dpd/blob/master/examples/get-shipment.php)
* [GetLabel](https://github.com/ekyna/Dpd/blob/master/examples/get-label.php)

## Testing with Docker

    docker build . -t dpd-test
    docker run -it --rm dpd-test php examples/get-shipping.php
