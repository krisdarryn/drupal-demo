<?php
/**
 * Reusable functions
 */
 
function user_has_access(array $roles) {
   global $user;
   $user = user_load($user->uid);
   
   if($user->uid != 0) {
      foreach($roles as $role) {
         if(in_array($role, $user->roles)) {
            return TRUE;
         }
      }
   } 
   return FALSE;
}

/**
 * Checks and returns object's field value
 * params: $obj (obj), $field (str)
 */
function get_obj_field_value($obj, $field) {
   if (isset($obj->{$field}['und'])) {
      return $obj->{$field}['und'][0]['value'];
   }
   
   return '';
}

/**
 * Checks and returns the url of object's field which is an image type
 * params: $obj (obj), $field (str)
 */
function get_obj_field_img_url($obj, $field) {
   if (isset($obj->{$field}['und']) && $obj->{$field}['und'][0]['uri']) {
      return file_create_url($obj->{$field}['und'][0]['uri']);
   }
   
   return '';
}

/**
 * Checks and returns the data of object's field which is an image type
 * Creates image url
 * params: $obj (obj), $field (str)
 */
function get_obj_field_img_info($obj, $field) {
   if (isset($obj->{$field}['und'])) {
      $imageInfo = $obj->{$field}['und'][0];
      $imageInfo['url'] = file_create_url($imageInfo['uri']);
      return $imageInfo;
   } else {
      return array(
         'fid' => '', 
         'uid' => 0, 
         'filename' => '', 
         'uri' => '',
         'filemime' => '', 
         'filesize' => 0, 
         'status' => 0, 
         'alt' => '', 
         'title' => '', 
         'width' => 0, 
         'height' => 0, 
         'url' => '',
      );
   }
}

/**
 * Checks and returns the data of object's field which is a file type
 * Creates file url
 * params: $obj (obj), $field (str)
 */
function get_obj_field_file_info($obj, $field) {
   if (isset($obj->{$field}['und'])) {
      $fileInfo = $obj->{$field}['und'][0];
      $fileInfo['url'] = file_create_url($fileInfo['uri']);
      return $fileInfo;
   } else {
      return array(
         'fid' => '', 
         'uid' => 0, 
         'filename' => '', 
         'uri' => '',
         'filemime' => '', 
         'filesize' => 0, 
         'status' => 0, 
         'url' => '',
      );
   }
}

/**
* Checks object's date field value
* Returns formatted date
* params: $obj (obj), $field (str)
 */
function format_obj_field_date_value($obj, $field, $format) {
   if (isset($obj->{$field}['und']) && $obj->{$field}['und'][0]['value'] != '') {
      
      if (!date_default_timezone_set(drupal_get_user_timezone())) {
         drupal_set_message('Invalid timezone in format_obj_field_date_value()', 'warning');
      }
      
      return date($format, strtotime($obj->{$field}['und'][0]['value']));
   }
   
   return '';
}

/**
* Checks object's date field value
* Returns formatted date
* params: $obj (obj), $field (str)
 */
function get_obj_field_date_formatted($obj, $field, $format) {
   $format = 'd/m/Y';
   if (isset($obj->{$field}['und']) && $obj->{$field}['und'][0]['value'] != '') {
      
      if (!date_default_timezone_set(drupal_get_user_timezone())) {
         drupal_set_message('Invalid timezone in get_obj_field_date_formatted()', 'warning');
      }
      
      return date($format, strtotime($obj->{$field}['und'][0]['value']));
   }
   
   return '';
}

/**
* Checks object's date field value
* Returns formatted time (hour:min a)
* params: $obj (obj), $field (str)
 */
function get_obj_field_time_format_gia($obj, $field) {
   $format = 'g:i a'; // 12-hour format of an hour (1 to 12) Ex. 7:10 am
   if (isset($obj->{$field}['und']) && $obj->{$field}['und'][0]['value'] != '') {
      
      if (!date_default_timezone_set(drupal_get_user_timezone())) {
         drupal_set_message('Invalid timezone in get_obj_field_time_format_gia()', 'warning');
      }
      
      return date($format, strtotime($obj->{$field}['und'][0]['value']));
   }
   
   return '';
}

/**
 * Returns staff list page information
 */
function get_staff_page_info() {   
   return get_page_info('page_staff_list');
}

/**
 * Returns graduate list page information
 */
function get_graduate_page_info() {
   return get_page_info('page_graduate_list');
}

/**
 * Returns event page information
 */
