<?php
namespace Craft;

class Progressive_SettingsRecord extends BaseRecord
{

    /**
     * Fetches table name
     * @return string
     */
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

    /**
     * Defines relationships with other tables
     * @return array
     */
    public function defineRelations()
    {
        return array(
            'iconImage' => array(static::BELONGS_TO, 'AssetFileRecord')
        );
    }

    /**
     * Creates a new instance of this record.
     * @return Progressive_SettingsRecord
     */
    public function create()
    {
        $class = get_class($this);
        $record = new $class();
        return $record;
    }

} /* -- class Progressive_SettingsRecord */