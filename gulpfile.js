const { src, dest, watch, parallel } = require('gulp');

// CSS
const sass = require('gulp-sass')(require('sass'));
const plumber = require('gulp-plumber');
const autoprefixer = require('autoprefixer');
const cssnano = require('cssnano');
const postcss = require('gulp-postcss');
const sourcemaps = require('gulp-sourcemaps');

// Javascript
const terser = require('gulp-terser');
const rename = require('gulp-rename');
const webpack = require('webpack-stream');

// Rutas
const paths = {
    scss: 'src/scss/**/*.scss',
    js: 'src/js/**/*.js',
    imagenes: 'src/img/**/*'
};

// Compilar CSS
function css() {
    return src(paths.scss)
        .pipe(plumber()) // evita que se rompa el watch
        .pipe(sourcemaps.init())
        .pipe(sass({ outputStyle: 'expanded' }))
        .pipe(postcss([autoprefixer(), cssnano()]))
        .pipe(sourcemaps.write('.'))
        .pipe(dest('public/build/css'));
}

// Compilar JS con Webpack
function javascript() {
    return src(paths.js)
        .pipe(webpack({
            mode: 'production',
            entry: './src/js/app.js',
            output: {
                filename: 'bundle.js'
            },
            module: {
                rules: [
                    {
                        test: /\.css$/i,
                        use: ['style-loader', 'css-loader']
                    }
                ]
            }
        }))
        .pipe(sourcemaps.init({ loadMaps: true }))
        .pipe(terser())
        .pipe(rename({ suffix: '.min' }))
        .pipe(sourcemaps.write('.'))
        .pipe(dest('public/build/js'));
}

// Watcher
function dev(done) {
    watch(paths.scss, css);
    watch(paths.js, javascript);
    done();
}

exports.css = css;
exports.js = javascript;
exports.dev = dev;
exports.build = parallel(css, javascript);
