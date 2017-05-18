<?php 

namespace Craft;

class ProgressiveService extends BaseApplicationComponent {
	
	protected $settingsRecord;

	public function __construct($settingsRecord = null) {
		$this->settingsRecord = $settingsRecord;
		if(is_null($this->settingsRecord)) {
			$this->settingsRecord = Progressive_SettingsRecord::model();
		}
	}

	public function create($attributes = array()) {
        $model = new Progressive_SettingsModel();
        $model->setAttributes($attributes);
        return $model;
	}

	public function getSettings() {
        $records = $this->settingsRecord->findAll(array('order'=>'t.id desc', 'limit' => '1'));
        
        if(count($records) > 0) {
        	$models = Progressive_SettingsModel::populateModels($records, 'id');
        	if(count($models) > 0) {
        		return array_pop($models);
        	}
    	}
    	return $this->create();
	}

	/**
	* Saves settings
	*
	* @return bool
	*/
	public function saveSettings(Progressive_SettingsModel &$model) {
		if ($id = $model->getAttribute('id')) {
            if (null === ($record = $this->settingsRecord->findByPk($id))) {
                throw new Exception(Craft::t('Can\'t find ingredient with ID "{id}"', array('id' => $id)));
            }
        } else {
            $record = $this->settingsRecord->create();
        }

        foreach($model->getAttributes() as $key => $value) {
        	$record->setAttribute($key, $value);
    	}
        if($record->save()) {
        	$model->setAttribute('id', $record->getAttribute('id'));
        } else {
        	$model->addErrors($record->getErrors());
        }
	}

	public function renderManifest() {
		$settings = $this->getSettings();

		$manifest = array(
			'short_name' => $settings->short_name,
			'name' => $settings->name,
			'background_color' => $settings->background_color,
			'theme_color' => $settings->theme_color,
			'start_url' => $settings->start_url
		);

		if($settings->orientation !== '') {
			$manifest['orientation'] = $settings->orientation;
		}

		return json_encode($manifest);
	}
}
?>