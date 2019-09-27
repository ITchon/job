
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
                        <h4 class="card-title text-primary">ค้นหาข้อมูลตารางสอน</h4>
                            <form action="select_teacher.php" method="get" >
                                    <div class="form-group">
                                            <select class="js-example-basic-multiple-limit form-control col-md-4" name="people_id" >
                                            <option value="" class="">---------- กรุณาเลือกชื่อ -------------</option>
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
                            where teacher_id=$people_id group by dpr3 order by dpr1 " ;
                            $res2=mysqli_query($conn,$sql2);
                            $row2=mysqli_fetch_assoc($res2);

                        ?>        
                        <br><div class="container-fluid">
                        <div class="row">
                            <div class="col-md-4 text-info"><h5>ตารางครูผู้สอน :<b> <?php echo $row2['teacher_name']?></b></h5> </div>
                            <div class="col-md-4 text-info"><h5>รหัสครูผู้สอน : <b> <?php echo $row2['people_id']?></b></h5> </div>
                            <div class="col-md-4 text-info"><h5>ครูประจำแผนก : <b> #####</b></h5> </div>
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
                                    <th> ชั่วโมงเวลาสอน </th>
                                </tr>
                            </thead>
                                <tbody>  
                                <?php   $dpr_1=null;  
                                        $dpr_2=null;  
                                        $data_show=1;    // 1 แสดง 0 ไม่แสดง  
                                        $sum_dpr4=0;
                                        while($row2=mysqli_fetch_assoc($res2)){  
                                            $dpr_1=$row2['dpr2'];  
                                            if($dpr_2==null){  
                                                $dpr_2=$dpr_1;  
                                                $data_show=1;     
                                            }else{  
                                                if($dpr_1==$dpr_2){  
                                                    $data_show=0;   
                                                    $dpr_2=$dpr_1;  
                                                }else{
                                                    $dpr_2=$dpr_1;  
                                                    $data_show=1;               
                                                }
                                            }

                                            $sum_dpr4 =$row2["dpr4"] + $sum_dpr4;

                                        ?>    
                                    <tr><?php if($data_show==1){?>  
                                        <td><?php echo $row2['dpr2'] ?></td>  
                                        <?php }
                                        else{ ?>
                                         <?php
                                            echo "<td></td>"; 
                                            }?> 
                                        <td> <?php echo $row2['dpr3']?> </td>
                                        <td> <?php echo $row2['group_name']?> </td>   
                                        <td> <?php echo $row2['dpr1']?> </td>
                                        <td> <?php echo $row2['dpr4']?></td>
                                        
                                    </tr>
                                    <?php }?>
                                    <tr>
                                    <td><a href="test.php"><button type="button" class="btn btn-gradient-warning btn-icon-text"> PDF <i class="mdi mdi-printer btn-icon-append"></i></button></a></td>
                                    <td></td>
                                    <td></td>
                                    <th>รวมชั่วโมงการสอน :</th>
                                    <td> <?php echo $sum_dpr4?></td>
                                    </tr>
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