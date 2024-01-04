<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Attachment;

class AttachmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Attachment::truncate();
        
        $attachments = [
            [
                'filename' => 'sample_document_1.pdf',
                'upload_date' => Carbon::now(),
            ],
            [
                'filename' => 'image_2.png',
                'upload_date' => Carbon::now(),
            ],
            [
                'filename' => 'image_3.png',
                'upload_date' => Carbon::now(),
            ],
            [
                'filename' => 'image_new.png',
                'upload_date' => Carbon::now(),
            ],
            [
                'filename' => 'image_local.png',
                'upload_date' => Carbon::now(),
            ],
            [
                'filename' => 'sample_document_1322323.pdf',
                'upload_date' => Carbon::now(),
            ],
            [
                'filename' => 'image_24354.png',
                'upload_date' => Carbon::now(),
            ],
            [
                'filename' => 'image_3656565.png',
                'upload_date' => Carbon::now(),
            ],
            [
                'filename' => 'image_new_45422.png',
                'upload_date' => Carbon::now(),
            ],
            [
                'filename' => 'image_local_434332.png',
                'upload_date' => Carbon::now(),
            ],
        ];

        foreach ($attachments as $attachment) {
            DB::table('attachments')->insert($attachment);
        }
    }
}