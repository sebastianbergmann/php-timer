# ChangeLog

All notable changes are documented in this file using the [Keep a CHANGELOG](http://keepachangelog.com/) principles.

## [3.1.2] - 2020-04-17

### Changed

* Improved the fix for [#30](https://github.com/sebastianbergmann/php-timer/issues/30) and restored usage of `hrtime()`

## [3.1.1] - 2020-04-17

### Fixed

* [#30](https://github.com/sebastianbergmann/php-timer/issues/30): Resolution of time returned by `Timer::stop()` is different than before (this reverts using `hrtime()` instead of `microtime()`)

## [3.1.0] - 2020-04-17

### Added

* `Timer::secondsToShortTimeString()` as alternative to `Timer::secondsToTimeString()`

### Changed

* `Timer::start()` and `Timer::stop()` now use `hrtime()` (high resolution monotonic timer) instead of `microtime()`
* `Timer::timeSinceStartOfRequest()` now uses `Timer::secondsToShortTimeString()` for time formatting
* Improved formatting of `Timer::secondsToTimeString()` result

## [3.0.0] - 2020-02-07

### Removed

* This component is no longer supported on PHP 7.1 and PHP 7.2

## [2.1.2] - 2019-06-07

### Fixed

* [#21](https://github.com/sebastianbergmann/php-timer/pull/21): Formatting of memory consumption does not work on 32bit systems

## [2.1.1] - 2019-02-20

### Changed

* Improved formatting of memory consumption for `resourceUsage()`

## [2.1.0] - 2019-02-20

### Changed

* Improved formatting of memory consumption for `resourceUsage()`

## [2.0.0] - 2018-02-01

### Changed

* This component now uses namespaces

### Removed

* This component is no longer supported on PHP 5.3, PHP 5.4, PHP 5.5, PHP 5.6, and PHP 7.0

[3.1.2]: https://github.com/sebastianbergmann/diff/compare/3.1.1...3.1.2
[3.1.1]: https://github.com/sebastianbergmann/diff/compare/3.1.0...3.1.1
[3.1.0]: https://github.com/sebastianbergmann/diff/compare/3.0.0...3.1.0
[3.0.0]: https://github.com/sebastianbergmann/diff/compare/2.1.2...3.0.0
[2.1.2]: https://github.com/sebastianbergmann/diff/compare/2.1.1...2.1.2
[2.1.1]: https://github.com/sebastianbergmann/diff/compare/2.1.0...2.1.1
[2.1.0]: https://github.com/sebastianbergmann/diff/compare/2.0.0...2.1.0
[2.0.0]: https://github.com/sebastianbergmann/diff/compare/1.0.9...2.0.0
