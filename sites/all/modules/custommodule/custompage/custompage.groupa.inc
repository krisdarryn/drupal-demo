<?php
// Some functions used are from custom_page.common.inc

/**
 * Landing page callback
 */
function landing_page() {
   $data = array();

   // Get landing page information
   $pageNode = get_page_info('page_landing');
   if ($pageNode) {
      
      $data['pageTitle']= ltrim($pageNode->title, 'Page -');
      $data['contactBtnCaption'] = get_obj_field_value($pageNode, 'field_lp_contact_button_caption');
      $data['courseBtnCaption'] = get_obj_field_value($pageNode, 'field_lp_course_button_caption');
      $data['workingSectionSlogan'] = get_obj_field_value($pageNode, 'field_lp_working_section_slogan');
      $data['testimonialSectionTitle'] = get_obj_field_value($pageNode, 'field_lp_testimonial_sec_title');
      $data['courseEventSectionTitle'] = get_obj_field_value($pageNode, 'field_lp_course_event_sec_title');
      $data['bannerLinkHref'] = get_obj_field_value($pageNode, 'field_lp_banner_link_href');
      $data['bannerLinkTarget'] = get_obj_field_value($pageNode, 'field_lp_banner_link_target');
      
      $data['graduateLink'] = get_obj_field_value($pageNode, 'field_lp_banner_graduate_link');
      $data['graduateText'] = get_obj_field_value($pageNode, 'field_lp_banner_graduate_text');
      $data['workLink'] = get_obj_field_value($pageNode, 'field_lp_banner_work_link');
      $data['workText'] = get_obj_field_value($pageNode, 'field_lp_banner_work_text');
      
      $imageInfo = get_obj_field_img_info($pageNode, 'field_lp_banner_image_desktop');
      $data['desktopBannerImageUrl'] = $imageInfo['url'];
      $data['desktopBannerImageAlt'] = $imageInfo['alt'];
      $data['desktopBannerImageTitle'] = $imageInfo['title'];
      
      $imageInfo = get_obj_field_img_info($pageNode, 'field_lp_banner_image_mobile');
      $data['mobileBannerImageUrl'] = $imageInfo['url'];
      $data['mobileBannerImageAlt'] = $imageInfo['alt'];
      $data['mobileBannerImageTitle'] = $imageInfo['title'];

      $imageInfo = get_obj_field_img_info($pageNode, 'field_lp_banner_graduate_image');
      $data['graduateBannerImageUrl'] = $imageInfo['url'];
      $data['graduateBannerImageAlt'] = $imageInfo['alt'];
      $data['graduateBannerImageTitle'] = $imageInfo['title'];
      
      $imageInfo = get_obj_field_img_info($pageNode, 'field_lp_banner_work_image');
      $data['workBannerImageUrl'] = $imageInfo['url'];
      $data['workBannerImageAlt'] = $imageInfo['alt'];
      $data['workBannerImageTitle'] = $imageInfo['title'];
      
      // Get 3 random testimonials
      if (isset($pageNode->field_lp_testimonial_items['und']) && $pageNode->field_lp_testimonial_items['und']) {
         $data['testimonials'] = get_random_testimonials();
      }
      
      // Get featured courses and events
      if (isset($pageNode->field_lp_featured_courses_events['und']) && $pageNode->field_lp_featured_courses_events['und']) {
         foreach ($pageNode->field_lp_featured_courses_events['und'] as $item) {
            $node = node_load($item['target_id']);
            
            if ($node->type == 'course') {
               // Add course to featured list
               $imageInfo = get_obj_field_img_info($node, 'field_c_cover_image');
               $data['featuredList'][] = array(
                  'nid' => $node->nid,
                  'type' => 'course',
                  'title' => $node->title,
                  'description' => get_obj_field_value($node, 'field_c_description'),
                  'startDate' => format_obj_field_date_value($node, 'field_c_start_date', 'j M Y'),
                  'duration' => get_obj_field_value($node, 'field_c_duration'),
                  'coverImageUrl' => $imageInfo['url'],
                  'coverImageAlt' => $imageInfo['alt'],
                  'coverImageTitle' => $imageInfo['title'],
               );
            } else {
               // Add event to featured list
               $imageInfo = get_obj_field_img_info($node, 'field_event_cover_image');               
               $data['featuredList'][] = array(
                  'nid' => $node->nid,
                  'type' => 'event',
                  'title' => $node->title,
                  'description' => get_obj_field_value($node, 'field_event_intro_description'),
                  'startDate' => format_obj_field_date_value($node, 'field_event_start_date', 'j M Y'),
                  'coverImageUrl' => $imageInfo['url'],
                  'coverImageAlt' => $imageInfo['alt'],
                  'coverImageTitle' => $imageInfo['title'],
               );
            }
         }
      }
   }
   
   drupal_add_js(drupal_get_path('theme', 'insight') .'/dist/scripts/landing.js', [
      'type' => 'file',
      'scope' => 'pageJs',
      'weight' => 1,
   ]);
   
   return theme('landing_template', $data);
}

/**
* Fetches and returns 3 random testimonials
*/
function get_random_testimonials() {   
   $testimonials = array();

   $query = db_select("field_data_field_lp_testimonial_items","d");
   $query->addField('d', 'field_lp_testimonial_items_value', 'value');
   $query->range(0, 3);
   $query->orderRandom();
   $result = $query->execute();
   
   while ($record = $result->fetchAssoc()) {
      $fc = entity_load('field_collection_item', array($record['value']));
      $fc = $fc[$record['value']];
      $imageInfo = get_obj_field_img_info($fc, 'field_testimonial_credit_image');
      
      $testimonials[] = array(
         'content' => get_obj_field_value($fc, 'field_testimonial_content'),
         'creditText' => get_obj_field_value($fc, 'field_testimonial_credit_text'),
         'creditImageUrl' => $imageInfo['url'],
         'creditImageAlt' => $imageInfo['alt'],
         'creditImageTitle' => $imageInfo['title'],
      );
   }
   
   return $testimonials;
}

/**
 * Staff list page callback
 */
