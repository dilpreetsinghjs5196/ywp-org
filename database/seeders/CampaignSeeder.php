<?php

namespace Database\Seeders;

use App\Models\Campaign;
use Illuminate\Database\Seeder;

class CampaignSeeder extends Seeder
{
    public function run()
    {
        Campaign::updateOrCreate(
            ['title' => 'Confessions Unplugged'],
            [
                'category' => 'Event Franchise',
                'description' => 'Confessions Unplugged was an 8 edition event franchise that provided attendees with an anonymous platform to share their thoughts and feelings and a safe space with like-minded people.',
                'link' => '/campaigns#confessions-unplugged'
            ]
        );

        Campaign::updateOrCreate(
            ['title' => 'S.P.E.A.K.'],
            [
                'category' => 'School Program',
                'description' => "You're Wonderful Project launched its pilot program for schools in Delhi NCR, S.P.E.A.K. - School Program For Emotional Acceptance and Knowledge. The focus of the program was to start a discussion amongst school children about mental health and its significance, enabling students to better understand and support themselves as well as their peers. The campaign reached out to more than 50 schools across the city, enabling conversation around mental health amongst more than 15,000 students.",
                'link' => '/campaigns#speak'
            ]
        );

        Campaign::updateOrCreate(
            ['title' => 'Disorder Dialogues'],
            [
                'category' => 'Awareness Campaign',
                'description' => "A dedicated platform for open conversations about various mental health disorders, aimed at reducing stigma and providing accurate information to the community through lived experiences and expert insights.",
                'link' => '/campaigns#disorder-dialogues'
            ]
        );
    }
}
