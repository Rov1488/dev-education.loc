<?php
require_once __DIR__. "/../config/config_db.php";
/**
Служебные функции
 */
//ASSOC massiv ko'rinishda
function debug($arr, $die = false){
    echo '<pre>'.print_r($arr, true).'</pre>';
    if ($die) die;
}

function redirect($http = false){
    if($http){
        $redirect = $http;
    } else{
        $redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : PATH;
    }
    header("Location: $redirect");
    exit;
}


function h($str){
    return htmlspecialchars($str, ENT_QUOTES);
}


function getCount($tableName)
{
    include __DIR__. "/../config/config_db.php";

    $count_sql = "SELECT * FROM {$tableName}";
    $count = $conn->prepare($count_sql);
     $count->execute();
    $totalCount = $count->rowCount();
    return $totalCount;
}
//Get data in table with id
function getDataBYtableId($tableName, $id = null)
{
    include __DIR__. "/../config/config_db.php";
if (is_null($id)){
    $sql = "SELECT * FROM {$tableName}";
}else{
    $sql = "SELECT * FROM {$tableName} where id = :id";
}
    $sth = $conn->prepare($sql);
    $sth->bindParam(":id", $id);
    $sth->execute();
    return $sth->fetch(PDO::FETCH_ASSOC);
}
//Get data in table
function getDataBYtable($tableName)
{
    include __DIR__. "/../config/config_db.php";
    $sql = "SELECT * FROM {$tableName}";
    $sth = $conn->prepare($sql);
    $sth->execute();
    return $sth->fetchAll(PDO::FETCH_ASSOC);
}

//FOR PAGINATION
function getPageCount($tableName)
{
    include __DIR__. "/../config/config_db.php";
    $count_sql = "SELECT * FROM {$tableName}";
    $count_pr = $conn->prepare($count_sql);
    $count_pr->execute();
    $totalCount = $count_pr->rowCount();
    return ceil($totalCount / LIMIT);
}

//getListSort
function getListSort($tableName, $page, $order = null)
{
    include __DIR__. "/../config/config_db.php";
    $offset = ($page - 1) * LIMIT;
    if (is_null($order)){
        $sql = "SELECT * FROM {$tableName} limit $offset, ".  LIMIT;
    }else{
        $sql = "SELECT * FROM {$tableName} order by {$order} limit $offset, ".  LIMIT;
    }
    $sth = $conn->prepare($sql);
    $sth->execute();
    return $sth->fetchAll(PDO::FETCH_ASSOC);
}


//FOR PAGINATION
function getList($tableName, $page)
{
    include __DIR__. "/../config/config_db.php";
    $offset = ($page - 1) * LIMIT;
    $sth = $conn->prepare("SELECT * FROM {$tableName} limit $offset," . LIMIT);
    $sth->execute();
    return $sth->fetchAll(PDO::FETCH_ASSOC);
}

function addRoom($floor, $roomNumber)
{
    include __DIR__. "/../config/config_db.php";
    $sql = "insert into room_table (floor, room_number) 
values (:floor, :roomNumber)";
    $stm = $conn->prepare($sql);
    $stm->bindParam(":floor", $floor);
    $stm->bindParam(":roomNumber", $roomNumber);
    return $stm->execute();
}

function updateRoom($id, $floor, $roomNumber)
{
    include __DIR__. "/../config/config_db.php";

    $sql = "update room_table set floor = :floor, room_number = :roomNumber where id=:id";
    $stm = $conn->prepare($sql);
    $stm->bindParam(":floor", $floor);
    $stm->bindParam(":roomNumber", $roomNumber);
    $stm->bindParam(":id", $id);
    return $stm->execute();
}


function addStudent($firstname, $lastname, $birthDate, $adress, $phone, $email, $image)
{
    include __DIR__. "/../config/config_db.php";
    $sql = "insert into students (firstName, lastName, birthDate, adress, phone, email, img) 
values (:firstName, :lastName, :birthDate, :adress, :phone, :email, :img)";
    $stm = $conn->prepare($sql);
    $stm->bindParam(":firstName", $firstname);
    $stm->bindParam(":lastName", $lastname);
    $stm->bindParam(":birthDate", $birthDate);
    $stm->bindParam(":adress", $adress);
    $stm->bindParam(":phone", $phone);
    $stm->bindParam(":email", $email);
    $stm->bindParam(":img", $image);
    return $stm->execute();
}

