<?php

function textCustom($nomeInput)
{
    $CI = &get_instance();

    switch ($nomeInput)
    {
        case "success":
            $class = "text-success";
            break;
        default:
            $class = "text-danger";
            break;
    }

    ?>
    <div class="form-text <?= $class ?>"><?= $CI->session->flashdata($nomeInput) ?></div>
<?php
}

