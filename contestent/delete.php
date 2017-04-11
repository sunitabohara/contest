
<?php

require_once 'contestent.class.php';
include '..\layout\header.php';


 if(isset($_GET['id']) && !empty($_GET['id']))
{

    $std= new Contestent();
    $row_id = $_GET['id'];
    $std->delete($row_id);

    if( $std->delete($row_id))
    {
        $_SESSION['success']=1;
        $_SESSION['success_message']="Record Deleted Successfully";
        header('Location:/contestent/');
    }
    else
    {
        $_SESSION['success']=0;
        $_SESSION['success_message']="Record  Failed To Delete";
        die('Error, query failed');
    }
}

if( isset($_GET['selected_id']) && count($_GET['selected_id']) > 0 )
{
    $std= new Contestent();
    print_r($_GET['selected_id']);

    $selected_id = $_GET['selected_id'];
    foreach($selected_id as $key=>$value)
    {
        echo "<br />key = $key value = $value";
        //$sql="DELETE FROM `student` WHERE student_id='$value' ";

        $_SESSION['success']=1;
        $_SESSION['success_message']="Selected Record Deleted Successfully";
        $std->delete($value);
    }
    header('Location:/../../contest/contestent/');
}
else
{
    header('Location:/../../contest/contestent');
}
?>