function staff_list_page() {
   $data = array('teacherList' => array());

   // Get staff list page information
   $staffPageNode = get_staff_page_info();
   if ($staffPageNode) {
      $data['pageTitle']= ltrim($staffPageNode->title, 'Page -');
      $imageInfo = get_obj_field_img_info($staffPageNode, 'field_slp_banner_image');
      $data['bannerImageUrl'] = $imageInfo['url'];
      $data['bannerImageAlt'] = $imageInfo['alt'];
      $data['bannerImageTitle'] = $imageInfo['title'];
      $data['bannerSlogan'] = get_obj_field_value($staffPageNode, 'field_slp_banner_slogan');
      $data['staffIntroTitle'] = get_obj_field_value($staffPageNode, 'field_slp_staff_intro_title');
      $data['staffIntroContent'] = get_obj_field_value($staffPageNode, 'field_slp_staff_intro_content');
      $data['lecturerIntroTitle'] = get_obj_field_value($staffPageNode, 'field_slp_lecturer_intro_title');
      $data['lecturerIntroContent'] = get_obj_field_value($staffPageNode, 'field_slp_lecturer_intro_content');
      $data['lecturerList'] = array();

      // Get lecturer list
      if (isset($staffPageNode->field_slp_lecturer_list['und']) && $staffPageNode->field_slp_lecturer_list['und']) {         
         foreach ($staffPageNode->field_slp_lecturer_list['und'] as $item) {
            $fc = entity_load('field_collection_item', array($item['value']));
            $fc = $fc[$item['value']];
            $imageInfo = get_obj_field_img_info($fc, 'field_slp_lecturer_image');
            
            $data['lecturerList'][] = array(
               'firstName' => get_obj_field_value($fc, 'field_slp_lecturer_firstname'),
               'lastName' => get_obj_field_value($fc, 'field_slp_lecturer_lastname'),
               'title' => get_obj_field_value($fc, 'field_slp_lecturer_title'),
               'imageUrl' => $imageInfo['url'],
               'imageAlt' => $imageInfo['alt'],
               'imageTitle' => $imageInfo['title'],
            );
         }
      }
   }
   
   // Get all graduate list count
   $data['allStaffListSize'] = get_content_total_count_by_type('teacher');
   
   if ($data['allStaffListSize'] > 0) {
      // Fetch 6 teacher records as initial display
      $query = db_select('node', 'n');
      $query->leftJoin('draggableviews_structure', 'dv', 'dv.entity_id = n.nid');
      $query->fields('n', array('nid'));
      $query->condition('n.type', 'teacher', '=');
      $query->condition('dv.view_name', 'teacher_list', '=');
      $query->orderBy('dv.weight', 'ASC');
      $query->range(0, 6);
      $result = $query->execute();

      while ($record = $result->fetchAssoc()) {
         $node = node_load($record['nid']);
         $imageInfo = get_obj_field_img_info($node, 'field_teacher_cover_image');

         $data['teacherList'][] = array(
            'nid' => $node->nid,
            'imageUrl' => $imageInfo['url'],
            'imageAlt' => $imageInfo['alt'],
            'imageTitle' => $imageInfo['title'],
            'firstName' => get_obj_field_value($node, 'field_teacher_firstname'),
            'lastName' => get_obj_field_value($node, 'field_teacher_lastname'),
            'longTitle' => get_obj_field_value($node, 'field_teacher_long_title'),
         );
      }

      // Fetch all teachers
      $query2 = db_select('node', 'n');
      $query2->leftJoin('draggableviews_structure', 'dv', 'dv.entity_id = n.nid');
      $query2->fields('n', array('nid'));
      $query2->condition('n.type', 'teacher', '=');
      $query2->condition('dv.view_name', 'teacher_list', '=');
      $query2->orderBy('dv.weight', 'ASC');
      $res = $query2->execute();

      while ($rec = $res->fetchAssoc()) {
         $node = node_load($rec['nid']);
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
   }

    drupal_add_js(drupal_get_path('theme', 'insight') .'/dist/scripts/staff.js', [
        'type' => 'file',
        'scope' => 'pageJs',
        'weight' => 3,
    ]);

    drupal_add_js([
      'insight' => [
         'staffVars' => [
            'staffList' => $list
         ]
      ]
   ], [
      'type' => 'setting'
   ]);
   
   return theme('staff_list_template', $data);
}

/**
 * Graduate list page callback
 */
function graduate_list_page() {
   $data = array('graduateList' => array());
   
   // Get graduate list page information
   $pageNode = get_graduate_page_info();
   if ($pageNode) {
      $data['pageTitle']= ltrim($pageNode->title, 'Page -');
      $imageInfo = get_obj_field_img_info($pageNode, 'field_glp_banner_image');
      $data['bannerImageUrl'] = $imageInfo['url'];
      $data['bannerImageAlt'] = $imageInfo['alt'];
      $data['bannerImageTitle'] = $imageInfo['title'];
      $data['bannerSlogan'] = get_obj_field_value($pageNode, 'field_glp_banner_slogan');
      $data['introSectionTitle'] = get_obj_field_value($pageNode, 'field_glp_intro_section_title');
      $data['introSectionContent'] = get_obj_field_value($pageNode, 'field_glp_intro_section_content');
      $data['initialNumDisplay'] = get_obj_field_value($pageNode, 'field_glp_initial_num_display');
      $data['employmentList'] = array();
      
      // Get list of employment image url
      if (isset($pageNode->field_glp_employment_list['und']) && $pageNode->field_glp_employment_list['und']) { 
         foreach ($pageNode->field_glp_employment_list['und'] as $item) {            
            $fc = entity_load('field_collection_item', array($item['value']));
            $fc = $fc[$item['value']];
            
            $data['employmentList'][] = array(
               'name' => get_obj_field_value($fc, 'field_employment_name'),
               'image' => get_obj_field_img_info($fc, 'field_employment_image'),
            );
         }
      }
   }
   
   // Get all graduate list count
   $data['allGraduateListSize'] = get_content_total_count_by_type('graduate');

   if ($data['allGraduateListSize'] > 0) {
      // Fetch graduates by initial number set to display
      $query = db_select('node', 'n');
      $query->leftJoin('draggableviews_structure', 'dv', 'dv.entity_id = n.nid');
      $query->fields('n', array('nid'));
      $query->condition('n.type', 'graduate', '=');
      $query->condition('dv.view_name', 'graduate_list', '=');
      $query->orderBy('dv.weight', 'ASC');
      
      if ($data['initialNumDisplay'] > 0) {
         $query->range(0, $data['initialNumDisplay']);
      }
      
      $result = $query->execute();

      while ($record = $result->fetchAssoc()) {
         $node = node_load($record['nid']);
         $imageInfo = get_obj_field_img_info($node, 'field_graduate_profile_image');

         $data['graduateList'][] = array(
            'nid' => $node->nid,
            'firstName' => get_obj_field_value($node, 'field_graduate_firstname'),
            'lastName' => get_obj_field_value($node, 'field_graduate_lastname'),
            'occupation' => get_obj_field_value($node, 'field_graduate_occupation'),
            'company' => get_obj_field_value($node, 'field_graduate_company'),
            'profileImageUrl' => $imageInfo['url'],
            'profileImageAlt' => $imageInfo['alt'],
            'profileImageTitle' => $imageInfo['title'],
         );

      }

      // Fetch All
      $query2 = db_select('node', 'n');
      $query2->leftJoin('draggableviews_structure', 'dv', 'dv.entity_id = n.nid');
      $query2->fields('n', array('nid'));
      $query2->condition('n.type', 'graduate', '=');
      $query2->condition('dv.view_name', 'graduate_list', '=');
      $query2->orderBy('dv.weight', 'ASC');
      
      $res = $query->execute();

      while ($record = $res->fetchAssoc()) {
         $node = node_load($record['nid']);
         $imageInfo = get_obj_field_img_info($node, 'field_graduate_profile_image');

         $data['graduateFullList'][] = array(
            'nid' => $node->nid,
            'firstName' => get_obj_field_value($node, 'field_graduate_firstname'),
            'lastName' => get_obj_field_value($node, 'field_graduate_lastname'),
            'occupation' => get_obj_field_value($node, 'field_graduate_occupation'),
            'company' => get_obj_field_value($node, 'field_graduate_company'),
            'profileImageUrl' => $imageInfo['url'],
            'profileImageAlt' => $imageInfo['alt'],
            'profileImageTitle' => $imageInfo['title'],
         );

      }

      //
   }


   drupal_add_js(drupal_get_path('theme', 'insight') .'/dist/scripts/graduates.js', [
      'type' => 'file',
      'scope' => 'pageJs',
      'weight' => 3,
   ]);



   drupal_add_js([
      'insight' => [
         'gradVars' => [
            'employmentList' => $data['employmentList'],
            'graduateFullList' => $data['graduateFullList']
         ]
      ]
   ], [
      'type' => 'setting'
   ]);

   return theme('graduate_list_template', $data);
}

/**
 * Blog overview page callback
 */
function blog_overview_page() {
   $data = array('blogItems' => array());
   
   // Get blog page information
   $pageNode = get_page_info('page_blog');
   if ($pageNode) {
      $data['pageTitle']= ltrim($pageNode->title, 'Page -');
      $imageInfo = get_obj_field_img_info($pageNode, 'field_bp_banner_image');
      $data['bannerImageUrl'] = $imageInfo['url'];
      $data['bannerImageAlt'] = $imageInfo['alt'];
      $data['bannerImageTitle'] = $imageInfo['title'];
      $data['bannerSlogan'] = get_obj_field_value($pageNode, 'field_bp_banner_slogan');
      $data['introSectionTitle'] = get_obj_field_value($pageNode, 'field_bp_intro_section_title');
      $data['linkBtnCaption'] = get_obj_field_value($pageNode, 'field_bp_link_button_caption');
   }
   
   $data['blogCategory'] = '';
   $data['blogCategoryTid'] = '';
   
   if (isset($_GET['article']) && $_GET['article'] != '') {
      // Get blog category tid. This will be use in query condition.
      $data['blogCategory'] = $_GET['article'];
      $categoryVoc = taxonomy_vocabulary_machine_name_load('blog_category');
      $data['blogCategoryTid'] = get_taxonomy_term_id_by_name($data['blogCategory'], $categoryVoc->vid);
      $data['allBlogListSize'] = get_blog_count_by_category($data['blogCategoryTid']); // Get blog list count by category
   } else {
      // Get all blog list count
      $data['allBlogListSize'] = get_content_total_count_by_type('blog');
   }
   
   // Get page number and start index for getting blog records
   if (isset($_GET['page']) && $_GET['page'] != '') {
      $data['page'] = (int) $_GET['page'];
   } else {
      $data['page'] = 1; // default
   }
   
   // Continue the process if there are blog records to fetch
   if ($data['allBlogListSize'] > 0) {
      $result = query_blogs($data); // Fetch blog records
      $categoryTids = array();
      
      while ($record = $result->fetchAssoc()) {
         $blog = node_load($record['nid']);
         $imageInfo = get_obj_field_img_info($blog, 'field_blog_cover_image');
         
         $data['blogItems'][] = array(
            'nid' => $blog->nid,
            'postedDate' => format_obj_field_date_value($blog, 'field_blog_posted_date', 'j M Y'),
            'title' => $blog->title,
            'introContent' => get_obj_field_value($blog, 'field_blog_intro_content'),
            'coverImageUrl' => $imageInfo['url'],
            'coverImageAlt' => $imageInfo['alt'],
            'coverImageTitle' => $imageInfo['title'],
         );
         
         // Get list of category tid. Use for getting list of related article counts
         if (isset($blog->field_blog_categories['und']) && $blog->field_blog_categories['und']) {
            foreach ($blog->field_blog_categories['und'] as $category) {
               if ($data['blogCategoryTid'] != $category['tid'] && ! in_array($category['tid'], $categoryTids)) {
                  $categoryTids[] = $category['tid'];
               }
            }
         }
      }
      
      // Get list of blog categories related to currently displayed blogs.
      // Total number of blogs by category is also returned
      if ($categoryTids) {
         $data['relatedArticles'] = get_related_article_counts($categoryTids);
      }
      
      // Set query strings
      $qString = drupal_get_query_parameters();
      $data['qVal'] = [];
      
      foreach ($qString as $name => $val) {
         $data['qVal'][] = "{$name}={$val}";
      }
      
      $data['qVal'] = !empty($data['qVal']) ? ('?' . implode('&', $data['qVal'])) : '';
   }
   
   drupal_add_js(drupal_get_path('theme', 'insight') .'/dist/scripts/blog.js', [
      'type' => 'file',
      'scope' => 'pageJs',
      'weight' => 3,
   ]);

   return theme('blog_overview_template', $data);
}

/**
* Returns total number of blogs by category
* param: $blogCategoryId (int)
*/
function get_blog_count_by_category($blogCategoryId) {
   $query = db_select('field_data_field_blog_categories', 'c');
   $query->fields('c', array('field_blog_categories_tid'));
   $query->condition('c.field_blog_categories_tid', $blogCategoryId, '=');
   return $query->execute()->rowCount();
}

/**
* Fetch specific number of blog records
* Returns query result
* param: $data (arr)
*/
function query_blogs($data) {
   $limit = 4;
   $startIdx = ($data['page'] - 1) * $limit;
   
   // Fetch blog records
   $query = db_select('node', 'n');
   $query->join('field_data_field_blog_posted_date', 'd', 'd.entity_id = n.nid');
   $query->fields('n', array('nid'));
   
   if ($data['blogCategory'] != '') {
      $query->join('field_data_field_blog_categories', 'c', 'c.entity_id = n.nid');
      $query->condition('c.field_blog_categories_tid', $data['blogCategoryTid'], '=');
   }
   
   $query->condition('n.type', 'blog', '=');
   $query->orderBy('d.field_blog_posted_date_value', 'DESC');
   $query->range($startIdx, $limit);
   return $query->execute();
}

/**
* Get total count of blogs per category
* Return list of blog category with total count information
* param: $categoryTids (arr)
*/
function get_related_article_counts($categoryTids) {
   $query = db_select('field_data_field_blog_categories', 'c');
   $query->addField('c', 'field_blog_categories_tid', 'tid');
   $query->condition('c.field_blog_categories_tid', $categoryTids, 'IN');
   $query->groupBy('c.field_blog_categories_tid');
   $query->addExpression('COUNT(c.field_blog_categories_tid)', 'ncount');
   $result = $query->execute()->fetchAll();
   
   $relatedArticles = array();
   foreach ($result as $item) {
      $category = taxonomy_term_load($item->tid);
      $relatedArticles[] = array(
         'tid' => $category->tid,
         'name' => $category->name,
         'count' => $item->ncount,
      );
   }
   
   return $relatedArticles;
}

/**
 * Returns specific blog details
 * param: $nid (int)
 */
function blog_detail_page($nid) {
   $blog = node_load($nid);
   
   if (!$blog) {
      return false;
   }
   
   $imageInfo = get_obj_field_img_info($blog, 'field_blog_cover_image');   
   $data = array(
      'title' => $blog->title,
      'postedDate' => format_obj_field_date_value($blog, 'field_blog_posted_date', 'j M Y'),
      'coverImageUrl' => $imageInfo['url'],
      'coverImageAlt' => $imageInfo['alt'],
      'coverImageTitle' => $imageInfo['title'],
      'quote' => get_obj_field_value($blog, 'field_blog_quote'),
      'quotePlacement' => get_obj_field_value($blog, 'field_blog_quote_placement'),
      'imagesPlacement' => get_obj_field_value($blog, 'field_blog_images_placement'),
      'previousBlogNid' => get_previous_blog_nid($blog->nid, $blog->field_blog_posted_date['und'][0]['value']),
      'nextBlogNid' => get_next_blog_nid($blog->nid, $blog->field_blog_posted_date['und'][0]['value']),
      'images' => array(),
      'contents' => array(),
   );
   
   // Get blog images
   if (isset($blog->field_blog_images['und']) && $blog->field_blog_images['und']) {
      foreach ($blog->field_blog_images['und'] as $item) {
         $fc = entity_load('field_collection_item', array($item['value']));
         $fc = $fc[$item['value']];
         $imageInfo = get_obj_field_img_info($fc, 'field_blog_image');
         
         $data['images'][] = array(
            'imageUrl' => $imageInfo['url'],
            'imageAlt' => $imageInfo['alt'],
            'imageTitle' => $imageInfo['title'],
            'caption' => get_obj_field_value($fc, 'field_blog_image_caption'),
         );
      }
   }
   
   // Get blog contents
   if (isset($blog->field_blog_contents['und']) && $blog->field_blog_contents['und']) {
      foreach ($blog->field_blog_contents['und'] as $item) {
         $fc = entity_load('field_collection_item', array($item['value']));
         $fc = $fc[$item['value']];
         
         $data['contents'][] = array(
            'title' => get_obj_field_value($fc, 'field_blog_content_title'),
            'content' => get_obj_field_value($fc, 'field_blog_content'),
         );
      }
   }
   
   // Get page banner slogan and image
   $pageNode = get_page_info('page_blog');
   if ($pageNode) {
      $imageInfo = get_obj_field_img_info($pageNode, 'field_bp_banner_image');
      $data['bannerImageUrl'] = $imageInfo['url'];
      $data['bannerImageAlt'] = $imageInfo['alt'];
      $data['bannerImageTitle'] = $imageInfo['title'];
      $data['bannerSlogan'] = get_obj_field_value($pageNode, 'field_bp_banner_slogan');
   }
   
   drupal_add_js(drupal_get_path('theme', 'insight') .'/dist/scripts/blog.js', [
      'type' => 'file',
      'scope' => 'pageJs',
      'weight' => 3,
   ]);
   
   
   return $data;   
}

/**
* Returns previous blog nid prior to active blog
* params: $activeBlogNid (int), $postedDate (str)
*/
function get_previous_blog_nid($activeBlogNid, $postedDate) {
   $query = db_select('node', 'n');
   $query->join('field_data_field_blog_posted_date', 'd', 'd.entity_id = n.nid');
   $query->fields('n', array('nid'));
   $query->condition('n.type', 'blog', '=');
   $query->condition('d.field_blog_posted_date_value', $postedDate, '<=');
   $query->orderBy('d.field_blog_posted_date_value', 'DESC');
   $query->range(0, 2);
   $result = $query->execute();
   
   while ($record = $result->fetchAssoc()) {
      if ($record['nid'] != $activeBlogNid) {
         return $record['nid'];
      }
   }
   
   return 0;   
}

/**
* Returns next blog nid prior to active blog
* params: $activeBlogNid (int), $postedDate (str)
*/
function get_next_blog_nid($activeBlogNid, $postedDate) {
   $query = db_select('node', 'n');
   $query->join('field_data_field_blog_posted_date', 'd', 'd.entity_id = n.nid');
   $query->fields('n', array('nid'));
   $query->condition('n.type', 'blog', '=');
   $query->condition('d.field_blog_posted_date_value', $postedDate, '>=');
   $query->orderBy('d.field_blog_posted_date_value', 'ASC');
   $query->range(0, 2);
   $result = $query->execute();
   
   while ($record = $result->fetchAssoc()) {
      if ($record['nid'] != $activeBlogNid) {
         return $record['nid'];
      }
   }
   
   return 0;
}

/**
 * Press page callback
 */
function press_page() {
   $data = array('pressItems' => array());
   
   // Get press page information
   $pageNode = get_page_info('page_press');
   if ($pageNode) {
      $data['pageTitle']= str_replace('Page - ', '', $pageNode->title);
      $imageInfo = get_obj_field_img_info($pageNode, 'field_pp_banner_image');
      $data['bannerImageUrl'] = $imageInfo['url'];
      $data['bannerImageAlt'] = $imageInfo['alt'];
      $data['bannerImageTitle'] = $imageInfo['title'];
      $data['bannerSlogan'] = get_obj_field_value($pageNode, 'field_pp_banner_slogan');
      $data['headerTitle'] = get_obj_field_value($pageNode, 'field_pp_header_title');
   }
   
   // Get press items
   $query = db_select('node', 'n');
   $query->join('field_data_field_press_post_date', 'd', 'd.entity_id = n.nid');
   $query->fields('n', array('nid'));
   $query->condition('n.type', 'press', '=');
   $query->orderBy('d.field_press_post_date_value', 'DESC');
   $result = $query->execute();
   
   while ($record = $result->fetchAssoc()) {
      $press = node_load($record['nid']);
      $imageInfo = get_obj_field_img_info($press, 'field_press_cover_image');
      
      $data['pressItems'][] = array(
         'nid' => $press->nid,
         'title' => $press->title,
         'postDate' => format_obj_field_date_value($press, 'field_press_post_date', 'F Y'),
         'location' => get_obj_field_value($press, 'field_press_location'),
         'coverImageUrl' => $imageInfo['url'],
         'coverImageAlt' => $imageInfo['alt'],
         'coverImageTitle' => $imageInfo['title'],
         'file' => get_obj_field_file_info($press, 'field_press_pdf_file'),
      );
   }

   drupal_add_js(drupal_get_path('theme', 'insight') .'/dist/scripts/press.js', [
      'type' => 'file',
      'scope' => 'pageJs',
      'weight' => 3,
   ]);
   
   return theme('press_template', $data);
}

/**
 * Contact page callback
 */
function contact_page() {
   $data = array();   
   $pageNode = get_page_info('page_contact');
   $data['formStatus'] = 0;
   $data['interestedCourses'] = [];
   $data['heardOptions'] = [];
   
   if ($pageNode) {
      $data['pageTitle']= ltrim($pageNode->title, 'Page -');
      $imageInfo = get_obj_field_img_info($pageNode, 'field_contact_banner_image');
      $data['bannerImageUrl'] = $imageInfo['url'];
      $data['bannerImageAlt'] = $imageInfo['alt'];
      $data['bannerImageTitle'] = $imageInfo['title'];
      $data['bannerSlogan'] = get_obj_field_value($pageNode, 'field_contact_banner_slogan');
      $data['address'] = get_obj_field_value($pageNode, 'field_contact_address');
      $data['telephone'] = get_obj_field_value($pageNode, 'field_contact_telephone');
      $data['email'] = get_obj_field_value($pageNode, 'field_contact_email');
      $data['trave_by_bus_list'] = array();
      $data['trave_by_mtr_list'] = array();
      $data['trave_by_car_list'] = array();
      
      if (isset($_GET['cid']) && $_GET['cid'] != '') {
         // Course name will be displayed in a text field
         $course = node_load($_GET['cid']);
         $data['interestedCourse'] = $course->title;
         //$data['interestedCourses'][] = $course->title;

         // Get option list for couse interested field
         if (isset($pageNode->field_contact_course_options['und']) && $pageNode->field_contact_course_options['und']) {
            foreach ($pageNode->field_contact_course_options['und'] as $item) {
               $data['interestedCourses'][] = $item['value'];
            }
         }
         
      } else {
         // Get option list for couse interested field
         if (isset($pageNode->field_contact_course_options['und']) && $pageNode->field_contact_course_options['und']) {
            foreach ($pageNode->field_contact_course_options['und'] as $item) {
               $data['interestedCourses'][] = $item['value'];
            }
         }
      }
      
      // Get option list for hear about us field
      if (isset($pageNode->field_contact_heard_options['und']) && $pageNode->field_contact_heard_options['und']) {
         foreach ($pageNode->field_contact_heard_options['und'] as $item) {
            $data['heardOptions'][] = $item['value'];
         }
      }
      
      // Get travel by bus list
      if (isset($pageNode->field_contact_travel_by_bus_list['und']) && $pageNode->field_contact_travel_by_bus_list['und']) {
         foreach ($pageNode->field_contact_travel_by_bus_list['und'] as $item) {
            $data['trave_by_bus_list'][] = array(
               'location' => get_field_collection_field_value($item['value'], 'field_travel_by_bus_location'),
               'name' => get_field_collection_field_value($item['value'], 'field_travel_by_bus_name'),
            );
         }
      }
      
      // Get travel by mtr / minibus list
      if (isset($pageNode->field_contact_travel_by_mtr_list['und']) && $pageNode->field_contact_travel_by_mtr_list['und']) {
         $data['trave_by_mtr_list'] = [];
         
         foreach ($pageNode->field_contact_travel_by_mtr_list['und'] as $item) {
            $data['trave_by_mtr_list'][] = [
               'train_name' => get_field_collection_field_value($item['value'], 'field_travel_by_mtr_train_name'),
               'bus_name' => get_field_collection_field_value($item['value'], 'field_travel_by_mtr_bus_name'),
               'bus_location' => get_field_collection_field_value($item['value'], 'field_travel_by_mtr_bus_location'),
            ];
         }
      }
      
      // Get travel by car list
      if (isset($pageNode->field_contact_travel_by_car_list['und']) && $pageNode->field_contact_travel_by_car_list['und']) {
         foreach ($pageNode->field_contact_travel_by_car_list['und'] as $item) {
            $fc = entity_load('field_collection_item', array($item['value']));
            $fc = $fc[$item['value']];
            
            // Get locations
            $locationList = array();         
            if (isset($fc->field_travel_by_car_locations['und']) && $fc->field_travel_by_car_locations['und']) {
               foreach ($fc->field_travel_by_car_locations['und'] as $location) {
                  $locationList[] = $location['value'];
               }
            }
            
            $data['trave_by_car_list'][] = array(
               'description' => get_obj_field_value($fc, 'field_travel_by_car_description'),
               'locationList' => $locationList,
            ); 
         }
      }
   }
   
   // Check if user send contact info
   // Process the request then send to the administrator
   if (($_SERVER['REQUEST_METHOD'] === 'POST') && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
      $response = [];
      $data['messages'] = [];
      $validationResult = validate_contact_us();
      
      if ($validationResult['isValid']) {
         $users = entity_load('user');
         $adminEmails = [];
         
         // List all administrator emails
         foreach ($users as $user) {
            
            if (in_array('administrator', $user->roles)) {
               $adminEmails[] = $user->mail;
            }
            
         }
         
         $a = drupal_mail('custom', 'contact-us', implode(',', $adminEmails), language_default(), array_merge($_POST, [
            //'subject' => 'Contact us message'
         ]));
         
         
         $response['messages'] = t('Thanks for your enquiry. One of our staff will get back to you shortly.');
         $response['title'] = t('Your message was successfully sent.');
         $response['status'] = 1;
      } else {
         $response['messages'] = $validationResult['msg'];
         $response['title'] = t('Please fill up properly.');
         $response['status'] = -1;
      }
      
      return drupal_json_output($response);
   }
   
   drupal_add_js('https://maps.googleapis.com/maps/api/js?key=AIzaSyAu3vQP2oYKrrEAxuamUXYGwYfxfLX9Rqw&callback=initMap', [
      'type' => 'external',
      'scope' => 'recaptcha',
      'weight' => 1,
      'defer' => true,
   ]);
   
   drupal_add_js(drupal_get_path('theme', 'insight') .'/dist/scripts/contact.js', [
      'type' => 'file',
      'scope' => 'pageJs',
      'weight' => 3,
   ]);
   
   return theme('contact_template', $data);
}

/**
 * Validated the contact form
 *
 * @return array
 */
function validate_contact_us() {
   $output = [
      'isValid' => true,
      'msg' => []
   ];
   
   if ($_POST['fm_first_name'] === '') {
      $output['msg'][] = t('First name is required.');
   }
   
   if ($_POST['fm_surname'] === '') {
      $output['msg'][] = t('Surname is required.');
   }
   
   if ($_POST['fm_email'] === '') {
      $output['msg'][] = t('Email is required.');
   }
   
   if ($_POST['fm_interested_course'] == '-1') {
      $output['msg'][] = t('Please select a course you are interested in.');
   }
   
   if ($_POST['fm_hear_about_us'] == '-1') {
      $output['msg'][] = t('Please select where you heard about us.');
   }
   
   if ($_POST['fm_message'] === '') {
      $output['msg'][] = t('Message is required.');
   }
   
   if (!empty($output['msg'])) {
      $output['isValid'] = false;
   }
   
   return $output;
}

/**
 * Generate the Option {n} value
 * @param $ctr int
 * @return string
 */
function contact_page_mrt_opt_gen($ctr) {
   
   if ($ctr > 24) {
      $ctr = 0;
   }
   
   return chr($ctr + 97);
}

/**
 * Event overview page callback
 */
function event_overview_page() {
   $data = array('upcomingEventItems' => array(), 'pastEventItems' => array());
   
   // Get event page information
   $pageNode = get_event_page_info();
   if ($pageNode) {
      $data['pageTitle']= ltrim($pageNode->title, 'Page -');
      $imageInfo = get_obj_field_img_info($pageNode, 'field_ep_overview_banner_image');
      $data['bannerImageUrl'] = $imageInfo['url'];
      $data['bannerImageAlt'] = $imageInfo['alt'];
      $data['bannerImageTitle'] = $imageInfo['title'];
      $data['bannerSlogan'] = get_obj_field_value($pageNode, 'field_ep_overview_banner_slogan');
      $data['linkBtnCaption'] = get_obj_field_value($pageNode, 'field_ep_link_button_caption');
   }
   
   $upcomingEventLimit = 4; // Limit number of upcoming events to fetch
   $pastEventLimit = 2; // Limit number of past events to fetch
   
   // Get page number and starting index point for getting event records
   if (isset($_GET['page']) && ($_GET['page'] != '') && $_GET['page'] > 1) {
      $upcomingEventLimit = 4;
      $pastEventLimit = 4;
      $data['page'] = (int) $_GET['page'];
      
      if ($_GET['page'] > 2) {
         $upcomingStartIdx = (($data['page'] - 1) * $upcomingEventLimit) - 2;
         $pastStartIdx = (($data['page'] - 1) * $pastEventLimit) - 2;
      } else {
         $upcomingStartIdx = 2;
         $pastStartIdx = 2;
      }
      
   } else {
      $upcomingEventLimit = 2;
      $pastEventLimit = 2;
      $data['page'] = 1;
      $upcomingStartIdx = 0;
      $pastStartIdx = 0;
   }   
   
   // Get latest upcoming events
   // Get latest past events
   $currentDate = date('Y-m-d H:i:s');
   $data['upcomingEventList'] = get_upcoming_events($currentDate, $upcomingStartIdx, $upcomingEventLimit);
   $data['pastEventList'] = get_past_events($currentDate, $pastStartIdx, $pastEventLimit);
   $data['upcomingEventListSize'] = get_filtered_events_count($currentDate, '>=', 'field_event_start_date');
   $data['pastEventListSize'] = get_filtered_events_count($currentDate, '<', 'field_event_end_date');
   
   return theme('event_overview_template', $data);
}

/**
 * Returns list of past event
 * params: $currentDate (str), $startIdx (int), $limit (int)
 */
function get_past_events($currentDate, $startIdx, $limit) {   
   // Fetch past event records
   $query = db_select('node', 'n');
   $query->join('field_data_field_event_end_date', 'd', 'd.entity_id = n.nid');
   $query->fields('n', array('nid'));
   $query->condition('n.type', 'event', '=');
   $query->condition('d.field_event_end_date_value', $currentDate, '<');
   $query->orderBy('d.field_event_end_date_value', 'DESC');
   $query->range($startIdx, $limit);
   $result = $query->execute();
   
   return buildEventList($result);
}

/**
 * Returns list of upcoming event
 * params: $currentDate (str), $startIdx (int), $limit (int)
 */
function get_upcoming_events($currentDate, $startIdx, $limit) {   
   // Fetch upcoming event records
   $query = db_select('node', 'n');
   $query->leftJoin('field_data_field_event_start_date', 'd', 'd.entity_id = n.nid');
   $query->leftJoin('field_data_field_event_end_date', 'ed', 'ed.entity_id = n.nid');
   $query->fields('n', array('nid'));
   $query->condition('n.type', 'event', '=');
   $query->condition('d.field_event_start_date_value', $currentDate, '>=');
   $query->orderBy('d.field_event_start_date_value, ed.field_event_end_date_value, n.nid', 'ASC');
   $query->range($startIdx, $limit);
   $result = $query->execute();
   
   return buildEventList($result);
}

/**
 * Builds and returns list of event
 * param: $result (obj)
 */
function buildEventList($result) {
   $eventList = array();
   
   while ($record = $result->fetchAssoc()) {
      $event = node_load($record['nid']);
      $imageInfo = get_obj_field_img_info($event, 'field_event_cover_image');
      $date = [];
      $time = [];
      $startDate = format_obj_field_date_value($event, 'field_event_start_date', 'j M Y');
      $endDate = format_obj_field_date_value($event, 'field_event_end_date', 'j M Y');
      $startTime = $endTime = null;
      
      if ($startDate != '') {
         $date[] = $startDate;
         $time[] = get_obj_field_time_format_gia($event, 'field_event_start_date');
         $startTime = get_obj_field_time_format_gia($event, 'field_event_start_date');
      }
      
      if ($endDate != '') {
         if ($startDate != $endDate) {
            $date[] = $endDate;
         }
         $time[] = get_obj_field_time_format_gia($event, 'field_event_end_date');
         $endTime = get_obj_field_time_format_gia($event, 'field_event_end_date');
      }
      
      $date = implode(' - ', $date);
      
      if ($startTime == $endTime) {
         $time = array_pop($time);
      } else {
         $time = implode(' - ', $time);
      }
      
      $eventList[] = array(
         'nid' => $event->nid,
         'title' => $event->title,
         'date' => $date,
         'time' => $time,
         'shortIntroDescription' => get_obj_field_value($event, 'field_event_short_intro_desc'),
         'coverImageUrl' => $imageInfo['url'],
         'coverImageAlt' => $imageInfo['alt'],
         'coverImageTitle' => $imageInfo['title'],
         'start_datetime' => $event->field_event_start_date['und'][0]['value'],
         'end_datetime' => $event->field_event_end_date['und'][0]['value'],
      );
   }
   
   return $eventList;
}

/**
 * Returns number of filtered event records
 * params: $currentDate (str), $operator (str), $field (str)
 */
function get_filtered_events_count($currentDate, $operator, $field) {   
   $fieldTable = 'field_data_' . $field;
   $fieldName = 'd.' . $field . '_value';

   // Fetch past event records
   $query = db_select('node', 'n');
   $query->join($fieldTable, 'd', 'd.entity_id = n.nid');
   $query->fields('n', array('nid'));
   $query->condition('n.type', 'event', '=');
   $query->condition($fieldName, $currentDate, $operator);
   $query->orderBy($fieldName, 'DESC');
   return $query->execute()->rowCount();
}

/**
 * Event detail page data
 */
function event_detail_page($nid) {
   $data = array();
   
   // Get event details
   $event = node_load($nid);
   $data['eventDetails'] = array(
      'nid' => $event->nid,
      'title' => $event->title,
      'introDescription' => get_obj_field_value($event, 'field_event_intro_description'),
      'description' => get_obj_field_value($event, 'field_event_description'),
      'bottomDescription' => get_obj_field_value($event, 'field_event_bottom_description'),
      'ctaCaption' => get_obj_field_value($event, 'field_event_cta_caption'),
      'email' => get_obj_field_value($event, 'field_event_cta_email'),
      'startDate' => format_obj_field_date_value($event, 'field_event_start_date', 'j M Y'),
      'endDate' => format_obj_field_date_value($event, 'field_event_end_date', 'j M Y'),
      'galleries' => array(),
   );
   
   $imageInfo = get_obj_field_img_info($event, 'field_event_banner_image');
   $data['eventDetails']['bannerImageUrl'] = $imageInfo['url'];
   $data['eventDetails']['bannerImageAlt'] = $imageInfo['alt'];
   $data['eventDetails']['bannerImageTitle'] = $imageInfo['title'];
   
   $imageInfo = get_obj_field_img_info($event, 'field_event_image');
   $data['eventDetails']['eventImageUrl'] = $imageInfo['url'];
   $data['eventDetails']['eventImageAlt'] = $imageInfo['alt'];
   $data['eventDetails']['eventImageTitle'] = $imageInfo['title'];
   
   if (isset($event->field_event_galleries['und']) && $event->field_event_galleries['und']) {
      foreach ($event->field_event_galleries['und'] as $item) {
         $fc = entity_load('field_collection_item', array($item['value']));
         $fc = $fc[$item['value']];
         $imageInfo = get_obj_field_img_info($fc, 'field_event_gallery_image');
         
         $data['eventDetails']['galleries'][] = array(
            'imageUrl' => $imageInfo['url'],
            'imageAlt' => $imageInfo['alt'],
            'imageTitle' => $imageInfo['title'],
            'caption' => get_obj_field_value($fc, 'field_event_gallery_caption'),
         );
      }
   }

   drupal_add_js(drupal_get_path('theme', 'insight') .'/dist/scripts/event.js', [
      'type' => 'file',
      'scope' => 'pageJs',
      'weight' => 1,
   ]);
   
   
   return $data;
}

/**
 * Job overview page callback
 */
function job_overview_page() {
   $data = array('jobList' => array());
   
   // Get job page information
   $pageNode = get_page_info('page_job');
   if ($pageNode) {
      $data['pageTitle']= ltrim($pageNode->title, 'Page -');
      $data['bannerSlogan'] = get_obj_field_value($pageNode, 'field_jp_banner_slogan');
      $data['introSectionTitle'] = get_obj_field_value($pageNode, 'field_jp_intro_section_title');      
      $data['introSectionContent'] = get_obj_field_value($pageNode, 'field_jp_intro_section_content');
      $data['advertisementTitle'] = get_obj_field_value($pageNode, 'field_jp_advertisement_title');
      $data['advertisementContent'] = get_obj_field_value($pageNode, 'field_jp_advertisement_content');
      $data['advertisementEmail'] = get_obj_field_value($pageNode, 'field_jp_advertisement_email');
      
      $imageInfo = get_obj_field_img_info($pageNode, 'field_jp_banner_image');
      $data['bannerImageUrl'] = $imageInfo['url'];
      $data['bannerImageAlt'] = $imageInfo['alt'];
      $data['bannerImageTitle'] = $imageInfo['title'];
   }
   
   // Get page number and starting index point for getting job records
   if (isset($_GET['page']) && $_GET['page'] != '') {
      $data['page'] = (int) $_GET['page'];
   } else {
      $data['page'] = 1;
   }
   
   // Get all job list count
   $data['allJobListSize'] = get_content_total_count_by_type('job');
   
   if ($data['allJobListSize'] > 0) {
      // Get list of job
      $limitPerPage = 8;
      $startIdx = ($data['page'] - 1) * $limitPerPage;
      $data['jobList'] = get_job_list($startIdx, $limitPerPage);
   }

   drupal_add_js(drupal_get_path('theme', 'insight') .'/dist/scripts/jobs.js', [
      'type' => 'file',
      'scope' => 'pageJs',
      'weight' => 1,
   ]);
   
   drupal_add_js([
      'insight' => [
         'jobVars' => [
            'allJobListSize' => $data['allJobListSize']
         ]
      ]
   ], [
      'type' => 'setting'
   ]);
      
   return theme('job_overview_template', $data);
}

/**
 * Partners page callback
 */
function partners_page() {
   $data = array('partnerList' => array());
   
   // Get partners page information
   $pageNode = get_page_info('page_partner');
   if ($pageNode) {
      $data['pageTitle']= str_replace('Page - ', '', $pageNode->title);
      $data['bannerSlogan'] = get_obj_field_value($pageNode, 'field_prp_banner_slogan');
      $data['introTitle'] = get_obj_field_value($pageNode, 'field_prp_intro_title');
      $data['introDescription'] = get_obj_field_value($pageNode, 'field_prp_intro_description');
      
      $imageInfo = get_obj_field_img_info($pageNode, 'field_prp_banner_image');
      $data['bannerImageUrl'] = $imageInfo['url'];
      $data['bannerImageAlt'] = $imageInfo['alt'];
      $data['bannerImageTitle'] = $imageInfo['title'];
   }
   
   // Get list of partner
   $query = db_select('node', 'n');   
   $query->fields('n', array('nid'));
   $query->condition('n.type', 'partnership', '=');
   $query->orderBy('n.nid', 'ASC');
   $result = $query->execute();
   
   while ($record = $result->fetchAssoc()) {
      $partner = node_load($record['nid']);
      $imageInfo = get_obj_field_img_info($partner, 'field_partnership_cover_image');
      
      $data['partnerList'][] = array(
         'nid' => $partner->nid,
         'title' => $partner->title,
         'content' => get_obj_field_value($partner, 'field_partnership_content'),
         'coverImageUrl' => $imageInfo['url'],
         'coverImageAlt' => $imageInfo['alt'],
         'coverImageTitle' => $imageInfo['title'],
         'isLive' => get_obj_field_value($partner, 'field_partnership_is_live'),
      );
   }
   
   drupal_add_js(drupal_get_path('theme', 'insight') .'/dist/scripts/partners.js', [
      'type' => 'file',
      'scope' => 'pageJs',
      'weight' => 1,
   ]);
   
   return theme('partners_template', $data);
}

/**
 * Internship page callback
 */
function internships_page() {
   $data = array('galleries' => array(), 'companies' => array());
   
   // Get internship page information
   $pageNode = get_page_info('page_internship');
   if ($pageNode) {
      $data['pageTitle']= ltrim($pageNode->title, 'Page -');
      $data['bannerSlogan'] = get_obj_field_value($pageNode, 'field_ip_banner_slogan');
      $data['introTitle'] = get_obj_field_value($pageNode, 'field_ip_intro_title');      
      $data['introDescription'] = get_obj_field_value($pageNode, 'field_ip_intro_description');
      $data['advertisementTitle'] = get_obj_field_value($pageNode, 'field_ip_advertisement_title');
      $data['advertisementContent'] = get_obj_field_value($pageNode, 'field_ip_advertisement_content');
      $data['advertisementEmail'] = get_obj_field_value($pageNode, 'field_ip_advertisement_email');
      
      $imageInfo = get_obj_field_img_info($pageNode, 'field_ip_banner_image');
      $data['bannerImageUrl'] = $imageInfo['url'];
      $data['bannerImageAlt'] = $imageInfo['alt'];
      $data['bannerImageTitle'] = $imageInfo['title'];
      
      // Get internship galleries
      if (isset($pageNode->field_internship_galleries['und']) && $pageNode->field_internship_galleries['und']) {
         foreach ($pageNode->field_internship_galleries['und'] as $item) {
            $fc = entity_load('field_collection_item', array($item['value']));
            $fc = $fc[$item['value']];
            $imageInfo = get_obj_field_img_info($fc, 'field_internship_gallery_image');
            
            $data['galleries'][] = array(
               'imageUrl' => $imageInfo['url'],
               'imageAlt' => $imageInfo['alt'],
               'imageTitle' => $imageInfo['title'],
               'caption' => get_obj_field_value($fc, 'field_internship_gallery_caption'),
            );
         }
      }
      
      // Get internship companies
      if (isset($pageNode->field_internship_companies['und']) && $pageNode->field_internship_companies['und']) {
         foreach ($pageNode->field_internship_companies['und'] as $item) {
            $fc = entity_load('field_collection_item', array($item['value']));
            $fc = $fc[$item['value']];
            $imageInfo = get_obj_field_img_info($fc, 'field_internship_company_image');
            
            $data['companies'][] = array(
               'imageUrl' => $imageInfo['url'],
               'imageAlt' => $imageInfo['alt'],
               'imageTitle' => $imageInfo['title'],
               'companyName' => get_obj_field_value($fc, 'field_internship_company_name'),
            );
         }
      }
   }



   drupal_add_js(drupal_get_path('theme', 'insight') .'/dist/scripts/internship.js', [
      'type' => 'file',
      'scope' => 'pageJs',
      'weight' => 1,
   ]);

   
   return theme('internships_template', $data);
}

/**
 * Scholarship page callback
 */
function scholarship_page() {
   $data = array('galleries' => array(), 'contents' => array());
   
   // Get scholarship page information
   $pageNode = get_page_info('page_scholarship');
   if ($pageNode) {
      $data['pageTitle']= ltrim($pageNode->title, 'Page -');
      $imageInfo = get_obj_field_img_info($pageNode, 'field_sp_banner_image');
      $data['bannerImageUrl'] = $imageInfo['url'];
      $data['bannerImageAlt'] = $imageInfo['alt'];
      $data['bannerImageTitle'] = $imageInfo['title'];
      $data['bannerSlogan'] = get_obj_field_value($pageNode, 'field_sp_banner_slogan');   
      
      // Get scholarship contents
      if (isset($pageNode->field_sp_contents['und']) && $pageNode->field_sp_contents['und']) {
         foreach ($pageNode->field_sp_contents['und'] as $item) {
            $fc = entity_load('field_collection_item', array($item['value']));
            $fc = $fc[$item['value']];
            
            $data['contents'][] = array(
               'title' => get_obj_field_value($fc, 'field_sp_content_title'),
               'content' => get_obj_field_value($fc, 'field_sp_content'),
            );
         }
      }
      
      // Get scholarship galleries
      if (isset($pageNode->field_scholarship_galleries['und']) && $pageNode->field_scholarship_galleries['und']) {
         foreach ($pageNode->field_scholarship_galleries['und'] as $item) {
            $fc = entity_load('field_collection_item', array($item['value']));
            $fc = $fc[$item['value']];
            $imageInfo = get_obj_field_img_info($fc, 'field_scholar_gallery_image');
            
            $data['galleries'][] = array(
               'imageUrl' => $imageInfo['url'],
               'imageAlt' => $imageInfo['alt'],
               'imageTitle' => $imageInfo['title'],
               'caption' => get_obj_field_value($fc, 'field_scholar_gallery_caption'),
            );
         }
      }
   }

   drupal_add_js(drupal_get_path('theme', 'insight') .'/dist/scripts/scholarships.js', [
      'type' => 'file',
      'scope' => 'pageJs',
      'weight' => 1,
   ]);
   
   return theme('scholarship_template', $data);
}

/**
 * Booking page callback
 */
function booking_page($stepno) {
   global $base_url;
   $data = array('courseDetails' => array());
   
   // Get booking page information
   $pageNode = get_page_info('page_booking');
   if ($pageNode) {
      $imageInfo = get_obj_field_img_info($pageNode, 'field_bkp_banner_image');
      $data['bannerImageUrl'] = $imageInfo['url'];
      $data['bannerImageAlt'] = $imageInfo['alt'];
      $data['bannerImageTitle'] = $imageInfo['title'];
      $data['bannerSlogan'] = get_obj_field_value($pageNode, 'field_bkp_banner_slogan');
   }
   
   // Get selected course information
   if (isset($_GET['course']) && $_GET['course'] != '') {
      if (isset($_GET['bookschedule']) && $_GET['bookschedule'] != '') {
         // Get course duration title
         $courseDurationTitle = get_field_collection_field_value($_GET['bookschedule'], 'field_cdur_duration_title');
         
         if ($courseDurationTitle != '') {
            $courseDetails = get_course_main_info($_GET['course']);
            
            // Check if course duration id belongs to selected course
            if (isset($courseDetails['durationIdList']) && in_array($_GET['bookschedule'], $courseDetails['durationIdList'])) {
               $courseDetails['feeCurrency'] = get_field_collection_field_value($_GET['bookschedule'], 'field_cdur_tuition_fee_currency');
               $courseDetails['totalFee'] = get_field_collection_field_value($_GET['bookschedule'], 'field_cdur_tuition_fee');
               $courseDetails['durationTitle'] = $courseDurationTitle;
               $courseDetails['durationDate'] = get_field_collection_field_value($_GET['bookschedule'], 'field_cdur_date');
               $data['courseDetails'] = $courseDetails;
            }
         }
      }
   }
   
   
   // Redirect to registration page if course does not exist. Also if course duration not exist.
   if (! isset($data['courseDetails']['title'])) {
      drupal_goto('short-courses');
   }
   
   drupal_add_js([
      'insight' => [
         'booking' => [
            'courseTotalFee' => $data['courseDetails']['totalFee'],
         ]
      ]
   ], [
      'type' => 'setting'
   ]);
   
   drupal_add_js(drupal_get_path('theme', 'insight') .'/dist/scripts/booking.js', [
      'type' => 'file',
      'scope' => 'pageJs',
      'weight' => 1,
   ]);
   
   // Step to process
   switch ($stepno) {
      case 1:
         // Step 1 - Registration
         return booking_registration($data, $pageNode);
      case 2:
         // Step 2 - Payment
         return booking_payment($data, $pageNode);
      case 3:
         // Step 3 - Confirmation
         return booking_confirmation($data, $pageNode);
      default:
         // Step 1 - Registration
         return booking_registration($data, $pageNode);
   }
}

/**
* Returns main information of a course
* param: $nid (int)
*/
function get_course_main_info($nid) {
   $course = array('nid' => $nid);
   $node = node_load($nid);
   
   if ($node && $node->type == 'course') {
      if (isset($node->field_c_subject['und'])) {
         $subject = taxonomy_term_load($node->field_c_subject['und'][0]['tid']);
         $course['subject'] = $subject->name;
      } else {
         $course['subject'] = '';
      }
      
      $imageInfo = get_obj_field_img_info($node, 'field_c_cover_image');
      $course['coverImageUrl'] = $imageInfo['url'];
      $course['coverImageAlt'] = $imageInfo['alt'];
      $course['coverImageTitle'] = $imageInfo['title'];
      $course['title'] = $node->title;
      $course['description'] = get_obj_field_value($node, 'field_c_description');
      $course['startDate'] = format_obj_field_date_value($node, 'field_c_start_date', 'j M Y');
      $course['startDateDM'] = format_obj_field_date_value($node, 'field_c_start_date', 'j F');
      $course['duration'] = get_obj_field_value($node, 'field_c_duration');
      
      $course['durationIdList'] = [];
      if (isset($node->field_c_duration_list['und']) && $node->field_c_duration_list['und']) {
         foreach ($node->field_c_duration_list['und'] as $item) {
            $course['durationIdList'][] = $item['value'];
         }
      }
   }
   
   return $course;
}

/**
* Page booking registration process
* param: $data (arr)
*/
function booking_registration($data, $pageNode) {
   global $base_url;
   
   // Clicking 'Proceed to payment' button
   if (isset($_POST['isSaveRegistration']) && $_POST['isSaveRegistration'] == 1) {
      $data['messages'] = [];
      $data['messages']['error'] = validateRegistration();
      
      if (! $data['messages']['error']) {
         $registrationNid = saveNewRegistration($data);
         
         if ($registrationNid != NULL) {
            $options = array('query' => array(
                  'course' => $_GET['course'], 
                  'bookschedule' => $_GET['bookschedule'], 
                  'registration' => $registrationNid
            ));
         
            // Generate the booking step 2 url for the registrations email url
            // to be use for the cron job         
            $regObj = node_load($registrationNid);
            $segment = [
               "course={$_GET['course']}", 
               "bookschedule={$_GET['bookschedule']}", 
               "registration={$registrationNid}",
            ];
            
            $regObj->field_registration_email_url['und'][0]['value'] = $base_url. '/booking/2?' . implode('&', $segment);
            node_save($regObj);
            
            drupal_goto('booking/2', $options);
         } else {
            $data['messages']['error'] = [t('Failed to register.')];
         }
      }
   }
   
   drupal_add_js('https://www.google.com/recaptcha/api.js', [
      'type' => 'external',
      'scope' => 'recaptcha',
      'weight' => 1,
   ]);
   
   if ($pageNode) {
      $data['registrationContent1'] = get_obj_field_value($pageNode, 'field_bkp_registration_content1');
      $data['registrationContent2'] = get_obj_field_value($pageNode, 'field_bkp_registration_content2');
      $data['termConditionFile'] = get_obj_field_file_info($pageNode, 'field_bkp_term_condition_file');
   }
   
   return theme('booking_registration_template', $data);
}

/**
* Creates new node entity
* param: $data (arr)
*/
function saveNewRegistration($data) {
   global $user;
   $values = array(
      'type' => 'registrations', // machine name of content type: Registrations
      'uid' => $user->uid,
      'status' => 1,
      'comment' => 1,
      'promote' => 0,
   );   
   $durationTitleDate = isset($data['courseDetails']['durationTitle']) ? '[' . $data['courseDetails']['durationTitle'] . '] ' : '';
   $durationTitleDate .= isset($data['courseDetails']['durationDate']) ? $data['courseDetails']['durationDate'] : '';

   $entity = entity_create('node', $values);
   $ewrapper = entity_metadata_wrapper('node', $entity);
   $ewrapper->title->set($_POST['firstname'].' '.$_POST['surname']);
   $ewrapper->field_registration_course->set(intval($_GET['course']));
   $ewrapper->field_registration_course_dur_id->set(intval($_GET['bookschedule']));
   $ewrapper->field_registration_course_dur_tx->set($durationTitleDate);
   $ewrapper->field_registration_first_name->set($_POST['firstname']);
   $ewrapper->field_registration_last_name->set($_POST['surname']);
   $ewrapper->field_registration_email->set($_POST['email']);
   $ewrapper->field_registration_contact_no->set($_POST['phoneno']);
   $ewrapper->field_registration_occupation->set($_POST['occupation']);
   $ewrapper->field_registration_status->set(0); // Pending
   $ewrapper->field_registration_has_reminded->set(0); // No   
   $ewrapper->field_registration_is_paid->set(0); // No   
   $dt = format_date(strtotime('now'), 'custom', 'Y-m-d H:i:s', 'UTC');
   $dt = str_replace(' ', 'T', $dt);
   $entity->field_registration_date[LANGUAGE_NONE][0] = array(
      'value' => $dt,
      'timezone' => 'UTC',
      'timezone_db' => 'UTC',
   );
   
   $ewrapper->save();
   return $ewrapper->getIdentifier();
}

/**
* Booking registration form validation
*/
function validateRegistration() {
   $errors = array();
   
   if (isset($_POST['firstname']) && $_POST['firstname'] == '')  {
      $errors[] = t('Please specify the firstname.');
   }
   
   if (isset($_POST['surname']) && $_POST['surname'] == '')  {
      $errors[] = t('Please specify the surname.');
   }
   
   if (isset($_POST['email']) && $_POST['email'] == '')  {
      $errors[] = t('Please specify the email.');
   }
   
   if (isset($_POST['phoneno']) && $_POST['phoneno'] == '')  {
      $errors[] = t('Please specify the phone number.');
   }
   
   // Check recaptcha
   $verifyUrl = 'https://www.google.com/recaptcha/api/siteverify';
   $data = [
      'secret' => '6LdkLzcUAAAAANrA_gY5N_fVQIEoAv_Mtl3Jua5j',
      'response' => $_POST['g-recaptcha-response'],
   ];
   
   $options = [
      'http' => [
         'method' => 'POST',
         'header' => 'Content-Type: application/x-www-form-urlencoded',
         'content' => http_build_query($data)
      ]
   ];
   
   $context  = stream_context_create($options);   
   $verify = file_get_contents($verifyUrl, false, $context);
   $captchaResponse = json_decode($verify);
   
   if (! $captchaResponse->success) {
      $errors[] = t('Recaptcha is required.');
   }
   
   return $errors;
}

/**
* Page booking payment process
* param: $data (arr)
*/
function booking_payment($data, $pageNode) {   

   if (isset($_GET['registration']) && $_GET['registration'] != '') {
      $registration = node_load($_GET['registration']);
      
      if ($registration) {
         
         if (isset($_POST['is_bank_transfer']) && ($_POST['is_bank_transfer'] == 1)) {
            // Bank Transfer payment
            if ($registration->field_registration_course['und'][0]['target_id'] == $_GET['course']) {
               $users = entity_load('user');
               $adminEmails = [];
               
               // List all administrator emails
               foreach ($users as $user) {
                  
                  if (in_array('administrator', $user->roles)) {
                     $adminEmails[] = $user->mail;
                  }
                  
               }
               
               //$adminEmails[] = get_obj_field_value($registration, 'field_registration_email');
               
               // Send successfull Registration email
               $a = drupal_mail('custom', 'registration-bank-transfer', get_obj_field_value($registration, 'field_registration_email'), language_default(), [
                  'ref_no' => $registration->nid,
                  'instruction' => get_obj_field_value($pageNode, 'field_bkp_bank_transfer_note'),
                  'bank_code' => get_obj_field_value($pageNode, 'field_bkp_bank_code'),
                  'bank_name' => get_obj_field_value($pageNode, 'field_bkp_bank_name'),
                  'bank_address' => get_obj_field_value($pageNode, 'field_bkp_bank_address'),
                  'account_number' => get_obj_field_value($pageNode, 'field_bkp_account_number'),
                  'account_name' => get_obj_field_value($pageNode, 'field_bkp_account_name'),
                  'swift_code' => get_obj_field_value($pageNode, 'field_bkp_swift_code'),
                  'name' => $registration->title,
                  'email' => get_obj_field_value($registration, 'field_registration_email'),
                  'firstName' => get_obj_field_value($registration, 'field_registration_first_name'),
                  'lastName' => get_obj_field_value($registration, 'field_registration_last_name'),
                  //'subject' => 'Bank Transfer Registration Details',
               ]);
            
               $registration->field_registration_status['und'][0]['value'] = 2; // Update status to bank transfer
               node_save($registration);
               
               // Redirect to booking - confirmation page
               $options = array('query' => array(
                  'course' => $_GET['course'], 
                  'bookschedule' => $_GET['bookschedule'],
                  'registration' => $registration->nid,
               ));
               drupal_goto('booking/3', $options);
            }
            
         } else {
            // Paypal payment
            // Check if the parameter course id is linked with the registration
            if ($registration->field_registration_course['und'][0]['target_id'] == $_GET['course']) {
               // Redirect to booking - confirmation page if registration is already paid
               if (get_obj_field_value($registration, 'field_registration_status') > 0) { // 0-Pending
                  $options = array('query' => array(
                     'course' => $_GET['course'], 
                     'bookschedule' => $_GET['bookschedule'],
                     'registration' => $registration->nid,
                  ));
                  drupal_goto('booking/3', $options);
               }
               
               // Get appropriate message according to payment status
               // Payment status is returned from paypal payment
               if (isset($_GET['paymentStatus'])) {
                  $data['messages'] = [];
                  
                  if ($_GET['paymentStatus'] == 'Failed') {
                     $data['messages']['error'] = [t('Failed to received the payment.')];
                  } else if (preg_match("/Pending|Pending_Under_Review/", $_GET['paymentStatus'])) {
                     $data['messages']['warning'] = [t('Your payment is not yet validated, please wait.')];
                  }
               }
               
               // Get bank and account information
               if ($pageNode) {
                  $data['bankCode'] = get_obj_field_value($pageNode, 'field_bkp_bank_code');
                  $data['bankName'] = get_obj_field_value($pageNode, 'field_bkp_bank_name');
                  $data['bankAddress'] = get_obj_field_value($pageNode, 'field_bkp_bank_address');
                  $data['accountNumber'] = get_obj_field_value($pageNode, 'field_bkp_account_number');
                  $data['accountName'] = get_obj_field_value($pageNode, 'field_bkp_account_name');
                  $data['swiftCode'] = get_obj_field_value($pageNode, 'field_bkp_swift_code');
                  $data['bankTransferNote'] = get_obj_field_value($pageNode, 'field_bkp_bank_transfer_note');
                  $data['paypalNotice'] = get_obj_field_value($pageNode, 'field_bkp_payment_content');
               }
               
               $data['courseDetails']['registeredBy'] = $registration->nid;
               return theme('booking_payment_template', $data);
            }
         
         }
         
      }
   }
   
   // Redirect to registration page if no registration id pass
   $options = array('query' => array('course' => $_GET['course']));
   drupal_goto('booking/1', $options);
}

/**
* Page booking confirmation process
* param: $data (arr)
*/
function booking_confirmation($data, $pageNode) {
   if (isset($_GET['registration']) && $_GET['registration'] != '') {
      $registration = node_load($_GET['registration']);
      
      if ($registration) {
         
         
         // Check if the parameter course id is linked with the registration
         if ($registration->field_registration_course['und'][0]['target_id'] == $_GET['course']) {
            // Redirect to booking - payment page if registration is not yet paid
            if (get_obj_field_value($registration, 'field_registration_status') == 0) { // 0-Pending
               $options = array('query' => array(
                     'course' => $_GET['course'], 
                     'bookschedule' => $_GET['bookschedule'], 
                     'registration' => $registration->nid,
               ));
               drupal_goto('booking/2', $options);
            }
   
            // Fetch related courses
            $data['relatedShortCourses'] = array();
            
            $selectedCourse = node_load($registration->field_registration_course['und'][0]['target_id']);
       
            if (isset($selectedCourse->field_bkp_related_courses['und']) && $selectedCourse->field_bkp_related_courses['und']) {
               foreach ($selectedCourse->field_bkp_related_courses['und'] as $item) {
                  $data['relatedShortCourses'][] = get_course_main_info($item['target_id']);
               }
            }
            
            /* if (isset($pageNode->field_bkp_related_courses['und']) && $pageNode->field_bkp_related_courses['und']) {
               foreach ($pageNode->field_bkp_related_courses['und'] as $item) {
                  $data['relatedShortCourses'][] = get_course_main_info($item['target_id']);
               }
            } */
            
            $data['registrationStatus'] = get_obj_field_value($registration, 'field_registration_status');
            $data['registrationContent3'] = get_obj_field_value($pageNode, 'field_bkp_registration_content_3');
            $data['confirmMsgPaypal'] = get_obj_field_value($pageNode, 'field_bkp_confirm_msg_paypal');
            $data['confirmMsgBankTranfer'] = get_obj_field_value($pageNode, 'field_bkp_confirm_msg_bt');

            return theme('booking_confirmation_template', $data);
         }
      }
   }
   
   // Redirect to registration page if no registration id pass
   $options = array('query' => array('course' => $_GET['course']));
   drupal_goto('booking/1', $options);
}

/**
 * About page callback
 */
function about_page() {
   $data = array();
   
   // Get about page information
   $pageNode = get_page_info('page_about_us');
   if ($pageNode) {
      $data['pageTitle']= ltrim($pageNode->title, 'Page -');
      $imageInfo = get_obj_field_img_info($pageNode, 'field_aup_banner_image');
      $data['bannerImageUrl'] = $imageInfo['url'];
      $data['bannerImageAlt'] = $imageInfo['alt'];
      $data['bannerImageTitle'] = $imageInfo['title'];
      $data['bannerSlogan'] = get_obj_field_value($pageNode, 'field_aup_banner_slogan');
      $data['sectionTitle'] = get_obj_field_value($pageNode, 'field_aup_section_title');
      $data['sectionContent'] = get_obj_field_value($pageNode, 'field_aup_section_content');
      $data['placeSectionTitle'] = get_obj_field_value($pageNode, 'field_aup_place_section_title');
      $data['placeSectionContent'] = get_obj_field_value($pageNode, 'field_aup_place_section_content');
      $data['featureVideoClip'] = get_obj_field_value($pageNode, 'field_aup_feature_video_clip');
      
      $imageInfo = get_obj_field_img_info($pageNode, 'field_aup_video_clip_cover_img');
      $data['featureVideoClipImgUrl'] = $imageInfo['url'];
      $data['featureVideoClipImgAlt'] = $imageInfo['alt'];
      $data['featureVideoClipImgTitle'] = $imageInfo['title'];
      
      $imageInfo = get_obj_field_img_info($pageNode, 'field_aup_feature_image');
      $data['featureImageUrl'] = $imageInfo['url'];
      $data['featureImageAlt'] = $imageInfo['alt'];
      $data['featureImageTitle'] = $imageInfo['title'];
      
      // Get place images
      if (isset($pageNode->field_aup_place_images['und']) && $pageNode->field_aup_place_images['und']) {
         foreach ($pageNode->field_aup_place_images['und'] as $item) {
            $fc = entity_load('field_collection_item', array($item['value']));
            $fc = $fc[$item['value']];
            $imageInfo = get_obj_field_img_info($fc, 'field_place_image');
            
            $data['placeImages'][] = array(
               'imageUrl' => $imageInfo['url'],
               'imageAlt' => $imageInfo['alt'],
               'imageTitle' => $imageInfo['title'],
               'caption' => get_obj_field_value($fc, 'field_place_image_caption'),
            );
         }
      }
   }

   drupal_add_js(drupal_get_path('theme', 'insight') .'/dist/scripts/about-us.js', [
      'type' => 'file',
      'scope' => 'pageJs',
      'weight' => 1,
   ]);
   
   return theme('about_template', $data);
}

/**
* Returns long course details
* 
* @param int $nid
* @return array
*/
function long_course($nid) {
   $course = node_load($nid);
   
   if (!$course) {
      return false;
   }
   
   drupal_add_js(drupal_get_path('theme', 'insight') .'/dist/scripts/long-course.js', [
      'type' => 'file',
      'scope' => 'pageJs',
      'weight' => 3,
   ]);
   
   $data = [];
   $subject = taxonomy_term_load($course->field_c_subject['und'][0]['tid']);
   $courseType = taxonomy_term_load($course->field_c_course_type['und'][0]['tid']);
   
   if ($subject) {
      $data['subjectName'] = $subject->name;
   }
   
   $data['courseNid'] = $course->nid;
   $data['courseType'] = $courseType->name;
   $data['title'] = $course->title;
   $data['description'] = get_obj_field_value($course, 'field_c_description');
   $data['detailsOverview'] = get_obj_field_value($course, 'field_c_details_overview');
   $data['durationDescription'] = get_obj_field_value($course, 'field_c_duration');
   $data['syllabus'] = get_obj_field_file_info($course, 'field_c_syllabus');
   $data['coverImage'] = get_obj_field_img_info($course, 'field_c_cover_image');
   $data['bannerImage'] = get_obj_field_img_info($course, 'field_aup_banner_image');
   $data['startDate'] = get_obj_field_date_formatted($course, 'field_c_start_date', 'j F Y');
   $data['endDate'] = get_obj_field_date_formatted($course, 'field_c_end_data', 'j F Y');
   $data['overrideDuration'] = get_obj_field_value($course, 'field_c_override_duration');
   $data['overrideFee'] = get_obj_field_value($course, 'field_c_override_fee');
   
   // Get staffs
   $data['staffs'] = [];
   
   if (isset($course->field_c_staffs['und']) && $course->field_c_staffs['und']) { 
      
      foreach ($course->field_c_staffs['und'] as $staff) {
          $data['staffs'][] = prepare_staff_details($staff['entity']);
      }
      
   }
   
   // Get duration list and enquire details
   $data['durationList'] = [];
   $data['enquireDetails'] = [];
   
   if (isset($course->field_c_long_duration_list['und']) && $course->field_c_long_duration_list['und']) {
      foreach ($course->field_c_long_duration_list['und'] as $item) {
         $fc = entity_load('field_collection_item', array($item['value']));
         $fc = $fc[$item['value']];
         $durationTitle = get_obj_field_value($fc, 'field_lcdur_duration_title');
         $durationDate = get_obj_field_value($fc, 'field_lcdur_date');
         
         $data['durationList'][] = [
            'grpid' => $item['value'],
            'title' => $durationTitle,
            'date' => $durationDate,
            'line1' => get_obj_field_value($fc, 'field_lcdur_line1'),
            'line2' => get_obj_field_value($fc, 'field_lcdur_line2'),
            'line3' => get_obj_field_value($fc, 'field_lcdur_line3'),
            'schoolCalendar' => get_obj_field_file_info($fc, 'field_lcdur_school_calendar'),
            'isHideDate' => get_obj_field_value($fc, 'field_lcdur_is_hide_date'),
         ];
                  
         $data['enquireDetails'][$durationTitle][] = $durationDate;
      }
   }
   
   // Get Progression
   $data['progression'] = [
      'description' => get_obj_field_value($course, 'field_c_progression_description'),
      'desktopImage' => get_obj_field_img_info($course, 'field_c_progression_desk_image'),
      'mobileImage' => get_obj_field_img_info($course, 'field_c_progression_mobile_image'),
   ];
   
   // Get Requirements
   $data['requirements'] = [];
   
   if (isset($course->field_c_requirements['und']) && $course->field_c_requirements['und']) {
      
      foreach ($course->field_c_requirements['und'] as $item) {
         
         if ($item['value']) { 
            $data['requirements'][] = $item['value'];
         }
         
      }
   }
   
   $data['totalFeeCurrency'] = get_obj_field_value($course, 'field_c_tuition_total_fee_cur');
   $data['totalFee'] = get_obj_field_value($course, 'field_c_tuition_total_fee');
   $data['totalFeeNote'] = get_obj_field_value($course, 'field_c_tuition_total_fee_note');
   $data['earlyBirdFee'] = get_obj_field_value($course, 'field_c_tuition_early_bird_fee');
   $data['earlyBirdFeeNote'] = get_obj_field_value($course, 'field_c_tuition_early_bird_note');
   
   // Get Installment Info
   $data['installmentInfo'] = [];
   
   if (isset($course->field_c_installment_info['und']) && $course->field_c_installment_info['und']) {
      
      foreach ($course->field_c_installment_info['und'] as $item) {
         
         if ($item['value']) { 
            $data['installmentInfo'][] = $item['value'];
         }
         
      }
   }
   
   // Get Student Works
   $data['studentWorks'] = [];
   
   if (isset($course->field_c_student_works['und']) && $course->field_c_student_works['und']) { 
      
      foreach ($course->field_c_student_works['und'] as $studentWork) {
          $data['studentWorks'][] = prepare_student_work_details($studentWork['entity']);
      }
      
   }
   
   $data['feedback'] = get_obj_field_value($course, 'field_c_student_feedback');
   
   // Get Graduate
   $data['graduates'] = [];
   
   if (isset($course->field_c_graduates['und']) && $course->field_c_graduates['und']) { 
      
      foreach ($course->field_c_graduates['und'] as $graduate) {
          $data['graduates'][] = prepare_graduate_details($graduate['entity']);
      }
      
   }
   
   // Get student feedbacks
   $data['studentFeedbacks'] = [];
   
   if (isset($course->field_c_student_feedbacks['und']) && $course->field_c_student_feedbacks['und']) {
      
      foreach ($course->field_c_student_feedbacks['und'] as $feedBack) {
         $fc = entity_load('field_collection_item', array($feedBack['value']));
         $fc = $fc[$feedBack['value']];
         
         $data['studentFeedbacks'][] = [
            'content' => get_obj_field_value($fc, 'field_sf_feedback_content'),
            'studentName' => get_obj_field_value($fc, 'field_sf_student_name'),
         ];
      }
      
   }
   
   $data['pending'] = get_obj_field_value($course, 'field_c_pending');
   
   return $data;
}

/**
* Returns short course details
*/
function short_course($nid) {
   $course = node_load($nid);
   $data['formStatus'] = 0;
   
   if (!$course) {
      return false;
   }
   
   drupal_add_js(drupal_get_path('theme', 'insight') .'/dist/scripts/short-course.js', [
      'type' => 'file',
      'scope' => 'pageJs',
      'weight' => 3,
   ]);
   
   $data = [];
   
   if (isset($course->field_c_subject['und'])) {
      $subject = taxonomy_term_load($course->field_c_subject['und'][0]['tid']);
      $data['subjectName'] = $subject->name;
   }
   
   $courseType = taxonomy_term_load($course->field_c_course_type['und'][0]['tid']);   
   $data['courseNid'] = $course->nid;
   $data['courseType'] = $courseType->name;
   $data['title'] = $course->title;
   $data['description'] = get_obj_field_value($course, 'field_c_description');
   $data['detailsOverview'] = get_obj_field_value($course, 'field_c_details_overview');
   $data['durationDescription'] = get_obj_field_value($course, 'field_c_duration');
   $data['syllabus'] = get_obj_field_file_info($course, 'field_c_syllabus');
   $data['coverImage'] = get_obj_field_img_info($course, 'field_c_cover_image');
   $data['bannerImage'] = get_obj_field_img_info($course, 'field_aup_banner_image');
   $data['startDate'] = format_obj_field_date_value($course, 'field_c_start_date', 'j F Y');
   $data['endDate'] = format_obj_field_date_value($course, 'field_c_end_data', 'j F Y');
   $data['overrideDuration'] = get_obj_field_value($course, 'field_c_override_duration');
   $data['overrideFee'] = get_obj_field_value($course, 'field_c_override_fee');

   // Get booking
   $data['booking'] = [];
   
   if (isset($course->field_c_booking_schedules['und']) && $course->field_c_booking_schedules['und']) {
      
      foreach ($course->field_c_booking_schedules['und'] as $item) {
         
         if ($item['value']) {
            $data['booking'][] = $item['value'];
         }
         
      }
         
   }
   
   // Get staffs
   $data['staffs'] = [];
   
   if (isset($course->field_c_staffs['und']) && $course->field_c_staffs['und']) { 
      
      foreach ($course->field_c_staffs['und'] as $staff) {
         $staffNode = node_load($staff['target_id']);
         $data['staffs'][] = prepare_staff_details($staffNode);
      }
      
   }
   
   // Get duration list
   $data['durationList'] = [];
   if (isset($course->field_c_duration_list['und']) && $course->field_c_duration_list['und']) {
      foreach ($course->field_c_duration_list['und'] as $item) {
         $fc = entity_load('field_collection_item', array($item['value']));
         $fc = $fc[$item['value']];
         
         $data['durationList'][] = [
            'grpid' => $item['value'],
            'title' => get_obj_field_value($fc, 'field_cdur_duration_title'),
            'date' => get_obj_field_value($fc, 'field_cdur_date'),
            'line1' => get_obj_field_value($fc, 'field_cdur_schedule_weeks'),
            'line2' => get_obj_field_value($fc, 'field_cdur_schedule_days'),
            'line3' => get_obj_field_value($fc, 'field_cdur_schedule_time'),
            'schoolCalendar' => get_obj_field_file_info($fc, 'field_cdur_school_calendar'),
            'isHideDate' => get_obj_field_value($fc, 'field_cdur_is_hide_date'),
            'feeCurrency' => get_obj_field_value($fc, 'field_cdur_tuition_fee_currency'),
            'fee' => get_obj_field_value($fc, 'field_cdur_tuition_fee'),
         ];
      }
   }
   
   // Get Suitability
   $data['suitability'] = [];
   
   if (isset($course->field_c_suitability['und']) && $course->field_c_suitability['und']) {
      
      foreach ($course->field_c_suitability['und'] as $item) {
         
         if ($item['value']) { 
            $data['suitability'][] = $item['value'];
         }
         
      }
   }
   
   $data['totalFeeCurrency'] = get_obj_field_value($course, 'field_c_tuition_total_fee_cur');
   $data['totalFee'] = get_obj_field_value($course, 'field_c_tuition_total_fee');
   $data['totalFeeNote'] = get_obj_field_value($course, 'field_c_tuition_total_fee_note');
   $data['pending'] = get_obj_field_value($course, 'field_c_pending');
   
   // Get student feedbacks
   $data['studentFeedbacks'] = [];
   
   if (isset($course->field_c_student_feedbacks['und']) && $course->field_c_student_feedbacks['und']) {
      
      foreach ($course->field_c_student_feedbacks['und'] as $feedBack) {
         $fc = entity_load('field_collection_item', array($feedBack['value']));
         $fc = $fc[$feedBack['value']];
         
         $data['studentFeedbacks'][] = [
            'content' => get_obj_field_value($fc, 'field_sf_feedback_content'),
            'studentName' => get_obj_field_value($fc, 'field_sf_student_name'),
         ];
      }
      
   }
   
   // Check if user send get notified info
   // Process the request then send to the administrator
   if (($_SERVER['REQUEST_METHOD'] === 'POST') && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
      $response = [];
      $data['messages'] = [];
      $validationResult = validate_get_notified();
      
      if ($validationResult['isValid']) {
         
         $users = entity_load('user');
         $adminEmails = [];
         
         // List all administrator emails
         foreach ($users as $user) {
            
            if (in_array('administrator', $user->roles)) {
               $adminEmails[] = $user->mail;
            }
            
         }
         
         $a = drupal_mail('custom', 'short-course-get-notified', implode(',', $adminEmails), language_default(), array_merge($_POST, [
            //'subject' => 'Short course notify message'
         ]));
         
         $response['messages'] = t('We will notify you once a new date is set for this course.');
         $response['title'] = t('Your message was successfully sent.');
         $response['status'] = 1;
      } else {
         $response['messages'] = $validationResult['msg'];
         $response['title'] = t('Please fill up properly.');
         $response['status'] = -1;
      }
      
      drupal_json_output($response);
      exit;
   }
   
   return $data;
}

/**
 * Validated the short course get notified form
 *
 * @return array
 */
function validate_get_notified() {
   $output = [
      'isValid' => true,
      'msg' => []
   ];
   
   if ($_POST['gn_first_name'] === '') {
      $output['msg'][] = t('First name is required.');
   }
   
   if ($_POST['gn_last_name'] === '') {
      $output['msg'][] = t('Last name is required.');
   }
   
   if ($_POST['gn_email'] === '') {
      $output['msg'][] = t('Email is required.');
   }
   
   if (!empty($output['msg'])) {
      $output['isValid'] = false;
   }
   
   return $output;
}

/**
* Course overview page callback
*/
function course_overview_page() {
   $data = array('shortCourseList' => array(), 'longCourseList' => array());
   
   // Get course overview page information
   $pageNode = get_page_info('page_course_overview');
   if ($pageNode) {
      $data['pageTitle']= ltrim($pageNode->title, 'Page -');
      $imageInfo = get_obj_field_img_info($pageNode, 'field_cp_banner_image');
      $data['bannerImageUrl'] = $imageInfo['url'];
      $data['bannerImageAlt'] = $imageInfo['alt'];
      $data['bannerImageTitle'] = $imageInfo['title'];
      $data['bannerSlogan'] = get_obj_field_value($pageNode, 'field_cp_banner_slogan');
      $data['shortSectionDescription'] = get_obj_field_value($pageNode, 'field_cp_short_section_desc');
      $data['shortSectionLinkText'] = get_obj_field_value($pageNode, 'field_cp_short_section_link_text');
      $data['executiveSectionDescription'] = get_obj_field_value($pageNode, 'field_cp_executive_desc');
      
      $imageInfo = get_obj_field_img_info($pageNode, 'field_cp_executive_image');
      $data['executiveSectionImgUrl'] = $imageInfo['url'];
      $data['executiveSectionImgAlt'] = $imageInfo['alt'];
      $data['executiveSectionImgTitle'] = $imageInfo['title'];
      
      // Get introductory course
      $node = node_load($pageNode->field_cp_introductory_course['und'][0]['target_id']);
      $term = taxonomy_term_load($node->field_c_course_type['und'][0]['tid']);
      $data['introductoryCourse'] = build_course_item($node);
      $data['introductoryCourse']['type'] = $term->name;
      
      // Get featured long courses
      if (isset($pageNode->field_cp_featured_long_courses['und'])  && $pageNode->field_cp_featured_long_courses['und']) {
         foreach ($pageNode->field_cp_featured_long_courses['und'] as $item) {
            $node = node_load($item['target_id']);
            $course = build_course_item($node);
            $course['type'] = 'Long';
            $data['longCourseList'][] = $course;
         }
      }
   } else {
      $data['introductoryCourse']['nid'] = 0;
   }
   
   if (isset($pageNode->field_cp_feature_courses['und']) && !empty($pageNode->field_cp_feature_courses['und'])) {
      
      foreach ($pageNode->field_cp_feature_courses['und'] as $shortCourse) {
         $node = node_load($shortCourse['target_id']);
         $course = build_course_item($node);
         $course['type'] = 'Short';
         $data['shortCourseList'][] = $course;
      }
      
   }
   
   /* // Get 2 latest upcoming short courses.
   // Selected course as introductory course will not be included in the list
   $courseTypeVoc = taxonomy_vocabulary_machine_name_load('course_type');
   if ($courseTypeVoc) {
      $result = query_upcoming_courses_by_type('Short', 2, $courseTypeVoc->vid, $data['introductoryCourse']['nid']);
      
      if ($result) {
         while ($record = $result->fetchAssoc()) {
            $node = node_load($record['nid']);
            $course = build_course_item($node);
            $course['type'] = 'Short';
            $data['shortCourseList'][] = $course;
         }
      }
   } */

   drupal_add_js(drupal_get_path('theme', 'insight') .'/dist/scripts/course.js', [
        'type' => 'file',
        'scope' => 'pageJs',
        'weight' => 1,
    ]);

   return theme('course_overview_template', $data);
}

/**
* Build and returns course main information in an array form
* This function is used by different functions
* param: $course (obj)
*/
function build_course_item($course) {
   $imageInfo = get_obj_field_img_info($course, 'field_c_cover_image');
   return array(
      'nid' => $course->nid,
      'title' => $course->title,
      'description' => get_obj_field_value($course, 'field_c_description'),
      'shortDescription' => get_obj_field_value($course, 'field_c_short_description'),
      'courseOverviewDescription' => get_obj_field_value($course, 'field_short_course_overview_desc'),
      'overview' => get_obj_field_value($course, 'field_c_details_overview'),
      'duration' => get_obj_field_value($course, 'field_c_duration'),
      'coverImageUrl' => $imageInfo['url'],
      'coverImageAlt' => $imageInfo['alt'],
      'coverImageTitle' => $imageInfo['title'],
      'startDate' => format_obj_field_date_value($course, 'field_c_start_date', 'j M Y'),
      'startDateDM' => get_obj_field_date_formatted($course, 'field_c_start_date', 'j F'),
   );
}

/**
* Short course overview page callback
*/
function short_course_overview_page() {   
   $data = array('courseList' => array());
   $data['availableMonth'] = array();
   
   // Get short course overview page information
   $pageNode = get_page_info('page_short_course_overview');
   if ($pageNode) {
      $data['pageTitle']= ltrim($pageNode->title, 'Page -');
      $imageInfo = get_obj_field_img_info($pageNode, 'field_scp_banner_image');
      $data['bannerImageUrl'] = $imageInfo['url'];
      $data['bannerImageAlt'] = $imageInfo['alt'];
      $data['bannerImageTitle'] = $imageInfo['title'];
      $data['bannerSlogan'] = get_obj_field_value($pageNode, 'field_scp_banner_slogan');
      $data['introTitle'] = get_obj_field_value($pageNode, 'field_scp_intro_title');
      $data['introDescription'] = get_obj_field_value($pageNode, 'field_scp_intro_description');
   }
   
   $courseTypeVoc = taxonomy_vocabulary_machine_name_load('course_type');
   if ($courseTypeVoc) {
      $shortCourseTypeId =  get_taxonomy_term_id_by_name('Short', $courseTypeVoc->vid);
      
      if ($shortCourseTypeId > 0) {
         $currentYearMonth = explode("-", date('Y-m'));
         $endYearMonth = date('Y-m', strtotime("+12 months", strtotime(date('Y-m-d'))));
         $endYearMonth = explode("-", $endYearMonth);
         $dtStart = $currentYearMonth[0] . '-' . $currentYearMonth[1] . '-01 00:00:00';
         $dtEnd = $endYearMonth[0] . '-' . $endYearMonth[1] . '-31 23:59:59';
         
         // Fetch not pending short courses 
         $query = db_select('node', 'n');
         $query->join('field_data_field_c_start_date', 'd', 'd.entity_id = n.nid');
         $query->join('field_data_field_c_course_type', 'ct', 'ct.entity_id = n.nid');
         $query->fields('n', array('nid'));
         $query->condition('n.type', 'course', '=');
         $query->condition('d.field_c_start_date_value', $dtStart, '>=');
         $query->condition('d.field_c_start_date_value', $dtEnd, '<=');
         $query->condition('ct.field_c_course_type_tid', $shortCourseTypeId, '=');
         $query->orderBy('d.field_c_start_date_value', 'ASC');
         $result = $query->execute();
         
         while ($record = $result->fetchAssoc()) {
            $node = node_load($record['nid']);      
            $monthNum = format_obj_field_date_value($node, 'field_c_start_date', 'm');
            $year = format_obj_field_date_value($node, 'field_c_start_date', 'Y');      
            $data['courseList'][$year][$monthNum][] = build_course_item($node);
            ksort($data['courseList']); // sort year key in ascending order
            ksort($data['courseList'][$year]); // sort monthNum key in ascending order
            if(!in_array($monthNum, $data['availableMonth'], true)){
               array_push($data['availableMonth'], $monthNum);
            }
         }
         
         // Fetch pending short courses
         $query = db_select('node', 'n');
         $query->leftJoin('field_data_field_c_start_date', 'd', 'd.entity_id = n.nid');
         $query->join('field_data_field_c_course_type', 'ct', 'ct.entity_id = n.nid');
         $query->fields('n', array('nid'));
         $query->condition('n.type', 'course', '=');
         $query->condition('ct.field_c_course_type_tid', $shortCourseTypeId, '=');
         $query->isNull('d.field_c_start_date_value');
         $query->orderBy('n.title', 'ASC');
         $result = $query->execute();
         
         while ($record = $result->fetchAssoc()) {
            $node = node_load($record['nid']);
            $data['courseList'][10000][0][] = build_course_item($node);
         }
      }
   }

   $data['monthList'] = get_month_names();
   
   drupal_add_js(drupal_get_path('theme', 'insight') .'/dist/scripts/short-course-overview.js', [
        'type' => 'file',
        'scope' => 'pageJs',
        'weight' => 1,
    ]);
    
   return theme('short_course_overview_template', $data);
}

/**
* Student Work page callback
*/
function student_work_page() {
   $data = array(
      'allResProjListSize' => 0,
      'allComProjListSize' => 0,
      'residentialProjects' => array(), 
      'commercialProjects' => array()
   );
   
   // Get student work page information
   $pageNode = get_page_info('page_student_work');
   if ($pageNode) {
      $data['pageTitle']= ltrim($pageNode->title, 'Page -');
      $imageInfo = get_obj_field_img_info($pageNode, 'field_swp_banner_image');
      $data['bannerImageUrl'] = $imageInfo['url'];
      $data['bannerImageAlt'] = $imageInfo['alt'];
      $data['bannerImageTitle'] = $imageInfo['title'];
      $data['bannerSlogan'] = get_obj_field_value($pageNode, 'field_swp_banner_slogan');
      $data['introTitle'] = get_obj_field_value($pageNode, 'field_swp_intro_title');
      $data['introDescription'] = get_obj_field_value($pageNode, 'field_swp_intro_description');
      $data['submitProjectTitle'] = get_obj_field_value($pageNode, 'field_swp_submit_project_title');
      $data['submitProjectDescription'] = get_obj_field_value($pageNode, 'field_swp_project_description');
   }
   
   $categories = get_student_work_categories(); // Get student work category list
   
   foreach ($categories as $tid => $name) {
      if ($name == 'Residential Interior Design Projects') {
         // Get 6 residential interior design projects as initial display
         $data['residentialProjects'] = get_project_list_by_category($tid, 0, 3);
         $data['allResProjListSize'] = get_total_project_count_by_category($tid);
         
      } else if ($name == 'Commercial Interior Design Projects') {
         // Get 6 commercial interior design projects as initial display
         $data['commercialProjects'] = get_project_list_by_category($tid, 0, 3);
         $data['allComProjListSize'] = get_total_project_count_by_category($tid);
      }
   }

   drupal_add_js(drupal_get_path('theme', 'insight') .'/dist/scripts/student-works.js', [
      'type' => 'file',
      'scope' => 'pageJs',
      'weight' => 1,
   ]);

   drupal_add_js([
      'insight' => [
         'studentWorkVars' => [
            'allResProjListSize' => $data['allResProjListSize'],
            'allComProjListSize' => $data['allComProjListSize']
         ]
      ]
   ], [
      'type' => 'setting'
   ]);
   
   return theme('student_work_template', $data);
}

/** 
* Returns student work category list
*/
function get_student_work_categories() {
   $categories = array();
   $studentWorkCategoryVoc = taxonomy_vocabulary_machine_name_load('student_work_categories');
   
   // Fetch student work categories
   if ($studentWorkCategoryVoc) {
      $query = db_select('taxonomy_term_data', 't');
      $query->fields('t', array('tid', 'name'));
      $query->condition('t.vid', $studentWorkCategoryVoc->vid, '=');
      $result = $query->execute();
      
      while ($rec = $result->fetchAssoc()) {
         $categories[$rec['tid']] = $rec['name'];
      }   
   } else {
      drupal_get_messages('status');
      drupal_set_message("Taxonomy vocabulary 'Student Work Categories' is not yet created", 'error');
   }
   
   return $categories;
}

function executive_course_overview_page() {
   // Get executive course overview page information
   $pageNode = get_page_info('page_executive_course_overview');
   $data = ['courseList' => array()];
   
   if ($pageNode) {
      $imageInfo = get_obj_field_img_info($pageNode, 'field_eco_cover_image');
      $data['bannerImageUrl'] = $imageInfo['url'];
      $data['bannerImageAlt'] = $imageInfo['alt'];
      $data['bannerImageTitle'] = $imageInfo['title'];      
      $data['bannerSlogan'] = get_obj_field_value($pageNode, 'field_eco_slogan');
      $data['introTitle'] = get_obj_field_value($pageNode, 'field_eco_intro_text');
      $data['introDescription'] = get_obj_field_value($pageNode, 'field_eco_intro_description');
   }
   
   $courseTypeVoc = taxonomy_vocabulary_machine_name_load('course_type');
   $executiveCourseTypeTid =  get_taxonomy_term_id_by_name('Executive', $courseTypeVoc->vid);
   
   // Fetch executive courses
   $query = db_select('node', 'n');
   $query->join('field_data_field_c_start_date', 'sd', 'sd.entity_id = n.nid');
   $query->join('field_data_field_c_course_type', 't', 't.entity_id = n.nid');
   $query->fields('n', array('nid'));
   $query->condition('n.type', 'course', '=');
   $query->condition('t.field_c_course_type_tid', $executiveCourseTypeTid, '=');
   $query->orderBy('sd.field_c_start_date_value', 'DESC');
   $result = $query->execute();
   
   while ($record = $result->fetchAssoc()) {
      $course = node_load($record['nid']);
      $imageInfo = get_obj_field_img_info($course, 'field_c_cover_image');
      $data['courseList'][] = array(
         'nid' => $course->nid,
         'title' => $course->title,
         'overview' => get_obj_field_value($course, 'field_c_details_overview'),
         'coverImageUrl' => $imageInfo['url'],
         'coverImageAlt' => $imageInfo['alt'],
         'coverImageTitle' => $imageInfo['title'],
      );
   }
   
   drupal_add_js(drupal_get_path('theme', 'insight') .'/dist/scripts/executive-course.js', [
      'type' => 'file',
      'scope' => 'pageJs',
      'weight' => 3,
   ]);
   
   return theme('executive_course_overview_template', $data);
}

/**
* Custom payment form used for paypal payment
*/
function custom_payment_form($form, &$form_state, $params) {
   if (isset($params['totalFee']) && $params['totalFee'] > 0) {
      // Get paypal payment method
      $query = db_select('payment_method', 'p')
         ->fields('p', array('pmid'))
         ->condition('p.controller_class_name', 'PayPalPaymentECPaymentMethodController', '=')
         ->range(0,1)
         ->execute();
      $result = $query->fetchObject();
      
      if ($result) {
         $payment = new Payment(array(
            'context_data' => array('courseNid' => $params['nid'], 'courseDurationId' => $params['bookschedule'], 'registrationNid' => $params['registeredBy']),
            'currency_code' => 'HKD',
            'description' => $params['title'],
            'finish_callback' => 'custom_payment_complete',
            'pmid' => $result->pmid,
         ));
         
         $payment->setLineItem(new PaymentLineItem(array(
            'amount' => $params['totalFee'],
            'name' => "{$params['registeredBy']}_{$params['nid']}_{$params['bookschedule']}", // registrationId_courseId_courseDurationId
            'description' => $params['title'],
            'tax_rate' => '0',
            'quantity' => 1,
         )));
         
         $form = payment_form_standalone($form, $form_state, $payment);
         return $form;
      }
   }
   
   return '';
}

function custom_payment_bank_transfer_form($form, &$form_state, $params) {
   
   $form['is_bank_transfer'] = [
      '#type' => 'hidden',
      '#value' => 1,
   ];
   
   return $form;
}

/**
* Custom payment finish callback
*/
function custom_payment_complete($payment) {
   $options = array('query' => array(
         'course' => $payment->context_data['courseNid'], 
         'bookschedule' => $payment->context_data['courseDurationId'],
         'registration' => $payment->context_data['registrationNid'],
   ));
   
   switch ($payment->statuses[count($payment->statuses)-1]->status) {
      case 'payment_status_success':
         // Update registration status
         $registration = node_load($payment->context_data['registrationNid']);
         $registration->field_registration_status['und'][0]['value'] = 1; // Paypal
         $registration->field_registration_is_paid['und'][0]['value'] = 1; // Paid
         node_save($registration);
         
         $course = node_load($registration->field_registration_course['und'][0]['target_id']);
         
         // Send successfull Registration email
         $a = drupal_mail('custom', 'registration', $registration->field_registration_email['und'][0]['value'], language_default(), [
            'ref_no' => $registration->nid,
            'courseId' => $payment->context_data['courseNid'],
            'registeredFullName' => $registration->title,
            'email' => get_obj_field_value($registration, 'field_registration_email'),
            'firstName' => get_obj_field_value($registration, 'field_registration_first_name'),
            'lastName' => get_obj_field_value($registration, 'field_registration_last_name'),
            'name' => $registration->title,
            'course' => ($course ? $course->title : ''),
            'contactNumber' => $registration->field_registration_contact_no['und'][0]['safe_value'],
            'occupation' => $registration->field_registration_occupation['und'][0]['safe_value'],
            //'subject' => 'Thanks for registration',
         ]);
         
         drupal_goto('booking/3', $options);
         
      case 'payment_status_failed':
         $options['query']['paymentStatus'] = 'Failed';
         drupal_goto('booking/2', $options);
         
      case 'payment_status_pending':
         $options['query']['paymentStatus'] = 'Pending';
         drupal_goto('booking/2', $options);
      
      case 'PAYPAL_PAYMENT_STATUS_REVIEW':
         $options['query']['paymentStatus'] = 'Pending_Under_Review';
         drupal_goto('booking/2', $options);
         
      default:
         $options['query']['paymentStatus'] = 'Failed';
         drupal_goto('booking/2', $options);
   }
}

/**
 * Mailing function
 *
 * @param string $key
 * @param array $array
 * @param params $array
 * @return void
 */
function custom_mail($key, &$message, $params) {
   
   switch ($key) {
      case 'registration':
         $emailTemplete = node_load(120);
         $emailContent = module_invoke('custompage', 'block_view', 'email_template', parse_registration_email_template_contents([
            'courseId' => $params['courseId'],
            'registeredFullName' => $params['registeredFullName'],
            'email' => $params['email'],
            'firstName' => $params['firstName'],
            'lastName' => $params['lastName'],
            'name' => $params['name'],
            'course' => $params['course'],
            'contactNumber' => $params['contactNumber'],
            'occupation' => $params['occupation'],
            'ref_no' => 'ref_no',
         ]));
         
         $message['subject'] = get_obj_field_value($emailTemplete, 'field_email_subject');
         $message['body'][] = $emailContent['content'];
         break;
      
      case 'contact-us':
         $emailContent = module_invoke('custompage', 'block_view', 'email_template', parse_contact_us_email_template_contents($params));
         $emailTemplete = node_load(124);
         
         $message['subject'] = get_obj_field_value($emailTemplete, 'field_email_subject');
         $message['body'][] = $emailContent['content'];
         break;
         
      case 'short-course-get-notified':
         $emailContent = module_invoke('custompage', 'block_view', 'email_template', parse_get_notified_email_template_contents($params));
         $emailTemplete = node_load(125);
         
         $message['subject'] = get_obj_field_value($emailTemplete, 'field_email_subject');
         $message['body'][] = $emailContent['content'];
         break;
      
      case 'registration-bank-transfer':
         $emailContent = module_invoke('custompage', 'block_view', 'email_template', parse_bank_transfer_email_template_contents($params));
         $emailTemplete = node_load(183);
         
         $message['subject'] = get_obj_field_value($emailTemplete, 'field_email_subject');;
         $message['body'][] = $emailContent['content'];
         break;
         
      case 'pending-registration':
         $emailContent = module_invoke('custompage', 'block_view', 'email_template', parse_pending_registration_email_template_contents($params));
         
         $message['subject'] = $params['subject'];
         $message['body'][] = $emailContent['content'];
         
         break;
         
      default:
         $message['subject'] = ($params['subject'] ? $params['subject'] : 'Defaul Email Subject');
         $message['body'][] = ($params['body'] ? $params['body'] : 'Default Email Body');
   }
   
   $message['headers']['Content-Type'] = 'text/html; charset=iso-8859-1';
}

/**
 * Load Registration email tempalate contents
 *
 * @param array $options
 * @return array
 */
function parse_registration_email_template_contents($options) {
   $data = [];
   $emailTemplete = node_load(120);
   $shortCourseDetails = short_course($options['courseId']);
   
   // Load Registration Email Template
   
   $data['bannerImage'] = get_obj_field_img_info($emailTemplete, 'field_email_banner_image');
   $data['bodyContent'] = get_obj_field_value($emailTemplete, 'field_email_content');
   $data['footerContent'] = get_obj_field_value($emailTemplete, 'field_email_footer_content');
   
   // Parse Body Content placeholder
   $data['bodyContent'] = str_replace('[REGISTERATION_NAME]', $options['registeredFullName'], $data['bodyContent']);
   $data['bodyContent'] = str_replace('[FIRST_NAME]', $options['firstName'], $data['bodyContent']);
   $data['bodyContent'] = str_replace('[LAST_NAME]', $options['lastName'], $data['bodyContent']);
   $data['bodyContent'] = str_replace('[REF_NO]', $options['ref_no'], $data['bodyContent']);
   $data['bodyContent'] = str_replace('[COURSE]', $options['course'], $data['bodyContent']);
   $data['bodyContent'] = str_replace('[EMAIL]', $options['email'], $data['bodyContent']);
   $data['bodyContent'] = str_replace('[CONTACT_NUMBER]', $options['contactNumber'], $data['bodyContent']);
   $data['bodyContent'] = str_replace('[NAME]', $options['name'], $data['bodyContent']);
   $data['bodyContent'] = str_replace('[OCCUPATION]', $options['occupation'], $data['bodyContent']);
   
   if (!empty($shortCourseDetails['staffs'])) {
      $data['bodyContent'] = str_replace('[STAFF_FULLNAME]', $shortCourseDetails['staffs'][0]['fullName'], $data['bodyContent']);
      $data['bodyContent'] = str_replace('[STAFF_BIOGRAPHY]', $shortCourseDetails['staffs'][0]['biography'], $data['bodyContent']);
   }
   
   return $data;
}

/**
 * Load Contact us email tempalate contents
 *
 * @param array $options
 * @return array
 */
function parse_contact_us_email_template_contents($options) {
   $data = [];
   $emailTemplete = node_load(124);
   
   $data['bannerImage'] = get_obj_field_img_info($emailTemplete, 'field_email_banner_image');
   $data['bodyContent'] = get_obj_field_value($emailTemplete, 'field_email_content');
   $data['footerContent'] = get_obj_field_value($emailTemplete, 'field_email_footer_content');
   
   // Parse Body Content placeholder
   $data['bodyContent'] = str_replace('[FIRST_NAME]', $options['fm_first_name'], $data['bodyContent']);
   $data['bodyContent'] = str_replace('[SURNAME]', $options['fm_surname'], $data['bodyContent']);
   $data['bodyContent'] = str_replace('[EMAIL]', $options['fm_email'], $data['bodyContent']);
   $data['bodyContent'] = str_replace('[PHONE_NUMBER]', $options['fm_phone_number'], $data['bodyContent']);
   $data['bodyContent'] = str_replace('[INTERESTED_COURSE]', $options['fm_interested_course'], $data['bodyContent']);
   $data['bodyContent'] = str_replace('[HEAR_ABOUT_US]', $options['fm_hear_about_us'], $data['bodyContent']);
   $data['bodyContent'] = str_replace('[MESSAGE]', $options['fm_message'], $data['bodyContent']);
   $data['bodyContent'] = str_replace('[IS_APPOINTMENT]', (isset($options['fm_is_appointment_true']) ? 'Yes' : 'No'), $data['bodyContent']);
   
   return $data;
}

/**
 * Load Short course get notified email tempalate contents
 *
 * @param array $options
 * @return array
 */
function parse_get_notified_email_template_contents($options) {
   $data = [];
   $emailTemplete = node_load(125);
   
   $data['bannerImage'] = get_obj_field_img_info($emailTemplete, 'field_email_banner_image');
   $data['bodyContent'] = get_obj_field_value($emailTemplete, 'field_email_content');
   $data['footerContent'] = get_obj_field_value($emailTemplete, 'field_email_footer_content');
   
   // Parse Body Content placeholder
   $data['bodyContent'] = str_replace('[COURSE_NAME]', $options['gn_course_name'], $data['bodyContent']);
   $data['bodyContent'] = str_replace('[FIRST_NAME]', $options['gn_first_name'], $data['bodyContent']);
   $data['bodyContent'] = str_replace('[LAST_NAME]', $options['gn_last_name'], $data['bodyContent']);
   $data['bodyContent'] = str_replace('[EMAIL]', $options['gn_email'], $data['bodyContent']);
   
   return $data;
}

/**
 * Load Short course get notified email tempalate contents
 *
 * @param array $options
 * @return array
 */
function parse_bank_transfer_email_template_contents($options) {
   $data = [];
   $emailTemplete = node_load(183);
   
   $data['bannerImage'] = get_obj_field_img_info($emailTemplete, 'field_email_banner_image');
   $data['bodyContent'] = get_obj_field_value($emailTemplete, 'field_email_content');
   $data['footerContent'] = get_obj_field_value($emailTemplete, 'field_email_footer_content');
   
   // Parse Body Content placeholder
   $data['bodyContent'] = str_replace('[REF_NO]', $options['ref_no'], $data['bodyContent']);
   $data['bodyContent'] = str_replace('[INSTRUCTION]', $options['instruction'], $data['bodyContent']);
   $data['bodyContent'] = str_replace('[BANK_CODE]', $options['bank_code'], $data['bodyContent']);
   $data['bodyContent'] = str_replace('[BANK_NAME]', $options['bank_name'], $data['bodyContent']);
   $data['bodyContent'] = str_replace('[BANK_ADDRESS]', $options['bank_address'], $data['bodyContent']);
   $data['bodyContent'] = str_replace('[ACCOUNT_NUMBER]', $options['account_number'], $data['bodyContent']);
   $data['bodyContent'] = str_replace('[ACCOUNT_NAME]', $options['account_name'], $data['bodyContent']);
   $data['bodyContent'] = str_replace('[SWIFT_CODE]', $options['swift_code'], $data['bodyContent']);
   $data['bodyContent'] = str_replace('[FIRST_NAME]', $options['firstName'], $data['bodyContent']);
   $data['bodyContent'] = str_replace('[LAST_NAME]', $options['lastName'], $data['bodyContent']);
   
   
   return $data;
}

/**
 * Load Pending Registration email tempalate contents
 *
 * @param array $options
 * @return array
 */
function parse_pending_registration_email_template_contents($options) {
   $data = [];
   $emailTemplete = node_load(260);
   
   $data['bannerImage'] = get_obj_field_img_info($emailTemplete, 'field_email_banner_image');
   $data['bodyContent'] = get_obj_field_value($emailTemplete, 'field_email_content');
   $data['footerContent'] = get_obj_field_value($emailTemplete, 'field_email_footer_content');
   
   // Parse Body Content placeholder
   $data['bodyContent'] = str_replace('[LINK]', '<a href="' . $options['urlLink'] . '" target="_blank">' . $options['urlLink'] . '</a>', $data['bodyContent']);
   $data['bodyContent'] = str_replace('[NAME]', $options['name'], $data['bodyContent']);
   $data['bodyContent'] = str_replace('[EMAIL]', $options['email'], $data['bodyContent']);
   $data['bodyContent'] = str_replace('[COURSE]', $options['course'], $data['bodyContent']);
   $data['bodyContent'] = str_replace('[CONTACT_NUMBER]', $options['contactNumber'], $data['bodyContent']);
   $data['bodyContent'] = str_replace('[OCCUPATION]', $options['occupation'], $data['bodyContent']);
   $data['bodyContent'] = str_replace('[REGISTRATION_DATE]', $options['registrationDate'], $data['bodyContent']);
   $data['bodyContent'] = str_replace('[FIRST_NAME]', $options['firstName'], $data['bodyContent']);
   $data['bodyContent'] = str_replace('[LAST_NAME]', $options['lastName'], $data['bodyContent']);
   
   return $data;
}

/**
 * Coming soon page callback
 */
function coming_soon_page() {
   $data = array();
   
   // Get landing page information
   $pageNode = get_page_info('page_coming_soon');   
   if ($pageNode) {
      $data['pageTitle']= ltrim($pageNode->title, 'Page -');
      $data['bannerSlogan'] = get_obj_field_value($pageNode, 'field_csp_banner_slogan');
      $data['bannerImage'] = get_obj_field_img_info($pageNode, 'field_csp_banner_image');
      $data['headerTitle'] = get_obj_field_value($pageNode, 'field_csp_header_title');
      $data['content'] = get_obj_field_value($pageNode, 'field_csp_content');
   }
   
   return theme('coming_soon_template', $data);
}
