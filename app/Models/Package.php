<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use \Sushi\Sushi;

    public function getRows(): array
    {
        return [
            [
                'name' => 'Bolt',
                'icon' => 'akar-thunder',
                'desc' => __('Bolt is a form builder for your users, with so many use cases') . ' ' . __('it also include Bolt Pro, Bolt Preset'),
                'admin_url' => url('/admin/forms'),
                'fe_text' => __('Forms'),
                'fe_url' => route('bolt.forms.list'),
                'other' => json_encode([
                    'title' => 'Available Addons:',
                    'urls' => [
                        [
                            'text' => 'Bolt Pro',
                            'url' => 'https://larazeus.com/bolt-pro',
                        ],
                    ],
                ]),
            ],
            [
                'name' => 'Thunder',
                'other' => null,
                'icon' => 'ri-thunderstorms-line',
                'desc' => __('Thunder is a tickets system for laravel built as filament plugin'),
                'admin_url' => url('/admin/offices'),
                'fe_text' => __('Tickets'),
                'fe_url' => route('thunder.offices.list'),
            ],
            [
                'name' => 'Hermes',
                'other' => null,
                'icon' => 'rpg-feather-wing',
                'desc' => __('Hermes | restaurants and cafés menu managements'),
                'admin_url' => url('/admin/branches'),
                'fe_text' => __('Our Menu'),
                'fe_url' => url('hermes'),
            ],
            [
                'name' => 'Sky',
                'icon' => 'ri-cloud-windy-line',
                'desc' => __('Sky is simple CMS for your website. It includes posts, pages, tags, and categories'),
                'admin_url' => url('/admin/posts'),
                'fe_text' => __('Blog'),
                'fe_url' => route('blogs'),
                'other' => null,
                /*'other' => json_encode([
                    'title' => 'Available Addons:',
                    'urls' => [
                        [
                            'text' => 'Artemis',
                            'url' => 'https://larazeus.com/artemis',
                        ],
                        [
                            'text' => 'Rhea',
                            'url' => 'https://larazeus.com/rhea',
                        ],
                    ],
                ]),*/
            ],
            [
                'name' => 'Wind',
                'other' => null,
                'icon' => 'akar-thunder',
                'desc' => __('Wind, is a package provides a simple contact form manger, with the ability to store the messages in the database, and you can reply to them from the dashboard'),
                'admin_url' => url('/admin/departments'),
                'fe_text' => __('Contact Form'),
                'fe_url' => route('contact'),
            ],
            [
                'name' => 'Rain',
                'other' => null,
                'icon' => 'carbon-rain-heavy',
                'desc' => __('Rain, simple way to manage widgets for your website landing page'),
                'admin_url' => url('/admin/layouts'),
                'fe_text' => __('home page'),
                'fe_url' => route('landing-page'),
            ],
            [
                'name' => 'Rhea',
                'other' => null,
                'icon' => 'tabler-bow',
                'desc' => __('Rhea is a tool that helps you migrate your wordpress blog to zeus sky'),
                'admin_url' => url('/admin/importer'),
                'fe_text' => null,
                'fe_url' => null,
            ],
            [
                'name' => 'Artemis',
                'icon' => 'rpg-spear-head',
                'desc' => __('Artemis | telling a story with a design. Themes for all Lara Zeus packages'),
                'admin_url' => null,
                'fe_text' => __('Read More'),
                'fe_url' => 'https://larazeus.com/artemis',
                'other' => json_encode([
                    'title' => 'Available Themes:',
                    'urls' => [
                        [
                            'url' => url('theme/zeus'),
                            'text' => 'Zeus',
                        ],
                        [
                            'url' => url('theme/daisy'),
                            'text' => 'Daisy',
                        ],
                        [
                            'url' => url('theme/another-portfolio'),
                            'text' => 'Another Portfolio',
                        ],
                    ],
                ]),
            ],
        ];
    }
}
