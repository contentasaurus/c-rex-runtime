//
// Gulpfile
//

var gulp = require('gulp');
var browserSync = require('browser-sync');

gulp.task('watch', function() {
	browserSync.init({
		proxy: 'runtime-bs.puffin.dev'
	});

	gulp.watch('init.php', ['refresh']);

	// gulp.watch('app/**/*.php', ['refresh']);

	// gulp.watch('vendor/pinguinio/puffin-framework/**/*.php', ['refresh']);
});

gulp.task('refresh', function(done) {
	browserSync.reload();
	done();
});