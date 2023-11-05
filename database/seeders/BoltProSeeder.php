<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BoltProSeeder extends Seeder
{
    /**
     * @throws \JsonException
     */
    public function run()
    {
        $category = DB::table('categories')->insertGetId([
            'name' => json_encode(['en' => 'Bolt Pro'], JSON_THROW_ON_ERROR),
            'description' => json_encode(['en' => 'Bolt Pro'], JSON_THROW_ON_ERROR),
            'slug' => 'bolt-pro',
            'created_at' => now(),
        ]);

        $form = DB::table('forms')->insertGetId([
            'description' => '{"en":"all new fields in bolt pro","pt":"all new fields in bolt pro","ko":"all new fields in bolt pro"}',
            'slug' => 'bolt-pro',
            'details' => '{"en":"<p><a href=\\"https:\\/\\/larazeus.com\\/bolt-pro\\">Get Bolt Pro now, 7 fields are available now, and more are on the way.<\\/a><\\/p>","pt":"<p><a href=\\"https:\\/\\/larazeus.com\\/bolt-pro\\">Get Bolt Pro now, 7 fields are available now, and more are on the way.<\\/a><\\/p>","ko":"<p><a href=\\"https:\\/\\/larazeus.com\\/bolt-pro\\">Get Bolt Pro now, 7 fields are available now, and more are on the way.<\\/a><\\/p>"}',
            'options' => '{"confirmation-message":"<p>Thank you for testing out Bolt Pro \\ud83d\\ude42, use the code: <strong>ATM23ZBP <\\/strong>to get 20% off<\\/p>","require-login":false,"show-as":"page","emails-notification":null}',
            'name' => json_encode(['en' => 'Bolt Pro', 'pt' => 'Bolt Pro', 'ko' => 'Bolt Pro'], JSON_THROW_ON_ERROR),
            'category_id' => $category,
            'user_id' => 1,
            'start_date' => null,
            'end_date' => null,
            'ordering' => 1,
            'is_active' => 1,
            'created_at' => now(),
        ]);

        $section1 = DB::table('sections')->insertGetId([
            'name' => json_encode(['en' => 'All Bolt Pro Fields'], JSON_THROW_ON_ERROR),
            'form_id' => $form,
            'created_at' => now(),
        ]);

        DB::table('fields')->insertGetId(
            [
                'section_id' => $section1,
                'name' => '{"en":"Image Picker","pt":"Image Picker","ko":"Image Picker"}',
                'description' => 'Allow users to choose an image from the uploaded images,presented in a beautiful list',
                'type' => '\\LaraZeus\\BoltPro\\Fields\\ImagePicker',
                'ordering' => '1',
                'options' => '{"htmlId":"zW7BRa","is_required":true,"images":["forms\/aZeqEiphnjtbHWa73ACLjpidJT3Dc5-metacmFpbi5wbmc=-.png","forms\/tqocpQqh1VO99VJ4AFeWnfYCvjrrPB-metacHJlbWl1bS5wbmc=-.png","forms\/BtAaVuoHL9WdANo2LOBxaiS0kxWEOS-metaVW50aXRsZWQgZGVzaWduICgyKS5wbmc=-.png"]}',
            ],
        );
        DB::table('fields')->insertGetId(
            [
                'section_id' => $section1,
                'name' => '{"en":"Dynamic Textbox","pt":"Dynamic Textbox","ko":"Dynamic Textbox"}',
                'description' => 'Allow users to add a list of options. You can set the maximum and minimum items',
                'type' => '\\LaraZeus\\BoltPro\\Fields\\Repeater',
                'ordering' => '2',
                'options' => '{"htmlId":"0SLUFp","is_required":false,"minItems":null,"maxItems":"5","defaultItems":null}',
            ],
        );
        DB::table('fields')->insertGetId(
            [
                'section_id' => $section1,
                'name' => '{"en":"Terms and Condetion","pt":"Terms and Condetion","ko":"Terms and Condetion"}',
                'description' => 'Set the URL of your Terms and Conditions',
                'type' => '\\LaraZeus\\BoltPro\\Fields\\Tac',
                'ordering' => '3',
                'options' => '{"htmlId":"mRpIvF","column_span_full":false,"terms":{"text":"Terms","link":"https:\\/\\/demo.test"},"conditions":{"text":"Conditions","link":"https:\\/\\/demo.test"}}',
            ],
        );
        DB::table('fields')->insertGetId(
            [
                'section_id' => $section1,
                'name' => '{"en":"Signature ","pt":"Signature ","ko":"Signature "}',
                'description' => 'Collect users Signatures',
                'type' => '\\LaraZeus\\BoltPro\\Fields\\SignPad',
                'ordering' => '4',
                'options' => '{"htmlId":"aCTAtB","is_required":true,"background-color":"#faf1f1","pen-color":"#000000"}',
            ],
        );
        DB::table('fields')->insertGetId(
            [
                'section_id' => $section1,
                'name' => '{"en":"Alert","pt":"Alert","ko":"Alert"}',
                'description' => 'Show a highlighted area tracks user attention',
                'type' => '\\LaraZeus\\BoltPro\\Fields\\Alert',
                'ordering' => '5',
                'options' => '{"content":"f sdf sdf sdf ","type":"warning","color":"#f22ade","icon":"iconoir-rocket"}',
            ],
        );
        DB::table('fields')->insertGetId(
            [
                'section_id' => $section1,
                'name' => '{"en":"Advanced Date","pt":"Advanced Date","ko":"Advanced Date"}',
                'description' => 'Let users pick a date range or multiple dates.',
                'type' => '\\LaraZeus\\BoltPro\\Fields\\AdvanceDate',
                'ordering' => '6',
                'options' => '{"htmlId":"sdfsdf","mode":"multiple"}',
            ],
        );
        DB::table('fields')->insertGetId(
            [
                'section_id' => $section1,
                'name' => '{"en":"Icon Picker","pt":"Icon Picker","ko":"Icon Picker"}',
                'description' => 'Icon Picker Selector ',
                'type' => '\\LaraZeus\\BoltPro\\Fields\\IconPicker',
                'ordering' => '7',
                'options' => '{"htmlId":"uqM2nC","is_required":false,"column_span_full":false}',
            ],
        );
        DB::table('fields')->insertGetId(
            [
                'section_id' => $section1,
                'name' => '{"en":"Matrix Choice checkbox","pt":"Matrix Choice checkbox","ko":"Matrix Choice checkbox"}',
                'description' => null,
                'type' => '\\LaraZeus\\BoltPro\\Fields\\MatrixGrid',
                'ordering' => '8',
                'options' => '{"htmlId":"hPZ3M2w","choice_type":"checkbox","column_data":{"1":"\\ud83d\\ude42","2":"\\ud83d\\ude10","3":"\\ud83d\\ude41"},"row_data":{"saturday":"saturday","sunday":"sunday","monday":"monday"}}',
            ],
        );
        DB::table('fields')->insertGetId(
            [
                'section_id' => $section1,
                'name' => '{"en":"Matrix Choice checkbox","pt":"Matrix Choice checkbox","ko":"Matrix Choice checkbox"}',
                'description' => null,
                'type' => '\\LaraZeus\\BoltPro\\Fields\\MatrixGrid',
                'ordering' => '9',
                'options' => '{"htmlId":"hPZ3MW","choice_type":"radio","column_data":{"1":"\\ud83d\\ude42","2":"\\ud83d\\ude10","3":"\\ud83d\\ude41"},"row_data":{"saturday":"saturday","sunday":"sunday","monday":"monday"}}',
            ],
        );
        DB::table('fields')->insertGetId(
            [
                'section_id' => $section1,
                'name' => '{"en":"Slider","pt":"Slider","ko":"Slider"}',
                'description' => null,
                'type' => '\\LaraZeus\\BoltPro\\Fields\\Slider',
                'ordering' => '10',
                'options' => '{"htmlId":"tjWeUW","is_required":false,"start_from":"4","start_to":"6","min_value":"1","max_value":"10"}',
            ],
        );
    }
}
