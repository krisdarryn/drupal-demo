<?php
/**
 * AJAX functions
 */

/**
 * Fetch project information, and returns modal that will show on the page.
 */
function show_project_details() {
   // make sure it is an ajax call
   if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
     
      if (isset($_GET['nid']) && $_GET['nid'] != '') {
         // Get project details
         $project = node_load($_GET['nid']);
         $imageInfo = get_obj_field_img_info($project, 'field_sw_client_logo');

         $data = array(
            'nid' => $project->nid,
            'projectName' => $project->title,
            'projectLocation' => get_obj_field_value($project, 'field_sw_project_location'),
            'categoryId' => $project->field_sw_category['und'][0]['tid'],
            'courseId' => $project->field_sw_course['und'][0]['target_id'],
            'dateCreated' => get_obj_field_date_formatted($project, 'field_sw_created_date', 'F Y'),
            'duration' => get_obj_field_value($project, 'field_sw_project_duration'),
            'clientName' => get_obj_field_value($project, 'field_sw_client_name'),         
            'clientLogoUrl' => $imageInfo['url'],
            'clientLogoAlt' => $imageInfo['alt'],
            'clientLogoTitle' => $imageInfo['title'],
            'background' => get_obj_field_value($project, 'field_sw_background_description'), 
            'projectBriefs' => array(),
            'projectGalleries' => array(),
         );

         // Get project brief list
         if (isset($project->field_sw_project_briefs['und']) && $project->field_sw_project_briefs['und']) {
            foreach ($project->field_sw_project_briefs['und'] as $brief) {
               $data['projectBriefs'][] = $brief['value'];
            }
         }

         // Get project galleries
         if (isset($project->field_sw_work_gallery['und']) && $project->field_sw_work_gallery['und']) {
            foreach ($project->field_sw_work_gallery['und'] as $item) {
               $fc = entity_load('field_collection_item', array($item['value']));
               $fc = $fc[$item['value']];
               $imageInfo = get_obj_field_img_info($fc, 'field_sw_fc_image');

               $data['projectGalleries'][] = array(
                  'imageUrl' => $imageInfo['url'],
                  'imageAlt' => $imageInfo['alt'],
                  'imageTitle' => $imageInfo['title'],
                  'caption' => get_obj_field_value($fc, 'field_sw_fc_caption'), 
               );
            }
         }

         print theme('project_detail_template', $data);
      } else {
         print '';
      }      
   }
}

/**
 * Fetches and returns all teacher records
 */
function show_all_teachers() {
   // make sure it is an ajax call
   if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
      $list = array();
      
      // Fetch all teachers
      $query = db_select('node', 'n');
      $query->leftJoin('draggableviews_structure', 'dv', 'dv.entity_id = n.nid');
      $query->fields('n', array('nid'));
      $query->condition('n.type', 'teacher', '=');
      $query->condition('dv.view_name', 'teacher_list', '=');
      $query->orderBy('dv.weight', 'ASC');
      $result = $query->execute();

      while ($record = $result->fetchAssoc()) {
         $node = node_load($record['nid']);
         $imageInfo = get_obj_field_img_info($node, 'field_teacher_cover_image');

         $list[] = array(
            'nid' => $node->nid,
            'imageUrl' => $imageInfo['url'],
            'imageAlt' => $imageInfo['alt'],
            'imageTitle' => $imageInfo['title'],
            'firstName' => get_obj_field_value($node, 'field_teacher_firstname'),
            'lastName' => get_obj_field_value($node, 'field_teacher_lastname'),
            'longTitle' => get_obj_field_value($node, 'field_teacher_long_title'),
         );
      }
      
      print theme('block_staff_list', array('teacherList' => $list));
  }
}

