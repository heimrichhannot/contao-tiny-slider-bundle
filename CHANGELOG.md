# Changelog

All notable changes to this project will be documented in this file.

## [1.17.0] - 2021-09-28

- Added: new accessibility enhancement in slider config. Handle tabindex more graciously.
- Changed: control buttons are always tabbable

## [1.16.5] - 2021-07-29

- fixed ContentGallery not to show if element is hidden(start and stop fields)

## [1.16.4] - 2021-06-24

- fixed wrong service call in Gallery ([#6])

## [1.16.3] - 2021-05-28

- added new template block `intro` in `block_tiny_slider.html5`

## [1.16.2] - 2021-05-28

- fixed service definitions

## [1.16.1] - 2021-05-27

- optimized encore handling
- fixed service definitions

## [1.16.0] - 2021-04-16

- passed file model to gallery template

## [1.15.0] - 2020-10-30

- Refactored reader config element type to config element type (#5)
- made config element usable as list config element
- added DcaFieldGenerator

## [1.14.1] - 2020-10-07

- fixed contao 4.9 support for custom templates

## [1.14.0] - 2020-10-01

- fixed overridable fields

## [1.13.0] - 2020-08-13

- added event AfterGalleryGetImagesBodyEvent (used to modify image data before parsing the template)

## [1.12.0] - 2020-04-02

- fixed sortby for reader config element
- fixed php_cs fixer style
- fixed comparisons

## [1.11.0] - 2019-11-19

- added list bundle support (integrated contao-tiny-slider-list-bundle)
- included tiny slider library (instead having a shim repo) (can be unset/overwritten in assets array)
- fixed non-encore support

## [1.10.3] - 2019-11-15

- fixed exception when tiny slider is installed with a fresh contao installation

## [1.10.2] - 2019-11-12

- removed symfony/framework-bundle dependency (#4)
- reader config element now respects configured image
- fixed an semantic error in twig template
- updated readme (#2)

## [1.10.1] - 2019-10-24

- fixed tiny slider initialization

## [1.10.0] - 2019-10-24

- added ReaderConfigElement
- added support automatic entries points inclusion of encore bundle 1.3
- bundle npm-package now within this repository

## [1.9.2] - 2019-06-11

### Fixed

- spread subpalette issue while injecting files

## [1.9.1] - 2019-05-29

### Added

- tns-complete CSS class to default SCSS to fix opacity

## [1.9.0] - 2019-05-08

### Added

- `@ContaoTinySlider/tiny_slider_wrapper.html.twig` template, for better tiny slider `embed` usage inside twig
  templates, see README.md for more information
- TwigExtension `tiny_slider_wrapper_class`, see README.md for more information
- TwigExtension `tiny_slider_container_attributes`, see README.md for more information

## [1.8.1] - 2019-05-08

### Fixed

- missing tl_content palette fields restored

## [1.8.0] - 2019-05-08

### Added

- center option

### Fixed

- some namespaces
- some deprecation warnings
- some translations

## [1.7.1] - 2019-05-08

### Changed

- refactored tiny slider config type names to constants
- enhanced ide autocompletion for config model

## [1.7.0] - 2019-05-02

### Changed

- replaced global constants to class constants of `TinySliderSpreadContainer`
- deprecated global constants

## [1.6.1] - 2019-04-12

### Fixed

- accessibility fix in version 1.6.0 must be triggered after init callback

## [1.6.0] - 2019-04-12

### Added

- accessibility support for sliders without focusable elments inside (tab/shift-tab support added, triggers slider goTo)
- accessibility support for sliders with focusable elments inside (tab/shift-tab support added, triggers slider goTo)

## [1.5.3] - 2019-04-11

### Fixed

- accessibility bug, remove `tabindex="0"` from `tns-controls`
- updated tiny-slider

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

- responsive settings now takes all values from it responsive config values, not only differences between parent config
  and responsive config

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

- rollback to `tiny-slider` version `2.8.8` as long as `https://github.com/ganlanyuan/tiny-slider/issues/361` is not
  fixed

## [1.1.10] - 2019-02-05

### Fixed

- config now contains default values again in order to reset params in responsive config properly

## [1.1.9] - 2019-02-05

### Fixed

- config now contains default values in non `default` palettes again in order to reset params in responsive config
  properly

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

[#6]: https://github.com/heimrichhannot/contao-tiny-slider-bundle/issues/6
