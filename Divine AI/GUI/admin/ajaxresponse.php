<?php
include_once '../../DAL/Database.php';
/**$database = new Database;
$db = $database->getConnection();
$conn = $db->conn;
var_dump($conn);**/
    $hostname = 'localhost';
    $username = 'root';
    $password = '';
    $db = 'business';
$conn = new PDO("mysql:host=" . $hostname . ";dbname=" . $db,
            $username, $password);
##var_dump($conn);
## Read value
$draw = $_POST['draw'];
$row = $_POST['start'];
$rowperpage = $_POST['length']; // Rows display per page
$columnIndex = $_POST['order'][0]['column']; // Column index
$columnName = $_POST['columns'][$columnIndex]['data']; // Column name
$columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
$searchValue = $_POST['search']['value']; // Search value

$searchArray = array();

## Search 
$searchQuery = " ";
if($searchValue != ''){
   $searchQuery = "SELECT * FROM taskovi WHERE (naziv LIKE :naziv or 
        opis LIKE :opis OR 
        naziv_radnog_mesta LIKE :naziv_radnog_mesta ) ";
   $searchArray = array( 
        'naziv'=>"%$searchValue%", 
        'opis'=>"%$searchValue%",
        'naziv_radnog_mesta'=>"%$searchValue%"
   );
}

## Total number of records without filtering
$stmt = $conn->prepare("SELECT COUNT(*) AS allcount FROM taskovi ");
$stmt->execute();
$records = $stmt->fetch();
$totalRecords = $records['allcount'];

## Total number of records with filtering
$stmt = $conn->prepare("SELECT COUNT(*) AS allcount FROM taskovi WHERE 1 ".$searchQuery);
$stmt->execute($searchArray);
$records = $stmt->fetch();
$totalRecordwithFilter = $records['allcount'];

## Fetch records
$stmt = $conn->prepare("SELECT * FROM taskovi WHERE 1 ".$searchQuery." ORDER BY ".$columnName." ".$columnSortOrder." LIMIT :limit,:offset");

// Bind values
foreach($searchArray as $key=>$search){
   $stmt->bindValue(':'.$key, $search,PDO::PARAM_STR);
}

$stmt->bindValue(':limit', (int)$row, PDO::PARAM_INT);
$stmt->bindValue(':offset', (int)$rowperpage, PDO::PARAM_INT);
$stmt->execute();
$empRecords = $stmt->fetchAll();

$data = array();

foreach($empRecords as $row){
   $data[] = array(
      "naziv"=>$row['naziv'],
      "opis"=>$row['opis'],
      "naziv_radnog_mesta"=>$row['naziv_radnog_mesta'],
      "id_task"=>$row['id_task'],
      "id_radno_mesto"=>$row['id_radno_mesto']
   );
}

## Response
$response = array(
   "draw" => intval($draw),
   "iTotalRecords" => $totalRecords,
   "iTotalDisplayRecords" => $totalRecordwithFilter,
   "aaData" => $data
);

echo json_encode($response);
