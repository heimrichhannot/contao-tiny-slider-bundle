var Encore = require('@symfony/webpack-encore');

Encore
    .setOutputPath('src/Resources/public/js/')
    .addEntry('contao-tiny-slider-bundle', '@hundh/contao-tiny-slider-bundle')
    .setPublicPath('/public/js/')
    .disableSingleRuntimeChunk()
    .addExternals({
        'tiny-slider': 'tns'
    })
    .configureBabel(function (babelConfig) {
    }, {
        exclude: (filePath) => {
            // do not exclude anything from babel!
            return false;
        }
    })
    .enableSourceMaps(!Encore.isProduction())
;

module.exports = Encore.getWebpackConfig();