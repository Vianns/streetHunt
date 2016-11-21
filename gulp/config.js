var argv = require('yargs').argv;

var apps = {
    front: {
        src: 'app/Resources/assets/front',
        dest: 'web/assets/f'
    },
    admin: {
        src: 'app/Resources/assets/admin',
        dest: 'web/assets/a'
    }
};

var config = {}, value = {};

for (var key in apps) {
    value = apps[key];

    config[key] = {
        clean: {
            paths: [
                value.dest + '/img/**/*',
                value.dest + '/css/**/*',
                value.dest + '/fonts/**/*',
            ]
        },

        compass: {
            src: value.src + '/sass/**/*.{sass,scss}',
            dest: value.dest + '/css',
            settings: {
                sass: value.src + '/sass',
                css: value.dest + '/css',
                image: value.dest + '/img',
                fonts: value.dest + '/fonts',
                sourcemap: true,
                style: 'compressed'
            }
        },

        images: {
            src: value.src + "/img/**",
            dest: value.dest + "/img"
        },

        browserify: {
            entries: value.src + '/js/main.js',
            dest: value.dest + '/js',
            outputName: 'main.js'
        },

        fonts: {
            src: value.src + '/fonts/**/*',
            dest: value.dest + '/fonts'
        }
    };
}

var app = undefined === argv.app ? 'front' : argv.app;

module.exports = config[app];
