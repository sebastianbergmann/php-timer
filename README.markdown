PHP_Timer
=========

Installation
------------

PHP_Timer should be installed using the [PEAR Installer](http://pear.php.net/). This installer is the backbone of PEAR, which provides a distribution system for PHP packages, and is shipped with every release of PHP since version 4.3.0.

The PEAR channel (`pear.phpunit.de`) that is used to distribute PHP_Timer needs to be registered with the local PEAR environment:

    sb@ubuntu ~ % pear channel-discover pear.phpunit.de
    Adding Channel "pear.phpunit.de" succeeded
    Discovery of channel "pear.phpunit.de" succeeded

This has to be done only once. Now the PEAR Installer can be used to install packages from the PHPUnit channel:

    sb@vmware ~ % pear install phpunit/PHP_Timer
    downloading PHP_Timer-1.0.0.tgz ...
    Starting to download PHP_Timer-1.0.0.tgz (2,536 bytes)
    ....done: 2,536 bytes
    install ok: channel://pear.phpunit.de/PHP_Timer-1.0.0

After the installation you can find the PHP_Timer source files inside your local PEAR directory; the path is usually `/usr/lib/php/PHP`.