function get_event_page_info() {
   return get_page_info('page_event');
}

/**
 * Returns page information
 * param: $contentType (str)
 */
function get_page_info($contentType) {
   $query = db_select('node', 'n');
   $query->fields('n', array('nid'));
   $query->condition('n.type', $contentType, '=');
   $query->orderBy('n.nid', 'ASC');
   $query->range(0,1);
   $result = $query->execute()->fetchAssoc();

   if ($result) {
      return node_load($result['nid']);
   }

   return array();
}

/**
* Returns field collection field value
* params: $groupId (int), $field (str)
*/
function get_field_collection_field_value($groupId, $field) {
   $fieldTable = 'field_data_'.$field;
   $fieldName = $field.'_value';
   
   $query = db_select($fieldTable, 'd')
      ->fields('d', array($fieldName))
      ->condition('d.entity_id', $groupId, '=')
      ->execute();
   $result = $query->fetchObject();

   if($result) {
      return $result->{$fieldName};
   } else {
      return '';
   }
}

/**
* Returns total number of records by content type
* param: $contentType (str)
*/
function get_content_total_count_by_type($contentType) {
   $query = db_select('node', 'n');
   $query->fields('n', array('nid'));
   $query->condition('n.type', $contentType, '=');
   return $query->execute()->rowCount();
}

/**
* Fetches and returns specific list of job
* List is ordered by latest job
* params: $startIdx (int), $limit (int)
*/
function get_job_list($startIdx, $limit) {
   $list = array();
   
   // Get list of job
   $query = db_select('node', 'n');
   $query->join('field_data_field_job_posted_date', 'd', 'd.entity_id = n.nid');
   $query->fields('n', array('nid'));
   $query->condition('n.type', 'job', '=');
   $query->orderBy('d.field_job_posted_date_value', 'DESC');
   $query->range($startIdx, $limit);
   $result = $query->execute();
   
   while ($record = $result->fetchAssoc()) {
      $job = node_load($record['nid']);
      $imageInfo = get_obj_field_img_info($job, 'field_job_feature_image');
      $fileInfo = get_obj_field_img_info($job, 'field_job_description_file');
      
      $list[] = array(
         'nid' => $job->nid,
         'title' => $job->title,
         'featureImageUrl' => $imageInfo['url'],
         'featureImageAlt' => $imageInfo['alt'],
         'featureImageTitle' => $imageInfo['title'],
         'postDate' => format_obj_field_date_value($job, 'field_job_posted_date', 'j M Y'),
         'employer' => get_obj_field_value($job, 'field_job_employer'),
         'jobType' => get_obj_field_value($job, 'field_job_type'),
         'location' => get_obj_field_value($job, 'field_job_location'),
         'careerLevel' => get_obj_field_value($job, 'field_job_career_level'),
         'salary' => get_obj_field_value($job, 'field_job_salary'),
         'status' => get_obj_field_value($job, 'field_job_status'),
         'jobDescriptionFileUrl' => $fileInfo['url'],
      );
   }
   
   return $list;
}

/**
* Returns project list by category
* params: $categoryId (int), $limit (int)
*/
function get_project_list_by_category($categoryId, $startIdx, $limit) {
   $list = array();
   
   // Fetch student works by specified category
   $query = db_select('node', 'n');
   $query->fields('n', array('nid'));
   $query->join('field_data_field_sw_category', 'c', 'c.entity_id = n.nid');
   $query->join('field_data_field_sw_created_date', 'd', 'd.entity_id = n.nid');
   $query->condition('n.type', 'student_works', '=');
   $query->condition('c.field_sw_category_tid', $categoryId, '=');
   $query->orderBy('d.field_sw_created_date_value', 'DESC');
   $query->range($startIdx, $limit);
   $result = $query->execute();
   
   while ($record = $result->fetchAssoc()) {
      $studentWork = node_load($record['nid']);
      $imageInfo = get_obj_field_img_info($studentWork, 'field_sw_cover_image');
      $list[] = array(
         'nid' => $studentWork->nid,
         'projectName' => $studentWork->title,
         'projectLocation' => get_obj_field_value($studentWork, 'field_sw_project_location'),
         'categoryId' => $studentWork->field_sw_category['und'][0]['tid'],
         'courseId' => $studentWork->field_sw_course['und'][0]['target_id'],
         'dateCreated' => format_obj_field_date_value($studentWork, 'field_sw_created_date', 'F Y'),
         'coverImageUrl' => $imageInfo['url'],
         'coverImageAlt' => $imageInfo['alt'],
         'coverImageTitle' => $imageInfo['title'],
      );
   }
   
   return $list;
}

