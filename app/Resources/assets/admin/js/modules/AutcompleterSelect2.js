require('select2');

class AutcompleterSelect2
{
    constructor(container)
    {
    	this.container = undefined === container ? $('body') : container;

	    this.container.find('[data-select-autocomplete]').select2({
	      width: '100%',
	      allowClear: true,
	      ajax: {
	        data: function (params) {
	          return {
	            q: params.term
	          };
	        },
	        processResults: function (data) {
	          return {
	            results: data
	          };
	        },
	        cache: true
	      }
	    });
    }
}

export { AutcompleterSelect2 };
