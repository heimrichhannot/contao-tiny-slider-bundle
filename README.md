# Tiny slider bundle

A slider bundle for contao based on [Tiny Slider](https://github.com/ganlanyuan/tiny-slider).

## Features
* global configuration
* content elements for image and content sliders
* [Encore Bundle](https://github.com/heimrichhannot/contao-encore-bundle) support
* show [List Bundle](https://github.com/heimrichhannot/contao-list-bundle) list as slider
* bundled config element type for [List Bundle](https://github.com/heimrichhannot/contao-list-bundle) and [Reader Bundle](https://github.com/heimrichhannot/contao-reader-bundle)

## Usage

### Install
1. install bundle with composer or contao manager

    ```
    composer require heimrichhannot/contao-tiny-slider-bundle
    ```
1. Call contao install tool and update the database

### Setup
1. Create a tiny slider config (System -> Tiny-Slider). Please consider the tiny slider documentation for more informations about the different config options.
1. Select the created config in a content element, an reader config element or in an list config after activating "Render as Tiny slider".


### Usage as config element type (list and reader bundle)

This bundle comes with an [config element type](https://github.com/heimrichhannot/contao-config-element-type-bundle), already registered for list and reader bundle. 

1. Add 'Slider (Tiny Slider)' as list or reader config element to your configuration
1. your defined template variable has two keys, html and images. html contains the complete slider, images just the prepared images if you want to define your own wrapper. So your typical template code to output a slider would be:

```twig
{% if tinySlider.html is defined %}
    {{ tinySlider.html }}
{% endif %}
```


## Twig usage

Tiny slider comes with an `tiny_slider_wrapper.html.twig` that can be embedded inside your custom twig template like the following:

```
{% set tinySliderConfigId = 1 %}
{% embed '@ContaoTinySlider/tiny_slider_wrapper.html.twig' with {config: tinySliderConfigId, selector: '.list-images', wrapperClass: 'overflow-hidden'} %}
    {% block slides %}
        <div class="image-container" {{ aos.default() }}>
        <ul class="list-images list-unstyled">
            {% for i, singleSRC in multiSRC %}
                <li class="image">
                    {{ singleSRC|image([240,180,'px'],{href : url, lazyload: {class: 'tns-lazy-img', src: 'data-src'}})|raw }}
                </li>
            {% endfor %}
        </ul>
        </div>
    {% endblock %}
{% endembed %}
```

There are also two twig extension available:

**tiny_slider_wrapper_class**

Returns the tiny slider wrapper css classes.

```
{% set tinySliderConfigId = 1 %}
{{ tinySliderConfigId|tiny_slider_wrapper_class}}
```

**tiny_slider_container_attributes**

Returns the tiny slider `data-tiny-slider-config` attribute for the container inside the wrapper. The parameter `selector` is optional and should point to the slides wrapper container. 

```
{% set tinySliderConfigId = 1 %}
{{ config|tiny_slider_container_attributes(selector|default('.tiny-slider-container'))|raw }}
```

## Custom transition effects

In order to use custom transitions for example using [animate.css](https://daneden.github.io/animate.css/) choose from the following effects.

### Fade effect

- import animate.css stylesheet
- set tiny slider config parameter `Mode` to `gallery`
- set tiny slider config parameter `Intro animation` to 'fadeIn'
- set tiny slider config parameter`Outro animation` to 'fadeOut'
- empty tiny slider config parameter `Normal animation`


## Assets

### NPM/Yarn Package

The assets for this bundle are provided as NPM/Yarn package `@hundh/contao-tiny-slider-bundle`. 

[![npm version](https://badge.fury.io/js/%40hundh%2Fcontao-tiny-slider-bundle.svg)](https://badge.fury.io/js/%40hundh%2Fcontao-tiny-slider-bundle)

You will find the sources under [src/Resources/npm-package](src/Resources/npm-package).

## Known Issues

### Lazyload

If you use tiny-slider together with `https://github.com/heimrichhannot/contao-speed-bundle` and its lazyload compoment enabled in page layout, ensure that you enabled `Lazy load` in tiny slider configuration as well and keep the `Lazy load selector` default value to `.tns-lazy-img`.

If you use the TwigExtension `image` that you must provide proper lazyload information in `data` attributes:

```
{{ singleSRC|image([240,120,'px'],{lazyload: {class: 'tns-lazy-img', src: 'data-src'} }}
```