/**
* Returns single taxonomy term id
* params: $name (str), $vid (int)
*/
function get_taxonomy_term_id_by_name($name, $vid) {
   $query = db_select('taxonomy_term_data', 't');
   $query->fields('t', array('tid'));
   $query->condition('t.vid', $vid, '=');
   $query->condition('t.name', $name, '=');
   $query->range(0, 1);
   $result =  $query->execute()->fetchAll();
   
   if ($result) {
      return $result[0]->tid;
   }
   
   return 0;
}

/**
* Returns total number of student works by category
* param: $categoryId (int)
*/
function get_total_project_count_by_category($categoryId) {
   $query = db_select('node', 'n');
   $query->fields('n', array('nid'));
   $query->join('field_data_field_sw_category', 'c', 'c.entity_id = n.nid');
   $query->condition('n.type', 'student_works', '=');
   $query->condition('c.field_sw_category_tid', $categoryId, '=');
   return $query->execute()->rowCount();
}


/**
 * Prepare a simplifed staff data given the staff entitiy record
 * 
 * @param $staff stdClass 
 * @return array|boolean
 */
function prepare_staff_details($staff) {
   $staffArr = [];
   
   if (!$staff) {
      return false;
   }
   
   $staffArr['fullName'] = $staff->title;
   $staffArr['nid'] = $staff->nid;
   $staffArr['firstName'] = get_obj_field_value($staff, 'field_teacher_firstname');
   $staffArr['lastNames'] = get_obj_field_value($staff, 'field_teacher_lastname');
   $staffArr['longTitle'] = get_obj_field_value($staff, 'field_teacher_long_title');
   $staffArr['shortTitle'] = get_obj_field_value($staff, 'field_teacher_long_title');
   $staffArr['biography'] = get_obj_field_value($staff, 'field_teacher_biography');
   $staffArr['profileImage'] = get_obj_field_img_info($staff, 'field_teacher_profile_image');
   
   // Loop all qualifications
   $staffArr['qualifications'] = [];
   
   if (isset($staff->field_teacher_qualifications['und']) && $staff->field_teacher_qualifications['und']) {
      
      foreach ($staff->field_teacher_qualifications['und'] as $item) {
         
         if ($item['value']) {
            $staffArr['qualifications'][] = $item['value'];
         }
         
      }
      
   }
   
   // Loop all inspiration board
   $staffArr['inspirationBoard'] = [];
   
   if (isset($staff->field_teacher_inspiration_boards['und']) && $staff->field_teacher_inspiration_boards['und']) {
      
      foreach ($staff->field_teacher_inspiration_boards['und'] as $item) {
         $fc = entity_load('field_collection_item', array($item['value']));
         $fc = $fc[$item['value']];
         
         $staffArr['inspirationBoard'][] = [
            'title' => get_obj_field_value($fc, 'field_teacher_board_title'),
            'description' => get_obj_field_value($fc, 'field_teacher_board_description'),
            'image' => get_obj_field_img_info($fc, 'field_teacher_board_image'),
         ];
         
      }
      
   }
   
   return $staffArr;
}

/**
 * Prepare a simplifed student work data given the student_work entitiy record
 * 
 * @param $studentWork stdClass 
 * @return array|boolean
 */
function prepare_student_work_details($studentWork) {
   $studentWorkArr = [];
   
   if (!$studentWork) {
      return false;
   }
   
   $studentWorkArr['nid'] = $studentWork->nid;
   $studentWorkArr['name'] = $studentWork->title;
   
   $category = taxonomy_term_load($studentWork->field_sw_category['und'][0]['tid']);   
   $studentWorkArr['category'] = $category->name;
   
   $studentWorkArr['coverImage'] = get_obj_field_img_info($studentWork, 'field_sw_cover_image');
   
   return $studentWorkArr;
}

/**
 * Prepare a simplifed graduate data given the graduate entitiy record
 * 
 * @param $graduate stdClass 
 * @return array|boolean
 */
function prepare_graduate_details($graduate) {
   $graduateWorkArr = [];
   
   if (!$graduate) {
      return false;
   }
   
   $graduateWorkArr['nid'] = $graduate->nid;
   $graduateWorkArr['name'] = $graduate->title;
   $graduateWorkArr['coverImage'] = get_obj_field_img_info($graduate, 'field_graduate_cover_image');
   
   return $graduateWorkArr;
}

