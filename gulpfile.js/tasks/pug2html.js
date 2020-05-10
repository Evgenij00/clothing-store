const { src, dest } = require('gulp');                               //сам Gulp
const plumber = require('gulp-plumber');                            //отслеживание ошибок в Gulp
const pug = require('gulp-pug');                                    //pug to html
const htmlValid = require('gulp-w3c-html-validator');            //корректирование html??????
// const bemlValid = require('gulp-w3c-html-validator');            //бэм валидатор - пока не нужен - САМОПИСНЫЙ ПЛАГИН!!!!!!!!

module.exports = function pug2html(cb) {
    return src('src/pages/*.pug')
        .pipe(plumber())
        .pipe(pug({ pretty: true }))
        .pipe(htmlValid())
        .pipe(dest('build/pages'));
}