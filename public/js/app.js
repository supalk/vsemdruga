/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(1);
module.exports = __webpack_require__(2);


/***/ }),
/* 1 */
/***/ (function(module, exports) {

var _typeof = typeof Symbol === "function" && typeof Symbol.iterator === "symbol" ? function (obj) { return typeof obj; } : function (obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; };

(function ($) {
    "use strict";

    $(document).ready(function () {
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        });
        Array.prototype.in_array = function (p_val) {
            for (var i = 0; i < this.length; i++) {
                if (this[i] == p_val) {
                    return true;
                }
            }
            return false;
        };
        String.prototype.isJSON = function () {
            try {
                JSON.parse(this);
            } catch (e) {
                return false;
            }
            return true;
        };
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
        menu: null,
        cache: [],
        init: function init() {
            this.body = $('body');
            this.header.parent = this;
            this.menu = this.body.find('.main_menu');
            this.menu.find('.dropdown').dropdown();
            this.body.find('.is_pu').popup();
            this.header.init();
        },
        header: {
            parent: null,
            body: null,
            init: function init() {
                this.body = $('#top-header');

            }
        },
        send: function send(conf, done) {
            var self = this;
            var options = {
                type: 'POST',
                url: '/',
                data: {},
                headers: {},
                message: {
                    ok: true,
                    error: true
                }
            };
            $.extend(true, options, conf);

            $.ajax({
                type: options.type,
                url: options.url,
                data: options.data,
                crossDomain: true,
                headers: options.headers,
                cache: false,
                dataType: 'json'
            }).done(function (data) {
                //console.log(data);
                if (options.message.ok && typeof data.message != "undefined") {
                    self.notyShow(data.message);
                }
                done(data);
            }).fail(function (xhr) {
                var obj = xhr.responseJSON;
                console.log('send fail', obj);
                if (options.message.error && obj.errors.length > 0) {
                    var msg = '';
                    var tr = '';
                    $.each(obj.errors, function (i, it) {
                        if ($.type(it) != 'object') {
                            msg += tr + '&#07; ' + it;
                        } else if (_typeof(it.message) != undefined) {
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
        notyShow: function notyShow(text) {
            var type = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 'info';
            var conf = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : {};

            var options = {
                layout: 'topRight',
                theme: 'semanticui',
                timeout: '2000',
                progressBar: true,
                closeWith: ['click'],
                killer: true,
                modal: false
            };
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
                modal: options.modal
            }).show();
        },
        datatable: {
            language: {
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
        dropdownLoad: function dropdownLoad(div, params) {
            var $div = $(div);
            var options = {
                api: {
                    method: 'POST',
                    url: null,
                    data: null,
                    paramData: null
                },
                result_data: null,
                value: null,
                thenLoad: null
            };
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
                            var values = [];
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
                            if (typeof options.thenLoad == "function") options.thenLoad(values);
                        });
                    }
                }
            }
        }
    };
})($);

/***/ }),
/* 2 */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ })
/******/ ]);