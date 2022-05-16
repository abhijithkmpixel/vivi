import { src, dest, watch, parallel, series } from 'gulp';
import yargs from 'yargs';
import sass from 'gulp-sass';
import cleanCss from 'gulp-clean-css';
import gulpif from 'gulp-if';
import postcss from 'gulp-postcss';
import sourcemaps from 'gulp-sourcemaps';
import autoprefixer from 'autoprefixer';
import imagemin from 'gulp-imagemin';
import webpack from 'webpack-stream';
import del from 'del';
import browserSync from "browser-sync";
import minify from "gulp-babel-minify";
import rename from "gulp-rename";

const PRODUCTION = yargs.argv.prod;

export const styles = () => {
    return src('src/scss/*.scss')
        .pipe(gulpif(!PRODUCTION, sourcemaps.init()))
        .pipe(sass().on('error', sass.logError))
        .pipe(gulpif(PRODUCTION, postcss([ autoprefixer ])))
        .pipe(gulpif(PRODUCTION, cleanCss({compatibility:'ie8'})))
        .pipe(gulpif(!PRODUCTION, sourcemaps.write()))
        .pipe(dest('dist/css'))
        .pipe(server.stream());
};

export const images = () => {
    return src('src/images/**/*.{jpg,jpeg,png,svg,gif}')
        .pipe(gulpif(PRODUCTION, imagemin()))
        .pipe(dest('dist/images'));
};

export const copy = () => {
    return src(['src/**/*','!src/{images,js,scss}','!src/{images,js,scss}/**/*'])
        .pipe(dest('dist'));
};

export const clean = () => del(['dist']);

export const swiper = () => {
  return src('src/js/plugins/swiper-bundle.min.js')
    .pipe(minify({
      mangle: {
        keepClassName: true
      }
    }))
    .pipe(rename('swiper.min.js'))
    .pipe(dest("dist/js"));
};

export const toast = () => {
  return src('src/js/plugins/toast.js')
    .pipe(minify({
      mangle: {
        keepClassName: true
      }
    }))
    .pipe(rename('toast.min.js'))
    .pipe(dest("dist/js"));
};

export const locomotive = () => {
  return src('src/js/plugins/locomotive-scroll.min.js')
    .pipe(minify({
      mangle: {
        keepClassName: true
      }
    }))
    .pipe(rename('locomotive.min.js'))
    .pipe(dest("dist/js"));
};

export const app = () => {
  return src('src/js/app/app.js')
    .pipe(minify({
      mangle: {
        keepClassName: true
      }
    }))
    .pipe(rename('app.min.js'))
    .pipe(dest("dist/js"));
};

export const home = () => {
  return src('src/js/app/home.js')
    .pipe(minify({
      mangle: {
        keepClassName: true
      }
    }))
    .pipe(rename('home.min.js'))
    .pipe(dest("dist/js"));
};

export const select = () => {
  return src('src/js/plugins/select.js')
    .pipe(minify({
      mangle: {
        keepClassName: true
      }
    }))
    .pipe(rename('select.min.js'))
    .pipe(dest("dist/js"));
};

export const datepicker = () => {
  return src('src/js/plugins/datepicker.js')
    .pipe(minify({
      mangle: {
        keepClassName: true
      }
    }))
    .pipe(rename('datepicker.min.js'))
    .pipe(dest("dist/js"));
};

export const intlTelInput = () => {
  return src('src/js/plugins/intlTelInput.js')
    .pipe(minify({
      mangle: {
        keepClassName: true
      }
    }))
    .pipe(rename('intlTelInput.min.js'))
    .pipe(dest("dist/js"));
};

export const utils = () => {
  return src('src/js/plugins/utils.js')
    .pipe(minify({
      mangle: {
        keepClassName: true
      }
    }))
    .pipe(rename('utils.js'))
    .pipe(dest("dist/js"));
};

export const validateJs = () => {
  return src('src/js/plugins/jquery.validate.js')
    .pipe(minify({
      mangle: {
        keepClassName: true
      }
    }))
    .pipe(rename('jquery.validate.min.js'))
    .pipe(dest("dist/js"));
};

