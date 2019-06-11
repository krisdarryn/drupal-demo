// ## Sage Default - Globals
var argv = require('minimist')(process.argv.slice(2));
var autoprefixer = require('gulp-autoprefixer');
var changed = require('gulp-changed');
var concat = require('gulp-concat');
var flatten = require('gulp-flatten');
var gulp = require('gulp');
var gulpif = require('gulp-if');
var imagemin = require('gulp-imagemin');
var jshint = require('gulp-jshint');
var lazypipe = require('lazypipe');
var merge = require('merge-stream');
var cssNano = require('gulp-cssnano');
var plumber = require('gulp-plumber');
var rev = require('gulp-rev');
var runSequence = require('run-sequence');
var sass = require('gulp-sass');
var sourcemaps = require('gulp-sourcemaps');
var uglify = require('gulp-uglify');
// ## Smart Drop Toolbox 4 - Globals
var gutil = require('gulp-util');
var rewriteCSS = require('gulp-rewrite-css');
var favicon = require('gulp-favicons');

// See https://github.com/austinpray/asset-builder
var manifest = require('asset-builder')('./manifest.json');

// `path` - Paths to base asset directories. With trailing slashes.
// - `path.source` - Path to the source files. Default: `assets/`
// - `path.dist` - Path to the build directory. Default: `dist/`
var path = manifest.paths;

// `config` - Store arbitrary configuration values here.
var config = manifest.config || {};

// `globs` - These ultimately end up in their respective `gulp.src`.
// - `globs.js` - Array of asset-builder JS dependency objects. Example:
// ```
// {type: 'js', name: 'main.js', globs: []}
// ```
// - `globs.css` - Array of asset-builder CSS dependency objects. Example:
// ```
// {type: 'css', name: 'main.css', globs: []}
// ```
// - `globs.fonts` - Array of font path globs.
// - `globs.images` - Array of image path globs.
// - `globs.bower` - Array of all the main Bower files.
var globs = manifest.globs;

// `project` - paths to first-party assets.
// - `project.js` - Array of first-party JS assets.
// - `project.css` - Array of first-party CSS assets.
var project = manifest.getProjectGlobs();

// CLI options
var enabled = {
   // Enable static asset revisioning when `--production`
   rev : argv.production,
   // Disable source maps when `--production`
   maps : !argv.production,
   // Fail styles task on error when `--production`
   failStyleTask : argv.production,
   // Fail due to JSHint warnings only when `--production`
   failJSHint : argv.production,
   // Strip debug statments from javascript when `--production`
   stripJSDebug : argv.production
};

// Path to the compiled assets manifest in the dist directory
var revManifest = path.dist + 'assets.json';

// Error checking; produce an error rather than crashing.
var onError = function (err) {
   console.log(err.toString());
   this.emit('end');
};

// ## Smart Drop Toolbox 4 - Cofing
var toolbox = {
   site : config.site || '',
   rewriteCssUrl : config.rewriteCssUrl || '',
   bowerComponentsToKeep : config.bowerComponentsToKeep || []
};

// ## Reusable Pipelines
// See https://github.com/OverZealous/lazypipe

// ### CSS processing pipeline
// Example
// ```
// gulp.src(cssFiles)
// .pipe(cssTasks('main.css')
// .pipe(gulp.dest(path.dist + 'styles'))
// ```
var cssTasks = function (filename) {
   return lazypipe().pipe(function () {
      return gulpif(!enabled.failStyleTask, plumber());
   }).pipe(function () {
      return gulpif(enabled.maps, sourcemaps.init());
   }).pipe(function () {
      return gulpif('*.scss', sass({
         outputStyle : 'nested', // libsass doesn't support expanded yet
         precision : 10,
         includePaths : [ '.' ],
         errLogToConsole : !enabled.failStyleTask
      }));
   }).pipe(concat, filename).pipe(autoprefixer, {
      browsers : [ 'last 2 versions', 'android 4', 'opera 12' ]
   }).pipe(rewriteCSS, {
      debug : false,
      destination : toolbox.rewriteCssUrl,
      adaptPath : function (ctx) {
         var start = ctx.targetFile.lastIndexOf('/') + 1;
         var filename = ctx.targetFile.substr(start);
         if (filename.search(/.(svg|woff|woff2|eot|ttf)/gm) > -1) {
            return '../fonts/' + filename;
         } else if (filename.search(/.(jpe?g|png|gif)/gm) > -1) {
            return '../images/' + filename;
         }
      }
   }).pipe(cssNano, {
      safe : true
   }).pipe(function () {
      return gulpif(enabled.rev, rev());
   }).pipe(function () {
      return gulpif(enabled.maps, sourcemaps.write('.', {
         // includeContent : false,
         sourceRoot : './styles/'
      }));
   })();
};

