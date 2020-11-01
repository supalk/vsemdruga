
(function ($) {
    "use strict";
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        });
        Array.prototype.in_array = function (p_val) {
            for (var i = 0; i < this.length; i++) {
                if (this[i] == p_val) {
                    return true;
                }
            }
            return false;
        }
        String.prototype.isJSON = function () {
            try {
                JSON.parse(this);
            } catch (e) {
                return false;
            }
            return true;
        }
        $.fn.dropdown.settings.message = {
            // addResult     : 'Add <b>{term}</b>',
            // count         : '{count} selected',
            // maxSelections : 'Max {maxCount} selections',
            noResults: 'Не найдено.'
        };
        window.app.init();
    });

    window.app = {
        body: null,
        cache: [],
        init() {
            this.body = $('body');
            this.header.parent = this;
            this.header.init();
            this.menu = this.body.find('.main_menu');
            this.menu.find('.dropdown').dropdown();
            this.body.find('.is_pu').popup();
        },
        header:{
            parent:null,
            body:null,
            init(){
                this.body = $('#top-header');
                this.body.find('.dropdown').dropdown();
            }
        },
        send(conf, done) {
            let self = this;
            let options = {
                type: 'POST',
                url: '/',
                data: {},
                headers: {},
                message: {
                    ok: true,
                    error: true
                }
            }
            $.extend(true, options, conf);

            $.ajax({
                type: options.type,
                url: options.url,
                data: options.data,
                crossDomain: true,
                headers: options.headers,
                cache: false,
                dataType:'json',
            }).done(function (data) {
                //console.log(data);
                if (options.message.ok && typeof(data.message)!="undefined") {
                    self.notyShow(data.message);
                }
                done(data);
            }).fail(function (xhr) {
                let obj = xhr.responseJSON;
                console.log('send fail', obj);
                if (options.message.error && obj.errors.length > 0) {
                    let msg = ''
                    let tr = '';
                    $.each(obj.errors, function (i, it) {
                        if ($.type(it) != 'object') {
                            msg += tr + '&#07; ' + it;
                        } else if (typeof (it.message) != undefined) {
                            msg += tr + '&#07; ' + it.message;
                        }
                        tr = '<br>';
                    });
                    self.notyShow(msg, 'error', {
                        timeout: false,
                        modal: true,
                        progressBar: false
                    });
                } else {
                    console.log(obj);
                    alert('Ошибка! Обратитесь к Админу!');
                }
            });
        },
        notyShow(text, type = 'info', conf = {}) {
            let options = {
                layout: 'topRight',
                theme: 'semanticui',
                timeout: '2000',
                progressBar: true,
                closeWith: ['click'],
                killer: true,
                modal: false
            }
            $.extend(true, options, conf);
            new Noty({
                type: type,
                layout: options.layout,
                theme: options.theme,
                text: text,
                timeout: options.timeout,
                progressBar: options.progressBar,
                closeWith: options.closeWith,
                killer: options.killer,
                modal: options.modal,
            }).show();
        },
        datatable:{
            language:{
                processing: "Подождите...",
                search: "_INPUT_",
                lengthMenu: "Показать _MENU_ записей",
                info: "Записи с _START_ до _END_ из _TOTAL_ записей",
                infoEmpty: "Записи с 0 до 0 из 0 записей",
                infoFiltered: "(отфильтровано из _MAX_ записей)",
                infoPostFix: "",
                loadingRecords: "Загрузка записей...",
                zeroRecords: "Записи отсутствуют.",
                emptyTable: "В таблице отсутствуют данные",
                paginate: {
                    first: "Первая",
                    previous: "Предыдущая",
                    next: "Следующая",
                    last: "Последняя"
                },
                select: {
                    rows: {
                        _: "Выбрано %d записей",
                        //0: "Кликните чтобы перейти к просмотру",
                        1: "Выбрана 1 запись"
                    }
                },
                aria: {
                    sortAscending: ": активировать для сортировки столбца по возрастанию",
                    sortDescending: ": активировать для сортировки столбца по убыванию"
                }
            }
        },
        setInputToInteger: function(inp) {
            inp.keypress(function (event) {
                if ((event.which != 8 || event.which != 46) && (event.which < 48 || event.which > 57)) {
                    event.preventDefault();
                    return;
                }
                if (typeof $(this).data('max') !== 'undefined'){
                    if (parseInt(''+$(this).val()+event.key)>parseInt($(this).data('max'))) {
                        event.preventDefault();
                        return;
                    }
                }
                if (typeof $(this).data('min') !== 'undefined'){
                    if (parseInt(''+$(this).val()+event.key)<parseInt($(this).data('min'))) {
                        event.preventDefault();
                    }
                }
            });
        },
        setInputToFloat: function(inp) {
            inp.keypress(function (event) {
                if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
                    event.preventDefault();
                    return;
                }
                if (typeof $(this).data('max') !== 'undefined'){
                    if (parseFloat(''+$(this).val()+event.key)>parseFloat($(this).data('max'))) {
                        event.preventDefault();
                        return;
                    }
                }
                if (typeof $(this).data('min') !== 'undefined'){
                    if (parseFloat(''+$(this).val()+event.key)<parseFloat($(this).data('min'))) {
                        event.preventDefault();
                    }
                }
            });
        },
        setInputToNotEdit:function(inp){
            inp.keypress(function (event){
                event.preventDefault();
            });
        },
        dropdownLoad(div, params) {
            let $div = $(div);
            let options = {
                api: {
                    method: 'POST',
                    url: null,
                    data: null,
                    paramData: null
                },
                result_data: null,
                value: null,
                thenLoad: null
            }
            $.extend(true, options, params);
            //console.log('div', $div);
            //console.log('options', options);
            if ($div.length == 1) {
                if (options.result_data) {
                    $div.dropdown('change values', options.result_data);
                    if (options.value) $div.dropdown('set selected', options.value);
                    window.app.formChange = [];
                } else if (options.api.url) {

                    if (options.api.url in window.app.cache) {
                        $div.dropdown('change values', window.app.cache[options.api.url]);
                        if (options.value) {
                            $div.dropdown('set selected', options.value);
                            window.app.formChange = [];
                        }

                    } else {
                        $.ajax({
                            method: options.api.method,
                            url: options.api.url,
                            data: options.api.data
                        }).then(function (data) {
                            let values = [];
                            if (options.api.paramData) {
                                values = data[options.api.paramData];
                            } else {
                                values = data;
                            }
                            //console.log('values',values);
                            window.app.cache[options.api.url] = values;
                            $div.dropdown('change values', values);
                            if (options.value) {
                                $div.dropdown('set selected', options.value);
                                window.app.formChange = [];
                            }
                            if (typeof options.thenLoad == "function")
                                options.thenLoad(values);
                        });
                    }
                }

            }
        },

    }

})($);