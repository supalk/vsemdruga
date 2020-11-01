<?php
/**
 * UPLOAD FILES
 * User: SuprunAK
 * Date: 21.09.2020
 * Time: 11:22
 */

namespace App\Helpers;
use App\Models\Lib_district;
use App\Models\Lib_organization;
use Carbon\Carbon;
use PHPExcel_Settings;
use PHPExcel_IOFactory;
use PHPExcel_Cell;
use PHPExcel_Style_Border;
use App\Models\Petsdata;
use App\Models\Pet;
use Illuminate\Support\Facades\DB;

class Reports
{
    private static $dir_main = '/files/report/';
    private static $dir_photo = '/files/';

    public static function monthes($num){
        $monthes=['','Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'];
        return $monthes[$num];
    }

    //возраст
    public static function old($date){
        $start=Carbon::parse($date);
        $end=Carbon::parse();
        $monthes_result=$end->diffInMonths($start);
        $monthes=$monthes_result%12;
        $years=($monthes_result-$monthes)/12;
        return ($years.' лет '.$monthes.' месяцев');
    }

    public static function report3($id){
        $templateFile="/templates/prilozh_3.docx";
        $phpWord= new \PhpOffice\PhpWord\TemplateProcessor(storage_path($templateFile));


        $pre_data=Petsdata::where('id','=',$id)->get();
        $data=$pre_data[0];
        $phpWord->setValue('date_day', date('d'));
        $phpWord->setValue('date_month', self::monthes(date('n')));
        $phpWord->setValue('date_year', date('y'));
        $phpWord->setValue('num_card', $data->num_card);
        $phpWord->setImageValue('image',
            ['path'=>base_path().self::$dir_photo.$data['photo'],
                'width'=>200,'height'=>200,'ratio'=>true
            ]
        );
        $phpWord->setValue('shelter_address', $data->org_address);
        $phpWord->setValue('shelter_name', $data->org_name);
        $phpWord->setValue('num_aviary', $data->num_aviary);
        $phpWord->setValue('kind_name', $data->kind_name);
        $phpWord->setValue('old', self::old($data->year_birth));
        $phpWord->setValue('weight', $data->weight);
        $phpWord->setValue('nickname', $data->nickname);
        $phpWord->setValue('male', $data->male?'Cамец':'Самка');
        $phpWord->setValue('breed_name', $data->breed_name);
        $phpWord->setValue('coloring_name', $data->coloring_name);
        $phpWord->setValue('wooltype_name', $data->wooltype_name);
        $phpWord->setValue('eartype_name', $data->eartype_name);
        $phpWord->setValue('tailtype_name', $data->tailtype_name);
        $phpWord->setValue('size_name', $data->size_name);
        $phpWord->setValue('specials', $data->specials);
        $phpWord->setValue('temper', $data->temper);
        $phpWord->setValue('ind_label', $data->ind_label);
        $phpWord->setValue('mark_sterilization', $data->mark_sterilization);
        $phpWord->setValue('is_state2', $data->state_id>1?'Да':'Нет');
        $phpWord->setValue('catch_order', $data->catch_order);
        $phpWord->setValue('catch_day', date('d',strtotime($data->catch_date_order)));
        $phpWord->setValue('catch_month', self::monthes(date('n',strtotime($data->catch_date_order))));
        $phpWord->setValue('catch_year', date('y',strtotime($data->catch_date_order)));
        $phpWord->setValue('catch_akt', $data->catch_akt);
        $phpWord->setValue('catch_address', $data->catch_address);

        header('Content-Type: application/vnd.ms-word');
        header('Content-Type: application/docx');
        header('Content-Disposition: attachment;filename="Карточка-'.$id.'.docx"');
        $phpWord->saveAs('php://output');
        die();
    }

