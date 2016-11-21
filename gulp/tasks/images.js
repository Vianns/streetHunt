var gulp     = require('gulp'),
    imagemin = require('gulp-imagemin'),
    cache    = require('gulp-cache'),
    pngquant = require('imagemin-pngquant')
    config   = require('../config').images;

gulp.task('images', ['clean'], function(cb) {
    gulp.src(config.src)
        .pipe(cache(imagemin({
            progressive: true,
            svgoPlugins: [{removeViewBox: false}],
            use: [pngquant()]
        })))
        .pipe(gulp.dest(config.dest));

    return cb();
});
