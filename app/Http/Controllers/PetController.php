<?php


namespace App\Http\Controllers;



use App\Models\Lib_breed;
use App\Models\Lib_kind;
use App\Models\Lib_size;
use App\Models\Lib_coloring;
use App\Models\Lib_wooltype;
use App\Models\Lib_eartype;
use App\Models\Lib_tailtype;
use App\Models\Lib_vet;
use App\Models\Pet;
use App\Models\Pet_state;
use App\Models\Pet_inspection;
use App\Models\Pet_treatment;
use App\Models\Pet_vaccination;
use App\Models\Petsdata;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\Upload;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Reports;

class PetController extends Controller
{
    use SubController;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function add()
    {
        $this->init('pet_add');
        //Проверка на наличие групп
        if (!$this->isAccess(['pet.add']))
            return view('error',['error'=>'Доступ запрещён!']);
        //Добавление переменных для view
        $this->addParam('kinds',Lib_kind::all());


        return view('pet_add', $this->getParams());
    }
    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function edit(Request $request)
    {
        $this->init('pet_edit');
        //Проверка на наличие групп

        //Добавление переменных для view
        $petsdata=Petsdata::where('id','=',$request->segment(2))->get();
        if ($petsdata[0]['shelter_id']!=Auth::user()->organization->id){
            $this->addParam('edit_access',false);
        }elseif (!$this->isAccess(['pet.edit'])){
            $this->addParam('edit_access',false);
        }else{
            $this->addParam('edit_access',true);
        }
        $this->addParam('Petsdata',$petsdata[0]);

        $result=Pet_treatment::where('pet_id','=',$petsdata[0]['id'])->get();
        $this->addParam('TreatmentData',$result);
        $result=Pet_vaccination::where('pet_id','=',$petsdata[0]['id'])->get();
    /*dd($petsdata[0]);*/

        $this->addParam('VacData',$result);
        $result=Pet_inspection::where('pet_id','=',$petsdata[0]['id'])->get();
        $this->addParam('InspectData',$result);

        return view('pet_edit', $this->getParams());
    }

