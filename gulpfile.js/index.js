const { src, dest, series, parallel, watch } = require('gulp');
const server = require("browser-sync").create();        //.create() - означает, что вы получаете уникальную ссылку и позволяет создавать несколько серверов или прокси.
const sass = require('gulp-sass')
const plumber = require('gulp-plumber');                            //отслеживание ошибок в Gulp
const pug = require('gulp-pug');                                    //pug to html
const htmlValid = require('gulp-w3c-html-validator');            //корректирование html??????
// const bemlValid = require('gulp-w3c-html-validator');            //бэм валидатор - пока не нужен - САМОПИСНЫЙ ПЛАГИН!!!!!!!!

// styles = function styles(cb) {
//     return src('src/styles/main.scss')
//         .pipe(plumber())
//         .pipe(sass())
//         .on('error', sass.logError)     //На данный момент, обработку ошибок в sass-файле мы ловим в следующей строке.
//         .pipe(dest('build/css'))
//         .pipe(server.stream());
// }

// //файлы лежащие на уровень ниже индексного
// pug2html = function pug2html(cb) {
//     return src('src/pages/*.pug')
//         .pipe(plumber())
//         .pipe(pug({ pretty: true }))
//         .pipe(htmlValid())
//         .pipe(dest('build/pages'))
// }

// //отдельный индекс файл
// pug2htmlindex = function pug2htmlindex(cb) {
//     return src('src/index.pug')
//         .pipe(plumber())
//         .pipe(pug({ pretty: true }))
//         .pipe(htmlValid())
//         .pipe(dest('build'))
//         .pipe(server.stream());
// }

// function serve(cb) {
//     // разобраться
//     server.init({
//         proxy: 'onlinestore.loc',
//         browser: 'chrome',
//         notify: false,
//     })

//     watch('src/styles/**/*.scss', series(styles));
//     watch('src/pages/**/*.pug', series(pug2html, pug2htmlindex));
//     watch('src/index.pug', series(pug2htmlindex));
//     watch('build/**/*.html').on('change', server.reload);
//     watch('build/**/*.php').on('change', server.reload);
    
//     return cb();
// }

// exports.default = series(parallel(styles, pug2html, pug2htmlindex), serve);

/////////////////////////////////////////////////////////////////////////////

//{TEMP}
styles = function styles(cb) {
    return src('src/styles/main.scss')
        .pipe(plumber())
        .pipe(sass())
        .on('error', sass.logError)     //На данный момент, обработку ошибок в sass-файле мы ловим в следующей строке.
        .pipe(dest('build/css'))
        .pipe(server.stream());
}

//файлы лежащие на уровень ниже индексного
pug2html = function pug2html(cb) {
    return src('src/pages/*.pug')
        .pipe(plumber())
        .pipe(pug({ pretty: true }))
        .pipe(htmlValid())
        .pipe(dest('build/pages'))
}

//отдельный индекс файл
pug2htmlindex = function pug2htmlindex(cb) {
    return src('src/index.pug')
        .pipe(plumber())
        .pipe(pug({ pretty: true }))
        .pipe(htmlValid())
        .pipe(dest('build'))
        .pipe(server.stream());
}

watch('src/styles/**/*.scss', series(styles));
watch('src/pages/**/*.pug', series(pug2html, pug2htmlindex));
watch('src/index.pug', series(pug2htmlindex));

exports.default = series(parallel(styles, pug2html, pug2htmlindex));