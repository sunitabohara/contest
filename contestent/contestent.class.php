<?php
include_once 'C:\xampp\htdocs\Contest\connection\database.php';

class Contestent
{
    public $table = "contestent";
    public $db_connect;
    public $id,
        $firstname,
        $lastname,
        $address,
        $dob,
        $is_active,
        $district_id;

    public function __construct()
    {
        global $connection_string;
        $this->db_connect = $connection_string;
    }

    public function setValue($data)
    {
        $this->id = (isset($data['id'])) ? $data['id'] : null;
        $this->firstname = (isset($data['firstname'])) ? $data['firstname'] : null;
        $this->lastname = (isset($data['lastname'])) ? $data['lastname'] : null;
        $this->dob = (isset($data['dob'])) ? $data['dob'] : null;
        $this->address = (isset($data['address'])) ? $data['address'] : null;
        $this->district_id = (isset($data['district_id'])) ? $data['district_id'] : null;

        $this->address_id = (isset($data['address_id'])) ? $data['address_id'] : null;

    }

    public function getList()
    {
        $sql = "SELECT co.*, d.`name` from `$this->table` as co left join `district` as d on co.`district_id` = d.`id`";
        $stmt = $this->db_connect->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getDistrictList()
    {
        $sql = "SELECT *  from `district`";
        $stmt = $this->db_connect->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getDetailById($id)
    {
        $stmt = $this->db_connect->prepare("SELECT * from `$this->table` where id=:contestent_id");
        $stmt->bindParam(':contestent_id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function insert()
    {
// print_r($_POST);
// $contestent = $this->db_connect->prepare("INSERT INTO `$this->table` (firstname, lastname, address,  district_id,dob,is_active)
//                 VALUES ('njsab',  'kkjkj', 'hj',  1,'2017-09-08','1')");
//             ;

//             $contestent->execute();

//             return true;

        try {

            $contestent = $this->db_connect->prepare("INSERT INTO `$this->table` (firstname, lastname, address,  district_id,dob,is_active)
    VALUES (:firstname,  :lastname, :address,  :district_id,:dob,:is_active)");
            ;

            $contestent->bindParam(':firstname', $this->firstname);
            $contestent->bindParam(':lastname', $this->lastname);
            $contestent->bindParam(':address', $this->address);
            $contestent->bindParam(':district_id',  $this->district_id);
            $contestent->bindParam(':dob', $this->dob);
            $contestent->bindParam(':is_active', $this->is_active);


            $contestent->execute();

            return true;
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function update()
    {
    // echo  $this->address . $this->district_id;exit;
        try {
            $stmt = $this->db_connect->prepare("UPDATE `$this->table`
            set
            firstname = :firstname,
            lastname = :lastname,
            address = :address,
            district_id = :district_id,
            is_active'= :is_active,
            where id=:id");

            $stmt->bindParam(':firstname', $this->firstname);
            $stmt->bindParam(':lastname', $this->lastname);
            $stmt->bindParam(':address', $this->address);
            $stmt->bindParam(':district_id',$this->district_id);            
            $stmt->bindParam(':is_active',$this->is_active);

            $stmt->bindParam(':id',$this->id);

            $stmt->execute();
            return true;
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }


    public function delete($id){

        try {


            // sql to delete a record
            $sql = "DELETE FROM `$this->table` WHERE id=$id";

            // use exec() because no results are returned
            $this->db_connect->exec($sql);
            return true;
            //  echo "Record deleted successfully";
        }
        catch(PDOException $e)
        {
             echo $sql . "<br>" . $e->getMessage();
        }
    }

    public function getLatest($limit){
        try{
            $sql="SELECT firstname,lastname from `$this->table` ORDER BY reg_date DESC LIMIT :limit";

            $stmt = $this->db_connect->prepare($sql);
            $stmt->bindParam('limit',$limit, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;

        }
        catch (PDOException $e){

            echo "Error: " . $e->getMessage();
            return false;

        }

    }

    public function getAssignedSubjectAndTeacherList($student_id){


//        print_r($teacher_id);
        try {
            $sql ="SELECT DISTINCT t.*, c.*,s.student_id
            FROM `teacher` AS t
           JOIN `teacher_class_subject` AS tc
             ON t.teacher_id = tc.teacher_id
            JOIN `subject` AS c
            ON tc.class_id = c.class_id
            JOIN `tbl_students` AS s
            ON c.class_id= s.class_id
            WHERE tc.status=1
            AND s.student_id=:student_id";
            ;

            $stmt = $this->db_connect->prepare($sql);
            $stmt->bindParam(':student_id', $student_id);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;

//            return true;
            //  echo "Record deleted successfully";
        }
        catch(PDOException $e)
        {
            //  echo $sql . "<br>" . $e->getMessage();
            return false;
        }
    }


}


