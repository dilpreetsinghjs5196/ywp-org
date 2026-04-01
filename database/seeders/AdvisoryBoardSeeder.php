<?php

namespace Database\Seeders;

use App\Models\PageContent;
use Illuminate\Database\Seeder;

class AdvisoryBoardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $contents = [
            // Header section
            ['page' => 'advisory-board', 'section' => 'header', 'key' => 'title', 'value' => 'Advisory Board', 'type' => 'text'],
            ['page' => 'advisory-board', 'section' => 'header', 'key' => 'bg_image', 'value' => 'images/advisery.jpg', 'type' => 'image'],

            // Board Members section
            // Member 1
            ['page' => 'advisory-board', 'section' => 'members', 'key' => 'member1_name', 'value' => 'Dr. Preeti kapur', 'type' => 'text'],
            ['page' => 'advisory-board', 'section' => 'members', 'key' => 'member1_desc', 'value' => "Head of Department, Psychology, IILM University\nFormer Associate professor, Daulat Ram College, Delhi University (Retd.)\nAdvisor, Peer Support Team, You’re Wonderful Project;", 'type' => 'textarea'],
            ['page' => 'advisory-board', 'section' => 'members', 'key' => 'member1_image', 'value' => 'images/preeti.jpg', 'type' => 'image'],

            // Member 2
            ['page' => 'advisory-board', 'section' => 'members', 'key' => 'member2_name', 'value' => 'Dr. Nimesh Desai', 'type' => 'text'],
            ['page' => 'advisory-board', 'section' => 'members', 'key' => 'member2_desc', 'value' => "Director, Institute of Human Behaviour and Allied Sciences, Delhi since 2010.\nHe has served on the faculty of the NIMHANS, Bangalore from 1982 to 1988 and on the faculty of AIIMS, Delhi from 1988 to 1998.\nHe has been a member of key working groups of national organizations like NKC, NDMA and ICMR.", 'type' => 'textarea'],
            ['page' => 'advisory-board', 'section' => 'members', 'key' => 'member2_image', 'value' => 'images/nimesh2.jpg', 'type' => 'image'],

            // Member 3
            ['page' => 'advisory-board', 'section' => 'members', 'key' => 'member3_name', 'value' => 'Vikram Srihari', 'type' => 'text'],
            ['page' => 'advisory-board', 'section' => 'members', 'key' => 'member3_desc', 'value' => "Business Systems & CIO, Coca-Cola India, 2002 – 2004\nGuest Lecturer on Int'l Business, Xavier University, 1987 – 2000.\nHe is an alumnus of St. Stephens College, Delhi University and Indian Institute of Science, Bengaluru; with years of experience in Management and IT.\nExtensive experience in Hospitality, Retail, F&B, Beverages and Property and the creation of strategic blueprints for their implementation.", 'type' => 'textarea'],
            ['page' => 'advisory-board', 'section' => 'members', 'key' => 'member3_image', 'value' => 'images/vikram.png', 'type' => 'image'],

            // Member 4
            ['page' => 'advisory-board', 'section' => 'members', 'key' => 'member4_name', 'value' => 'Dr. Srishti Meera Sardana', 'type' => 'text'],
            ['page' => 'advisory-board', 'section' => 'members', 'key' => 'member4_desc', 'value' => "Dr. Srishti Meera Sardana is an internationally recognised researcher and psychologist specialising in global mental health and culturally sensitive interventions. With extensive research and clinical experience across India, the US, and humanitarian contexts, she focuses on supporting vulnerable populations, including youth and trauma survivors.\nDr. Sardana has developed evidence-based programs for mental health accessibility and currently leads the mhSEVA Lab, advancing innovative approaches for community well-being. As a YWP; advisor, she brings deep expertise in designing impactful, inclusive mental health initiatives for diverse groups.", 'type' => 'textarea'],
            ['page' => 'advisory-board', 'section' => 'members', 'key' => 'member4_image', 'value' => 'images/srishti.jpeg', 'type' => 'image'],
        ];

        foreach ($contents as $data) {
            PageContent::updateOrCreate(
                ['page' => $data['page'], 'section' => $data['section'], 'key' => $data['key']],
                ['value' => $data['value'], 'type' => $data['type']]
            );
        }
    }
}
