<?php

namespace Database\Seeders;

use App\Models\Business;
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

        // Get a portion of businesses
        $businesses = Business::limit(5)->get();

        foreach ($businesses as $business) {
            ApiToken::create([
                'issuer' => 'SampleIssuer' . $business->id,
                'expiration_date' => Carbon::now()->addYear(1),
                'times_used' => 0,
                'invalidated' => false,
                'business_id' => $business->id,
            ]);
        }
    }
}
