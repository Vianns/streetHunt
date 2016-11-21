var gulp    = require('gulp'),
    argv    = require('yargs').argv,
    config  = require('../config');

var app = undefined === argv.app ? 'front' : argv.app;

gulp.task('watch', ['browserify'], function() {
    gulp.watch(config.compass.src, ['compass']);
});
