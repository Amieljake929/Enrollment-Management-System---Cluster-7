<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ShsDocument;

class ShsDocumentSeeder extends Seeder
{
    public function run()
    {
        // I-delete ang lahat ng records (instead of truncate)
        ShsDocument::query()->delete();

        $documents = [
            // New Regular (type_id = 1)
            ['doc_id' => 1, 'document_name' => 'Form 138 (Report Card)', 'type_id' => 1],
            ['doc_id' => 2, 'document_name' => 'Form 137', 'type_id' => 1],
            ['doc_id' => 3, 'document_name' => 'Certificate of Good Moral', 'type_id' => 1],
            ['doc_id' => 4, 'document_name' => '2"x2" ID Picture (White Background) - 2 pcs', 'type_id' => 1],
            ['doc_id' => 5, 'document_name' => 'Photocopy of NCAE Result', 'type_id' => 1],
            ['doc_id' => 6, 'document_name' => 'ESC Certificate, if a graduate of a private Junior High School', 'type_id' => 1],
            ['doc_id' => 7, 'document_name' => 'PSA Authenticated Birth Certificate', 'type_id' => 1],
            ['doc_id' => 8, 'document_name' => 'Barangay Clearance', 'type_id' => 1],
            ['doc_id' => 9, 'document_name' => 'Photocopy of Diploma', 'type_id' => 1],

            // Transferee (type_id = 2)
            ['doc_id' => 10, 'document_name' => 'ESC Certificate, if a graduate of a private Junior High School', 'type_id' => 2],
            ['doc_id' => 11, 'document_name' => 'Photocopy of NCAE Result', 'type_id' => 2],
            ['doc_id' => 12, 'document_name' => 'Barangay Clearance', 'type_id' => 2],
            ['doc_id' => 13, 'document_name' => 'Photocopy of Diploma', 'type_id' => 2],

            // Returnee (type_id = 3)
            ['doc_id' => 14, 'document_name' => 'Barangay Clearance', 'type_id' => 3],
            ['doc_id' => 15, 'document_name' => 'Photocopy of Diploma', 'type_id' => 3],
        ];

        foreach ($documents as $doc) {
            ShsDocument::create($doc);
        }
    }
}