/**
* Returns month list 
* with month number as key and month name as value
*/
function get_month_names() {
   return array(
      '01' => 'January',
      '02' => 'February',
      '03' => 'March',
      '04' => 'April',
      '05' => 'May',
      '06' => 'June',
      '07' => 'July',
      '08' => 'August',
      '09' => 'September',
      '10' => 'October',
      '11' => 'November',
      '12' => 'December'
   );
}

/**
* Returns query result of latest upcoming courses
* params: $courseType (str), $limit (int), $courseTypeVid (int), $notIncludeNid (int)
*
* Reuse by custompage.groupa.inc and custompage.block.inc
*/
function query_upcoming_courses_by_type($courseType, $limit, $courseTypeVid, $notIncludeNid = NULL) {
   $shortCourseTypeTid =  get_taxonomy_term_id_by_name($courseType, $courseTypeVid);

   if ($shortCourseTypeTid > 0) {    
      $query = db_select('node', 'n');
      $query->join('field_data_field_c_course_type', 't', 't.entity_id = n.nid');
      $query->join('field_data_field_c_start_date', 'd', 'd.entity_id = n.nid');
      $query->fields('n', array('nid', 'title'));
      
      if ($notIncludeNid != NULL) {
         $query->condition('n.nid', $notIncludeNid, '<>');
      }
      
      $query->condition('n.type', 'course', '=');
      $query->condition('t.field_c_course_type_tid', $shortCourseTypeTid , '=');
      $query->orderBy('d.field_c_start_date_value', 'DESC');
      $query->range(0, $limit);
      return $query->execute();
   }
   
   return array();
}


function generateYTEmbedUrl($str) {
   $url = 'https://www.youtube.com/embed/';
   
   if (strpos($str, 'youtu.be') !== false) {
      $url .= ltrim($str, 'https://youtu.be/');
   } else if (strpos($str, 'youtube.com/watch?v') !== false) {
      $url .= substr($str, (strpos($str, '?v=') + 3));
   }
   
   return $url;
}

