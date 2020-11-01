<?php


namespace App\Http\Controllers;


use App\Models\Lib_district;
use App\Models\Lib_organization;
use App\Models\Lib_size;
use App\Models\Lib_subordination;
use App\Models\Pet_inspection;
use App\Models\Pet_state;
use App\Models\Pet_vaccination;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

/**
 * Работа с реестром
 * Class CatalogController
 * @package App\Http\Controllers
 */
class CatalogController extends Controller
{
    use SubController;

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     *
     * @param Request $request
     * @return Factory|Application|View
     */
    public function page(Request $request)
    {
        $this->init('catalog');
        $this->addParam('states', Pet_state::all());
        $this->addParam('district', Lib_district::all());
        $this->addParam('shelter', Lib_organization::where('org_type',1)->select(['id','name'])->get());
        $this->addParam('subord', Lib_organization::where('org_type',3)->select(['id','name'])->get());

        return view('catalog', $this->getParams());

    }

    /**
     * Получение реестра животных по фильтрам и сортировки
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function list(Request $request)
    {

        $input = $request->all();
        $draw = $input['draw'];
        $columns = isset($input['columns']) ? $input['columns'] : [];
        $order = isset($input['order']) ? $input['order'] : '';

        /*
                $columns
                    [data] => id
                        [name] =>
                        [searchable] => true
                        [orderable] => true
                        [search] => Array
                        (
                            [value] =>
                                [regex] => false
                        )
                $order
                [0] => Array
                    (
                        [column] => 1
                        [dir] => asc
                    )

        */
        $qr = DB::table('petsdata');
        $s = '';
        foreach ($order as $or) {
            $field = $columns[$or['column']]['data'];
            $qr->orderBy($field, $or['dir']);
        }

        //Фильтрация

        if ($input['state_bid'] != '') {
            $qr->whereIn('state_id', explode(',', $input['state_bid']));
        }
        if ($input['male'] != '') {
            $qr->where('male', '=', $input['male'] == 1 ? 1 : 0);
        }
        if ($input['kind_id'] != '') {
            $qr->where('kind_id', '=', $input['kind_id']);
        }
        if ($input['breed_id'] != '') {
            $qr->whereIn('breed_id', explode(',', $input['breed_id']));
        }
        if ($input['coloring_id'] != '') {
            $qr->whereIn('coloring_id', explode(',', $input['coloring_id']));
        }
        if ($input['ind_label'] != '') {
            $qr->where('ind_label', 'ILIKE', '%' . $input['ind_label'] . '%');
        }
        if ($input['mark_sterilization'] != '') {
            $qr->where('mark_sterilization', 'ILIKE', '%' . $input['mark_sterilization'] . '%');
        }
        if ($input['nickname'] != '') {
            $qr->where('nickname', 'ILIKE', '%' . $input['nickname'] . '%');
        }
        if ($input['num_card'] != '') {
            $qr->where('num_card', 'ILIKE', '%' . $input['num_card'] . '%');
        }
        if ($input['vacc'] != '') {
            $pet = Pet_vaccination::where('type', 'ILIKE', '%' . $input['vacc'] . "%")->pluck('pet_id')->toArray();
            $qr->whereIn('id', $pet);
        }
        if ($input['insp'] != '') {
            $pet = Pet_inspection::where('description', 'ILIKE', '%' . $input['insp'] . "%")->pluck('pet_id')->toArray();
            $qr->whereIn('id', $pet);
        }
        if ($input['in_date_beg'] != '' && $input['in_date_beg'] != 'Invalid date' && $input['in_date_beg'] != $input['in_date_end']) {
            $qr->whereRaw("in_date::date >='" . date('Y-m-d', strtotime($input['in_date_beg'])) . "'");
            $qr->whereRaw("in_date::date <='" . date('Y-m-d', strtotime($input['in_date_end'])) . "'");
        }
        if (Auth::User()->organization->org_type == 1){
            $qr->where('shelter_id', '=', Auth::User()->org_id);
        }else{
            if ($input['district'] != '') {
                $qr->whereIn("org_district_id", explode(',', $input['district']));
            }
            if ($input['shelter'] != '') {
                $qr->whereIn("shelter_id", explode(',', $input['shelter']));
            }
            if ($input['subord'] != '') {
                $selters = DB::table('org_subord')->whereIn('id', explode(',',$input['subord']))->where('org_type', 1)->pluck('org_id')->toArray();
                $qr->whereIn("shelter_id", explode(',', $selters));
            }



        }
        $limit = $input['length'];
        $start = $input['start'];


        try {

            $result = array(
                'draw' => $draw,
                'success' => true
            );
            $result['sql'] = $qr->toSql();
            $kol_all = $qr->count();
            $data = $qr->skip($start)->take($limit)->get();
            foreach ($data as $it) {
                $it->vacc = implode('<br>',Pet_vaccination::where('pet_id', '=', $it->id)
                    ->pluck('type')->toArray());
                $it->insp = implode('<br>',Pet_inspection::where('pet_id', '=', $it->id)
                    ->pluck('description')->toArray());
                if (Auth::User()->organization->org_type!=1) {
                    //type 3 - Эксплуатирующая организация
                    $sub= DB::table('org_subord')->select('id')->where('org_id', $it->shelter_id)->where('org_type', 3)->first();
                    $it->sub_org =Lib_organization::where('id',$sub->id)->value('name');
                }
            }
            $result['data'] = $data;
            $result['recordsTotal'] = $kol_all;
            $result['recordsFiltered'] = $kol_all;


        } catch (\Exception $err) {
            $result = array(
                'recordsTotal' => 0,
                'recordsFiltered' => 0,
                'data' => [],
                'draw' => $draw,
                'success' => false,
                'error' => $err->getMessage()
            );

        }

        //$qr->select(["id","num_card","in_date","ind_label","kind_name","male","nickname","year_birth","breed_name","coloring_name",""]);


        return response()->json($result);
    }


    public function Save(Request $request, $name)
    {
        $input = $request->all();
        $data['status'] = false;
        $tbl = "lib_" . $name . "s";
        try {
            $id = $input['id'];
            unset($input['id']);
            if ($id > 0) {
                $input['updated_at'] = date('Y-m-d H:i:s');
                DB::table($tbl)->where('id', $id)->update($input);
            } else {
                $input['created_at'] = date('Y-m-d H:i:s');
                $id = DB::table($tbl)->insertGetId($input);
            }
            $data['status'] = true;
            $data['id'] = $id;
            $data['message'] = 'Данные успешно сохранены!';
        } catch (\Exception $e) {
            $data['errors'][] = ["message" => "Error:" . $e->getMessage()];
        }
        return response()->json($data, isset($data['errors']) ? 400 : 200);
    }

}