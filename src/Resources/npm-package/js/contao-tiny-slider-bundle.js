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
        this.displayPageNumber = false;
    }

    init(forceInit) {
        this.config = JSON.parse(this.container.getAttribute('data-tiny-slider-config'));

        let focusElements = this.container.querySelectorAll('button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])');

        if (this.config.hasOwnProperty('skipInit') && this.config.skipInit === true && (typeof forceInit === 'undefined' || !forceInit)) {
            return;
        }

        this.config.container = this.element.querySelector(this.config.container);

        let onInit = this.config.onInit;

        this.config.onInit = function(e) {
            this.element.classList.add('tiny-slider-initialized');
            this.sliderControls = this.element.querySelector('.tns-controls');

            // accessibility fix, control div should not have a tabindex if nested elements can have focus
            if (this.sliderControls && focusElements.length > 0) {
                this.sliderControls.removeAttribute('tabindex');
            }

            // accessibility fix, control div should not have an aria-label
            if (this.sliderControls) {
                this.sliderControls.removeAttribute('aria-label');
            }

            // accessibility fix, controls should be tabbable
            if (this.sliderControls) {
                let controls = this.sliderControls.querySelectorAll('button[data-controls="prev"], button[data-controls="next"]');
                controls.forEach(item => item.setAttribute('tabindex', "0"));
            }

            if (onInit) {
                let onInitFunction = new Function(onInit + '()');
                onInitFunction();
            }
        }.bind(this);

        // Handling responsive config
        if (this.config.responsive) {

            const currentWidth = window.innerWidth;

            let responsiveConfigs = Object.keys(this.config.responsive).filter(width => width <= currentWidth);

            if (responsiveConfigs.length > 0) {

                var closest = responsiveConfigs.reduce(function(prev, curr) {
                    return (Math.abs(curr - currentWidth) < Math.abs(prev - currentWidth) ? curr : prev);
                });

                this.displayPageNumber = this.config.responsive[closest].displayPageNumber;

            } else {

                this.displayPageNumber = this.config.displayPageNumber;

            }

        } else {
            this.displayPageNumber = this.config.displayPageNumber;
        }

        if (this.displayPageNumber) {
            // nav needs to be generated in order to get page number
            this.config.nav = true
        }

        this.slider = tns(this.config);

        if (this.displayPageNumber) {
            this.generateSlideNumber(this.container, this.config.dotAriaLabel);
            this.slider.events.on('transitionEnd', () => {
                this.updateSlideNumber(this.container);
            })
        } else {
            this.modifySliderNav(this.container, this.config)
        }

        if (this.config.enhanceAccessibility) {
            this.handleTabindex(this.container);
        } else {
            this.container.addEventListener('keydown', this.keyListener.bind(this), true);
        }

        if (this.config.nav && this.element.querySelector('.tns-nav')) {
            this.handleTabindex(this.element.querySelector('.tns-nav'));
        }

        /*
        * NOTE: using keydown while focusing
        * on tns-controls(next/prev nav button) sometimes does not
        * work as expected, so the tns events are removed and sliding
        * will be manually triggered instead. Apply only on loop mode.
        * */
        if (this.config.loop) {
            let tnsControls = this.element.querySelectorAll('.tns-controls');

            tnsControls.length > 0 && tnsControls.forEach(control => {
                // clone tns-controls to remove all event listeners
                let clone = control.cloneNode(true);
                let leftButton = clone.querySelector('button[data-controls="prev"]');
                let rightButton = clone.querySelector('button[data-controls="next"]');

                leftButton && leftButton.addEventListener('click', e => this.slider.goTo('prev'))
                rightButton && rightButton.addEventListener('click', e => this.slider.goTo('next'))
                control.replaceWith(clone);
            })

        }

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

    handleTabindex(container) {

        let focusElements = container.querySelectorAll('button, [href], input:not([type="hidden"]), select, textarea, [tabindex]:not([tabindex="-1"])');

        focusElements.forEach(item => item.setAttribute('tabindex', "-1"));
        let activeFocusElements = container.querySelectorAll('.tns-slide-active button, .tns-slide-active [href], .tns-slide-active input:not([type="hidden"]), .tns-slide-active select, .tns-slide-active textarea, button.tns-nav-active');
        activeFocusElements.forEach(item => item.setAttribute('tabindex',0));

        // Set up an observer
        const config = {attributes: true, subtree: true};

        const callback = (mutationList, observer) => {
            for (const mutation of mutationList) {
                if (mutation.type === 'attributes' && mutation.attributeName === 'class') {
                    focusElements.forEach(item => item.setAttribute('tabindex', "-1"));
                    activeFocusElements = container.querySelectorAll('.tns-slide-active button, .tns-slide-active [href], .tns-slide-active input:not([type="hidden"]), .tns-slide-active select, .tns-slide-active textarea, button.tns-nav-active');
                    activeFocusElements.forEach(item => item.setAttribute('tabindex',0));

                }
            }
        }

        const tinySliderObserver = new MutationObserver(callback);
        tinySliderObserver.observe(container, config);

    }

    modifySliderNav(tinySliderContainer, config) {
        const navAriaLabel = config.navAriaLabel || false;
        const dotAriaLabel = config.dotAriaLabel || false;
        const dotCurrentAriaLabel = config.dotCurrentAriaLabel || false;

        let tnsNav = tinySliderContainer.parentNode.parentNode.parentNode.querySelector('.tns-nav');

        if (tnsNav) {

            this.changeTinySliderNavAriaLabels(tnsNav, navAriaLabel, dotAriaLabel, dotCurrentAriaLabel);

            // Set up an observer
            const config = {attributes: true, subtree: true};

            const callback = (mutationList, observer) => {
                for (const mutation of mutationList) {
                    if (mutation.type === 'attributes' && mutation.attributeName === 'class') {
                        dotAriaLabel && mutation.target.setAttribute('aria-label', mutation.target.getAttribute('aria-label').replace('Carousel Page', dotAriaLabel));
                        dotCurrentAriaLabel && mutation.target.setAttribute('aria-label', mutation.target.getAttribute('aria-label').replace('Current Slide', dotCurrentAriaLabel));
                    }
                }
            }

            const tinySliderNavObserver = new MutationObserver(callback);
            tinySliderNavObserver.observe(tnsNav, config);

        }
    }

    changeTinySliderNavAriaLabels(tnsNav, navAriaLabel, dotAriaLabel, dotCurrentAriaLabel) {

        navAriaLabel && tnsNav.setAttribute('aria-label', navAriaLabel);

        tnsNav.setAttribute('role', 'navigation');

        let navItems = tnsNav.querySelectorAll('button');

        navItems.forEach(item => {
            dotAriaLabel && item.setAttribute('aria-label', item.getAttribute('aria-label').replace('Carousel Page', dotAriaLabel));
            dotCurrentAriaLabel && item.setAttribute('aria-label', item.getAttribute('aria-label').replace('Current Slide', dotCurrentAriaLabel));
        })
    }

    // Generate slide number based on dots, dots will be hidden as well
    generateSlideNumber(container, label) {

        let tinySlider = container.parentNode.parentNode.parentNode;

        if (this.slider.getInfo().pages > 1) {
            let wrapper = document.createElement('DIV');
            wrapper.classList.add('tns-slide-number');
            wrapper.insertAdjacentHTML('afterbegin', '<p class="sr-only">' + label + '</p><p class="number"></p>')
            tinySlider.append(wrapper);
        }


        let tnsNav = tinySlider.querySelector('.tns-nav');

        tnsNav.style.display = 'none';

        this.updateSlideNumber(container);

    }

    updateSlideNumber(container) {

        let tinySlider = container.parentNode.parentNode.parentNode;

        const total = this.slider.getInfo().pages;

        const current = this.slider.getInfo().navCurrentIndex;

        if (total > 1) {
            tinySlider.querySelector('.tns-slide-number .number').innerHTML = current + 1 + '/' + total;
        }
    }

}

TinySliderBundle.sliders = [];

document.addEventListener('DOMContentLoaded', function() {
    new TinySliderBundle('.tiny-slider');
});

window.TinySliderBundle = TinySliderBundle;

export default TinySliderBundle;
