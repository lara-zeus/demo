<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BigBoltSeeder extends Seeder
{
    public function run()
    {
        $prefix = config('zeus-bolt.table-prefix', 'zeus_bolt_');

        // Collections
        $collectionIds = [];

        $collectionIds[] = DB::table($prefix . 'collections')->insertGetId([
            'name' => 'Big Form Options',
            'values' => json_encode([
                ['itemKey' => 'opt1', 'itemValue' => 'Option 1', 'itemIsDefault' => false],
                ['itemKey' => 'opt2', 'itemValue' => 'Option 2', 'itemIsDefault' => false],
                ['itemKey' => 'opt3', 'itemValue' => 'Option 3', 'itemIsDefault' => false],
                ['itemKey' => 'opt4', 'itemValue' => 'Option 4', 'itemIsDefault' => false],
            ], JSON_THROW_ON_ERROR),
            'created_at' => now(),
        ]);

        $collectionIds[] = DB::table($prefix . 'collections')->insertGetId([
            'name' => 'Yes No Maybe',
            'values' => json_encode([
                ['itemKey' => 'yes', 'itemValue' => 'Yes', 'itemIsDefault' => false],
                ['itemKey' => 'no', 'itemValue' => 'No', 'itemIsDefault' => false],
                ['itemKey' => 'maybe', 'itemValue' => 'Maybe', 'itemIsDefault' => false],
            ], JSON_THROW_ON_ERROR),
            'created_at' => now(),
        ]);

        $collectionIds[] = DB::table($prefix . 'collections')->insertGetId([
            'name' => 'Satisfaction Levels',
            'values' => json_encode([
                ['itemKey' => 'very_satisfied', 'itemValue' => 'Very Satisfied', 'itemIsDefault' => false],
                ['itemKey' => 'satisfied', 'itemValue' => 'Satisfied', 'itemIsDefault' => false],
                ['itemKey' => 'neutral', 'itemValue' => 'Neutral', 'itemIsDefault' => false],
                ['itemKey' => 'dissatisfied', 'itemValue' => 'Dissatisfied', 'itemIsDefault' => false],
                ['itemKey' => 'very_dissatisfied', 'itemValue' => 'Very Dissatisfied', 'itemIsDefault' => false],
            ], JSON_THROW_ON_ERROR),
            'created_at' => now(),
        ]);

        $collectionIds[] = DB::table($prefix . 'collections')->insertGetId([
            'name' => 'Days of Week',
            'values' => json_encode([
                ['itemKey' => 'mon', 'itemValue' => 'Monday', 'itemIsDefault' => false],
                ['itemKey' => 'tue', 'itemValue' => 'Tuesday', 'itemIsDefault' => false],
                ['itemKey' => 'wed', 'itemValue' => 'Wednesday', 'itemIsDefault' => false],
                ['itemKey' => 'thu', 'itemValue' => 'Thursday', 'itemIsDefault' => false],
                ['itemKey' => 'fri', 'itemValue' => 'Friday', 'itemIsDefault' => false],
                ['itemKey' => 'sat', 'itemValue' => 'Saturday', 'itemIsDefault' => false],
                ['itemKey' => 'sun', 'itemValue' => 'Sunday', 'itemIsDefault' => false],
            ], JSON_THROW_ON_ERROR),
            'created_at' => now(),
        ]);

        $category = DB::table($prefix . 'categories')->insertGetId([
            'name' => json_encode(['en' => 'Big Forms', 'ar' => 'نماذج كبيرة'], JSON_THROW_ON_ERROR),
            'description' => json_encode(['en' => 'Very big forms', 'ar' => 'نماذج كبيرة جدا'], JSON_THROW_ON_ERROR),
            'slug' => 'big-forms-' . Str::random(4),
            'created_at' => now(),
        ]);

        $form = DB::table($prefix . 'forms')->insertGetId([
            'name' => json_encode(['en' => 'BigBolt Form', 'ar' => 'نموذج بيج بولت'], JSON_THROW_ON_ERROR),
            'slug' => 'bigbolt-form-' . Str::random(4),
            'options' => json_encode([
                'confirmation-message' => 'Thank you for submitting the BigBolt Form!',
                'show-as' => 'page',
                'require-login' => false,
                'emails-notification' => null,
                'web-hook' => null,
            ], JSON_THROW_ON_ERROR),
            'category_id' => $category,
            'user_id' => 1,
            'start_date' => null,
            'end_date' => null,
            'ordering' => 1,
            'is_active' => 1,
            'description' => json_encode([
                'en' => 'This is a big form with more than 30 fields', 'ar' => 'هذا نموذج كبير يحتوي على أكثر من ٣٠ حقل',
            ], JSON_THROW_ON_ERROR),
            'details' => json_encode([
                'en' => 'Fill all fields carefully',
                'ar' => 'يرجى تعبئة جميع الحقول بعناية',
            ], JSON_THROW_ON_ERROR),
            'created_at' => now(),
        ]);

        // Sections
        $sections = [];
        for ($i = 1; $i <= 5; $i++) {
            $sections[] = DB::table($prefix . 'sections')->insertGetId([
                'name' => json_encode(['en' => 'Section ' . $i, 'ar' => 'القسم ' . $i], JSON_THROW_ON_ERROR),
                'form_id' => $form,
                'created_at' => now(),
            ]);
        }

        $fieldTypes = [
            '\LaraZeus\Bolt\Fields\Classes\TextInput',
            '\LaraZeus\Bolt\Fields\Classes\Textarea',
            '\LaraZeus\Bolt\Fields\Classes\Toggle',
            '\LaraZeus\Bolt\Fields\Classes\Radio',
            '\LaraZeus\Bolt\Fields\Classes\Select',
            '\LaraZeus\Bolt\Fields\Classes\CheckboxList',
            '\LaraZeus\Bolt\Fields\Classes\DatePicker',
            '\LaraZeus\Bolt\Fields\Classes\DateTimePicker',
            '\LaraZeus\Bolt\Fields\Classes\TimePicker',
            '\LaraZeus\Bolt\Fields\Classes\ColorPicker',
            '\LaraZeus\Bolt\Fields\Classes\RichEditor',
            '\LaraZeus\Bolt\Fields\Classes\Paragraph',
            '\LaraZeus\Bolt\Fields\Classes\FileUpload',
        ];

        $totalFields = 35;
        $order = 1;

        for ($j = 1; $j <= $totalFields; $j++) {
            $sectionIndex = ($j % 5);
            $typeIndex = ($j % count($fieldTypes));
            $typeClass = $fieldTypes[$typeIndex];

            $options = [
                'htmlId' => Str::random(6),
                'is_required' => rand(0, 1) === 1,
            ];

            if (in_array($typeClass, [
                '\LaraZeus\Bolt\Fields\Classes\Radio',
                '\LaraZeus\Bolt\Fields\Classes\Select',
                '\LaraZeus\Bolt\Fields\Classes\CheckboxList',
            ])) {
                $options['dataSource'] = (string) $collectionIds[array_rand($collectionIds)];
            } elseif ($typeClass === '\LaraZeus\Bolt\Fields\Classes\TextInput') {
                $options['dateType'] = 'string';
            }

            DB::table($prefix . 'fields')->insert([
                'name' => json_encode(['en' => 'Field ' . $j . ' - ' . class_basename($typeClass), 'ar' => 'حقل ' . $j], JSON_THROW_ON_ERROR),
                'section_id' => $sections[$sectionIndex],
                'ordering' => $order++,
                'options' => json_encode($options, JSON_THROW_ON_ERROR),
                'type' => $typeClass,
                'created_at' => now(),
            ]);
        }
    }
}
