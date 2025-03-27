<?php

namespace App\Zeus\Presets;

use LaraZeus\BoltPro\Preset;
use Illuminate\Support\Str;

class BoltProPreset extends Preset
{
    public function title(): string
    {
        return __('Bolt Pro');
    }

    public function desc(): string
    {
        return __('Bolt Pro Descriptions');
    }

    public function category(): string
    {
        return __('work');
    }

    /**
     * @throws \JsonException
     */
    public function definition(): array
    {
        return [
            
                'name' => 'Bolt Pro',
                'slug' => 'bolt-pro-4FyBtq',
                'description' => 'Bolt Pro',
                'options' => json_encode([
                    'confirmation-message' => '<p>Thank you for testing out Bolt Pro 🙂, use the code: <strong>ATM23ZBP </strong>to get 20% off</p>',
                    'show-as' => 'page',
                    'require-login' => '',
                    'emails-notification' => '',
                ], JSON_THROW_ON_ERROR),
                'user_id' => 1,

                //'category_id' => 1, // optional
                //'start_date' => null, // optional
                //'end_date' => null, // optional

                'ordering' => 2,
                'is_active' => 1,
                'created_at' => '2025-03-27 20:26:16',
            
                        'section' => [
                            
                        [
                            'name' => 'All Bolt Pro Fields',
                            'aside' => false,
                            'compact' => false,
                            'columns' => '1',
                    
                        'fields' => [
                            
                                [
                                    'name' => 'Image Picker',
                                    'description' => 'Allow users to choose an image from the uploaded images,presented in a beautiful list',
                                    'type' => '\LaraZeus\BoltPro\Fields\ImagePicker',
                                    'ordering' => 1,
                                    'options' => json_encode([
                                        'htmlId' => 'zW7BRa',
                                    'is_required' => '1',
                                    
                                    'images' => [
                                        '0' => 'forms/aZeqEiphnjtbHWa73ACLjpidJT3Dc5-metacmFpbi5wbmc=-.png',
                                        '1' => 'forms/tqocpQqh1VO99VJ4AFeWnfYCvjrrPB-metacHJlbWl1bS5wbmc=-.png',
                                        '2' => 'forms/BtAaVuoHL9WdANo2LOBxaiS0kxWEOS-metaVW50aXRsZWQgZGVzaWduICgyKS5wbmc=-.png',
                                        
                                    ],
                                    
                                    ], JSON_THROW_ON_ERROR),
                                ],
                            
                                [
                                    'name' => 'Dynamic Textbox',
                                    'description' => 'Allow users to add a list of options. You can set the maximum and minimum items',
                                    'type' => '\LaraZeus\BoltPro\Fields\Repeater',
                                    'ordering' => 2,
                                    'options' => json_encode([
                                        'htmlId' => '0SLUFp',
                                    'is_required' => '',
                                    'minItems' => null,
                                    'maxItems' => '5',
                                    'defaultItems' => null,
                                    
                                    ], JSON_THROW_ON_ERROR),
                                ],
                            
                                [
                                    'name' => 'Terms and Condetion',
                                    'description' => 'Set the URL of your Terms and Conditions',
                                    'type' => '\LaraZeus\BoltPro\Fields\Tac',
                                    'ordering' => 3,
                                    'options' => json_encode([
                                        'htmlId' => 'mRpIvF',
                                    'column_span_full' => '',
                                    
                                    'terms' => [
                                        'text' => 'Terms',
                                        'link' => 'https://demo.test',
                                        
                                    ],
                                    
                                    'conditions' => [
                                        'text' => 'Conditions',
                                        'link' => 'https://demo.test',
                                        
                                    ],
                                    
                                    ], JSON_THROW_ON_ERROR),
                                ],
                            
                                [
                                    'name' => 'Signature ',
                                    'description' => 'Collect users Signatures',
                                    'type' => '\LaraZeus\BoltPro\Fields\SignPad',
                                    'ordering' => 4,
                                    'options' => json_encode([
                                        'htmlId' => 'aCTAtB',
                                    'is_required' => '1',
                                    'background-color' => '#faf1f1',
                                    'pen-color' => '#000000',
                                    
                                    ], JSON_THROW_ON_ERROR),
                                ],
                            
                                [
                                    'name' => 'Alert',
                                    'description' => 'Show a highlighted area tracks user attention',
                                    'type' => '\LaraZeus\BoltPro\Fields\Alert',
                                    'ordering' => 5,
                                    'options' => json_encode([
                                        'htmlId' => 'aCTAtB',
                                    'content' => 'f sdf sdf sdf ',
                                    'type' => 'warning',
                                    'color' => '#f22ade',
                                    'icon' => 'tabler-rocket',
                                    
                                    ], JSON_THROW_ON_ERROR),
                                ],
                            
                                [
                                    'name' => 'Advanced Date',
                                    'description' => 'Let users pick a date range or multiple dates.',
                                    'type' => '\LaraZeus\BoltPro\Fields\AdvanceDate',
                                    'ordering' => 6,
                                    'options' => json_encode([
                                        'htmlId' => 'sdfsdf',
                                    'mode' => 'multiple',
                                    
                                    ], JSON_THROW_ON_ERROR),
                                ],
                            
                                [
                                    'name' => 'Icon Picker',
                                    'description' => 'Icon Picker Selector ',
                                    'type' => '\LaraZeus\BoltPro\Fields\IconPicker',
                                    'ordering' => 7,
                                    'options' => json_encode([
                                        'htmlId' => 'uqM2nC',
                                    'is_required' => '',
                                    'column_span_full' => '',
                                    
                                    ], JSON_THROW_ON_ERROR),
                                ],
                            
                                [
                                    'name' => 'Matrix Choice checkbox',
                                    'description' => '',
                                    'type' => '\LaraZeus\BoltPro\Fields\MatrixGrid',
                                    'ordering' => 8,
                                    'options' => json_encode([
                                        'htmlId' => 'hPZ3M2w',
                                    'choice_type' => 'checkbox',
                                    
                                    'column_data' => [
                                        '1' => '🙂',
                                        '2' => '😐',
                                        '3' => '🙁',
                                        
                                    ],
                                    
                                    'row_data' => [
                                        'saturday' => 'Saturday',
                                        'sunday' => 'Sunday',
                                        'monday' => 'Monday',
                                        
                                    ],
                                    
                                    ], JSON_THROW_ON_ERROR),
                                ],
                            
                                [
                                    'name' => 'Matrix Choice radio',
                                    'description' => '',
                                    'type' => '\LaraZeus\BoltPro\Fields\MatrixGrid',
                                    'ordering' => 9,
                                    'options' => json_encode([
                                        'htmlId' => 'hPZ3MW',
                                    'choice_type' => 'radio',
                                    
                                    'column_data' => [
                                        'happy' => '🙂',
                                        'nothing' => '😐',
                                        'sad' => '🙁',
                                        
                                    ],
                                    
                                    'row_data' => [
                                        'saturday' => 'Saturday',
                                        'sunday' => 'Sunday',
                                        'monday' => 'Monday',
                                        
                                    ],
                                    
                                    ], JSON_THROW_ON_ERROR),
                                ],
                            
                                [
                                    'name' => 'Slider',
                                    'description' => '',
                                    'type' => '\LaraZeus\BoltPro\Fields\Slider',
                                    'ordering' => 10,
                                    'options' => json_encode([
                                        'htmlId' => 'tjWeUW',
                                    'is_required' => '',
                                    'start_from' => '4',
                                    'start_to' => '6',
                                    'min_value' => '1',
                                    'max_value' => '10',
                                    
                                    ], JSON_THROW_ON_ERROR),
                                ],
                            
                                [
                                    'name' => 'Rating',
                                    'description' => '',
                                    'type' => '\LaraZeus\BoltPro\Fields\Rating',
                                    'ordering' => 11,
                                    'options' => json_encode([
                                        'htmlId' => 'tjDeUW',
                                    'is_required' => '',
                                    
                                    ], JSON_THROW_ON_ERROR),
                                ],
                            
                        ],
                    ],
                    
            ]
        ];
    }
}

