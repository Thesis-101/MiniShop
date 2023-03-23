<?php

    function validation_errors($validation, $field)
    {
        if($validation->hasError($field))
        {
            return $validation->getError($field);
        }
    }