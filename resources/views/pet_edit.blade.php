@extends('layouts.app')
@section('htmlheader_title')
    Добавление
@endsection

@section('style')
    <style>
        .ui.input.disabled{
            opacity: 1!important;
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
        @if(!$edit_access)
        <h2 style="text-align: center;">Карточка учёта животного</h2>
        @else
        <h2 style="text-align: center;">Редактирование карточки учёта животного</h2>
        @endif
        <div class="ui icon right floated button btn_export">
            <a target="_blank" href="/reports?id={{$Petsdata['id']}}&type=3"><i class="icon large link green file word outline"></i></a>

        </div>
        <form class="ui form card" style="/*display:none;*/width:100%;/*margin:25px;*/padding: 15px;">
            <h3 style="text-align: center;">Сведения о поступлении</h3>
            <div class="ui grid">
                <div class="row">
                    <div class="sixteen wide column">
                        <div class="four fields">
                            <div class="field">
                                <label for="ind_label">Номер чипа(-ов)</label>
                                <div class="ui input @if(!$edit_access) disabled @endif">
                                    <input type="hidden" name="id" value="{{$Petsdata['id']}}">
                                    <input name="ind_label" id="ind_label" type="text" value="{{$Petsdata['ind_label']}}"  placeholder="Введите номер(-а через запятую)">
                                </div>
                            </div>
                            <div class="field">
                                <div class="field">
                                    <div class="field">
                                        <label for="kind_id">Вид</label>
                                        <div class="ui selection dropdown @if(!$edit_access) disabled @endif my_dropdown kind">
                                            <input type="hidden" name="kind_id" class="kind_id" value="{{$Petsdata['kind_id']}}">
                                            <i class="dropdown icon"></i>
                                            <div class="default text">Кошка/Собака</div>
                                            <div class="menu">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="field" style="/*width: 300px;*/">
                                <label for="nickname">Кличка</label>
                                <div class="ui input @if(!$edit_access) disabled @endif">
                                    <input name="nickname" id="nickname" placeholder="Введите кличку" value="{{$Petsdata['nickname']}}">
                                </div>
                            </div>
                            <div class="field">
                                <label for="photo">Добавить фотографии животного</label>
                                <div class="ui input @if(!$edit_access) disabled @endif">
                                    <input type="file" name="photo" id="photo"  multiple title="Загрузите одну или несколько фотографий" accept="image/*,image/jpeg" value="">
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
                                    <div class="ui input @if(!$edit_access) disabled @endif">
                                        <input name="in_akt" id="in_akt" type="text" placeholder="" value="{{$Petsdata['in_akt']}}">
                                    </div>
                                </div>
                                <div class="field" style="/*width: 150px;*/">
                                    <label for="num_card">Номер карточки</label>
                                    <div class="ui input @if(!$edit_access) disabled @endif">
                                        <input name="num_card" id="num_card" type="text" placeholder="" value="{{$Petsdata['num_card']}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="two fields">
                                <div class="field" style="/*width: 150px;*/">
                                    <label for="care_worker">Сотрудник по уходу</label>
                                    <div class="ui input @if(!$edit_access) disabled @endif">
                                        <input name="care_worker" id="care_worker" type="text" placeholder="" value="{{$Petsdata['care_worker']}}">
                                    </div>
                                </div>
                                <div class="field" style="padding-top: 33px;">
                                    <div class="ui  checkbox @if(!$edit_access) disabled @endif">
                                        <input type="checkbox" {{$Petsdata['state_id']>1?'checked':''}} name="socialized">
                                        <label>Животное социализировано</label>
                                    </div>
                                </div>
                                {{--<div class="field">
                                    <label for="state_id">Статус</label>
                                    <div class="ui selection dropdown @if(!$edit_access) disabled @endif my_dropdown state_id">
                                        <input type="hidden" name="state_id" id="state_id" value="{{$Petsdata['state_id']}}">
                                        <i class="dropdown icon"></i>
                                        <div class="default text">Статус</div>
                                        <div class="menu">
                                        </div>
                                    </div>
                                </div>--}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="three fields">
                                <div class="field" style="/*width: 300px;*/">
                                    <label for="in_date">Дата поступления</label>
                                    <div class="ui icon input @if(!$edit_access) disabled @endif" >
                                        <input value="{{strtotime($Petsdata['in_date'])!==false?date('d.m.Y',strtotime($Petsdata['in_date'])):''}}" class="my_calendar_input" type="text" name="in_date" id="in_date" >
                                        <i class="calendar icon"></i>
                                    </div>
                                </div>
                                <div class="field" style="/*width: 300px;*/">
                                    <label for="birthdate">Год рождения</label>
                                    <div class="ui icon input @if(!$edit_access) disabled @endif" >
                                        <input value="{{strtotime($Petsdata['year_birth'])!==false?date('d.m.Y',strtotime($Petsdata['year_birth'])):''}}" class="my_calendar_input" type="text" name="birthdate" id="birthdate">
                                        <i class="calendar icon"></i>
                                    </div>
                                </div>
                                <div class="field">
                                    <label for="weight">Вес, кг</label>
                                    <div class="ui input @if(!$edit_access) disabled @endif" >
                                        <input name="weight" id="weight" type="text" placeholder="Введите вес" value="{{$Petsdata['weight']}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="two fields">
                                <div class="field">
                                    <label for="breed">Порода</label>
                                    <div class="ui search selection dropdown @if(!$edit_access) disabled @endif my_dropdown breed unselected">
                                        <input type="hidden" name="breed" id="breed" value="{{$Petsdata['breed_id']}}">
                                        <i class="dropdown icon"></i>
                                        <div class="default text">Порода</div>
                                        <div class="menu">
                                        </div>
                                    </div>
                                </div>
                                <div class="field">
                                    <label for="wooltype">Шерсть</label>
                                    <div class="ui search selection dropdown @if(!$edit_access) disabled @endif my_dropdown wooltype unselected">
                                        <input type="hidden" name="wooltype" id="wooltype" value="{{$Petsdata['wooltype_id']}}">
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
                                    <div class="ui search selection dropdown @if(!$edit_access) disabled @endif my_dropdown color unselected">
                                        <input type="hidden" name="color" id="color" value="{{$Petsdata['coloring_id']}}">
                                        <i class="dropdown icon"></i>
                                        <div class="default text">Окрас</div>
                                        <div class="menu">
                                        </div>
                                    </div>
                                </div>
                                <div class="field">
                                    <label for="tailtype">Хвост</label>
                                    <div class="ui search selection dropdown @if(!$edit_access) disabled @endif my_dropdown tailtype">
                                        <input type="hidden" name="tailtype" id="tailtype" value="{{$Petsdata['tailtype_id']}}">
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
                                    <div class="ui search selection dropdown @if(!$edit_access) disabled @endif my_dropdown eartype">
                                        <input type="hidden" name="eartype" id="eartype" value="{{$Petsdata['eartype_id']}}">
                                        <i class="dropdown icon"></i>
                                        <div class="default text">Уши</div>
                                        <div class="menu">
                                        </div>
                                    </div>
                                </div>
                                <div class="field" style="/*width: 150px;*/">
                                    <label for="num_aviary">Номер вольера</label>
                                    <div class="ui input @if(!$edit_access) disabled @endif" >
                                        <input name="num_aviary" id="num_aviary" type="text" placeholder="Введите номер" value="{{$Petsdata['num_aviary']}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="two fields">
                                <div class="field">
                                    <label for="size">Размер</label>
                                    <div class="ui search selection dropdown @if(!$edit_access) disabled @endif my_dropdown size">
                                        <input type="hidden" name="size" id="size" value="{{$Petsdata['size_id']}}">
                                        <i class="dropdown icon"></i>
                                        <div class="default text">Размер</div>
                                        <div class="menu">
                                        </div>
                                    </div>
                                </div>
                                <div class="field">
                                    <label for="male">Пол</label>
                                    <div class="ui selection dropdown @if(!$edit_access) disabled @endif my_dropdown male">
                                        <input type="hidden" name="male" id="male" value="{{$Petsdata['male']?"true":"false"}}">
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
                        @if($Petsdata['photo']!="")
                            <div class="content">
                                <div class="center">
                                    <img class="ui image uploading" src="/data/img/origin/{{$Petsdata['photo']}}" style="max-width:800px;max-height:450px;">
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="two fields">
                <div class="field">
                    <label for="specials">Особые приметы</label>
                    <div class="ui input @if(!$edit_access) disabled @endif" >
                        <textarea rows="4" name="specials" id="specials">{{!is_null($Petsdata['specials'])?$Petsdata['specials']:''}}</textarea>
                    </div>
                </div>
                <div class="field">
                    <label for="temper">Характер</label>
                    <div class="ui input @if(!$edit_access) disabled @endif" >
                        <textarea rows="4" name="temper" id="temper">{{!is_null($Petsdata['temper'])?$Petsdata['temper']:''}}</textarea>
                    </div>
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
                                                    <div class="ui input @if(!$edit_access) disabled @endif">
                                                        <input name="mark_sterilization" id="mark_sterilization" type="text" placeholder="" value="{{$Petsdata['mark_sterilization']}}">
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td style="text-align: right;">
                                            <label for="mark_sterilization" style="padding-left: 15px;">Врач</label>
                                        </td>
                                        <td>
                                            <div class="field">
                                                <div class="ui selection dropdown @if(!$edit_access) disabled @endif my_dropdown vet">
                                                    <input type="hidden" name="vet_id" id="vet_id" value="{{$Petsdata['vet_id']}}">
                                                    <i class="dropdown icon"></i>
                                                    <div class="default text">Врач</div>
                                                    <div class="menu">
                                                    </div>
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
                                                <div class="ui input @if(!$edit_access) disabled @endif">
                                                    <input name="catch_order" id="catch_order" type="text" placeholder="" value="{{$Petsdata['catch_order']}}">
                                                </div>
                                            </div>
                                        </td>
                                        <td style="text-align: right;">
                                            <label for="catch_date_order" style="padding-left: 15px;">Дата заказ-наряда</label>
                                        </td>
                                        <td>
                                            <div class="field">
                                                <div class="ui icon input @if(!$edit_access) disabled @endif">
                                                    <input class="my_calendar_input" type="text" name="catch_date_order" id="catch_date_order" value="{{strtotime($Petsdata['catch_date_order'])!==false?date('d.m.Y',strtotime($Petsdata['catch_date_order'])):''}}">
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
                                                <div class="ui input @if(!$edit_access) disabled @endif">
                                                    <input name="catch_akt" id="catch_akt" type="text" placeholder="" value="{{$Petsdata['catch_akt']}}">
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
                                                <div class="ui input @if(!$edit_access) disabled @endif">
                                                    <input name="catch_address" id="catch_address" type="text" placeholder="" value="{{$Petsdata['catch_address']}}">
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
                                                <div class="ui input @if(!$edit_access) disabled @endif">
                                                    <input name="own_entity_name" id="own_entity_name" type="text" placeholder="" value="{{$Petsdata['own_entity_name']}}">
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
                                                <div class="ui input @if(!$edit_access) disabled @endif">
                                                    <input name="own_fio" id="own_fio" type="text" placeholder="" value="{{$Petsdata['own_fio']}}">
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
                                                <div class="ui input @if(!$edit_access) disabled @endif">
                                                    <input name="own_address" id="own_address" type="text" placeholder="" value="{{$Petsdata['own_address']}}">
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
                                                <div class="ui input @if(!$edit_access) disabled @endif">
                                                    <input name="own_telephone" id="own_telephone" type="text" placeholder="" value="{{$Petsdata['own_telephone']}}">
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
                                    @foreach($TreatmentData as $key=>$treat)
                                        <tr class="treatment_row">
                                            <td style="text-align: right;">
                                                <label style="padding-left: 15px;">Дата обработки</label>
                                            </td>
                                            <td>
                                                <div class="field" style="/*width: 300px;*/">
                                                    <div class="ui icon input @if(!$edit_access) disabled @endif">
                                                        <input class="my_calendar_input" type="text" name="treatment_date[]" value="{{strtotime($treat['event_date'])!==false?date('d.m.Y',strtotime($treat['event_date'])):''}}">
                                                        <i class="calendar icon"></i>
                                                    </div>
                                                </div>
                                            </td>
                                            <td style="text-align: right;">
                                                <label style="padding-left: 15px;">Препарат</label>
                                            </td>
                                            <td>
                                                <div class="field" style="/*width: 300px;*/">
                                                    <div class="ui input @if(!$edit_access) disabled @endif">
                                                        <input name="treatment_drug[]"  type="text" placeholder="" value="{{$treat['drug']}}">
                                                    </div>
                                                </div>
                                            </td>
                                            <td style="text-align: right;">
                                                <label style="padding-left: 15px;">Доза</label>
                                            </td>
                                            <td>
                                                <div class="field" style="/*width: 300px;*/">
                                                    <div class="ui input @if(!$edit_access) disabled @endif">
                                                        <input name="treatment_dose[]"  type="text" placeholder="" value="{{$treat['dose']}}">
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                @if($edit_access)
                                                <i class="ui icon big green plus treatment_add"></i>
                                                <i class="ui icon big red x treatment_remove"></i>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    @if(count($TreatmentData)==0)
                                        <tr class="treatment_row">
                                            <td style="text-align: right;">
                                                <label style="padding-left: 15px;">Дата обработки</label>
                                            </td>
                                            <td>
                                                <div class="field" style="/*width: 300px;*/">
                                                    <div class="ui icon input @if(!$edit_access) disabled @endif">
                                                        <input class="my_calendar_input" type="text" name="treatment_date[]" >
                                                        <i class="calendar icon"></i>
                                                    </div>
                                                </div>
                                            </td>
                                            <td style="text-align: right;">
                                                <label style="padding-left: 15px;">Препарат</label>
                                            </td>
                                            <td>
                                                <div class="field" style="/*width: 300px;*/">
                                                    <div class="ui input @if(!$edit_access) disabled @endif">
                                                        <input name="treatment_drug[]"  type="text" placeholder="" >
                                                    </div>
                                                </div>
                                            </td>
                                            <td style="text-align: right;">
                                                <label style="padding-left: 15px;">Доза</label>
                                            </td>
                                            <td>
                                                <div class="field" style="/*width: 300px;*/">
                                                    <div class="ui input @if(!$edit_access) disabled @endif">
                                                        <input name="treatment_dose[]"  type="text" placeholder="" >
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                @if($edit_access)
                                                    <i class="ui icon big green plus treatment_add"></i>
                                                    <i class="ui icon big red x treatment_remove"></i>
                                                @endif
                                            </td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="ui tab" data-tab="tab-data5">
                            <div class="ui table">
                                <table>
                                    <tbody>
                                    @foreach($VacData as $key=>$vac)
                                        <tr class="vac_row">
                                            <td style="text-align: right;">
                                                <label style="padding-left: 15px;">Дата</label>
                                            </td>
                                            <td>
                                                <div class="field" style="/*width: 300px;*/">
                                                    <div class="ui icon input @if(!$edit_access) disabled @endif">
                                                        <input class="my_calendar_input" type="text" name="vac_date[]" value="{{strtotime($vac['event_date'])!==false?date('d.m.Y',strtotime($vac['event_date'])):''}}">
                                                        <i class="calendar icon"></i>
                                                    </div>
                                                </div>
                                            </td>
                                            <td style="text-align: right;">
                                                <label style="padding-left: 15px;">Вид вакцины</label>
                                            </td>
                                            <td>
                                                <div class="field" style="/*width: 300px;*/">
                                                    <div class="ui input @if(!$edit_access) disabled @endif">
                                                        <input name="vac_type[]"  type="text" placeholder="" value="{{$vac['type']}}">
                                                    </div>
                                                </div>
                                            </td>
                                            <td style="text-align: right;">
                                                <label style="padding-left: 15px;">№ Серии</label>
                                            </td>
                                            <td>
                                                <div class="field" style="/*width: 300px;*/">
                                                    <div class="ui input @if(!$edit_access) disabled @endif">
                                                        <input name="vac_serial[]"  type="text" placeholder="" value="{{$vac['serial']}}">
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                @if($edit_access)
                                                <i class="ui icon big green plus vac_add"></i>
                                                <i class="ui icon big red x vac_remove"></i>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    @if(count($VacData)==0)
                                        <tr class="vac_row">
                                            <td style="text-align: right;">
                                                <label style="padding-left: 15px;">Дата</label>
                                            </td>
                                            <td>
                                                <div class="field" style="/*width: 300px;*/">
                                                    <div class="ui icon input @if(!$edit_access) disabled @endif">
                                                        <input class="my_calendar_input" type="text" name="vac_date[]" >
                                                        <i class="calendar icon"></i>
                                                    </div>
                                                </div>
                                            </td>
                                            <td style="text-align: right;">
                                                <label style="padding-left: 15px;">Вид вакцины</label>
                                            </td>
                                            <td>
                                                <div class="field" style="/*width: 300px;*/">
                                                    <div class="ui input @if(!$edit_access) disabled @endif">
                                                        <input name="vac_type[]"  type="text" placeholder="" >
                                                    </div>
                                                </div>
                                            </td>
                                            <td style="text-align: right;">
                                                <label style="padding-left: 15px;">№ Серии</label>
                                            </td>
                                            <td>
                                                <div class="field" style="/*width: 300px;*/">
                                                    <div class="ui input @if(!$edit_access) disabled @endif">
                                                        <input name="vac_serial[]"  type="text" placeholder="" >
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                @if($edit_access)
                                                    <i class="ui icon big green plus vac_add"></i>
                                                    <i class="ui icon big red x vac_remove"></i>
                                                @endif
                                            </td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="ui tab" data-tab="tab-data6">
                            <div class="ui table">
                                <table>
                                    <tbody>
                                    @foreach($InspectData as $key=>$inspect)
                                        <tr class="inspect_row">
                                            <td style="text-align: right;">
                                                <label style="padding-left: 15px;">Дата осмотра</label>
                                            </td>
                                            <td>
                                                <div class="field" style="/*width: 300px;*/">
                                                    <div class="ui icon input @if(!$edit_access) disabled @endif">
                                                        <input class="my_calendar_input" type="text" name="inspect_date[]" value="{{strtotime($inspect['event_date'])!==false?date('d.m.Y',strtotime($inspect['event_date'])):''}}">
                                                        <i class="calendar icon"></i>
                                                    </div>
                                                </div>
                                            </td>
                                            <td style="text-align: right;">
                                                <label style="padding-left: 15px;">Анамнез</label>
                                            </td>
                                            <td width="50%">
                                                <div class="field" style="/*width: 300px;*/">
                                                    <div class="ui input @if(!$edit_access) disabled @endif">
                                                        <textarea name="inspect_description[]"  rows="3">{{!is_null($inspect['description'])?$inspect['description']:''}}</textarea>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                @if($edit_access)
                                                <i class="ui icon big green plus inspect_add"></i>
                                                <i class="ui icon big red x inspect_remove"></i>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    @if(count($InspectData)==0)
                                        <tr class="inspect_row">
                                            <td style="text-align: right;">
                                                <label style="padding-left: 15px;">Дата осмотра</label>
                                            </td>
                                            <td>
                                                <div class="field" style="/*width: 300px;*/">
                                                    <div class="ui icon input @if(!$edit_access) disabled @endif">
                                                        <input class="my_calendar_input" type="text" name="inspect_date[]" value="">
                                                        <i class="calendar icon"></i>
                                                    </div>
                                                </div>
                                            </td>
                                            <td style="text-align: right;">
                                                <label style="padding-left: 15px;">Анамнез</label>
                                            </td>
                                            <td width="50%">
                                                <div class="field" style="/*width: 300px;*/">
                                                    <div class="ui input @if(!$edit_access) disabled @endif">
                                                        <textarea name="inspect_description[]"  rows="3"></textarea>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                @if($edit_access)
                                                    <i class="ui icon big green plus inspect_add"></i>
                                                    <i class="ui icon big red x inspect_remove"></i>
                                                @endif
                                            </td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if($edit_access)
                <div class="ui green button right floated save_card" style="margin: 15px;">Сохранить</div>
            @endif
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
                    .form(/*{
                        fields: {
                            kind_id: 'empty',
                            in_date: 'empty',
                            num_aviary: 'empty',
                            weight: 'empty',
                            breed: 'empty',
                            size: 'empty',
                            birthdate:['length[4]','integer','empty'],
                            color:'empty',
                            wooltype:'empty',
                            eartype:'empty',
                            tailtype:'empty',
                            male:'empty',
                            nickname:'empty',
                            uploading:'empty',//не проверено
                        }
                    }*/);

                /*_this.$body.find('input').on('change',function () {
                    console.log(_this.$body.find('.ui.form.card').form('validate form'));
                    console.log(_this.$body.find('.ui.form.card').serialize()c);
                });*/

                _this.$body.find('.my_calendar_input').datetimepicker({
                    format:'d.m.Y',
                    locale:'ru',
                    timepicker: false
                });

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


                _this.kind=_this.$body.find('.my_dropdown.kind').find('input').val();
                _this.$body.find('.unselected').removeClass('unselected');
                _this.kindChosen();

                _this.$body.find('.unselected').on('click',function () {
                    if($(this).hasClass('unselected')) {
                        _this.$body.find('.my_dropdown.kind').focus();
                    }
                });

                _this.$body.find('.my_dropdown.male').dropdown({transition:'scale'});

                _this.$body.find('.save_card').on('click',function () {
                    if(_this.$body.find('.ui.form.card').form('validate form')) {
                        _this.$winModalConfirm.find('form').form('clear');
                        _this.$winModalConfirm.find('.field_message').html('Вы уверены, что хотите сохранить карточку питомца?');
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
                _this.$body.find('.btn_edit').on('click',function(){
                    $(this).closest('.field').find('.pnl_view').hide();
                    $(this).closest('.field').find('.pnl_edit').show();
                });
                _this.$body.find('.btn_save').on('click',function(){
                    $(this).closest('.field').find('.e_val').html($(this).closest('.field').find('input').val());
                    $(this).closest('.field').find('.pnl_view').show();
                    $(this).closest('.field').find('.pnl_edit').hide();
                });

                /*$(this).dropdown('queryRemote', '', function() {});*/




                _this.treatMent();
                _this.vac();
                _this.inspect();
                _this.dropdownloader();
                setTimeout(function () {
                    $.each(_this.$body.find('.my_dropdown'),function(){
                        $(this).dropdown('set selected',$(this).find('input').val());
                    });
                },500);
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
            dropdownloader() {
                let _this = this;
                _this.$body = $(_this.body);
                let tail_val=_this.$body.find('.my_dropdown.tailtype input').val();
                let tailtype_table = "";
                $.ajax({
                    method: "POST",
                    url: "/pet/route",
                    data: {
                        getTailtypes: true
                    }
                }).then(function (result) {
                    $.each(result.data, function (key, row) {
                        tailtype_table += '<div class="item" data-value="' + row['id'] + '">' + row['tailtype_name'] + '</div>';
                    });
                    _this.$body.find('.my_dropdown.tailtype .menu').html(tailtype_table);
                    _this.$body.find('.my_dropdown.tailtype').dropdown({transition: 'scale'});
                    if(tail_val!=""){
                        _this.$body.find('.my_dropdown.tailtype').dropdown('set selected',tail_val);
                    }
                });

                let ear_val=_this.$body.find('.my_dropdown.eartype input').val();
                let eartype_table = "";
                $.ajax({
                    method: "POST",
                    url: "/pet/route",
                    data: {
                        getEartypes: true
                    }
                }).then(function (result) {
                    $.each(result.data, function (key, row) {
                        eartype_table += '<div class="item" data-value="' + row['id'] + '">' + row['eartype_name'] + '</div>';
                    });
                    _this.$body.find('.my_dropdown.eartype .menu').html(eartype_table);
                    _this.$body.find('.my_dropdown.eartype').dropdown({transition: 'scale'});
                    if(ear_val!=""){
                        _this.$body.find('.my_dropdown.eartype').dropdown('set selected',ear_val);
                    }
                });
                let size_val=_this.$body.find('.my_dropdown.size input').val();
                let size_table = "";
                $.ajax({
                    method: "POST",
                    url: "/pet/route",
                    data: {
                        getSizes: true
                    }
                }).then(function (result) {
                    $.each(result.data, function (key, row) {
                        size_table += '<div class="item" data-value="' + row['value'] + '">' + row['name'] + '</div>';
                    });
                    _this.$body.find('.my_dropdown.size .menu').html(size_table);
                    _this.$body.find('.my_dropdown.size').dropdown({transition: 'scale'});
                    if(size_val!=""){
                        _this.$body.find('.my_dropdown.size').dropdown('set selected',size_val);
                    }
                });
                let state_val=_this.$body.find('.my_dropdown.state_id input').val();
                let state_table = "";
                $.ajax({
                    method: "POST",
                    url: "/pet/route",
                    data: {
                        getStates: true
                    }
                }).then(function (result) {
                    $.each(result.data, function (key, row) {
                        state_table += '<div class="item" data-value="' + row['id'] + '">' + row['state_name'] + '</div>';
                    });
                    _this.$body.find('.my_dropdown.state_id .menu').html(state_table);
                    _this.$body.find('.my_dropdown.state_id').dropdown({transition: 'scale'});
                    if(state_val!=""){
                        _this.$body.find('.my_dropdown.state_id').dropdown('set selected',state_val);
                    }
                });
                let vet_val=_this.$body.find('.my_dropdown.vet input').val();
                let vet_table = "";
                $.ajax({
                    method: "POST",
                    url: "/pet/route",
                    data: {
                        getVets: true
                    }
                }).then(function (result) {
                    $.each(result.data, function (key, row) {
                        vet_table += '<div class="item" data-value="' + row['id'] + '">' + row['vet_name'] + '</div>';
                    });
                    _this.$body.find('.my_dropdown.vet .menu').html(vet_table);
                    _this.$body.find('.my_dropdown.vet').dropdown({transition: 'scale'});
                    if(vet_val!=""){
                        _this.$body.find('.my_dropdown.state_id').dropdown('set selected',vet_val);
                    }
                });

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

