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
                'desc' => __('Thunder is a tickets system for laravel built as filament plugin'),
                'admin_url' => url('/admin/offices'),
                'fe_text' => __('Tickets'),
                'fe_url' => route('thunder.offices.list'),
            ],
            [
                'name' => 'Athena',
                'other' => null,
                'desc' => __('Athena | Booking and Appointments Managements'),
                'admin_url' => url('/admin/services'),
                'fe_text' => 'Book an Appointments',
                'fe_url' => url('athena'),
            ],
            [
                'name' => 'Hermes',
                'other' => null,
                'desc' => __('Hermes | restaurants and cafés menu managements'),
                'admin_url' => url('/admin/branches'),
                'fe_text' => __('Our Menu'),
                'fe_url' => url('hermes'),
            ],
            [
                'name' => 'Helen',
                'other' => null,
                'desc' => __('Helen | short URL management with qr code generator'),
                'admin_url' => url('/admin/links'),
                'fe_text' => null,
                'fe_url' => null,
            ],
            [
                'name' => 'Sky',
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
                'desc' => __('Wind, is a package provides a simple contact form manger, with the ability to store the messages in the database, and you can reply to them from the dashboard'),
                'admin_url' => url('/admin/departments'),
                'fe_text' => __('Contact Form'),
                'fe_url' => route('contact'),
            ],
            [
                'name' => 'Dynamic Dashboard',
                'other' => null,
                'desc' => __('Dynamic Dashboard, simple way to manage widgets for your website landing page'),
                'admin_url' => url('/admin/layouts'),
                'fe_text' => __('home page'),
                'fe_url' => route('landing-page'),
            ],
            [
                'name' => 'Translatable Pro',
                'other' => null,
                'desc' => __('Build an Advanced, Optimized, High-Performance Translatable App with FilamentPHP'),
                'admin_url' => 'https://translatable.larazeus.com/',
                'fe_text' => null,
                'fe_url' => null,
            ],
        ];
    }
}
