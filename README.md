# PHP-GPIO
PHP library to manage GPIO on single-board computers (like OrangePi, BananaPi, RaspberryPi)

## Troubleshooting
### inside docker
don't forget to properly set your volumes:

    volumes:
      - ./:/app
      - "phpsocket:/var/run"
      - "/sys/:/sys/:rw"
    
## Usage example
### GPIO service (simplefied)
    
```php
<?php

namespace YourNamespace\Services;

use Gpio\Gpio;
use YourNamespace\Models\Pin;

class GpioService
{
    private Gpio $gpio;

    public function __construct()
    {
        $this->gpio = new Gpio();
    }
    
    /**
     * @param Pin $pin
     * @param mixed $value
     */
    private function setValue(Pin $pin, $value): void
    {
        $pin = $this->gpio->getOutputPin($pin->number);
        $pin->setValue($value);
    }

    public function changePinState(string $slug, mixed $value): void
    {
        // for example you can get your pins by slug from DB
        $pin = new Pin(
            1,
            1,
            'led1',
            '',
            70,
            ''
        );

        $this->setValue($pin, $value);
    }
}
```
