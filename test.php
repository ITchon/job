<?php


require_once  '/vendor/autoload.php';

include ("connect.php");


$sql = "SELECT  * FROM `studying` WHERE `teacher_id`= 3200200636572  ORDER BY FIELD (`dpr2`,'จันทร์','อังคาร','พุธ','พฤหัส','ศุกร์')";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$content = "";
if (mysqli_num_rows($result) > 0) {
    while($row = $result->fetch_assoc()) {
        $content .= '<tr  style="border:1px solid #000;" > 
                <td style="border-right:1px solid #000;padding:3px;text-align:center;" >'.$row['dpr2'].'</td>
                <td style="border-right:1px solid #000;padding:3px;text-align:center;" >'.$row['subject_id'].'</td>
                <td style="border-right:1px solid #000;padding:3px;"  >'.$row['subject_name'].'</td>
                <td style="border-right:1px solid #000;padding:3px;text-align:center;"  >'.$row['dpr3'].'</td>
                <td style="border-right:1px solid #000;padding:3px;text-align:center;"  >'.number_format($row['dpr4'],2).'</td>
                <td style="border-right:1px solid #000;padding:3px;text-align:center;"  >'.$row['price'].'</td>
            </tr>';
    }
}

//mysqli_close($conn);

$mpdf = new \Mpdf\Mpdf();
$sql = "SELECT * FROM studying where teacher_id = 3200200636572";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$head = '
<style>
    body{
        font-family: "Garuda";//เรียกใช้font Garuda สำหรับแสดงผล ภาษาไทย
    }
</style>
 


<h3 style="text-align:center">ใบเบิกค่าสอนพิเศษ</h3>
        <table >
        <tr>
        <td colspan="4"><b>คำขอเบิก</b></td>
         <td style="width: 250px"></td>
        </tr>
        
        <tr>
        <td style="width: 6%">ข้าพเจ้า</td>
        <td style="width: 20%">'.$row['teacher_name'].'</td>
        <td style="width: 40%"></td>
        <td style="width: 10%">ตำแหน่ง</td>
        <tdstyle="width: 20%">'.$row[''].'</td>
        </tr>
        
        <tr>
        <td>สังกัด</td>
        <td>-------------</td>
        <td style="width: 40%"></td>
        <td colspan="2">ขอยื่นคำขอรับเงินพิเศษ<br>ดังต่อไปนี้</td>
        <td></td>
        </tr>   
        
      
        



</table>

 
<table id="bg-table" width="100%" style="border-collapse: collapse;font-size:12pt;margin-top:8px;">
    <tr style="border:1px solid #000;padding:4px;">
        <td  style="border-right:1px solid #000;padding:4px;text-align:center;"   width="10%">ว/ด/ป</td>
        <td  style="border-right:1px solid #000;padding:4px;text-align:center;"  width="15%">รหัสวิชา</td>
        <td  width="45%" style="border-right:1px solid #000;padding:4px;text-align:center;">&nbsp;ชั้นเรียน</td>
        <td  style="border-right:1px solid #000;padding:4px;text-align:center;"  width="15%">เวลาที่สอน</td>
        <td  style="border-right:1px solid #000;padding:4px;text-align:center;" width="15%">ชั่วโมงสอน</td>
          <td  style="border-right:1px solid #000;padding:4px;text-align:center;" width="15%">หมายเหตุ</td>
    </tr>
 
</thead>
    <tbody>';

$end = "</tbody>
</table>";

$mpdf->WriteHTML($head);

$mpdf->WriteHTML($content);

$mpdf->WriteHTML($end);

$mpdf->Output();