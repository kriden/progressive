<?php

namespace Craft;

class Progressive_SettingsModel extends BaseModel
{
    /**
     * @access protected
     * @return array
     */
    protected function defineAttributes() {
        return array_merge(parent::defineAttributes(), array(
            'id'                => array(AttributeType::Number),
        	'short_name'		        => array(AttributeType::String, 'default' => ''),
            'name'  			        => array(AttributeType::String, 'default' => ''),
            'background_color'          => array(AttributeType::String, 'default' => ''),
            'theme_color'               => array(AttributeType::String, 'default' => ''),
            'start_url'                 => array(AttributeType::String, 'default' => ''),
        	'orientation' 				=> array(AttributeType::String, 'default' => '')
    	));
    }
} 