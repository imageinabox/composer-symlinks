<?php

namespace IIAB\Symlinks;

// Exit if accessed directly
use Composer\Script\Event;
use Symfony\Component\Filesystem\Filesystem;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class ScriptHandler
 * @package       IIAB\Symlinks
 *
 * @since         0.0.1
 * @package       composer-symlinks
 * @author        Image in a Box <support@imageinabox.com>
 *
 */
class ScriptHandler {

	public static function createSymlinks( Event $event, Filesystem $filesystem = null ) {

		$package = $event->getComposer()->getPackage();
		$config  = $event->getComposer()->getConfig();
		$io      = $event->getIO();

		$base = dirname( $config->get( 'vendor-dir' ) );
		var_dump( $base );

		$symlinks = $package->getExtra()['iiab-symlinks'];
		if ( ! empty( $symlinks ) || ! is_array( $symlinks ) ) {
			$symlinks = [];
		}

		$filesystem = is_null( $filesystem ) ? new Filesystem() : $filesystem;

		foreach ( $symlinks as $key => $link ) {

			var_dump( $link );
			/*
			if ( file_exists( $link ) ) {
				continue;
			}

			$io->write( '<comment>Some symlinks are missing. Lets get them added.</comment>' );

			$value = $io->ask( sprintf( '<question>%s</question> (<comment>%s</comment>): ', $link, '' ), '' );

			if ( ! empty( $value ) ) {
				$filesystem->symlink( $value, $link );
			}*/
		}
	}
}