/*
* Fetches and returns teacher information which will be displayed in modal
*/
function show_teacher_details() {
   // make sure it is an ajax call
   if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
      
      if (isset($_GET['nid']) && $_GET['nid'] != '') {
         // Get teacher's information
         $teacher = node_load($_GET['nid']);
         $imageInfo = get_obj_field_img_info($teacher, 'field_teacher_profile_image');         
         $data = array(
            'nid' => $teacher->nid,
            'imageUrl' => $imageInfo['url'],
            'imageAlt' => $imageInfo['alt'],
            'imageTitle' => $imageInfo['title'],
            'firstName' => get_obj_field_value($teacher, 'field_teacher_firstname'),
            'lastName' => get_obj_field_value($teacher, 'field_teacher_lastname'),
            'longTitle' => get_obj_field_value($teacher, 'field_teacher_long_title'),
            'shortTitle' => get_obj_field_value($teacher, 'field_teacher_short_title'),
            'biography' => get_obj_field_value($teacher, 'field_teacher_biography'),
            'qualifications' => array(),
            'inspirationBoards' => array(),
         );
         
         // Get teacher's qualifications list
         if (isset($teacher->field_teacher_qualifications['und']) && $teacher->field_teacher_qualifications['und']) {
            foreach ($teacher->field_teacher_qualifications['und'] as $item) {
               $data['qualifications'][] = $item['value'];
            }
         }
         
         // Get teacher's inspiration board list
         if (isset($teacher->field_teacher_inspiration_boards['und']) && $teacher->field_teacher_inspiration_boards['und']) {
            foreach ($teacher->field_teacher_inspiration_boards['und'] as $item) {
               $fc = entity_load('field_collection_item', array($item['value']));
               $fc = $fc[$item['value']];
               $imageInfo = get_obj_field_img_info($fc, 'field_teacher_board_image');
               
               $data['inspirationBoards'][] = array(
                  'title' => get_obj_field_value($fc, 'field_teacher_board_title'),
                  'description' => get_obj_field_value($fc, 'field_teacher_board_description'),
                  'imageUrl' => $imageInfo['url'],
                  'imageAlt' => $imageInfo['alt'],
                  'imageTitle' => $imageInfo['title'],
               );
            }
         }
         
         // Get teacher's courses         
         if (isset($teacher->field_teacher_courses['und']) && $teacher->field_teacher_courses['und']) {
            foreach ($teacher->field_teacher_courses['und'] as $item) {
               $fc = entity_load('field_collection_item', array($item['value']));
               $fc = $fc[$item['value']];
               
               if (isset($fc->field_tc_course_name['und']) && $fc->field_tc_course_name['und']) {
                  $list = array();
                  
                  foreach ($fc->field_tc_course_name['und'] as $name) {
                     $list[] = $name['value'];
                  }
                  
                  $courseTitle = get_obj_field_value($fc, 'field_tc_title');
                  $data['courses'][$courseTitle] = $list;
               }
            }
         }
         
         // Get header title
         $pageNode = get_staff_page_info();
         if ($pageNode) {
            $data['headerTitle'] = get_obj_field_value($pageNode, 'field_slp_detail_header_title');
         }
         
         print theme('staff_detail_template', $data);
      } else {
         print '';
      }
   }
}

/**
 * Fetches and returns all graduate records
 */
function show_all_graduates() {
   // make sure it is an ajax call
   if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
      $list = array();
      
      // Fetch all teachers
      $query = db_select('node', 'n');
      $query->fields('n', array('nid'));
      $query->condition('n.type', 'graduate', '=');
      $result = $query->execute();

      while ($record = $result->fetchAssoc()) {
         $node = node_load($record['nid']);
         $imageInfo = get_obj_field_img_info($node, 'field_graduate_profile_image');

         $list[] = array(
            'nid' => $node->nid,
            'firstName' => get_obj_field_value($node, 'field_graduate_firstname'),
            'lastName' => get_obj_field_value($node, 'field_graduate_lastname'),
            'occupation' => get_obj_field_value($node, 'field_graduate_occupation'),
            'profileImageUrl' => $imageInfo['url'],
            'profileImageAlt' => $imageInfo['alt'],
            'profileImageTitle' => $imageInfo['title'],
         );
      }
      
      print theme('block_graduate_list', array('graduateList' => $list));
   }
}

