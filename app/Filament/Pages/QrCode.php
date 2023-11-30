<?php

namespace App\Filament\Pages;

use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Pages\Page;

class QrCode extends Page
{
    protected static ?string $navigationIcon = 'heroicon-m-qr-code';

    protected static string $view = 'filament.pages.qrcode';

    protected static ?int $navigationSort = 2;

    public array $data;

    public string $qrcode;

    public static function getNavigationLabel(): string
    {
        return 'QR maker';
    }

    public function getTitle(): string
    {
        return 'QR maker (Demo)';
    }

    public function mount(): void
    {
        $defualtData = [
            'url' => 'https://filamentphp.com/',
            'size' => '300',
            'margin' => '1',
            'color' => 'rgb(0, 0, 0)',
            'back_color' => 'rgb(252, 252, 252)',
            'gradient_form' => 'rgb(69, 179, 157)',
            'gradient_to' => 'rgb(241, 148, 138)',
            'eye_color_inner' => 'rgb(241, 148, 138)',
            'eye_color_outer' => 'rgb(69, 179, 157)',
            'gradient_type' => 'vertical',
            'style' => 'square',
            'eye_style' => 'square',
        ];

        $this->form->fill($defualtData);
    }

    public function form(Form $form): Form
    {
        return $form
            ->statePath('data')
            ->schema([
                Section::make()->id('main-card')
                    ->columns([
                        'default' => '1',
                        'lg' => '2',
                    ])
                    ->schema([
                        TextInput::make('size')
                            ->live()
                            ->label(__('Size')),

                        TextInput::make('url')
                            ->live(onBlur: true)
                            ->label(__('Url')),

                        ColorPicker::make('color')
                            ->live()
                            ->label(__('Color'))
                            ->rgb(),

                        ColorPicker::make('back_color')
                            ->live()
                            ->label(__('Back Color'))
                            ->rgb(),

                        Select::make('margin')
                            ->live()
                            ->label(__('Margin'))
                            ->options([
                                '0' => '0',
                                '1' => '1',
                                '3' => '3',
                                '7' => '7',
                                '9' => '9',
                            ]),

                        Select::make('style')
                            ->live()
                            ->label(__('Style'))
                            ->options([
                                'square' => __('square'),
                                'round' => __('round'),
                                'dot' => __('dot'),
                            ]),

                        Toggle::make('hasGradient')
                            ->live()
                            ->inline()
                            ->columnSpan([
                                'sm' => 1,
                                'lg' => 2,
                            ])
                            ->reactive()
                            ->label(__('Gradient')),

                        Grid::make()
                            ->schema([
                                ColorPicker::make('gradient_form')
                                    ->live()
                                    ->label(__('Gradient From'))
                                    ->rgb(),

                                ColorPicker::make('gradient_to')
                                    ->live()
                                    ->label(__('Gradient To'))
                                    ->rgb(),

                                Select::make('gradient_type')
                                    ->live()
                                    ->label(__('Gradient Type'))
                                    ->options([
                                        'vertical' => __('vertical'),
                                        'horizontal' => __('horizontal'),
                                        'diagonal' => __('diagonal'),
                                        'inverse_diagonal' => __('inverse_diagonal'),
                                        'radial' => __('radial'),
                                    ]),
                            ])
                            ->columns([
                                'sm' => 1,
                                'lg' => 3,
                            ])
                            ->columnSpan([
                                'sm' => 1,
                                'lg' => 2,
                            ])
                            ->visible(fn(\Filament\Forms\Get $get) => $get('hasGradient')),

                        Toggle::make('hasEyeColor')
                            ->live()
                            ->inline()
                            ->columnSpan([
                                'sm' => 1,
                                'lg' => 2,
                            ])
                            ->label(__('Eye Config')),

                        Grid::make()->schema([
                            ColorPicker::make('eye_color_inner')
                                ->live()
                                ->label(__('Inner Eye Color'))
                                ->rgb(),

                            ColorPicker::make('eye_color_outer')
                                ->live()
                                ->label(__('Outer Eye Color'))
                                ->rgb(),

                            Select::make('eye_style')
                                ->live()
                                ->label(__('Eye Style'))
                                ->options([
                                    'square' => __('square'),
                                    'circle' => __('circle'),
                                ]),
                        ])
                            ->columns([
                                'sm' => 1,
                                'lg' => 3,
                            ])
                            ->columnSpan([
                                'sm' => 1,
                                'lg' => 2,
                            ])
                            ->visible(fn(\Filament\Forms\Get $get) => $get('hasEyeColor')),
                        //TextInput::make('logo')->default('https://nadel.test/images/logo-md.png'),
                        //TextInput::make('domain')->required()->maxLength(255)->disabled(),
                        //RichEditor::make('description')->columnSpan(2),
                    ]),
            ]);
    }

    public static function maketheqr($data): string
    {
        $maker = new \SimpleSoftwareIO\QrCode\Generator();

        if ($data['color'] !== null) {
            $colorRGB = str_replace(['rgb(', ')'], '', $data['color']);
            $colorRGB = explode(',', $colorRGB);
            call_user_func_array([$maker, 'color'], $colorRGB);
        }

        if ($data['back_color'] !== null) {
            $back_colorRGB = str_replace(['rgb(', ')'], '', $data['back_color']);
            $back_colorRGB = explode(',', $back_colorRGB);
            call_user_func_array([$maker, 'backgroundColor'], $back_colorRGB);
        }

        $maker = $maker->size($data['size']);

        if ($data['hasGradient']) {
            if ($data['gradient_to'] !== null && $data['gradient_form'] !== null) {
                $gradient_form = str_replace(['rgb(', ')'], '', $data['gradient_form']);
                $gradient_form = explode(',', $gradient_form);

                $gradient_to = str_replace(['rgb(', ')'], '', $data['gradient_to']);
                $gradient_to = explode(',', $gradient_to);

                $options = array_merge($gradient_to, $gradient_form, [$data['gradient_type']]);
                call_user_func_array([$maker, 'gradient'], $options);
            }
        }

        if ($data['hasEyeColor']) {
            if ($data['eye_color_inner'] !== null && $data['eye_color_outer'] !== null) {
                $eye_color_inner = str_replace(['rgb(', ')'], '', $data['eye_color_inner']);
                $eye_color_inner = explode(',', $eye_color_inner);

                $eye_color_outer = str_replace(['rgb(', ')'], '', $data['eye_color_outer']);
                $eye_color_outer = explode(',', $eye_color_outer);

                $options = array_merge([0], $eye_color_inner, $eye_color_outer);
                call_user_func_array([$maker, 'eyeColor'], $options);

                $options = array_merge([1], $eye_color_inner, $eye_color_outer);
                call_user_func_array([$maker, 'eyeColor'], $options);

                $options = array_merge([2], $eye_color_inner, $eye_color_outer);
                call_user_func_array([$maker, 'eyeColor'], $options);
            }
        }

        if ($data['margin'] !== null) {
            $maker = $maker->margin($data['margin']);
        }

        if ($data['style'] !== null) {
            $maker = $maker->style($data['style']);
        }

        if (isset($data['eye_style']) && filled($data['eye_style'])) {
            $maker = $maker->eye($data['eye_style']);
        }

        /*if ($data['logo'] !== null) {
            $maker = $maker->merge('/public/images/logo-5-110px-instagram.png', .4,false);
        }*/

        return $maker->generate('https://domain.sdfsdfsdf.ccc?qr=1')->toHtml();
    }
}
