/*
 * jQuery UI Multiselect
 *
 * Authors:
 *  Michael Aufreiter (quasipartikel.at)
 *  Yanick Rochon (yanick.rochon[at]gmail[dot]com)
 *
 * Dual licensed under the MIT (MIT-LICENSE.txt)
 * and GPL (GPL-LICENSE.txt) licenses.
 *
 * http://www.quasipartikel.at/multiselect/
 *
 *
 * Depends:
 *	ui.core.js
 *	ui.sortable.js
 *
 * Optional:
 * localization (http://plugins.jquery.com/project/localisation)
 * scrollTo (http://plugins.jquery.com/project/ScrollTo)
 *
 * Todo:
 *  Make batch actions faster
 *  Implement dynamic insertion through remote calls
 */


(function($, undefined) {

    $.widget("ui.multiselect", {

        options: {
            sortable: false,
            searchable: true,
            doubleClickable: true,
            animated: 'fast',
            show: 'slideDown',
            hide: 'slideUp',
            dividerLocation: 0.6,
            nodeComparator: function(node1,node2) {
                var text1 = node1.text(),
                text2 = node2.text();
                return text1 == text2 ? 0 : (text1 < text2 ? -1 : 1);
            }
        },

        _create: function() {
            this.element.hide();
            this.id = this.element.attr("id");
            this.container = $('<div class="ui-multiselect ui-helper-clearfix ui-widget ui-widget-content ui-corner-all" style="width: 417px !important; margin-bottom: 10px !important;"></div>').insertAfter(this.element);

            this.selectedCount = 0; // number of currently selected options
            this.availableCount = this.element.find('option').length;

            //modificado @ylienn
            this.availableContainer = $('<div class="available"></div>').appendTo(this.container);
            this.selectedContainer  = $('<div class="selected"></div>').appendTo(this.container);

            //modificado @ylienn
            this.selectedActions  = $('<div class="actions ui-widget-header ui-helper-clearfix"><input type="text" class="search empty ui-widget-content ui-corner-all"/><span class="count">0 '+$.ui.multiselect.locales.itemsCount+'</span><a href="#" class="remove-all">'+$.ui.multiselect.locales.removeAll+'</a></div>').appendTo(this.selectedContainer);
            this.availableActions = $('<div class="actions ui-widget-header ui-helper-clearfix"><input type="text" class="search empty ui-widget-content ui-corner-all"/><span class="count">0 '+$.ui.multiselect.locales.itemsCount+'</span><a href="#" class="add-all">'+$.ui.multiselect.locales.addAll+'</a></div>').appendTo(this.availableContainer);

            this.selectedList  = $('<ul class="selected connected-list"><li class="ui-helper-hidden-accessible"></li></ul>').bind('selectstart', function(){
                return false;
            }).appendTo(this.selectedContainer);
            this.availableList = $('<ul class="available connected-list"><li class="ui-helper-hidden-accessible"></li></ul>').bind('selectstart', function(){
                return false;
            }).appendTo(this.availableContainer);

            var that = this;

            // modificado
            this.container.width(410);
            this.selectedContainer.width(205);
            this.availableContainer.width(205);

            // modificado
            this.selectedList.height(150);
            this.availableList.height(150);

            if ( !this.options.animated ) {
                this.options.show = 'show';
                this.options.hide = 'hide';
            }

            // init lists
            this._populateLists(this.element.find('option'));

            // make selection sortable
            //            if (this.options.sortable) {
            //                this.selectedList.sortable({
            //                    placeholder: 'ui-state-highlight',
            //                    axis: 'y',
            //                    update: function(event, ui) {
            //                        // apply the new sort order to the original selectbox
            //                        that.selectedList.find('li').each(function() {
            //                            if ($(this).data('optionLink'))
            //                                $(this).data('optionLink').remove().appendTo(that.element);
            //                        });
            //                    },
            //                    receive: function(event, ui) {
            //                        ui.item.data('optionLink').attr('selected', true);
            //                        // increment count
            //                        that.selectedCount += 1;
            //                        that._updateSelectedCount();
            //                        // workaround, because there's no way to reference
            //                        // the new element, see http://dev.jqueryui.com/ticket/4303
            //                        that.selectedList.children('.ui-draggable').each(function() {
            //                            $(this).removeClass('ui-draggable');
            //                            $(this).data('optionLink', ui.item.data('optionLink'));
            //                            $(this).data('idx', ui.item.data('idx'));
            //                            that._applyItemState($(this), true);
            //                        });
            //
            //                        // workaround according to http://dev.jqueryui.com/ticket/4088
            //                        setTimeout(function() {
            //                            ui.item.remove();
            //                        }, 1);
            //                    }
            //                });
            //            }

            // set up livesearch
            if (this.options.searchable) {
                // this._registerSearchEvents(this.availableContainer.find('input.search'));
                // modificado @ylienn
                this._registerSearchEvents(this.availableContainer.find('input.search'),this.availableList);
                this._registerSearchEvents(this.selectedContainer.find('input.search'),this.selectedList);
            } else {
                $('.search').hide();
            }

            // batch actions
            this.container.find(".remove-all").click(function() {
                that._populateLists(that.element.find('option').removeAttr('selected'));
                return false;
            });

            this.container.find(".add-all").click(function() {
                var options = that.element.find('option').not(":selected");
                if (that.availableList.children('li:hidden').length > 1) {
                    that.availableList.children('li').each(function(i) {
                        if ($(this).is(":visible")) $(options[i-1]).attr('selected', 'selected');
                    });
                } else {
                    options.attr('selected', 'selected');
                }
                that._populateLists(that.element.find('option'));
                return false;
            });
        },

        destroy: function() {
            this.element.show();
            this.container.remove();
            $.Widget.prototype.destroy.apply(this, arguments);
        },

        _populateLists: function(options) {
            // modificado @ylienn
            this.selectedList.children('.ui-element').remove();
            this.availableList.children('.ui-element').remove();

            // modificado @ylienn
            this.selectedCount = 0;
            this.availableCount = options.length;

            var that = this;
            var items = $(options.map(function(i) {
                // contruyen los li por cada option
                var item = that._getOptionNode(this).appendTo(this.selected ? that.selectedList : that.availableList).show();
                //add @ylienn
                if (this.selected)
                {
                    that.selectedCount += 1;
                    that.availableCount -= 1;
                }
                // aplicar estado al item
                that._applyItemState(item, this.selected);
                item.data('idx', i);
                return item[0];
            }));
            // modificado @ylienn
            this._updateSelectedCount();
            this._updateAvailableCount();
        },

        // modificado @ylienn
        _updateSelectedCount: function(count) {
            if(count == undefined)
                count = this.selectedCount;
            this.selectedContainer.find('span.count').text(count+ "seleccionados");
            if(count==0)
                $('#cantidad_seleccionados_multiselect').val('');
            else
                $('#cantidad_seleccionados_multiselect').val(count);
        },

        // add @ylienn
        _updateAvailableCount: function(count){
            if(count == undefined)
                count = this.availableCount;
            this.availableContainer.find('span.count').text(count+ "seleccionados");
        },

        // construyen los li dado el option
        _getOptionNode: function(option) {
            option = $(option);
            var node = $('<li class="ui-state-default ui-element" title="'+option.text()+'">'+option.text()+'<a href="#" class="action"><span class="ui-corner-all ui-icon"/></a></li>').hide();
            node.data('optionLink', option);
            return node;
        },

        // clones an item with associated data
        // didn't find a smarter away around this
        _cloneWithData: function(clonee) {
            var clone = clonee.clone(false,false);
            clone.data('optionLink', clonee.data('optionLink'));
            clone.data('idx', clonee.data('idx'));
            return clone;
        },

        _setSelected: function(item, selected) {
            item.data('optionLink').attr('selected', selected);

            if (selected) {
                var selectedItem = this._cloneWithData(item);
                item[this.options.hide](this.options.animated, function() {
                    $(this).remove();
                });
                selectedItem.appendTo(this.selectedList).hide()[this.options.show](this.options.animated);

                this._applyItemState(selectedItem, true);
                return selectedItem;
            } else {

                // look for successor based on initial option index
                var items = this.availableList.find('li'), comparator = this.options.nodeComparator;
                var succ = null, i = item.data('idx'), direction = comparator(item, $(items[i]));

                // TODO: test needed for dynamic list populating
                if ( direction ) {
                    while (i>=0 && i<items.length) {
                        direction > 0 ? i++ : i--;
                        if ( direction != comparator(item, $(items[i])) ) {
                            // going up, go back one item down, otherwise leave as is
                            succ = items[direction > 0 ? i : i+1];
                            break;
                        }
                    }
                } else {
                    succ = items[i];
                }

                var availableItem = this._cloneWithData(item);
                succ ? availableItem.insertBefore($(succ)) : availableItem.appendTo(this.availableList);
                item[this.options.hide](this.options.animated, function() {
                    $(this).remove();
                });
                availableItem.hide()[this.options.show](this.options.animated);

                this._applyItemState(availableItem, false);
                return availableItem;
            }
        },

        // aplicar estado al item
        _applyItemState: function(item, selected) {
            if (selected) {
                if (this.options.sortable)
                    // modificado @ylienn
                    //                    item.children('span').addClass('ui-icon-arrowthick-2-n-s').removeClass('ui-helper-hidden').addClass('ui-icon');
                    //                 else
                    item.children('span').removeClass('ui-icon-arrowthick-2-n-s').addClass('ui-helper-hidden').removeClass('ui-icon');
                item.find('a.action span').addClass('ui-icon-minus').removeClass('ui-icon-plus');
                this._registerRemoveEvents(item.find('a.action'));

            } else {
                item.children('span').removeClass('ui-icon-arrowthick-2-n-s').addClass('ui-helper-hidden').removeClass('ui-icon');
                item.find('a.action span').addClass('ui-icon-plus').removeClass('ui-icon-minus');
                this._registerAddEvents(item.find('a.action'));
            }

            this._registerDoubleClickEvents(item);
            this._registerHoverEvents(item);
        },

        // taken from John Resig's liveUpdate script
        _filter: function(list) {
            var input = $(this);
            var rows = list.children('li'),
            cache = rows.map(function(){
                return $(this).text().toLowerCase();
            });
            var term = $.trim(input.val().toLowerCase()), scores = [];
            if (!term) {
                rows.show();
            } else {
                rows.hide();

                cache.each(function(i) {
                    if (this.indexOf(term)>-1) {
                        scores.push(i);
                    }
                });

                $.each(scores, function() {
                    $(rows[this]).show();
                });
            }
            return scores.length;
        },

        _registerDoubleClickEvents: function(elements) {
            if (!this.options.doubleClickable) return;
            elements.dblclick(function() {
                elements.find('a.action').click();
            });
        },

        _registerHoverEvents: function(elements) {
            elements.removeClass('ui-state-hover');
            elements.mouseover(function() {
                $(this).addClass('ui-state-hover');
            });
            elements.mouseout(function() {
                $(this).removeClass('ui-state-hover');
            });
        },

        _registerAddEvents: function(elements) {
            var that = this;
            elements.click(function() {
                var item = that._setSelected($(this).parent(), true);
                // modificado @ylienn
                that.selectedCount += 1;
                that.availableCount -= 1;
                that._updateSelectedCount();
                that._updateAvailableCount();
                return false;
            });

            // make draggable
            if (this.options.sortable) {
                elements.each(function() {
                    $(this).parent().draggable({
                        connectToSortable: that.selectedList,
                        helper: function() {
                            var selectedItem = that._cloneWithData($(this)).width($(this).width() - 50);
                            selectedItem.width($(this).width());
                            return selectedItem;
                        },
                        appendTo: that.container,
                        containment: that.container,
                        revert: 'invalid'
                    });
                });
            }
        },

        _registerRemoveEvents: function(elements) {
            var that = this;
            elements.click(function() {
                that._setSelected($(this).parent(), false);
                // modificado @ylienn
                that.selectedCount -= 1;
                that.availableCount += 1;
                that._updateSelectedCount();
                that._updateAvailableCount();
                return false;
            });
        },

        _registerSearchEvents: function(input, list) {
            var that = this;

            input.focus(function() {
                $(this).addClass('ui-state-active');
            })
            .blur(function() {
                $(this).removeClass('ui-state-active');
            })
            .keypress(function(e) {
                if (e.keyCode == 13)
                    return false;
            })
            .keyup(function() {
                //                that._filter.apply(this, [that.availableList]);
                // modificado @ylienn
                var count = that._filter.apply(this, [list]);
                if(count == 0 && $(input).val() == '')
                    count = ($(list).hasClass('available')) ? that.availableCount : that.selectedCount;
                $(list).hasClass('available') ? that._updateAvailableCount(count) : that._updateSelectedCount(count);
            });
        }
    });

    $.extend($.ui.multiselect, {
        locales: {
            addAll:'A&ntilde;adir todos',
            removeAll:'Remover todos',
            itemsCount:'selecionados'
        }
    });
    
})(jQuery);