// ### JS processing pipeline
// Example
// ```
// gulp.src(jsFiles)
// .pipe(jsTasks('main.js')
// .pipe(gulp.dest(path.dist + 'scripts'))
// ```
var jsTasks = function (filename) {
   return lazypipe().pipe(function () {
      return gulpif(enabled.maps, sourcemaps.init());
   }).pipe(concat, filename).pipe(uglify, {
      compress : {
         'drop_debugger' : enabled.stripJSDebug
      }
   }).pipe(function () {
      return gulpif(enabled.rev, rev());
   }).pipe(function () {
      return gulpif(enabled.maps, sourcemaps.write('.', {
         // includeContent : false,
         sourceRoot : './scripts/'
      }));
   })();
};

// ### Write to rev manifest
// If there are any revved files then write them to the rev manifest.
// See https://github.com/sindresorhus/gulp-rev
var writeToManifest = function (directory) {
   return lazypipe().pipe(gulp.dest, path.dist + directory).pipe(rev.manifest,
         revManifest, {
            base : path.dist,
            merge : true
         }).pipe(gulp.dest, path.dist)();
};

// ## Gulp tasks
// Run `gulp -T` for a task summary

// ### Styles
// `gulp styles` - Compiles, combines, and optimizes Bower CSS and project CSS.
// By default this task will only log a warning if a precompiler error is
// raised. If the `--production` flag is set: this task will fail outright.
gulp.task('styles', [ 'wiredep' ], function () {
   var merged = merge();
   manifest.forEachDependency('css', function (dep) {
      var cssTasksInstance = cssTasks(dep.name);
      if (!enabled.failStyleTask) {
         cssTasksInstance.on('error', function (err) {
            console.error(err.message);
            this.emit('end');
         });
      }
      merged.add(gulp.src(dep.globs, {
         base : 'styles'
      }).pipe(plumber({
         errorHandler : onError
      })).pipe(cssTasksInstance));
   });
   return merged.pipe(writeToManifest('styles'));
});

// ### Style
// `gulp style` - Compiles, combines, and optimizes Bower CSS and project CSS.
// By default this task will only log a warning if a precompiler error is
// raised. If the `--production` flag is set: this task will fail outright.
// Usage: gulp style --file xxx.css
gulp.task('style', [ 'wiredep' ], function () {
   var file = argv.file || false;
   if (!file) {
      gutil.log('Usage: gulp style --file xxx.css');
      return null;
   }

   var merged = merge();
   var dep = manifest.getDependencyByName(argv.file);
   gutil.log(dep.name);

   var cssTasksInstance = cssTasks(dep.name);
   if (!enabled.failStyleTask) {
      cssTasksInstance.on('error', function (err) {
         console.error(err.message);
         this.emit('end');
      });
   }
   merged.add(gulp.src(dep.globs, {
      base : 'styles'
   }).pipe(plumber({
      errorHandler : onError
   })).pipe(cssTasksInstance));
   return merged.pipe(writeToManifest('styles'));
});

// ### Scripts
// `gulp scripts` - Runs JSHint then compiles, combines, and optimizes Bower JS
// and project JS.
gulp.task('scripts', [ 'jshint' ], function () {
   var merged = merge();
   manifest.forEachDependency('js', function (dep) {
      merged.add(gulp.src(dep.globs, {
         base : 'scripts'
      }).pipe(plumber({
         errorHandler : onError
      })).pipe(jsTasks(dep.name)));
   });
   return merged.pipe(writeToManifest('scripts'));
});

// ### Script
// `gulp script` - Compiles, combines, and optimizes Bower JS
// and project JS.
// gulp script --file xxx.js
gulp.task('script', [ 'jshint' ], function () {
   var file = argv.file || false;
   if (!file) {
      gutil.log('Usage: gulp style --file xxx.js');
      return null;
   }

   var merged = merge();
   var dep = manifest.getDependencyByName(file);
   gutil.log('Compiling ' + dep.name);

   merged.add(gulp.src(dep.globs, {
      base : 'scripts'
   }).pipe(plumber({
      errorHandler : onError
   })).pipe(jsTasks(dep.name)));
   return merged.pipe(writeToManifest('scripts'));
});

// ### Fonts
// `gulp fonts` - Grabs all the fonts and outputs them in a flattened directory
// structure. See: https://github.com/armed/gulp-flatten
gulp.task('fonts', function () {
   return gulp.src(globs.fonts).pipe(flatten()).pipe(
         gulp.dest(path.dist + 'fonts'));
});

// ### Images
// `gulp images` - Run lossless compression on all the images.
gulp.task('images', function () {
   return gulp.src(globs.images).pipe(imagemin([ imagemin.jpegtran({
      progressive : true
   }), imagemin.gifsicle({
      interlaced : true
   }), imagemin.svgo({
      plugins : [ {
         removeUnknownsAndDefaults : false
      }, {
         cleanupIDs : false
      } ]
   }) ])).pipe(gulp.dest(path.dist + 'images'));
});

