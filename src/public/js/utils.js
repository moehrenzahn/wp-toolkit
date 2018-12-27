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
        var windowHeight = (window.innerHeight || document.documentElement.clientHeight);
        var windowWidth = (window.innerWidth || document.documentElement.clientWidth);
        var comparison = 0;
        if (almost) {
            comparison = - (windowHeight / 2);
        }
        var vertInView = (rect.top <= windowHeight) && ((rect.top + rect.height) >= comparison);
        var horInView = (rect.left <= windowWidth) && ((rect.left + rect.width) >= comparison);

        return (vertInView && horInView);
    }
};