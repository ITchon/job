
<?php include('menu.php');
 include('connect.php');

 $sql="select * from studying 
 inner join people on studying.teacher_id=people.people_id
 inner join std_group on studying.student_group_id=std_group.group_id
 group by people_id";
 $res=mysqli_query($conn,$sql);

    ?>
<link href="css/select2.min.css" rel="stylesheet" />
<script src="js/select2.min.js"></script>

<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12">
        <div class="col-lg-12 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body">
                        <h4 class="card-title text-info">ค้นหาข้อมูลตารางสอน</h4>
                            <form action="select_teacher.php" method="get" >
                                    <div class="form-group">
                                            <select class="js-example-basic-multiple-limit form-control col-md-4" name="people_id" >
                                            <option value="">---------- กรุณาเลือกชื่อ -------------</option>
                                            <?php while($row=mysqli_fetch_assoc($res)){ ?>
                                                    
                                            <option value="<?php echo $row['people_id']?>"> <?php echo $row['people_id']?> <?php echo $row['people_name']."  ".$row['people_surname']?> </option>
                                        
                                        <?php } ?>
                                        
                                    </select>
                                    </div>
                                    
                                    <button type="submit" class="btn btn-gradient-info btn-rounded btn-fw">OK</button> 
                                </form>
                        
                        <?php
                        $people_id=$_GET['people_id'];
                        if($people_id==''){
                                ?>
                                <script>
                            alert(" กรุณาเลือกชื่อ ");
                            </script>
                                <?php
                        }   
                        else if($people_id=$_GET['people_id']){
                            $sql2="select * from studying 
                            inner join people on studying.teacher_id=people.people_id
                            inner join std_group on studying.student_group_id=std_group.group_id
                            where teacher_id=$people_id order by dpr1 " ;
                            $res2=mysqli_query($conn,$sql2);
                            $row2=mysqli_fetch_assoc($res2);

                        ?>        
                        <br><div class="container-fluid">
                        <div class="row">
                            <div class="col-md-4 text-info"><h5>ตารางครูผู้สอน :<b> <?php echo $row2['teacher_name']?></b></h5> </div>
                            <div class="col-md-4 text-info"><h5>รหัสครูผู้สอน : <b> <?php echo $row2['people_id']?></b></h5> </div>
                            <div class="col-md-4 text-info"><h5> : <b> #####</b></h5> </div>
                        </div>
                        </div>
                        <br>
                        
                        
                        <table id="example" class="table table-hover ">
                            <thead>
                                <tr>
                                    <th> วันที่สอน </th>
                                    <th> เวลา</th>
                                    <th> ชื่อกลุ่ม</th>
                                    <th> รหัสวิชา </th>
                                </tr>
                            </thead>
                                <tbody>
                                    <tr> 
                                    <?php while($row2=mysqli_fetch_assoc($res2)){ 
                                    ?>
                                        <td><?php 
                                        if($row2['dpr2']=='จันทร์'){
                                            echo "จันทร์";
                                        } 
                                        if($row2['dpr2']=='อังคาร'){
                                            echo "อังคาร";
                                        } 
                                        if($row2['dpr2']=='พุธ'){
                                            echo "พุธ";
                                        } 
                                        if($row2['dpr2']=='พฤหัส'){
                                            echo "พฤหัส";
                                        } 
                                        if($row2['dpr2']=='ศุกร์'){
                                            echo "ศุกร์";
                                        } 
                                        ?></td>
                                        
                                        <td><?php echo $row2['dpr3']?></td>
                                        <td> <?php echo $row2['group_name']?> </td>   
                                        <td> <?php echo $row2['dpr1']?> </td>   
                                    </tr>
                                    <?php } ?>
                                </tbody>
                        </table>
                        <?php } ?>
                    </div>

                  </div>
                </div>
              </div>
            </div>
          </div>    



        </div>
    </div>
</div>


<script>
        $(document).ready(function() {
          $('#example').DataTable();
        } );
        $(document).ready(function() {
            $(".js-example-basic-multiple-limit").select2({
        maximumSelectionLength: 2
        });
            });
      </script>