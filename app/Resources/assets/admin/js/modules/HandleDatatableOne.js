var datatable = require('datatables');

import { Flash } from './Flash';
import { HandleModal } from './HandleModal';

class HandleDatatableOne
{
    /**
     * HandleDatatableOn.
     *
     * @param  {element} element
     * @return {void}
     */
    constructor(element)
    {
        this.element = element;
        this.table = this.element.find('[data-table]');

        this.attacheDatatable();
        this.injectBtns();
        this.handleFilter();
    }

    showLoading()
    {
        this.element.find('.dataTables_processing').show();
    }

    attacheDatatable()
    {
        var that = this;

        this.table.dataTable({
            'dom': '<"row data-table-toolbar"<"col-sm-3"lr><"col-sm-9 btns-injection"f>><"row"<"col-sm-12"t>><"row data-table-toolbar"<"col-sm-5"ir><"col-sm-7"p>>',
            'processing': true,
            'serverSide': true,
            'stateSave': true,
            'responsive': true,
            'pagingType': 'full',
            'order': [],
            'lengthMenu': [ 10, 25, 50, 75, 100 ],
            'ajax': this.table.data('table'),
            'columns': $.parseJSON(this.table.next().html()),
            'language': that.getTranslation($('html').attr('lang'))
        });

        this.table.on('draw.dt', function () {
            that.onDatatableDraw();
        });
    }

    onDatatableDraw()
    {
        this.element.find('.dataTables_length select').selectpicker({
            'style': 'btn-primary',
            'size': 'auto',
            'width': '70px',
            'show-tick': false
        });

        this.bindActionBtns();

        new HandleModal(this.element);
    }

    injectBtns()
    {
        var toInject = this.element.find('[data-table-injection]');

        if (0 < toInject.length) {
            var injectIn = $(toInject.data('tableInjection') + '_wrapper');

            if (0 < injectIn.length) {
                injectIn.find('.btns-injection').prepend(toInject);
                toInject.fadeIn();
            }
        }
    }

    handleFilter()
    {
        var that = this;
        var togglefilterBtn = this.element.find('[data-table-filter-btn]');

        if (0 < togglefilterBtn.length) {
            togglefilterBtn.on('click', function (e) {
                e.preventDefault();
                var filter = that.element.find('[data-table-filter]');

                if (filter.is(':visible')) {
                    filter.slideUp();
                } else {
                    filter.slideDown();
                }
            });
        }

        var formFilter = this.element.find('[data-table-filter]');
        var formButtons = formFilter.find('button');

        if (0 < formFilter.length) {
            formFilter.on('submit', function (e) {
                e.preventDefault();

                that.showLoading();

                var form = $(this),
                    clicked = $('button[data-clicked=true]'),
                    datas = form.serialize();

                if ('cancel_filter' == clicked.attr('name')) {
                    datas += '&' + clicked.attr('name');
                    form.clearForm();
                }

                $.ajax(form.attr('action'), {
                    type: 'post',
                    data: datas,
                    success: function (datas) {
                        that.table.dataTable().api().draw();
                    }
                });
            });

            formButtons.on('click', function() {
                formButtons.removeAttr('data-clicked');
                $(this).attr('data-clicked', true);
            });
        }
    }

    bindActionBtns()
    {
        var that = this, btns = this.element.find('[data-table-btn-ajax]');

        btns.on('click', function (e) {
            e.preventDefault();

            if (undefined !== $(this).attr('data-confirm')) {
                if (!confirm($(this).data('confirm'))) {
                    return false;
                }
            }

            that.showLoading();

            var url = $(this).attr('href'),
                method = $(this).data('method');

            $.ajax(url, {
                type: undefined !== method ? method : 'get',
                success: function (success) {
                    that.table.dataTable().api().draw();
                    new Flash().fire(success, 'success');
                }
            });
        });
    }

    getTranslation(lang)
    {
        var dictionnary = {
            'fr': {
                'processing':     '<i class="fa fa-refresh fa-spin"></i>',
                'search':         'Recherche rapide',
                'lengthMenu':     '_MENU_ <span class="length-menu-txt">&eacute;l&eacute;ments</span>',
                'info':           'Affichage _START_ &agrave; _END_ sur _TOTAL_',
                'infoEmpty':      'Affichage 0 &agrave; 0 sur 0',
                'infoFiltered':   '(filtr&eacute; de _MAX_ au total)',
                'infoPostFix':    '',
                'loadingRecords': '<i class="fa fa-refresh fa-spin"></i>',
                'zeroRecords':    'Aucun &eacute;l&eacute;ment &agrave; afficher',
                'emptyTable':     'Aucune donn&eacute;e disponible dans le tableau',
                'aria': {
                    'sortAscending':  ': activer pour trier la colonne par ordre croissant',
                    'sortDescending': ': activer pour trier la colonne par ordre d&eacute;croissant'
                },
                'paginate': {
                    'first':    '<i class="fa fa-angle-double-left"></i>',
                    'previous': '<i class="fa fa-angle-left"></i>',
                    'next':     '<i class="fa fa-angle-right"></i>',
                    'last':     '<i class="fa fa-angle-double-right"></i>'
                }
            },
            'en': {
                'processing':     '<i class="fa fa-refresh fa-spin"></i>',
                'search':         'Quick search',
                'lengthMenu':     '_MENU_ <span class="length-menu-txt">entries</span>',
                'info':           'Showing _START_ to _END_ of _TOTAL_',
                'infoEmpty':      'Showing 0 to 0 of 0',
                'infoFiltered':   '(filtered from _MAX_ total)',
                'infoPostFix':    '',
                'infoThousands':  ',',
                'loadingRecords': '<i class="fa fa-refresh fa-spin"></i>',
                'zeroRecords':    'No matching records found',
                'emptyTable':     'No data available in table',
                'aria': {
                    'sortAscending':  ': activate to sort column ascending',
                    'sortDescending': ': activate to sort column descending'
                },
                'paginate': {
                    'first':    '<i class="fa fa-angle-double-left"></i>',
                    'previous': '<i class="fa fa-angle-left"></i>',
                    'next':     '<i class="fa fa-angle-right"></i>',
                    'last':     '<i class="fa fa-angle-double-right"></i>'
                }
            }
        };

        lang = undefined === lang ? 'en' : undefined === dictionnary[lang] ? 'en' : lang;

        return dictionnary[lang];
    }
}

export { HandleDatatableOne };
