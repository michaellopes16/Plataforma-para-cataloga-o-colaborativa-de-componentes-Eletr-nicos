(function(){
	'use strict';

	var path = require('path');

	// Returns the name of the logged in user (useful for locating the user folder)
	module.exports = function() {
		var username = require('child_process').execSync('whoami', { encoding: 'utf-8' });
		return String(username).trim();
	};
})();