function remindPendingRegistration() {
   $query = db_select('node', 'registration');
   $query->leftJoin('field_data_field_registration_has_reminded', 'reminder', 'reminder.entity_id = registration.nid');
   $query->leftJoin('field_data_field_registration_date', 'rDate', 'rDate.entity_id = registration.nid');
   $query->leftJoin('field_data_field_registration_course', 'course', 'course.entity_id = registration.nid');
   $query->leftJoin('field_data_field_registration_status', 'stats', 'stats.entity_id = registration.nid');
   $query->addField('registration', 'nid');
   $query->addField('registration', 'title');
   $query->addField('reminder', 'field_registration_has_reminded_value');
   $query->addField('rDate', 'field_registration_date_value');
   $query->addField('course', 'field_registration_course_target_id');
   $query->addField('stats', 'field_registration_status_value');
   $query->condition('reminder.field_registration_has_reminded_value', '0', '=');
   $query->orderBy('registration.title, rDate.field_registration_date_value, course.field_registration_course_target_id', '');
   $result = $query->execute();
   $regRecords = $result->fetchAll();
   
   $lastTitle = null;
   $lastRegDate = null;
   $lastCourse = -1;
   $format = array();
   
   // Format result
   foreach ($regRecords as $record) {
      $simplifiedDate = date('Y-m-d', strtotime($record->field_registration_date_value));
      
      if ($lastTitle != $record->title) {
         $lastTitle = $record->title;
         
         if ($lastRegDate != $simplifiedDate) {
            $lastRegDate = $simplifiedDate;
            
            if ($lastCourse != $record->field_registration_course_target_id) {
               $lastCourse = $record->field_registration_course_target_id;
               $format[$lastTitle][$lastRegDate][$lastCourse][] = $record;
            } else {
               $lastCourse = $record->field_registration_course_target_id;
               $format[$lastTitle][$lastRegDate][$lastCourse][] = $record;
            }
            
         } else {
            
            if ($lastCourse != $record->field_registration_course_target_id) {
               $lastCourse = $record->field_registration_course_target_id;
               $format[$lastTitle][$lastRegDate][$lastCourse][] = $record;
            } else {
               $lastCourse = $record->field_registration_course_target_id;
               $format[$lastTitle][$lastRegDate][$lastCourse][] = $record;
            }
            
         }
         
         
      } else {
         
         if ($lastRegDate != $simplifiedDate) {
            $lastRegDate = $simplifiedDate;
            
            if ($lastCourse != $record->field_registration_course_target_id) {
               $lastCourse = $record->field_registration_course_target_id;
               $format[$lastTitle][$lastRegDate][$lastCourse][] = $record;
            } else {
               $lastCourse = $record->field_registration_course_target_id;
               $format[$lastTitle][$lastRegDate][$lastCourse][] = $record;
            }
            
         } else {
            
            if ($lastCourse != $record->field_registration_course_target_id) {
               $lastCourse = $record->field_registration_course_target_id;
               $format[$lastTitle][$lastRegDate][$lastCourse][] = $record;
            } else {
               $lastCourse = $record->field_registration_course_target_id;
               $format[$lastTitle][$lastRegDate][$lastCourse][] = $record;
            }
            
         }
      }
      
   }

   $hasPaid = false;
   $listToEmail = $toEmail = array();
   $statusList = array(
      'pending' => 0,
      'paypal' => 1,
      'bankTransfer' => 2,
   );
   
   // Prepare the list of registration record to be reminded
   foreach ($format as $name => $tuple) {
      
      foreach ($tuple as $date => $courseList) {
            
         foreach ($courseList as $courseId => $innerRecords) {
            $toEmail = array();
            $hasPaid = false;
            
            foreach ($innerRecords as $innerRecord) {
               
               if ($innerRecord->field_registration_status_value != $statusList['pending']) {
                  $hasPaid = true;
                  break;
               } else {
                  $toEmail[] = $innerRecord->nid;
               } 
              
            }
            
            if (!$hasPaid) {
               $listToEmail = array_merge($listToEmail, $toEmail);
            }
               
         }
         
      }
     
   }

   $nodeList = node_load_multiple($listToEmail);
   $emailTemplete = $users = null;
   $adminEmails = [];
   
   if (!empty($nodeList)) {
      $emailTemplete = node_load(260);
      $users = entity_load('user');
         
      // List all administrator emails
      foreach ($users as $user) {
         
         if (in_array('administrator', $user->roles)) {
            $adminEmails[] = $user->mail;
         }
         
      }
      
      foreach ($nodeList as $node) {
      
         if (
            isset($node->field_registration_email['und'][0]['value']) &&
            !empty($node->field_registration_email['und'][0]['value']) &&
            isset($node->field_registration_email_url['und'][0]['safe_value']) &&
            !empty($node->field_registration_email_url['und'][0]['safe_value'])
         ) {   
            
            $course = node_load($node->field_registration_course['und'][0]['target_id']);
            
            $a = drupal_mail('custom', 'pending-registration', implode(',', array_merge($adminEmails, [$node->field_registration_email['und'][0]['value']])), language_default(), [
               'urlLink' => $node->field_registration_email_url['und'][0]['safe_value'],
               'name' => $node->title,
               'email' => $node->field_registration_email['und'][0]['value'],
               'course' =>  ($course ? $course->title : ''),
               'contactNumber' => $node->field_registration_contact_no['und'][0]['safe_value'],
               'occupation' => $node->field_registration_occupation['und'][0]['safe_value'],
               'registrationDate' => date('j F Y - h:i A', strtotime($node->field_registration_date['und'][0]['value'])),
               'firstName' => $node->field_registration_first_name['und'][0]['value'],
               'lastName' => $node->field_registration_last_name['und'][0]['value'],
               'subject' => get_obj_field_value($emailTemplete, 'field_email_subject'),
            ]);
            
            $node->field_registration_has_reminded['und'][0]['value'] = 1;
            
            node_save($node);
         }
      }
      
   }
   
   watchdog('cron', 'Run Cronjob for sending emails to those Pending Registration.');
   
}

function deleteAllRegisterNewsLetterRecords() {
   $nodeId = [];
   $query = db_select('node', 'n');
   $query->fields('n', array('nid'));
   $query->condition('n.type', 'registrations', '=');
   $result = $query->execute();
   
   while ($record = $result->fetchAssoc()) {
      $nodeId[] = $record['nid'];
   }
   
   $query = db_select('node', 'n');
   $query->fields('n', array('nid'));
   $query->condition('n.type', 'newsletter_subscriptions', '=');
   $result = $query->execute();
   
   while ($record = $result->fetchAssoc()) {
      $nodeId[] = $record['nid'];
   }
   
   node_delete_multiple($nodeId);
}

