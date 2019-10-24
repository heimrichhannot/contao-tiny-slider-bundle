import {tns} from 'tiny-slider/src/tiny-slider';

window.tns = !window.tns ? tns : window.tns;

class TinySliderBundle {
    constructor(selector, forceInit) {
        document.querySelectorAll(selector).forEach(element => {
            let instance = new TinySliderInstance(element);
            instance.init(forceInit);
        });
    }

    static getSliders() {
        return TinySliderBundle.sliders;
    }
}

class TinySliderInstance {
    constructor(element) {
        this.element = element;
        this.container = this.element.querySelector('.tiny-slider-container');
    }

    init(forceInit) {
        this.config = JSON.parse(this.container.getAttribute('data-tiny-slider-config'));

        let focusElements = this.container.querySelectorAll('button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])');

        if (this.config.hasOwnProperty('skipInit') && (typeof forceInit === 'undefined' || !forceInit)) {
            return;
        }

        this.config.container = this.element.querySelector(this.config.container);

        let onInit = this.config.onInit;

        this.config.onInit = function(e) {
            this.element.classList.add('tiny-slider-initialized');
            this.sliderControls = this.element.querySelector('.tns-controls');

            // accessibility fix, control div should not have an tabindex if nested elements can have focus
            if (this.sliderControls && focusElements.length > 0) {
                this.sliderControls.removeAttribute('tabindex');
            }

            if (onInit) {
                let onInitFunction = new Function(onInit + '()');
                onInitFunction();
            }
        }.bind(this);

        this.slider = window.tns(this.config);

        this.container.addEventListener('keydown', this.keyListener.bind(this), true);

        TinySliderBundle.sliders.push(this.slider);
    }

    keyListener(e) {

        let current = e.target,
            info = this.slider.getInfo();

        if (e.keyCode === 9) {

            // slider without focusable links
            if (e.target === this.sliderControls) {
                this.slider.goTo((e.shiftKey ? 'prev' : 'next'));

                if (e.shiftKey) {
                    // keep focus on slider prev tab
                    info.index > 0 && e.preventDefault();
                } else {
                    // keep focus on slider next tab
                    (info.index + 1 < info.slideCount) && e.preventDefault();
                }

                return;

            }

            // slider with focusable links inside
            while (current.parentNode) {
                if ('undefined' !== typeof current.parentNode.classList && current.parentNode.classList.contains('tns-item')) {
                    this.slider.goTo((e.shiftKey ? 'prev' : 'next'));
                    break;
                }
                current = current.parentNode;
            }
        }
    }

}

TinySliderBundle.sliders = [];

document.addEventListener('DOMContentLoaded', function() {
    new TinySliderBundle('.tiny-slider');
});

window.TinySliderBundle = TinySliderBundle;

export default TinySliderBundle;
