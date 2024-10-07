import preset from '../../../../vendor/filament/filament/tailwind.config.preset'
import colors from "tailwindcss/colors.js";

export default {
    presets: [preset],
    content: [
        './app/Filament/**/*.php',
        './vendor/filament/**/*.blade.php',
        './resources/views/**/*.blade.php',

        './vendor/lara-zeus/core/resources/views/**/*.blade.php',
        './vendor/lara-zeus/core/src/CoreServiceProvider.php',

        './vendor/lara-zeus/wind/resources/views/**/*.blade.php',
        './vendor/lara-zeus/wind/src/Filament/Resources/LetterResource.php',
        './vendor/lara-zeus/wind/src/Livewire/ContactsForm.php',

        './vendor/lara-zeus/sky/resources/views/**/*.blade.php',
        './vendor/lara-zeus/sky/src/Models/PostStatus.php',

        './vendor/lara-zeus/bolt/resources/views/**/*.blade.php',

        './vendor/lara-zeus/thunder/resources/views/**/*.blade.php',
        './vendor/lara-zeus/thunder/src/Models/TicketsStatus.php',
        './vendor/lara-zeus/thunder/src/Filament/Resources/TicketResource.php',

        './vendor/lara-zeus/athena/resources/views/**/*.blade.php',

        './vendor/lara-zeus/artemis/resources/views/**/*.blade.php',

        './vendor/lara-zeus/quantity/resources/views/**/*.blade.php',

        './vendor/lara-zeus/dynamic-dashboard/resources/views/**/*.blade.php',
        './vendor/lara-zeus/dynamic-dashboard/src/Models/Columns.php',

        './vendor/lara-zeus/rhea/resources/views/**/*.blade.php',

        // hermes
        './vendor/lara-zeus/hermes/resources/views/**/*.blade.php',

        // Bolt Pro
        './vendor/lara-zeus/bolt-pro/resources/views/**/*.blade.php',
        './vendor/sawirricardo/filament-nouislider/resources/views/forms/components/nouislider.blade.php',

        // matrix-choice
        './vendor/lara-zeus/matrix-choice/resources/views/**/*.blade.php',

        './vendor/lara-zeus/accordion/resources/views/**/*.blade.php',

        './vendor/lara-zeus/list-group/resources/views/**/*.blade.php',

        // helen
        './vendor/lara-zeus/helen/resources/views/**/*.blade.php',
        './vendor/lara-zeus/helen/src/Filament/Resources/LinksResource.php',
        './vendor/lara-zeus/helen/src/Facades/Helen.php',

        // filament
        './app/Filament/**/*.php',
        './resources/views/filament/**/*.blade.php',
        './vendor/filament/**/*.blade.php',

        './vendor/awcodes/preset-color-picker/resources/**/*.blade.php',
        './vendor/awcodes/recently/resources/**/*.blade.php',
        './vendor/awcodes/filament-tiptap-editor/resources/**/*.blade.php',
        './vendor/awcodes/filament-versions/resources/**/*.blade.php',
        './vendor/awcodes/filament-quick-create/resources/**/*.blade.php',
        './vendor/awcodes/overlook/resources/**/*.blade.php',
        './vendor/awcodes/filament-curator/resources/**/*.blade.php',
        './vendor/ryangjchandler/filament-navigation/resources/**/*.blade.php',
        './vendor/wire-elements/spotlight/resources/views/spotlight.blade.php',
        './vendor/archilex/filament-filter-sets/**/*.php',
        './vendor/bezhansalleh/filament-panel-switch/resources/views/panel-switch-menu.blade.php',
        './vendor/jaocero/radio-deck/resources/views/**/*.blade.php',
        './vendor/jaocero/activity-timeline/resources/views/**/*.blade.php',
    ],
    theme: {
        extend: {
            colors: {
                primary: {
                    DEFAULT: '#45B39D',
                    50: '#C6E9E2',
                    100: '#B8E4DB',
                    200: '#9AD8CC',
                    300: '#7DCDBD',
                    400: '#5FC1AE',
                    500: '#45B39D',
                    600: '#358B79',
                    700: '#266256',
                    800: '#163A32',
                    900: '#07110F',
                    950: '#000000'
                },
                secondary: {
                    DEFAULT: '#F1948A',
                    50: '#FDF2F0',
                    100: '#FCE7E5',
                    200: '#F9D2CE',
                    300: '#F6BEB8',
                    400: '#F4A9A1',
                    500: '#F1948A',
                    600: '#EB6658',
                    700: '#E53826',
                    800: '#BC2717',
                    900: '#8A1C11',
                    950: '#71170E'
                },
                danger: colors.red,
                success: colors.green,
                warning: colors.yellow,
                info: colors.blue,
            }
        },
    },
}
