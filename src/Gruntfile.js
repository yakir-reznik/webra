module.exports = function(grunt){
	
	require("load-grunt-tasks")(grunt);

	grunt.initConfig({
		sass_globbing: {
			your_traget: {
				files: {
					"sass/styles.sass" : "sass/**/*.*"
				},
				options: {
					useSingleQuotes: true
				}
			}
		},
		sass: {
			options: {
				sourceMap: true,
				sourceComments: false
			},
			dist: {
				files: {
					"../build/styles.css" : "sass/styles.sass"
				}
			}
		},
		autoprefixer: {
			// npm update caniuse-db
			options: {
				browsers: ["last 10 versions", "ie 8", "ie 9"]
			},
			dist: {
				files:{
					"../build/styles.css" : "../build/styles.css"
				}
			}
		},
		cssmin: {
			target: {
				files: {
					"../build/styles.css" : "../build/styles.css"
				}
			}
		},
		concat: {
			js: {
				src: ["js/jQuery.js", "js/functions.js", "js/scripts.js"],
				dest: "../build/scripts.js"
			},
			css: {
				src: ["../build/styles.css"], // add css files to concat here
				dest: "../build/styles.css"
			}
		},
		uglify: {
			my_target: {
				files: {
					"../build/scripts.js" : "../build/scripts.js"
				}
			}
		},
		watch: {
			prod: {
				files: ["*.sass", "**/*.sass", "*.css", "**/*.css"],
				tasks: ["sass_globbing", "sass", "autoprefixer"]
			},
			sass: {
				files: ["*.sass", "**/*.sass"],
				tasks: ["sass_globbing", "sass"]
			},
			js: {
				files: ["*.js", "**/*.js"],
				tasks: ["concat:js"]
			}
		},
		browserSync: {
			bsFiles: {
				src : ['../build/**/*.css', '../build/**/*.js', '../build/**/*.html', '../*.php', '../parts/*.php', '../templates/*.php' ]
			},
			options: {
				watchTask: true,
				proxy: "http://localhost/webra",
				startPath: "/"
			}
		},
		concurrent: {
			target: ['watch:sass', 'watch:js']
		}
	});	
	
	grunt.loadNpmTasks("grunt-sass-globbing");
	grunt.loadNpmTasks("grunt-autoprefixer");
	grunt.loadNpmTasks("grunt-contrib-concat");
	grunt.loadNpmTasks("grunt-contrib-uglify");

	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-browser-sync');


	grunt.registerTask("prod", ["sass_globbing", "sass", "autoprefixer", "concat:js", "concat:css", "cssmin", "uglify"]);
	grunt.registerTask("dev", ["browserSync", "concurrent"]);

}