function updateStudent($id, $firstname, $lastname, $birthDate, $adress, $phone, $email, $image)
{
    include __DIR__. "/../config/config_db.php";
    $sql = "update students set firstName = :firstName, lastName = :lastName, birthDate = :birthDate,
 adress = :adress, phone = :phone, email = :email, img = :img where id=:id";
    $stm = $conn->prepare($sql);
    $stm->bindParam(":firstName", $firstname);
    $stm->bindParam(":lastName", $lastname);
    $stm->bindParam(":birthDate", $birthDate);
    $stm->bindParam(":adress", $adress);
    $stm->bindParam(":phone", $phone);
    $stm->bindParam(":email", $email);
    $stm->bindParam(":img", $image);
    $stm->bindParam(":id", $id);
    return $stm->execute();
}

//id orqali ma'lumot olish
function getById($tableName, $id)
{
    include __DIR__. "/../config/config_db.php";
    $sql = "select * from {$tableName} where id = :id";
    $st = $conn->prepare($sql);
    $st->bindParam(":id", $id);
    $st->execute();
    return $st->fetch(PDO::FETCH_ASSOC);
}

function addCourse($title, $price)
{
    include __DIR__. "/../config/config_db.php";
    $sql = "insert into course (courseName, price_course) values (:courseName, :price_course)";
    $stm = $conn->prepare($sql);
    $stm->bindParam(":courseName", $title);
    $stm->bindParam(":price_course", $price);
    return $stm->execute();
}

function updateCourse($id, $courseName, $price)
{
    include __DIR__. "/../config/config_db.php";
    $sql = "update course set courseName = :courseName, price_course = :price
 where id=:id";
    $stm = $conn->prepare($sql);
    $stm->bindParam(":courseName", $courseName);
    $stm->bindParam(":price", $price);
    $stm->bindParam(":id", $id);
    return $stm->execute();
}

//delete function

function deleteData($tableName, $id, $del){
    include __DIR__. "/../config/config_db.php";

    if (!empty($del) == "del-item"){

            $sql = "DELETE FROM {$tableName} WHERE id = :id";
            $stm = $conn->prepare($sql);
            $stm->bindParam(":id", $id);
            return $stm->execute();

        }else{
            $error = "Ma'lumoti o'chirishda xatolik";
            return $error;
            }



}

function addMentor($firstname, $lastname, $birthDate, $adress, $phone, $email, $workExp, $placeWork)
{
    include __DIR__. "/../config/config_db.php";

    $sql = "insert into mentors(mentorFirstName, mentorLastName, birthDate, adress, phone, email, work_experience, placeWork) 
values (:mentorFirstName, :mentorLastName, :birthDate, :adress, :phone, :email, :work_experience, :placeWork)";
    $stm = $conn->prepare($sql);
    $stm->bindParam(":mentorFirstName", $firstname);
    $stm->bindParam(":mentorLastName", $lastname);
    $stm->bindParam(":birthDate", $birthDate);
    $stm->bindParam(":adress", $adress);
    $stm->bindParam(":phone", $phone);
    $stm->bindParam(":email", $email);
    $stm->bindParam(":work_experience", $workExp);
    $stm->bindParam(":placeWork", $placeWork);
    return $stm->execute();
}

function updateMentor($id, $firstname, $lastname, $birthDate, $adress, $phone, $email, $workExp, $placeWork)
{
    include __DIR__. "/../config/config_db.php";
    $sql = "update mentors set mentorFirstName = :mentorFirstName, mentorLastName = :mentorLastName, birthDate = :birthDate, adress = :adress, phone = :phone, email = :email, work_experience = :work_experience, placeWork = :placeWork
 where id=:id";
    $stm = $conn->prepare($sql);
    $stm->bindParam(":mentorFirstName", $firstname);
    $stm->bindParam(":mentorLastName", $lastname);
    $stm->bindParam(":birthDate", $birthDate);
    $stm->bindParam(":adress", $adress);
    $stm->bindParam(":phone", $phone);
    $stm->bindParam(":email", $email);
    $stm->bindParam(":work_experience", $workExp);
    $stm->bindParam(":placeWork", $placeWork);
    $stm->bindParam(":id", $id);
    return $stm->execute();
}

