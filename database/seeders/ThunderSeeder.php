<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ThunderSeeder extends Seeder
{
    /**
     * @throws \JsonException
     */
    public function run(): void
    {
        $collection = DB::table(config('zeus-bolt.table-prefix') . 'collections')->insertGetId([
            'name' => 'all printers list',
            'values' => json_encode([
                [
                    'itemKey' => 'printer-001',
                    'itemValue' => 'Printer 001',
                    'itemIsDefault' => false,
                ],
                [
                    'itemKey' => 'printer-002',
                    'itemValue' => 'Printer 002',
                    'itemIsDefault' => false,
                ],
                [
                    'itemKey' => 'printer-003',
                    'itemValue' => 'Printer 003',
                    'itemIsDefault' => false,
                ],
                [
                    'itemKey' => 'printer-004',
                    'itemValue' => 'Printer 004',
                    'itemIsDefault' => false,
                ],
                [
                    'itemKey' => 'printer-005',
                    'itemValue' => 'Printer 005',
                    'itemIsDefault' => false,
                ],
            ], JSON_THROW_ON_ERROR),
            'created_at' => now(),
        ]);
        $category = DB::table(config('zeus-bolt.table-prefix') . 'categories')->insertGetId([
            'name' => json_encode(['en' => 'support tickets Forms', 'ar' => 'نماذج الدعم الفني'], JSON_THROW_ON_ERROR),
            'description' => json_encode(['en' => 'all support tickets Forms', 'ar' => 'كافة نماذج الدعم الفني'], JSON_THROW_ON_ERROR),
            'slug' => 'general-forms',
            'created_at' => now(),
        ]);

        $form = DB::table(config('zeus-bolt.table-prefix') . 'forms')->insertGetId([
            'name' => json_encode(['en' => 'printer issues', 'ar' => 'مشاكل الطابعات'], JSON_THROW_ON_ERROR),
            'slug' => 'printer-issues',
            'options' => json_encode([
                'confirmation-message' => 'your ticket has been sent, we will reply soon',
                'show-as-wizard' => false,
                'require-login' => true,
                'emails-notification' => null,
                'web-hook' => null,
            ], JSON_THROW_ON_ERROR),
            'extensions' => 'LaraZeus\\Thunder\\Extensions\\Thunder',
            'category_id' => $category,
            'user_id' => 1,
            'start_date' => null,
            'end_date' => null,
            'ordering' => 1,
            'is_active' => 1,
            'description' => json_encode(['en' => 'for all printer issues, your printer dosent work? we are here for you', 'ar' => 'لحل كافة مشاكل الطابعات'], JSON_THROW_ON_ERROR),
            'created_at' => now(),
        ]);

        $office = DB::table(config('zeus-thunder.table-prefix') . 'offices')->insertGetId([
            'name' => json_encode([
                'en' => 'printers department',
                'ar' => 'مشاكل الطابعات',
            ]),
            'slug' => 'printers-department',
            'form_ids' => json_encode([$form]),
            'description' => json_encode(['en' => 'all printers issues', 'ar' => 'كافة المشاكل المتعلقة بالطابعات'], JSON_THROW_ON_ERROR),
            'options' => json_encode([
                'assigning-mechanism' => 'manually',
                'is_internal' => false,
                'allow-escalation' => true,
                'allow-escalation-after' => '1',
            ]),
            'created_at' => now(),
        ]);

        $section1 = DB::table(config('zeus-bolt.table-prefix') . 'sections')->insertGetId([
            'name' => json_encode(['en' => 'location info', 'ar' => 'بيانات الموقع'], JSON_THROW_ON_ERROR),
            'form_id' => $form,
            'created_at' => now(),
        ]);
        $section2 = DB::table(config('zeus-bolt.table-prefix') . 'sections')->insertGetId([
            'name' => json_encode(['en' => 'device info', 'ar' => 'تفاصيل المشكلة'], JSON_THROW_ON_ERROR),
            'form_id' => $form,
            'created_at' => now(),
        ]);

        $section1_field_1 = DB::table(config('zeus-bolt.table-prefix') . 'fields')->insertGetId([
            'name' => json_encode(['en' => 'room number', 'ar' => 'رقم الغرفة'], JSON_THROW_ON_ERROR),
            'section_id' => $section1,
            'ordering' => 1,
            'options' => json_encode([
                'htmlId' => Str::random(6),
                'dateType' => 'numeric',
                'is_required' => true,
            ], JSON_THROW_ON_ERROR),
            'type' => '\LaraZeus\Bolt\Fields\Classes\TextInput',
            'created_at' => now(),
        ]);
        $section1_field_2 = DB::table(config('zeus-bolt.table-prefix') . 'fields')->insertGetId([
            'name' => json_encode(['en' => 'floor', 'ar' => 'الدور'], JSON_THROW_ON_ERROR),
            'section_id' => $section1,
            'ordering' => 2,
            'options' => json_encode([
                'htmlId' => Str::random(6),
                'dateType' => 'numeric',
                'is_required' => true,
            ], JSON_THROW_ON_ERROR),
            'type' => '\LaraZeus\Bolt\Fields\Classes\TextInput',
            'created_at' => now(),
        ]);
        $section2_field_1 = DB::table(config('zeus-bolt.table-prefix') . 'fields')->insertGetId([
            'name' => json_encode(['en' => 'have you restart the device?', 'ar' => 'هل جربت اعادة تشغيل الجهاز؟'], JSON_THROW_ON_ERROR),
            'section_id' => $section2,
            'ordering' => 2,
            'options' => json_encode([
                'htmlId' => Str::random(6),
                'dataSource' => '2',
                'is_required' => true,
                'is_inline' => true,
            ], JSON_THROW_ON_ERROR),
            'type' => '\LaraZeus\Bolt\Fields\Classes\Radio',
            'created_at' => now(),
        ]);
        $section2_field_2 = DB::table(config('zeus-bolt.table-prefix') . 'fields')->insertGetId([
            'name' => json_encode(['en' => 'select the printer model', 'ar' => 'اختر موديل الطابعة'], JSON_THROW_ON_ERROR),
            'section_id' => $section2,
            'ordering' => 2,
            'options' => json_encode([
                'dataSource' => '3',
                'htmlId' => Str::random(6),
                'is_required' => true,
            ], JSON_THROW_ON_ERROR),
            'type' => '\LaraZeus\Bolt\Fields\Classes\Select',
            'created_at' => now(),
        ]);

        $response_1 = DB::table(config('zeus-bolt.table-prefix') . 'responses')->insertGetId([
            'form_id' => $form,
            'user_id' => 3,
            'status' => 'OPEN',
            'notes' => null,
            'created_at' => now(),
            'extension_item_id' => 1,
        ]);

        $response_1_field_1 = DB::table(config('zeus-bolt.table-prefix') . 'field_responses')->insertGetId([
            'form_id' => $form,
            'field_id' => $section1_field_1,
            'response_id' => $response_1,
            'response' => '1',
            'created_at' => now(),
        ]);
        $response_1_field_2 = DB::table(config('zeus-bolt.table-prefix') . 'field_responses')->insertGetId([
            'form_id' => $form,
            'field_id' => $section1_field_2,
            'response_id' => $response_1,
            'response' => '1',
            'created_at' => now(),
        ]);
        $response_1_field_3 = DB::table(config('zeus-bolt.table-prefix') . 'field_responses')->insertGetId([
            'form_id' => $form,
            'field_id' => $section2_field_1,
            'response_id' => $response_1,
            'response' => 'maybe',
            'created_at' => now(),
        ]);
        $response_1_field_4 = DB::table(config('zeus-bolt.table-prefix') . 'field_responses')->insertGetId([
            'form_id' => $form,
            'field_id' => $section2_field_2,
            'response_id' => $response_1,
            'response' => 'printer-001',
            'created_at' => now(),
        ]);

        $ticket = DB::table(config('zeus-thunder.table-prefix') . 'tickets')->insertGetId([
            'ticket_no' => Str::random(6),
            'office_id' => $office,
            'response_id' => $response_1,
            'user_id' => 3,
            'assignee_id' => 1,
            'status' => 'OPEN',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
