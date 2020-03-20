<?php

function clean($string){

    return htmlentities($string);


}


function trimString($string){

return str_replace(' ', '-', $string);

}

//display error message
function displayErrorMsg($error){


    echo '
    <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss = "alert" aria-label="close"><span aria-hidden="true">&times;</span>
                </button>
            <strong>Warning!</strong> '.$error.'
    </div>';

}

//display success message
function displaySuccessMsg($msg){


    echo '
    <div class="alert alert-primary alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss = "alert" aria-label="close"><span aria-hidden="true">&times;</span>
                </button>
            <strong>Success!</strong> '.$msg.'
    </div>';

}


