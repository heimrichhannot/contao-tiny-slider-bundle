# Tiny slider bundle

Tiny slider, a vanilla javascript content slider for contao based on [tiny-slider](https://github.com/ganlanyuan/tiny-slider).

**Support only provided for webpack-encore projects using  [heimrichhannot/contao-encore-bundle](https://github.com/heimrichhannot/contao-encore-bundle)!**

## Installation

- Setup your encore project environment, see: https://github.com/heimrichhannot/contao-encore-bundle/blob/master/README.md
- Install via composer: `composer require heimrichhannot/contao-tiny-slider-bundle` and update your database.
- Add active entry for `contao-tiny-slider-bundle` within your root page for example.
- Add active entry for `contao-tiny-slider-bundle-theme` within your root page for example for default slider animations.

## Custom transition effects

In order to use custom transitions for example using [animate.css](https://daneden.github.io/animate.css/) choose from the following effects.

### Fade effect

- import animate.css stylesheet
- set tiny slider config parameter `Mode` to `gallery`
- set tiny slider config parameter `Intro animation` to 'fadeIn'
- set tiny slider config parameter`Outro animation` to 'fadeOut'
- empty tiny slider config parameter `Normal animation`
