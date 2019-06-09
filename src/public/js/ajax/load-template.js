/**
 * @param {string} templatePath The template path for the PHP view
 * @param {Element} container
 * @param {string} viewClass   The FQN of a custom PHP view class
 * @param {int} postId
 */
function loadTemplate(templatePath, container, viewClass, postId)
{
    var loading = false;
    var aroundContainer = document.createElement('div');
    container.classList.add('ajax-container-inner');
    container.parentNode.insertBefore(aroundContainer, container);
    aroundContainer.appendChild(container);
    aroundContainer.classList.add('ajax-container');
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
                    container.classList.add('hidden');
                    container.style.position = 'absolute';
                    container.style.width = '100%';
                    container.insertAdjacentHTML('afterend', response);
                    setTimeout(function () {
                        container.remove();
                    }, 3000)
                })
                .error(function () {
                    console.error('Template Ajax request failed.');
                    loading = false;
                })
        }
    }
}
