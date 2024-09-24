import preset from '../../../../vendor/filament/filament/tailwind.config.preset'

export default {
    presets: [preset],
    content: [
        './app/Filament/Guests/**/*.php',
        './resources/views/filament/guests/**/*.blade.php',
        './vendor/filament/**/*.blade.php',

        //App
        './resources/views/**/*.blade.php',
        // filament
        './app/Filament/**/*.php',
        './resources/views/filament/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
        './vendor/awcodes/filament-table-repeater/resources/**/*.blade.php',
        './vendor/awcodes/matinee/resources/views/**/*.blade.php',
        './vendor/awcodes/filament-badgeable-column/resources/**/*.blade.php',
        './vendor/awcodes/preset-color-picker/resources/**/*.blade.php',
    ],
}
