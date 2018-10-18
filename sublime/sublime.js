(function() {
	'use strict';

	var fs = require('fs');
	var os = require('os');
	var _ = require('lodash');
	var path = require('path');
	var user = require('whoami-exec')();
	var exec = require('child_process').execSync;

	module.exports = (function() {
		/**
		 * The Sublime NPM Module containing the various methods for accessing Sublime files, plugins, properties, and more.
		 * @alias Sublime
		 * @namespace
		 * @return {Object}
		 */
		var Sublime = {};

		var winDirPath = exec('echo %APPDATA%', { encoding: 'UTF-8' }).split('\\').slice(1);
		winDirPath[winDirPath.length-1] = winDirPath[winDirPath.length-1].replace(/(\r\n|\n|\r)/gm,"");
		winDirPath.unshift('C:');
		
		var appsPathOSX = path.join(path.sep, 'users', user, 'Library', 'Application\ Support');
		var appsPathWin = path.join.apply(this, winDirPath);

		/**
		 * Returns an object containing arrays of absolute paths for each plugin installed for each detected Sublime App
		 * @return {Object}
		 */
		Sublime.plugins = function() {
			var plugins = {};
			switch(os.platform()){
				case 'darwin':
					var apps = fs.readdirSync(appsPathOSX);
					var sublimeApps = apps.filter(function(el) { return el.match('Sublime Text') ? true : false; });
					sublimeApps.forEach(function(dirname, idx) {
						var dir = fs.readdirSync(path.join(appsPathOSX, dirname, 'Packages'));
						// Expand the paths
						dir = dir.map(function(el) { return path.join(appsPathOSX, dirname, 'Packages', el); });
						// Filter to keep only approved dirs (and ignore .DS_Store)
						dir = dir.filter(function(el) { return (fs.lstatSync(el).isDirectory() || !el.match('.DS_Store$')) ? true : false; });
						plugins[dirname] = dir;
					});
					return plugins;
				case 'win32':
					var apps = fs.readdirSync(appsPathWin);
					var sublimeApps = apps.filter(function(el) { return el.match('Sublime Text') ? true : false; });
					sublimeApps.forEach(function(dirname, idx) {
						var dir = fs.readdirSync(path.join(appsPathWin, dirname, 'Packages'));
						// Expand the paths
						dir = dir.map(function(el) { return path.join(appsPathWin, dirname, 'Packages', el); });
						// Filter to keep only approved dirs (and ignore .DS_Store)
						dir = dir.filter(function(el) { return (fs.lstatSync(el).isDirectory() || !el.match('.DS_Store$')) ? true : false; });
						plugins[dirname] = dir;
					});
					return plugins;
				default:
					// Windows or other platform
					break;
			}
		};

		/**
		 * Returns an object containing arrays of absolute paths for each settings file stored in the User folder
		 * @return {Object}
		 */
		Sublime.getUserSettingsFiles = function() {
			var files = [];
			switch(os.platform()) {
				case 'darwin':
					var apps = fs.readdirSync(appsPathOSX);
					var sublimeApps = apps.filter(function(el) { return el.match('Sublime Text') ? true : false; });
					sublimeApps.forEach(function(dirname, idx) {
						var user_folder = fs.readdirSync(path.join(appsPathOSX, dirname, 'Packages', 'User'));
						// Expand the paths
						user_folder = user_folder.map(function(el) { return path.join(appsPathOSX, 'Packages', 'User', el); });
						// Keep only settings files
						var settings_files = user_folder.filter(function(el) { return el.match('sublime-settings$') ? true : false; });
						console.log(settings_files);
					});
					return files;
				default:
					return files;
			}
		};

		return Sublime;
	})();
})();