/**
 * @param {string} templatePath The template path for the PHP block
 * @param {Element} container
 * @param {string} blockClass   The FQN of a custom PHP block class
 */
function loadTemplate(templatePath, container, blockClass)
{
    container.classList.add('ajax-container');
    var loading = false;
    load();
    scrollHandler.doOnScroll(function () {
        load();
    });

    function load() {
        if (utils.isInView(container, true) && !loading) {
            loading = true;
            var data = {
                'action': 'load_template',
                'templatePath': templatePath,
                'blockClass': blockClass
            };
            jQuery.post(ajaxData.ajaxUrl, data)
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
