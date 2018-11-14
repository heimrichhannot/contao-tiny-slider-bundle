import {tns} from 'tiny-slider/src/tiny-slider';

require('tiny-slider/src/tiny-slider.scss');

function TinySliderBundle(selector) {
    this.elements = document.querySelectorAll(selector);
    this.sliders = [];

    this.elements.forEach(element => {
        this.init(element);
    });
}

TinySliderBundle.prototype.init = function (element) {
    let container = element.querySelector('.tiny-slider-container'),
        config = JSON.parse(container.getAttribute('data-tiny-slider-config'));

    config.container = element.querySelector(config.container);

    let onInit = config.onInit;

    console.log(element);
    console.log(config);

    config.onInit = function () {
        onInit ? onInit() : null;
    };

    let slider = tns(config);

    element.classList.add('tiny-slider-initialized');

    this.sliders.push(slider);
};

document.addEventListener("DOMContentLoaded", function () {
    new TinySliderBundle('.tiny-slider');
});

