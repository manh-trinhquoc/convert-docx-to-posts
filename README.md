The composer.json is for end user to install plugin in the right plugin directory.
For plugin developer, install dependence using compose-dev.json

# install composer to distribute
- Windows powershell:
` $Env:COMPOSER='composer-dev.json' `
` composer install --no-dev ` 