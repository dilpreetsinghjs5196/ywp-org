<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Report;

class ReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $reports = [
            [
                'title' => 'Mental Health Awareness amongst School Students across Delhi, NCR: A Pilot Study',
                'description' => 'The study was aimed at initiating a conversation about the importance of mental health among school children. This project has been founded with the aim to equip 6th-8th graders with the knowledge of common mental health issues through the process of a) creating awareness, b) encouraging acceptance, c) ensuring prevention, and d) assisting with cure. For this study, a qualitative design was used. This study is a pilot study that will further help to understand how to ensure the effectiveness of the SPEAK program, as well as conduct more enhanced workshops around mental health awareness among school students.',
                'image' => 'images/gallery/paper/SPEAK-Pilot.png',
                'link' => 'https://drive.google.com/file/d/13W7tESwu72J07Be16zSR2BkqLT-Nt_mW/view?usp=sharing',
                'order' => 1
            ],
            [
                'title' => 'Perception on Mental Illness: Gauging Perceptions of 15-65 year olds in Pan-India',
                'description' => 'The study aimed to assess the perception of common people on mental illnesses. For the purpose of the study, a mixed-method design was used. The results indicated that males had significantly higher authoritarian attitudes towards the mentally ill than females. The content analysis of qualitative data revealed that the picture is not entirely bleak as there exists some familiarity with and awareness about mental health and contingent issues, but there is still immense scope in increasing the sensitisation toward mental health awareness.',
                'image' => 'images/gallery/paper/Perception StudyPaper.png',
                'link' => 'https://drive.google.com/file/d/1MlbS6HszFqRJuehPICLpzUl0LbQrE0TC/view?usp=sharing',
                'order' => 2
            ],
            [
                'title' => 'A qualitative study: effect of sport participation on general mental health of athletes with intellectual disabilities from special Olympics Bharat',
                'description' => 'The qualitative study aimed at exploring the effect of sports participation on the general mental health of athletes with intellectual disabilities from Special Olympics Bharat. In-depth interviews were conducted with 20 athletes with intellectual disabilities from various states of India and thematic analysis of the data has been carried out. The analysis and findings concluded that participating in sports help enhance an athlete’s confidence, their relationships and helps them become more independent.',
                'image' => 'images/gallery/paper/studymentalhealth ofathletes.png',
                'link' => 'https://drive.google.com/file/d/18aTI4gVtNxRIWnGJUI0_ejWQ1jAZhaqa/view',
                'order' => 3
            ],
            [
                'title' => 'Impact of Trauma in Sexual Assault Victims',
                'description' => 'This is a review that examines the role that trauma plays in sexual assault survivors’ well-being and prevalent interventions that facilitate healing and recovery. This study also highlights the role played by differences in cultural backgrounds and gender identities in aggravating the trauma associated with sexual violence. For this review, six databases of academic research were searched for studies on the impact of sexual assault on cisgendered females and transgendered females.',
                'image' => 'images/gallery/paper/Research in RnD.png',
                'link' => 'https://docs.google.com/document/d/1_KL2yLsE30WBf6uh2AqF949S84rLoByuJF-O7qrqGHE/edit',
                'order' => 4
            ],
            [
                'title' => 'Indian Farmers Protest and its Impact on the Mental Health of the Farmers',
                'description' => 'The challenges faced by Indian farmers have been a topic of conversation in the media for the last couple of decades. While these protests tend to disrupt the life of a farmer, their impact is experienced nationwide. The present study aimed at understanding the impact of the Indian Farmers’ Protest against the three newly introduced Farm Bills on the mental health of the agronomists from the states of Haryana and Punjab. The objective of the study was to understand the impact on the mental and emotional wellbeing of the farmers from a psycho-socio-political lens. Findings revealed that processes like motivation, attribution, and locus of control promoted certain elements.',
                'image' => 'images/gallery/paper/ECPP-21-RA-299.png',
                'link' => 'https://drive.google.com/file/d/1ArGllr4vFiXaJuqNSLNjYhHg1KpcNcoa/view',
                'order' => 5
            ],
            [
                'title' => 'Effectiveness of an online Peer Support Model: A quantitative Study',
                'description' => 'The paper explores how effective is the process of providing peer support counselling to those who are seeking help for their mental health. The Effectiveness of the Online Peer support Model was studied using a sample of 25 individuals who have taken online peer support counselling. Overall the results of the study were positive with the participants reporting that they felt better and stated that the peer support helped them in overcoming certain concerns and living life more healthily.',
                'image' => 'images/gallery/paper/online Peer Support Model.png',
                'link' => 'https://drive.google.com/file/d/1XBQg6qSYILQlETPyXj9qPZisc2vit-Xa/view',
                'order' => 6
            ],
            [
                'title' => 'Exploration of mental health in Disney',
                'description' => 'The study was conducted to assess whether there exists an adequate representation of psychological disorders in famous Disney characters. A single-blind design was used to select 5 participants who were assigned Disney movies to watch and were told to observe the character’s behaviors and actions. Observations were made on the following criteria general observations, childhood and family history, cognitive, affective, and behavioral components, history of abuse or psychiatric disorders, and a conclusion about the character.',
                'image' => 'images/gallery/paper/Exploration.png',
                'link' => 'https://drive.google.com/file/d/1AeT9c69t3XbS9N72IoTHfQ4H37A3VFbv/view',
                'order' => 7
            ],
            [
                'title' => 'Exploring the Experiences of an online Peer Support Service : An Inward Approach',
                'description' => 'You’re Wonderful Project, is a student-run organization that provides online peer support to increase the accessibility and affordability of mental health services to everyone. The study was conducted to assess the effectiveness of the Online Peer Support Model and to study the growth and experiences of the Peer Support team of YWP. Qualitative method was used to collect data. Data was collected from 18 participants who had been working for 6 months in the Peer Support Team of YWP. 6 Major themes were explored in the study.',
                'image' => 'images/gallery/paper/ExperiencesofOnlinePeerSupport.png',
                'link' => 'https://drive.google.com/file/d/1Qsra0wnVpqhe5uSzLSiPGQ4vJ9AvlL-9/view',
                'order' => 8
            ],
            [
                'title' => 'Impact of Trauma/Sexual Assault Victims',
                'description' => '',
                'image' => 'images/gallery/paper/trauma.jpeg',
                'link' => '',
                'order' => 9
            ],
            [
                'title' => 'Pilot Study',
                'description' => '',
                'image' => 'images/gallery/paper/pilot.jpg',
                'link' => '',
                'order' => 10
            ],
            [
                'title' => 'Final Links',
                'description' => '',
                'image' => 'images/gallery/paper/finallinks.jpeg',
                'link' => '',
                'order' => 11
            ],
            [
                'title' => 'Perception',
                'description' => '',
                'image' => 'images/gallery/paper/Perception.png',
                'link' => '',
                'order' => 12
            ],
            [
                'title' => 'SPEAK Campaign Report',
                'description' => 'SPEAK was started with a vision to initiate conversations about mental health and its importance among school children. According to the WHO, suicide is the second leading cause of death in the age groups of 15-29-year-olds. since research in India is minimal with regards to school-based mental health interventions, we first did an assessment through a pilot study identifying the risk factors among students of Delhi NCR through a qualitative study. Thereafter, an intervention at the school level was planned for students of the age group of 10-14 years.',
                'image' => 'images/gallery/paper/SPEAK Campaign Report.png',
                'link' => 'https://drive.google.com/file/d/1aciyM-5jZiUOMNM3KG52Ao2lqfGslFwJ/view',
                'order' => 13
            ],
        ];

        foreach ($reports as $report) {
            Report::create($report);
        }
    }
}
