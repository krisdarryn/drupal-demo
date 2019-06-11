<?php
/**
 * @file
 * The primary PHP file for this theme.
 */
 
function insight_theme() {   
   return array(
      'user_login' => array(
         'render element' => 'form',
         'template' => 'templates/user-login',
      ),
      'user_pass' => array(
         'render element' => 'form',
         'template' => 'templates/user-pass',
      ),
      'user_pass_reset' => array(
         'render element' => 'form',
         'template' => 'templates/user-pass-reset',
      ),
   );
}

function insight_form_alter(&$form, &$form_state, $form_id) {   
   if ($form_id == 'user_login') {
      $form['name']['#attributes']['class'] = array('form-text-field');
      $form['name']['#title'] = 'USERNAME ';
      $form['pass']['#attributes']['class'] = array('form-text-field');
      $form['pass']['#title'] = 'PASSWORD ';
      $form['actions']['submit']['#attributes']['class'] = array('btn-login');
      
   } else if ($form_id == 'user_pass') {
      $form['name']['#attributes']['class'] = array('form-text-field');
      $form['name']['#title'] = 'USERNAME OR E-MAIL ADDRESS ';
      $form['actions']['submit']['#attributes']['class'] = array('btn-login');
      
   } else if ($form_id == 'user_pass_reset') {
      $form['actions']['submit']['#attributes']['class'] = array('btn-login');
   }
}

