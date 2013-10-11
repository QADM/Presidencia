(function($){

    var form = {

        options:{
            version: "0.0.1",
            getter: "getStep validateElement validateWizard actionButton",
            defaults: {
                wizard: [],
                wizardAction: {
                    cancel: null,
                    accept: null
                },
                action: null,
                buttonCls: 'button',
                container: 'box_editable',
                overlayid: '',
                loadingid: '',
                dinamico: true,
                debug: false,
                invalidHandler: null,
                rules: {},
                messages: {},
                onsubmit: true,
                focusInvalid: true,
                focusCleanup: false,
                errorClass: 'error',
                errorElement: 'label',
                showErrors: null,
                success: null,
                submit: {
                    iframe :false,
                    data: {},
                    dataType: 'json',
                    semantic: false,
                    timeout: 15000,
                    type: 'POST',
                    resetForm:false,
                    clearForm: true
                }
            }
        },

        _init: function(){
            var self = this;
            self._aditionalMethods();
            self._wizard();
            $(self.element).validate(self.options);
        },

        _aditionalMethods: function(){

            var self = this;

            self.options.submitHandler = self._submitHandler;
            self.addMethod("validPage", self._validPage, $.validator.defaultMessage);
        },

        _invalidHandler: function(form, validator, self){
        //self.reportMessages('error','Errores','Han ocurrido ' + validator.numberOfInvalids() + ' error(es).');
        },

        _submitHandler: function(form) {
            var self = this;
            var o = $.extend({},{
                success: function(responseText, statusText){
                    responseText = $.secureEvalJSON(responseText);
                    if(statusText == "success")
                    {
//                        if(responseText.ident ==  'matrix')
//                        {
//                            $(self.currentForm).form('reportMessages',type, responseText.message, responseText.ident, responseText.url);
//                        }
//                        else
//                        {
                            var type = responseText.success ? 'info' : 'error';
                            $(self.currentForm).form('reportMessages',type,responseText.message,self.settings.action);
//                        }
                    }
                    else
                    {
                        $(self.currentForm).form('reportMessages','error',responseText.message,self.settings.action);
                    }
                },
                error: function(XMLHttpRequest, textStatus, errorThrown){
                    if(textStatus == "timeout")
                        XMLHttpRequest = {
                            responseText: ''
                        };
                    $(self.currentForm).form('reportMessages','error', "Este elemento ya ha sido insertado.");
                }
            },self.settings.submit);
            $(form).ajaxSubmit(o);
        },

        _errorPlacement: function(error, element) {
        },
        
        // -----------------------------------     WIZARD    ---------------------------------------------------------------------

        _wizard: function()
        {
            var self = this;

            if(typeof(self.options.wizard) != "undefined" )
            {
                if(self.options.wizard.length >= 2)
                {
                    var rules = self.options.rules;
                    for( method in rules )
                    {
                        rules[method] = {
                            validPage:rules[method]
                        };
                    }

                    var hide = false;
                    $.each(self.options.wizard, function(i,etapa){
                        if($("#" + etapa).length > 0)
                        {
                            $("#" + etapa).attr('step',i);
                            if(hide)
                            {
                                $("#" + etapa).hide();
                            }
                            hide = true
                            self.addButtons(i);
                        }
                        else
                        {
                            this.reportMessages('error','El elemento ' + etapa + ' no existe');
                        }
                    });
                    $.extend(self.options,{
                        step:0
                    });
                }
            }
        },

        addButtons: function(i)
        {
            var divbuttons = $('<div style="float:right"></div>');
            var steps = this.options.wizard.length;
            var first = (steps - i == steps);
            var last = (steps - i == 1);
            var cancel, acept, prev, next;

            cancel = $('<input  id="cancel_'+i+'" type="button" class="button_wizard">')
            .attr('value', 'Cancelar')
            .appendTo(divbuttons);
            cancel.click(function(e){
                var wizardAction = $(this).parents('form').form('option','wizardAction');
                if($.isFunction(wizardAction.cancel))
                    wizardAction.cancel();
            });
            if(first)
            {
                next = $('<input  id="next_'+i+'" type="button" class="button_wizard">')
                .attr('value', 'Siguiente')
                .appendTo(divbuttons);
                next.click(function(e){
                    var actionButton = $(this).parents('form').form('actionButton','next');
                    $(this).parents('form').form('validateWizard',actionButton);
                });
            }
            else if(last)
            {
                prev = $('<input  id="prev_'+i+'" type="button" class="button_wizard">')
                .attr('value', 'Anterior')
                .appendTo(divbuttons);
                prev.click(function(e){
                    var actionButton = $(this).parents('form').form('actionButton','prev');
                    $(this).parents('form').form('backWizard',actionButton);
                });
                
                acept = $('<input  id="acept_'+i+'" type="submit" class="button_wizard">')
                .attr('value', 'Aceptar')
                .appendTo(divbuttons);
                acept.click(function(e){
                    var wizardAction = $(this).parents('form').form('option','wizardAction');
                    $(this).parents('form').form('validateWizard', wizardAction.accept);
                });
            }
            else if(!first && !last)
            {
                prev = $('<input  id="prev_'+i+'" type="button" class="button_wizard">')
                .attr('value', 'Anterior')
                .appendTo(divbuttons);
                prev.click(function(e){
                    var actionButton = $(this).parents('form').form('actionButton','prev');
                    $(this).parents('form').form('backWizard',actionButton);
                });

                next = $('<input  id="next_'+i+'" type="button" class="button_wizard">')
                .attr('value', 'Siguiente')
                .appendTo(divbuttons);
                next.click(function(e){
                    var actionButton = $(this).parents('form').form('actionButton','next');
                    $(this).parents('form').form('validateWizard',actionButton);
                });
            }
            divbuttons.appendTo($("#"+this.options.wizard[i]));
        },

        actionButton: function(type){
            var wizardAction = this.options.wizardAction;
            var step = this.options.step;
            var wizard = this.options.wizard;

            if(wizardAction[wizard[step]] && wizardAction[wizard[step]][type] && $.isFunction(wizardAction[wizard[step]][type]))
                return wizardAction[wizard[step]][type];
            return function(){};
        },

        validateWizard: function(fn)
        {
            var self = this;
            var s = self.options.step;
            var form = $(self.element);

            $.validator.setDefaults(self.options);

            if( $(form).validate().form() )
            {
                if(fn && $.isFunction(fn))
                    fn();

                if(s == self.options.wizard.length - 1)
                {
                    $("#"+self.options.wizard[s]).hide();
                    $("#"+self.options.wizard[0]).show();
                    self.options.step = 0;
                }
                else
                {
                    $("#"+self.options.wizard[s]).hide();
                    $("#"+self.options.wizard[s+1]).show();
                    self.options.step++;
                }
                return true;
            }
            return false;
        },

        backWizard: function(fn)
        {
            var self = this;
            var step_ = self.options.step;



            if(step_ >= 0)
            {
                $("#"+self.options.wizard[ step_ ]).hide();
                $("#"+self.options.wizard[ step_ -1 ]).show();
                self.options.step--;
                if(fn)
                    fn();
            }
        },

        //   ------------------------------------------   EXTRAS   --------------------------------------------------------------

        _validPage: function(value,element,param){

            var steps = this.settings.wizard;
            var _step = $(this.currentForm).form("getStep");

            function macth(index)
            {
                if($(element).parents("#"+steps[index]).length)
                    return _step == $("#"+steps[index]).attr("step");
                return false;
            }
            for(var index = 0; index < steps.length; index++)
                if(macth(index))
                {
                    this.settings.rules[element.name] = param;
                    this.check(element);
                    delete this.settings.rules[element.name];
                    this.settings.rules[element.name] = {
                        validPage:param
                    };
                }
            return "dependency-mismatch";
        },

        validateElement: function(e){
            return $(this.element).validate().element(e);
        },

        reportMessages: function(type, message, callback, extra){

//            if(callback == 'matrix')
//                type = 'matrix';
            switch(type)
            {
//                case 'matrix':
//                    $.app.messages.error(message, function(){window.location = base_url+extra;});
//                    break;
                case 'info':
                    $.app.messages.info(message, callback);
                    break;
                case 'error':
                    $.app.messages.error(message, callback);
                    break;
            }
        },

        addMethod: function(name, func, mess){

            $.validator.addMethod(name, func, mess);
        },

        getStep: function()
        {
            var self = this;
            return self.options.step;
        }
    };

    $.widget('app.form', form);

})(jQuery);

