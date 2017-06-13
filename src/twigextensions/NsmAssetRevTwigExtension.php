<?php
/**
 * NSM Asset Rev plugin for Craft CMS 3.x
 *
 * Rev asset urls with timestamps
 *
 * @link      http://newism.com.au
 * @copyright Copyright (c) 2017 Newism
 */

namespace newism\assetrev\twigextensions;

use craft\elements\Asset;
use craft\helpers\UrlHelper;
use newism\assetrev\NsmAssetRev;

/**
 * Twig can be extended in many ways; you can add extra tags, filters, tests, operators,
 * global variables, and functions. You can even extend the parser itself with
 * node visitors.
 *
 * http://twig.sensiolabs.org/doc/advanced.html
 *
 * @author    Newism
 * @package   NsmAssetRev
 * @since     0.0.1
 */
class NsmAssetRevTwigExtension extends \Twig_Extension
{

    /**
     * @var array
     */
    static protected $manifest;


    // Public Methods
    // =========================================================================

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName(): string
    {
        return 'NsmAssetRev';
    }

    /**
     * Returns an array of Twig functions, used in Twig templates via:
     *
     *      {% set this = someFunction('something') %}
     *
     * @return array
     */
    public function getFunctions(): array
    {
        return [
            new \Twig_Function('nsm_rev_url', [$this, 'revUrl']),
            new \Twig_Function('nsm_rev_asset_url', [$this, 'revAssetUrl']),
            new \Twig_Function('nsm_rev_manifest_url', [$this, 'revManifestUrl']),
        ];
    }

    /**
     * Helper function that accepts either an Asset or url
     *
     * @return string
     */
    public function revUrl(): string
    {
        $args = func_get_args();
        $method = ($args[0] instanceof Asset) ? 'revAssetUrl' : 'revManifestUrl';

        return $this->$method(...$args);
    }

    /**
     * Rev an asset url and optional transform
     *
     * @param Asset $asset
     * @param null $transform
     * @return string
     */
    public function revAssetUrl(Asset $asset, $transform = null): string
    {
        $revvedUrl = $this->addTimeStamp(
            $asset->dateModified->getTimestamp(),
            $asset->getUrl($transform),
            $asset->getExtension()
        );

        return $revvedUrl;
    }

    /**
     * Rev a url checking the manifest
     *
     * @param $url
     * @return string
     */
    public function revManifestUrl($url): string
    {
        $pluginSettings = NsmAssetRev::getInstance()->getSettings();
        $manifestPath = $pluginSettings['manifestPath'];

        if (null === self::$manifest) {
            try {
                self::$manifest = json_decode(
                    file_get_contents($manifestPath),
                    true
                );
            } catch (\Exception $exception) {
                self::$manifest = [];
            }
        }

        $url = array_key_exists($url, self::$manifest)
                ? self::$manifest[$url]
                : $url;

        $url = $pluginSettings['assetUrlPrefix'].$url;

        return UrlHelper::url($url);
    }

    /**
     * Add a timestamp to a url
     *
     * @param $timestamp
     * @param $url
     * @param $extension
     * @return mixed
     */
    private function addTimeStamp($timestamp, $url, $extension): string
    {
        return str_replace($extension, $timestamp.'.'.$extension, $url);
    }
}
