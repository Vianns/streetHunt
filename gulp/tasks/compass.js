var gulp         = require('gulp'),
    compass      = require('gulp-compass'),
    autoprefixer = require('gulp-autoprefixer'),
    rename       = require('gulp-rename'),
    plumber      = require('gulp-plumber'),
    beep         = require('beepbeep'),
    config       = require('../config').compass;

var onError = function (err) {
    beep(3, 500);
    console.log(err);
    this.emit('end');
};

gulp.task('compass', function() {
    return gulp.src(config.src)
        .pipe(plumber({ errorHandler: onError }))
        .pipe(compass(config.settings))
        .pipe(autoprefixer('last 2 version', 'safari 5', 'ie 9', 'opera 12.1', 'ios 6', 'android 4'))
        .pipe(gulp.dest(config.dest));
;});
