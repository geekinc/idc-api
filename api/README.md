## Synopsis

This project enables interaction between the various IDC systems.

## Code Example

This project is built as an API that has endpoints to be called periodically (with cURL in a crontab).

## Tests

Testing can be done from within Vagrant.

```
$ vagrant up
$ cd /var/www
$ sudo apt-get install snmp ( you only need to do this the first time )
$ composer update 
$ vendor/bin/phpunit --configuration phpunit_mysql.xml
```

## Contributors

This project lives on the Geek Inc. GitLab system.

## License

This project is Copyright © Geek Inc. 2016-2018
