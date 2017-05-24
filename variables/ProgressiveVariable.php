<?php
namespace Craft;

class ProgressiveVariable
{
	/**
	 * Returns the manifest JSON notation.
	 * @return string
	 */
	public function renderManifest() {
		return craft()->progressive->renderManifest();
	}
}