
<?php 
    $nameERR = '';
    if(isset($_POST['categoryCreateBtn'])) {
        $name = $_POST['name'];
        if($name === '') {
             $nameERR = "This field is required";
        } else {
            $stmt = $db->prepare("INSERT INTO categories (name) VALUES ('$name')");
            $stmt->execute();
            echo "<script>sweetAlert('Congrats!', 'created a new category', 'category')</script>";
        }
    }
?>

<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <!-- <h1 class="h3 mb-0 text-gray-800">Category Create Form</h1> -->
    </div>
    <!-- Content Row -->
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Category Creation Form</h6>
                    <a href="index.php?page=category" class="btn-sm btn-primary"> <i class="fas fa-angle-double-left"></i> Back</a>
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <div class="mb-2">
                            <label for="">Name</label>
                            <input type="text" name="name" class="form-control">
                            <span class="text-danger"> <?php echo $nameERR ?> </span>
                        </div>
                        <!-- <div class="mb-2">
                            <label for="">Email</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="mb-2">
                            <label for="">Address</label>
                            <textarea name="" id="" rows="5" class="form-control"></textarea>
                        </div> -->
                        <button name="categoryCreateBtn" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>