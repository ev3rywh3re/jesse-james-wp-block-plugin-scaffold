# My Jesse James WP Block Plugin scaffold

## Exactly what it is.

This is just a repo for experimentation developing what are known as "WordPress block editor" tools. These are a combination of PHP, Javascript, CSS, JSON and other file types that combined create user interfaces and applications to display highly interactive content on WordPress sites.

This project is in the form of a WordPress plugin using the install of the @wordpress/create-block package as a start. This does require familiarity with modern web application build systems. As always please review source documention of these projects availble on [wordpress.org](http://wordpress.org). 

My goal is to have this in a working state as a WordPress plugin, so it can be installed and activated for learning and experimentation. If this project is current it should work with the currently available version of WordPress.

## Resources

* [https://developer.wordpress.org/block-editor/getting-started/quick-start-guide/](https://developer.wordpress.org/block-editor/getting-started/quick-start-guide/)
* [https://modularwp.com/how-to-build-gutenberg-blocks-jsx/](https://modularwp.com/how-to-build-gutenberg-blocks-jsx/)
* h[ttps://krasenslavov.com/setting-up-and-compiling-wordpress-react-js-for-the-block-editor-with-gulp-and-npm/](https://krasenslavov.com/setting-up-and-compiling-wordpress-react-js-for-the-block-editor-with-gulp-and-npm/)

## Features

* Goal is to have a space for WP block experimentation that builds something. anything.

## Getting Started

This is mostly copied from my current experiments. So it may not be edited... You are warned.

### Custom build files:

It is worth noting that there are different types of cusom build files that may be used. These can be configuration files as well as final output files. I will try to note any files that differ from the root package here.

### Install process:

**Basic package install:**

```
npx @wordpress/create-block copyright-date-block --template @wordpress/create-block-tutorial-template
```

**Some additional packages:**

`npm install @wordpress/blocks
npm install @wordpress/block-editor
npm install @wordpress/components
npm install @wordpress/data
npm install@wordpress/api-fetch
npm install @wordpress/i18n`

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

npm audit fix --force

Build with:
npm run build

The testing endpoint is at:

https://example.com/wp-json/jess-block-scaffold-experiments/v1/open/{id}
