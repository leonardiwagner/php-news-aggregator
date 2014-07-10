module.exports = function (grunt) {
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        stylus: {
            compile: {
                options: {
                    linenos: true,
                    compress: false
                },
                files: [{
                    expand: true,
                    cwd: './',
                    src: ['**/*.styl'],
                    dest: './',
                    ext: '.css'
                }]
            }
        },
        concat: {
            compile: {
                src: ['./gnome-shell-original.css', './gnome-shell-linda.css'],
                dest: './gnome-shell.css'
            }
        },
        watch: {
            stylus: {
                files: ['./gnome-shell-linda.styl'],
                tasks: ['stylus', 'concat']
            }
        }
    });

    // Load the plugin that provides the "watch" & "stylus" tasks.
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-stylus');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-contrib-csshint');
    grunt.loadNpmTasks('grunt-contrib-concat');

    // Default task(s).
    grunt.registerTask('default', ['watch']);
};