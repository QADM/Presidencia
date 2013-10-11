(function($){

    var grid = {
        options: {
            url: "",
            height: "auto",        // de 150 para auto
            page: 1,
            rowNum: 5,             // de 20 para 5
            rowTotal : null,
            records: 0,
            pager: "",
            pgbuttons: true,
            pginput: true,
            colModel: [],
            rowList: [5,10,20,50],  // de [] para [5,10,20,50]
            colNames: [],
            sortorder: "asc",
            sortname: "",
            datatype: "json",       // de xml para json
            mtype: "POST",          // de GET para POST
            altRows: false,
            selarrrow: [],
            savedRow: [],
            shrinkToFit: true,    // de true para false --permite que se tomen las columnas del tamaño exacto
            xmlReader: {},
            jsonReader: {},
            subGrid: false,
            subGridModel :[],
            reccount: 0,
            lastpage: 0,
            lastsort: 0,
            selrow: null,

            // EVENTOS
            beforeSelectRow: null,
            onSelectRow: null,
            onSortCol: null,
            ondblClickRow: null,
            onRightClickRow: null,
            onPaging: null,
            onSelectAll: null,
            loadComplete: null,
            gridComplete: null,
            loadError: null,
            loadBeforeSend: null,
            afterInsertRow: null,
            beforeRequest: null,
            onHeaderClick: null,
            viewrecords: true,     // de false para true
            loadonce: false,

            // UTILIDADES
            multiselect: false,
            multikey: false,
            editurl: null,
            search: false,
            caption: "",
            hidegrid: true,
            hiddengrid: false,
            postData: {},
            userData: {},
            treeGrid : false,
            treeGridModel : 'nested',
            treeReader : {},
            treeANode : -1,
            ExpandColumn: null,
            tree_root_level : 0,
            prmNames: {
                page:"page",
                rows:"rows",
                sort: "sidx",
                order: "sord",
                search:"_search",
                nd:"nd",
                id:"id",
                oper:"oper",
                editoper:"edit",
                addoper:"add",
                deloper:"del",
                subgridid:"id",
                npage: null,
                totalrows:"totalrows"
            },
            forceFit : false,
            gridstate : "visible",
            cellEdit: false,
            cellsubmit: "remote",
            nv:0,
            loadui: "enable",
            toolbar: [false,""],
            scroll: false,
            multiboxonly : false,
            deselectAfterSort : true,
            scrollrows : false,
            autowidth: true,         // de false para true
            scrollOffset :18,
            cellLayout: 5,
            subGridWidth: 20,
            multiselectWidth: 20,
            gridview: false,
            rownumWidth: 25,
            rownumbers : false,      // de false para true
            pagerpos: 'center',
            recordpos: 'right',
            footerrow : false,
            userDataOnFooter : false,
            hoverrows : true,
            altclass : 'ui-priority-secondary',
            viewsortcols : [false,'vertical',true],
            resizeclass : '',
            autoencode : false,
            remapColumns : [],
            ajaxGridOptions :{},
            direction : "ltr",
            toppager: false,
            headertitles: false,
            scrollTimeout: 40,
            data : [],
            _index : {},
            grouping : false,
            groupingView : {
                groupField:[],
                groupOrder:[],
                groupText:[],
                groupColumnShow:[],
                groupSummary:[],
                showSummaryOnHide: false,
                sortitems:[],
                sortnames:[],
                groupDataSorted : false,
                summary:[],
                summaryval:[],
                plusicon: 'ui-icon-circlesmall-plus',
                minusicon: 'ui-icon-circlesmall-minus'
            },
            ignoreCase : false,
            cmTemplate : {}
        },

        _init: function(){
//            console.log(this.options);
            $(this.element).jqGrid(this.options);

//            $('#lui_' + this.element[0].id).css('width',$('#lui_' + this.element[0].id).parent().width() + 'px');
//            $('#lui_' + this.element[0].id).css('height',$('#lui_' + this.element[0].id).parent().height() + 'px');
        },
        destroy: function() {
           $.widget.prototype.destroy.apply(this, arguments); // call default destroy
        }

    };
    $.widget('app.grid', grid);

})(jQuery);