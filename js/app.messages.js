(function($){

    if(typeof ($.app) == "undefined"){
        $.extend($,{
            app:{
                messages:{}
            }
        });
    }

    $.app.messages = {
        height: 105,
        width: 420,

        _create: function(message, title, buttons, type, data){
            this._hide();
            var botones = this._init(message, title, buttons, data);
            this._setIcon(type);
            this._show(botones);
        },

        _init: function(message, title, buttons, data){
            var div_general  = $('<div id="dialog" class="" style="display:none,top:130px !important;" title="'+title+'"></div>');
            var span_icon    = $('<span id="dialog-type-icon"></span>');
            var span_message = $('<span id="dialog-message">'+message+'</span>');
            var div_content  = $('<div id="dialog-content"></div>');

            div_content.append(span_icon);
            div_content.append(span_message);
            div_general.append(div_content);

            $('body').append(div_general);

            var botones = {};
            for(var i=0; i < buttons.length; i++){
                if($.isFunction(buttons[i].callback))
                {
                    var callback =  buttons[i].callback;
                    botones[buttons[i].text] = function()
                    {
                        callback();
                        $.app.messages._hide();
                    }
                }
                else
                {
                    botones[buttons[i].text] = function()
                    {
                        $.app.messages._hide();
                    }
                }
            }
            return botones;
        },

        _show: function(botones){
            $("#dialog").dialog({
                buttons: botones,
                height: this.height+28,
                width: this.width,
                resizable: false,
                draggable: false,
                modal: true,
                close: function() {
                    $.app.messages._hide();
                }
            });

        },

        _hide: function(){
            $("#dialog").remove();
        },

        _setIcon: function(icon){
            $("#dialog-type-icon").addClass('message_icon message_'+icon);
        },


        info: function(message, callbackAccept, data){
            var buttons = [{
                text:   'Aceptar',
                callback: callbackAccept
            }];
            this._create(message, 'INFORMACI&Oacute;N', buttons,'info', data);
        },

        error: function(message, callbackAccept){
            var buttons = [{
                text:   'Aceptar',
                callback: callbackAccept
            }];
            this._create(message, "ERROR", buttons,"error");
        },

        confirm: function(message, callbackAccept,callbackCancel,textOpcion1,textOpcion2){
            var buttons;
            if(textOpcion1 != undefined && textOpcion2 != undefined){
                buttons = [
                {
                    text:   textOpcion1,
                    callback: callbackAccept
                },
                {
                    text:   textOpcion2,
                    callback: callbackCancel
                }];
            }
            else{ // Default...
                buttons = [
                {
                    text:   'Aceptar',
                    callback: callbackAccept
                },
                {
                    text:   'Cancelar',
                    callback: callbackCancel
                }];
            }
            this._create(message, 'CONFIRMACI&Oacute;N', buttons,'confirm');
        },

        warning: function(message, callbackAccept,callbackCancel){
            var buttons = [
            {
                text:   'Aceptar',
                callback: callbackAccept
            },
            {
                text:   'Cancelar',
                callback: callbackCancel
            }];
            this._create(message, 'ADVERTENCIA', buttons,'warning');
        },

        notification: function(message, callbackAccept,callbackCancel){
            var buttons = [
            {
                text:   'Aceptar',
                callback: callbackAccept
            },
            {
                text:   'Cancelar',
                callback: callbackCancel
            }];
            this._create(message, 'NOTIFICACI&Oacute;N', buttons,'warning');

            $("#dialog-message").css({
                height: 'auto'
            });
            $("#dialog-message-content").css({
                height: '100%',
                background:'#FFFFFF',
                'background-image':'-moz-linear-gradient( center bottom, rgb(229,231,243) 14%, rgb(245,246,249) 73%, rgb(253,253,253) 87%)'
            });
        },

        alerta: function(message, callbackAccept){
            var buttons = [
            {
                text:   'Aceptar',
                callback: callbackAccept
            }];
            this._create(message, 'ALERTA', buttons,'warning');

            $("#dialog-message").css({
                height: 'auto'
            });
            $("#dialog-message-content").css({
                height: '100%',
                background:'#FFFFFF',
                'background-image':'-moz-linear-gradient( center bottom, rgb(229,231,243) 14%, rgb(245,246,249) 73%, rgb(253,253,253) 87%)'
            });
        }
    };

    info = function(message, callbackAccept, data)
    {
        $.app.messages.info(message, callbackAccept, data);
    }
    warning = function(message, callbackAccept,callbackCancel)
    {
        $.app.messages.warning(message, callbackAccept,callbackCancel);
    }
    error = function(message, callbackAccept)
    {
        $.app.messages.error(message, callbackAccept);
    }
    confirmation = function(message, callbackAccept,callbackCancel,textOpcion1,textOpcion2)
    {
        $.app.messages.confirm(message, callbackAccept,callbackCancel,textOpcion1,textOpcion2);
    }
    notification = function(message, callbackAccept,callbackCancel)
    {
        $.app.messages.notification(message, callbackAccept,callbackCancel);
    }
    alerta = function(message, callbackAccept,callbackCancel)
    {
        $.app.messages.alerta(message, callbackAccept,callbackCancel);
    }
    
})(jQuery)
