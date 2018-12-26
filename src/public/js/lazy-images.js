var lazyImages = {
    images: Array.prototype.slice.call(document.querySelectorAll('.image-lazy')),

    /**
     * @public
     */
    loadImages: function loadImages() {
        this.images.forEach(function (image) {
            if (this.isLoading(image) && utils.isInView(image, true)) {
                this.loadFull(image);
            }
        }.bind(this));
        scrollHandler.doOnScroll(function () {
            this.images.forEach(function (image) {
                if (this.isLoading(image) && utils.isInView(image, true)) {
                    this.loadFull(image);
                }
            }.bind(this));
        }.bind(this));
    },

    /**
     * Can be used when new image are added to the DOM.
     *
     * @public
     */
    reindexImages: function () {
        this.images = Array.prototype.slice.call(document.querySelectorAll('.image-lazy'));
        this.images.forEach(function (image) {
            if (this.isLoading(image) && utils.isInView(image, true)) {
                this.loadFull(image);
            }
        }.bind(this));
    },

    /**
     * @private
     * @param {Element} image
     */
     loadFull: function(image) {
        var full = image.dataset.full;
        var downloadingImage = new Image();
        downloadingImage.onload = function() {
            image.src = downloadingImage.src;
            image.classList.remove('loading');
        };
        downloadingImage.src = full;
    },

    /**
     * @private
     * @param {Element} image
     * @returns {boolean}
     */
    isLoading: function (image) {
        return image.classList.contains('loading')
    }
};

document.addEventListener("DOMContentLoaded", function() {
    lazyImages.loadImages();
});