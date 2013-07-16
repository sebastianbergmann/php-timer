# PHP_Timer

Utility class for timing things, factored out of PHPUnit into a stand-alone component.

## Installation

You can use the [PEAR Installer](http://pear.php.net/manual/en/guide.users.commandline.cli.php) or [Composer](http://getcomposer.org/) to download and install this package as well as its dependencies.

### PEAR Installer

The following two commands (which you may have to run as `root`) are all that is required to install this package using the PEAR Installer:

    pear config-set auto_discover 1
    pear install pear.phpunit.de/PHP_Timer

### Composer

To add this package as a local, per-project dependency to your project, simply add a dependency on `phpunit/php-timer` to your project's `composer.json` file. Here is a minimal example of a `composer.json` file that just defines a dependency on PHP_Timer 1.1:

    {
        "require": {
            "phpunit/php-timer": "1.1.*"
        }
    }

### Usage

#### Basic Timing

```php
$timer = new PHP_Timer;

$timer->start();

// ...

$time = $timer->stop();
var_dump($time);

print $timer->secondsToTimeString($time);
```

The code above yields the output below:

    double(1.0967254638672E-5)
    0 ms

#### Resource Consumption Since PHP Startup

```php
$timer = new PHP_Timer;
print $timer->resourceUsage();
```

The code above yields the output below:

    Time: 0 ms, Memory: 0.50Mb
