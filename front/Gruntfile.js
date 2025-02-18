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
                    cwd : "assets/src/sass",
                    src : ["*.scss"],
                    dest : "assets/dist/css/",
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
                        cwd: 'assets/dist/css',
                        src: ['*.css'],
                        dest: '../assets/<%= pathTheme %>/css',
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
            src: ["assets/src/js/script.js"],
            dest: "../assets/<%= pathTheme %>/js/app.min.js",
          },
          jslib: {
              src: ["assets/src/js/libs/*"],
              dest: "../assets/<%= pathTheme %>/js/lib.min.js",
          }
        },
        image: {
          dynamic: {
              files: [{
                  expand: true,
                  cwd: "assets/src/img/",
                  src: ["*.{png,jpg,gif,svg}"],
                  dest: '../assets/<%= pathTheme %>/img'
              }]
          }
        },
        watch: {
            scripts: {
                files: "assets/src/js/script.js",
                tasks: ["uglify:js"]
            },
            styles: {
                files: "assets/src/sass/*.scss",
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
