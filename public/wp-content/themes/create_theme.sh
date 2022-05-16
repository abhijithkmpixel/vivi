#!/bin/bash

echo "## WORDPRESS THEME BOILERPLATE GENERATOR ##"
echo
echo "Please answer to the following questions and press [ENTER]. Leave it blank if don't want to specify something."
echo
echo "1. Theme Name?"
read -r theme_name
echo "2. Theme Slug?"
read -r theme_slug
echo "3. Theme Author?"
read -r theme_author
echo "4. Author URI?"
read -r author_uri
echo "Theme Description?"
read -r theme_description
while true; do
    read -p "Do you want the theme woocommerce ready?" yn
    case $yn in
        [Yy]* ) woocommerce=1; break;;
        [Nn]* ) woocommerce=0; break;;
        * ) echo "Please answer yes or no.";;
    esac
done
echo
echo "Creating theme..."

curl --data "underscoresme_generate=1&underscoresme_name=${theme_name}&underscoresme_slug=${theme_slug}&underscoresme_author=${theme_author}&underscoresme_author_uri=${author_uri}&underscoresme_description=${theme_description}" http://underscores.me >> "${theme_slug}".zip; unzip "${theme_slug}".zip; rm "${theme_slug}".zip;

echo "Done."
echo
echo "Fixing folder structure..."
mkdir -p "${theme_slug}"/src/images
mkdir -p "${theme_slug}"/src/scss
mkdir -p "${theme_slug}"/src/js
mkdir -p "${theme_slug}"/dist/images
mkdir -p "${theme_slug}"/dist/css
mkdir -p "${theme_slug}"/dist/js
echo "Done."
echo
echo "writing Gulp configuration files..."
cd "${theme_slug}"
curl -O https://gist.githubusercontent.com/daaanny90/64b7e4dc6f58e7d17f1f411562983656/raw/eee88f4227f06530272f771e6237f2b36c58b4ec/gulpfile.babel.js
cat <<EOF >.babelrc
{
  "presets": ["@babel/preset-env"]
}
EOF
echo "Done."
echo
echo "Set up NPM."

/usr/bin/expect <<!

spawn npm init
expect "package name:"
send "${theme_slug}\n"
expect "version:"
send "1.0.0\n"
expect "description:"
send "${theme_description}\n"
expect "entry point:"
send "index.js\n"
expect "test command:"
send "\n"
expect "git repository"
send "\n"
expect "keywords:"
send "\n"
expect "author:"
send "${theme_author}\n"
expect "license:"
send "\n"
expect "Is this ok?"
send "yes\n"
expect eof
!
file='package.json'

jq '.scripts = {"start": "gulp", "build": "gulp build --prod"}' $file > tmp.$$.json && mv tmp.$$.json $file
echo "Done."
echo
echo "Installing dependencies..."
npm install --save-dev @babel/register @babel/preset-env @babel/core gulp yargs gulp-sass gulp-clean-css gulp-postcss autoprefixer gulp-sourcemaps gulp-imagemin webpack-stream babel-loader browser-sync gulp-if del
npm install --global gulp-cli

cd src/scss
touch bundle.scss
cd .. && cd js
touch bundle.js

echo 'Ready!'
