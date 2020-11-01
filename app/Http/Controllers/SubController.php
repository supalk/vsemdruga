<?php


namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;

trait SubController
{
    protected $params = [];

    public function getParams()
    {
        return $this->params;
    }

    public function addParam($name, $value)
    {
        $this->params[$name] = $value;
    }

    public function init($name)
    {
        $this->params['user'] = Auth::user();
        $this->params['groups'] = [];
        if (Auth::user()->role)
            $this->params['groups'] = Auth::user()->role->groups->pluck('code')->toArray();
        $this->params['act_menu'] = $name;
        $this->params['menu'] = $this->getMenu($this->dataMenu());
    }

    public function isAccess($groups = [], $strict = true)
    {
        if (!is_array($groups)) $groups = [$groups];
        $user_groups = [];
        if (Auth::user()->role)
            $user_groups = Auth::user()->role->groups->pluck('code')->toArray();
        if (isset($groups[0]) && $groups[0] == '*') return $user_groups;
        if (isset($user_groups)) {
            $intersect = array_intersect($groups, $user_groups);
            if (count($intersect) > 0) {
                if ($strict && count($intersect) == count($groups))
                    return $intersect;
                if (!$strict)
                    return $intersect;
            }
        }
        return false;

    }

    private function getMenu($menus)
    {
        $menu = [];
        foreach ($menus as $i=>$m) {
            //Есть ограничения роли
            if (isset($m['group'])) {
                if ($this->isAccess($m['group'], false) == false) continue;
                unset($m['group']);
            }
            //если меню вложенное
            if (isset($m['items'])) {
                $m['parent'] = true;
                $m['items'] = $this->getMenu($m['items']);
            } else{
                $m["parent"] = false;
            }
            $m['active'] = '';
            if ($m['name'] == $this->params['act_menu']) $m['active'] = 'active';
            $menu[$m['order']] = (object)$m;
        }
        return $menu;
    }

    private function dataMenu()
    {
        return [
            [
                "title" => "Реестр",
                "url" => "/catalog",
                "disable" => 0,
                "name" => "catalog",
                "group" => ['*'],
                "order" => 1
            ],
            [
                "title" => "Добавить в реестр",
                "url" => "/pet/add",
                "disable" => 0,
                "name" => "pet_add",
                "group" => ["pet.add"],
                "order" => 2
            ],
            [
                "title" => "Заявки на опеку",
                "name" => "bids",
                "disable" => 1,
                "url" => "/pet/bids",
                "group" => ["pet.add", "pet.edit"],
                "order" => 3
            ],
            [
                "title" => "Справочники",
                "name" => "lib",
                "disable" => 0,
                "group" => ["lib.org", "lib.sub", "lib.dist", "lib.kind", "lib.breed", "lib.color", "lib.ear", "lib.wool", "lib.tail", "lib.death", "lib.leav", "lib.eauth", "lib.vet"],
                "order" => 4,
                "items" => [
                    [
                        "title" => "Организация",
                        "name" => "lib",
                        "disable" => 1,
                        "url" => "/lib/org",
                        "group" => ["lib.org"],
                        "order" => 1
                    ], [
                        "title" => "Подчинения",
                        "name" => "lib",
                        "disable" => 1,
                        "url" => "/lib/sub",
                        "group" => ["lib.sub"],
                        "order" => 2
                    ], [
                        "title" => "Административный округ",
                        "name" => "lib",
                        "disable" => 1,
                        "url" => "/lib/dist",
                        "group" => ["lib.dist"],
                        "order" => 3
                    ], [
                        "title" => "Вид животных",
                        "name" => "lib",
                        "disable" => 1,
                        "url" => "/lib/kind",
                        "group" => ["lib.kind"],
                        "order" => 4
                    ], [
                        "title" => "Порода",
                        "name" => "lib",
                        "disable" => 0,
                        "url" => "/lib/breed",
                        "group" => ["lib.breed"],
                        "order" => 5
                    ], [
                        "title" => "Окрас",
                        "name" => "lib",
                        "disable" => 0,
                        "url" => "/lib/color",
                        "group" => ["lib.color"],
                        "order" => 6
                    ], [
                        "title" => "Типы ушей",
                        "name" => "lib",
                        "disable" => 0,
                        "url" => "/lib/ear",
                        "group" => ["lib.ear"],
                        "order" => 7
                    ], [
                        "title" => "Размер",
                        "name" => "lib",
                        "disable" => 0,
                        "url" => "/lib/size",
                        "group" => ["lib.size"],
                        "order" => 8
                    ], [
                        "title" => "Типы шерсти",
                        "name" => "lib",
                        "disable" => 0,
                        "url" => "/lib/wool",
                        "group" => ["lib.wool"],
                        "order" => 9
                    ], [
                        "title" => "Типы хвостов",
                        "name" => "lib",
                        "disable" => 0,
                        "url" => "/lib/tail",
                        "group" => ["lib.tail"],
                        "order" => 10
                    ], [
                        "title" => "Причины смерти",
                        "name" => "lib",
                        "disable" => 0,
                        "url" => "/lib/death",
                        "group" => ["lib.death"],
                        "order" => 11
                    ], [
                        "title" => "Причины выбытия из приюта",
                        "name" => "lib",
                        "disable" => 0,
                        "url" => "/lib/leav",
                        "group" => ["lib.leav"],
                        "order" => 12
                    ], [
                        "title" => "Причины эвтаназии",
                        "name" => "lib",
                        "disable" => 0,
                        "url" => "/lib/euth",
                        "group" => ["lib.eauth"],
                        "order" => 13
                    ], [
                        "title" => "Ветеринары",
                        "name" => "lib",
                        "disable" => 0,
                        "order" => 13
                    ], [
                        "title" => "Ветеринары",
                        "name" => "lib",
                        "disable" => 0,
                        "url" => "/lib/vet",
                        "group" => ["lib.vet"],
                        "order" => 14
                    ],


                ]
            ],
            [
                "title" => "Администрирование",
                "name" => "auth",
                "disable" => 0,
                "group" => ["auth.user", "auth.role"],
                "order" => 5,
                "items" => [
                    [
                        "title" => "Пользователи",
                        "name" => "auth",
                        "disable" => 1,
                        "url" => "/adm/user",
                        "group" => ["auth.user"],
                        "order" => 1
                    ],
                    [
                        "title" => "Роли",
                        "name" => "auth",
                        "disable" => 1,
                        "url" => "/adm/role",
                        "group" => ["auth.role"],
                        "order" => 2
                    ],
                ]
            ],
        ];
    }
}