/*
function addPayMentor($firstname, $lastname, $birthDate, $adress, $phone, $email, $workExp, $placeWork)
{
    include __DIR__. "/../config/config_db.php";

    $sql = "insert into mentors(mentorFirstName, mentorLastName, birthDate, adress, phone, email, work_experience, placeWork) 
values (:mentorFirstName, :mentorLastName, :birthDate, :adress, :phone, :email, :work_experience, :placeWork)";
    $stm = $conn->prepare($sql);
    $stm->bindParam(":mentorFirstName", $firstname);
    $stm->bindParam(":mentorLastName", $lastname);
    $stm->bindParam(":birthDate", $birthDate);
    $stm->bindParam(":adress", $adress);
    $stm->bindParam(":phone", $phone);
    $stm->bindParam(":email", $email);
    $stm->bindParam(":work_experience", $workExp);
    $stm->bindParam(":placeWork", $placeWork);
    return $stm->execute();
}*/

function addOrgInfo($nameOrg, $adress, $phone, $email, $setAccount, $bankName, $mfo, $inn, $oked, $regCode)
{
    include __DIR__. "/../config/config_db.php";

    $sql = "insert into organisetion_info(name_org, adress, phone, email, settlement_account, bank_name, mfo, inn, oked, reg_cod_nds) 
values (:name_org, :adress, :phone, :email, :settlement_account, :bank_name, :mfo, :inn, :oked, :reg_cod_nds)";
    $stm = $conn->prepare($sql);
    $stm->bindParam(":name_org", $nameOrg);
    $stm->bindParam(":adress", $adress);
    $stm->bindParam(":phone", $phone);
    $stm->bindParam(":email", $email);
    $stm->bindParam(":settlement_account", $setAccount);
    $stm->bindParam(":bank_name", $bankName);
    $stm->bindParam(":mfo", $mfo);
    $stm->bindParam(":inn", $inn);
    $stm->bindParam(":oked", $oked);
    $stm->bindParam(":reg_cod_nds", $regCode);
    return $stm->execute();
}

function updateOrgInfo($id, $nameOrg, $adress, $phone, $email, $setAccount, $bankName, $mfo, $inn, $oked, $regCode)
{
    include __DIR__. "/../config/config_db.php";

    $sql = "update organisetion_info set name_org = :name_org, adress = :adress, phone = :phone, email = :email,
 settlement_account = :settlement_account, bank_name = :bank_name, mfo = :mfo, inn = :inn, oked = :oked, reg_cod_nds = :reg_cod_nds  where id=:id";

    $stm = $conn->prepare($sql);
    $stm->bindParam(":name_org", $nameOrg);
    $stm->bindParam(":adress", $adress);
    $stm->bindParam(":phone", $phone);
    $stm->bindParam(":email", $email);
    $stm->bindParam(":settlement_account", $setAccount);
    $stm->bindParam(":bank_name", $bankName);
    $stm->bindParam(":mfo", $mfo);
    $stm->bindParam(":inn", $inn);
    $stm->bindParam(":oked", $oked);
    $stm->bindParam(":reg_cod_nds", $regCode);
    $stm->bindParam(":id", $id);
    return $stm->execute();
}

function addGroupDay($dayName, $group_id)
{
    include __DIR__. "/../config/config_db.php";
    $sql = "insert into group_days (day_name, group_id) values (:day_name, :group_id)";
    $stm = $conn->prepare($sql);
    $stm->bindParam(":day_name", $dayName);
    $stm->bindParam(":group_id", $group_id);
    return $stm->execute();
}

