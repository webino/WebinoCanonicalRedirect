var root = '';
if (undefined === process.env.NODE_PATH) {
    console.error('NODE_PATH is not configured, trying to resolve.');
    root = (function () {
        try {
            require('shelljs/global');
            return exec('npm root -g', {silent: true}).output.trim() + '/';
        } catch(exc) {
            console.error('Assuming default NODE_PATH, did you initialize the module?');
        }
    })();

    root || (root = '/usr/lib/node_modules/');
    process.env.NODE_PATH = root;
}
module.exports = function(grunt) {
    grunt.initConfig((function() {
        var config = (function () {
            return require(root + 'webino-devkit');
        })().config(grunt, ['module', 'github', 'zend'])

        // TODO issue https://github.com/zendframework/ZendSkeletonApplication/pull/283/files
        config.test_app_vendor_git = 'https://github.com/bacinsky';
        config.test_app_git_branch = 'hotfix/index-php-cli-server';
        return config;
    })());
};
