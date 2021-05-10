// noinspection JSUnusedLocalSymbols,JSUnresolvedVariable
(function ($) {
    'use strict';

    /**
     * All of the code for your public-facing JavaScript source
     * should reside in this file.
     *
     * Note: It has been assumed you will write jQuery code here, so the
     * $ function reference has been prepared for usage within the scope
     * of this function.
     *
     * This enables you to define handlers, for when the DOM is ready:
     *
     * $(function() {
     *
     * });
     *
     * When the window is loaded:
     *
     * $( window ).load(function() {
     *
     * });
     *
     * ...and/or other possibilities.
     *
     * Ideally, it is not considered best practise to attach more than a
     * single DOM-ready or window-load handler for a particular page.
     * Although scripts in the WordPress core, Plugins and Themes may be
     * practising this, we should strive to set a better example in our own work.
     */
    $(window).on('load', function () {
        console.log('window loaded');

        (() => {
            const CL = (ele, method = 'add', className = 'team-grid__box__in-active') =>
                ele.classList[method](className);
            const boxEle = document.querySelectorAll('.single__team-grid__box');
            let currentActive;

            const hidePopUp = () => {
                if (!currentActive) return;
                CL(currentActive);
                CL(currentActive, 'remove', 'active__pop-up');
            };

            const handleClickEvent = (e) => {
                if (e.target.closest('.team-grid__box__content-image')) {
                    if (currentActive) hidePopUp();
                    currentActive = e.currentTarget;
                    CL(e.currentTarget, 'remove');
                    CL(e.currentTarget, 'add', 'active__pop-up');
                }
                if (e.target.closest('.close__btn')) hidePopUp();
            };

            boxEle.forEach((ele) => {
                CL(ele);
                ele.addEventListener('click', handleClickEvent);
            });

            document.addEventListener('keydown', (e) => e.key === 'Escape' && hidePopUp());
            document.body,
                addEventListener('click', (e) =>
                    e.target.closest('.single__team-grid__box') ? '' : hidePopUp()
                );
        })()


    });


})(jQuery);