    //маршрутизация функций
    public function routeMe(Request $request){
        $input = $request->all();
        $data['status']=true;
        if (isset($input['searchByIndLabel']) && ($input['searchByIndLabel'])==true){
            $ind_label = trim($input['id']);
            $ind_label = str_replace('.','%',$ind_label);
            $ind_label = str_replace(' ','%',$ind_label);
            $data['data']= Petsdata::where('ind_label','LIKE','%'.$ind_label.'%')->get();
            /*$result=array();
            foreach(Petsdata::where('ind_label','LIKE','%'.$ind_label.'%')->get() as $key=>$val){
                if(!isset($result[$val['kind_id']])){
                    $result[$val['kind_id']]=['name'=>'','results'=>[]];
                }
                $result[$val['kind_id']]['name']=$val['kind_name'];
                $obj=new \stdClass();
                $obj->title="Title1";
                $obj->image="/files/none.png";
                $obj->price="price";
                $obj->description="description";
                $result[$val['kind_id']]['results'][]=$obj;
            }
            $data['data']=$result;*/
        }elseif(isset($input['getKinds']) && ($input['getKinds'])==true) {
            $data['data']=Lib_kind::all();
        }elseif(isset($input['getBreeds']) && ($input['getBreeds'])==true) {
            $data['data']=Lib_breed::where('kind_id','=',$input['kind_id'])->get();
        }elseif(isset($input['getSizes']) && ($input['getSizes'])==true) {
            $data['data'] = Lib_size::all(['id as value','size_name as name']);
        }elseif(isset($input['getColors']) && ($input['getColors'])==true) {
            $data['data']=Lib_coloring::where('kind_id','=',$input['kind_id'])->get();
        }elseif(isset($input['getWooltypes']) && ($input['getWooltypes'])==true) {
            $data['data']=Lib_wooltype::where('kind_id','=',$input['kind_id'])->get();
        }elseif(isset($input['getStates']) && ($input['getStates'])==true) {
            $data['data']=Pet_state::all();
        }elseif(isset($input['getVets']) && ($input['getVets'])==true) {
            $data['data']=Lib_vet::all();
        }elseif(isset($input['getEartypes']) && ($input['getEartypes'])==true) {
            if(isset($input['type']) && ($input['type'])=='dropdown'){
                $data['data'] = Lib_eartype::all(['id as value','eartype_name as name']);
            }else {
                $data['data'] = Lib_eartype::all();
            }
        }elseif(isset($input['getTailtypes']) && ($input['getTailtypes'])==true) {
            if(isset($input['type']) && ($input['type'])=='dropdown'){
                $data['data']=Lib_tailtype::all(['id as value','tailtype_name as name']);
            }else{
                $data['data']=Lib_tailtype::all();
            }
        }elseif(isset($input['newOne']) && ($input['newOne'])==true) {
            $data['input'] = $input;
            $pet = new Pet;
            /*if(isset($input['state_id']))
                $pet->state_id=$input['state_id'];
            else*/
            if ($input['socialized']=='true'){
                $pet->state_id = 2;
            }else{
                $pet->state_id = 1;
            }


            $pet->shelter_id=Auth::user()->organization->id;
            $pet->in_akt=$input['in_akt'];
            $pet->vet_id=$input['vet_id'];
            $pet->num_card=$input['num_card'];
            $pet->mark_sterilization=$input['mark_sterilization'];
            $pet->catch_order=$input['catch_order'];
            $pet->catch_akt=$input['catch_akt'];
            $pet->catch_address=$input['catch_address'];
            $pet->own_entity_name=$input['own_entity_name'];
            $pet->own_fio=$input['own_fio'];
            $pet->own_address=$input['own_address'];
            $pet->own_telephone=$input['own_telephone'];
            $pet->catch_date_order=strtotime($input['catch_date_order'])!==false?date('Y-m-d',strtotime($input['catch_date_order'])):NULL;
            $pet->year_birth=strtotime($input['birthdate'])!==false?date('Y-m-d',strtotime($input['birthdate'])):NULL;
            $pet->breed_id=$input['breed'];
            $pet->coloring_id=$input['color'];
            $pet->in_date=strtotime($input['in_date'])!==false?date('Y-m-d',strtotime($input['in_date'])):NULL;
            $pet->eartype_id=$input['eartype'];
            $pet->ind_label=$input['ind_label'];
            $pet->kind_id=$input['kind_id'];
            $pet->male=$input['male'];
            $pet->nickname=$input['nickname'];
            $pet->num_aviary=$input['num_aviary'];
            $pet->size_id=$input['size'];
            $pet->specials=$input['specials'];
            $pet->tailtype_id=$input['tailtype'];
            $pet->temper=$input['temper'];
            $pet->weight=$input['weight'];
            $pet->wooltype_id=$input['wooltype'];
            $pet->care_worker=$input['care_worker'];
            $pet->user_id=Auth::user()->id;

            /*$pet->vet_id=Auth::user()->id;*/
            if(isset($input['id']) && is_numeric($input['id'])){
                if (!$this->isAccess(['pet.edit']))
                    return view('error',['error'=>'Доступ запрещён!']);
                $pet->id=$input['id'];
                $tdata=$pet->attributesToArray();
                $update=Pet::whereId($pet->id)->update($tdata);
            }else{
                $pet->save();
            }

            if($request->hasFile('files') && is_numeric($pet->id) && (!isset($update) || $update)){
                Pet::whereId($pet->id)->update(['photo'=>Upload::saveFile('photo/'.Auth::user()->organization->id.'/'.$pet->id, $_FILES['files'])]);
            }

            if(is_array($input['treatment_drug']) || $input['treatment_drug']!="") {
                Pet_treatment::where('pet_id', '=', $pet->id)->delete();
                if(is_array($input['treatment_drug'])) {
                    foreach ($input['treatment_drug'] as $key => $val) {
                        if ($val != "") {
                            $treat = new Pet_treatment();
                            $treat->pet_id = $pet->id;
                            $treat->event_date = strtotime($input['treatment_date'][$key]) !== false ? date('Y-m-d', strtotime($input['treatment_date'][$key])) : NULL;
                            $treat->drug = $input['treatment_drug'][$key];
                            $treat->dose = $input['treatment_dose'][$key];
                            $treat->user_id = Auth::user()->id;
                            $treat->save();
                        }
                    }
                }else{
                    $treat = new Pet_treatment();
                    $treat->pet_id = $pet->id;
                    $treat->event_date = strtotime($input['treatment_date']) !== false ? date('Y-m-d', strtotime($input['treatment_date'])) : NULL;
                    $treat->drug = $input['treatment_drug'];
                    $treat->dose = $input['treatment_dose'];
                    $treat->user_id = Auth::user()->id;
                    $treat->save();
                }
            }
            if(is_array($input['vac_type']) || $input['vac_type']!="") {
                Pet_vaccination::where('pet_id', '=', $pet->id)->delete();
                if (is_array($input['vac_type'])) {
                    foreach ($input['vac_type'] as $key => $val) {
                        if ($val != "") {
                            $vac = new Pet_vaccination();
                            $vac->pet_id = $pet->id;
                            $vac->event_date = strtotime($input['vac_date'][$key]) !== false ? date('Y-m-d', strtotime($input['vac_date'][$key])) : NULL;
                            $vac->type = $input['vac_type'][$key];
                            $vac->serial = $input['vac_serial'][$key];
                            $vac->user_id = Auth::user()->id;
                            $vac->save();
                        }
                    }
                }else{
                    $vac = new Pet_vaccination();
                    $vac->pet_id = $pet->id;
                    $vac->event_date = strtotime($input['vac_date']) !== false ? date('Y-m-d', strtotime($input['vac_date'])) : NULL;
                    $vac->type = $input['vac_type'];
                    $vac->serial = $input['vac_serial'];
                    $vac->user_id = Auth::user()->id;
                    $vac->save();
                }
            }
            if(is_array($input['inspect_description']) || $input['inspect_description']!="") {
                Pet_inspection::where('pet_id', '=', $pet->id)->delete();
                if(is_array($input['inspect_description'])) {
                    foreach ($input['inspect_description'] as $key => $val) {
                        if ($val != "") {
                            $inspect = new Pet_inspection();
                            $inspect->pet_id = $pet->id;
                            $inspect->event_date = strtotime($input['inspect_date'][$key]) !== false ? date('Y-m-d', strtotime($input['inspect_date'][$key])) : NULL;
                            $inspect->description = $input['inspect_description'][$key];
                            $inspect->user_id = Auth::user()->id;
                            $inspect->save();
                        }
                    }
                }else{
                    $inspect = new Pet_inspection();
                    $inspect->pet_id = $pet->id;
                    $inspect->event_date = strtotime($input['inspect_date']) !== false ? date('Y-m-d', strtotime($input['inspect_date'])) : NULL;
                    $inspect->description = $input['inspect_description'];
                    $inspect->user_id = Auth::user()->id;
                    $inspect->save();
                }
            }
        }
        $data['success']=true;
        return response()->json($data);
    }

    public function reports(Request $request){
        $input = $request->all();
        $report = new Reports;
        switch ($input['type']) {
            case 3:
                return response()->json($report::report3($input['id']));
                break;
            case 4:
                return response()->json($report::report4($input['shelter_id']));
                break;
            case 6:
                return response()->json($report::report6($input['district_id'],$input['from_date'],$input['to_date']));
                break;
        }

    }

}