/*
* Fetches and returns graduate information which will be displayed in modal
*/
function show_graduate_details() {
   // make sure it is an ajax call
   if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
      
      if (isset($_GET['nid']) && $_GET['nid'] != '') {
         $graduate = node_load($_GET['nid']);
         
         $data = array(
            'nid' => $graduate->nid,
            'firstName' => get_obj_field_value($graduate, 'field_graduate_firstname'),
            'lastName' => get_obj_field_value($graduate, 'field_graduate_lastname'),
            'occupation' => get_obj_field_value($graduate, 'field_graduate_occupation'),
            'company' => get_obj_field_value($graduate, 'field_graduate_company'),
            'motto' => get_obj_field_value($graduate, 'field_graduate_motto'),
            'graduateSchool' => get_obj_field_value($graduate, 'field_graduate_school'),
            'coverImageDesktop' => get_obj_field_img_info($graduate, 'field_graduate_cover_image'),
            'coverImageMobile' => get_obj_field_img_info($graduate, 'field_graduate_cover_img_mobile'),
            'workList' => array(),
            'biographyList' => array(),
         );
         
         $imageInfo = get_obj_field_img_info($graduate, 'field_graduate_profile_image');
         $data['profileImageUrl'] = $imageInfo['url'];
         $data['profileImageAlt'] = $imageInfo['alt'];
         $data['profileImageTitle'] = $imageInfo['title'];
         
         // Get work list
         if (isset($graduate->field_graduate_work_list['und']) && $graduate->field_graduate_work_list['und']) {
            foreach ($graduate->field_graduate_work_list['und'] as $item) {
               $fc = entity_load('field_collection_item', array($item['value']));
               $fc = $fc[$item['value']];
               $imageInfo = get_obj_field_img_info($fc, 'field_graduate_work_image');
               
               $data['workList'][] = array(
                  'imageUrl' => $imageInfo['url'],
                  'imageAlt' => $imageInfo['alt'],
                  'imageTitle' => $imageInfo['title'],
                  'caption' => get_obj_field_value($fc, 'field_graduate_work_caption'),
               );
            }
         }
         
         // Get biography list
         if (isset($graduate->field_graduate_biography_list['und']) && $graduate->field_graduate_biography_list['und']) {
            $ctr = 0;
            foreach ($graduate->field_graduate_biography_list['und'] as $item) {
               $fc = entity_load('field_collection_item', array($item['value']));
               $fc = $fc[$item['value']];
               
               $data['biographyList'][$ctr] = array(
                  'title' => get_obj_field_value($fc, 'field_graduate_biography_title'),
                  'content' => get_obj_field_value($fc, 'field_graduate_biography_content'),
               );
               
               $ctr++;
            }
         }
         
         // Get header title
         $pageNode = get_graduate_page_info();
         if ($pageNode) {
            $data['headerTitle'] = get_obj_field_value($pageNode, 'field_glp_detail_header_title');
         }
         
         print theme('graduate_detail_template', $data);
      } else {
         print '';
      }
   }
}

/*
* Fetches and returns job list in html format
*/
function show_more_jobs() {
  // make sure it is an ajax call
   if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
      
      if (isset($_GET['currentJobCount'])) {
         $startIdx = (int) $_GET['currentJobCount']; // Get Start index to get job records
         $jobList = get_job_list($startIdx, 8); // Get list of job
         print theme('block_job_list', array('jobList' => $jobList));
      } else {
         print '';
      }
      
   }
}

/*
*  Show newsletter form modal
*/
function show_newsletter_form() {
   // make sure it is an ajax call
   if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
      $data = array();
   
      // Get newsletter form information
      $pageNode = get_page_info('newsletter');
      if ($pageNode) {
         $data['introTitle'] = get_obj_field_value($pageNode, 'field_newsletter_intro_title');
         $data['introDescription'] = get_obj_field_value($pageNode, 'field_newsletter_intro_desc');
      }
      
      print theme('newsletter_form_template', $data);
   }
}

