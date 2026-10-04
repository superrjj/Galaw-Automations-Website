<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'category' => 'Web Development',
                'name' => 'Website Development',
                'slug' => 'website-development',
                'short_description' => 'Professional business websites, landing pages, and CMS-driven sites.',
                'description' => 'We design and develop responsive websites that clearly present your brand, services, and calls to action. From corporate sites to custom web applications and admin dashboards, we focus on clarity, performance, and maintainability.',
                'icon' => 'globe',
                'features' => [
                    'Business and corporate websites',
                    'Landing pages',
                    'Admin dashboards',
                    'CMS websites',
                    'Custom web applications',
                    'Responsive and accessible layouts',
                ],
                'technologies' => ['Laravel', 'Blade', 'Tailwind CSS', 'Alpine.js', 'PostgreSQL', 'Vite'],
                'benefits' => [
                    'Clear messaging for potential clients',
                    'Mobile-responsive experience',
                    'Maintainable codebase',
                    'SEO-friendly page structure',
                ],
                'process_steps' => ['Discovery', 'Planning', 'Design', 'Development', 'Testing', 'Deployment', 'Support'],
                'faqs' => [
                    ['question' => 'Can you redesign an existing website?', 'answer' => 'Yes. We can rebuild or improve an existing website based on your goals, content, and technical constraints.'],
                    ['question' => 'Do you provide ongoing website support?', 'answer' => 'Yes. Maintenance and support can be included after launch.'],
                ],
                'sort_order' => 1,
            ],
            [
                'category' => 'Mobile App Development',
                'name' => 'Mobile App Development',
                'slug' => 'mobile-app-development',
                'short_description' => 'Business-focused Android, iOS, and cross-platform mobile applications.',
                'description' => 'We build mobile applications for business workflows, customer experiences, and internal operations. Mobile app development is one of our services — the Galaw Automations website itself is a web application, not a mobile app.',
                'icon' => 'smartphone',
                'features' => [
                    'Android applications',
                    'iOS applications',
                    'Cross-platform applications',
                    'React Native applications',
                    'Business mobile apps',
                    'API-backed mobile experiences',
                ],
                'technologies' => ['React Native', 'TypeScript', 'REST APIs', 'Laravel', 'PostgreSQL'],
                'benefits' => [
                    'Cross-platform delivery where appropriate',
                    'Business-focused feature planning',
                    'Secure API integration',
                    'Maintainable app architecture',
                ],
                'process_steps' => ['Discovery', 'Requirements', 'UI/UX Design', 'Development', 'Testing', 'Deployment', 'Support'],
                'faqs' => [
                    ['question' => 'Do you only build native apps?', 'answer' => 'No. We can build native or cross-platform apps depending on your requirements, timeline, and budget.'],
                    ['question' => 'Can the app connect to an existing backend?', 'answer' => 'Yes. We can integrate with existing APIs or build a new backend when needed.'],
                ],
                'sort_order' => 2,
            ],
            [
                'category' => 'Custom Software',
                'name' => 'Custom Software Development',
                'slug' => 'custom-software-development',
                'short_description' => 'Tailored software systems, internal tools, and workflow platforms.',
                'description' => 'We develop custom software that fits how your business actually works. This includes management systems, internal tools, dashboards, and workflow applications designed around your processes.',
                'icon' => 'code',
                'features' => [
                    'Business management systems',
                    'Internal tools',
                    'Management dashboards',
                    'Workflow systems',
                    'Custom enterprise software',
                    'Role-based access and admin controls',
                ],
                'technologies' => ['Laravel', 'PHP', 'PostgreSQL', 'Livewire', 'JavaScript', 'REST APIs'],
                'benefits' => [
                    'Software shaped around your process',
                    'Reduced manual work',
                    'Scalable architecture',
                    'Long-term maintainability',
                ],
                'process_steps' => ['Discovery', 'Requirements', 'Planning', 'Development', 'Testing', 'Deployment', 'Maintenance'],
                'faqs' => [
                    ['question' => 'Can you replace spreadsheets and manual processes?', 'answer' => 'Yes. Many projects start by turning manual workflows into structured, secure software systems.'],
                ],
                'sort_order' => 3,
            ],
            [
                'category' => 'Custom Software',
                'name' => 'Business System Development',
                'slug' => 'business-system-development',
                'short_description' => 'Operational systems for teams, reporting, and day-to-day business management.',
                'description' => 'We build business systems that help teams manage operations, records, reporting, and internal processes with clearer structure and fewer manual steps.',
                'icon' => 'building',
                'features' => [
                    'Operations management',
                    'Internal dashboards',
                    'Reporting views',
                    'Team workflows',
                    'Secure admin areas',
                ],
                'technologies' => ['Laravel', 'PostgreSQL', 'Livewire', 'Tailwind CSS'],
                'benefits' => [
                    'Centralized operations',
                    'Better visibility for teams',
                    'Consistent processes',
                ],
                'process_steps' => ['Discovery', 'Planning', 'Design', 'Development', 'Testing', 'Deployment', 'Support'],
                'faqs' => [
                    ['question' => 'Can the system grow with our team?', 'answer' => 'Yes. We design systems with room to expand modules and roles as your needs change.'],
                ],
                'sort_order' => 4,
            ],
            [
                'category' => 'AI Solutions',
                'name' => 'AI Integration / AI Solutions',
                'slug' => 'ai-solutions',
                'short_description' => 'Practical AI features, assistants, and automation for real business use cases.',
                'description' => 'We integrate AI where it adds clear value — assistants, document processing, recommendations, and automation — without making your product depend on AI for basic functionality.',
                'icon' => 'sparkles',
                'features' => [
                    'AI assistants',
                    'AI-powered features',
                    'AI document processing',
                    'AI recommendation systems',
                    'AI automation',
                    'AI API integration',
                ],
                'technologies' => ['OpenAI', 'Gemini', 'Laravel', 'Python', 'REST APIs'],
                'benefits' => [
                    'AI used for practical outcomes',
                    'Modular and configurable integration',
                    'Core product still works without AI',
                ],
                'process_steps' => ['Discovery', 'Use-case definition', 'Prototype', 'Integration', 'Testing', 'Deployment', 'Monitoring'],
                'faqs' => [
                    ['question' => 'Do you force AI into every project?', 'answer' => 'No. We recommend AI only when it clearly helps the workflow, and we keep the core system usable without it.'],
                ],
                'sort_order' => 5,
            ],
            [
                'category' => 'API & Integration',
                'name' => 'API Integration',
                'slug' => 'api-integration',
                'short_description' => 'REST APIs and third-party integrations for payments, auth, and external systems.',
                'description' => 'We connect applications to third-party platforms and internal systems through well-structured APIs, authentication flows, and reliable data exchange.',
                'icon' => 'link',
                'features' => [
                    'REST APIs',
                    'Third-party API integration',
                    'Payment integrations',
                    'Authentication integrations',
                    'Webhook handling',
                ],
                'technologies' => ['Laravel', 'REST APIs', 'OAuth', 'JSON', 'Node.js'],
                'benefits' => [
                    'Reliable system connectivity',
                    'Secure credential handling',
                    'Clear integration boundaries',
                ],
                'process_steps' => ['Discovery', 'API mapping', 'Development', 'Testing', 'Deployment', 'Monitoring'],
                'faqs' => [
                    ['question' => 'Can you integrate payment providers?', 'answer' => 'Yes. We can integrate supported payment providers based on your business requirements and compliance needs.'],
                ],
                'sort_order' => 6,
            ],
            [
                'category' => 'API & Integration',
                'name' => 'System Integration',
                'slug' => 'system-integration',
                'short_description' => 'Connect business systems so data and workflows move reliably between tools.',
                'description' => 'We help businesses connect existing tools and platforms so information flows between systems without fragile manual processes.',
                'icon' => 'layers',
                'features' => [
                    'System-to-system integration',
                    'Data synchronization',
                    'Workflow bridging',
                    'Legacy and modern system connections',
                ],
                'technologies' => ['REST APIs', 'Laravel', 'Queued jobs', 'PostgreSQL', 'Cloud platforms'],
                'benefits' => [
                    'Less duplicate data entry',
                    'More reliable operational flow',
                    'Clearer system ownership',
                ],
                'process_steps' => ['Discovery', 'Mapping', 'Development', 'Testing', 'Deployment', 'Support'],
                'faqs' => [
                    ['question' => 'Can you connect tools we already use?', 'answer' => 'Often yes, depending on available APIs, access permissions, and data constraints.'],
                ],
                'sort_order' => 7,
            ],
            [
                'category' => 'Cloud & Automation',
                'name' => 'Cloud Solutions',
                'slug' => 'cloud-solutions',
                'short_description' => 'Cloud deployment, hosting setup, and cloud-based application architecture.',
                'description' => 'We help deploy and structure applications for cloud environments, including hosting setup, environment configuration, and scalable backend architecture.',
                'icon' => 'cloud',
                'features' => [
                    'Cloud deployment',
                    'Environment configuration',
                    'Cloud-based systems',
                    'CI/CD support',
                    'Secure storage setup',
                ],
                'technologies' => ['Docker', 'GitHub', 'Cloud platforms', 'Laravel', 'S3-compatible storage'],
                'benefits' => [
                    'Reliable deployment process',
                    'Environment separation',
                    'Scalable infrastructure foundations',
                ],
                'process_steps' => ['Assessment', 'Architecture', 'Setup', 'Deployment', 'Monitoring', 'Support'],
                'faqs' => [
                    ['question' => 'Do you manage production hosting?', 'answer' => 'We can help set up and deploy to your chosen cloud provider. Ongoing hosting ownership depends on the engagement.'],
                ],
                'sort_order' => 8,
            ],
            [
                'category' => 'Cloud & Automation',
                'name' => 'Automation Solutions',
                'slug' => 'automation-solutions',
                'short_description' => 'Backend automation, scheduled processes, and operational workflow automation.',
                'description' => 'We build automation that reduces repetitive work — scheduled jobs, sync processes, notifications, and operational workflows that run reliably in the background.',
                'icon' => 'workflow',
                'features' => [
                    'Backend automation',
                    'Scheduled processes',
                    'Data synchronization',
                    'Notification workflows',
                    'Operational automation',
                ],
                'technologies' => ['Laravel Queues', 'Scheduled tasks', 'APIs', 'PostgreSQL', 'Cloud platforms'],
                'benefits' => [
                    'Fewer repetitive tasks',
                    'More consistent operations',
                    'Better use of staff time',
                ],
                'process_steps' => ['Discovery', 'Process mapping', 'Automation design', 'Development', 'Testing', 'Deployment', 'Monitoring'],
                'faqs' => [
                    ['question' => 'What kinds of work can be automated?', 'answer' => 'Common examples include scheduled reports, data syncing, status updates, and repetitive internal workflows.'],
                ],
                'sort_order' => 9,
            ],
            [
                'category' => 'Web Development',
                'name' => 'Software Maintenance and Support',
                'slug' => 'software-maintenance-and-support',
                'short_description' => 'Ongoing updates, fixes, monitoring support, and long-term software care.',
                'description' => 'We provide maintenance and support so your software stays secure, usable, and aligned with changing business needs after launch.',
                'icon' => 'wrench',
                'features' => [
                    'Bug fixes and updates',
                    'Security maintenance',
                    'Feature improvements',
                    'Performance review',
                    'Technical support',
                ],
                'technologies' => ['Laravel', 'Git', 'GitHub', 'Monitoring tools', 'Cloud platforms'],
                'benefits' => [
                    'Long-term software health',
                    'Faster issue response',
                    'Planned improvements over time',
                ],
                'process_steps' => ['Handover review', 'Priority setup', 'Maintenance cycles', 'Reporting', 'Continuous improvement'],
                'faqs' => [
                    ['question' => 'Do you only support software you built?', 'answer' => 'We prioritize systems we built, and we can assess existing systems case by case.'],
                ],
                'sort_order' => 10,
            ],
        ];

        foreach ($services as $service) {
            $category = ServiceCategory::query()->where('name', $service['category'])->first();

            Service::query()->updateOrCreate(
                ['slug' => $service['slug']],
                [
                    'service_category_id' => $category?->id,
                    'name' => $service['name'],
                    'short_description' => $service['short_description'],
                    'description' => $service['description'],
                    'icon' => $service['icon'],
                    'features' => $service['features'],
                    'technologies' => $service['technologies'],
                    'benefits' => $service['benefits'],
                    'process_steps' => $service['process_steps'],
                    'faqs' => $service['faqs'],
                    'is_active' => true,
                    'sort_order' => $service['sort_order'],
                ],
            );
        }
    }
}
