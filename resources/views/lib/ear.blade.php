@extends('layouts.app')
@section('htmlheader_title')
    Справочник типов ушей
@endsection
@section('style')
    <style>
        .grid.my {
            margin: 0 !important;
        }

        .pnl_button {
            position: absolute;
            left: 20px;
            top: 15px;
            z-index: 5;
        }

        .tab {
            position: relative;
        }

        .lbl_page_name {
            font-size: 16px;
            text-align: center;
            font-weight: bold;
            margin-bottom: 10px;
        }
    </style>
@endsection
@section('content')
    <div class="page-lib">
        <div class="ui center aligned blue header">Справочник типов ушей</div>
        <div class="ui bottom attached active tab" data-tab="list">

            <div class="pnl_button">
                <div data-content="Изменить"
                     class="ui disabled green icon right button is_pu btn_edit">
                    <i class="icon edit"></i>
                </div>
                <div data-content="Добавить"
                     class="ui blue icon right button is_pu btn_add">
                    <i class="icon plus"></i>
                </div>
            </div>
            <table style="width:100%" class="ui celled striped structured unstackable table tbl_lib">
                <thead>
                <tr style="text-align: center">
                    <th>ID</th>
                    <th>Наименование</th>
                    <th>Дата создания</th>
                    <th>Дата обновления</th>
                </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>

        <div class="ui bottom attached tab" data-tab="edit">
            <div data-content="Назад" class="ui icon is_pu left floated button btn_back">
                <i class="icon blue reply"></i>
            </div>
            <div class="lbl_page_name">Добавление</div>
            <br>
            <form class="ui form frm-add" onsubmit="return false;" method="post">
                <input type="hidden" name="id">
                <div class="ui inline required field">
                    <label for="name">Наименование</label>
                    <input style="width:calc(100% - 100px)" id="name" name="eartype_name" type="text" class="inp_change">
                </div>
                <div style="text-align: center" class="center aligned field">
                    <div class="ui green icon labeled button btn_save"><i class="icon save"></i>Сохранить
                    </div>
                </div>

            </form>
        </div>

    </div>
@endsection

@section('script')

    <link href="/assets/datatables/css/dataTables.semanticui.css" rel="stylesheet">
    <script type="text/javascript" src="/assets/datatables/datatables.js"></script>
    <script type="text/javascript" src="/assets/datatables/js/dataTables.semanticui.js"></script>
    <link href="/assets/datatables/Select-1.2.6/css/select.dataTables.css" rel="stylesheet">
    <script type="text/javascript" src="/assets/datatables/Select-1.2.6/js/dataTables.select.js"></script>

    <script>
        $(document).ready(function () {
            page.init();
        });

        let page = {
            body: '.page-lib',
            id: null,
            select_rec: null,
            table: null,
            form: null,
            btn_edit: null,
            btn_add: null,
            btn_save: null,
            init() {
                let self = this;
                self.body = $(self.body);
                self.btn_edit = self.body.find('.btn_edit');
                self.form = self.body.find('.frm-add');
                self.form.form({
                    inline: true,
                    delay: true,
                    fields: {
                        eartype_name: {
                            identifier: 'eartype_name',
                            rules: [{
                                type: 'empty',
                                prompt: '{name} должно быть заполнено'
                            }]
                        }
                    }
                });
                self.btn_add = self.body.find('.btn_add');
                self.btn_save = self.body.find('.btn_save');

                self.table = self.body.find('.tbl_lib').DataTable({
                    pageLength: 20,
                    lengthMenu: [10, 15, 20, 30, 50],
                    // sDom: '<"top"f>rt<"bottom"lp><"clear">',
                    sDom: '<"ui stackable grid my"<"row"<"eight wide column"b><"right aligned eight wide column"f>><"row dt-table"<"sixteen wide column"rt>><"row"<"seven wide column"l><"right aligned nine wide column"p>>>',
                    ajax: {
                        url: "/lib/eartype/get",
                        type: 'POST',
                        data: function (d) {
                            d.type = 'table';
                        },
                        dataSrc: 'data'
                    },
                    order: [1, 'asc'],
                    paging: true,
                    processing: true,
                    columnDefs: [
                        {className: "ta-center", targets: [1]}
                    ],
                    columns: [
                        {
                            data: 'id'
                        },
                        {
                            data: 'name',
                            render: function (data, type, row) {
                                return data;
                            }
                        },
                        {
                            data: 'created_at',

                        },
                        {
                            data: 'updated_at',

                        }
                    ],
                    language: window.app.datatable.language,
                    retrieve: true,
                    serverSide: false,
                    colReorder: true,
                    scrollY: 400,
                    scrollX: true,
                    scrollCollapse: true,
                    select: true,
                    info: false,
                    //pagingType: "ellipses"
                });
                self.table.on('select', function (e, dt, type, indexes) {
                    if (type === 'row') {
                        self.body.find('.btn_edit, .btn_del').removeClass('disabled');
                        self.select_rec = self.table.rows(indexes).data()[0];
                    }
                });
                self.table.on('deselect', function (e, dt, type, indexes) {
                    if (type === 'row') {
                        self.body.find('.btn_edit, .btn_del').addClass('disabled');
                        self.select_rec = null
                    }
                });
                self.btn_add.on('click', function () {
                    page.loadAdd();
                });
                self.btn_edit.on('click', function () {
                    if (self.select_rec) {
                        self.loadEdit(self.select_rec);
                    }
                    window.app.formChange = [];
                });
                self.btn_save.on('click', function () {
                    self.save();
                });
                self.body.find('.btn_back').on('click', function () {
                    $.tab('change tab', 'list');
                });
            },
            loadEdit(rec) {
                let self = this;
                self.form.form('set values', rec);
                self.form.find('.btn_save').html('<i class="icon save"></i>Сохранить')
                    .removeClass('red').addClass('green');
                self.body.find('.lbl_page_name').html("Изменение: "+rec.name);
                $.tab('change tab', 'edit');
            },
            loadAdd() {
                let self = this;
                self.form.form('clear');
                self.form.form('set value', 'kind_id',self.body.find('.sel_kind').dropdown('get value'));
                self.btn_save
                    .html('<i class="icon save"></i>Сохранить')
                    .removeClass('red').addClass('green');
                $.tab('change tab', 'edit');
                self.body.find('.lbl_page_name').html("Добавление")
            },
            save() {
                let self = this;
                let formData = self.form.form('get values');
                 if (!self.form.form('validate form')) return;
                window.app.send({
                    url: '/lib/eartype/save',
                    data: formData
                }, function (data) {
                    $.tab('change tab', 'list');
                    self.table.ajax.reload();
                });

            },
        }

    </script>
@endsection