// ### JSHint
// `gulp jshint` - Lints configuration JSON and project JS.
gulp.task('jshint', function () {
   return gulp.src([ 'bower.json', 'gulpfile.js' ].concat(project.js)).pipe(
         jshint()).pipe(jshint.reporter('jshint-stylish')).pipe(
         gulpif(enabled.failJSHint, jshint.reporter('fail')));
});

// ### Clean
// `gulp clean` - Deletes the build folder entirely.
gulp.task('clean', function () {
   require('del').bind(null, [ path.dist ]);
});

// ### Watch
gulp.task('watch', function () {
   gulp.watch([ path.source + 'styles/**/*' ], [ 'styles' ]);
   gulp.watch([ path.source + 'scripts/**/*' ], [ 'jshint', 'scripts' ]);
   gulp.watch([ path.source + 'fonts/**/*' ], [ 'fonts' ]);
   gulp.watch([ path.source + 'images/**/*' ], [ 'images' ]);
   gulp.watch([ 'bower.json', './manifest.json' ], [ 'build' ]);
});

// ### WatchOne
gulp.task('watchfast', function () {
   // var file = argv.file || false;
   // if (!file) {
   // gutil.log('Usage: gulp watchone --file scripts/xxx/xxx/xxx.js');
   // gutil.log('Usage: gulp watchone --file styles/xxx/xxx/xxx.css');
   // return null;
   // }
   //  
   // files = file.split(',');
   // for (i in files) {
   // gutil.log('Watching ' + files[i]);
   // files[i] = path.source + files[i];
   // }
   gulp.watch([ path.source + 'styles/**/*' ], [ 'styles' ]);
   gulp.watch([ path.source + 'scripts/**/*' ], [ 'scripts' ]);
   gulp.watch([ path.source + 'fonts/**/*' ], [ 'fonts' ]);
   gulp.watch([ path.source + 'images/**/*' ], [ 'images' ]);
   gulp.watch([ 'bower.json', './manifest.json' ], [ 'build' ]);
});

// ### Build
// `gulp build` - Run all the build tasks but don't clean up beforehand.
// Generally you should be running `gulp` instead of `gulp build`.
gulp.task('build', function (callback) {
   /* runSequence('styles', 'scripts', 'keep-bower', [ 'fonts', 'images' ],
         callback); */
         
   /* runSequence('styles', 'scripts', 'transfer-tinymce', [ 'fonts', 'images' ],
         callback); */
         
   runSequence('styles', 'scripts', [ 'fonts', 'images' ],
         callback);
});

// ### Wiredep
// `gulp wiredep` - Automatically inject Less and Sass Bower dependencies. See
// https://github.com/taptapship/wiredep
gulp.task('wiredep', function () {
   var wiredep = require('wiredep').stream;
   return gulp.src(project.css).pipe(wiredep()).pipe(
         changed(path.source + 'styles', {
            hasChanged : changed.compareSha1Digest
         })).pipe(gulp.dest(path.source + 'styles'));
});

// ### Toolbox 4 - tinymce
gulp.task("keep-bower", function () {
   var i, from = [];
   for (i in toolbox.bowerComponentsToKeep) {
      from[i] = './bower_components/' + toolbox.bowerComponentsToKeep[i]
            + '/**/*';
   }
   
   return gulp.src(from).pipe(gulp.dest(function (file) {
      var dir = file.base.replace(file.cwd + '/', '');
      return path.dist + dir;
   }));
});

gulp.task("transfer-tinymce", function () {
   return gulp.src(path.source + 'bower_components/tinymce/**/*')
              .pipe(gulp.dest(path.dist + 'bower_components/tinymce'));
});

// ### Toolbox 4 - favicons
gulp.task("favicons", function () {
   gutil.log('this is gulp task has not yet been implemented.');
   gutil.log('Please use http://www.favicon-generator.org/');
   gutil.log('and unzip the icons to `/public/`');
   // return gulp.src(toolbox.favicon).pipe(favicons({
   // appName: "",
   // appDescription: "This is my application",
   // developerName: "",
   // developerURL: "",
   // background: "#020307",
   // path: "favicons/",
   // url: "",
   // display: "standalone",
   // orientation: "portrait",
   // version: 1.0,
   // logging: false,
   // online: false,
   // html: "",
   // pipeHTML: true,
   // replace: true
   // }))
   // .on("error", gutil.log)
   // .pipe(gulp.dest("./"));
});

// ### Gulp
// `gulp` - Run a complete build. To compile for production run `gulp
// --production`.
gulp.task('default', [ 'clean' ], function () {
   gulp.start('build');
});
