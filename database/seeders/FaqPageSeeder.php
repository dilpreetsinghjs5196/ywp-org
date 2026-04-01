<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PageContent;

class FaqPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. General FAQs (The first 28)
        $generalFaqs = [
            ['q' => '1. What is the vision of YWP;?', 'a' => 'The vision of You’re Wonderful Project; is to make mental health available and accessible for all.'],
            ['q' => '2. What does YWP; do?', 'a' => 'You’re Wonderful Project; works on raising awareness on mental health, encouraging acceptance of mental health difficulties, promoting prevention and facilitating intervention. We make this happen through a range of online and offline campaigns, events, workshops and training.'],
            ['q' => '3. How can we reach out to YWP; for peer support?', 'a' => 'YWP; online peer support team is available through our Facebook message option, Instagram DM option and via e-mail at helpteam.ywp@gmail.com. You can also reach out anonymously via our website chat.'],
            ['q' => '4. What kind of events does YWP; conduct?', 'a' => 'YWP conducts various mental health awareness events, workshops, and campaigns aimed at youth and professionals.'],
            ['q' => '5. What paid opportunities does YWP; offer?', 'a' => 'You’re Wonderful Project; does not offer any paid opportunities currently. However, the organisation reimburses organisational expenditure and recognises work through rewards and incentives.'],
            ['q' => '6. What is the structure of the organisation?', 'a' => 'There are three tiers: Tier 3 (On-ground awareness), Tier 2 (Online Peer Support Team), and Tier 1 (Board of psychologists).'],
            ['q' => '7. How can I apply to work with YWP;? Is there any age bar for applying?', 'a' => 'The organisation recruits through an intensive HR process. While primarily youth-run (under 30), there is no official age bar.'],
            ['q' => '8. What is the story behind YWP;?', 'a' => 'Started by Naman Dutt in 2014 as an online community, it became a registered trust in 2017 with a goal of suicide prevention.'],
            ['q' => '9. What are the various departments under YWP; and what do they do?', 'a' => 'Departments include Communications, Design, Creative, Help Team, Research & Development, Fundraising, and Admin (HR, Finance, Legal).'],
            ['q' => '10. What is SPEAK?', 'a' => 'SPEAK stands for School Programme for Emotional Acceptance and Knowledge, initiating dialogue among school students around Mental Health.'],
            ['q' => '11. How can one contribute in terms of donation?', 'a' => 'Donations can be made through donor cards ranging from 100 rs. to 50,000 rs., which come with various perks.'],
            ['q' => '12. What are the Equity policies of the organisation?', 'a' => 'We have policies for Sexual Misconduct and membership agreements to ensure a safe working environment.'],
            ['q' => '13. Who are the leaders of the organization?', 'a' => 'YWP was founded by Akhilesh Nair & Akash Saxena, with departments managed by dedicated Heads and Co-Heads.'],
            ['q' => '14. How do we nominate speakers and artists?', 'a' => 'Anyone can nominate artists and speakers using our provided online forms.'],
            ['q' => '15. What is the minimum duration for working with YWP;?', 'a' => 'The minimum duration is six months, focusing on building a strong network of like-minded individuals.'],
            ['q' => '16. What is mental health?', 'a' => 'Mental health is a state of well-being in which every individual realizes how they can cope with the normal stresses of life and can work productively.'],
            ['q' => '17. What is the difference between a counsellor, clinical psychologist and psychiatrist?', 'a' => 'Counsellors (MA) manage emotional problems. Clinical Psychologists (MPhil) evaluate and treat disorders. Psychiatrists (MD) can prescribe medicines.'],
            ['q' => '18. What is Cognitive Behaviour Therapy (CBT)?', 'a' => 'CBT is a common type of talk therapy that aims to help an individual with their emotions, behaviour, and goals by changing unhealthy beliefs.'],
            ['q' => '19. What do you need to look out for in a mental health professional?', 'a' => 'Identify your issues, look for specializations, and verify their educational qualifications and licenses.'],
            ['q' => '20. What role does psychiatric medication play?', 'a' => 'Psychiatric medication alters neurotransmitter levels to help manage symptoms, often combined with psychotherapy.'],
            ['q' => '21. What questions can you ask your mental health professional?', 'a' => 'Ask about the therapy process, expectations, therapeutic approach, and estimated timeline for signs of improvement.'],
            ['q' => '22. Who should seek counseling/therapy?', 'a' => 'Anyone distress by concerns that interfere with life, whether it is high-intensity disorders or daily stresses like exams or relationships.'],
            ['q' => '23. How long does counseling/therapy continue?', 'a' => 'There is no fixed timeline; it can range from a few sessions to years depending on the symptoms and goals.'],
            ['q' => '24. How to deal with grief, loneliness, or overwhelming emotions?', 'a' => 'Strategies include identifying emotions one at a time, engaging in hobbies, understanding the cause, and talking to someone.'],
            ['q' => '25. Why is a good support system essential for mental well-being?', 'a' => 'Social support provides strength during crisis, ensuring you are never alone facing challenges.'],
            ['q' => '26. Why is there stigma around psychiatric medication?', 'a' => 'Stigma exists due to "pill shaming", fear of side effects, or denial of mental health issues.'],
            ['q' => '27. How does one make sure if what they are feeling is sadness or depression?', 'a' => 'Sadness is natural; depression often includes hopelessness, lack of motivation, and lasts longer than two weeks.'],
            ['q' => '28. How affordable is mental healthcare?', 'a' => 'Average costs vary (Rs. 500-2000), but many work on a sliding scale or offer student discounts.'],
        ];

        // 2. FAQs about the Help Team
        $helpTeamFaqs = [
            ['q' => '1. How does the YWP; Peer Support Team work?', 'a' => 'The Peer Support Team consists of undergraduate and postgraduate students trained by professionals. They take up Direct and Indirect peer support, acting as a bridge to mental health practitioners.'],
            ['q' => '2. How to initiate conversations with Peer supporters?', 'a' => 'You can initiate conversation by sending a simple \'Hey\' on Instagram, Gmail, Twitter, or Facebook, or via our anonymous website chat.'],
            ['q' => '3. Understanding the mode of interaction with the Peer supporter?', 'a' => 'Interaction involves providing a safe space, referring to professionals, providing access to subsidized rates, and helping locate helpline numbers.'],
            ['q' => '4. What are the possible apprehensions that can hold you back?', 'a' => 'Concerns about confidentiality and anonymity are common. YWP ensures strict confidentiality and prompt responses.'],
            ['q' => '5. What to do if I am worried about a relative’s mental health?', 'a' => 'Pay attention, provide emotional support, create a non-judgemental environment, and encourage them to visit a professional.'],
            ['q' => '6. What do I do if I need urgent help?', 'a' => 'Contact 24/7 helplines. YWP maintains an extensive database of these helplines for your reference.'],
            ['q' => '7. How do I make a complaint about the conduct of a counselor/therapist?', 'a' => 'File an official complaint with the Rehabilitation Council of India (RCI) or the Indian Association of Clinical Psychologists (IACP).'],
        ];

        // 3. ADDITIONAL QUESTIONS
        $additionalFaqs = [
            ['q' => '1. How to deal with exam stress?', 'a' => 'Construct a time table, ensure adequate rest, connect with people, and trust your process.'],
            ['q' => '2. What is a toxic relationship? How do I break free?', 'a' => 'A relationship impacting mental health adversely is toxic. Seek professional help, talk to friends, and express your feelings.'],
            ['q' => '3. Practices to enhance mental health?', 'a' => 'Exercise, healthy diet, meditation, positive self-talk, and maintaining a good sleep cycle.'],
        ];

        // FAQ Page Header
        PageContent::updateOrCreate(['page' => 'faq', 'section' => 'header', 'key' => 'title'], ['value' => 'FAQs', 'type' => 'text']);
        PageContent::updateOrCreate(['page' => 'faq', 'section' => 'header', 'key' => 'bg_image'], ['value' => 'images/fundraishing-bg.jpg', 'type' => 'image']);

        // General FAQs
        foreach ($generalFaqs as $index => $faq) {
            PageContent::updateOrCreate(['page' => 'faq', 'section' => 'faq', 'key' => "faq{$index}_question"], ['value' => $faq['q'], 'type' => 'text']);
            PageContent::updateOrCreate(['page' => 'faq', 'section' => 'faq', 'key' => "faq{$index}_answer"], ['value' => $faq['a'], 'type' => 'textarea']);
        }

        // Help Team Section
        PageContent::updateOrCreate(['page' => 'faq', 'section' => 'help_team', 'key' => 'title'], ['value' => 'FAQs about the Help Team', 'type' => 'text']);
        PageContent::updateOrCreate(['page' => 'faq', 'section' => 'help_team', 'key' => 'description'], ['value' => 'For visitors, in the website itself : Introduction to what we do, how first time visitors can initiate conversations with our peer supporters; expected role of peer supporters specified on website; exploring apprehensions and thoughts of people reaching out for their first sessions, to make them feel more comfortable and more understood.', 'type' => 'textarea']);
        foreach ($helpTeamFaqs as $index => $faq) {
            PageContent::updateOrCreate(['page' => 'faq', 'section' => 'help_team', 'key' => "faq{$index}_question"], ['value' => $faq['q'], 'type' => 'text']);
            PageContent::updateOrCreate(['page' => 'faq', 'section' => 'help_team', 'key' => "faq{$index}_answer"], ['value' => $faq['a'], 'type' => 'textarea']);
        }

        // Additional Questions Section
        PageContent::updateOrCreate(['page' => 'faq', 'section' => 'additional', 'key' => 'title'], ['value' => 'ADDITIONAL QUESTIONS', 'type' => 'text']);
        foreach ($additionalFaqs as $index => $faq) {
            PageContent::updateOrCreate(['page' => 'faq', 'section' => 'additional', 'key' => "faq{$index}_question"], ['value' => $faq['q'], 'type' => 'text']);
            PageContent::updateOrCreate(['page' => 'faq', 'section' => 'additional', 'key' => "faq{$index}_answer"], ['value' => $faq['a'], 'type' => 'textarea']);
        }

        // 4. R&D Exploration Blog Ideas
        $blogIdeas = [
            'Are you kind to yourself ?',
            'What is my sexual orientation?',
            'Shame in mental illness, medicalisation, how to replace shame with openness and support in family? Is anyone “normal”? Do I need to “fix” my mental state?.',
            'Belongingness',
            'Seeking help in case of sexual abuse',
            'Understanding love',
            'Bereavement and loss',
            'Feeling low',
            'Feeling lonely',
            'Self harming',
            'Relationship problems',
            'Feeling suicidal',
            'Feeling stressed or anxious'
        ];
        PageContent::updateOrCreate(['page' => 'faq', 'section' => 'rd_blogs', 'key' => 'title'], ['value' => 'R&D Exploration Blog Ideas', 'type' => 'text']);
        foreach ($blogIdeas as $index => $idea) {
            PageContent::updateOrCreate(['page' => 'faq', 'section' => 'rd_blogs', 'key' => "idea{$index}"], ['value' => $idea, 'type' => 'text']);
        }

        // 5. Further topics for exploration
        $topics = [
            'Bullying, Mental Health and Help Seeking?',
            'Does seeking help make you weak?',
            'Is emotional vulnerability desirable?',
            'How does a therapeutic alliance work?',
            'How do I remove the stigma around mental health?',
            'How do I encourage my family and friends to see a psychologist?',
            'How to tell my parents I’m seeing a counsellor or therapist?',
            'A brief introduction to all psychological disorders'
        ];
        PageContent::updateOrCreate(['page' => 'faq', 'section' => 'further_topics', 'key' => 'title'], ['value' => 'Further topics for exploration (Pitch in ideas)', 'type' => 'text']);
        foreach ($topics as $index => $topic) {
            PageContent::updateOrCreate(['page' => 'faq', 'section' => 'further_topics', 'key' => "topic{$index}"], ['value' => $topic, 'type' => 'text']);
        }

        // 6. REFERENCES
        $references = [
            'World Health Organization. Promoting mental health: concepts, emerging evidence, practice (Summary Report) Geneva: World Health Organization; 2004. [Google Scholar] [Ref list]',
            'CBT. (2019, April 19). Clear View Counseling Center. https://clearviewcounselingcenter.com/cbt/',
            'American Psychological Association. Manage Stress: Strengthen Your Support Network. Updated October 2019.',
            'How do I know if I need therapy? (2017, July 31). American Psychological Association. Retrieved from https://www.apa.org/ptsd-guideline/patients-and-families/seeking-therapy.aspx',
            'Raypole, B. C. (2019, January 18). Why Should I Go to Therapy? 8 Signs It’s Time to See a Therapist. GoodTherapy.Org Therapy Blog. https://www.goodtherapy.org/blog/why-should-i-go-to-therapy-8-signs-its-time-to-see-a-therapist-0118197',
            'What is Cognitive Behavioural Therapy? (2017, July). American Psychological Association.Retrieved from https://www.apa.org/ptsd-guideline/patients-and-families/cognitive-behavioral'
        ];
        PageContent::updateOrCreate(['page' => 'faq', 'section' => 'references', 'key' => 'title'], ['value' => 'References', 'type' => 'text']);
        foreach ($references as $index => $ref) {
            PageContent::updateOrCreate(['page' => 'faq', 'section' => 'references', 'key' => "ref{$index}"], ['value' => $ref, 'type' => 'text']);
        }
    }
}
