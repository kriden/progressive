<?php
namespace Craft;

class Progressive_SettingsRecord extends BaseRecord
{

    public function getTableName()
    {
        return 'progressive_settings';
    }

    protected function defineAttributes()
    {
        return array(
            'locale'			        => array(AttributeType::String, 'default' => craft()->language),
            'elementId'			        => array(AttributeType::Number, 'default' => 0),
            'short_name'		        => array(AttributeType::String, 'default' => ''),
            'start_url'                 => array(AttributeType::String, 'start_url' => ''),
            'name'  			        => array(AttributeType::String, 'default' => ''),
            'background_color'          => array(AttributeType::String, 'default' => ''),
            'theme_color'               => array(AttributeType::String, 'default' => ''),
            'orientation'               => array(AttributeType::String, 'default' => ''),
            'display'                   => array(AttributeType::String, 'default' => ''),
            'cached_files'              => array(AttributeType::String, 'default' => '')
        );
    }

    public function defineRelations()
    {
        return array(
            'iconImage' => array(static::BELONGS_TO, 'AssetFileRecord')
        );
    }

    

    public function create()
    {
        $class = get_class($this);
        $record = new $class();
        return $record;
    }

} /* -- class Progressive_SettingsRecord */