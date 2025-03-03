const sass = require('sass');


module.exports = function(grunt) {
  grunt.initConfig({
        pathTheme: 'rubis',
        sass: {
          dist: {
            options: {
              implementation: sass,
              style: "expanded",
            },
            files: [
                {
                    expand : true,
                    cwd : "assets/<%= pathTheme %>/assets/sass",
                    src : ["*.scss"],
                    dest : "assets/<%= pathTheme %>/assets/css",
                    ext : ".css",
                },
            ],
          },
        },
        cssmin: {
            dist: {
                files: [
                    {
                        expand: true,
                        cwd: 'assets/<%= pathTheme %>/assets/css',
                        src: ['*.css'],
                        dest: 'assets/<%= pathTheme %>/assets/css',
                        ext: '.min.css'
                    },
                ],
            },
        },
        uglify: {
          options: {
            separator: ";",
          },
          js: {
            src: ["assets/<%= pathTheme %>/assets/js/script.js"],
            dest: "assets/<%= pathTheme %>/assets/js/app.min.js",
          },
          jslib: {
              src: ["assets/<%= pathTheme %>/assets/js/libs/*"],
              dest: "assets/<%= pathTheme %>/assets/js/lib.min.js",
          }
        },
        image: {
          dynamic: {
              files: [{
                  expand: true,
                  cwd: "assets/<%= pathTheme %>/assets/img/",
                  src: ["*.{png,jpg,gif,svg}"],
                  dest: 'assets/<%= pathTheme %>/assets/img'
              }]
          }
        },
        watch: {
            scripts: {
                files: "assets/<%= pathTheme %>/assets/js/script.js",
                tasks: ["uglify:js"]
            },
            styles: {
                files: "assets/<%= pathTheme %>/assets/sass/*.scss",
                tasks: ["sass:dist", "cssmin:dist"]
            }
        }
    });

  // Import du package
  grunt.loadNpmTasks("grunt-sass");
  grunt.loadNpmTasks('grunt-contrib-cssmin');
  grunt.loadNpmTasks("grunt-contrib-uglify");
  grunt.loadNpmTasks('grunt-image');
  grunt.loadNpmTasks('grunt-contrib-watch')


  // Redéfinition de la tâche `default` qui est la tâche lancée dès que vous lancez Grunt sans rien spécifier.
  // Note : ici, nous définissons sass comme une tâche à lancer si on lance la tâche `default`.

  grunt.registerTask("default", ["dev", "watch"]);
  grunt.registerTask("dev", ["sass:dist", "cssmin:dist", "uglify:js", "image:dynamic"]);
  grunt.registerTask("jslib", ["uglify:jslib"]);
};
