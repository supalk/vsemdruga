<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LibController extends Controller
{
    use SubController;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function page(Request $request, $name)
    {
        $this->init('lib.' . $name);
        $group = 'lib.' . $name;

        if ($this->isAccess([$group])) {
            $this->addParam('act_menu','lib');
            return view($group, $this->getParams());
        } else
            return view('error',['error'=>'Доступ запрещён!']);
    }

    public function list(Request $request, $name)
    {
        $input = $request->all();
        $data['input']=$input;
        $data['status'] = true;
        $group = 'lib.' . $name;
        $this->isAccess([$group]);
        $qr = null;
        switch ($name) {
            case 'kind':
                $qr = DB::table('lib_kinds');
                if (isset($input['type']) && $input['type'] == 'dropdown')
                    $qr->select(['id as value', 'kind_name as name']);
                if (isset($input['q']) && $input['q']!=''){
                    $qr->where('kind_name','LIKE','%'.$input['q'].'%');
                }
                break;
            case 'breed':
                $qr = DB::table('lib_breeds');
                if (isset($input['type']) && $input['type'] == 'dropdown')
                    $qr->select(['id as value', 'breed_name as name']);
                else if (isset($input['type']) && $input['type'] == 'table')
                    $qr->select(['id', 'kind_id','breed_name as name', 'created_at', 'updated_at']);
                if (isset($input['kind']))
                    $qr->where('kind_id', '=', $input['kind']);
                if (isset($input['q']) && $input['q']!=''){
                    $qr->where('breed_name','LIKE','%'.$input['q'].'%');
                }
                break;
            case 'coloring':
                $qr = DB::table('lib_colorings');
                if (isset($input['type']) && $input['type'] == 'dropdown')
                    $qr->select(['id as value', 'coloring_name as name']);
                else if (isset($input['type']) && $input['type'] == 'table')
                    $qr->select(['id', 'kind_id','coloring_name as name', 'created_at', 'updated_at']);
                if (isset($input['kind']))
                    $qr->where('kind_id', '=', $input['kind']);
                if (isset($input['q']) && $input['q']!=''){
                    $qr->where('coloring_name','LIKE','%'.$input['q'].'%');
                }

                break;
            case 'wooltype':
                $qr = DB::table('lib_wooltypes');
                if (isset($input['type']) && $input['type'] == 'dropdown')
                    $qr->select(['id as value', 'wooltype_name as name']);
                else if (isset($input['type']) && $input['type'] == 'table')
                    $qr->select(['id', 'kind_id','wooltype_name as name', 'created_at', 'updated_at']);
                if (isset($input['kind']))
                    $qr->where('kind_id', '=', $input['kind']);
                if (isset($input['q']) && $input['q']!=''){
                    $qr->where('wooltype_name','LIKE','%'.$input['q'].'%');
                }

                break;
            case 'reason_death':
                $qr = DB::table('lib_reason_deaths');
                if (isset($input['type']) && $input['type'] == 'dropdown')
                    $qr->select(['id as value', 'death_name as name']);
                else if (isset($input['type']) && $input['type'] == 'table')
                    $qr->select(['id', 'death_name as name', 'created_at', 'updated_at']);
                if (isset($input['q']) && $input['q']!=''){
                    $qr->where('death_name','LIKE','%'.$input['q'].'%');
                }

                break;
            case 'reason_euthanasia':
                $qr = DB::table('lib_reason_euthanasias');
                if (isset($input['type']) && $input['type'] == 'dropdown')
                    $qr->select(['id as value', 'euthanasia_name as name']);
                else if (isset($input['type']) && $input['type'] == 'table')
                    $qr->select(['id', 'euthanasia_name as name', 'created_at', 'updated_at']);
                if (isset($input['q']) && $input['q']!=''){
                    $qr->where('euthanasia_name','LIKE','%'.$input['q'].'%');
                }

                break;
            case 'reason_leaving':
                $qr = DB::table('lib_reason_leavings');
                if (isset($input['type']) && $input['type'] == 'dropdown')
                    $qr->select(['id as value', 'leaving_name as name']);
                else if (isset($input['type']) && $input['type'] == 'table')
                    $qr->select(['id', 'leaving_name as name', 'created_at', 'updated_at']);
                if (isset($input['q']) && $input['q']!=''){
                    $qr->where('leaving_name','LIKE','%'.$input['q'].'%');
                }

                break;
            default:
                $qr = DB::table('lib_'.$name.'s');
                if (isset($input['type']) && $input['type'] == 'dropdown')
                    $data['data'] = $qr->select(['id as value', $name.'_name as name']);
                else if (isset($input['type']) && $input['type'] == 'table')
                    $data['data'] = $qr->select(['id', $name.'_name as name', 'created_at', 'updated_at']);
                if (isset($input['q']) && $input['q']!=''){
                    $qr->where($name.'_name','LIKE','%'.$input['q'].'%');
                }

                break;

        }
        if ($qr) $data['data'] = $qr->get();
        $data['recordsTotal']=count($data['data']);
        //  $data['input'] = $input;


        return response()->json($data);
    }


    public function Save(Request $request, $name)
    {
        $input = $request->all();
        $data['status'] = false;
        $tbl = "lib_".$name."s";
        try {
            $id = $input['id'];
            unset($input['id']);
            if ($id > 0) {
                $input['updated_at'] = date('Y-m-d H:i:s');
                DB::table($tbl)->where('id',$id)->update($input);
            }else{
                $input['created_at'] = date('Y-m-d H:i:s');
                $id = DB::table($tbl)->insertGetId($input);
            }
            $data['status'] = true;
            $data['id'] = $id;
            $data['message'] = 'Данные успешно сохранены!';
        }
        catch (\Exception $e){
            $data['errors'][]=["message"=>"Error:".$e->getMessage()];
        }
        return response()->json($data,isset($data['errors'])?400:200);
    }

}