<?php

namespace App\Models;

use App\Core\AccountConstant;
use App\Core\Traits\SpatieLogsActivity;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable 
// implements MustVerifyEmail
{
    use HasFactory, Notifiable;
    use SpatieLogsActivity;
    use HasRoles;
    protected $primaryKey = 'id';
    public $incrementing = false; 
    public $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
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

    public static function getAdmin() {
        return self::where(['email' => 'admin@admin.com'])->first();
    }

    public static function isAdmin() {
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
        if($type == AccountConstant::TYPE_USER_MEMBER && $total_left >=155 && $total_right >= 155){
            return AccountConstant::TYPE_USER_DIAMOND;
        }
        elseif($type == AccountConstant::TYPE_USER_MEMBER && $total_left >=55 && $total_right >= 55){
            return AccountConstant::TYPE_USER_RUBY;
        }elseif($type == AccountConstant::TYPE_USER_MEMBER && $total_left >=55 && $total_right >= 55){
            return AccountConstant::TYPE_USER_SAPHIRE;
        }
        else{
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

        return asset(theme()->getMediaUrlPath().'avatars/blank.png');
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
    public function children()
    {
        return $this->hasMany(self::class, 'direct_user_id', 'id');
    }
    public function indirect_user()
    {
        return $this->belongsTo(self::class, 'indirect_user_id', 'id');
    }

    public static function insertLevelOrder($arr, $i, $n)
    {
        $root = null;
        # Base case for recursion 
        if ($i < $n) {
            $root = new newNode($arr[$i]);
            $root->left = self::insertLevelOrder($arr, 2 * $i + 1, $n);
            $root->right = self::insertLevelOrder($arr, 2 * $i + 2, $n);
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

    public function checkHasBranch($node){
        if(!empty($node->left)){
            
        }
    }
    public static function printPreorder($node, &$html = ''){
    if (empty($node)) return null;
    $item = $node->data;
    $avatar = $item['avatar'] ? asset($item['avatar']) :  asset(theme()->getMediaUrlPath() . 'avatars/blank.png');
    $full_name = $item['first_name'] . ' ' . $item['last_name'];
    $a = "<a class='view_detail cursor-pointer' data-id='{$item['id']}' data-full_name='{$full_name}'>
    <div >
                                                            <img style='width:25px;height:25px;' src='{$avatar}' alt=''>
                                                        </div>
    </a>";
    if(!empty($node->left)){
            // $html .= '<ul>';
            $html .= '<li>';
            $html .= $a;
            $html .= '<ul>';
        }else{
            $html .= '<li>';
            $html .= $a;
        }
        // # Deal with the node
        // if (!empty($node->left)){
        //     // $html .= '<ul>';
        //     // $html .= '<li>';
        //     $html .= $node->data['first_name'];
        //     $html .= '<ul>';
        //     $html .= '<li>';
        // }
        // else{
        //     // $html .= '<li>';
        //     $html .= $node->data['first_name'];
        //     $html .= '</li>';
        // }
        // if(empty($node->left) && empty($node->right)){
        //     $html .= '<li>';
        //     $html .= $node->data['first_name'];
        // }
        // $html .= '<li>';
        // $html .= $node->data['first_name'];
        // if (!empty($node->left)){
        //     $html .= '<ul>';
        //     $html .= '<li>';
        //     // dd(12);
        // }
        // if(empty($node->left) && empty($node->right)){
        //     $html .= '</li>';
        // }

        // else{
        //     $html .= '</li>';
        //     // $html .= '</ul>';
        // }
        

        # Recur on left subtree
        self::printPreorder($node->left, $html);
        # Recur on right subtree
        self::printPreorder($node->right, $html);
        if(!empty($node->left)){
            $html .= '</ul>';
            $html .= '</li>';
        }else{
            $html .= '</li>';
        }

        // $html .= '</li>';
        // $html .= '</ul>';
        // if (!empty($node->left)){
        //     $html .= '</li>';
        //     $html .= '</ul>';
        //     $html .= '</li>';
        //     $html .= '</ul>';
        // }
    }

    public static function search($node, $user_id){
        // $result_node = null;
        // if (empty($node)) return $result_node;
        //     # Recur on left subtree
        // dump($node, $node->data['id'] == $user_id);
        // if($node->data['id'] == $user_id){
        //     $result_node = $node;
        // }

        // self::search($node->left, $user_id);

        // # Recur on right subtree
        // self::search($node->right, $user_id);
        // return $result_node;
        if (empty($node)) return null;
            # Recur on left subtree
        // dump($node, $node->data['id'] == $user_id);
        if($node->data['id'] == $user_id){
            return $node;
        }
        $result_node = self::search($node->left, $user_id);
        if(!(empty($result_node))){
            return $result_node;
        }
        # Recur on right subtree
        $result_node = self::search($node->right, $user_id);
        if(!(empty($result_node))){
            return $result_node;
        }
        //     // $result_node = self::search($node->left, $user_id);
        //     // # Recur on right subtree
        //     // $result_node = self::search($node->right, $user_id);
        //     return $result_node;
        // }
    }

    public static function getTotal($node){
        if (empty($node)) return 0;
        $l = self::getTotal($node->left);
        $r = self::getTotal($node->right);
        return 1 + $l + $r;
    }
    public static function getTotalLeft($node){
        if (empty($node->left)) return 0;
        return self::getTotal($node->left);
    }
    public static function getTotalRight($node){
        if (empty($node->right)) return 0;
        return self::getTotal($node->right);
    }

    public static function getLevelUtil($node, $data, $level){
        if ($node == null){
            return 0;

        }
        if ($node->data == $data){
            return $level;
        }
        $downlevel = self::getLevelUtil($node->left, $data, $level + 1);
        if ($downlevel != 0){
            return $downlevel;
        }
        $downlevel = self::getLevelUtil($node->right, $data, $level + 1);
        return $downlevel;
    }
 
 
# Returns level of given data value
 
 
    public static function getLevel($node, $data){
        return self::getLevelUtil($node, $data, 0);
    }

    public static function handleUpgrade($direct_user_id){
        $users = self::where('direct_user_id', '<>', null)
        ->where('state' , AccountConstant::USER_STATE_PAID)
            ->orWhere(['username' => 'admin'])
            // ->orderBy('level')
            ->orderBy('created_at')
            ->get()->toArray();

            $n = count($users);
            $root = null;
            $root = self::insertLevelOrder($users, 0, $n);


            foreach($users as $user){
                $gold_commission = 0;
                $total_coin = 0;

                // $level = self::getLevel($root, $users[6]);
                $nodeSearched = User::search($root, $user['id']);
                $totalLeft = self::getTotalLeft($nodeSearched);
                // dd($totalLeft);
                $totalRight = self::getTotalRight($nodeSearched);
                $totalNode = $totalLeft + $totalRight;
                // dd($totalRight);


                $new_type = self::getAccountType(auth()->user()->type, $totalLeft, $totalRight);
                // self::where(['id' => $user['id']])->update(['type' => $new_type]);
                switch($user['type']){
                // switch($new_type){
                    case AccountConstant::TYPE_USER_SAPHIRE:
                        $count_user_saphire = self::where(['type' => AccountConstant::TYPE_USER_SAPHIRE])->count();
                        if ($count_user_saphire > 0){
                            $gold_commission = (AccountConstant::DIRECT_COMISSION * (3/100))/$count_user_saphire;
                        }
                        break;
                    case AccountConstant::TYPE_USER_RUBY:
                        $count_user_ruby = self::where(['type' => AccountConstant::TYPE_USER_SAPHIRE])->count();
                        if ($count_user_ruby > 0){
                            $gold_commission = (AccountConstant::DIRECT_COMISSION * (5/100))/$count_user_ruby;
                        }
                        break;
                    case AccountConstant::TYPE_USER_DIAMOND:
                        $count_user_diamond = self::where(['type' => AccountConstant::TYPE_USER_SAPHIRE])->count();
                        if ($count_user_diamond > 0){
                            $gold_commission= (AccountConstant::DIRECT_COMISSION * (7/100))/$count_user_diamond;
                        }
                        break;
                }

                if($gold_commission > 0 || $user['id'] == $direct_user_id || $totalNode > 0){
                    $total_coin = $user['coin'];
                    $content = '';
                    if($user['id'] == $direct_user_id){
                        $total_coin += AccountConstant::DIRECT_COMISSION;
                        $content = 'direct commission';
                        Income::create([
                            'user_id'        => $user['id'],
                            'coin'             => AccountConstant::DIRECT_COMISSION,
                            'content'             => $content,
                        ]);
                    }
                    if($gold_commission > 0){
                        $total_coin += $gold_commission;
                        $content = "{$new_type} commission";
                        Income::create([
                            'user_id'        => $user['id'],
                            'coin'             => $gold_commission,
                            'content'             => $content,
                        ]);
                    }
                    self::where(['id' => $user['id']])->update([
                        'commissions' => $total_coin
                    ]);
                    if($totalNode > 0){
                        $coin = $totalNode * AccountConstant::INDIRECT_COMISSION;
                        $total_coin += $gold_commission;
                        $content = "branch bonus commissions";
                        Income::create([
                            'user_id'        => $user['id'],
                            'coin'             => $coin,
                            'content'             => $content,
                        ]);
                    }
                }
        }
    }
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
