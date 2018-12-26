/**
 * @param {string} templatePath
 * @param {Element} container
 */
function loadTemplate(templatePath, container)
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
                'templatePath': templatePath
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
