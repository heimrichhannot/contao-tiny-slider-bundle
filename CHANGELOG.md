# Changelog
All notable changes to this project will be documented in this file.

## [1.5.2] - 2019-03-19

### Fixed
- multi column editor version 2.1 compatibility and fixed missing configuration language key

## [1.5.1] - 2019-03-19

### Fixed
- multi column editor twig template

## [1.5.0] - 2019-03-19

### Fixed
- version 2 of `heimrichhannot/contao-multi-column-editor-bundle` as dependency

## [1.4.2] - 2019-03-18

### Fixed
- `tns-lazy-img` css class should only have styles when in tiny-slider scope

## [1.4.1] - 2019-03-18

### Changed
- SCSS integration for encore

## [1.4.0] - 2019-03-14

### Changed
- maintain config differences between parent config, and responsive config in mobile first order

## [1.3.0] - 2019-03-12

### Changed
- responsive settings now takes all values from it responsive config values, not only differences between parent config and responsive config

## [1.2.1] - 2019-03-12

### Changed
- optimized webpack config

## [1.2.0] - 2019-03-12

### Changed
- removed encore from dependencies (now also usable without encore)
- modernized js generation process using webpack

### Added
- skipInit option

## [1.1.12] - 2019-03-11

### Fixed
- multi column editor issue

## [1.1.11] - 2019-02-05

### Fixed
- rollback to `tiny-slider` version `2.8.8` as long as `https://github.com/ganlanyuan/tiny-slider/issues/361` is not fixed

## [1.1.10] - 2019-02-05

### Fixed
- config now contains default values again in order to reset params in responsive config properly

## [1.1.9] - 2019-02-05

### Fixed
- config now contains default values in non `default` palettes again in order to reset params in responsive config properly

## [1.1.8] - 2019-02-04

### Fixed
- package.json dependency

## [1.1.7] - 2019-02-04

### Fixed
- empty `tl_tiny_slider_config` palette in production environment

## [1.1.6] - 2019-01-18

### Added
- Translations (cs, pl, ru)

## [1.1.5] - 2018-12-18

### Fixed
- added environment (`prod`, `dev`) to config cache key

## [1.1.4] - 2018-12-14

### Fixed
- call of custom `onInit` callbacks (provide public function name)

## [1.1.3] - 2018-12-05

### Fixed
- caching in production mode, cacheKey should contain $container paramter

## [1.1.2] - 2018-11-14

### Fixed
- `animateNormal` translation
- added `fadeAnimation` howto in README.md

## [1.1.1] - 2018-11-14

### Fixed
- `console.log()` debug messages removed

## [1.1.0] - 2018-11-14

### Added
- config filesystem cache in production mode (clear var/cache if you changed tiny slider config)

### Changed
- config now does only contain non default values

## [1.0.0] - 2018-11-12

### Added
- initial version
