var scrollHandler = {
    /**
     * @public
     * @param {Function} callback
     * @param {int} timeout
     */
    doOnScroll: function(callback, timeout) {
        if (!timeout) {
            timeout = 100;
        }
        var frameCallback = function() { window.requestAnimationFrame(callback)};
        if (timeout > 0) {
            window.addEventListener('scroll', utils.throttle(callback, timeout));
        } else {
            window.addEventListener('scroll', frameCallback);
        }
    }
};