export const SmoothScroll = () => {
  return src('src/js/plugins/SmoothScroll.js')
    .pipe(minify({
      mangle: {
        keepClassName: true
      }
    }))
    .pipe(rename('SmoothScroll.min.js'))
    .pipe(dest("dist/js"));
};

export const ajax = () => {
  return src('src/js/app/ajax.js')
    .pipe(minify({
      mangle: {
        keepClassName: true
      }
    }))
    .pipe(rename('ajax.min.js'))
    .pipe(dest("dist/js"));
};

// export const swiper = () => {
//   return src('src/js/plugins/swiper-bundle.min.js')
//       .pipe(webpack({
//           module: {
//               rules: [
//                   {
//                       test: /\.js$/,
//                       use: {
//                           loader: 'babel-loader',
//                           options: {
//                               presets: []
//                           }
//                       }
//                   }
//               ]
//           },
//           mode: PRODUCTION ? 'production' : 'development',
//           devtool: !PRODUCTION ? 'inline-source-map' : false,
//           output: {
//               filename: 'swiper.min.js'
//           },
//       }))
//       .pipe(dest('dist/js'));
// };

// export const wow = () => {
//   return src('src/js/plugins/wow.js')
//       .pipe(webpack({
//           module: {
//               rules: [
//                   {
//                       test: /\.js$/,
//                       use: {
//                           loader: 'babel-loader',
//                           options: {
//                               presets: []
//                           }
//                       }
//                   }
//               ]
//           },
//           mode: PRODUCTION ? 'production' : 'development',
//           devtool: !PRODUCTION ? 'inline-source-map' : false,
//           output: {
//               filename: 'wow.min.js'
//           },
//       }))
//       .pipe(dest('dist/js'));
// };




export const app_scripts = () => {
  return src('src/js/app/*.js')
      .pipe(webpack({
          module: {
              rules: [
                  {
                      test: /\.js$/,
                      use: {
                          loader: 'babel-loader',
                          options: {
                              presets: []
                          }
                      }
                  }
              ]
          },
          mode: PRODUCTION ? 'production' : 'development',
          devtool: !PRODUCTION ? 'inline-source-map' : false,
          output: {
              filename: 'app.min.js'
          },
      }))
      .pipe(dest('dist/js'));
};

const server = browserSync.create();
export const serve = done => {
    server.init({
        proxy: "http://localhost/vivi/" // your local website link
    });
    done();
};
export const reload = done => {
    server.reload();
    done();
};

export const watchForChanges = () => {
    watch('src/scss/**/*.scss', series(styles));
    watch('src/images/**/*.{jpg,jpeg,png,svg,gif}', series(images, reload));
    watch(['src/**/*','!src/{images,js,scss}','!src/{images,js,scss}/**/*'], series(copy, reload));
    watch('src/js/**/*.js', series(home, reload));
    watch('src/js/**/*.js', series(app, reload));
    watch('src/js/**/*.js', series(ajax, reload));
    watch('src/js/**/*.js', series(swiper, reload));
    watch('src/js/**/*.js', series(toast, reload));
    watch('src/js/**/*.js', series(locomotive, reload));
    watch('src/js/**/*.js', series(select, reload));
    watch('src/js/**/*.js', series(datepicker, reload));
    watch('src/js/**/*.js', series(intlTelInput, reload));
    watch('src/js/**/*.js', series(validateJs, reload));
    watch('src/js/**/*.js', series(SmoothScroll, reload));
    watch('src/js/**/*.js', series(utils, reload));
    watch("**/*.php", reload);
};

export const dev = series(clean, parallel(styles, images, copy, home, app, select, ajax, datepicker, intlTelInput, validateJs, SmoothScroll, utils, swiper, toast, locomotive), serve, watchForChanges);
export const build = series(clean, parallel(styles, images, copy, home, app, select, ajax, datepicker, intlTelInput, utils, validateJs, SmoothScroll, swiper, toast, locomotive));
export default dev;