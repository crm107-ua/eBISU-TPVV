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
                'issuer' => 'SampleIssuer13232',
                'expiration_date' => Carbon::now()->addYear(1),
                'times_used' => 0,
                'invalidated' => true,
                'business_id' => 3,
            ],
            [
                'issuer' => 'SampleIssuer12323',
                'expiration_date' => Carbon::now()->addYear(1),
                'times_used' => 0,
                'invalidated' => true,
                'business_id' => 3,
            ],
            [
                'issuer' => 'SampleIssuer1121221',
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
                'issuer' => 'SampleIssuer3232323',
                'expiration_date' => Carbon::now()->addYear(1),
                'times_used' => 0,
                'invalidated' => true,
                'business_id' => 4,
            ],
            [
                'issuer' => 'SampleIssuer323231212',
                'expiration_date' => Carbon::now()->addYear(1),
                'times_used' => 0,
                'invalidated' => true,
                'business_id' => 4,
            ],
            [
                'issuer' => 'SampleIssuer32321123',
                'expiration_date' => Carbon::now()->addYear(1),
                'times_used' => 0,
                'invalidated' => true,
                'business_id' => 4,
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