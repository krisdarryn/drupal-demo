<?php
// Callback functions for block view

function _block_header() {
   $data = array();
   $data['courseList'] = get_course_overview_featured_courses();
   
   return array(
      'content' => theme('block-header', $data),
   );
}

function get_course_overview_featured_courses() {
   $list = array('longCourseList' => array());
   
   $pageNode = get_page_info('page_course_overview');
   if ($pageNode) {
      // Get indroductory course
      $course = node_load($pageNode->field_cp_introductory_course['und'][0]['target_id']);   
      $list['introductoryCourse'] = array(
         'nid' => $course->nid,
         'title' => $course->title,
      );
      
      // Get featured long courses
      if (isset($pageNode->field_cp_featured_long_courses['und'])  && $pageNode->field_cp_featured_long_courses['und']) {
         foreach ($pageNode->field_cp_featured_long_courses['und'] as $item) {
            $course = node_load($item['target_id']);
            $list['longCourseList'][] = array(
               'nid' => $course->nid,
               'title' => $course->title,
            );
         }
      }
   }
   
   return $list;
}

function _block_landing_header($params) {
   $params['courseList'] = get_course_overview_featured_courses();
   
   return array(
      'content' => theme('block-landing-header', $params),
   );
}

function _block_footer() {
   return array(
      'content' => theme('block-footer', array()),
   );
}

function _block_landing_footer() {
   return array(
      'content' => theme('block-landing-footer', array()),
   );
}

function _block_pagination($params) {
   return array(
      'content' => theme('block_pagination_template', $params),
   );
}

function _block_discover_secondary_menu($params) {
   return array(
      'content' => theme('block_discover_secondary_menu_template', $params),
   );
}

function _block_collaborate_secondary_menu($params) {
   return array(
      'content' => theme('block_collaborate_secondary_menu_template', $params),
   );
}

function _block_email_template($params) {
   return array(
      'content' => theme('block_email_template', $params),
   );
}

function _block_custom_messages($params) {
   return array(
      'content' => theme('block_custom_messages_template', $params),
   );
}
