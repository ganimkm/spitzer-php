<?php

    if (count($custom_js) > 0)
    {
        foreach ($custom_js as $value)
        {
            echo '<script src="' . base_url() . $value . '" type="text/javascript"></script>';
        }
    }

?> 



