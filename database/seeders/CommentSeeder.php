<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Comment;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Comment::truncate();
        
        $comments = [
            [
                'message' => 'This is the first comment.',
                'sent_date' => Carbon::now()->subDays(4),
                'author_id' => 3,
                'attachment_id' => 1,
                'ticket_id' => 1,
            ],
            [
                'message' => 'This is the second comment.',
                'sent_date' => Carbon::now()->subDays(3),
                'author_id' => 4,
                'attachment_id' => 2,
                'ticket_id' => 2,
            ],
            [
                'message' => 'This is a comment.',
                'sent_date' => Carbon::now()->subDays(4),
                'author_id' => 3,
                'attachment_id' => 3,
                'ticket_id' => 3,
            ],
            [
                'message' => 'This is a comment 2.',
                'sent_date' => Carbon::now()->subDays(3),
                'author_id' => 4,
                'attachment_id' => 4,
                'ticket_id' => 4,
            ],
        ];

        foreach ($comments as $comment) {
            DB::table('comments')->insert($comment);
        }
    }
}