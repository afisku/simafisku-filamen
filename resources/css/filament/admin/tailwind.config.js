import preset from '../../../../vendor/filament/filament/tailwind.config.preset'

export default {
    presets: [preset],
    content: [
        './app/Filament/C:\Users\windows\Documents\test_foto_filamen\app\Filament\Clusters\Data_Master\**/*.php',
        './resources/views/filament/c:\-users\windows\-documents\test_foto_filamen\app\-filament\-clusters\-data_-master\**/*.blade.php',
        './vendor/filament/**/*.blade.php',
    ],
}

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
      './resources/**/*.blade.php',
      './resources/**/*.js',
      './resources/**/*.vue',
    ],
    theme: {
      extend: {},
    },
    plugins: [],
  }