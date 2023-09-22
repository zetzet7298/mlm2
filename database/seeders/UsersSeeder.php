<?php

namespace Database\Seeders;

use App\Core\AccountConstant;
use App\Models\Income;
use App\Models\Transfer;
use App\Models\User;
use App\Models\UserInfo;
use Faker\Generator;
use Faker\Provider\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Generator $faker)
    {
        $demoUser = User::create([
            'id' => Str::uuid()->toString(),
            'first_name'        => $faker->firstName,
            'last_name'         => $faker->lastName,
            'email'             => 'admin@admin.com',
            'password'          => Hash::make('admin'),
            'password2'          => Hash::make('admin2'),
            'coin' => 1000000,
            'type' => AccountConstant::TYPE_USER_MEMBER,
            'state' => AccountConstant::USER_STATE_PAID,
            'email_verified_at' => now(),
        ]);


        $user1 = User::create([
            'id' => Str::uuid()->toString(),
            'first_name'        => $faker->firstName,
            'last_name'         => $faker->lastName,
            'email'             => $faker->unique()->safeEmail,
            'password'          => Hash::make('demo'),
            'password2'          => Hash::make('demo2'),
            'direct_user_id'          => $demoUser->id,
            'state' => AccountConstant::USER_STATE_PAID,
            'indirect_user_id'          => $demoUser->id,
            'email_verified_at' => now(),
        ]);

        Transfer::create([
            'sender_id'        => $demoUser->id,
            'receiver_id'         => $demoUser->id,
            'coin'             => 40,
            'content'             => 'test',
        ]);

        Income::create([
            'user_id'        => $demoUser->id,
            'coin'             => 11,
            'content'             => 'Hoa hồng trực tiếp từ ai kia',
        ]);

        $user2 = User::create([
            'id' => Str::uuid()->toString(),
            'first_name'        => $faker->firstName,
            'last_name'         => $faker->lastName,
            'email'             => $faker->unique()->safeEmail,
            'password'          => Hash::make('demo'),
            'password2'          => Hash::make('demo2'),
            'direct_user_id'          => $user1->id,
            'state' => AccountConstant::USER_STATE_PAID,
            'indirect_user_id'          => $user1->id,
            'email_verified_at' => now(),
        ]);

        Income::create([
            'user_id'        => $user1->id,
            'coin'             => 11,
        ]);
        
        Transfer::create([
            'sender_id'        => $demoUser->id,
            'receiver_id'         => $user2->id,
            'coin'             => 40,
        ]);

        $user3 = User::create([
            'id' => Str::uuid()->toString(),
            'first_name'        => $faker->firstName,
            'last_name'         => $faker->lastName,
            'email'             => $faker->unique()->safeEmail,
            'password'          => Hash::make('demo'),
            'state' => AccountConstant::USER_STATE_PAID,
            'password2'          => Hash::make('demo2'),
            'direct_user_id'          => $user1->id,
            'indirect_user_id'          => $user1->id,
            'email_verified_at' => now(),
        ]);

        Income::create([
            'user_id'        => $user1->id,
            'coin'             => 11,
        ]);

        Transfer::create([
            'sender_id'        => $demoUser->id,
            'receiver_id'         => $user3->id,
            'coin'             => 40,
        ]);

        $user4 = User::create([
            'id' => Str::uuid()->toString(),
            'first_name'        => $faker->firstName,
            'last_name'         => $faker->lastName,
            'email'             => $faker->unique()->safeEmail,
            'password'          => Hash::make('demo'),
            'state' => AccountConstant::USER_STATE_PAID,
            'password2'          => Hash::make('demo2'),
            'direct_user_id'          => $demoUser->id,
            'indirect_user_id'          => $demoUser->id,
            'email_verified_at' => now(),
        ]);

        Transfer::create([
            'sender_id'        => $demoUser->id,
            'receiver_id'         => $user4->id,
            'coin'             => 40,
        ]);

        Income::create([
            'user_id'        => $demoUser->id,
            'coin'             => 11,
        ]);

        $user5 = User::create([
            'id' => Str::uuid()->toString(),
            'first_name'        => $faker->firstName,
            'last_name'         => $faker->lastName,
            'email'             => $faker->unique()->safeEmail,
            'password'          => Hash::make('demo'),
            'password2'          => Hash::make('demo2'),
            'state' => AccountConstant::USER_STATE_PAID,
            'direct_user_id'          => $user4->id,
            'indirect_user_id'          => $user1->id,
            'email_verified_at' => now(),
        ]);

        Transfer::create([
            'sender_id'        => $demoUser->id,
            'receiver_id'         => $user5->id,
            'coin'             => 40,
        ]);

        Income::create([
            'user_id'        => $user1->id,
            'coin'             => 11,
        ]);

        $user6 = User::create([
            'id' => Str::uuid()->toString(),
            'first_name'        => $faker->firstName,
            'last_name'         => $faker->lastName,
            'email'             => $faker->unique()->safeEmail,
            'password'          => Hash::make('demo'),
            'password2'          => Hash::make('demo2'),
            'state' => AccountConstant::USER_STATE_PROCESSING,
            // 'state' => AccountConstant::USER_STATE_PAID,
            'direct_user_id'          => $user4->id,
            'indirect_user_id'          => $demoUser->id,
            'email_verified_at' => now(),
        ]);

        $user20 = User::create([
            'id' => Str::uuid()->toString(),
            'first_name'        => $faker->firstName,
            'last_name'         => $faker->lastName,
            'email'             => $faker->unique()->safeEmail,
            'password'          => Hash::make('demo'),
            'password2'          => Hash::make('demo2'),
            'state' => AccountConstant::USER_STATE_PROCESSING,
            // 'state' => AccountConstant::USER_STATE_PAID,
            'direct_user_id'          => $user3->id,
            'indirect_user_id'          => $demoUser->id,
            'email_verified_at' => now(),
        ]);
        $user21 = User::create([
            'id' => Str::uuid()->toString(),
            'first_name'        => $faker->firstName,
            'last_name'         => $faker->lastName,
            'email'             => $faker->unique()->safeEmail,
            'password'          => Hash::make('demo'),
            'password2'          => Hash::make('demo2'),
            'state' => AccountConstant::USER_STATE_PROCESSING,
            // 'state' => AccountConstant::USER_STATE_PAID,
            'direct_user_id'          => $user3->id,
            'indirect_user_id'          => $demoUser->id,
            'email_verified_at' => now(),
        ]);
        $user22 = User::create([
            'id' => Str::uuid()->toString(),
            'first_name'        => $faker->firstName,
            'last_name'         => $faker->lastName,
            'email'             => $faker->unique()->safeEmail,
            'password'          => Hash::make('demo'),
            'password2'          => Hash::make('demo2'),
            'state' => AccountConstant::USER_STATE_PROCESSING,
            // 'state' => AccountConstant::USER_STATE_PAID,
            'direct_user_id'          => $user2->id,
            'indirect_user_id'          => $demoUser->id,
            'email_verified_at' => now(),
        ]);
        $user23 = User::create([
            'id' => Str::uuid()->toString(),
            'first_name'        => $faker->firstName,
            'last_name'         => $faker->lastName,
            'email'             => $faker->unique()->safeEmail,
            'password'          => Hash::make('demo'),
            'password2'          => Hash::make('demo2'),
            'state' => AccountConstant::USER_STATE_PROCESSING,
            // 'state' => AccountConstant::USER_STATE_PAID,
            'direct_user_id'          => $user2->id,
            'indirect_user_id'          => $demoUser->id,
            'email_verified_at' => now(),
        ]);

        $user24 = User::create([
            'id' => Str::uuid()->toString(),
            'first_name'        => $faker->firstName,
            'last_name'         => $faker->lastName,
            'email'             => $faker->unique()->safeEmail,
            'password'          => Hash::make('demo'),
            'password2'          => Hash::make('demo2'),
            'state' => AccountConstant::USER_STATE_PROCESSING,
            // 'state' => AccountConstant::USER_STATE_PAID,
            'direct_user_id'          => $user20->id,
            'indirect_user_id'          => $demoUser->id,
            'email_verified_at' => now(),
        ]);

        $user25 = User::create([
            'id' => Str::uuid()->toString(),
            'first_name'        => $faker->firstName,
            'last_name'         => $faker->lastName,
            'email'             => $faker->unique()->safeEmail,
            'password'          => Hash::make('demo'),
            'password2'          => Hash::make('demo2'),
            'state' => AccountConstant::USER_STATE_PROCESSING,
            // 'state' => AccountConstant::USER_STATE_PAID,
            'direct_user_id'          => $user20->id,
            'indirect_user_id'          => $demoUser->id,
            'email_verified_at' => now(),
        ]);
        $user26 = User::create([
            'id' => Str::uuid()->toString(),
            'first_name'        => $faker->firstName,
            'last_name'         => $faker->lastName,
            'email'             => $faker->unique()->safeEmail,
            'password'          => Hash::make('demo'),
            'password2'          => Hash::make('demo2'),
            'state' => AccountConstant::USER_STATE_PROCESSING,
            // 'state' => AccountConstant::USER_STATE_PAID,
            'direct_user_id'          => $user21->id,
            'indirect_user_id'          => $demoUser->id,
            'email_verified_at' => now(),
        ]);
        $user27 = User::create([
            'id' => Str::uuid()->toString(),
            'first_name'        => $faker->firstName,
            'last_name'         => $faker->lastName,
            'email'             => $faker->unique()->safeEmail,
            'password'          => Hash::make('demo'),
            'password2'          => Hash::make('demo2'),
            'state' => AccountConstant::USER_STATE_PROCESSING,
            // 'state' => AccountConstant::USER_STATE_PAID,
            'direct_user_id'          => $user21->id,
            'indirect_user_id'          => $demoUser->id,
            'email_verified_at' => now(),
        ]);
        $user28 = User::create([
            'id' => Str::uuid()->toString(),
            'first_name'        => $faker->firstName,
            'last_name'         => $faker->lastName,
            'email'             => $faker->unique()->safeEmail,
            'password'          => Hash::make('demo'),
            'password2'          => Hash::make('demo2'),
            'state' => AccountConstant::USER_STATE_PROCESSING,
            // 'state' => AccountConstant::USER_STATE_PAID,
            'direct_user_id'          => $user22->id,
            'indirect_user_id'          => $demoUser->id,
            'email_verified_at' => now(),
        ]);
        $user29 = User::create([
            'id' => Str::uuid()->toString(),
            'first_name'        => $faker->firstName,
            'last_name'         => $faker->lastName,
            'email'             => $faker->unique()->safeEmail,
            'password'          => Hash::make('demo'),
            'password2'          => Hash::make('demo2'),
            'state' => AccountConstant::USER_STATE_PROCESSING,
            // 'state' => AccountConstant::USER_STATE_PAID,
            'direct_user_id'          => $user22->id,
            'indirect_user_id'          => $demoUser->id,
            'email_verified_at' => now(),
        ]);
        $user30 = User::create([
            'id' => Str::uuid()->toString(),
            'first_name'        => $faker->firstName,
            'last_name'         => $faker->lastName,
            'email'             => $faker->unique()->safeEmail,
            'password'          => Hash::make('demo'),
            'password2'          => Hash::make('demo2'),
            'state' => AccountConstant::USER_STATE_PROCESSING,
            // 'state' => AccountConstant::USER_STATE_PAID,
            'direct_user_id'          => $user23->id,
            'indirect_user_id'          => $demoUser->id,
            'email_verified_at' => now(),
        ]);
        $user31 = User::create([
            'id' => Str::uuid()->toString(),
            'first_name'        => $faker->firstName,
            'last_name'         => $faker->lastName,
            'email'             => $faker->unique()->safeEmail,
            'password'          => Hash::make('demo'),
            'password2'          => Hash::make('demo2'),
            'state' => AccountConstant::USER_STATE_PROCESSING,
            // 'state' => AccountConstant::USER_STATE_PAID,
            'direct_user_id'          => $user23->id,
            'indirect_user_id'          => $demoUser->id,
            'email_verified_at' => now(),
        ]);
        
        $user7 = User::create([
            'id' => Str::uuid()->toString(),
            'first_name'        => $faker->firstName,
            'last_name'         => $faker->lastName,
            'email'             => $faker->unique()->safeEmail,
            'password'          => Hash::make('demo'),
            'password2'          => Hash::make('demo2'),
            'state' => AccountConstant::USER_STATE_PROCESSING,
            // 'state' => AccountConstant::USER_STATE_PAID,
            'direct_user_id'          => $user6->id,
            'indirect_user_id'          => $demoUser->id,
            'email_verified_at' => now(),
        ]);

        $user8= User::create([
            'id' => Str::uuid()->toString(),
            'first_name'        => $faker->firstName,
            'last_name'         => $faker->lastName,
            'email'             => $faker->unique()->safeEmail,
            'password'          => Hash::make('demo'),
            'password2'          => Hash::make('demo2'),
            'state' => AccountConstant::USER_STATE_PROCESSING,
            // 'state' => AccountConstant::USER_STATE_PAID,
            'direct_user_id'          => $user6->id,
            'indirect_user_id'          => $demoUser->id,
            'email_verified_at' => now(),
        ]);

        $user9= User::create([
            'id' => Str::uuid()->toString(),
            'first_name'        => $faker->firstName,
            'last_name'         => $faker->lastName,
            'email'             => $faker->unique()->safeEmail,
            'password'          => Hash::make('demo'),
            'password2'          => Hash::make('demo2'),
            'state' => AccountConstant::USER_STATE_PROCESSING,
            // 'state' => AccountConstant::USER_STATE_PAID,
            'direct_user_id'          => $user5->id,
            'indirect_user_id'          => $demoUser->id,
            'email_verified_at' => now(),
        ]);

        $user10= User::create([
            'id' => Str::uuid()->toString(),
            'first_name'        => $faker->firstName,
            'last_name'         => $faker->lastName,
            'email'             => $faker->unique()->safeEmail,
            'password'          => Hash::make('demo'),
            'password2'          => Hash::make('demo2'),
            'state' => AccountConstant::USER_STATE_PROCESSING,
            // 'state' => AccountConstant::USER_STATE_PAID,
            'direct_user_id'          => $user5->id,
            'indirect_user_id'          => $demoUser->id,
            'email_verified_at' => now(),
        ]);

        Income::create([
            'user_id'        => $user1->id,
            'coin'             => 10,
        ]);
        Income::create([
            'user_id'        => $demoUser->id,
            'coin'             => 1,
        ]);
        Transfer::create([
            'sender_id'        => $demoUser->id,
            'receiver_id'         => $user6->id,
            'coin'             => 40,
        ]);

        $user11= User::create([
            'id' => Str::uuid()->toString(),
            'first_name'        => $faker->firstName,
            'last_name'         => $faker->lastName,
            'email'             => $faker->unique()->safeEmail,
            'password'          => Hash::make('demo'),
            'password2'          => Hash::make('demo2'),
            'state' => AccountConstant::USER_STATE_PROCESSING,
            // 'state' => AccountConstant::USER_STATE_PAID,
            'direct_user_id'          => $user7->id,
            'indirect_user_id'          => $demoUser->id,
            'email_verified_at' => now(),
        ]);

        $user12= User::create([
            'id' => Str::uuid()->toString(),
            'first_name'        => $faker->firstName,
            'last_name'         => $faker->lastName,
            'email'             => $faker->unique()->safeEmail,
            'password'          => Hash::make('demo'),
            'password2'          => Hash::make('demo2'),
            'state' => AccountConstant::USER_STATE_PROCESSING,
            // 'state' => AccountConstant::USER_STATE_PAID,
            'direct_user_id'          => $user7->id,
            'indirect_user_id'          => $demoUser->id,
            'email_verified_at' => now(),
        ]);

        $user13= User::create([
            'id' => Str::uuid()->toString(),
            'first_name'        => $faker->firstName,
            'last_name'         => $faker->lastName,
            'email'             => $faker->unique()->safeEmail,
            'password'          => Hash::make('demo'),
            'password2'          => Hash::make('demo2'),
            'state' => AccountConstant::USER_STATE_PROCESSING,
            // 'state' => AccountConstant::USER_STATE_PAID,
            'direct_user_id'          => $user8->id,
            'indirect_user_id'          => $demoUser->id,
            'email_verified_at' => now(),
        ]);

        $user14= User::create([
            'id' => Str::uuid()->toString(),
            'first_name'        => $faker->firstName,
            'last_name'         => $faker->lastName,
            'email'             => $faker->unique()->safeEmail,
            'password'          => Hash::make('demo'),
            'password2'          => Hash::make('demo2'),
            'state' => AccountConstant::USER_STATE_PROCESSING,
            // 'state' => AccountConstant::USER_STATE_PAID,
            'direct_user_id'          => $user8->id,
            'indirect_user_id'          => $demoUser->id,
            'email_verified_at' => now(),
        ]);

        $user15= User::create([
            'id' => Str::uuid()->toString(),
            'first_name'        => $faker->firstName,
            'last_name'         => $faker->lastName,
            'email'             => $faker->unique()->safeEmail,
            'password'          => Hash::make('demo'),
            'password2'          => Hash::make('demo2'),
            'state' => AccountConstant::USER_STATE_PROCESSING,
            // 'state' => AccountConstant::USER_STATE_PAID,
            'direct_user_id'          => $user9->id,
            'indirect_user_id'          => $demoUser->id,
            'email_verified_at' => now(),
        ]);
        $user16= User::create([
            'id' => Str::uuid()->toString(),
            'first_name'        => $faker->firstName,
            'last_name'         => $faker->lastName,
            'email'             => $faker->unique()->safeEmail,
            'password'          => Hash::make('demo'),
            'password2'          => Hash::make('demo2'),
            'state' => AccountConstant::USER_STATE_PROCESSING,
            // 'state' => AccountConstant::USER_STATE_PAID,
            'direct_user_id'          => $user9->id,
            'indirect_user_id'          => $demoUser->id,
            'email_verified_at' => now(),
        ]);

        $user17= User::create([
            'id' => Str::uuid()->toString(),
            'first_name'        => $faker->firstName,
            'last_name'         => $faker->lastName,
            'email'             => $faker->unique()->safeEmail,
            'password'          => Hash::make('demo'),
            'password2'          => Hash::make('demo2'),
            'state' => AccountConstant::USER_STATE_PROCESSING,
            // 'state' => AccountConstant::USER_STATE_PAID,
            'direct_user_id'          => $user10->id,
            'indirect_user_id'          => $demoUser->id,
            'email_verified_at' => now(),
        ]);

        $user17= User::create([
            'id' => Str::uuid()->toString(),
            'first_name'        => $faker->firstName,
            'last_name'         => $faker->lastName,
            'email'             => $faker->unique()->safeEmail,
            'password'          => Hash::make('demo'),
            'password2'          => Hash::make('demo2'),
            'state' => AccountConstant::USER_STATE_PROCESSING,
            // 'state' => AccountConstant::USER_STATE_PAID,
            'direct_user_id'          => $user10->id,
            'indirect_user_id'          => $demoUser->id,
            'email_verified_at' => now(),
        ]);

        // $this->addDummyInfo($faker, $demoUser);

        // User::factory(100)->create()->each(function (User $user) use ($faker) {
        //     $this->addDummyInfo($faker, $user);
        // });
    }

    private function addDummyInfo(Generator $faker, User $user)
    {
        $dummyInfo = [
            'company'  => $faker->company,
            'phone'    => $faker->phoneNumber,
            'website'  => $faker->url,
            'language' => $faker->languageCode,
            'country'  => $faker->countryCode,
        ];

        $info = new UserInfo();
        foreach ($dummyInfo as $key => $value) {
            $info->$key = $value;
        }
        $info->user()->associate($user);
        $info->save();
    }
}
