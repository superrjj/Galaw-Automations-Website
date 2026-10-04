<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        $faqs = [
            [
                'question' => 'How does the development process work?',
                'answer' => 'We start with discovery and requirements, then move through planning, design, development, testing, deployment, and ongoing support. Each stage is explained in plain language so you always know what is happening next.',
            ],
            [
                'question' => 'How long does a project take?',
                'answer' => 'Timelines depend on scope, complexity, integrations, and feedback cycles. After reviewing your requirements, we can provide a realistic estimate for your specific project.',
            ],
            [
                'question' => 'Can you build custom software?',
                'answer' => 'Yes. Custom software development is one of our core services, including business systems, internal tools, dashboards, and workflow applications.',
            ],
            [
                'question' => 'Do you develop mobile applications?',
                'answer' => 'Yes. Mobile app development is one of the services we offer. We can build Android, iOS, and cross-platform applications for business use.',
            ],
            [
                'question' => 'Can you integrate AI?',
                'answer' => 'Yes. We can integrate AI features such as assistants, document processing, recommendations, and automation when they provide clear business value.',
            ],
            [
                'question' => 'Can you integrate third-party APIs?',
                'answer' => 'Yes. We integrate REST APIs, payment providers, authentication services, and other third-party platforms as needed.',
            ],
            [
                'question' => 'Do you provide maintenance?',
                'answer' => 'Yes. We offer software maintenance and support after launch, including updates, fixes, and planned improvements.',
            ],
            [
                'question' => 'How can I request a project?',
                'answer' => 'Use the Start a Project form on the website. Share your goals, preferred service, timeline, and any useful details. Our team will review the inquiry and contact you.',
            ],
        ];

        foreach ($faqs as $index => $faq) {
            Faq::query()->updateOrCreate(
                ['question' => $faq['question']],
                [
                    'answer' => $faq['answer'],
                    'is_active' => true,
                    'sort_order' => $index + 1,
                ],
            );
        }
    }
}
