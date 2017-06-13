<?php
/**
 * NSM Asset Rev plugin for Craft CMS 3.x
 *
 * Various fields for CraftCMS
 *
 * @link      http://newism.com.au
 * @copyright Copyright (c) 2017 Leevi Graham
 */

/**
 * NSM Asset Rev config.php
 *
 * Completely optional configuration settings for NSM Fields if you want to customize some
 * of its more esoteric behavior, or just want specific control over things.
 *
 * Don't edit this file, instead copy it to 'craft/config' as 'nsmassetrev.php' and make
 * your changes there.
 *
 * Once copied to 'craft/config', this file will be multi-environment aware as well, so you can
 * have different settings groups for each environment, just as you do for 'general.php'
 */
return array(

    '*' => [

        /**
         * Fully qualified path to your manifest file
         */
        'manifestPath' => CRAFT_BASE_PATH.'/manifest.json',

        /**
         * Prefixed to the manifest value.
         *
         * If the final url assetUrlPrefix + manifest url is relative the siteUrl
         * will be appended. If the final qualified url is absolute or contains a
         * fully qualified domain it will not be modified.
         */
        'assetUrlPrefix' => '',
    ],
);
