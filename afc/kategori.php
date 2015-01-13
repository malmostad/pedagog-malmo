<?php
if(function_exists("register_field_group"))
{
  register_field_group(array (
    'id' => 'acf_uppdelning-av-kategori',
    'title' => 'Uppdelning av kategori',
    'fields' => array (
      array (
        'key' => 'field_54acfbd8ed1b8',
        'label' => 'Uppdelning av kategori',
        'name' => 'is_subject',
        'type' => 'checkbox',
        'choices' => array (
          1 => 'Kategori är ämne',
        ),
        'default_value' => '',
        'layout' => 'vertical',
      ),
    ),
    'location' => array (
      array (
        array (
          'param' => 'ef_taxonomy',
          'operator' => '==',
          'value' => 'artikelkategorier',
          'order_no' => 0,
          'group_no' => 0,
        ),
      ),
      array (
        array (
          'param' => 'ef_taxonomy',
          'operator' => '==',
          'value' => 'category',
          'order_no' => 0,
          'group_no' => 1,
        ),
      ),
    ),
    'options' => array (
      'position' => 'normal',
      'layout' => 'no_box',
      'hide_on_screen' => array (
      ),
    ),
    'menu_order' => 0,
  ));
}
