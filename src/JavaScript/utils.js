var utils = {
    /**
     * @public
     * @param callback
     * @param wait
     * @returns {Function}
     */
    throttle: function (callback, wait) {
      var time = Date.now();
      return function() {
          if ((time + wait - Date.now()) < 0) {
              callback();
              time = Date.now();
          }
      }
    },

    /**
     * @public
     * @param {Element|Node} element
     * @param {boolean} almost – use to detect elements a half screen in advance
     * @returns {boolean}
     */
    isInView: function(element, almost) {
        var rect = element.getBoundingClientRect();
        const windowHeight = (window.innerHeight || document.documentElement.clientHeight);
        const windowWidth = (window.innerWidth || document.documentElement.clientWidth);
        var comparison = 0;
        if (almost) {
            comparison = - (windowHeight / 2);
        }
        const vertInView = (rect.top <= windowHeight) && ((rect.top + rect.height) >= comparison);
        const horInView = (rect.left <= windowWidth) && ((rect.left + rect.width) >= comparison);

        return (vertInView && horInView);
    }
};