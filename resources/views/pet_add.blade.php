@extends('layouts.app')
@section('htmlheader_title')
    Добавление
@endsection

@section('style')
    <style>
        .ui.shape .sides .side.no_padding{
            padding:0!important;
            min-width: 800px;
            min-height: 450px;
        }
    </style>
@endsection

@section('content')
    <div class="pet_add">
        @include('modal_confirm')
        <div class="ui inverted dimmer loader_save">
            <div class="ui text loader">Сохранение...</div>
        </div>
        <div class="ui inverted dimmer loader_load">
            <div class="ui text loader">Загрузка...</div>
        </div>
        <h2 style="text-align: center;">Новая карточка учёта животного</h2>
        <div class="inline field search_by_ind_label_block" style="text-align: center;">
            <label>Номер чипа(-ов)</label>
            <div class="ui category search">
                <div class="ui icon input" style="width: 300px;">
                    <input class="prompt search_by_ind_label"  type="text" placeholder="Введите номер(-а через запятую)">
                    <i class="search icon"></i>
                </div>
                <div class="results"></div>
            </div>
        </div>
        <form class="ui form card" style="/*display:none;*/width:100%;/*margin:25px;*/padding: 15px;">
            <h3 style="text-align: center;">Сведения о поступлении</h3>

            <div class="ui grid">
                <div class="row">
                    <div class="sixteen wide column">
                        <div class="four fields">
                            <div class="field">
                                <label for="ind_label">Номер чипа(-ов)</label>
                                <input name="ind_label" id="ind_label" type="text" placeholder="Введите номер(-а через запятую)">
                            </div>
                            <div class="field">
                                <div class="field">
                                    <div class="field">
                                        <label for="kind_id">Вид</label>
                                        <div class="ui selection dropdown my_dropdown kind">
                                            <input type="hidden" name="kind_id" class="kind_id">
                                            <i class="dropdown icon"></i>
                                            <div class="default text">Выберите Кошка/Собака</div>
                                            <div class="menu">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="field" style="/*width: 300px;*/">
                                <label for="nickname">Кличка</label>
                                <input name="nickname" id="nickname" placeholder="Введите кличку">
                            </div>
                            <div class="field">
                                <label for="photo">Фотография животного </label>
                                <div class="ui input">
                                    <input type="file" name="photo" id="photo" required title="Загрузите одну или несколько фотографий" accept="image/*,image/jpeg">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="eight wide column">
                        <div class="row">
                            <div class="two fields">
                                <div class="field" style="/*width: 150px;*/">
                                    <label for="in_akt">Номер Акта поступления</label>
                                    <input name="in_akt" id="in_akt" type="text" placeholder="">
                                </div>
                                <div class="field" style="/*width: 150px;*/">
                                    <label for="num_card">Номер карточки</label>
                                    <input name="num_card" id="num_card" type="text" placeholder="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="two fields">
                                <div class="field" style="/*width: 150px;*/">
                                    <label for="care_worker">Сотрудник по уходу</label>
                                    <input name="care_worker" id="care_worker" type="text" placeholder="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="three fields">
                                <div class="field" style="/*width: 300px;*/">
                                    <label for="in_date">Дата поступления</label>
                                    <div class="ui icon input" >
                                        <input value="{{date('d.m.Y')}}" class="my_calendar_input" type="text" name="in_date" id="in_date">
                                        <i class="calendar icon"></i>
                                    </div>
                                </div>
                                <div class="field" style="/*width: 300px;*/">
                                    <label for="birthdate">Год рождения</label>
                                    <div class="ui icon input" >
                                        <input value="" class="my_calendar_input" type="text" name="birthdate" id="birthdate">
                                        <i class="calendar icon"></i>
                                    </div>
                                </div>
                                <div class="field">
                                    <label for="weight">Вес, кг</label>
                                    <input name="weight" id="weight" type="text" placeholder="Введите вес">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="two fields">
                                <div class="field">
                                    <label for="breed">Порода</label>
                                    <div class="ui search selection dropdown my_dropdown breed unselected">
                                        <input type="hidden" name="breed" id="breed">
                                        <i class="dropdown icon"></i>
                                        <div class="default text">Порода</div>
                                        <div class="menu">
                                        </div>
                                    </div>
                                </div>
                                <div class="field">
                                    <label for="wooltype">Шерсть</label>
                                    <div class="ui search selection dropdown my_dropdown wooltype unselected">
                                        <input type="hidden" name="wooltype" id="wooltype">
                                        <i class="dropdown icon"></i>
                                        <div class="default text">Шерсть</div>
                                        <div class="menu">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="two fields">
                                <div class="field">
                                    <label for="color">Окрас</label>
                                    <div class="ui search selection dropdown my_dropdown color unselected">
                                        <input type="hidden" name="color" id="color">
                                        <i class="dropdown icon"></i>
                                        <div class="default text">Окрас</div>
                                        <div class="menu">
                                        </div>
                                    </div>
                                </div>
                                <div class="field">
                                    <label for="tailtype">Хвост</label>
                                    <div class="ui search selection dropdown my_dropdown tailtype">
                                        <input type="hidden" name="tailtype" id="tailtype">
                                        <i class="dropdown icon"></i>
                                        <div class="default text">Хвост</div>
                                        <div class="menu">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="two fields">
                                <div class="field">
                                    <label for="eartype">Уши</label>
                                    <div class="ui search selection dropdown my_dropdown eartype">
                                        <input type="hidden" name="eartype" id="eartype">
                                        <i class="dropdown icon"></i>
                                        <div class="default text">Уши</div>
                                        <div class="menu">
                                        </div>
                                    </div>
                                </div>
                                <div class="field" style="/*width: 150px;*/">
                                    <label for="num_aviary">Номер вольера</label>
                                    <input name="num_aviary" id="num_aviary" type="text" placeholder="Введите номер">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="two fields">
                                <div class="field">
                                    <label for="size">Размер</label>
                                    <div class="ui search selection dropdown my_dropdown size">
                                        <input type="hidden" name="size" id="size">
                                        <i class="dropdown icon"></i>
                                        <div class="default text">Размер</div>
                                        <div class="menu">
                                        </div>
                                    </div>
                                </div>
                                <div class="field">
                                    <label for="size">Пол</label>
                                    <div class="ui selection dropdown my_dropdown male">
                                        <input type="hidden" name="male" id="male">
                                        <i class="dropdown icon"></i>
                                        <div class="default text">Пол</div>
                                        <div class="menu">
                                            <div class="item" data-value="true">Самец</div>
                                            <div class="item" data-value="false">Самка</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="eight wide column" style="text-align: center;height: 450px;">
                        <div class="content">
                            <div class="center">
                                <img class="ui image uploading" src="/files/none.png" style="max-width:800px;max-height:450px;">
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="two fields">
                <div class="field">
                    <label for="specials">Особые приметы</label>
                    <textarea rows="4" name="specials" id="specials"></textarea>
                </div>
                <div class="field">
                    <label for="temper">Характер</label>
                    <textarea rows="4" name="temper" id="temper"></textarea>
                </div>
            </div>







        <div class="ui grid tabular_menu">
            <div class="four wide column">
                <div class="ui vertical fluid left tabular menu">
                    <div class="item active" data-tab="tab-data1">Сведения о стерилизации</div>
                    <div class="item" data-tab="tab-data2">Сведения об отлове</div>
                    <div class="item" data-tab="tab-data3">Сведения о новых владельцах</div>
                    <div class="item" data-tab="tab-data4">Сведения об обработке от экто- и эндопаразитов</div>
                    <div class="item" data-tab="tab-data5">Сведения вакцинации</div>
                    <div class="item" data-tab="tab-data6">Сведения о стостоянии здоровья</div>
                </div>
            </div>
            <div class="twelve wide stretched column">
                <div class="ui segment">
                    <div class="ui tab active" data-tab="tab-data1">
                        <div class="ui table">
                            <table>
                                <tbody>
                                <tr>
                                    <td style="text-align: right;">
                                        <label for="mark_sterilization" style="padding-left: 15px;">Пометка о стерилизации</label>
                                    </td>
                                    <td>
                                        <div class="field">
                                            <div class="ui input">
                                                <div class="ui input ">
                                                    <input name="mark_sterilization" id="mark_sterilization" type="text" placeholder="" >
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td style="text-align: right;">
                                        <label for="mark_sterilization" style="padding-left: 15px;">Врач</label>
                                    </td>
                                    <td>
                                        <div class="field">
                                            <div class="ui selection dropdown my_dropdown vet">
                                                <input type="hidden" name="vet_id" id="vet_id" >
                                                <i class="dropdown icon"></i>
                                                <div class="default text">Врач</div>
                                                <div class="menu">
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="field">
                                            <div class="ui checkbox ">
                                                <input type="checkbox" name="socialized">
                                                <label>Животное социализировано</label>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="ui tab" data-tab="tab-data2">
                        <div class="ui table">
                            <table>
                                <tbody>
                                <tr>
                                    <td style="text-align: right;">
                                        <label for="catch_order" style="padding-left: 15px;">Номер заказ-наряда</label>
                                    </td>
                                    <td>
                                        <div class="field">
                                            <div class="ui input">
                                                <input name="catch_order" id="catch_order" type="text" placeholder="">
                                            </div>
                                        </div>
                                    </td>
                                    <td style="text-align: right;">
                                        <label for="catch_date_order" style="padding-left: 15px;">Дата заказ-наряда</label>
                                    </td>
                                    <td>
                                        <div class="field">
                                            <div class="ui icon input" >
                                                <input value="" class="my_calendar_input" type="text" name="catch_date_order" id="catch_date_order">
                                                <i class="calendar icon"></i>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: right;">
                                        <label for="catch_akt" style="padding-left: 15px;">Акт отлова</label>
                                    </td>
                                    <td>
                                        <div class="field">
                                            <div class="ui input">
                                                <input name="catch_akt" id="catch_akt" type="text" placeholder="">
                                            </div>
                                        </div>
                                    </td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td style="text-align: right;">
                                        <label for="catch_address" style="padding-left: 15px;">Адрес отлова</label>
                                    </td>
                                    <td>
                                        <div class="field">
                                            <div class="ui input">
                                                <input name="catch_address" id="catch_address" type="text" placeholder="">
                                            </div>
                                        </div>
                                    </td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="ui tab" data-tab="tab-data3">
                        <div class="ui table">
                            <table>
                                <tbody>
                                <tr>
                                    <td style="text-align: right;">
                                        <label for="own_entity_name" style="padding-left: 15px;">Наименование Юридической организации владельца</label>
                                    </td>
                                    <td>
                                        <div class="field">
                                            <div class="ui input">
                                                <input name="own_entity_name" id="own_entity_name" type="text" placeholder="">
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: right;">
                                        <label for="own_fio" style="padding-left: 15px;">ФИО владельца</label>
                                    </td>
                                    <td>
                                        <div class="field">
                                            <div class="ui input">
                                                <input name="own_fio" id="own_fio" type="text" placeholder="">
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: right;">
                                        <label for="own_address" style="padding-left: 15px;">Адрес проживания владельца</label>
                                    </td>
                                    <td>
                                        <div class="field">
                                            <div class="ui input">
                                                <input name="own_address" id="own_address" type="text" placeholder="">
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: right;">
                                        <label for="own_telephone" style="padding-left: 15px;">Телефон владельца</label>
                                    </td>
                                    <td>
                                        <div class="field">
                                            <div class="ui input">
                                                <input name="own_telephone" id="own_telephone" type="text" placeholder="">
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="ui tab" data-tab="tab-data4">
                        <div class="ui table">
                            <table>
                                <tbody>
                                <tr class="treatment_row">
                                    <td style="text-align: right;">
                                        <label style="padding-left: 15px;">Дата обработки</label>
                                    </td>
                                    <td>
                                        <div class="field" style="/*width: 300px;*/">
                                            <div class="ui icon input" >
                                                <input value="" class="my_calendar_input" type="text" name="treatment_date[]" >
                                                <i class="calendar icon"></i>
                                            </div>
                                        </div>
                                    </td>
                                    <td style="text-align: right;">
                                        <label style="padding-left: 15px;">Препарат</label>
                                    </td>
                                    <td>
                                        <div class="field" style="/*width: 300px;*/">
                                            <div class="ui input">
                                                <input name="treatment_drug[]"  type="text" placeholder="">
                                            </div>
                                        </div>
                                    </td>
                                    <td style="text-align: right;">
                                        <label style="padding-left: 15px;">Доза</label>
                                    </td>
                                    <td>
                                        <div class="field" style="/*width: 300px;*/">
                                            <div class="ui input">
                                                <input name="treatment_dose[]"  type="text" placeholder="">
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <i class="ui icon big green plus treatment_add"></i>
                                        <i class="ui icon big red x treatment_remove"></i>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="ui tab" data-tab="tab-data5">
                        <div class="ui table">
                            <table>
                                <tbody>
                                <tr class="vac_row">
                                    <td style="text-align: right;">
                                        <label style="padding-left: 15px;">Дата</label>
                                    </td>
                                    <td>
                                        <div class="field" style="/*width: 300px;*/">
                                            <div class="ui icon input" >
                                                <input value="" class="my_calendar_input" type="text" name="vac_date[]" >
                                                <i class="calendar icon"></i>
                                            </div>
                                        </div>
                                    </td>
                                    <td style="text-align: right;">
                                        <label style="padding-left: 15px;">Вид вакцины</label>
                                    </td>
                                    <td>
                                        <div class="field" style="/*width: 300px;*/">
                                            <div class="ui input">
                                                <input name="vac_type[]"  type="text" placeholder="">
                                            </div>
                                        </div>
                                    </td>
                                    <td style="text-align: right;">
                                        <label style="padding-left: 15px;">№ Серии</label>
                                    </td>
                                    <td>
                                        <div class="field" style="/*width: 300px;*/">
                                            <div class="ui input">
                                                <input name="vac_serial[]"  type="text" placeholder="">
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <i class="ui icon big green plus vac_add"></i>
                                        <i class="ui icon big red x vac_remove"></i>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="ui tab" data-tab="tab-data6">
                        <div class="ui table">
                            <table>
                                <tbody>
                                <tr class="inspect_row">
                                    <td style="text-align: right;">
                                        <label style="padding-left: 15px;">Дата осмотра</label>
                                    </td>
                                    <td>
                                        <div class="field" style="/*width: 300px;*/">
                                            <div class="ui icon input" >
                                                <input value="" class="my_calendar_input" type="text" name="inspect_date[]" >
                                                <i class="calendar icon"></i>
                                            </div>
                                        </div>
                                    </td>
                                    <td style="text-align: right;">
                                        <label style="padding-left: 15px;">Анамнез</label>
                                    </td>
                                    <td width="50%">
                                        <div class="field" style="/*width: 300px;*/">
                                            <div class="ui input">
                                                <textarea name="inspect_description[]"  rows="3"></textarea>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <i class="ui icon big green plus inspect_add"></i>
                                        <i class="ui icon big red x inspect_remove"></i>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="ui green button right floated save_card" style="margin: 15px;">Сохранить</div>
        </form>
    </div>
