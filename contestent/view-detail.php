<?php
require_once'student.class.php';
require_once '..\teacher\teacher.php';


if(isset($_GET['student_id']) && !empty($_GET['student_id'])){

    $student_id = $_GET['student_id'];
    $student_obj = new student();
    $result = $student_obj->getDetailById($student_id);

    ?>

    <table class="table">
        <tr>
            <th>Student Name</th>
            <td><?php echo $result['firstname'] . PHP_EOL. $result['lastname']?></td>
        </tr>

        <tr>
            <th>Email:</th>
            <td><?php echo $result['email'] ?></td>

        </tr>
        <tr>
            <td>Admitted on:</td>
            <td><?php echo date('jS M, Y', strtotime($result['reg_date'])) ?></td>
        </tr>

    </table>

    <h4>Classes Assigned</h4>
    <table class="table table-bordered">
        <tr>
            <th>SN</th>
            <th>Subject Name</th>
            <th>Teacher s</th>
            <!--        <th>Action</th>-->
        </tr>

        <?php
        $student_obj = new Student();
        $student_id = $_GET['student_id'];
        //$class_id=$result['class_id'];
        $teacher_result = $student_obj->getAssignedSubjectAndTeacherList($student_id);
        //$class_result = $class_obj->getAssignedTeacherList($class_id);
       // $student_result = $class_obj->getStudentAssignedClass($student_id);
        //print_r($teacher_result);
        //            echo count($teacher_result);
        if(count($teacher_result)>0){
            $x=1;
            foreach($teacher_result as $class){

                echo "<tr>";
                echo "<td>" .$x++  . "</td>";
                echo "<td>" . $class['subjectname'] . "</td>";
               echo "<td>";


                    echo PHP_EOL. $class['firstname']. PHP_EOL.$class['lastname'] ;

                    "</td>";

                echo "</tr>";
            }
        }
        ?>
    </table>
<?php
}?>
