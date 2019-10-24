var Encore = require('@symfony/webpack-encore');

Encore
    .setOutputPath('src/Resources/public/js/')
    .addEntry('contao-tiny-slider-bundle', './src/Resources/assets/js/contao-tiny-slider-bundle.js')
    .addEntry('contao-tiny-slider-bundle-theme', './src/Resources/assets/js/contao-tiny-slider-bundle-theme.js')
    .setPublicPath('/public/js/')
    .disableSingleRuntimeChunk()
    .addExternals({
        'tiny-slider': 'tns'
    })
    .configureBabel(function (babelConfig) {
    }, {
        // include to babel processing
        includeNodeModules: ['@hundh/contao-tiny-slider-bundle']
    })
    .enableSourceMaps(!Encore.isProduction())
;

module.exports = Encore.getWebpackConfig();