@endsection

@section('script')
    <link href="{{ asset('assets/datetimepicker/jquery.datetimepicker.min.css') }}" rel="stylesheet">
    <script src="/assets/datetimepicker/jquery.datetimepicker.full.min.js"></script>
    
    <script>
        $(document).ready(function () {
            page.init();
        });

        let page = {
            body: '.pet_add',
            id: null,
            card: '.card',
            kind:0,
            winModalConfirm:'.mod_confirm-block',
            in_progress:false,
            counter:null,
            init(){
                let _this = this;
                _this.$body = $(_this.body);
                _this.card = _this.$body.find(_this.card);
                _this.$winModalConfirm = $(_this.winModalConfirm);

                _this.$body.find("#photo").change(function() {
                    _this.proceedPhotoPreview(this);
                });
                _this.$body.find('.tabular.menu .item').tab();

                _this.$body.find('.ui.form.card')
                    .form({
                        fields: {
                            /*kind_id: 'empty',
                            in_date: 'empty',*/
                            /*num_aviary: 'empty',*/
                            /*weight: 'empty',
                            breed: 'empty',
                            size: 'empty',
                            birthdate:['length[4]','integer','empty'],
                            color:'empty',
                            wooltype:'empty',
                            eartype:'empty',
                            tailtype:'empty',
                            male:'empty',
                            nickname:'empty',
                            uploading:'empty',*///не проверено
                        }
                    });

                /*_this.$body.find('input').on('change',function () {
                    console.log(_this.$body.find('.ui.form.card').form('validate form'));
                    console.log(_this.$body.find('.ui.form.card').serialize()c);
                });*/

                _this.$body.find('.my_calendar_input').datetimepicker({
                    format:'d.m.Y',
                    locale:'ru',
                    timepicker: false
                });

                _this.$body.find('.search_by_ind_label_block .ui.search')
                    .search({
                        type: 'category',
                        error: {
                            noResults: 'Записей не найдено'
                        },
                        apiSettings: {
                            url: "/pet/route?searchByIndLabel=true&id={query}",
                            method: 'POST',
                            onResponse: function(Response) {
                                var
                                    response = {
                                        results : {}
                                    }
                                ;
                                // translate GitHub API response to work with search
                                $.each(Response.data, function(index, pet) {
                                    var
                                        kind_name  = pet.kind_name|| 'Unknown',
                                        maxResults = 10
                                    ;
                                    if(index >= maxResults) {
                                        return false;
                                    }
                                    // create new language category
                                    if(response.results[kind_name] === undefined) {
                                        response.results[kind_name] = {
                                            name    : kind_name,
                                            results : []
                                        };
                                    }
                                    // add result to category
                                    response.results[kind_name].results.push({
                                        title       : pet.nickname,
                                        description : pet.ind_label,
                                        url         : '/pet/add/'+pet.id,
                                        id          : pet.id,
                                        pet        : pet
                                    });
                                });
                                return response;
                            },
                        },
                        minCharacters : 2,
                        templates: {
                            category: function (response) {
                                // returns results html for standard results
                                result="<div>";
                                $.each (response['results'],function (cat,data) {
                                    result+='<div class="category">'+
                                        '<div class="name">'+cat+'</div>'+
                                            '<div class="results">';
                                    $.each(data['results'],function (key2,val2) {
                                        result+='<a class="result">'+
                                            '<div class="content">'+
                                                '<div class="title">'+val2['title']+'</div>'+
                                                '<div class="description">'+val2['description']+'</div>'+
                                            '</div>' +
                                            '</a>';
                                    });
                                    result+='</div>'+
                                        '</div>';
                                });
                                result+="</div>";
                                return result;
                            }
                        },
                        onSelect: function(result, response){
                            _this.preload_data(result.pet);
                            return false;
                        }
                    })
                ;



                _this.$body.find('.my_dropdown.kind').dropdown({
                    transition:'scale',
                    apiSettings: {
                        url: "/pet/route?getKinds=true",
                        method: "POST",
                        saveRemoteData:false,
                        cache:false,
                    },
                    fields:{
                        remoteValues:'data',
                        name:'kind_name',
                        value:'id'
                    },
                    onChange:function (val,text,choice) {
                        _this.kind=val;
                        _this.$body.find('.unselected').removeClass('unselected');
                        _this.kindChosen();
                    }
                }).dropdown('queryRemote', '', function() {});
                _this.$body.find('.unselected').on('click',function () {
                    if($(this).hasClass('unselected')) {
                        _this.$body.find('.my_dropdown.kind').focus();
                    }
                });
                _this.$body.find('.my_dropdown.size').dropdown({
                    transition:'scale',
                    fullTextSearch:true
                });
                window.app.dropdownLoad('.my_dropdown.size', {
                    api: {
                        url: "/pet/route?getSizes=true",
                        paramData: 'data',
                        data:{
                            type:'dropdown'
                        }
                    },
                });
                _this.$body.find('.my_dropdown.vet').dropdown({
                    transition:'scale',
                    fullTextSearch:true
                });
                window.app.dropdownLoad('.my_dropdown.vet', {
                    api: {
                        url: "/pet/route?getVetsDropdown=true",
                        paramData: 'data',
                        data:{
                            type:'dropdown'
                        }
                    },
                });

                _this.$body.find('.my_dropdown.eartype').dropdown({
                    transition:'scale',
                    fullTextSearch:true
                });
                window.app.dropdownLoad('.my_dropdown.eartype', {
                    api: {
                        url: "/pet/route?getEartypes=true",
                        paramData: 'data',
                        data:{
                            type:'dropdown'
                        }
                    },
                    value:'eartype_name'
                });

                _this.$body.find('.my_dropdown.tailtype').dropdown({
                    transition:'scale',
                    fullTextSearch:true
                });
                window.app.dropdownLoad('.my_dropdown.tailtype', {
                    api: {
                        url: "/pet/route?getTailtypes=true",
                        paramData: 'data',
                        data:{
                            type:'dropdown'
                        }
                    },
                    value:'tailtype_name'
                });
                _this.$body.find('.my_dropdown.male').dropdown({transition:'scale'});

                _this.$body.find('.save_card').on('click',function () {
                    if(_this.$body.find('.ui.form.card').form('validate form')) {
                        _this.$winModalConfirm.find('form').form('clear');
                        _this.$winModalConfirm.find('.field_message').html('Вы уверены, что хотите сохранить карточку нового питомца?');
                        _this.$winModalConfirm.find('.btn_confirm').off('click').on('click', function (event) {
                            if (_this.in_progress) {
                                return;
                            } else {
                               // _this.in_progress = true;
                                _this.$body.find('.my_error').removeClass('my_error');
                                _this.$winModalConfirm.modal('hide');
                                _this.save();
                            }
                        });
                        _this.$winModalConfirm.modal('show');
                    }else{
                        alert('Заполните все обязательные поля. <br>Проверьте поля подсвеченные красным');
                    }
                });

                _this.treatMent();
                _this.vac();
                _this.inspect();
            },
            preload_data(pet){
                //console.log(pet);
                let _this=this;
                _this.$body.find('input[name="ind_label"]').val(pet.ind_label);
                _this.$body.find('input[name="birthdate"]').val(pet.year_birth);
                _this.$body.find('input[name="nickname"]').val(pet.nickname);
                _this.$body.find('.my_dropdown.kind').dropdown('set selected',pet.kind_id);
            },
            treatMent(){
                let _this = this;
                _this.$body.find('.treatment_add').off().on('click',function () {
                    let row_clone=$(this).closest('tr').clone();
                    row_clone.find('input').val('');
                    $(this).closest('tr').closest('tbody').append(row_clone);
                    _this.treatMent();
                });
                _this.$body.find('.treatment_remove').off().on('click',function () {
                    if(_this.$body.find('.treatment_remove').length>1){
                        $(this).closest('tr').remove();
                    }
                });
                _this.$body.find('.my_calendar_input').datetimepicker({
                    format:'d.m.Y',
                    locale:'ru',
                    timepicker: false
                });
            },
            vac(){
                let _this = this;
                _this.$body.find('.vac_add').off().on('click',function () {
                    let row_clone=$(this).closest('tr').clone();
                    row_clone.find('input').val('');
                    $(this).closest('tr').closest('tbody').append(row_clone);
                    _this.vac();
                });
                _this.$body.find('.vac_remove').off().on('click',function () {
                    if(_this.$body.find('.vac_remove').length>1){
                        $(this).closest('tr').remove();
                    }
                });
                _this.$body.find('.my_calendar_input').datetimepicker({
                    format:'d.m.Y',
                    locale:'ru',
                    timepicker: false
                });
            },
            inspect(){
                let _this = this;
                _this.$body.find('.inspect_add').off().on('click',function () {
                    let row_clone=$(this).closest('tr').clone();
                    row_clone.find('input').val('');
                    row_clone.find('textarea').val('');
                    $(this).closest('tr').closest('tbody').append(row_clone);
                    _this.inspect();
                });
                _this.$body.find('.inspect_remove').off().on('click',function () {
                    if(_this.$body.find('.inspect_remove').length>1){
                        $(this).closest('tr').remove();
                    }
                });
                _this.$body.find('.my_calendar_input').datetimepicker({
                    format:'d.m.Y',
                    locale:'ru',
                    timepicker: false
                });
            },
            save(){
                let _this = this;
                //let form =_this.$body.find('.ui.form.card').form();
                //let formData=new FormData();
                /*$.each(form,function (key,val) {
                    formData.append(key,val);
                });*/

                let formData=new FormData();
                $.each(_this.$body.find('.ui.form.card').form('get values'),function (key,val) {
                    formData.append(key,val);
                });

                $.each(_this.$body.find('.treatment_row input'),function () {
                    formData.append($(this).attr('name'),$(this).val());
                });
                $.each(_this.$body.find('.vac_row input'),function () {
                    formData.append($(this).attr('name'),$(this).val());
                });
                $.each(_this.$body.find('.inspect_row input'),function () {
                    formData.append($(this).attr('name'),$(this).val());
                });
                $.each(_this.$body.find('.inspect_row textarea'),function () {
                    formData.append($(this).attr('name'),$(this).val());
                });

                $.each(_this.$body.find('input[name^="photo"]'),function(i,ob){
                    let key=0;
                    while (typeof($(ob).prop('files')[key]) !== 'undefined'){
                        formData.append('files[]', $(ob).prop('files')[key]);
                        key++;
                    }
                });

                //clear mark error

                let loader = _this.$body.find('.loader_save');
                loader.addClass('active');
                $.ajax({
                    method: 'POST',
                    url: "/pet/route?newOne=true",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false
                }).then(function (obj) {
                    loader.removeClass('active');
                    _this.in_progress=false;

                    if (obj.success) {
                        alert('Сохранено успешно');
                        window.location.reload();
                    } else {

                    }
                });

            },
            proceedPhotoPreview(input) {
                let _this = this;
                _this.$body = $(_this.body);
                if (input.files && input.files[0]) {
                    $.each(input.files,function (key,val) {
                        var reader = new FileReader();
                        reader.onload = function (e) {
                            _this.$body.find('img.uploading').attr('src', e.target.result);
                        };
                        reader.readAsDataURL(input.files[key]); // convert to base64 string
                    });
                }else{
                    _this.$body.find('img.uploading').attr('src', '/files/none.png');
                }
            },
            kindChosen() {
                let _this = this;
                _this.$body = $(_this.body);
                _this.counter=3;//количество функций, после которых отключится диммер функцией _this.getAllCheck();
                let loader = _this.$body.find('.loader_load');
                loader.addClass('active');
                let breed_table = "";
                $.ajax({
                    method: "POST",
                    url: "/pet/route",
                    data: {
                        getBreeds: true,
                        kind_id: _this.kind
                    }
                }).then(function (result) {
                    $.each(result.data, function (key, row) {
                        breed_table += '<div class="item" data-value="' + row['id'] + '">' + row['breed_name'] + '</div>';
                    });
                    _this.$body.find('.my_dropdown.breed .menu').html(breed_table);
                    _this.$body.find('.my_dropdown.breed').dropdown('restore defaults').dropdown('destroy').dropdown({transition: 'scale'});
                    _this.getAllCheck();
                });

                let color_table="";
                $.ajax({
                    method: "POST",
                    url: "/pet/route",
                    data: {
                        getColors: true,
                        kind_id: _this.kind
                    }
                }).then(function (result) {
                    $.each(result.data, function (key, row) {
                        color_table += '<div class="item" data-value="' + row['id'] + '">' + row['coloring_name'] + '</div>';
                    });
                    _this.$body.find('.my_dropdown.color .menu').html(color_table);
                    _this.$body.find('.my_dropdown.color').dropdown('restore defaults').dropdown('destroy').dropdown({transition: 'scale'});
                    _this.getAllCheck();
                });

                let wooltype_table="";
                $.ajax({
                    method: "POST",
                    url: "/pet/route",
                    data: {
                        getWooltypes: true,
                        kind_id: _this.kind
                    }
                }).then(function (result) {
                    $.each(result.data, function (key, row) {
                        wooltype_table += '<div class="item" data-value="' + row['id'] + '">' + row['wooltype_name'] + '</div>';
                    });
                    _this.$body.find('.my_dropdown.wooltype .menu').html(wooltype_table);
                    _this.$body.find('.my_dropdown.wooltype').dropdown('restore defaults').dropdown('destroy').dropdown({transition: 'scale'});
                    _this.getAllCheck();
                });

            },
            getAllCheck(){
                let _this= this;
                _this.counter--;
                if(_this.counter==0) {
                    let loader = _this.$body.find('.loader_load');
                    loader.removeClass('active');
                }
            }

        }

    </script>
@endsection

