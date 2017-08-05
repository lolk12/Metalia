"use strict";

const gulp = require('gulp');
const sass = require('gulp-sass');
const babel = require('gulp-babel');
const autoprefixer = require('gulp-autoprefixer');

gulp.task('sass', () => {
	return gulp.src('./css/def/**/*.sass') // src - Путь откуда транспилировать 
		.pipe(sass())
		//.pipe(concat('all.css')) // Обьединяет весь транспилированный код в один файл
		.pipe(autoprefixer({
            browsers: ['last 2 versions'],
            cascade: false
        }))
		.pipe(gulp.dest('css/public')) // dest - Имя директории в которую нужно сохранять 
		.on('error', console.log);
});

gulp.task('babel', () => {
    return gulp.src('./js/def/**/*.js')
        .pipe(babel({
            presets: ['es2015']
        }))
        .pipe(gulp.dest('js/public'))
        .on('error', console.log);
});


gulp.watch('./css/def/**/*.sass', gulp.series('sass'));
gulp.watch('./js/def/**/*.js', gulp.series('babel'));

gulp.task('build', gulp.series('sass','babel'));
