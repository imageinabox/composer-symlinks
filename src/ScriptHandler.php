<?php

namespace IIAB\Symlinks;

// Exit if accessed directly
use Composer\Script\Event;
use Symfony\Component\Filesystem\Filesystem;

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

	public static function createSymlinks( Event $event) {

		$package = $event->getComposer()->getPackage();
		$io      = $event->getIO();

		$extras = $package->getExtra();
		$symlinks = isset( $extras['iiab-symlinks'] ) ? $extras['iiab-symlinks'] : [];
		if ( empty( $symlinks ) || ! is_array( $symlinks ) ) {
			$symlinks = [];
		}

		$filesystem = new Filesystem();

		foreach ( $symlinks as $link ) {

			if ( file_exists( $link ) ) {
				continue;
			}

			$io->write( '<comment>Some symlinks are missing. Lets get them added.</comment>' );

			$value = $io->ask( sprintf( '<question>%s</question> : ', $link, '' ), '' );

			if ( ! empty( $value ) ) {
				$filesystem->symlink( $value, $link );
			}
		}
	}
}