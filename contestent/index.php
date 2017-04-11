<?php
require_once 'contestent.class.php';
include '..\layout\header.php';

$contestent = new Contestent();
?>

       <h2>Student Module
        <div class="pull-right">
            <div class="btn-group">
                <a href = "addedit.php" class="btn btn-primary btn-sm">Add</a>
            </div>

        </div>
       </h2>
    <hr/>

<form action="delete.php" method="GET">

    <table class="table table-bordered">
        <tr>
            <th></th>
            <th>Full Name</th>
            <th>District</th>
            <th>Address</th>
            <th>Active</th>
            <th>Action</th>
        </tr>
        <?php

        $obj = new Contestent();

        $result = $obj->getList();

        if( count($result) > 0 )
        {
            foreach($result as $row)
            {
               // print_r($row);
                $addedit_url = "addedit.php?id=" . $row['id'];

                $delete_url = "delete.php?id=" . $row['id']; ?>
                $upload_url = "upload_image.php?id=" . $row['id']; ?>

                <tr>
                    <td><input type='checkbox' name='selected_id[]' value="<?php echo $row['id']?>"></td>
                    <td> <?php echo $row['firstname'] . $row['lastname'] ?> </td>
                    <td><?php echo $row['name'] ?></td>
                    <td><?php echo $row['address'] ?></td>
                    <td><?php echo $row['is_active']?'Active':'Inactive' ?></td>
                    <td>
                        <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#view-detail-modal" data-student-id="<?php echo $row['student_id'] ?>">view</button> |

                        <a href="<?php echo $addedit_url ?>"> edit</a> |
                        <a href="<?php echo $delete_url ?>" class='del'>delete</a>|
                         <a href="<?php echo $upload_url ?>"> upload</a> 


                    </td>

                </tr>
            <?php    }
        }
        else
        {
            echo 'No Members';
        }
        ?>

    </table>
    <div>Total Records = <?php echo count($result) ?></div>





    <div class="modal fade" id="view-detail-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Student Detail</h4>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <input type="submit" value="Delete Selected" class="group-delete btn btn-danger" />

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.del').click(function(){
                if(!confirm("Are You Sure to Delete?"))
                {
                    return false;
                }
            });

            $('.group-delete').click(function(){
                if(!confirm("Are You Sure to Delete these records?"))
                {
                    return false;
                }
            });

            $('#view-detail-modal').on('show.bs.modal', function (event)
            {
                var button = $(event.relatedTarget) // Button that triggered the modal
                var studentId = button.data('student-id'); // Extract info from data-* attributes

                $.ajax({
                    url: "view-detail.php?student_id=" + studentId,
                    context: document.body,
                    success: function(result)
                    {
//                        $('#ajaxPlaceholder').html(result);
                        var modal = $(this);
                        modal.find('.modal-body').html(result);
                    }
                });
            });

        });
    </script>


<?php include '..\layout\footer.php'; ?>