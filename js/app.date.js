(function($){
    
    $.widget('app.date', {
        
        options: {
            dateFormat: 'dd/mm/yy',
            changeMonth: false,
	    changeYear: false
        },

        _init: function()
        {
            $(this.element).datepicker(this.options);
        }

    });
})
(jQuery);