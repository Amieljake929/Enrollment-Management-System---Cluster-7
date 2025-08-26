<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CollegeDocumentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
{
    $newRegularId = DB::table('college_student_types')->where('type_name', 'New Regular')->value('type_id');
    $returneeId = DB::table('college_student_types')->where('type_name', 'Returnee')->value('type_id');
    $transfereeId = DB::table('college_student_types')->where('type_name', 'Transferee')->value('type_id');

    $commonDocs = [
        'Form 138 (Report Card)',
        'Form 137',
        'Certificate of Good Moral',
        'PSA Authenticated Birth Certificate',
        'Passport Size ID Picture (White Background, Formal Attire) - 2 pcs',
        'Barangay Clearance',
    ];

    foreach ($commonDocs as $doc) {
        DB::table('college_documents')->insert([
            ['document_name' => $doc, 'type_id' => $newRegularId],
            ['document_name' => $doc, 'type_id' => $returneeId],
        ]);
    }

    $transfereeDocs = [
        'Transcript of Records from Previous School',
        'Honorable Dismissal',
        'Certificate of Good Moral',
        'PSA Authenticated Birth Certificate',
        'Passport Size ID Picture (White Background, Formal Attire) - 2 pcs',
        'Barangay Clearance',
    ];

    foreach ($transfereeDocs as $doc) {
        DB::table('college_documents')->insert([
            'document_name' => $doc,
            'type_id' => $transfereeId,
        ]);
    }
}
}
