@extends('layouts.app')
@section('htmlheader_title')
    Реестр
@endsection
@section('style')
    <style>
        .btn_selfields {
            float: right;
        }

        .td-filter {
            padding: 0 !important;
        }

        .row_filters {
            border-bottom: 1px solid #aeafb1;
        }

        .ch_column {
            display: block !important;
        }


    </style>
@endsection
@section('content')
    <div class="page-catalog">
{{--        <div class="ui center aligned blue header">Реестр</div>--}}
        <div style="height:60px">
        <div data-position="bottom right" class="ui right floated icon button btn_selfields">
            <i class="icon large link tasks" style="color: rgb(74, 144, 226);"></i>
        </div>
        <div data-content="Поля для отображения" class="ui pop_selfields popup bottom right">
            <div class="header">Поля для отображения</div>
            <div class="ui content">

                <div class="ui checkbox ch_column">
                    <input type="checkbox" name="col[]" checked value="0">
                    <label>№ карточки</label>
                </div>
                <div class="ui checkbox ch_column">
                    <input type="checkbox" name="col[]" checked value="1">
                    <label>Дата поступления</label>
                </div>
                <div class="ui checkbox ch_column">
                    <input type="checkbox" name="col[]" checked value="2">
                    <label>Идентификационная метка</label>
                </div>
                <div class="ui checkbox ch_column">
                    <input type="checkbox" name="col[]" checked value="3">
                    <label>Вид животного</label>
                </div>
                <div class="ui checkbox ch_column">
                    <input type="checkbox" name="col[]" checked value="4">
                    <label>Пол</label>
                </div>
                <div class="ui checkbox ch_column">
                    <input type="checkbox" name="col[]" checked value="5">
                    <label>Кличка</label>
                </div>
                <div class="ui checkbox ch_column">
                    <input type="checkbox" name="col[]" checked value="6">
                    <label>Год рождения</label>
                </div>
                <div class="ui checkbox ch_column">
                    <input type="checkbox" name="col[]" checked value="7">
                    <label>Порода</label>
                </div>
                <div class="ui checkbox ch_column">
                    <input type="checkbox" name="col[]" checked value="8">
                    <label>Окрас</label>
                </div>
                <div class="ui row checkbox ch_column">
                    <input type="checkbox" name="col[]" checked value="9">
                    <label>Вакцинация</label>
                </div>
                <div class="ui row checkbox ch_column">
                    <input type="checkbox" name="col[]" checked value="10">
                    <label>Здоровье</label>
                </div>
                <div class="ui checkbox ch_column">
                    <input type="checkbox" name="col[]" checked value="11">
                    <label>Стерилизация</label>
                </div>
                <div class="ui checkbox ch_column">
                    <input type="checkbox" name="col[]" checked value="12">
                    <label>Заявка на опеку</label>
                </div>
                <div class="ui row checkbox ch_column">
                    <input type="checkbox" name="col[]" checked value="13">
                    <label>Статус</label>
                </div>

            </div>
        </div>
        <div class="ui icon right floated button btn_export">
            <i class="icon large link green file excel outline"></i>
        </div>
        <div data-content="Отчёты" class="ui pop_selxls popup bottom right">
            <div class="ui content selection list">
                <div data-report="4" class="item"><a href="/reports?type=4&shelter_id={{ Auth::user()->organization->id>0?(Auth::user()->organization->id):'2'}}">Сводный отчёт</a></div>
                <div data-report="6" class="item"><a href="/reports?type=6&from_date=2020-01-01&to_date=2020-12-01&district_id=2">Отчёт о мониторинге</a></div>
            </div>
        </div>
        <div class="ui icon right floated button btn_filter">
            <i class="icon large link blue filter"></i>
        </div>
        </div>
        <div class="ui transition hidden pnl_filters">

            <div class="ui form row_filters segment">
                @if( Auth::user()->organization->org_type!=1 )
                    <div class="four fields">
                        <div class="field">
                            <label for="">Округ</label>
                            <div style="min-height: auto;min-width: 80px;" class="ui selection multiple dropdown sel_district">
                                <input type="hidden" name="district" class="act_f" value="">
                                <i class="dropdown icon"></i>
                                <div class="default text">Все</div>
                                <div class="menu">
                                    <div class="item" data-value="">Все</div>
                                    @foreach($district as $it)
                                        <div class="item" data-value="{{$it->id}}">{{$it->district_short_name}}</div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="field">
                            <label for="">Приют</label>
                            <div style="min-height: auto;min-width: 80px;" class="ui selection multiple dropdown sel_shelter">
                                <input type="hidden" name="shelter" class="act_f" value="">
                                <i class="dropdown icon"></i>
                                <div class="default text">Все</div>
                                <div class="menu">
                                    <div class="item" data-value="">Все</div>
                                    @foreach($shelter as $it)
                                        <div class="item" data-value="{{$it->id}}">{{$it->name}}</div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="field">
                            <label for="">Эксплуатирующая организация</label>
                            <div style="min-height: auto;min-width: 80px;" class="ui selection multiple dropdown sel_subord">
                                <input type="hidden" name="subord" class="act_f" value="">
                                <i class="dropdown icon"></i>
                                <div class="default text">Все</div>
                                <div class="menu">
                                    <div class="item" data-value="">Все</div>
                                    @foreach($subord as $it)
                                        <div class="item" data-value="{{$it->id}}">{{$it->name}}</div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="four fields">
                    <div class="field">
                        <label>№ карточки</label>
                        <div style="width:100%" class="ui icon input">
                            <input name="num_card" type="text" class="act_f">
                        </div>

                    </div>
                    <div class="field">
                        <label>Период поступления</label>
                        <div style="width: 100%;" class="ui icon input">
                            <input autocomplete="off" type="text" class="range_date act_f">
                            <i class="calendar icon"></i>
                        </div>
                    </div>
                    <div class="field">
                        <label>Идентификационная метка</label>
                        <div style="width:100%" class="ui icon input">
                            <input name="ind_label" type="text" class="inp_number act_f">
                        </div>
                    </div>
                    <div class="field">
                        <label for="">Вид животного</label>
                        <div style="min-height: auto;min-width: 80px;" class="ui selection dropdown sel_kind">
                            <input type="hidden" name="kind_id" class="act_f">
                            <i class="dropdown icon"></i>
                            <div class="default text">Все</div>
                            <div class="menu">
                                <div class="item" data-value="">Все</div>
                                <div class="item" data-value="1">Кошка</div>
                                <div class="item" data-value="2">Собака</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="four fields">
                <div class="field">
                    <label for="">Пол</label>
                    <div style="min-height: auto;min-width: 80px;" class="ui selection dropdown sel_male">
                        <input type="hidden" name="male" class="act_f" value="0">
                        <i class="dropdown icon"></i>
                        <div class="default text">Все</div>
                        <div class="menu">
                            <div class="item" data-value="">Все</div>
                            <div class="item" data-value="1">Мужской</div>
                            <div class="item" data-value="2">Женский</div>
                        </div>
                    </div>

                </div>
                <div class="field">
                    <label for="">Кличка</label>
                    <div style="width:100%" class="ui icon input">
                        <input name="nickname" type="text" class="act_f">
                    </div>
                </div>
                <div class="field">
                    <label for="">Год рождения</label>
                    <div style="width:100%" class="ui icon input">
                        <input name="year_birth" type="text" class="inp_float act_f">
                    </div>
                </div>
                <div class="field">
                    <label for="">Порода</label>
                    <div style="min-height: auto;min-width: calc(100% - 36px);"
                         class="ui search normal selection multiple  dropdown sel_breed">
                        <input name="breed_id" type="hidden" value="" class="act_f">
                        <i class="dropdown icon"></i>
                        <div class="default text">Все</div>
                        <div class="menu">
                        </div>
                    </div>
                </div>
                </div>
                <div class="four fields">
                <div class="field">
                    <label for="">Окрас</label>
                    <div style="min-height: auto;min-width: calc(100% - 36px);"
                         class="ui search normal selection multiple dropdown sel_coloring">
                        <input name="coloring_id" type="hidden" value="" class="act_f">
                        <i class="dropdown icon"></i>
                        <div class="default text">Все</div>
                        <div class="menu">
                        </div>
                    </div>
                </div>
                <div class="field">
                    <label for="">Вакцинация</label>
                    <div style="width:100%" class="ui icon input">
                        <input name="vacc" type="text" class="act_f">
                    </div>
                </div>
                <div class="field">
                    <label for="">Здоровье</label>
                    <div style="width:100%" class="ui icon input">
                        <input name="insp" type="text" class="act_f">
                    </div>
                </div>
                <div class="field">
                    <label for="">Стерилизация</label>
                    <div style="width:100%" class="ui icon input">
                        <input name="mark_sterilization" type="text" class="act_f">
                    </div>
                </div>
                </div>
                <div class="four fields">
                <div class="field">
                    <label for="">Заявка на опеку</label>
                    <div style="min-height: auto;min-width: 80px;" class="ui selection dropdown sel_bid">
                        <input type="hidden" name="bid" class="act_f">
                        <i class="dropdown icon"></i>
                        <div class="default text">Все</div>
                        <div class="menu">
                            <div class="item" data-value="">Все</div>
                            <div class="item" data-value="1">Да</div>
                            <div class="item" data-value="2">Нет</div>
                        </div>
                    </div>
                </div>
                <div class="field">
                    <label for="">Статус</label>
                    <div style="min-height: auto;min-width: 80px;" class="ui selection multiple dropdown sel_state">
                        <input type="hidden" name="state_bid" class="act_f" value="">
                        <i class="dropdown icon"></i>
                        <div class="default text">Все</div>
                        <div class="menu">
                            <div class="item" data-value="">Все</div>
                            @foreach($states as $it)
                                <div class="item" data-value="{{$it->id}}">{{$it->state_name}}</div>
                            @endforeach
                        </div>
                    </div>
                </div>
                    <div class="field">

                    </div>
                    <div class="field">
                        <div class="ui blue button btn_filter_send">Применить</div>
                        <div class="ui button btn_filter_clear">Очистить</div>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <table style="width:100%" class="ui celled striped structured table tbl_catalog">
                <thead>
                <tr style="text-align: center">
                    @if( Auth::user()->organization->org_type!=1 )
                        <th>Округ</th>
                        <th>Приют</th>
                        <th>Эксплуатирующая организация</th>
                    @endif

                    <th>№ карточки</th>
                    <th>Дата поступления</th>
                    <th>Идентификационная метка</th>
                    <th>Вид животного</th>
                    <th>Пол</th>
                    <th>Кличка</th>
                    <th>Год рождения</th>
                    <th>Порода</th>
                    <th>Окрас</th>
                    <th>Вакцинация</th>
                    <th>Здоровье</th>
                    <th>Стерилизация</th>
                    <th>Заявка на опеку</th>
                    <th>Статус</th>
                </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('script')
    <link href="/assets/datatables/css/dataTables.semanticui.css" rel="stylesheet">
    <script type="text/javascript" src="/assets/datatables/datatables.js"></script>
    <script type="text/javascript" src="/assets/datatables/js/dataTables.semanticui.js"></script>
    <link href="/assets/datatables/Select-1.2.6/css/select.dataTables.css" rel="stylesheet">
    <script type="text/javascript" src="/assets/datatables/Select-1.2.6/js/dataTables.select.js"></script>
    <script type="text/javascript" src="/assets/moment-with-locales.min.js"></script>

    <script type="text/javascript" src="/assets/daterangepicker.min.js"></script>
    <link href="/assets/daterangepicker.css" rel="stylesheet">

    <script>


        $(document).ready(function () {
            page.init();
        });

        let page = {
            body: '.page-catalog',
            id: null,
            select_rec: null,
            table: null,
            init() {
                console.log('init');
                moment.locale('ru');
                let self = this;
                self.body = $(self.body);
                self.body.find('.btn_selfields').popup({
                    popup: $('.pop_selfields.popup'),
                    on: 'click'
                });
                self.body.find('.btn_export').popup({
                    popup: $('.pop_selxls.popup'),
                    on: 'click'
                });
                window.app.setInputToFloat(self.body.find('.inp_float'));
                window.app.setInputToInteger(self.body.find('.inp_number'));
                self.body.find('.ch_column').checkbox();
                self.body.find('.range_date').daterangepicker({
                    timePicker: false,
                    timePicker24Hour: true,
                    startDate: false,
                    //autoUpdateInput: false,
                    //startDate: moment().startOf('hour').subtract(12, 'hour'),
                    //endDate: moment().startOf('hour').add(1, 'hour'),
                    endDate: false,
                    opens: "center",
                    minYear: 2017,
                    maxYear: parseInt(moment().format('YYYY'), 10),
                    locale: {
                        format: 'DD.MM.YYYY',
                        cancelLabel: 'Отмена',
                        applyLabel: 'Принять',
                        invalidDateLabel: 'Выберите дату',
                        daysOfWeek: ['Вт', 'Ср', 'Чт', 'Пт', 'Сб', 'Вс', 'Пн'],
                        monthNames: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'],
                        firstDay: 1
                    }
                });
                self.body.find('.row_filters .dropdown').dropdown();
                self.body.find('.sel_breed').dropdown({
                    apiSettings: {
                        method: 'post',
                        cache: false,
                        url: '/lib/breed/get?q={query}',
                        performance: false,
                        data: {
                            kind: 0,
                            type:"dropdown"
                        },
                        beforeSend: function (settings) {
                            settings.data.kind = self.body.find('.sel_kind').dropdown('get value');
                            return settings;
                        }

                    },
                    fields: {
                        remoteValues: 'data'
                    },
                    // filterRemoteData : true,
                    minCharacters: 2
                });
                self.body.find('.sel_coloring').dropdown({
                    apiSettings: {
                        method: 'post',
                        cache: false,
                        url: '/lib/coloring/get?q={query}',
                        performance: false,
                        data: {
                            kind: 0,
                            type:"dropdown"
                        },
                        beforeSend: function (settings) {
                            settings.data.kind = self.body.find('.sel_kind').dropdown('get value');
                            return settings;
                        }

                    },

                    fields: {
                        remoteValues: 'data'
                    },
                    // filterRemoteData : true,
                    minCharacters: 2
                });
                self.table = self.body.find('.tbl_catalog').DataTable({
                    pageLength: 20,
                    lengthMenu: [10, 15, 20, 30, 50],
                    sDom: '<"ui stackable grid my"<"row dt-table"<"sixteen wide column"i>><"row dt-table"<"sixteen wide column"rt>><"row"<"seven wide column"l><"right aligned nine wide column"p>>>',
                    ajax: {
                        url: "/catalog",
                        type: 'POST',
                        autoload: false,
                        data: function (d) {
                            $.each(self.body.find('.row_filters:first').form('get values'), function (field, val) {
                                d[field] = val;
                            });
                            let rang_date = self.body.find('.row_filters:first .range_date').val().split(" - ");
                            d['in_date_beg'] = moment(rang_date[0], 'DD.MM.YY HH:mm').format('YYYY-MM-DD HH:mm');
                            d['in_date_end'] = moment(rang_date[1], 'DD.MM.YY HH:mm').format('YYYY-MM-DD HH:mm');
                        },
                        dataSrc: 'data'
                    },
                    order: [1, 'desc'],
                    paging: true,
                    processing: true,
                    columnDefs: [
                        {className: "ta-center", targets: [1]}
                    ],
                    columns: [
                            @if( Auth::user()->organization->org_type!=1 )
                            {
                                data: 'district_short_name',
                            },
                            {
                                data: 'org_name'
                            },
                            {
                                data: 'sub_org',
                                orderable:false
                            },

                            @endif
                        {
                            data: 'num_card',
                            width: 200,
                            render: function (data, type, row) {
                                return '<a href="/pet/'+row.id+'" target="_blank">'+data+'</a>';
                            }

                        },
                        {
                            data: 'in_date',
                            render: function (data, type, row) {
                                return moment(data).format('DD.MM.YYYY');
                            }
                        },
                        {
                            data: 'ind_label',

                        },
                        {
                            data: 'kind_name',

                        },
                        {
                            data: 'male',
                            render: function (data, type, row) {
                                return data>0?'М':'Ж';
                            }

                        },
                        {
                            data: 'nickname',

                        },
                        {
                            data: 'year_birth',
                            render: function (data, type, row) {
                                return moment(data).format('MMM YYYY');
                            }

                        },
                        {
                            data: 'breed_name',

                        },
                        {
                            data: 'coloring_name',

                        },
                        {
                            data: 'vacc',
                            orderable:false

                        },
                        {
                            data: 'insp',
                            orderable: false

                        },
                        {
                            data: 'mark_sterilization',

                        },
                        {
                            data: 'id',
                            render: function (data, type, row) {
                                return 'Нет';
                            }
                        },
                        {data: 'state_name'}
                    ],
                    language: window.app.datatable.language,
                    retrieve: true,
                    serverSide: true,
                    colReorder: true,
                    bSortCellsTop: true,
                    searching: false,
                    scrollY: 500,
                    scrollX: true,
                    scrollCollapse: true,
                    select: true,
                    info: true,
                    //pagingType: "ellipses"
                });
                self.body.find('.pop_selfields .ch_column').checkbox({
                    onChange: function () {
                        $.each($(this).val().split(','), function (i, it) {
                            let column = self.table.column(it);
                            column.visible(!column.visible());
                        });
                    }
                });
                self.body.find('.btn_filter').on('click', function () {
                    self.body.find('.pnl_filters').transition();

                });
                self.body.find('.btn_filter_send').on('click', function () {
                    self.table.ajax.reload();

                });
                self.defaultFilters();
                self.body.find('.btn_filter_clear').on('click', function () {
                    self.defaultFilters();
                    self.body.find('.pnl_filters .sel_state').dropdown('set selected',['1','2']);
                    self.table.ajax.reload();
                });

            },
            defaultFilters(){
                let self=this;
                self.body.find('.pnl_filters .form').form('clear');
                self.body.find('.pnl_filters .sel_state').dropdown('set selected',['1','2']);
            }
        }
    </script>
@endsection