# Changelog
All notable changes to this project will be documented in this file.

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