function updateGroupDay($id, $dayName, $group_id)
{
    include __DIR__. "/../config/config_db.php";
    $sql = "update group_days set day_name = :day_name, group_id = :group_id
 where id=:id";
    $stm = $conn->prepare($sql);
    $stm->bindParam(":day_name", $dayName);
    $stm->bindParam(":group_id", $group_id);
    $stm->bindParam(":id", $id);
    return $stm->execute();
}

//ADD edu_groups
function addGroups($groupName, $course_id, $room_id, $s_time, $e_time, $s_date, $e_date, $countStudent, $mentor_id, $status, $group_day_id){

    include __DIR__. "/../config/config_db.php";
 $sql = "insert into edu_groups (groupName, course_id, room_id, start_time, end_time, start_date, end_date, countStudent, mentor_id, status, group_day_id) 
values (:groupName, :course_id, :room_id, :start_time, :end_time, :start_date, :end_date, :countStudent, :mentor_id, :status, :group_day_id)";
    $stm = $conn->prepare($sql);
    $stm->bindParam(":groupName", $groupName);
    $stm->bindParam(":course_id", $course_id);
    $stm->bindParam(":room_id", $room_id);
    $stm->bindParam(":start_time", $s_time);
    $stm->bindParam(":end_time", $e_time);
    $stm->bindParam(":start_date", $s_date);
    $stm->bindParam(":end_date", $e_date);
    $stm->bindParam(":countStudent", $countStudent);
    $stm->bindParam(":mentor_id", $mentor_id);
    $stm->bindParam(":status", $status);
    $stm->bindParam(":group_day_id", $group_day_id);
    return $stm->execute();
}

function updateGroups($id ,$groupName, $course_id, $room_id, $s_time, $e_time, $s_date, $e_date, $countStudent, $mentor_id, $status, $group_day_id){

    include __DIR__. "/../config/config_db.php";

    $sql = "update edu_groups set groupName = :groupName, course_id = :course_id, room_id = :room_id,
 start_time = :start_time, end_time = :end_time, start_date = :start_date, end_date = :end_date, countStudent = :countStudent,
  mentor_id = :mentor_id, status = :status, group_day_id = :group_day_id where id = :id";

    $stm = $conn->prepare($sql);
    $stm->bindParam(":groupName", $groupName);
    $stm->bindParam(":course_id", $course_id);
    $stm->bindParam(":room_id", $room_id);
    $stm->bindParam(":start_time", $s_time);
    $stm->bindParam(":end_time", $e_time);
    $stm->bindParam(":start_date", $s_date);
    $stm->bindParam(":end_date", $e_date);
    $stm->bindParam(":countStudent", $countStudent);
    $stm->bindParam(":mentor_id", $mentor_id);
    $stm->bindParam(":status", $status);
    $stm->bindParam(":group_day_id", $group_day_id);
    $stm->bindParam(":id", $id);
    return $stm->execute();
}

function addUser($username, $paswword, $email, $role, $status)
{
    include __DIR__. "/../config/config_db.php";

    $hash_pass = password_hash($paswword, PASSWORD_DEFAULT);
    $sql = "insert into users (username, password, email, role, status) values (:username, :password, :email, :role, :status)";
    $stm = $conn->prepare($sql);
    $stm->bindParam(":username", $username);
    $stm->bindParam(":password", $hash_pass);
    $stm->bindParam(":email", $email);
    $stm->bindParam(":role", $role);
    $stm->bindParam(":status", $status);
    try {
        return $stm->execute();
    }catch (PDOException $e){
        $error = $e->getMessage();
    }

}

function updateUser($id, $username, $paswword, $email, $role, $status)
{
    include __DIR__. "/../config/config_db.php";

    $hash_pass = password_hash($paswword, PASSWORD_DEFAULT);
    $sql = "update users set username = :username, password = :password, email = :email, role = :role, status = :status where id=:id";
    $stm = $conn->prepare($sql);
    $stm->bindParam(":username", $username);
    $stm->bindParam(":password", $hash_pass);
    $stm->bindParam(":email", $email);
    $stm->bindParam(":role", $role);
    $stm->bindParam(":status", $status);
    $stm->bindParam(":id", $id);
    return $stm->execute();
}

