<?php
require_once 'contestent.class.php';
include_once '..\layout\header.php';


$id = $firstname = $lastname=$address= $district_id= $dob=$is_active="";

if(!empty($_POST))
{

    if(isset($_POST['id']) && !empty($_POST['id']))
        $id =$_POST['id'];

    if(isset($_POST['firstname']) && !empty($_POST['firstname']))
        $firstname=$_POST['firstname'];

    if(isset($_POST['lastname']) && !empty($_POST['lastname']))
        $lastname=$_POST['lastname'];

    if(isset($_POST['address']) && !empty($_POST['address']))
        $address=$_POST['address'];

    if(isset($_POST['district_id']) && !empty($_POST['district_id']))
        $district_id=$_POST['district_id'];

    if(isset($_POST['dob']) && !empty($_POST['dob']))
        $dob=$_POST['dob'];

if(isset($_POST['is_active']) && !empty($_POST['is_active']))
        $is_active=$_POST['is_active'];


    $data = array(
        'id' => $id,
        'firstname' => $firstname,
        'lastname' => $lastname,
        'address' => $address,
        'district_id' => $district_id,        
        'dob' => $dob,
        'is_active' =>$is_active
    );

    $contestent= new Contestent();
    $contestent->setValue($data);

    //    insertion
    if(!empty($contestent->firstname))

    {
        if(isset($contestent->id) && !empty($contestent->id))
        {
            $_SESSION['success']=1;
            $_SESSION['success_message']="Record Updated Successfully";
            echo ($contestent->update()) ? "record successfully updated" : "FAILED !!!";
        }
        else
        {
            $_SESSION['success']=1;
            $_SESSION['success_message']="Record Added   Successfully";
            echo ($contestent->insert()) ?"record successfully added." : "FAILED !!!";
        }

        header('Location: /../../contest/contestent/');
    }
    else
    {

        $_SESSION['error']=1;
        $_SESSION['error_message']="First Name is Mandatory";
        header('Location: /../../contest/contestent/addedit.php');
    }
}


if(isset($_GET['id']) && !empty($_GET['id']))
{
    $contestent= new Contestent();

    //die('here');
    $row_id = $_GET['id'];

    $detail = $contestent->getDetailById($row_id);

    if($detail)
    {
        $id=$detail['id'];
        $firstname=$detail['firstname'];
        $lastname=$detail['lastname'];
        $address=$detail['address'];
        $district_id=$detail['district_id'];
        $dob=$detail['dob'];
    }
}

$contestent_obj = new Contestent();
$district_recordset = $contestent_obj->getDistrictList();
echo count($district_recordset);
?>

    <h3>Add / Edit :Student Information</h3>
    <hr/>

    <form action="/../../contest/contestent/addedit.php" method="post">
        <input type="hidden" name="id" value="<?php echo $id ?>">
        <table class="table">
            <tr>
                <th>First Name:</th>
                <td> <input type="text" name="firstname" value="<?php echo $firstname; ?>"  class="form-control"></td>
            </tr>
            <tr><th>Last Name:</th><br><td><input type="text" name="lastname" id="lastname" value="<?php echo $lastname; ?>" class="form-control"></td>
            <tr><th>Date of Birth:</th><br><td><input type="text" name="dob" id="dob" value="<?php echo $dob; ?>" data-provide="datepicker" class="form-control"></td>
            <tr><th>Address:</th> <td><input type="text" name="address" value="<?php echo $address; ?>" class="form-control"></td></tr>
            <tr><th>District Name:</th>
                <td>
                    <?php if(count($district_recordset) > 0)
                    {
                        echo "<select name=\"district_id\" id=\"district_id\" class=\"form-control\">";
                        echo "<option value=''>Select District</option>";
                        foreach($district_recordset as $district)
                        {
                            $selected = ($_id == $district['id']) ? "selected='selected'" : "";
                            echo PHP_EOL ."<option value='" . $district['id'] . "' " . $selected . ">". $district['name'] . "</option>";
                        }
                        echo "</select>";
                    } ?>
                </td>
            </tr>
            <tr><th>Active:</th> <td><input type="checkbox" name="vehicle" value="1"></td></tr>
            <tr><th></th><td>
                    <div class="btn-group">
                    <input type="submit" value="Save" class="btn btn-primary">
                          <a href = "index.php" class=" btn btn-primary"> back </a>
                    </div>
                </td></tr>

        </table>
    </form>











<?php include '..\layout\footer.php'; ?>