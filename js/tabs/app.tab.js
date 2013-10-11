(function($){
    
    var tab =  {

        options: {
            options:{
                selected: 0
            },
            loadAll: false,
            alwaysload:false
        },

         
        _init: function(){
            
            // variables
            var _self = this;
            var _element = this.element;
            var _options = this.options;

            var loaders  = [];   // tabs cargados
            var postdata = [];   // array de los postdata
            var urls     = [];   // array con las urls

            // creando el ul
            var ul = $('<ul></ul>').attr('id', 'ul_'+ _element.context.id);
            this.element.append(ul);


            // recorriendo los tabs
            $.each(this.options.tabs, function(i,tabs){

                // creo los div y los li correspondientes a cada div con su link
                var div = $('<div></div>').attr('id', 'div_'+ tabs.id);
                var li = $('<li></li>').attr('id', 'li_'+ tabs.id);
                var a  = $('<a>'+tabs.name+'</a>').attr('href', '#div_'+ tabs.id).attr('id', 'a_'+tabs.id);

                // adiciono link al li
                // adiciono -li- al -ul-
                // adiciono el div al element
                li.append(a);
                ul.append(li);
                _element.append(div);

                // guardando todos los postdata siempre que esten definidos
                if(tabs.postdata != undefined){
                    postdata['div_'.concat(tabs.id)] = tabs.postdata;
                }

                // guardando todas las urls
                urls['div_'.concat(tabs.id)] = tabs.url;

                // si se cargan todos los tab al crear el componente
                if(_options.loadAll){
                    
                    // cargar vista con postdata si esta definido
                    var id = 'div_' + tabs.id;
                    if(postdata[id] != undefined )
                    {
                        $.post(tabs.url, {'postdata':postdata[id]}, function(){
                            $('#div_'+ tabs.id).html(response);
                        });
                    }
                    else
                    {
                        $.post(tabs.url, {}, function(){
                            $('#div_'+ tabs.id).html(response);
                        });
                    }

                    // añadir tab como cargado
                    loaders.push('div_' + tabs.id);
                }
                else{
                    // cargando tab especifico al crear el componente, por defecto es 0
                    if(i == _options.options.selected){
                        
                        // cargar vista con postdata si esta definido
                        var id = 'div_' + tabs.id;
                        if(postdata[id] != undefined )
                        {
                            $.post(tabs.url, {'postdata':postdata[id]}, function(response){
                                $('#div_'+ tabs.id).html(response);
                            });
                        }
                        else
                        {
                            $.post(tabs.url, {}, function(response){
                                $('#div_'+ tabs.id).html(response);
                            });
                        }
                        // añadir tab como cargado
                        loaders.push('div_' +tabs.id);
                    }
                }
            });

            // creando el componente con las options definidas            
            $(_element).tabs(_options.options);

            // seleccionando un tab
            $(_element).bind( "tabsselect", function(event, ui) {

                // recargar siempre al seleccionar el tab
                if(_options.alwaysload ){

                    // cargar vista con postdata si esta definido
                    var id = ui.panel.id;
                    if(postdata[id] != undefined )
                    {
                        $.post(urls[id], {'postdata':postdata[id]}, function(response){
                                $('#' + ui.panel.id).html(response);
                        });
                    }
                    else
                    {
                        $.post(urls[id], {}, function(response){
                                $('#' + ui.panel.id).html(response);
                        });
                    }
                       

                    // añadir tab como cargado si no lo esta
                    if(!_self.isloader(loaders, ui.panel.id)){
                        loaders.push(ui.panel.id);
                    }
                }else{

                    // verificando si esta cargado el tab
                    if(!_self.isloader(loaders, ui.panel.id)){

                        // cargar vista con postdata si esta definido
                        var id = ui.panel.id;
                        if(postdata[id] != undefined )
                            {
                                $.post(urls[id], {'postdata':postdata[id]}, function(response){
                                   $('#' + ui.panel.id).html(response);
                                });
                            }
                           
                        else
                        {
                            $.post(urls[id], {}, function(response){
                               $('#' + ui.panel.id).html(response);
                            });
                        }
                           
                        // añadir tab como cargado
                        loaders.push(ui.panel.id);
                    }
                  
                }            
            });
        },

        // verifica si un tab esta cargado
        isloader: function(loaders,elem){
            var flag = false;
            for (var i = 0; i < loaders.length; i++) {
                if(loaders[i] == elem){
                    flag = true;
                    break;
                }
            }
            return flag;
        },

        // destruye el componente
        destroy: function() {
           $.widget.prototype.destroy.apply(this, arguments); // call default destroy
        }
    };
    $.widget('app.tab', tab);
})(jQuery);