/*
* Fetches and returns residential project list in html format
*/
function load_more_residential_projects() {
   // make sure it is an ajax call
   if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
      
      if (isset($_GET['currentProjCount'])) {
         $categoryVoc = taxonomy_vocabulary_machine_name_load('student_work_categories');
         $categoryId = get_taxonomy_term_id_by_name('Residential Interior Design Projects', $categoryVoc->vid);
         $startIdx = (int) $_GET['currentProjCount']; // Get Start index to get residential project records
         $projectList = get_project_list_by_category($categoryId, $startIdx, 6); // Get 6 list of residential projects
         print theme('block_student_work_list_template', array('projectList' => $projectList));
      } else {
         print '';
      }
   }
}

/*
* Fetches and returns commercial project list in html format
*/
function load_more_commercial_projects() {
   // make sure it is an ajax call
   if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
      
      if (isset($_GET['currentProjCount'])) {
         $categoryVoc = taxonomy_vocabulary_machine_name_load('student_work_categories');
         $categoryId = get_taxonomy_term_id_by_name('Commercial Interior Design Projects', $categoryVoc->vid);
         $startIdx = (int) $_GET['currentProjCount']; // Get Start index to get commercial project records
         $projectList = get_project_list_by_category($categoryId, $startIdx, 6); // Get 6 list of commercial projects
         print theme('block_student_work_list_template', array('projectList' => $projectList));
      } else {
         print '';
      }
   }
}

function newsletter_register() {
   global $user;
   $response = [
      'status' => 0,
      'messages' => 'API not found.',
   ];
   
   // Check if user send newsletter registration
   // Process the request then send to the administrator
   if (($_SERVER['REQUEST_METHOD'] === 'POST') && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
      $validationResult = validate_newsletter_registration();
      
      if ($validationResult['isValid']) {         
         
         $values = array(
            'type' => 'newsletter_subscriptions', // machine name of content type: Registrations
            'uid' => $user->uid,
            'status' => 1,
            'comment' => 1,
            'promote' => 0,
         );
         
         $entity = entity_create('node', $values);
         $ewrapper = entity_metadata_wrapper('node', $entity);
         $ewrapper->title->set($_POST['nl_first_name'].' '.$_POST['nl_last_name']);
         $ewrapper->field_ns_first_name->set($_POST['nl_first_name']);
         $ewrapper->field_ns_surname->set($_POST['nl_last_name']);
         $ewrapper->field_ns_email->set($_POST['nl_email']);
         $ewrapper->field_ns_phone_number->set($_POST['nl_phone']);
         $ewrapper->field_ns_subscribed->set(1);
         
         if ($ewrapper->save()) {
            $response['status'] = 1;
            $response['title'] = t('Success! You have been added!');
            $response['messages'] = t('Stay tuned for the latest in design news, course information and events, delivered directly to your inbox.');
         } else {
            $response['messages'] = t('There was a problem with your registration, please send again.');
         }
      
      } else {
         $response['messages'] = $validationResult['msg'];
         $response['title'] = t('Please fill up properly.');
         $response['status'] = -1;
      }
      
   } else {
      drupal_goto(url());
   }
   
   return drupal_json_output($response);
}

function validate_newsletter_registration() {
   $output = [
      'isValid' => true,
      'msg' => []
   ];
   
   if ($_POST['nl_first_name'] === '') {
      $output['msg'][] = t('First name is required.');
   }
   
   if ($_POST['nl_last_name'] === '') {
      $output['msg'][] = t('Surname is required.');
   }
   
   if ($_POST['nl_email'] === '') {
      $output['msg'][] = t('Email is required.');
   }
   
   /* if ($_POST['nl_phone'] === '') {
      $output['msg'][] = t('Phone number is required.');
   } */
   
   if (!empty($output['msg'])) {
      $output['isValid'] = false;
   }
   
   return $output;
}