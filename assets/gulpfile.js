var gulp = require('gulp'),
    $    = require('gulp-load-plugins')();

var handleError = function (err) {
  $.notify.onError()(err);
  this.emit('end');
};

// Default
gulp.task('default', function () {
  $.livereload.listen();
  gulp.watch('sass/**/*.scss', ['sass']);
  gulp.watch('../css/*.css').on('change', $.livereload.changed);
  gulp.watch('javascripts/**/*.js', ['lint', 'scripts', 'plugins', 'modules']).on('change', $.livereload.changed);
});

// SASS
gulp.task('sass', function () {
  return gulp.src('sass/**/*.scss')
    .pipe($.rubySass({
      compass : true,
      sourcemap : 'auto'
    }).on('error', handleError))
    .pipe($.autoprefixer())
    .pipe(gulp.dest('../css'))
    .pipe($.rename({ suffix: '.min' }))
    .pipe($.minifyCss())
    .pipe(gulp.dest('../css'));
});

// Script linting
gulp.task('lint', function () {
  return gulp.src('javascripts/*.js')
    .pipe($.jshint())
    .pipe($.jshint.reporter('jshint-stylish'))
    .pipe($.notify(function (file) {
      if (file.jshint.success) {
        return false;
      }

      var errors = file.jshint.results.map(function (data) {
        if (data.error) {
          return "(" + data.error.line + ':' + data.error.character + ') ' + data.error.reason;
        }
      }).join("\n");
      return file.relative + " (" + file.jshint.results.length + " errors)\n" + errors;
    }));
});

// Script concat and uglify
gulp.task('scripts', function () {
  return gulp.src('javascripts/*.js')
    .pipe($.concat('scripts.js'))
    .pipe(gulp.dest('../js'))
    .pipe($.rename({ suffix: '.min' }))
    .pipe($.uglify())
    .pipe(gulp.dest('../js'));
});

// Plugin scripts concat and uglify
gulp.task('plugins', function () {
  return gulp.src('javascripts/contrib/*.js')
    .pipe($.concat('plugins.js'))
    .pipe(gulp.dest('../js'))
    .pipe($.rename({ suffix: '.min' }))
    .pipe($.uglify())
    .pipe(gulp.dest('../js'));
});

// Module scripts concat and uglify
gulp.task('modules', function () {
  return gulp.src('javascripts/modules/*.js')
    .pipe(gulp.dest('../js'))
    .pipe($.rename({ suffix: '.min' }))
    .pipe($.uglify())
    .pipe(gulp.dest('../js'));
});
