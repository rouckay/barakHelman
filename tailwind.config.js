import preset from './vendor/filament/support/tailwind.config.preset'

export default {
    presets: [preset],
    content: [
        './app/Filament/**/*.php',
        './resources/views/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
        '<path-to-vendor>/awcodes/overlook/resources/**/*.blade.php',
        './vendor/guava/filament-knowledge-base/src/**/*.php',
        './vendor/guava/filament-knowledge-base/resources/**/*.blade.php',
        '<path-to-vendor>/awcodes/filament-badgeable-column/resources/**/*.blade.php',
    ],
}
