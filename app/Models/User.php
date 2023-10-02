<?php

namespace App\Models;

use App\Core\AccountConstant;
use App\Core\Traits\SpatieLogsActivity;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends \TCG\Voyager\Models\User
// implements MustVerifyEmail
{
    use HasFactory, Notifiable;
    use SpatieLogsActivity;
    // use HasRoles;
    // protected $primaryKey = 'id';
    // public $incrementing = false;
    // public $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'commissions',
        'username',
        'type',
        'first_name',
        'last_name',
        'email',
        'password',
        'password2',
        'phone',
        'sponsor_id',
        'direct_user_id',
        'indirect_user_id',
        'avatar',
        'sponsor_id',
        'coin',
        'state',
        'level',
    ];
    public function username()
    {
        return 'username';
    }
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function getAdmin()
    {
        return User::where(['email' => 'admin@admin.com'])->first();
    }

    public static function isAdmin()
    {
        return auth()->user()->email == 'admin@admin.com';
    }
    /**
     * Get a fullname combination of first_name and last_name
     *
     * @return string
     */
    public function getNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }
    /**
     * Get a fullname combination of first_name and last_name
     *
     * @return string
     */
    public static function getAccountType($type, $total_left = 0, $total_right = 0)
    {
        if ($type == AccountConstant::TYPE_USER_MEMBER && $total_left >= 155 && $total_right >= 155) {
            return AccountConstant::TYPE_USER_DIAMOND;
        } elseif ($type == AccountConstant::TYPE_USER_MEMBER && $total_left >= 55 && $total_right >= 55) {
            return AccountConstant::TYPE_USER_RUBY;
        } elseif ($type == AccountConstant::TYPE_USER_MEMBER && $total_left >= 5 && $total_right >= 5) {
            return AccountConstant::TYPE_USER_SAPHIRE;
        } else {
            return $type;
        }
    }

    /**
     * Prepare proper error handling for url attribute
     *
     * @return string
     */
    public function getAvatarUrlAttribute()
    {
        if ($this->avatar) {
            return asset($this->avatar);
        }

        return asset(theme()->getMediaUrlPath() . 'avatars/blank.png');
    }

    /**
     * User relation to info model
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    // public function info()
    // {
    //     return $this->hasOne(UserInfo::class);
    // }

    public function direct_user()
    {
        return $this->belongsTo(self::class, 'direct_user_id', 'id');
    }
    public function parent()
    {
        return $this->belongsTo(self::class, 'indirect_user_id', 'id')->with('allChildren');
    }



    public function parents()
    {
        return $this->parent()->with('parents');
    }
    public function children()
    {
        return $this->hasMany(self::class, 'indirect_user_id', 'id')->where('direct_user_id', '<>', null)->where('indirect_user_id', '<>', null)->orderBy('created_at')
            // ;
            ->where('state', AccountConstant::USER_STATE_PAID);
    }
    public function allChildren()
    {
        return $this->children()->with('allChildren');
    }
    public function indirect_user()
    {
        return $this->belongsTo(self::class, 'indirect_user_id', 'id');
    }

    // public static function generate_system_tree($tree_data, &$new_data, $direct_user_id = 0, $level = 0)
    // {
    //     $children = [];
    //     foreach ($tree_data as $k => $item) {
    //         # code...
    //         if ($item['indirect_user_id'] == $direct_user_id) {
    //             $item['level'] = $level;
    //             array_push($children, $item);
    //         }
    //     }
    //     if ($children) {
    //         array_push($new_data, '<ul>');
    //         foreach ($children as $k => $item) {
    //             $avatar = $item['avatar'] ? asset($item['avatar']) :  asset(theme()->getMediaUrlPath() . 'avatars/blank.png');
    //             # code...
    //             $full_name = $item['first_name'] . ' ' . $item['last_name'];
    //             array_push($new_data, "<li><a class='view_detail cursor-pointer' data-id='{$item['id']}' data-full_name='{$full_name}' data-level='{$item['level']}'>
    //             <div class='symbol symbol-50px symbol-sm-30px'>
    // 																	<img src='{$avatar}' alt=''>
    //                                                                     {$full_name}
    // 																</div>
    //             </a>");
    //             self::generate_system_tree($tree_data, $new_data, $item['id'], $level + 1);
    //             array_push($new_data, '</li>');
    //         }
    //         array_push($new_data, '</ul>');
    //     }
    // }

    public static function generate_system_tree($parent, &$new_data, $direct_user_id = 0, $level = 0, &$total = 0, &$totalLeft = 0, &$totalRight = 0)
    {
        $avatar = $parent->avatar ? asset($parent->avatar) :  asset(theme()->getMediaUrlPath() . 'avatars/blank.png');
        # code...
        $full_name = $parent->first_name . ' ' . $parent->last_name;
        array_push($new_data, "<li><a class='view_detail cursor-pointer' data-id='{$parent->id}' data-full_name='{$full_name}'>
        <div class='symbol symbol-20px symbol-sm-20px'>
                                                                <img src='{$avatar}' alt=''>

                                                            </div>
        </a>");
        $children = $parent->allChildren;

        if ($children) {
            // array_push($new_data, '<ul>');
            array_push($new_data, '<ul>');
            foreach ($children as $k => $item) {
                // $total += 1;
                self::generate_system_tree($item, $new_data, $item['id'], $level + 1, $total, $totalLeft, $totalRight);
            }
            array_push($new_data, '</ul>');
            // array_push($new_data, '</ul>');
        }
        array_push($new_data, '</li>');
    }

    public static function insert($arr, $parent_id)
    {
        $node = null;
        if ($arr) {
            // $node = new newNode($k);
            // dump(new newNode($arr[0]));

            // return new newNode($arr[0]);
            // dd($arr);
            // if(!empty($arr)){
            foreach ($arr as $i => $item) {
                if ($item['direct_user_id'] == $parent_id) {
                    $node = new newNode($item);
                    // dump($node->left);
                    // $node->left = self::insert($node->left, $arr, $item['id']);
                    // unset($arr[$i]);
                    // dump($new_node);
                    $node->left = self::insert($node->left, $arr, $item['id']);
                    $node->right = self::insert($node->right, $arr, $item['id']);
                    // return $new_node;
                }
            }
            // }

        }
        // dump($node);
        return $node;
    }
    public static function insert_node($node, $key)
    {
        if (empty($node)) {
            return new newNode($key);
        }
        // dd($node);

        # Otherwise, recur down the tree
        if ($key['indirect_user_id'] == $node->data['id']) {
            $node->left = self::insert_node($node->left, $key);
        } elseif ($key['indirect_user_id'] != $node->data['id']) {
            $node->right = self::insert_node($node->right, $key);
        }
        return $node;
    }



    # Return the (unchanged) node pointer
    public static function insertLevelOrder($arr, $i, $n, $parent_id = '')
    {
        $root = null;
        # Base case for recursion 
        if ($i < $n) {
            $root = new newNode($arr[$i]);
            // dump($root);
            // $parent_id = $root->data['direct_user_id'];
            // if($root->data['direct_user_id'] == $parent_id){
            //     $root->left = self::insertLevelOrder($arr, 2 * $i + 1, $n, $root->data['direct_user_id']);
            // }
            // if($root->data['direct_user_id'] != $parent_id){
            //     $root->right = self::insertLevelOrder($arr, 2 * $i + 2, $n, $root->data['direct_user_id']);
            // }
            // dump($parent_id);
            // foreach($arr as $item){
            //     if($item['direct_user_id'] == $root->data['id']){
            //         dd($item[]);
            //     }

            // }
            $root->left = self::insertLevelOrder($arr, 2 * $i + 1, $n, $root->data['direct_user_id']);
            $root->right = self::insertLevelOrder($arr, 2 * $i + 2, $n, $root->data['direct_user_id']);
        }
        return $root;
    }

    public function inOrder($root)
    {
        if ($root != null) {
            $this->inOrder($root->left);
            // echo ($root->data, end=" ");
            $this->inOrder($root->right);
        }
    }

    public function checkHasBranch($node)
    {
        if (!empty($node->left)) {
        }
    }
    public static function printPreorder($node, &$html = '')
    {
        if (empty($node)) return null;
        $item = $node->data;
        $avatar = $item['avatar'] ? asset($item['avatar']) :  asset(theme()->getMediaUrlPath() . 'avatars/blank.png');
        $full_name = $item['first_name'] . ' ' . $item['last_name'];
        // $a = "<a class='view_detail cursor-pointer' data-id='{$item['id']}' data-full_name='{$full_name}'>
        // <div >
        //                                                         <img style='width:25px;height:25px;' src='{$avatar}' alt=''>
        //                                                     </div>
        // </a>";
        $a = "<a class='view_detail cursor-pointer' data-id='{$item['id']}' data-full_name='{$full_name}'>
    <div >
                                                            {$full_name}
                                                        </div>
    </a>";
        if (!empty($node->left) || !empty($node->right)) {
            // $html .= '<ul>';
            $html .= '<li>';
            $html .= $a;
            $html .= '<ul>';
        } else {
            $html .= '<li>';
            $html .= $a;
        }

        # Recur on left subtree
        self::printPreorder($node->left, $html);
        # Recur on right subtree
        self::printPreorder($node->right, $html);
        if (!empty($node->left) || !empty($node->right)) {
            $html .= '</ul>';
            $html .= '</li>';
        } else {
            $html .= '</li>';
        }
    }

    public static function search($node, $user_id)
    {

        if (empty($node)) return null;

        if ($node->data['id'] == $user_id) {
            return $node;
        }
        $result_node = self::search($node->left, $user_id);
        if (!(empty($result_node))) {
            return $result_node;
        }
        # Recur on right subtree
        $result_node = self::search($node->right, $user_id);
        if (!(empty($result_node))) {
            return $result_node;
        }
    }

    public static function getTotal($parent, &$total = 0)
    {
        $children = $parent->allChildren;
        $total += 1;
        if ($children) {
            foreach ($children as $k => $item) {
                // $total += 1;
                self::getTotal($item, $total);
            }
        }
    }
    // public static function getTotal($node){
    //     if (empty($node)) return 0;
    //     $l = self::getTotal($node->left);
    //     $r = self::getTotal($node->right);
    //     return 1 + $l + $r;
    // }

    // public static function getTotalLeft($node){
    //     if (empty($node->left)) return 0;
    //     return self::getTotal($node->left);
    // }
    public static function calc_total($parent)
    {
        $total = 0;
        $totalLeft = 0;
        $totalRight = 0;
        $children = $parent->allChildren;
        if (!empty($children)) {
            if (!empty($children[0])) {
                self::getTotal($children[0], $totalLeft);
            }
            if (!empty($children[1])) {
                self::getTotal($children[1], $totalRight);
            }
        }
        return [
            'total' => $totalLeft + $totalRight,
            'totalLeft' => $totalLeft,
            'totalRight' => $totalRight,
        ];
    }

    public static function getTotalRight($node)
    {
        if (empty($node->right)) return 0;
        return self::getTotal($node->right);
    }

    public static function getLevelUtil($node, $data, $level)
    {
        if ($node == null) {
            return 0;
        }
        if ($node->data == $data) {
            return $level;
        }
        $downlevel = self::getLevelUtil($node->left, $data, $level + 1);
        if ($downlevel != 0) {
            return $downlevel;
        }
        $downlevel = self::getLevelUtil($node->right, $data, $level + 1);
        return $downlevel;
    }


    # Returns level of given data value


    public static function getLevel($node, $data)
    {
        return self::getLevelUtil($node, $data, 0);
    }

    public static function handleUpgrade($user_id, $direct_user_id)
    {
        $me = User::where(['id' => $user_id])->with(['parents'])->first();
        $user = $me->parents;
        while (!empty($user)) {
            $calc_total = self::calc_total($user);
            $totalLeft = $calc_total['totalLeft'];
            $totalRight = $calc_total['totalRight'];
            // $totalNode = $calc_total['total'];
            $new_type = self::getAccountType($user['type'], $totalLeft, $totalRight);
            // dump($totalLeft, $totalRight, $new_type);
            // User::where(['id' => $user['id']])->update(['type' => $new_type]);
            $content = "quick bonus commissions";
            Income::create([
                'user_id'        => $user['id'],
                'coin'             => AccountConstant::INDIRECT_COMISSION,
                'content'             => $content,
            ]);
            // dd(Income::where('user_id', $user->id)->first());

            User::where(['id' => $user['id']])->update([
                'type' => $new_type,
                'coin' => AccountConstant::INDIRECT_COMISSION + $user['coin'],
                'commissions' => AccountConstant::INDIRECT_COMISSION + $user['commissions'],
            ]);
            // dd(User::find($user->id));

            $user = $user->parents;
        }

        $old_direct_user = User::find($direct_user_id);
        User::where('id', $direct_user_id)->update([
            'coin' => AccountConstant::DIRECT_COMISSION + $old_direct_user['coin'],
            'commissions' => AccountConstant::DIRECT_COMISSION + $old_direct_user['commissions'],
        ]);

        $content = 'direct commission';
        Income::create([
            'user_id'        => $direct_user_id,
            'coin'             => AccountConstant::DIRECT_COMISSION,
            'content'             => $content,
        ]);

        $gold_users = User::where('type', AccountConstant::TYPE_USER_RUBY)
            ->orWhere('type', AccountConstant::TYPE_USER_SAPHIRE)
            ->orWhere('type', AccountConstant::TYPE_USER_DIAMOND)->get();
            
        foreach ($gold_users as $gold_user) {
            $gold_commission = 0;
            switch ($gold_user->type) {
                case AccountConstant::TYPE_USER_SAPHIRE:
                    $count_user_saphire = User::where(['type' => AccountConstant::TYPE_USER_SAPHIRE])->count();
                    if ($count_user_saphire > 0) {
                        $gold_commission = (AccountConstant::GOLD_COMISSION * (3 / 100)) / $count_user_saphire;
                    }
                    break;
                case AccountConstant::TYPE_USER_RUBY:
                    $count_user_ruby = User::where(['type' => AccountConstant::TYPE_USER_RUBY])->count();
                    if ($count_user_ruby > 0) {
                        $gold_commission = (AccountConstant::GOLD_COMISSION * (2 / 100)) / $count_user_ruby;
                    }
                    break;
                case AccountConstant::TYPE_USER_DIAMOND:
                    $count_user_diamond = User::where(['type' => AccountConstant::TYPE_USER_DIAMOND])->count();
                    if ($count_user_diamond > 0) {
                        $gold_commission = (AccountConstant::GOLD_COMISSION * (2 / 100)) / $count_user_diamond;
                    }
                    break;
            }

            if ($gold_commission > 0) {
                $content = "{$gold_user->type} commission";
                Income::create([
                    'user_id'        => $gold_user['id'],
                    'coin'             => $gold_commission,
                    'content'             => $content,
                ]);

                User::where(['id' => $gold_user['id']])->update([
                    'coin' => $gold_commission + $gold_user['coin'],
                    'commissions' => $gold_commission + $gold_user['commissions'],
                ]);
            }
        }
        User::where('id', $user_id)->update(['level' => $me->parents->level + 1, 'state' => AccountConstant::USER_STATE_PAID]);

        // $users = self::with(['allChildren'])
        //     ->orderBy('created_at')
        //     ->get()->toArray();
        // $user_id = auth()->user()->id;
        // $user = User::with(['allChildren'])
        // ->where('state' , AccountConstant::USER_STATE_PAID)
        // ->where('id', $user_id)
        // ->first();

        //     foreach($users as $user){

        // }
    }
    // public static function handleUpgrade($direct_user_id){
    //     $users = User::where('direct_user_id', '<>', null)
    //     ->where('state' , AccountConstant::USER_STATE_PAID)
    //         ->orWhere(['username' => 'admin'])
    //         // ->orderBy('level')
    //         ->orderBy('created_at')
    //         ->get()->toArray();

    //         $n = count($users);
    //         $root = null;
    //         $root = self::insertLevelOrder($users, 0, $n);


    //         foreach($users as $user){
    //             $gold_commission = 0;
    //             $total_coin = 0;

    //             // $level = self::getLevel($root, $users[6]);
    //             $nodeSearched = User::search($root, $user['id']);
    //             $totalLeft = self::getTotalLeft($nodeSearched);
    //             // dd($totalLeft);
    //             $totalRight = self::getTotalRight($nodeSearched);
    //             $totalNode = $totalLeft + $totalRight;
    //             // dd($totalRight);


    //             $new_type = self::getAccountType(auth()->user()->type, $totalLeft, $totalRight);
    //             // User::where(['id' => $user['id']])->update(['type' => $new_type]);
    //             switch($user['type']){
    //             // switch($new_type){
    //                 case AccountConstant::TYPE_USER_SAPHIRE:
    //                     $count_user_saphire = User::where(['type' => AccountConstant::TYPE_USER_SAPHIRE])->count();
    //                     if ($count_user_saphire > 0){
    //                         $gold_commission = (AccountConstant::DIRECT_COMISSION * (3/100))/$count_user_saphire;
    //                     }
    //                     break;
    //                 case AccountConstant::TYPE_USER_RUBY:
    //                     $count_user_ruby = User::where(['type' => AccountConstant::TYPE_USER_SAPHIRE])->count();
    //                     if ($count_user_ruby > 0){
    //                         $gold_commission = (AccountConstant::DIRECT_COMISSION * (5/100))/$count_user_ruby;
    //                     }
    //                     break;
    //                 case AccountConstant::TYPE_USER_DIAMOND:
    //                     $count_user_diamond = User::where(['type' => AccountConstant::TYPE_USER_SAPHIRE])->count();
    //                     if ($count_user_diamond > 0){
    //                         $gold_commission= (AccountConstant::DIRECT_COMISSION * (7/100))/$count_user_diamond;
    //                     }
    //                     break;
    //             }

    //             if($gold_commission > 0 || $user['id'] == $direct_user_id || $totalNode > 0){
    //                 $total_coin = $user['coin'];
    //                 $content = '';
    //                 if($user['id'] == $direct_user_id){
    //                     $total_coin += AccountConstant::DIRECT_COMISSION;
    //                     $content = 'direct commission';
    //                     Income::create([
    //                         'user_id'        => $user['id'],
    //                         'coin'             => AccountConstant::DIRECT_COMISSION,
    //                         'content'             => $content,
    //                     ]);
    //                 }
    //                 if($gold_commission > 0){
    //                     $total_coin += $gold_commission;
    //                     $content = "{$new_type} commission";
    //                     Income::create([
    //                         'user_id'        => $user['id'],
    //                         'coin'             => $gold_commission,
    //                         'content'             => $content,
    //                     ]);
    //                 }
    //                 User::where(['id' => $user['id']])->update([
    //                     'commissions' => $total_coin
    //                 ]);
    //                 if($totalNode > 0){
    //                     $coin = $totalNode * AccountConstant::INDIRECT_COMISSION;
    //                     $total_coin += $gold_commission;
    //                     $content = "branch bonus commissions";
    //                     Income::create([
    //                         'user_id'        => $user['id'],
    //                         'coin'             => $coin,
    //                         'content'             => $content,
    //                     ]);
    //                 }
    //             }
    //     }
    // }
}
class newNode
{
    public $data;
    public $left;
    public $right;
    public function __construct($data)
    {
        $this->data = $data;
        $this->left = $this->right = null;
    }
}
