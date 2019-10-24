var Encore = require('@symfony/webpack-encore');

Encore
.setOutputPath('src/Resources/public/')
.addEntry('contao-tiny-slider-bundle', './src/Resources/assets/js/contao-tiny-slider-bundle.js')
.addEntry('contao-tiny-slider-bundle-theme', './src/Resources/assets/js/contao-tiny-slider-bundle-theme.js')
.addEntry('tiny-slider', 'tiny-slider/dist/tiny-slider')
.setPublicPath('/bundles/contaotinyslider/')
.setManifestKeyPrefix('bundles/contaotinyslider')
.disableSingleRuntimeChunk()
.addExternals({
    'tiny-slider': 'tns'
})
.configureBabel()
.enableSourceMaps(!Encore.isProduction())
.enableSassLoader()
.enablePostCssLoader()
;

module.exports = Encore.getWebpackConfig();