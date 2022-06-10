<img src="./src/icon.svg" width="64">

# Craft CMS Inline SVG
[![Build Status](https://travis-ci.com/clubstudioltd/craft-inline-svg.svg?branch=master)](https://travis-ci.com/clubstudioltd/craft-inline-svg)
[![Latest Stable Version](https://poser.pugx.org/clubstudioltd/craft-inline-svg/v/stable)](https://packagist.org/packages/clubstudioltd/craft-inline-svg)
[![Total Downloads](https://poser.pugx.org/clubstudioltd/craft-inline-svg/downloads)](https://packagist.org/packages/clubstudioltd/craft-inline-svg)
[![Latest Unstable Version](https://poser.pugx.org/clubstudioltd/craft-inline-svg/v/unstable)](https://packagist.org/packages/clubstudioltd/craft-inline-svg)
[![License](https://poser.pugx.org/clubstudioltd/craft-inline-svg/license)](https://packagist.org/packages/clubstudioltd/craft-inline-svg)

A Twig extension for Craft CMS that helps you inline SVGs in your templates.

## Why?
While Craft provides an `svg()` function out of the box, you need to pass an Asset element or full path every time you use it. If all of your SVGs are stored in the same (or a handful of) directories, this plugin allows you to use shorter, more convenient syntax to inline your SVG.

## Installation
Install via the Plugin Store within your Craft 3 installation or using Composer:

```composer require clubstudioltd/craft-inline-svg```

## Configuration
The plugin comes with a `config.php` file that defines some sensible defaults.

If you want to set your own values you should create a `inlinesvg.php` file in your Craft `/config` directory. The contents of this file will get merged with the plugin defaults, so you only need to specify values for the settings you want to override.

### Example Config

```
<?php

return [

    // Enter the paths to the directories where you store your individual SVG
    // files. Absolute paths should be used, which is simple using aliases
    // such as @webroot. (https://docs.craftcms.com/v3/config/#aliases)

    'paths' => [
        '@webroot/img/svg',
    ],

    // Specify any CSS classes that you want to add to all SVGs included in
    // your templates. The classes that you specify here will be merged
    // with any passed through as the second param of `inlineSvg()`.

    'class' => 'fill-current',

];

```

You should add the paths to all of the directories where your SVG files are stored to the `paths` configuration array.

If you'd like to add a class to every SVG that is output you should add it to the `class` configuration value. Separate multiple classes with spaces.

## Basic Usage

Once activated and configured you can use the `inlineSvg()` function in your templates.

```
{{ inlineSvg('icon') }}
```

In this example the plugin will look for a file called `icon.svg` in all of the configured paths and return the first match it finds.

### Adding additional classes

The plugin will add any classes defined in your configuration file to the SVG output. You can add more by passing them as a second parameter:

```
{{ inlineSvg('icon', 'another-class') }}
```

You can override the classes defined in your configuration file ad hoc using the `class` key:

```
{{ inlineSvg('icon', { class: 'override-class' }) }}
```

this would output `<svg class="override-class" ... >` regardless of any other classes defined in your config file.

### Adding additional parameters

You can add additional parameters by passing them as an array:

```
{{ inlineSvg('icon', 'my-class', { id: 'icon-1' }) }}
```

which would output:

```
<svg id="icon-1" class="my-class" ... >
```

### Sanitising & Namespacing

As the `inlineSvg()` helper uses the native Craft `svg()` helper under the hood, you can still make use of the sanitising and namespacing it offers:

```
{{ inlineSvg('icon', 'my-class', { sanitize: true, namespace: true }) }}
```

## Credits

Inspired by [blade-svg](https://github.com/adamwathan/blade-svg)
