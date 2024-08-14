# jesse-james-wp-block-plugin-scaffold


# jesse-james-wp-block-plugin-scaffold

This is a basic WordPress plugin project to provide some basic scaffolding for development.

## Features

* Goal to have a space for WP block experimentation that builds something. anything.

## Getting Started

This is mostly copied from my current experiments. So it may not be edited... You are warned.

From: https://developer.wordpress.org/block-editor/getting-started/quick-start-guide/

More From: https://modularwp.com/how-to-build-gutenberg-blocks-jsx/

And More from: https://krasenslavov.com/setting-up-and-compiling-wordpress-react-js-for-the-block-editor-with-gulp-and-npm/

### Custom build files:

### Install process:

npx @wordpress/create-block copyright-date-block --template @wordpress/create-block-tutorial-template

### commands:

$ npm start
Starts the build for development.

$ npm run build
Builds the code for production.

$ npm run format
Formats files.

$ npm run lint:css
Lints CSS files.

$ npm run lint:js
Lints JavaScript files.

$ npm run plugin-zip
Creates a zip file for a WordPress plugin.

$ npm run packages-update
Updates WordPress packages to the latest version.

You can start development with:

  $ npm start

You can start WordPress with:

  $ npx wp-env start


### FIX Notes

Adding to while restarting developemnt with this new repo using basic functionality...

npm install --save-dev gulp browserify babelify vinyl-source-stream vinyl-buffer gulp-uglify gulp-notify --legacy-peer-deps

npm audit fix --force

Build with:
npm run build
