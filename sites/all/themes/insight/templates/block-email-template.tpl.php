<?php
global $base_url;
$images_path = $base_url .'/'. drupal_get_path('theme', 'insight') . '/dist/images/';
$dist_path = $base_url .'/'. drupal_get_path('theme', 'insight') . '/dist/';
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title><?php print variable_get('site_name', 'Insight'); ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <!--[if !mso]><!-->
        <style>
            @font-face {
                font-family: 'latoregular';
                src: url('<?php print $dist_path; ?>fonts/lato-regular-webfont.woff2') format('woff2'),
                    url('<?php print $dist_path; ?>fonts/latmsg-bdy-regular-webfont-regular-webfont.woff') format('woff');
                font-weight: normal;
                font-style: normal;
            }

            @font-face {
                font-family: 'Myriad Pro';
                src: url('<?php print $dist_path; ?>fonts/MyriadPro-Regular.eot');
                src: url('<?php print $dist_path; ?>fonts/MyriadPro-Regular.eot?#iefix') format('embedded-opentype'),
                    url('<?php print $dist_path; ?>fonts/MyriadPro-Regular.woff') format('woff'),
                    url('<?php print $dist_path; ?>fonts/MyriadPro-Regular.ttf') format('truetype');
                font-weight: normal;
                font-style: normal;
            }


            @media screen {
                table {
                    font-family: 'Myriad Pro', Arial, sans-serif!important;
                    font-size: 20px;
                }

                .email-head {
                    font-family: 'latoregular', Arial, sans-serif!important;
                    font-size: 34px;
                    font-weight: 400;
                }

                hr {
                    border-bottom: 1px solid #000;
                }

                .msg-bdy {
                     padding-top: 24px;
                }
                
                .msg-bdy p {
                    line-height: 1.5;
                    padding-bottom: 10px;
                }

                .msg-bdy .learn-more a {
                    text-decoration: none;
                    text-transform: uppercase;
                    color: #000;
                }

                .ftr-sec {
                    background-color: #d1d1d1;
                    color: #fff;
                    font-size: 18px;
                    font-weight: 100;
                }

                .ftr-sec p {
                    margin: 0;
                    padding-bottom: 4px;
                }

                .ftr-tbl {
                    width: 600px;
                    padding-top: 20px;
                    font-size: 16px;
                }

                .ftr-tbl td {
                    padding: 0;
                    padding-bottom: 20px;
                }

                .ftr-end {
                    line-height: 20px;
                }

                .ftr-tbl .scl-imgs {
                    margin-right: 92px;
                }
            }
        </style>
        <!--<![endif]-->
    </head>
    <body style="margin: 0; padding: 0;">
        <table align="center" border="0" cellpadding="0" cellspacing="0" width="629">
            <tr>
                <td style="padding:15px 0;">
                    <img src="<?php print "{$images_path}logo_mail.png"; ?>" title="<?php print variable_get('site_name', 'Insight'); ?>">
                </td>
            </tr>
            <tr>
                <td background="<?php echo isset($bannerImage['url']) ? $bannerImage['url'] : ''; ?>" height="124px;" align="center" title="<?php print variable_get('site_name', 'Insight'); ?>">
                </td>
            </tr>
            <tr>
                <td class="msg-bdy">
                    <?php print isset($bodyContent) ? $bodyContent : ''; ?>
                </td>
            </tr>
            <tr>
                <td class="ftr-sec">
                    <table align="center" border="0" cellpadding="0" cellspacing="0" class="ftr-tbl">
                        <tr>
                            <td>
                              <a href="#" class="scl-imgs"><img style="height: 45px; width: 45px;" src="<?php echo $images_path; ?>mb-youtube-icon-wht.png" title="Insight Youtube"></a>
                              <a href="#" class="scl-imgs"><img  style="height: 45px; width: 45px;" src="<?php echo $images_path; ?>mb-fb-icon.png" title="Insight Facebook"></a>
                              <a href="#" class="scl-imgs"><img  style="height: 45px; width: 45px;" src="<?php echo $images_path; ?>mb-twitter-icon-wht.png" title="Insight Twitter"></a>
                              <a href="#" class="scl-imgs" style="margin-right: 80px;"><img style="height: 45px; width: 45px;" src="<?php echo $images_path; ?>mb-instagram-icon-wht.png" title="Insight Instagram"></a>
                              <a href="#"><img style="height: 45px; width: 45px;" src="<?php echo $images_path; ?>mb-pinterest-icon-wht.png" title="Insight Pinterest"></a>
                            </td>
                        </tr>
                        <tr>
                            <td class="ftr-end">
                                <?php print isset($footerContent) ? $footerContent : ''; ?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>
</html>