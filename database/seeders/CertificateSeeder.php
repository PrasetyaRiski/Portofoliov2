<?php

namespace Database\Seeders;

use App\Models\Certificate;
use Illuminate\Database\Seeder;

class CertificateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $certificates = [
            [
                'title' => 'AWS Certified Solutions Architect - Associate',
                'issuer' => 'Amazon Web Services',
                'category' => 'cloud',
                'description' => 'Validates ability to design distributed systems on AWS, including compute, networking, storage, and database services.',
                'credential_id' => 'AWS-SAA-C03-123456',
                'credential_url' => 'https://aws.amazon.com/verification',
                'issue_date' => now()->subMonths(6),
                'expiry_date' => now()->addYears(3)->subMonths(6),
                'is_featured' => true,
                'order' => 1,
            ],
            [
                'title' => 'Laravel Certified Developer',
                'issuer' => 'Laravel',
                'category' => 'development',
                'description' => 'Official certification demonstrating proficiency in Laravel framework and modern PHP development.',
                'credential_id' => 'LCD-2024-78901',
                'credential_url' => 'https://certification.laravel.com/verify',
                'issue_date' => now()->subMonths(4),
                'expiry_date' => null,
                'is_featured' => true,
                'order' => 2,
            ],
            [
                'title' => 'Google Cloud Professional Cloud Architect',
                'issuer' => 'Google Cloud',
                'category' => 'cloud',
                'description' => 'Professional-level certification for designing, developing, and managing robust, secure, scalable cloud architectures.',
                'credential_id' => 'GCP-PCA-456789',
                'credential_url' => 'https://cloud.google.com/certification',
                'issue_date' => now()->subMonths(8),
                'expiry_date' => now()->addYears(2)->subMonths(8),
                'is_featured' => true,
                'order' => 3,
            ],
            [
                'title' => 'Meta Front-End Developer Professional Certificate',
                'issuer' => 'Meta (Coursera)',
                'category' => 'development',
                'description' => 'Comprehensive program covering HTML, CSS, JavaScript, React, and modern front-end development practices.',
                'credential_id' => 'COURSERA-META-FE-2024',
                'credential_url' => 'https://coursera.org/verify/professional-cert',
                'issue_date' => now()->subMonths(10),
                'expiry_date' => null,
                'is_featured' => false,
                'order' => 4,
            ],
            [
                'title' => 'Certified Kubernetes Administrator (CKA)',
                'issuer' => 'Cloud Native Computing Foundation',
                'category' => 'devops',
                'description' => 'Demonstrates ability to perform the responsibilities of a Kubernetes administrator.',
                'credential_id' => 'CKA-2024-12345',
                'credential_url' => 'https://training.linuxfoundation.org/certification/verify',
                'issue_date' => now()->subMonths(5),
                'expiry_date' => now()->addYears(3)->subMonths(5),
                'is_featured' => false,
                'order' => 5,
            ],
            [
                'title' => 'MySQL Database Administrator',
                'issuer' => 'Oracle',
                'category' => 'database',
                'description' => 'Certification validating expertise in MySQL database administration, optimization, and management.',
                'credential_id' => 'ORACLE-MYSQL-DBA-2024',
                'credential_url' => 'https://education.oracle.com/verify',
                'issue_date' => now()->subYear(),
                'expiry_date' => null,
                'is_featured' => false,
                'order' => 6,
            ],
            [
                'title' => 'CCNA: Introduction to Networks',
                'issuer' => 'Cisco',
                'category' => 'network',
                'description' => 'Foundation certification covering networking fundamentals, IP addressing, and basic security concepts.',
                'credential_id' => 'CISCO-CCNA-001234',
                'credential_url' => 'https://cisco.com/verify',
                'issue_date' => now()->subMonths(14),
                'expiry_date' => now()->addYears(3)->subMonths(14),
                'is_featured' => false,
                'order' => 7,
            ],
            [
                'title' => 'Scrum Master Certified (SMC)',
                'issuer' => 'Scrum Alliance',
                'category' => 'other',
                'description' => 'Certification demonstrating knowledge of Scrum framework and agile methodologies.',
                'credential_id' => 'SMC-2024-567890',
                'credential_url' => 'https://scrumalliance.org/verify',
                'issue_date' => now()->subMonths(9),
                'expiry_date' => now()->addYears(2)->subMonths(9),
                'is_featured' => false,
                'order' => 8,
            ],
        ];

        foreach ($certificates as $certificate) {
            Certificate::create($certificate);
        }
    }
}
