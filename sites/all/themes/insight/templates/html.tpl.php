<?php
/**
 * @file
 * Default theme implementation to display the basic html structure of a single
 * Drupal page.
 *
 * Variables:
 * - $css: An array of CSS files for the current page.
 * - $language: (object) The language the site is being displayed in.
 *   $language->language contains its textual representation.
 *   $language->dir contains the language direction. It will either be 'ltr' or
 *   'rtl'.
 * - $html_attributes:  String of attributes for the html element. It can be
 *   manipulated through the variable $html_attributes_array from preprocess
 *   functions.
 * - $html_attributes_array: An array of attribute values for the HTML element.
 *   It is flattened into a string within the variable $html_attributes.
 * - $body_attributes:  String of attributes for the BODY element. It can be
 *   manipulated through the variable $body_attributes_array from preprocess
 *   functions.
 * - $body_attributes_array: An array of attribute values for the BODY element.
 *   It is flattened into a string within the variable $body_attributes.
 * - $rdf_namespaces: All the RDF namespace prefixes used in the HTML document.
 * - $grddl_profile: A GRDDL profile allowing agents to extract the RDF data.
 * - $head_title: A modified version of the page title, for use in the TITLE
 *   tag.
 * - $head_title_array: (array) An associative array containing the string parts
 *   that were used to generate the $head_title variable, already prepared to be
 *   output as TITLE tag. The key/value pairs may contain one or more of the
 *   following, depending on conditions:
 *   - title: The title of the current page, if any.
 *   - name: The name of the site.
 *   - slogan: The slogan of the site, if any, and if there is no title.
 * - $head: Markup for the HEAD section (including meta tags, keyword tags, and
 *   so on).
 * - $styles: Style tags necessary to import all CSS files for the page.
 * - $scripts: Script tags necessary to load the JavaScript files and settings
 *   for the page.
 * - $page_top: Initial markup from any modules that have altered the
 *   page. This variable should always be output first, before all other dynamic
 *   content.
 * - $page: The rendered page content.
 * - $page_bottom: Final closing markup from any modules that have altered the
 *   page. This variable should always be output last, after all other dynamic
 *   content.
 * - $classes String of classes that can be used to style contextually through
 *   CSS.
 *
 * @see bootstrap_preprocess_html()
 * @see template_preprocess()
 * @see template_preprocess_html()
 * @see template_process()
 *
 * @ingroup templates
 */
?><!DOCTYPE html>
<html<?php print isset($html_attributes) ? $html_attributes : '';?><?php print isset($rdf_namespaces) ? $rdf_namespaces : '';?>>
<head>
   
  <?php 
   /* if (isset($metaRel) && count($metaRel) > 0) { 
      
      if (isset($metaRel['cano']) && $metaRel['cano']) {
         echo '<link rel="canonical" href="' . $metaRel['cano'] . '"/>' . "\n";
      }
      
      
      if (isset($metaRel['prev']) && $metaRel['prev']) {
         echo '<link rel="prev" href="' . $metaRel['prev'] . '" />' . "\n";
      }
      
      if (isset($metaRel['next']) && $metaRel['next']) {
         echo '<link rel="next" href="' . $metaRel['next'] . '" />' . "\n";
      }
      
   } */
  ?>
  
  <link rel="profile" href="<?php print isset($grddl_profile) ? $grddl_profile : ''; ?>" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php print isset($head) ? $head : ''; ?>
  <title><?php print $head_title; ?></title>
  
  <?php 
   if (isset($customMetaTags) && count($customMetaTags) > 0) { 
      
      foreach ($customMetaTags as $metaRecord) {
            
         if ($metaRecord['tag'] == 'meta') {
            echo '<meta '.$metaRecord['attr1'].'="'.$metaRecord['attr1Val'].'" '.$metaRecord['attr2'].'="'.$metaRecord['attr2Val'].'">' . "\n";
         } else if ($metaRecord['tag'] == 'link') {
            echo '<link '.$metaRecord['attr1'].'="'.$metaRecord['attr1Val'].'" '.$metaRecord['attr2'].'="'.$metaRecord['attr2Val'].'">' . "\n";
         }
         
      }
      
   }
  ?>
  
  <?php print isset($styles) ? $styles : '' ; ?>
  <!-- HTML5 element support for IE6-8 -->
  <!--[if lt IE 9]>
    <script src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv-printshiv.min.js"></script>
    <?php print drupal_get_js('pollyfill'); ?>
  <![endif]-->
  <?php print isset($scripts) ? $scripts : ''; ?>
   <?php print drupal_get_js('recaptcha'); ?>
</head>
<body<?php print isset($body_attributes) ? $body_attributes : ''; ?>>
  <div id="skip-link">
    <a href="#main-content" class="element-invisible element-focusable"><?php print t('Skip to main content'); ?></a>
  </div>
   <div id="ins-mn-cntr">
      <?php print isset($page_top) ? $page_top : ''; ?>
      <?php print isset($page) ? $page : ''; ?>
      <?php print isset($page_bottom) ? $page_bottom : ''; ?>
   </div>
  <?php 
      print drupal_get_js('lib');
      print drupal_get_js('pageJs');
  ?>
</body>
</html>
