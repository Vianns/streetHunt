var gulp        = require('gulp'),
    gutil       = require('gulp-util'),
    uglify      = require('gulp-uglify'),
    watchify    = require('watchify'),
    browserify  = require('browserify'),
    babelify    = require('babelify'),
    source      = require('vinyl-source-stream'),
    buffer      = require('vinyl-buffer'),
    sourcemaps  = require('gulp-sourcemaps'),
    assign      = require('lodash.assign'),
    config      = require('../config').browserify;

var customOpts = {
    entries: [config.entries],
    debug: false
};

var opts = assign({}, watchify.args, customOpts);
var b = watchify(browserify(opts));

// Add transformations here
b.transform(babelify);

gulp.task('browserify', bundle);
b.on('update', bundle);
b.on('log', gutil.log);

function bundle() {
    return b
        .bundle()
        .on('error', gutil.log.bind(gutil, 'Browserify Error'))
        .pipe(source(config.outputName))
        // .pipe(buffer())
        // .pipe(sourcemaps.init({loadMaps: true}))
        // Add transformation tasks to the pipeline here.
        // .pipe(uglify())
        // .pipe(sourcemaps.write('./'))
        .pipe(gulp.dest(config.dest));
}
