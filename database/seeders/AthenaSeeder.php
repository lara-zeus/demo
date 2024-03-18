<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AthenaSeeder extends Seeder
{
    /**
     * @throws \JsonException
     */
    public function run(): void
    {
        $category = DB::table(config('zeus-bolt.table-prefix') . 'categories')->insertGetId([
            'name' => json_encode(
                ['en' => 'Appointments Forms', 'ar' => 'نماذج الحجوزات والمواعيد'],
                JSON_THROW_ON_ERROR
            ),
            'description' => json_encode([
                'en' => 'all Appointments Forms Forms', 'ar' => 'كافة نماذج الحجوزات والمواعيد',
            ], JSON_THROW_ON_ERROR),
            'slug' => 'appointments-forms',
            'created_at' => now(),
        ]);

        $form = DB::table(config('zeus-bolt.table-prefix') . 'forms')->insertGetId([
            'name' => json_encode(['en' => 'general appointment', 'ar' => 'حجز موعد عام'], JSON_THROW_ON_ERROR),
            'slug' => 'general-appointment',
            'options' => json_encode([
                'confirmation-message' => 'your appointment has been sent',
                'show-as-wizard' => false,
                'require-login' => true,
                'emails-notification' => null,
                'web-hook' => null,
            ], JSON_THROW_ON_ERROR),
            'extensions' => 'LaraZeus\\Athena\\Extensions\\Athena',
            'category_id' => $category,
            'user_id' => 1,
            'start_date' => null,
            'end_date' => null,
            'ordering' => 1,
            'is_active' => 1,
            'description' => json_encode([
                'en' => 'all Appointments Forms Forms', 'ar' => 'كافة نماذج الحجوزات والمواعيد',
            ], JSON_THROW_ON_ERROR),
            'created_at' => now(),
        ]);

        $service = DB::table(config('zeus-athena.table-prefix') . 'services')->insertGetId([
            'name' => 'car washer',
            'slug' => 'car-washer',
            'form_id' => $form,
            'description' => 'keep your car clean and skip the queue',
            'color' => '#d62525',
            'user_id' => '1',
            'slots_period_minutes' => 40,
            'min_time_slots' => 1,
            'max_time_slots' => 5,

            'req_per_slot' => 2,
            'allow_multiple' => 1,

            'days_before_req' => 1,
            'days_to_req' => 100,
            'hours_to_cancel' => 3,
            'days_between_requests' => 1,
            'req_acceptance_mode' => 'AUTO',
            'is_multi_day' => 1,
            'is_request_user_unique' => 1,
            'is_active' => 1,
            'timetable' => '{"weekDays":[{"day":"Sunday","available":true,"times":[{"from":"09:00","to":"20:00"}]},{"day":"Monday","available":true,"times":[{"from":"08:00","to":"15:00"}]},{"day":"Tuesday","available":false,"times":{"7de096a4-0bb1-4e35-97ee-5a4de1931b90":{"from":null,"to":null}}},{"day":"Wednesday","available":false,"times":{"1e04dc13-a549-4fbc-b1cc-bd0e531d9026":{"from":null,"to":null}}},{"day":"Thursday","available":false,"times":{"b43c1aaf-3fa5-4fb2-b47d-551d5b6a8244":{"from":null,"to":null}}},{"day":"Friday","available":true,"times":[{"from":"10:00","to":"19:00"}]},{"day":"Saturday","available":false,"times":{"204519f7-8600-4e5a-af03-5d10c76060e2":{"from":null,"to":null}}}],"holidays":[]}',

            'start_time' => now(),
            'end_time' => now()->addYears(10),
            'created_at' => now(),
        ]);

        DB::table(config('zeus-athena.table-prefix') . 'tmp_time_lock')->insert([
            ['service_id' => '1', 'appointment' => '2024-02-16 15:20:00', 'start_time_lock' => '2024-02-12 16:48:20'],
            ['service_id' => '1', 'appointment' => '2024-02-18 18:20:00', 'start_time_lock' => '2024-02-12 16:48:20'],
            ['service_id' => '1', 'appointment' => '2024-02-18 19:00:00', 'start_time_lock' => '2024-02-12 16:48:20'],
            ['service_id' => '1', 'appointment' => '2024-02-26 08:40:00', 'start_time_lock' => '2024-02-12 16:48:20'],
            ['service_id' => '1', 'appointment' => '2024-02-26 13:20:00', 'start_time_lock' => '2024-02-12 16:48:20'],
            ['service_id' => '1', 'appointment' => '2024-02-26 14:00:00', 'start_time_lock' => '2024-02-12 16:48:20'],
        ]);

        $section1 = DB::table(config('zeus-bolt.table-prefix') . 'sections')->insertGetId([
            'name' => json_encode(['en' => 'info', 'ar' => 'بيانات'], JSON_THROW_ON_ERROR),
            'form_id' => $form,
            'created_at' => now(),
        ]);

        $section1_field_1 = DB::table(config('zeus-bolt.table-prefix') . 'fields')->insertGetId([
            'name' => json_encode(['en' => 'your name', 'ar' => 'اسمك'], JSON_THROW_ON_ERROR),
            'section_id' => $section1,
            'ordering' => 1,
            'options' => json_encode([
                'htmlId' => Str::random(6),
                'dateType' => 'string',
                'is_required' => true,
            ], JSON_THROW_ON_ERROR),
            'type' => '\LaraZeus\Bolt\Fields\Classes\TextInput',
            'created_at' => now(),
        ]);

        $response_1 = DB::table(config('zeus-bolt.table-prefix') . 'responses')->insertGetId([
            'form_id' => $form,
            'user_id' => 1,
            'status' => 'OPEN',
            'notes' => null,
            'created_at' => now(),
        ]);

        $response_1_field_1 = DB::table(config('zeus-bolt.table-prefix') . 'field_responses')->insertGetId([
            'form_id' => $form,
            'field_id' => $section1_field_1,
            'response_id' => $response_1,
            'response' => 'my name',
            'created_at' => now(),
        ]);

        DB::table(config('zeus-athena.table-prefix') . 'requests')->insertGetId([
            'appointment_no' => Str::random(6),
            'service_id' => $service,
            'response_id' => $response_1,
            'user_id' => 1,
            'status' => 'NEW',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table(config('zeus-athena.table-prefix') . 'requests_periods')->insert([
            ['service_id' => '1', 'request_id' => '1', 'appointment' => '2024-02-16 15:20:00'],
            ['service_id' => '1', 'request_id' => '1', 'appointment' => '2024-02-18 18:20:00'],
            ['service_id' => '1', 'request_id' => '1', 'appointment' => '2024-02-18 19:00:00'],
            ['service_id' => '1', 'request_id' => '1', 'appointment' => '2024-02-26 08:40:00'],
            ['service_id' => '1', 'request_id' => '1', 'appointment' => '2024-02-26 13:20:00'],
            ['service_id' => '1', 'request_id' => '1', 'appointment' => '2024-02-26 14:00:00'],
        ]);
    }
}
