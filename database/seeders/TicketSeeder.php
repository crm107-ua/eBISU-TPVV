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
                'valoration_valoration' => 5,
                'valoration_comment' => 'The technician was extremely professional and kind. They quickly identified the problem and provided an effective solution. Their communication was clear and they ensured I understood the process. I am very satisfied with the service provided.',            ],
            [
                'title' => 'Error in Report Generation',
                'description' => 'The monthly report generation feature is not working.',
                'creation_date' => Carbon::now()->subDays(4),
                'state' => 'resolving',
                'priority' => 2,
                'attachment_id' => 2,
                'technitian_id' => 2,
                'transaction_id' => 2,
                'valoration_valoration' => 4,
                'valoration_comment' => 'While the technician was professional and kind, there were some issues encountered during the problem-solving process. Initially, the technician was quick to identify the problem and proposed a solution. However, during the implementation of the solution, an unexpected error occurred which caused a delay in the resolution. The technician communicated this promptly and worked diligently to resolve the error. Despite the setback, the technician remained committed to resolving the issue and eventually found a workaround. Although the process took longer than expected, the problem was ultimately solved. The technician\'s perseverance and transparency throughout the process were commendable. However, the delay caused some inconvenience.'            ],
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
                'valoration_valoration' => 2,
                'valoration_comment' => 'I am disappointed with the service provided by the technician. Despite multiple attempts to communicate the issue, the technician seemed to ignore my concerns. This lack of attention to customer needs is unacceptable. If this continues, I will be forced to look for other service providers. It\'s crucial for the technician to understand that effective communication and customer satisfaction are key to maintaining a good business relationship.'
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
