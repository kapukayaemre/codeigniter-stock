<?php 

function get_active_user(){

    $t = & get_instance(); //! OOP bir yapı olmadığı için codeigniter içerikleri değişkene aktarıldı.

    $user = $t->session->userdata('user');

    if($user) 
        return $user;
    else
        return false;

}