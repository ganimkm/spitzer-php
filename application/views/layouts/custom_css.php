<?php

    if (count($custom_css) > 0)
    {
        foreach ($custom_css as $value)
        {
            echo '<link rel="stylesheet" href="' . base_url() . $value . '"  type="text/css" />';
        }
    }

?> 



