<?php
use App\Models\PageContent;

$faqs = [
    [
        'question' => 'What is the vision of YWP;?',
        'answer' => 'The vision of You’re Wonderful Project; is to make mental health available and accessible for all.'
    ],
    [
        'question' => 'What does YWP; do?',
        'answer' => 'You’re Wonderful Project; works on raising awareness on mental health, encouraging acceptance of mental health difficulties, promoting prevention and facilitating intervention. We make this happen through a range of online and offline campaigns, events, workshops and training. These initiatives are in addition to the work our dedicated team puts in towards the same ends.'
    ],
    [
        'question' => 'How can we reach out to YWP; for peer support?',
        'answer' => 'YWP; online peer support team is available through our Facebook message option, Instagram DM option and via e-mail at helpteam.ywp@gmail.com If you prefer to reach out anonymously, you can do so using an anonymous account. You can also chat on our website and someone will respond live to your queries or be there to support. In that case, your identity will remain anonymous. In addition, the peer support team at YWP; assures confidentiality of all the information for everyone contacting us for support.'
    ],
    [
        'question' => 'What kind of events does YWP; conduct?',
        'answer' => 'There are many variations of passages the majority have suffered alteration in some fo injected humour, or randomised words believable.'
    ],
    [
        'question' => 'What paid opportunities does YWP; offer?',
        'answer' => 'You’re Wonderful Project; does not offer any paid opportunities currently. However, the organisation reimburses any organisational expenditure incurred by the members in the course of the working of the organisation. Further, the organisation does recognise the work of the members in the form of rewards and incentives.'
    ],
    [
        'question' => 'What is the structure of the organisation?',
        'answer' => 'There are three tiers on which You’re Wonderful Project; operates. On the third tier, through our programs like SPEAK, Our Happy Place and Workplace Mental Health we raise awareness and set up peer support groups on the ground level. At tier 2, we address all the queries and cases which come from tier 3 with the help of our online Peer Support Team, create engaging online content and conduct courses, seminars, webinars and workshops for raising awareness about mental health.'
    ]
];

foreach ($faqs as $index => $faq) {
    PageContent::updateOrCreate(
        ['page' => 'home', 'section' => 'faq', 'key' => "faq{$index}_question"],
        ['value' => $faq['question'], 'type' => 'text']
    );
    PageContent::updateOrCreate(
        ['page' => 'home', 'section' => 'faq', 'key' => "faq{$index}_answer"],
        ['value' => $faq['answer'], 'type' => 'textarea']
    );
}

echo "Successfully seeded " . count($faqs) . " FAQs into page_contents table.\n";
