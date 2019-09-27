<!DOCTYPE html>
<html lang="en">
<body>
<?php
include ("connect.php");
include("header.php");
$sql = "SELECT * FROM people ";
$result = $conn->query($sql);

?>

<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12">
<span class="d-flex align-items-center purchase-popup ">
                <h2>แสดง</h2><?php /*echo $row1["group_name"]; */?><!-- <button onclick="document.getElementById('id02').style.display='block'" class="btn btn-gradient-danger insert_data  btn-rounded"  id="<?php /*echo $row["id"]; */?>">เพิ่มข้อมูล</button>-->
                </span>
        </div>
    </div>



    <div class="row">
        <div class="col-md-12">
            <table id="example" class="table table-bordered text-center bg-white"style="width:100%" >
              <thead>
              <body>
              <tr class="bg-danger text-white">

                  <th>รหัสครูผู้สอน</th>
                  <th>ชื่อ</th>
                  <th>นามสกุล</th>
                  <th>อีเมลล์</th>
                  <th>รายละเอียดสินค้า</th>
                  <th>แก้ไข</th>
                  <th>ลบ</th>
                 </tr>
                <tbody>


                <?php  while($row = $result->fetch_assoc()) {

                  ?>
            <tr> <td> <?php echo $row["people_id"]; ?></td>
                <td><?php echo$row ["people_name"] ?></td>
                <td><?php echo$row ["people_surname"] ?></td>

                <td> <?php echo $row["people_email"]; ?></td>
                <td><?php echo$row ["detail"] ?></td>
                <td><input type="button" name="edit" value="Edit" id="<?php echo $row["id"]; ?>" class="btn btn-outline-info btn-sm edit_data" /></td>
                <td ><a href='delete.php?id=<?php echo$row['id']?>' onclick="return confirm('คุณต้องการลบข้อมูลที่เลือก?')"><button  class="btn btn-outline-danger btn-sm delete">ลบ</button></a> </td>
            </tr>



            <?php
        }

        ?>

        </tbody>
    </table>
        </div>

</body>
</html>
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    } );
    $(document).ready(function(){
        $(document).on('click', '.edit_data', function(){
            var id = $(this).attr("id");
            $.ajax({
                url:"fetch.php",
                method:"POST",
                data:{id:id},
                dataType:"json",
                success:function(data){
                    $('#name').val(data.name);
                    $('#price').val(data.price);
                    $('#brand').val(data.brand);
                    $('#detail').val(data.detail);

                    $('#id').val(data.id);
                    $('#add_data_Modal').modal('show');

                }
            });
        });


    });
</script>



