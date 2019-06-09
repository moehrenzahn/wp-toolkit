document.addEventListener("DOMContentLoaded", function() {
    configDepends.dependentSections = document.querySelectorAll(
        '.config-section[data-depends]'
    );
    configDepends.dependentInputs = document.querySelectorAll(
        'input[data-depends],' +
        'a[data-depends],' +
        'textarea[data-depends],' +
        'select[data-depends]'
    );

    configDepends.handleInputChanges();
});

configDepends = {
    /**
     * @property {NodeList} dependentSections
     */
    dependentSections: {},

    /**
     * @property {NodeList} dependentInputs
     */
    dependentInputs: {},

    handleValueChange: function (target) {
        this.dependentSections.forEach(function (element) {
            if (this.dependentBelongsToDependency(element, target.id)) {
                if (this.hasValue(target)) {
                    element.previousElementSibling.style.display = '';
                    element.style.display = '';
                    element.nextElementSibling.style.display = '';
                } else {
                    element.previousElementSibling.style.display = 'none';
                    element.style.display = 'none';
                    element.nextElementSibling.style.display = 'none';
                }
            }
        }.bind(this));
        this.dependentInputs.forEach(function (element) {
            if (this.dependentBelongsToDependency(element, target.id)) {
                if (this.hasValue(target)) {
                    element.closest('tr').style.display = '';
                } else {
                    element.closest('tr').style.display = 'none';
                }
            }
        }.bind(this));
    },

    handleInputChanges: function () {
        this.collectDependencies().forEach(function (element) {
            this.handleValueChange(element);
            element.addEventListener('input', function (event) {
                this.handleValueChange(event.target);
            }.bind(this));
        }.bind(this));
    },

    /**
     * @returns {Element[]}
     */
    collectDependencies: function() {
        var dependencies = [];
        this.mergeNodeLists(this.dependentInputs, this.dependentSections).forEach(function (element) {
            if (element.dataset.depends) {
                element.dataset.depends.split(";").forEach(function (id) {
                    dependencies.push(document.querySelector('#'+id));
                })
            }
        });

        return dependencies;
    },

    /**
     * @param {HTMLElement} element
     * @returns boolean
     */
    hasValue: function (element) {
        if (element.type === 'checkbox' || element.type === 'radio') {
            return !!element.checked;
        } else {
            return !!element.value;
        }
    },

    /**
     *
     * @param {HTMLElement} dependentElement
     * @param {string} dependencyId
     * @returns {boolean}
     */
    dependentBelongsToDependency: function (dependentElement, dependencyId) {
        return dependentElement.dataset.depends.split(";").indexOf(dependencyId) !== -1;
    },

    /**
     *
     * @param {NodeList} a
     * @param {NodeList} b
     * @returns {HTMLElement[]}
     */
    mergeNodeLists: function (a, b) {
        var slice = Array.prototype.slice;
        return slice.call(a).concat(slice.call(b));
    }
};