# Tiny slider bundle

Tiny slider, a vanilla javascript content slider for contao based on [tiny-slider](https://github.com/ganlanyuan/tiny-slider).

**Support only provided for webpack-encore projects using  [heimrichhannot/contao-encore-bundle](https://github.com/heimrichhannot/contao-encore-bundle)!**

## Installation

- Setup your encore project environment, see: https://github.com/heimrichhannot/contao-encore-bundle/blob/master/README.md
- Install via composer: `composer require heimrichhannot/contao-tiny-slider-bundle` and update your database.
- Add active entry for `contao-tiny-slider-bundle` within your root page for example.
- Add active entry for `contao-tiny-slider-bundle-theme` within your root page for example for default slider animations.

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

## Known Issues

### Lazyload

If you use tiny-slider together with `https://github.com/heimrichhannot/contao-speed-bundle` and its lazyload compoment enabled in page layout, ensure that you enabled `Lazy load` in tiny slider configuration as well and keep the `Lazy load selector` default value to `.tns-lazy-img`.

If you use the TwigExtension `image` that you must provide proper lazyload information in `data` attributes:

```
{{ singleSRC|image([240,120,'px'],{lazyload: {class: 'tns-lazy-img', src: 'data-src'} }}
```

