<?php


require_once  '/vendor/autoload.php';

//ตั้งค่าการเชื่อมต่อฐานข้อมูล
$servername = "localhost";
$username = "root";
$password = "123456789";
$dbname = "notebook";
$conn = mysqli_connect($servername, $username, $password, $dbname);

mysqli_set_charset($conn, "utf8");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM products";

$result = mysqli_query($conn, $sql);
$content = "";
if (mysqli_num_rows($result) > 0) {
    $i = 1;
    while($row = mysqli_fetch_assoc($result)) {
        $content .= '<tr style="border:1px solid #000;">
                <td style="border-right:1px solid #000;padding:3px;text-align:center;"  >'.$i.'</td>
                <td style="border-right:1px solid #000;padding:3px;text-align:center;" >'.$row['id'].'</td>
                <td style="border-right:1px solid #000;padding:3px;"  >'.$row['name'].'</td>
                <td style="border-right:1px solid #000;padding:3px;text-align:center;"  >'.$row['price'].'</td>
                <td style="border-right:1px solid #000;padding:3px;text-align:right;"  >'.number_format($row['price'],2).'</td>
            </tr>';
        $i++;
    }
}

mysqli_close($conn);

$mpdf = new \Mpdf\Mpdf();

$head = '
<style>
    body{
        font-family: "Garuda";//เรียกใช้font Garuda สำหรับแสดงผล ภาษาไทย
    }
</style>
 
<h2 style="text-align:center">ใบรับสินค้า</h2>
 
<table id="bg-table" width="100%" style="border-collapse: collapse;font-size:12pt;margin-top:8px;">
    <tr style="border:1px solid #000;padding:4px;">
        <td  style="border-right:1px solid #000;padding:4px;text-align:center;"   width="10%">ลำดับ</td>
        <td  style="border-right:1px solid #000;padding:4px;text-align:center;"  width="15%">รหัสสินค้า</td>
        <td  width="45%" style="border-right:1px solid #000;padding:4px;text-align:center;">&nbsp;รายละเอียดสินค้า</td>
        <td  style="border-right:1px solid #000;padding:4px;text-align:center;"  width="15%">หน่วยนับ</td>
        <td  style="border-right:1px solid #000;padding:4px;text-align:center;" width="15%">ราคา (฿)</td>
    </tr>
 
</thead>
    <tbody>';

$end = "</tbody>
</table>";

$mpdf->WriteHTML($head);

$mpdf->WriteHTML($content);

$mpdf->WriteHTML($end);

$mpdf->Output();