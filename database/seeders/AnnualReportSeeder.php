<?php

namespace Database\Seeders;

use App\Models\AnnualReport;
use Illuminate\Database\Seeder;

class AnnualReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $reports = [
            [
                'title' => 'Annual Report 2019-2020',
                'description' => 'Started as a student-run organisation, You’re wonderful project; works towards mental health awareness and accessibility. It tackles mental health-related issues and works towards removing the stigma around the same. The aim of the organisation is 4 fold which includes raising awareness, encouraging acceptance of mental health, promoting prevention and facilitating intervention.',
                'link' => 'images/reports/report2019.pdf',
                'image' => 'images/gallery/paper/Annual Report 2020-2021.png',
                'order' => 1
            ],
            [
                'title' => 'Annual Report 2020-2021',
                'description' => 'The novel coronavirus pandemic made its way in the year 2020-21. This unprecedented situation was difficult for everyone to cope with. Even we as an organisation, were initially at a standstill but we made it through!',
                'link' => 'images/reports/Annual report 2020 YWP.pdf',
                'image' => 'images/gallery/paper/Annual Report 2019-2020.png',
                'order' => 2
            ],
            [
                'title' => 'Annual Report 2021-2022',
                'description' => 'With a dedicated team of members from different walks of life, the organisation provides a forum for expression by individuals mainly through art, dialogues, and articles that are research-oriented.',
                'link' => 'images/reports/Annual report 2021-22 YWP.pdf',
                'image' => 'images/gallery/paper/Annual Report 2021-2022.png',
                'order' => 3
            ]
        ];

        foreach ($reports as $r) {
            AnnualReport::create($r);
        }
    }
}