function checkUser($username){

    include __DIR__. "/../config/config_db.php";

    //$hash_pass = password_hash($password, PASSWORD_DEFAULT);
    $sql = "SELECT * FROM users where username = :username";
    $sth = $conn->prepare($sql);
    $sth->bindParam(":username", $username);
    //$sth->bindParam(":password", $password);
    $sth->execute();
    return $sth->fetch(PDO::FETCH_ASSOC);
}

/*create table poducts for testing insert json data into table product
column type specifProduct must be json
*/
function addProduct($title, $category, $content, $keyword, $description, $price, $oldPrice, $productSpecif){
    include __DIR__. "/../config/config_db.php";

    $sql = "insert into products (title, category_id, content, keyword, description, price, oldPrice, productSpecif) values 
(:title, :category_id, :content, :keyword, :description, :price, :oldPrice, :productSpecif)";
    $stm = $conn->prepare($sql);
    $stm->bindParam(":title", $title);
    $stm->bindParam(":category_id", $category);
    $stm->bindParam(":content", $content);
    $stm->bindParam(":keyword", $keyword);
    $stm->bindParam(":description", $description);
    $stm->bindParam(":price", $price);
    $stm->bindParam(":oldPrice", $oldPrice);
    $stm->bindParam(":productSpecif", $productSpecif);
    return $stm->execute();
}

function updateProduct($id, $title, $category, $content, $keyword, $description, $price, $oldPrice, $productSpecif){
    include __DIR__. "/../config/config_db.php";

    $sql = "update products set title = :title, category_id = :category_id, content = :content, keyword =:keyword, description = :description, 
 price = :price, oldPrice = :oldPrice, productSpecif = :productSpecif where id=:id";
    $stm = $conn->prepare($sql);
    $stm->bindParam(":title", $title);
    $stm->bindParam(":category_id", $category);
    $stm->bindParam(":content", $content);
    $stm->bindParam(":keyword", $keyword);
    $stm->bindParam(":description", $description);
    $stm->bindParam(":price", $price);
    $stm->bindParam(":oldPrice", $oldPrice);
    $stm->bindParam(":productSpecif", $productSpecif);
    $stm->bindParam(":id", $id);
    return $stm->execute();
}


//resize image

  /**
     * Метод для проверки ширину и высоту изображение
     * @param string $target путь к оригинальному файлу
     * @param string $dest путь сохранения обработанного файла
     * @param string $wmax максимальная ширина
     * @param string $hmax максимальная высота
     * @param string $ext расширение файла
     */
  function resize($target, $dest, $wmax, $hmax, $ext){

        list($w_orig, $h_orig) = getimagesize($target);
        $ratio = $w_orig / $h_orig; // =1 - квадрат, <1 - альбомная, >1 - книжная

        if(($wmax / $hmax) > $ratio){
            $wmax = $hmax * $ratio;
        }else{
            $hmax = $wmax / $ratio;
        }

        $img = "";
        // imagecreatefromjpeg | imagecreatefromgif | imagecreatefrompng
        switch($ext){
            case("gif"):
                $img = imagecreatefromgif($target);
                break;
            case("png"):
                $img = imagecreatefrompng($target);
                break;
            default:
                $img = imagecreatefromjpeg($target);
        }
        $newImg = imagecreatetruecolor($wmax, $hmax); // создаем оболочку для новой картинки

        /*if($ext == "png"){
            imagesavealpha($newImg, true); // сохранение альфа канала
            $transPng = imagecolorallocatealpha($newImg,0,0,0,127); // добавляем прозрачность
            imagefill($newImg, 0, 0, $transPng); // заливка
        }*/

        imagecopyresampled($newImg, $img, 0, 0, 0, 0, $wmax, $hmax, $w_orig, $h_orig); // копируем и ресайзим изображение
        switch($ext){
            case("gif"):
                imagegif($newImg, $dest);
                break;
            case("png"):
                imagepng($newImg, $dest);
                break;
            default:
                imagejpeg($newImg, $dest);
        }

        imagedestroy($newImg);

    }




















?>

<script type="text/javascript">
    $('.delete').click(function () {
        var res = confirm('Подтвердите действие');
        if(!res) return false;
    });
</script>
