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
            new \Twig_Function('nsm_rev_asset', [$this, 'revAsset']),
            new \Twig_Function('nsm_rev_asset_url', [$this, 'revAssetUrl']),
        ];
    }

    /**
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
