
<?php include('menu.php');
 include('connect.php');

?>




    <div class="content-wrapper">
        <div class="row">
        <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-danger card-img-holder text-white">
                <div class="card-body">

        
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h1 class="font-weight-normal mb-3">สินค้าทั้งหมด
                    </h1>
                    <h1 class="mb-5"><?php echo $countid['gg']?> รายการ</h1>

                </div>
            </div>
        </div>
        <div class="col-md-8 stretch-card grid-margin">
            <div class="card bg-gradient-success card-img-holder text-white">
                <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Visitors Online <i class="mdi mdi-diamond mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5"><?php echo $count_type1['type']?></h2>
                    <h6 class="card-text">Increased by 5%</h6>
                </div>
            </div>
        </div>







<?php include('table.php') ?>

    </div>

