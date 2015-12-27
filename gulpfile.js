var gulp = require('gulp');
var exec = require('child_process').exec;
var browserSync = require('browser-sync');

gulp.task('test', function(done){
    exec('vendor\\bin\\phpunit.bat --coverage-html coverage', function(err, stdout, stderr){
        console.log(stdout);
        console.error(stderr);
        done();
    });
});

gulp.task('browser-sync', function() {
    browserSync.init({
        server: {
            baseDir: "./coverage/",
            port: 3005
        }
    });
})

gulp.task('reload', ['test'], function(){
    browserSync.reload();
});

gulp.task('watch', ['browser-sync'], function(){
    gulp.watch(['src/**', 'tests/**'], ['reload']);
});

gulp.task('default', ['test']);