function insight_preprocess_page(&$variables) { 
   global $base_url;
   $insight_theme_path = $base_url . '/' . drupal_get_path('theme', 'insight');
   $images_path = $insight_theme_path.'/dist/images/';
   $scripts_path = $insight_theme_path.'/dist/scripts/';
   
   // Override metaga module
   switch (arg(0)) {
      case "about":
      case "student-work":
      case "executive-course":
      case "home":
      case "course":
      case "coming-soon":
      case "booking":
      case "short-courses":
      case "staff":
      case "graduates":
      case "blog":
      case "press":
      case "contact":
      case "event":
      case "jobs":
      case "partners":
      case "internships":
      case "scholarship":
         unset($variables['page']['content']['metatags']);
         break;
   } 

   // Add you common/global variables here
   // to be converted to JS variables
   $jsVars = [
      'absoluteUrl' => $insight_theme_path,
      'baseUrl' => "{$base_url}/",
      'imgUrl' => $images_path,
      'ajaxUrl' => [
         'showProjectDetails' => "{$base_url}/ajax/api/show-project-details",
         'showAllTeachers' => "{$base_url}/ajax/api/show-all-teachers",
         'showTeacherDetails' => "{$base_url}/ajax/api/show-teacher-details",
         'showAllGraduates' => "{$base_url}/ajax/api/show-all-graduates",
         'showGraduateDetails' => "{$base_url}/ajax/api/show-graduate-details",
         'showMoreJobs' => "{$base_url}/ajax/api/show-more-jobs",
         'showNewsletterForm' => "{$base_url}/ajax/api/show-newsletter-form",
         'loadMoreResidentialProj' => "{$base_url}/ajax/api/load-more-residential-proj",
         'loadMoreCommercialProj' => "{$base_url}/ajax/api/load-more-commercial-proj",
         'newletterRegistration' => "{$base_url}/ajax/api/newsletter-regsiter",
      ]
   ];
   
   // Set backend variables in to javascript
   drupal_add_js([
      'insight' => [
         'jsVars' => $jsVars
      ]
   ], [
      'type' => 'setting'
   ]);
   
   // Add Pollyfill js
   drupal_add_js("{$scripts_path}polyfill.js", [
      'type' => 'file',
      'scope' => 'pollyfill',
      'weight' => 1,
   ]);
   
   // Add Common js 
   // This will be render to all pages
   drupal_add_js("{$scripts_path}bower.js", [
      'type' => 'file',
      'scope' => 'lib',
      'weight' => 1,
   ]);
   drupal_add_js("{$scripts_path}insight.js", [
      'type' => 'file',
      'scope' => 'lib',
      'weight' => 2,
   ]);
   
   // Check if pages fall from the below categories
   $alias_parts = explode('/', drupal_get_path_alias());
   
   // Load the blog details
   if (
      (count($alias_parts) >= 2) && 
      ($alias_parts[0] === 'blog') && 
      isset($alias_parts[1]) && 
      isset($variables['node']) && 
      isset($variables['node']->nid)
   ) {
      $blogDetails = blog_detail_page($variables['node']->nid);
      
      // If blog details doesn't exist reditect to blog page
      if (!$blogDetails) {
         drupal_goto('blog');
      }
      
      $variables = array_merge($blogDetails, $variables);
      $variables['theme_hook_suggestions'][] = 'blog_detail_template';
   }
   
   // Load course details
   if ((count($alias_parts) >= 3) && $alias_parts[0] === 'course') {
      $courseDetails = null;
   
      if (
         $alias_parts[1] === 'long' && 
         isset($alias_parts[2]) && 
         isset($variables['node']) && 
         isset($variables['node']->nid)
      ) {
         // Load long course details
         $courseDetails = long_course($variables['node']->nid);
         
         // If blog details doesn't exist reditect to blog page
         if (!$courseDetails) {
            drupal_goto('course');
         }
         
         $variables = array_merge($courseDetails, $variables);
         $variables['theme_hook_suggestions'][] = 'long_course_detail_template';
         
      } else if (
         $alias_parts[1] === 'short' && 
         isset($alias_parts[2]) && 
         isset($variables['node']) && 
         isset($variables['node']->nid)
      ) {
         // Load short course details
         $courseDetails = short_course($variables['node']->nid);
         
         // If blog details doesn't exist reditect to blog page
         if (!$courseDetails) {
            drupal_goto('short-courses');
         }
         
         $variables = array_merge($courseDetails, $variables);
         $variables['theme_hook_suggestions'][] = 'short_course_detail_template';
         
         drupal_add_js([
            'insight' => [
               'shortCourseVars' => [
                  'url' => implode('/', $alias_parts),
               ]
            ]
         ], [
            'type' => 'setting'
         ]);
      }
      
      if ($alias_parts[1] === 'executive') {
         drupal_goto('executive-course');
      }
      
   }
   
   // Load the event details
   if (
      (count($alias_parts) >= 2) && 
      ($alias_parts[0] === 'event') && 
      isset($alias_parts[1]) && 
      isset($variables['node']) && 
      isset($variables['node']->nid)
   ) {
      $eventDetails = event_detail_page($variables['node']->nid);
      
      // If event details doesn't exist reditect to event page
      if (!$eventDetails) {
         drupal_goto('event');
      }
         
      $variables = array_merge($eventDetails, $variables);
      $variables['theme_hook_suggestions'][] = 'event_detail_template';
   }
   
   // Redirect  to home page after login
   if (user_is_logged_in()) {
      if (arg(0) == 'user' && is_numeric(arg(1)) && arg(2) == '') {
         drupal_goto('home');
      }
   }
}

