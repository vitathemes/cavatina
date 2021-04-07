"use strict";

const gulp = require("gulp");
const sass = require("gulp-sass");
sass.compiler = require("node-sass");
const imagemin = require("gulp-imagemin");
const concat = require("gulp-concat");
const cleanCSS = require("gulp-clean-css");
const uglify = require("gulp-uglify");
const browserSync = require("browser-sync").create();
const series = gulp.series;
const parallel = gulp.parallel;

const sassTask = (cb) => {
  return gulp
    .src("assets/src/scss/**/*.scss")
    .pipe(sass().on("error", sass.logError))
    .pipe(gulp.dest("assets/src/css"))
    .pipe(browserSync.stream());
  cb();
};

const cssConcatTask = (cb) => {
  return gulp
    .src([
      "./node_modules/flickity/dist/flickity.css",
      "./node_modules/simplebar/dist/simplebar.css",
      "assets/src/css/*.css",
    ])
    .pipe(concat("main.css"))
    .pipe(gulp.dest("assets/css"))
    .pipe(browserSync.stream());
  cb();
};

const cleanCssTask = (cb) => {
  return gulp
    .src("assets/css/*.css")
    .pipe(cleanCSS({ compatibility: "ie11" }))
    .pipe(gulp.dest("assets/css"));
  cb();
};

const concatJs = (cb) => {
  return gulp
    .src([
      "./node_modules/flickity/dist/flickity.pkgd.js",
      "./node_modules/flickity-sync/flickity-sync.js",
      "./node_modules/simplebar/dist/simplebar.js",
      "./node_modules/vanilla-lazyload/dist/lazyload.js",
    ])
    .pipe(concat("vendor.min.js"))
    .pipe(gulp.dest("assets/js"));
  cb();
};

const concatMainJs = (cb) => {
  return gulp
    .src(["./assets/src/js/*.js"])
    .pipe(concat("main.js"))
    .pipe(gulp.dest("assets/js"));
  cb();
};

exports.default = () =>
  gulp
    .src("assets/src/images/**/*")
    .pipe(imagemin())
    .pipe(gulp.dest("assets/images/dist"));

const browserSyncTask = (cb) => {
  browserSync.init({
    proxy: "localhost/",
  });
  cb();
};

const watchTask = () => {
  gulp.watch("./assets/src/scss/**/*.scss", series(sassTask, cssConcatTask));
  gulp.watch("./assets/src/js/*.js", series(concatJs, concatMainJs));
  gulp.watch("./**/*.php", browserSync.reload);
};

exports.default = parallel(
  series(sassTask, cssConcatTask),
  series(concatJs, concatMainJs),
  series(browserSyncTask, watchTask)
);

exports.production = parallel(cleanCssTask);
