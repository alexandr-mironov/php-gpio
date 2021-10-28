# PHP-GPIO
PHP library to manage GPIO on single-board computers (like OrangePi, BananaPi, RaspberryPi)

## Troubleshooting
### inside docker
don't forget to properly set your volumes:

    volumes:
      - ./:/app
      - "phpsocket:/var/run"
      - "/sys/:/sys/:rw"
    