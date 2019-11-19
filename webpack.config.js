var Encore = require('@symfony/webpack-encore');

Encore
.setOutputPath('src/Resources/public/')
.addEntry('contao-tiny-slider-bundle', './src/Resources/npm-package/js/contao-tiny-slider-bundle.js')
.addEntry('contao-tiny-slider-bundle-theme', './src/Resources/assets/js/contao-tiny-slider-bundle-theme.js')
.setPublicPath('/bundles/contaotinyslider/')
.setManifestKeyPrefix('bundles/contaotinyslider')
.disableSingleRuntimeChunk()
.splitEntryChunks()
    .configureSplitChunks(function(splitChunks) {
        splitChunks.name =  function (module, chunks, cacheGroupKey) {
            const moduleFileName = module.identifier().split('/').reduceRight(item => item).split('.').slice(0, -1).join('.');
            return `${moduleFileName}`;
        };
})
.configureBabel(null)
.enableSourceMaps(!Encore.isProduction())
.enableSassLoader()
.enablePostCssLoader()
;

module.exports = Encore.getWebpackConfig();