    public static function report4($shelter_id){
        $templateFile="/templates/prilozh_4.xlsx";
        $objPHPExcel=PHPExcel_IOFactory::load(storage_path($templateFile));
        $objPHPExcel->setActiveSheetIndex(0);

        $pre_data=Petsdata::where('shelter_id','=',$shelter_id)->get();

        $explorg=DB::table('lib_organizations')->select('lib_organizations.name')
            ->join('lib_subordinations','lib_organizations.id','=','lib_subordinations.parent_org_id')->where('lib_subordinations.org_id','=',$shelter_id)->get();
/*dd($explorg[0]->name);*/

        $counter=1;
        $start_row=9;
        $cur_row=$start_row;
        $objPHPExcel->getActiveSheet()->setCellValue('C5', $pre_data[0]['org_address']);
        $objPHPExcel->getActiveSheet()->setCellValue('C6', $explorg[0]->name);
        $objPHPExcel->getActiveSheet()->setCellValue('F3', date('d.m.Y'));

        $fields_main_list=['B'=>'num_card','C'=>'nickname','D'=>'kind_name','E'=>'male','F'=>'ind_label','G'=>'in_date'];
        foreach($pre_data as $key=>$data){
            $objPHPExcel->getActiveSheet()->setCellValue('A' . $cur_row, $counter);
            $objPHPExcel->getActiveSheet()->setCellValue('B' . $cur_row, $data['num_card']);
            $objPHPExcel->getActiveSheet()->setCellValue('C' . $cur_row, $data['nickname']);
            $objPHPExcel->getActiveSheet()->setCellValue('D' . $cur_row, $data['kind_name']);
            $objPHPExcel->getActiveSheet()->setCellValue('E' . $cur_row, $data['male']?'Самец':'Самка');
            $objPHPExcel->getActiveSheet()->setCellValue('F' . $cur_row, '`'.$data['ind_label']);
            $objPHPExcel->getActiveSheet()->setCellValue('G' . $cur_row, strtotime($data['in_date'])!==false?date('d.m.Y',strtotime($data['in_date'])):'');

            $cur_row++;
            $counter++;
        }
        $styleFontItog = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );
        $objPHPExcel->getActiveSheet()->getStyle("A".($start_row).":G".($cur_row-1))->applyFromArray($styleFontItog);
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Type: application/xlsx');
        header('Content-Disposition: attachment;filename="Выгрузка-'.$shelter_id.'.xlsx"');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
        die();
    }

    public static function report6($district_id,$from_date,$to_date){
        $templateFile="/templates/prilozh_6.xlsx";
        $objPHPExcel=PHPExcel_IOFactory::load(storage_path($templateFile));
        $objPHPExcel->setActiveSheetIndex(0);

        $pre_data=self::getDataForReport6($district_id,$from_date,$to_date);

        $start_row=9;
        $cur_row=$start_row;


        $start=0;
        $start_2=0;
        $start_1=0;
        $income=0;
        $income_2=0;
        $income_1=0;
        $outcome=0;
        $outcome_2=0;
        $outcome_1=0;
        $end=0;
        $end_2=0;
        $end_1=0;
        $string_names_orgs="";

        foreach($pre_data as $key=>$data){
            $objPHPExcel->getActiveSheet()->insertNewRowBefore($cur_row+1,1);
            $string_names_orgs.=$data['name'].',';
            $objPHPExcel->getActiveSheet()->setCellValue('A' . $cur_row, $data['name']);
            $objPHPExcel->getActiveSheet()->setCellValue('B' . $cur_row, $data['start']);
            $objPHPExcel->getActiveSheet()->setCellValue('C' . $cur_row, $data['start_2']);
            $objPHPExcel->getActiveSheet()->setCellValue('D' . $cur_row, $data['start_1']);
            $objPHPExcel->getActiveSheet()->setCellValue('E' . $cur_row, $data['income']);
            $objPHPExcel->getActiveSheet()->setCellValue('F' . $cur_row, $data['income_2']);
            $objPHPExcel->getActiveSheet()->setCellValue('G' . $cur_row, $data['income_1']);
            $objPHPExcel->getActiveSheet()->setCellValue('H' . $cur_row, $data['outcome']);
            $objPHPExcel->getActiveSheet()->setCellValue('I' . $cur_row, $data['outcome_2']);
            $objPHPExcel->getActiveSheet()->setCellValue('J' . $cur_row, $data['outcome_1']);
            $objPHPExcel->getActiveSheet()->setCellValue('K' . $cur_row, $data['end']);
            $objPHPExcel->getActiveSheet()->setCellValue('L' . $cur_row, $data['end_2']);
            $objPHPExcel->getActiveSheet()->setCellValue('M' . $cur_row, $data['end_1']);

            $start+=$data['start'];
            $start_1+=$data['start_1'];
            $start_2+=$data['start_2'];
            $income+=$data['income'];
            $income_1+=$data['income_1'];
            $income_2+=$data['income_2'];
            $outcome+=$data['outcome'];
            $outcome_1+=$data['outcome_1'];
            $outcome_2+=$data['outcome_2'];
            $end+=$data['end'];
            $end_1+=$data['end_1'];
            $end_2+=$data['end_2'];
            $cur_row++;
        }

        $objPHPExcel->getActiveSheet()->setCellValue('F3', date('d.m.Y'));
        $objPHPExcel->getActiveSheet()->setCellValue('A' . $cur_row, 'Итого');
        $objPHPExcel->getActiveSheet()->setCellValue('B' . $cur_row, $start);
        $objPHPExcel->getActiveSheet()->setCellValue('C' . $cur_row, $start_1);
        $objPHPExcel->getActiveSheet()->setCellValue('D' . $cur_row, $start_2);
        $objPHPExcel->getActiveSheet()->setCellValue('E' . $cur_row, $income);
        $objPHPExcel->getActiveSheet()->setCellValue('F' . $cur_row, $income_2);
        $objPHPExcel->getActiveSheet()->setCellValue('G' . $cur_row, $income_1);
        $objPHPExcel->getActiveSheet()->setCellValue('H' . $cur_row, $outcome);
        $objPHPExcel->getActiveSheet()->setCellValue('I' . $cur_row, $outcome_2);
        $objPHPExcel->getActiveSheet()->setCellValue('J' . $cur_row, $outcome_1);
        $objPHPExcel->getActiveSheet()->setCellValue('K' . $cur_row, $end);
        $objPHPExcel->getActiveSheet()->setCellValue('L' . $cur_row, $end_2);
        $objPHPExcel->getActiveSheet()->setCellValue('M' . $cur_row, $end_1);

        $objPHPExcel->getActiveSheet()->setCellValue('E2' , trim($string_names_orgs,','));
        $districts=Lib_district::where('id','=',$district_id)->get();
        $objPHPExcel->getActiveSheet()->setCellValue('B4' , $districts[0]['district_name']);
        $objPHPExcel->getActiveSheet()->setCellValue('B5' , date('d',strtotime($from_date)));
        $objPHPExcel->getActiveSheet()->setCellValue('C5' , date('m',strtotime($from_date)));
        $objPHPExcel->getActiveSheet()->setCellValue('D5' , date('Y',strtotime($from_date)));
        $objPHPExcel->getActiveSheet()->setCellValue('F5' , date('d',strtotime($to_date)));
        $objPHPExcel->getActiveSheet()->setCellValue('G5' , date('m',strtotime($to_date)));
        $objPHPExcel->getActiveSheet()->setCellValue('H5' , date('Y',strtotime($to_date)));

        /*$objPHPExcel->getActiveSheet()->fromArray($cellValues, null, 'A'.($cur_row+2));
        $objPHPExcel->getActiveSheet()->getStyle("A".($cur_row+2).":M".($cur_row+3))->applyFromArray($cellValues);
        $objPHPExcel->getActiveSheet()->duplicateStyle($objPHPExcel->getActiveSheet()->getStyle('N6:Z7'), 'A'.($cur_row+2).':M'.($cur_row+3));*/
        $styleFontItog = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );


        $objPHPExcel->getActiveSheet()->getStyle("A".($start_row).":M".($cur_row))->applyFromArray($styleFontItog);
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Type: application/xlsx');
        header('Content-Disposition: attachment;filename="Выгрузка за период -'.$district_id.'.xlsx"');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
        die();
    }

    public static function getDataForReport6($district_id,$from_date,$to_date){
        if(strtotime($from_date)===false || strtotime($to_date)===false){
            return "incorrect dates";
        }
        //Количество животных в приюте на начало отчётного периода
        //(out_date>date_start OR out_date IS NULL) AND in_date<date_start
        $data[0]=DB::table('pets')->
        select(DB::raw('shelter_id, kind_id, COUNT(id) as counter'))
            ->whereRAW('(out_date>=\''.date('Y-m-d',strtotime($from_date)).'\' OR out_date IS NULL) AND in_date<\''.date('Y-m-d',strtotime($from_date)).'\'
            AND pets.shelter_id in (SELECT id from lib_organizations where district_id='.$district_id.')')->groupBy(['shelter_id','kind_id'])->get();


        //Прибыло в приют в течение отчётного периода, ед.
        //in_date>date_start AND in_date<date_end
        $data[1]=DB::table('pets')->
        select(DB::raw('shelter_id, kind_id, COUNT(id) as counter'))
            ->whereRAW('in_date>=\''.date('Y-m-d',strtotime($from_date)).'\' AND in_date<=\''.date('Y-m-d',strtotime($to_date)).'\'
            AND pets.shelter_id in (SELECT id from lib_organizations where district_id='.$district_id.')')->groupBy(['shelter_id','kind_id'])->get();

        //Выбыло из приюта в течение отчётного периода, ед.
        //out_date>date_start AND out_date<date_end
        $data[2]=DB::table('pets')->
        select(DB::raw('shelter_id, kind_id, COUNT(id) as counter'))
            ->whereRAW('out_date>=\''.date('Y-m-d',strtotime($from_date)).'\' AND out_date<=\''.date('Y-m-d',strtotime($to_date)).'\'
            AND pets.shelter_id in (SELECT id from lib_organizations where district_id='.$district_id.')')->groupBy(['shelter_id','kind_id'])->get();

        //Количество животных в приюте на конец отчётного периода, ед.
        //in_date<date_end AND (out_date>date_end or out_date IS NULL)
        $data[3]=DB::table('pets')->
        select(DB::raw('shelter_id, kind_id, COUNT(id) as counter'))
            ->whereRAW('in_date<\''.date('Y-m-d',strtotime($to_date)).'\' AND (out_date>\''.date('Y-m-d',strtotime($to_date)).'\' OR out_date IS NULL) 
            AND pets.shelter_id in (SELECT id from lib_organizations where district_id='.$district_id.')')
            ->groupBy(['shelter_id','kind_id'])->get();
        $result=array();
        foreach($data as $num=>$datum) {
            $magick=['start','income','outcome','end'];
            foreach ($datum as $key => $val) {
                if (!isset($result[$val->shelter_id])) {
                    $org_names = Lib_organization::where('id', '=', $val->shelter_id)->get();
                    $result[$val->shelter_id] = array(
                        'name' => $org_names[0]['name'],
                        'address' => $org_names[0]['address'],
                        'start' => 0,
                        'start_1' => 0,//cat
                        'start_2' => 0,//dog

                        'income' => 0,
                        'income_1' => 0,
                        'income_2' => 0,

                        'outcome' => 0,
                        'outcome_1' => 0,
                        'outcome_2' => 0,

                        'end' => 0,
                        'end_1' => 0,
                        'end_2' => 0,
                    );
                }
                $result[$val->shelter_id][$magick[$num]] += $val->counter;
                $result[$val->shelter_id][$magick[$num].'_' . $val->kind_id] += $val->counter;
                $result[$val->shelter_id][$magick[$num]] += $val->counter;
                $result[$val->shelter_id][$magick[$num].'_' . $val->kind_id] += $val->counter;
            }
        }

        return $result;
    }
}