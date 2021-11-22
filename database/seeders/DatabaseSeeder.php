<?php

namespace Database\Seeders;

use App\Models\ProviderType;
use App\Models\Provider;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //User::truncate();
        ProviderType::truncate();
        Provider::truncate();

        // \App\Models\User::factory(10)->create();
        ProviderType::create([
            'name' => 'Public',
            'slug'  => 'public'
        ]);
        ProviderType::create([
            'name' => 'Private',
            'slug'  => 'private'
        ]);

        ProviderType::create([
            'name' => 'Non Profit',
            'slug'  => 'nonprofit'
        ]);

//        $n = 5;
//        $nproviders = 30; // number of providers to create
        \App\Models\Provider::factory(30)->create();

//       for($i=0; $i<$nproviders; $i++) {
//           Provider::create([
//               'twc_id' => rand(),
//               'name' => bin2hex(random_bytes($n)) . ' County College',
//               'url' => 'https://' . bin2hex(random_bytes($n)) . '.com/',
//               'description' => 'A description of provider',
//               'provider_type_id' => rand('1','3')
//           ]) ;
//       }


        //
//        Provider::create([
//            'twc_id' => '11112',
//            'name' => 'Middlesex County College',
//            'url' => 'www.mcc.edu',
//            'description' => 'A description of MCC',
//            'provider_type_id' => 1
//        ]) ;
//
//        Provider::create([
//            'twc_id' => '11113',
//            'name' => 'Middlesex County College',
//            'url' => 'www.mcc.edu',
//            'description' => 'A description of MCC',
//            'provider_type_id' => 3
//        ]) ;
//
//        Provider::create([
//            'twc_id' => '11114',
//            'name' => 'Middlesex County College',
//            'url' => 'www.mcc.edu',
//            'description' => 'A description of MCC',
//            'provider_type_id' => 3
//        ]) ;
//
//        Provider::create([
//            'twc_id' => '11115',
//            'name' => 'Middlesex County College',
//            'url' => 'www.mcc.edu',
//            'description' => 'A description of MCC',
//            'provider_type_id' => 2
//        ]) ;
//        Provider::create([
//            'twc_id' => '11116',
//            'name' => 'Middlesex County College',
//            'url' => 'www.mcc.edu',
//            'description' => 'A description of MCC',
//            'provider_type_id' => 2
//        ]) ;
//
//        Provider::create([
//            'twc_id' => '11117',
//            'name' => 'Middlesex County College',
//            'url' => 'www.mcc.edu',
//            'description' => 'A description of MCC',
//            'provider_type_id' => 1
//        ]) ;
    }
}
