<?php
/**
 * @file
 * course_feature.features.conditional_fields.inc
 */

/**
 * Implements hook_conditional_fields_default_fields().
 */
function course_feature_conditional_fields_default_fields() {
  $items = array();

  $items["node:course"] = array(
    array(
      'entity' => 'node',
      'bundle' => 'course',
      'dependent' => 'field_c_booking_schedules',
      'dependee' => 'field_c_course_type',
      'options' => array(
        'state' => 'visible',
        'condition' => 'value',
        'grouping' => 'AND',
        'effect' => 'show',
        'effect_options' => array(),
        'element_view' => array(
          1 => 1,
          2 => 2,
          5 => 0,
          3 => 0,
          4 => 0,
        ),
        'element_view_per_role' => 0,
        'element_view_roles' => array(
          1 => array(
            1 => 1,
            2 => 2,
            5 => 0,
            3 => 0,
            4 => 0,
          ),
          2 => array(
            1 => 1,
            2 => 2,
            5 => 0,
            3 => 0,
            4 => 0,
          ),
          3 => array(
            1 => 1,
            2 => 2,
            5 => 0,
            3 => 0,
            4 => 0,
          ),
        ),
        'element_edit' => array(
          1 => 1,
          3 => 3,
        ),
        'element_edit_per_role' => 0,
        'element_edit_roles' => array(
          1 => array(
            1 => 1,
            3 => 0,
          ),
          2 => array(
            1 => 1,
            3 => 0,
          ),
          3 => array(
            1 => 1,
            3 => 0,
          ),
        ),
        'selector' => '',
        'values_set' => 1,
        'value_form' => 9,
        'value' => array(
          0 => array(
            'tid' => 9,
          ),
        ),
        'values' => array(),
      ),
    ),
    array(
      'entity' => 'node',
      'bundle' => 'course',
      'dependent' => 'field_c_enquire',
      'dependee' => 'field_c_course_type',
      'options' => array(
        'state' => 'visible',
        'condition' => 'value',
        'grouping' => 'AND',
        'effect' => 'show',
        'effect_options' => array(),
        'element_view' => array(
          1 => 1,
          2 => 2,
          5 => 0,
          3 => 0,
          4 => 0,
        ),
        'element_view_per_role' => 0,
        'element_view_roles' => array(
          1 => array(
            1 => 1,
            2 => 2,
            5 => 0,
            3 => 0,
            4 => 0,
          ),
          2 => array(
            1 => 1,
            2 => 2,
            5 => 0,
            3 => 0,
            4 => 0,
          ),
          3 => array(
            1 => 1,
            2 => 2,
            5 => 0,
            3 => 0,
            4 => 0,
          ),
        ),
        'element_edit' => array(
          1 => 1,
          3 => 3,
        ),
        'element_edit_per_role' => 0,
        'element_edit_roles' => array(
          1 => array(
            1 => 1,
            3 => 0,
          ),
          2 => array(
            1 => 1,
            3 => 0,
          ),
          3 => array(
            1 => 1,
            3 => 0,
          ),
        ),
        'selector' => '',
        'values_set' => 1,
        'value_form' => 8,
        'value' => array(
          0 => array(
            'tid' => 8,
          ),
        ),
        'values' => array(),
      ),
    ),
    array(
      'entity' => 'node',
      'bundle' => 'course',
      'dependent' => 'field_c_full_time_duration',
      'dependee' => 'field_c_course_type',
      'options' => array(
        'state' => 'visible',
        'condition' => 'value',
        'grouping' => 'AND',
        'effect' => 'show',
        'effect_options' => array(),
        'element_view' => array(
          1 => 1,
          2 => 2,
          5 => 0,
          3 => 0,
          4 => 0,
        ),
        'element_view_per_role' => 0,
        'element_view_roles' => array(
          1 => array(
            1 => 1,
            2 => 2,
            5 => 0,
            3 => 0,
            4 => 0,
          ),
          2 => array(
            1 => 1,
            2 => 2,
            5 => 0,
            3 => 0,
            4 => 0,
          ),
          3 => array(
            1 => 1,
            2 => 2,
            5 => 0,
            3 => 0,
            4 => 0,
          ),
        ),
        'element_edit' => array(
          1 => 1,
          3 => 3,
        ),
        'element_edit_per_role' => 0,
        'element_edit_roles' => array(
          1 => array(
            1 => 1,
            3 => 0,
          ),
          2 => array(
            1 => 1,
            3 => 0,
          ),
          3 => array(
            1 => 1,
            3 => 0,
          ),
        ),
        'selector' => '',
        'values_set' => 5,
        'value_form' => '_none',
        'values' => array(
          0 => 10,
          1 => '_none',
        ),
        'value' => array(),
      ),
    ),
    array(
      'entity' => 'node',
      'bundle' => 'course',
      'dependent' => 'field_c_graduates',
      'dependee' => 'field_c_course_type',
      'options' => array(
        'state' => 'visible',
        'condition' => 'value',
        'grouping' => 'AND',
        'effect' => 'show',
        'effect_options' => array(),
        'element_view' => array(
          1 => 1,
          2 => 2,
          5 => 0,
          3 => 0,
          4 => 0,
        ),
        'element_view_per_role' => 0,
        'element_view_roles' => array(
          1 => array(
            1 => 1,
            2 => 2,
            5 => 0,
            3 => 0,
            4 => 0,
          ),
          2 => array(
            1 => 1,
            2 => 2,
            5 => 0,
            3 => 0,
            4 => 0,
          ),
          3 => array(
            1 => 1,
            2 => 2,
            5 => 0,
            3 => 0,
            4 => 0,
          ),
        ),
        'element_edit' => array(
          1 => 1,
          3 => 3,
        ),
        'element_edit_per_role' => 0,
        'element_edit_roles' => array(
          1 => array(
            1 => 1,
            3 => 0,
          ),
          2 => array(
            1 => 1,
            3 => 0,
          ),
          3 => array(
            1 => 1,
            3 => 0,
          ),
        ),
        'selector' => '',
        'values_set' => 1,
        'value_form' => 8,
        'value' => array(
          0 => array(
            'tid' => 8,
          ),
        ),
        'values' => array(),
      ),
    ),
    array(
      'entity' => 'node',
      'bundle' => 'course',
      'dependent' => 'field_c_installment_info',
      'dependee' => 'field_c_course_type',
      'options' => array(
        'state' => 'visible',
        'condition' => 'value',
        'grouping' => 'AND',
        'effect' => 'show',
        'effect_options' => array(),
        'element_view' => array(
          1 => 1,
          2 => 2,
          5 => 0,
          3 => 0,
          4 => 0,
        ),
        'element_view_per_role' => 0,
        'element_view_roles' => array(
          1 => array(
            1 => 1,
            2 => 2,
            5 => 0,
            3 => 0,
            4 => 0,
          ),
          2 => array(
            1 => 1,
            2 => 2,
            5 => 0,
            3 => 0,
            4 => 0,
          ),
          3 => array(
            1 => 1,
            2 => 2,
            5 => 0,
            3 => 0,
            4 => 0,
          ),
        ),
        'element_edit' => array(
          1 => 1,
          3 => 3,
        ),
        'element_edit_per_role' => 0,
        'element_edit_roles' => array(
          1 => array(
            1 => 1,
            3 => 0,
          ),
          2 => array(
            1 => 1,
            3 => 0,
          ),
          3 => array(
            1 => 1,
            3 => 0,
          ),
        ),
        'selector' => '',
        'values_set' => 1,
        'value_form' => 8,
        'value' => array(
          0 => array(
            'tid' => 8,
          ),
        ),
        'values' => array(),
      ),
    ),
    array(
      'entity' => 'node',
      'bundle' => 'course',
      'dependent' => 'field_c_online_duration',
      'dependee' => 'field_c_course_type',
      'options' => array(
        'state' => 'visible',
        'condition' => 'value',
        'grouping' => 'AND',
        'effect' => 'show',
        'effect_options' => array(),
        'element_view' => array(
          1 => 1,
          2 => 2,
          5 => 0,
          3 => 0,
          4 => 0,
        ),
        'element_view_per_role' => 0,
        'element_view_roles' => array(
          1 => array(
            1 => 1,
            2 => 2,
            5 => 0,
            3 => 0,
            4 => 0,
          ),
          2 => array(
            1 => 1,
            2 => 2,
            5 => 0,
            3 => 0,
            4 => 0,
          ),
          3 => array(
            1 => 1,
            2 => 2,
            5 => 0,
            3 => 0,
            4 => 0,
          ),
        ),
        'element_edit' => array(
          1 => 1,
          3 => 3,
        ),
        'element_edit_per_role' => 0,
        'element_edit_roles' => array(
          1 => array(
            1 => 1,
            3 => 0,
          ),
          2 => array(
            1 => 1,
            3 => 0,
          ),
          3 => array(
            1 => 1,
            3 => 0,
          ),
        ),
        'selector' => '',
        'values_set' => 1,
        'value_form' => 8,
        'value' => array(
          0 => array(
            'tid' => 8,
          ),
        ),
        'values' => array(),
      ),
    ),
    array(
      'entity' => 'node',
      'bundle' => 'course',
      'dependent' => 'field_c_part_time_duration',
      'dependee' => 'field_c_course_type',
      'options' => array(
        'state' => 'visible',
        'condition' => 'value',
        'grouping' => 'AND',
        'effect' => 'show',
        'effect_options' => array(),
        'element_view' => array(
          1 => 1,
          2 => 2,
          5 => 0,
          3 => 0,
          4 => 0,
        ),
        'element_view_per_role' => 0,
        'element_view_roles' => array(
          1 => array(
            1 => 1,
            2 => 2,
            5 => 0,
            3 => 0,
            4 => 0,
          ),
          2 => array(
            1 => 1,
            2 => 2,
            5 => 0,
            3 => 0,
            4 => 0,
          ),
          3 => array(
            1 => 1,
            2 => 2,
            5 => 0,
            3 => 0,
            4 => 0,
          ),
        ),
        'element_edit' => array(
          1 => 1,
          3 => 3,
        ),
        'element_edit_per_role' => 0,
        'element_edit_roles' => array(
          1 => array(
            1 => 1,
            3 => 0,
          ),
          2 => array(
            1 => 1,
            3 => 0,
          ),
          3 => array(
            1 => 1,
            3 => 0,
          ),
        ),
        'selector' => '',
        'values_set' => 5,
        'value_form' => '_none',
        'values' => array(
          0 => 10,
          1 => '_none',
        ),
        'value' => array(),
      ),
    ),
    array(
      'entity' => 'node',
      'bundle' => 'course',
      'dependent' => 'field_c_pending',
      'dependee' => 'field_c_course_type',
      'options' => array(
        'state' => 'visible',
        'condition' => 'value',
        'grouping' => 'AND',
        'effect' => 'show',
        'effect_options' => array(),
        'element_view' => array(
          1 => 1,
          2 => 2,
          5 => 0,
          3 => 0,
          4 => 0,
        ),
        'element_view_per_role' => 0,
        'element_view_roles' => array(
          1 => array(
            1 => 1,
            2 => 2,
            5 => 0,
            3 => 0,
            4 => 0,
          ),
          2 => array(
            1 => 1,
            2 => 2,
            5 => 0,
            3 => 0,
            4 => 0,
          ),
          3 => array(
            1 => 1,
            2 => 2,
            5 => 0,
            3 => 0,
            4 => 0,
          ),
        ),
        'element_edit' => array(
          1 => 1,
          3 => 3,
        ),
        'element_edit_per_role' => 0,
        'element_edit_roles' => array(
          1 => array(
            1 => 1,
            3 => 0,
          ),
          2 => array(
            1 => 1,
            3 => 0,
          ),
          3 => array(
            1 => 1,
            3 => 0,
          ),
        ),
        'selector' => '',
        'values_set' => 5,
        'value_form' => '_none',
        'values' => array(
          0 => 10,
          1 => '_none',
        ),
        'value' => array(),
      ),
    ),
    array(
      'entity' => 'node',
      'bundle' => 'course',
      'dependent' => 'field_c_progression_desk_image',
      'dependee' => 'field_c_course_type',
      'options' => array(
        'state' => 'visible',
        'condition' => 'value',
        'grouping' => 'AND',
        'effect' => 'show',
        'effect_options' => array(),
        'element_view' => array(
          1 => 1,
          2 => 2,
          5 => 0,
          3 => 0,
          4 => 0,
        ),
        'element_view_per_role' => 0,
        'element_view_roles' => array(
          1 => array(
            1 => 1,
            2 => 2,
            5 => 0,
            3 => 0,
            4 => 0,
          ),
          2 => array(
            1 => 1,
            2 => 2,
            5 => 0,
            3 => 0,
            4 => 0,
          ),
          3 => array(
            1 => 1,
            2 => 2,
            5 => 0,
            3 => 0,
            4 => 0,
          ),
        ),
        'element_edit' => array(
          1 => 1,
          3 => 3,
        ),
        'element_edit_per_role' => 0,
        'element_edit_roles' => array(
          1 => array(
            1 => 1,
            3 => 0,
          ),
          2 => array(
            1 => 1,
            3 => 0,
          ),
          3 => array(
            1 => 1,
            3 => 0,
          ),
        ),
        'selector' => '',
        'values_set' => 1,
        'value_form' => 8,
        'value' => array(
          0 => array(
            'tid' => 8,
          ),
        ),
        'values' => array(),
      ),
    ),
    array(
      'entity' => 'node',
      'bundle' => 'course',
      'dependent' => 'field_c_progression_mobile_image',
      'dependee' => 'field_c_course_type',
      'options' => array(
        'state' => 'visible',
        'condition' => 'value',
        'grouping' => 'AND',
        'effect' => 'show',
        'effect_options' => array(),
        'element_view' => array(
          1 => 1,
          2 => 2,
          5 => 0,
          3 => 0,
          4 => 0,
        ),
        'element_view_per_role' => 0,
        'element_view_roles' => array(
          1 => array(
            1 => 1,
            2 => 2,
            5 => 0,
            3 => 0,
            4 => 0,
          ),
          2 => array(
            1 => 1,
            2 => 2,
            5 => 0,
            3 => 0,
            4 => 0,
          ),
          3 => array(
            1 => 1,
            2 => 2,
            5 => 0,
            3 => 0,
            4 => 0,
          ),
        ),
        'element_edit' => array(
          1 => 1,
          3 => 3,
        ),
        'element_edit_per_role' => 0,
        'element_edit_roles' => array(
          1 => array(
            1 => 1,
            3 => 0,
          ),
          2 => array(
            1 => 1,
            3 => 0,
          ),
          3 => array(
            1 => 1,
            3 => 0,
          ),
        ),
        'selector' => '',
        'values_set' => 1,
        'value_form' => 8,
        'value' => array(
          0 => array(
            'tid' => 8,
          ),
        ),
        'values' => array(),
      ),
    ),
    array(
      'entity' => 'node',
      'bundle' => 'course',
      'dependent' => 'field_c_requirements',
      'dependee' => 'field_c_course_type',
      'options' => array(
        'state' => 'visible',
        'condition' => 'value',
        'grouping' => 'AND',
        'effect' => 'show',
        'effect_options' => array(),
        'element_view' => array(
          1 => 1,
          2 => 2,
          5 => 0,
          3 => 0,
          4 => 0,
        ),
        'element_view_per_role' => 0,
        'element_view_roles' => array(
          1 => array(
            1 => 1,
            2 => 2,
            5 => 0,
            3 => 0,
            4 => 0,
          ),
          2 => array(
            1 => 1,
            2 => 2,
            5 => 0,
            3 => 0,
            4 => 0,
          ),
          3 => array(
            1 => 1,
            2 => 2,
            5 => 0,
            3 => 0,
            4 => 0,
          ),
        ),
        'element_edit' => array(
          1 => 1,
          3 => 3,
        ),
        'element_edit_per_role' => 0,
        'element_edit_roles' => array(
          1 => array(
            1 => 1,
            3 => 0,
          ),
          2 => array(
            1 => 1,
            3 => 0,
          ),
          3 => array(
            1 => 1,
            3 => 0,
          ),
        ),
        'selector' => '',
        'values_set' => 1,
        'value_form' => 8,
        'value' => array(
          0 => array(
            'tid' => 8,
          ),
        ),
        'values' => array(),
      ),
    ),
    array(
      'entity' => 'node',
      'bundle' => 'course',
      'dependent' => 'field_c_staffs',
      'dependee' => 'field_c_course_type',
      'options' => array(
        'state' => 'visible',
        'condition' => 'value',
        'grouping' => 'AND',
        'effect' => 'show',
        'effect_options' => array(),
        'element_view' => array(
          1 => 1,
          2 => 2,
          5 => 0,
          3 => 0,
          4 => 0,
        ),
        'element_view_per_role' => 0,
        'element_view_roles' => array(
          1 => array(
            1 => 1,
            2 => 2,
            5 => 0,
            3 => 0,
            4 => 0,
          ),
          2 => array(
            1 => 1,
            2 => 2,
            5 => 0,
            3 => 0,
            4 => 0,
          ),
          3 => array(
            1 => 1,
            2 => 2,
            5 => 0,
            3 => 0,
            4 => 0,
          ),
        ),
        'element_edit' => array(
          1 => 1,
          3 => 3,
        ),
        'element_edit_per_role' => 0,
        'element_edit_roles' => array(
          1 => array(
            1 => 1,
            3 => 0,
          ),
          2 => array(
            1 => 1,
            3 => 0,
          ),
          3 => array(
            1 => 1,
            3 => 0,
          ),
        ),
        'selector' => '',
        'values_set' => 5,
        'value_form' => '_none',
        'values' => array(
          0 => 10,
          1 => '_none',
        ),
        'value' => array(),
      ),
    ),
    array(
      'entity' => 'node',
      'bundle' => 'course',
      'dependent' => 'field_c_student_feedback',
      'dependee' => 'field_c_course_type',
      'options' => array(
        'state' => 'visible',
        'condition' => 'value',
        'grouping' => 'AND',
        'effect' => 'show',
        'effect_options' => array(),
        'element_view' => array(
          1 => 1,
          2 => 2,
          5 => 0,
          3 => 0,
          4 => 0,
        ),
        'element_view_per_role' => 0,
        'element_view_roles' => array(
          1 => array(
            1 => 1,
            2 => 2,
            5 => 0,
            3 => 0,
            4 => 0,
          ),
          2 => array(
            1 => 1,
            2 => 2,
            5 => 0,
            3 => 0,
            4 => 0,
          ),
          3 => array(
            1 => 1,
            2 => 2,
            5 => 0,
            3 => 0,
            4 => 0,
          ),
        ),
        'element_edit' => array(
          1 => 1,
          3 => 3,
        ),
        'element_edit_per_role' => 0,
        'element_edit_roles' => array(
          1 => array(
            1 => 1,
            3 => 0,
          ),
          2 => array(
            1 => 1,
            3 => 0,
          ),
          3 => array(
            1 => 1,
            3 => 0,
          ),
        ),
        'selector' => '',
        'values_set' => 5,
        'value_form' => '_none',
        'values' => array(
          0 => 10,
          1 => '_none',
        ),
        'value' => array(),
      ),
    ),
    array(
      'entity' => 'node',
      'bundle' => 'course',
      'dependent' => 'field_c_student_works',
      'dependee' => 'field_c_course_type',
      'options' => array(
        'state' => 'visible',
        'condition' => 'value',
        'grouping' => 'AND',
        'effect' => 'show',
        'effect_options' => array(),
        'element_view' => array(
          1 => 1,
          2 => 2,
          5 => 0,
          3 => 0,
          4 => 0,
        ),
        'element_view_per_role' => 0,
        'element_view_roles' => array(
          1 => array(
            1 => 1,
            2 => 2,
            5 => 0,
            3 => 0,
            4 => 0,
          ),
          2 => array(
            1 => 1,
            2 => 2,
            5 => 0,
            3 => 0,
            4 => 0,
          ),
          3 => array(
            1 => 1,
            2 => 2,
            5 => 0,
            3 => 0,
            4 => 0,
          ),
        ),
        'element_edit' => array(
          1 => 1,
          3 => 3,
        ),
        'element_edit_per_role' => 0,
        'element_edit_roles' => array(
          1 => array(
            1 => 1,
            3 => 0,
          ),
          2 => array(
            1 => 1,
            3 => 0,
          ),
          3 => array(
            1 => 1,
            3 => 0,
          ),
        ),
        'selector' => '',
        'values_set' => 1,
        'value_form' => 8,
        'value' => array(
          0 => array(
            'tid' => 8,
          ),
        ),
        'values' => array(),
      ),
    ),
    array(
      'entity' => 'node',
      'bundle' => 'course',
      'dependent' => 'field_c_suitability',
      'dependee' => 'field_c_course_type',
      'options' => array(
        'state' => 'visible',
        'condition' => 'value',
        'grouping' => 'AND',
        'effect' => 'show',
        'effect_options' => array(),
        'element_view' => array(
          1 => 1,
          2 => 2,
          5 => 0,
          3 => 0,
          4 => 0,
        ),
        'element_view_per_role' => 0,
        'element_view_roles' => array(
          1 => array(
            1 => 1,
            2 => 2,
            5 => 0,
            3 => 0,
            4 => 0,
          ),
          2 => array(
            1 => 1,
            2 => 2,
            5 => 0,
            3 => 0,
            4 => 0,
          ),
          3 => array(
            1 => 1,
            2 => 2,
            5 => 0,
            3 => 0,
            4 => 0,
          ),
        ),
        'element_edit' => array(
          1 => 1,
          3 => 3,
        ),
        'element_edit_per_role' => 0,
        'element_edit_roles' => array(
          1 => array(
            1 => 1,
            3 => 0,
          ),
          2 => array(
            1 => 1,
            3 => 0,
          ),
          3 => array(
            1 => 1,
            3 => 0,
          ),
        ),
        'selector' => '',
        'values_set' => 1,
        'value_form' => 9,
        'value' => array(
          0 => array(
            'tid' => 9,
          ),
        ),
        'values' => array(),
      ),
    ),
    array(
      'entity' => 'node',
      'bundle' => 'course',
      'dependent' => 'field_c_syllabus',
      'dependee' => 'field_c_course_type',
      'options' => array(
        'state' => 'visible',
        'condition' => 'value',
        'grouping' => 'AND',
        'effect' => 'show',
        'effect_options' => array(),
        'element_view' => array(
          1 => 1,
          2 => 2,
          5 => 0,
          3 => 0,
          4 => 0,
        ),
        'element_view_per_role' => 0,
        'element_view_roles' => array(
          1 => array(
            1 => 1,
            2 => 2,
            5 => 0,
            3 => 0,
            4 => 0,
          ),
          2 => array(
            1 => 1,
            2 => 2,
            5 => 0,
            3 => 0,
            4 => 0,
          ),
          3 => array(
            1 => 1,
            2 => 2,
            5 => 0,
            3 => 0,
            4 => 0,
          ),
        ),
        'element_edit' => array(
          1 => 1,
          3 => 3,
        ),
        'element_edit_per_role' => 0,
        'element_edit_roles' => array(
          1 => array(
            1 => 1,
            3 => 0,
          ),
          2 => array(
            1 => 1,
            3 => 0,
          ),
          3 => array(
            1 => 1,
            3 => 0,
          ),
        ),
        'selector' => '',
        'values_set' => 1,
        'value_form' => 8,
        'value' => array(
          0 => array(
            'tid' => 8,
          ),
        ),
        'values' => array(),
      ),
    ),
    array(
      'entity' => 'node',
      'bundle' => 'course',
      'dependent' => 'field_c_tuition_early_bird_fee',
      'dependee' => 'field_c_course_type',
      'options' => array(
        'state' => 'visible',
        'condition' => 'value',
        'grouping' => 'AND',
        'effect' => 'show',
        'effect_options' => array(),
        'element_view' => array(
          1 => 1,
          2 => 2,
          5 => 0,
          3 => 0,
          4 => 0,
        ),
        'element_view_per_role' => 0,
        'element_view_roles' => array(
          1 => array(
            1 => 1,
            2 => 2,
            5 => 0,
            3 => 0,
            4 => 0,
          ),
          2 => array(
            1 => 1,
            2 => 2,
            5 => 0,
            3 => 0,
            4 => 0,
          ),
          3 => array(
            1 => 1,
            2 => 2,
            5 => 0,
            3 => 0,
            4 => 0,
          ),
        ),
        'element_edit' => array(
          1 => 1,
          3 => 3,
        ),
        'element_edit_per_role' => 0,
        'element_edit_roles' => array(
          1 => array(
            1 => 1,
            3 => 0,
          ),
          2 => array(
            1 => 1,
            3 => 0,
          ),
          3 => array(
            1 => 1,
            3 => 0,
          ),
        ),
        'selector' => '',
        'values_set' => 1,
        'value_form' => 8,
        'value' => array(
          0 => array(
            'tid' => 8,
          ),
        ),
        'values' => array(),
      ),
    ),
    array(
      'entity' => 'node',
      'bundle' => 'course',
      'dependent' => 'field_c_tuition_total_fee',
      'dependee' => 'field_c_course_type',
      'options' => array(
        'state' => 'visible',
        'condition' => 'value',
        'grouping' => 'AND',
        'effect' => 'show',
        'effect_options' => array(),
        'element_view' => array(
          1 => 1,
          2 => 2,
          5 => 0,
          3 => 0,
          4 => 0,
        ),
        'element_view_per_role' => 0,
        'element_view_roles' => array(
          1 => array(
            1 => 1,
            2 => 2,
            5 => 0,
            3 => 0,
            4 => 0,
          ),
          2 => array(
            1 => 1,
            2 => 2,
            5 => 0,
            3 => 0,
            4 => 0,
          ),
          3 => array(
            1 => 1,
            2 => 2,
            5 => 0,
            3 => 0,
            4 => 0,
          ),
        ),
        'element_edit' => array(
          1 => 1,
          3 => 3,
        ),
        'element_edit_per_role' => 0,
        'element_edit_roles' => array(
          1 => array(
            1 => 1,
            3 => 0,
          ),
          2 => array(
            1 => 1,
            3 => 0,
          ),
          3 => array(
            1 => 1,
            3 => 0,
          ),
        ),
        'selector' => '',
        'values_set' => 5,
        'value_form' => '_none',
        'values' => array(
          0 => 10,
          1 => '_none',
        ),
        'value' => array(),
      ),
    ),
  );

  return $items;
}
