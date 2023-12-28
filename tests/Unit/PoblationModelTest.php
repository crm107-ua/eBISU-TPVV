<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Support\Facades\Schema;

class PoblationModelTest extends TestCase
{
    public function test_check_poblation_model(){
        $this->assertTrue(Schema::hasTable('poblations'));
        $this->assertDatabaseHas('poblations', [
            'name' => 'Petrer',
        ]);
        $this->assertDatabaseHas('poblations', [
            'name' => 'Elda',
        ]);
    }
}
