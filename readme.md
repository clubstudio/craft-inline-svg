# Craft CMS Inline SVG (Craft 3.x)
[![Build Status](https://travis-ci.org/clubstudioltd/craft-inline-svg.svg?branch=master)](https://travis-ci.org/clubstudioltd/craft-inline-svg)
[![Latest Stable Version](https://poser.pugx.org/clubstudioltd/craft-inline-svg/v/stable)](https://packagist.org/packages/clubstudioltd/craft-inline-svg)
[![Total Downloads](https://poser.pugx.org/clubstudioltd/craft-inline-svg/downloads)](https://packagist.org/packages/clubstudioltd/craft-inline-svg)
[![Latest Unstable Version](https://poser.pugx.org/clubstudioltd/craft-inline-svg/v/unstable)](https://packagist.org/packages/clubstudioltd/craft-inline-svg)
[![License](https://poser.pugx.org/clubstudioltd/craft-inline-svg/license)](https://packagist.org/packages/clubstudioltd/craft-inline-svg)

A Twig extension for Craft CMS that helps you inline SVGs in your templates.

## Why?
While Craft provides an `svg()` function out of the box, you need to pass an Asset element or full path every time you use it. This plugin provides allows you to define SVG paths and inline SVGs .

## Installation
Install via the Plugin Store within your Craft 3 installation or using Composer: `composer require clubstudioltd/craft-inline-svg`

## Configuration
The plugin comes with a `config.php` file that defines some sensible defaults.

If you want to set your own values you should create a `inlinesvg.php` file in your Craft `/config` directory. The contents of this file will get merged with the plugin defaults, so you only need to specify values for the settings you want to override.

## Basic Usage
Once activated and configured you can use the `inlineSvg()` function in your templates.

```
{{ inlineSvg('icon') }}
```

In this example the plugin will look for a file called `icon.svg` in all of the configured paths and return the first match it finds.

### Adding additional classes
The plugin will add any classes defined in your configuration file to the SVG output. You can add more by passing them as a second parameter:

```
{{ inlineSvg('icon', 'another-class') }}
```

You can override the classes defined in your configuration file ad hoc using the `class` key:

```
{{ inlineSvg('icon', { class: 'override-class' }) }}
```

### Adding additional parameters
You can add additional parameters by passing them as an array:

```
{{ inlineSvg('icon', 'my-class', { id: 'icon-1' }) }}
```

which would output:

```
<svg id="icon-1" class="my-class" ... >
```