function insight_preprocess_html(&$vars) {
   // Set page head title
   switch (arg(0)) {
      case "about":
         $pageNode = get_page_info('page_about_us');
         $vars['customMetaTags'] = setCustomMetaTags($pageNode);
         
         if (isset($pageNode->metatags['und']['title']['value']) && !empty($pageNode->metatags['und']['title']['value']))  {
            $vars['head_title'] = $pageNode->metatags['und']['title']['value'];
         }
         break;
      case "student-work":
         $pageNode = get_page_info('page_student_work');
         $vars['customMetaTags'] = setCustomMetaTags($pageNode);
         
         if (isset($pageNode->metatags['und']['title']['value']) && !empty($pageNode->metatags['und']['title']['value']))  {
            $vars['head_title'] = $pageNode->metatags['und']['title']['value'];
         }
         break;
      case "executive-course":
         $pageNode = get_page_info('page_executive_course_overview');
         $vars['customMetaTags'] = setCustomMetaTags($pageNode);
         
         if (isset($pageNode->metatags['und']['title']['value']) && !empty($pageNode->metatags['und']['title']['value']))  {
            $vars['head_title'] = $pageNode->metatags['und']['title']['value'];
         }
         break;
      case "home":
         $pageNode = get_page_info('page_landing');
         $vars['customMetaTags'] = setCustomMetaTags($pageNode);
         
         if (isset($pageNode->metatags['und']['title']['value']) && !empty($pageNode->metatags['und']['title']['value']))  {
            $vars['head_title'] = $pageNode->metatags['und']['title']['value'];
         }
         break;
      case "course":
         $pageNode = get_page_info('page_course_overview');
         $vars['customMetaTags'] = setCustomMetaTags($pageNode);
         
         if (isset($pageNode->metatags['und']['title']['value']) && !empty($pageNode->metatags['und']['title']['value']))  {
            $vars['head_title'] = $pageNode->metatags['und']['title']['value'];
         }
         break;
      case "coming-soon":
         $pageNode = get_page_info('page_coming_soon');   
         $vars['customMetaTags'] = setCustomMetaTags($pageNode);
         
         if (isset($pageNode->metatags['und']['title']['value']) && !empty($pageNode->metatags['und']['title']['value']))  {
            $vars['head_title'] = $pageNode->metatags['und']['title']['value'];
         }
         break;
      case "booking":
         $pageNode = get_page_info('page_booking');
         $vars['customMetaTags'] = setCustomMetaTags($pageNode);
         
         if (isset($pageNode->metatags['und']['title']['value']) && !empty($pageNode->metatags['und']['title']['value']))  {
            $vars['head_title'] = $pageNode->metatags['und']['title']['value'];
         }
         break;
      case "short-courses":
         $pageNode = get_page_info('page_short_course_overview');
         $vars['customMetaTags'] = setCustomMetaTags($pageNode);
         
         if (isset($pageNode->metatags['und']['title']['value']) && !empty($pageNode->metatags['und']['title']['value']))  {
            $vars['head_title'] = $pageNode->metatags['und']['title']['value'];
         }
         break;
      case "staff":
         $pageNode = get_staff_page_info();
         $vars['customMetaTags'] = setCustomMetaTags($pageNode);
         
         if (isset($pageNode->metatags['und']['title']['value']) && !empty($pageNode->metatags['und']['title']['value']))  {
            $vars['head_title'] = $pageNode->metatags['und']['title']['value'];
         }
         
         break;
      case "graduates":
         $pageNode = get_graduate_page_info();
         $vars['customMetaTags'] = setCustomMetaTags($pageNode);
         
         if (isset($pageNode->metatags['und']['title']['value']) && !empty($pageNode->metatags['und']['title']['value']))  {
            $vars['head_title'] = $pageNode->metatags['und']['title']['value'];
         }
         
         break;
      case "blog":
         $pageNode = get_page_info('page_blog');
         $vars['customMetaTags'] = setCustomMetaTags($pageNode);
         
         if (isset($pageNode->metatags['und']['title']['value']) && !empty($pageNode->metatags['und']['title']['value']))  {
            $vars['head_title'] = $pageNode->metatags['und']['title']['value'];
         }
         
         break;
      case "press":
         $pageNode = get_page_info('page_press');
         $vars['customMetaTags'] = setCustomMetaTags($pageNode);
         
         if (isset($pageNode->metatags['und']['title']['value']) && !empty($pageNode->metatags['und']['title']['value']))  {
            $vars['head_title'] = $pageNode->metatags['und']['title']['value'];
         }
         
         break;
      case "contact":
         $pageNode = get_page_info('page_contact');
         $vars['customMetaTags'] = setCustomMetaTags($pageNode);
         
         if (isset($pageNode->metatags['und']['title']['value']) && !empty($pageNode->metatags['und']['title']['value']))  {
            $vars['head_title'] = $pageNode->metatags['und']['title']['value'];
         }
         
         break;
      case "event":
         $pageNode = get_event_page_info();
         $vars['customMetaTags'] = setCustomMetaTags($pageNode);
         
         if (isset($pageNode->metatags['und']['title']['value']) && !empty($pageNode->metatags['und']['title']['value']))  {
            $vars['head_title'] = $pageNode->metatags['und']['title']['value'];
         }
         
         break;
      case "jobs":
         $pageNode = get_page_info('page_job');
         $vars['customMetaTags'] = setCustomMetaTags($pageNode);
         
         if (isset($pageNode->metatags['und']['title']['value']) && !empty($pageNode->metatags['und']['title']['value']))  {
            $vars['head_title'] = $pageNode->metatags['und']['title']['value'];
         }
         
         break;
      case "partners":
         $pageNode = get_page_info('page_partner');
         $vars['customMetaTags'] = setCustomMetaTags($pageNode);
         
         if (isset($pageNode->metatags['und']['title']['value']) && !empty($pageNode->metatags['und']['title']['value']))  {
            $vars['head_title'] = $pageNode->metatags['und']['title']['value'];
         }
         
         break;
      case "internships":
         $pageNode = get_page_info('page_internship');
         $vars['customMetaTags'] = setCustomMetaTags($pageNode);
         
         if (isset($pageNode->metatags['und']['title']['value']) && !empty($pageNode->metatags['und']['title']['value']))  {
            $vars['head_title'] = $pageNode->metatags['und']['title']['value'];
         }
         
         break;
      case "scholarship":
         $pageNode = get_page_info('page_scholarship');
         $vars['customMetaTags'] = setCustomMetaTags($pageNode);
         
         if (isset($pageNode->metatags['und']['title']['value']) && !empty($pageNode->metatags['und']['title']['value']))  {
            $vars['head_title'] = $pageNode->metatags['und']['title']['value'];
         }
         
         break;
   }

   // Check if pages fall from the below categories
   $alias_parts = explode('/', drupal_get_path_alias());
         
   // Load the blog details meta tags
   if (
      (count($alias_parts) >= 2) && 
      ($alias_parts[0] === 'blog')
   ) {
      
      // Generate meta tag rel="prev" and rel="next"
      if (isset($alias_parts[1]) && $alias_parts[1]) {         
         $node = array_shift($vars['page']['content']['system_main']['nodes']);
         $node = is_array($node) ? array_shift($node) : null;
         
         if ($node && is_array($node) && isset($node['#object'])) {
            // Set query strings
            $qString = drupal_get_query_parameters();
            $qVal = [];
            
            foreach ($qString as $name => $val) {
               $qVal[] = "{$name}={$val}";
            }
            
            $qVal = !empty($qVal) ? ('?' . implode('&', $qVal)) : '';
            
            $vars['metaRel'] = array(
               'cano' => url('blog', array('absolute' => TRUE)) . $qVal,
            );
            $previousBlogNid = get_previous_blog_nid($node['#object']->nid, $node['#object']->field_blog_posted_date['und'][0]['value']);
            $nextBlogNid = get_next_blog_nid($node['#object']->nid, $node['#object']->field_blog_posted_date['und'][0]['value']);
            
            // Prepare prev and next meta rel 
            if ($previousBlogNid > 0) {
               $vars['metaRel']['prev'] = url("node/{$previousBlogNid}", array('absolute' => TRUE));
            }
            
            if ($nextBlogNid > 0) {
               $vars['metaRel']['next'] = url("node/{$nextBlogNid}", array('absolute' => TRUE));
            }
            
         }
         
      }
   }
   
   // Load the short course details meta tags
   if (
      (count($alias_parts) >= 2) && 
      ($alias_parts[0] === 'course') &&
      ($alias_parts[1] === 'short')
   ) {
      $vars['metaRel'] = array(
         'cano' => url('short-courses', array('absolute' => TRUE)),
      );   
   }
   
}