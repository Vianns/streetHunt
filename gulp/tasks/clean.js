var gulp = require('gulp')
    del = require('del')
    paths = require('../config').clean.paths;

gulp.task('clean', function(cb) {
    return del(paths, cb);
});
