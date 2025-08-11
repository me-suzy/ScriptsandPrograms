<?php

/**
* See class SB_HookInterface in ../../inc/page.inc.php for possible methods to be overridden.
*/

class SB_Hook extends SB_HookInterface
{
    function designedBy()
    {
        echo SB_T("Skin designed by")?> <a href='http://brablc.com/' <?php echo SB_Page::target()?>>Ondrej Brablc</a><?php
    }

    function getStyle($styleID)
    {
        switch ($styleID)
        {
            case 'google_color_border': return '807AD6';
            case 'sf_logo_src': return 'http://sourceforge.net/sflogo.php?group_id=76467&amp;type=4';
        }

        return parent::getStyle($styleID);
    }
}

?>
