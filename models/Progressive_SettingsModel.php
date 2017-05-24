<?php

namespace Craft;

class Progressive_SettingsModel extends BaseModel
{
    /**
     * @return array
     */
    protected function defineAttributes() {
        return array_merge(parent::defineAttributes(), array(
            'id'                        => array(AttributeType::Number),
        	'short_name'		        => array(AttributeType::String, 'default' => ''),
            'name'  			        => array(AttributeType::String, 'default' => ''),
            'background_color'          => array(AttributeType::String, 'default' => ''),
            'theme_color'               => array(AttributeType::String, 'default' => ''),
            'start_url'                 => array(AttributeType::String, 'default' => ''),
        	'orientation' 				=> array(AttributeType::String, 'default' => ''),
            'display'                   => array(AttributeType::String, 'default' => ''),
            'cached_files'              => array(AttributeType::String, 'default' => ''),
            'iconImageId'               => array(AttributeType::Number, 'default' => null),
            'iconImage144Id'            => array(AttributeType::Number, 'default' => null),
            'iconImage152Id'            => array(AttributeType::Number, 'default' => null),
            'iconImage192Id'            => array(AttributeType::Number, 'default' => null)
    	));
    }
} 