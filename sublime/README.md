# sublime
npm module for interfacing with Sublime Text plugins and settings

### Installation:

    npm install --save sublime

### Methods:

1. **Fetch Installed Plugins Folders**

Returns an object containing arrays of absolute paths for each plugin installed for each detected Sublime App

```js
var Sublime = require('sublime');

var plugins = Sublime.plugins();

console.log(plugins);
```

Output

```json
{
	"Sublime Text 2": [ ... ],
	"Sublime Text 3": [ ... ]
}
```

2. **Fetch Custom User Settings for Plugins/etc**

Returns an object containing arrays of absolute paths for each settings file found in the User folder

```js
var Sublime = require('sublime');

var settings_files = Sublime.getUserSettingsFiles();

console.log(settings_files);
```

Output

```json
{
	"Sublime Text 2": [ ... ],
	"Sublime Text 3": [ ... ]
}
```