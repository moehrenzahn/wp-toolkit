/**
 * @param {string} templatePath The template path for the PHP view
 * @param {Element} container
 * @param {string} viewClass   The FQN of a custom PHP view class
 * @param {int} postId
 */
function loadTemplate(templatePath, container, viewClass, postId)
{
    var loading = false;
    container.classList.add('ajax-container');
    load();
    scrollHandler.doOnScroll(function () {
        load();
    });

    function load() {
        /**
         * Grab request data from global object set via wp_localize_script.
         */
        var requestData = ToolkitTemplateAjaxData;
        if (utils.isInView(container, true) && !loading) {
            loading = true;
            var data = {
                'action': 'load_template',
                'templatePath': templatePath,
                'viewClass': viewClass,
                'postId': postId,
            };
            jQuery.post(requestData.ajaxUrl, data)
                .done(function (response) {
                    container.innerHTML = response;
                })
                .error(function () {
                    console.error('Template Ajax request failed.');
                    loading = false;
                })
        }
    }
}
