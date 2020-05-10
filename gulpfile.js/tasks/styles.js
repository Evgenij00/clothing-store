const { src, dest } = require('gulp');
const plumber = require('gulp-plumber');  
const sass = require('gulp-sass')

module.exports = function styles(cb) {
    return src('src/styles/main.scss')
        .pipe(plumber())
        .pipe(sass())
        .on('error', sass.logError)     //На данный момент, обработку ошибок в sass-файле мы ловим в следующей строке.
        .pipe(dest('build/css'));
}