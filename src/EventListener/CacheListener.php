<?php

namespace HeimrichHannot\TinySliderBundle\EventListener;

use Contao\CoreBundle\ServiceAnnotation\Callback;
use Contao\DataContainer;
use HeimrichHannot\TinySliderBundle\Model\TinySliderConfigModel;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpKernel\CacheClearer\CacheClearerInterface;

class CacheListener implements CacheClearerInterface
{
    public const CACHE_NAMESPACE = 'huh_tiny_slider';

    /**
     * @var ParameterBagInterface
     */
    private $parameterBag;

    public function __construct(ParameterBagInterface $parameterBag)
    {
        $this->parameterBag = $parameterBag;
    }

    /**
     * @Callback(table="tl_tiny_slider_config", target="config.onsubmit")
     */
    public function onConfigSaveCallback(DataContainer $dc): void
    {
        $configModel = TinySliderConfigModel::findByPk($dc->id);
        if (!$configModel) {
            return;
        }
        $cache = new FilesystemAdapter(static::CACHE_NAMESPACE, 0, $this->parameterBag->get('kernel.cache_dir'));
        $cache->deleteItem(static::getCacheKey((int)$configModel->id));
    }

    public static function getCacheKey(int $configId): string
    {
        return 'config_'.$configId;
    }

    public function clear(string $cacheDir)
    {
        $cache = new FilesystemAdapter(static::CACHE_NAMESPACE, 0, $this->parameterBag->get('kernel.cache_dir'));
        $cache->clear();
    }
}