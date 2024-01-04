<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\ApiToken;

class ApiTokenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
    
        ApiToken::truncate();
        
        $apiTokens = [
            [
                'issuer' => 'SampleIssuer1',
                'expiration_date' => Carbon::now()->addYear(1),
                'times_used' => 0,
                'invalidated' => true,
                'business_id' => 3,
            ],
            [
                'issuer' => 'SampleIssuer2',
                'expiration_date' => Carbon::now()->addYear(1),
                'times_used' => 0,
                'invalidated' => false,
                'business_id' => 3,
            ],
            [
                'issuer' => 'SampleIssuer3',
                'expiration_date' => Carbon::now()->addYear(1),
                'times_used' => 0,
                'invalidated' => false,
                'business_id' => 4,
            ],
        ];

        foreach ($apiTokens as $token) {
            DB::table('api_tokens')->insert($token);
        }
    }
}