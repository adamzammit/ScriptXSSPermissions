# LimeSurvey ScriptXSSPermissions plugin
LimeSurvey plugin to make question script and XSS filter permissions user based instead of global

## Requirements
- LimeSurvey 6.X

## Installation instructions
- Download the zip from the [releases](https://github.com/adamzammit/ScriptXSSPermissions/releases) page and extract to your plugins folder.

## Usage
- Enable the plugin
- Enable "Filter HTML for XSS" in Global settings
- Enable "Disable question script for XSS restricted user" in Global settings
- Assign the "Allow question javascript editing" update permission to those who need to edit javascript
- Assign the "Disable XSS filter" update permission to those who can be trusted not to need XSS filtering

## Acknowledgements

- LimeSurvey: https://github.com/LimeSurvey/LimeSurvey
 
## Licence

GPLv3
