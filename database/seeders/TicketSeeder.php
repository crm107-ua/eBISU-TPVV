<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\Ticket;
use Illuminate\Support\Facades\DB;


class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Ticket::truncate();

        $tickets = [
            [
                'title' => 'Issue with Login',
                'description' => 'User reports being unable to login with their credentials.',
                'creation_date' => Carbon::now()->subDays(5),
                'state' => 'open',
                'priority' => 1,
                'attachment_id' => 1,
                'technitian_id' => 2,
                'transaction_id' => 1,
            ],
            [
                'title' => 'Error in Report Generation',
                'description' => 'The monthly report generation feature is not working.',
                'creation_date' => Carbon::now()->subDays(4),
                'state' => 'resolving',
                'priority' => 2,
                'attachment_id' => 2,
                'technitian_id' => 2,
                'transaction_id' => 2,
            ],
            [
                'title' => 'Issue with Login',
                'description' => 'User reports being unable to login with their credentials.',
                'creation_date' => Carbon::now()->subDays(5),
                'state' => 'open',
                'priority' => 1,
                'attachment_id' => 3,
                'technitian_id' => 2,
                'transaction_id' => 3,
            ],
            [
                'title' => 'Error in Report Generation',
                'description' => 'The monthly report generation feature is not working.',
                'creation_date' => Carbon::now()->subDays(4),
                'state' => 'resolving',
                'priority' => 2,
                'attachment_id' => 4,
                'technitian_id' => 2,
                'transaction_id' => 5,
            ],
            [
                'title' => 'Issue with Store',
                'description' => 'User reports being unable to login with their credentials.',
                'creation_date' => Carbon::now()->subDays(5),
                'state' => 'closed',
                'priority' => 1,
                'attachment_id' => 5,
                'technitian_id' => 2,
                'transaction_id' => 1,
            ],
            [
                'title' => 'Issue with Login',
                'description' => 'User reports being unable to login with their credentials.',
                'creation_date' => Carbon::now()->subDays(5),
                'state' => 'open',
                'priority' => 1,
                'attachment_id' => 7,
                'technitian_id' => 2,
                'transaction_id' => 5,
            ],
            [
                'title' => 'Error in Report Generation',
                'description' => 'The monthly report generation feature is not working.',
                'creation_date' => Carbon::now()->subDays(4),
                'state' => 'resolving',
                'priority' => 2,
                'attachment_id' => 8,
                'technitian_id' => 2,
                'transaction_id' => 6,
            ],
            [
                'title' => 'Issue with Login',
                'description' => 'User reports being unable to login with their credentials.',
                'creation_date' => Carbon::now()->subDays(5),
                'state' => 'open',
                'priority' => 1,
                'attachment_id' => 9,
                'technitian_id' => 2,
                'transaction_id' => 7,
            ],
            [
                'title' => 'Error in Report Generation',
                'description' => 'The monthly report generation feature is not working.',
                'creation_date' => Carbon::now()->subDays(4),
                'state' => 'resolving',
                'priority' => 2,
                'attachment_id' => 10,
                'technitian_id' => 2,
                'transaction_id' => 8,
            ],
            [
                'title' => 'Issue with Store',
                'description' => 'User reports being unable to login with their credentials.',
                'creation_date' => Carbon::now()->subDays(5),
                'state' => 'closed',
                'priority' => 1,
                'attachment_id' => 5,
                'technitian_id' => 2,
                'transaction_id' => 8,
            ]
        ];

        foreach ($tickets as $ticket) {
            DB::table('tickets')->insert($ticket);
        }
    }
}