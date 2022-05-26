<?php
// require "../../Models/Medicine/Medicine.php";
// require "../../Models/ConnectionConfig/Database.php";
class MedicineInStock
{
    public static function Pagination()
    {  
        $count = Medicine::fetchCountTotal();
        if($count->num_rows > 0){
            $row = $count->fetch_assoc();
            $total_records = $row['total'];
        }
        
        $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
        $limit = 6;
        
        $total_page = ceil($total_records / $limit);
        
        if ($current_page > $total_page) {
            $current_page = $total_page;
        } else if ($current_page < 1) {
            $current_page = 1;
        }
        
        $start = ($current_page - 1) * $limit;
        $result = Medicine::fetchMedicinePage($start, $limit);
        return $result;
    }
}

// $aa = MedicineInStock::Pagination();
// $i = 0;
// $temp = "";
// while ($row = $aa->fetch_assoc()) {
//     $temp .= "<div id='".$i."'>" . $row['medicine_name'] . "</div>" ;
//     $i++;
// }
// echo $temp;
?>