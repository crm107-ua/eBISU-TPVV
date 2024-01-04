<?php

namespace App\Services;

use App\Models\Business;

class BusinessService
{
    public function getBusinessPaginatedList() {
        return Business::paginate(10);
    }
}