function setCustomMetaTags($pageNode) {
   $meta = [];
   
   if (isset($pageNode->metatags['und']) && !empty($pageNode->metatags['und'])) {
      
      foreach ($pageNode->metatags['und'] as $name => $tags) {
         $content = '';
         
         if ($name != 'title') {
            
            if (is_array($tags['value'])) {
               $contents = [];
               
               foreach ($tags['value'] as $val) {
                  if ($val) {
                     $contents[] = $val;
                  }
               }
               
               $content = implode(', ', $contents);
            } else {
               
               if ($name == 'revisit-after') {
                  $content = $tags['value'] . ' ' . $tags['period'];
               } else {
                  $content = $tags['value'];
               }
               
            }
            
            if (in_array($name, ['refresh', 'pragma', 'cache-control', 'content-language'])) {
               $meta[] = [
                  'tag' => 'meta',
                  'attr1' => 'http-equiv',
                  'attr2' => 'content',
                  'attr1Val' => $name,
                  'attr2Val' => $content,
               ];
   
            } else if (in_array($name, ['image_src', 'canonical', 'shortlink', 'prev', 'next'])) {
               $meta[] = [
                  'tag' => 'link',
                  'attr1' => 'rel',
                  'attr2' => 'href',
                  'attr1Val' => $name,
                  'attr2Val' => $content,
               ];

            } else {
               $meta[] = [
                  'tag' => 'meta',
                  'attr1' => 'name',
                  'attr2' => 'content',
                  'attr1Val' => $name,
                  'attr2Val' => $content,
               ];

            }
            
         }
         
      }
      
   }
      
   return $meta;
}

function updateIntroShortCourseDuration() {
   // Fetch upcoming event records
   $query = db_select('node', 'n');
   $query->leftJoin('field_data_field_c_course_type', 'ctype', 'ctype.entity_id = n.nid');
   $query->leftJoin('field_data_field_c_is_introductory_course', 'cintro', 'cintro.entity_id = n.nid');
   $query->fields('n', array('nid'));
   $query->condition('n.type', 'course', '=');
   $query->condition('ctype.field_c_course_type_tid', '9', '=');
   $query->condition('cintro.field_c_is_introductory_course_value', '1', '=');
   $result = $query->execute();
   $result = $result->fetchAll();
   $nids = [];
   $currentTime = date('Y-m-d');
   
   
   foreach ($result as $record) {
      $nids[] = $record->nid;
   }
   
   if (empty($nids)) {
      return;
   }
   
   $shortCourses = node_load_multiple($nids);

   // Update short course duration and start date
   foreach ($shortCourses as $course) {
      $durationList = [];
      $hasRemoved = false;

      if (isset($course->field_c_duration_list['und']) && $course->field_c_duration_list['und']) {
      
         foreach ($course->field_c_duration_list['und'] as $index => $item) {
            $fc = entity_load('field_collection_item', array($item['value']));
            $fc = $fc[$item['value']];
            $fcStartDate = get_obj_field_value($fc, 'field_cdur_start_date');
            $fcEndDate = get_obj_field_value($fc, 'field_cdur_end_date');

            if ($currentTime > date('Y-m-d', strtotime($fcEndDate))) {
               $hasRemoved = true;
               unset($course->field_c_duration_list['und'][$index]);
            } else {
               $durationList[] = [
                  'grpid' => $item['value'],
                  'startDate' => $fcStartDate,
                  'endDate' => $fcEndDate,
               ];
            }
               
         }
         
      } 
      
      $updatedDurationListCtr = count($durationList);
      
      if ($hasRemoved && ($updatedDurationListCtr > 0)) {
         // Update start and end date
         
         if (isset($durationList[0]) && $durationList[0]) {
            $course->field_c_start_date['und'][0] = [
               'value' => $durationList[0]['startDate'],
               'timezone' => 'UTC',
               'timezone_db' => 'UTC',
               'date_type' => 'date',
            ]; 
         }
         
         if (isset($durationList[($updatedDurationListCtr - 1)]['endDate']) && $durationList[($updatedDurationListCtr - 1)]['endDate']) {
            $course->field_c_end_data['und'][0] = [
               'value' => $durationList[($updatedDurationListCtr - 1)]['endDate'],
               'timezone' => 'UTC',
               'timezone_db' => 'UTC',
               'date_type' => 'date',
            ];
         }
         
      } else if ($updatedDurationListCtr <= 0){
         // Remove start and end date if there are no more duration item
         $course->field_c_start_date = [];
         $course->field_c_end_data = [];
      }
      
      node_save($course);
   }
   
   watchdog('cron', 'Run Cronjob for Updating Introductory Short Courses');
}