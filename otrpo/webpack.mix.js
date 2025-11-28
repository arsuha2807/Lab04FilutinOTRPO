const mix = require('laravel-mix');

mix.js('resources/js/main.js', 'public/js')
   .sass('resources/scss/styles.scss', 'public/css')
   .options({
       postCss: [
           require('autoprefixer'),
       ],
   })
   
   mix.webpackConfig({
  resolve: {
    extensions: ['.js', '.jsx', '.vue', '.json', '.scss', '.sass', '.css']
  } 
})
   .sourceMaps()
   .browserSync({
       proxy: 'http://127.0.0.1:8000/', // укажите локальный URL Laravel проекта
       files: [
           'app/**/*.php',
           'resources/views/**/*.blade.php',
           'public/js/**/*.js',
           'public/css/**/*.css'
       ]
   });

