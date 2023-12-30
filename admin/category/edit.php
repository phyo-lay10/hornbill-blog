<?php 
    $categoryId = $_GET['category_id'];

    #get old category
    $stmt = $db->prepare("SELECT * FROM categories WHERE id=$categoryId");
    $stmt->execute();
    $category = $stmt->fetchObject();

    #update category
    $nameERR ='';
    if(isset($_POST['categoryUpdateBtn'])) {
        $name = $_POST['name'];
        if($name ==='') {
            $nameERR = 'This field is required';
        } else {
            $stmt = $db->prepare(" UPDATE categories SET name='$name' WHERE id= $categoryId ");
            $stmt->execute();
            // echo "<script>location.href='index.php?page=category'</script>";
            echo "<script>sweetAlert('Alright!', ' updated a category', 'category')</script>";
        }
    }

?>

<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <!-- <h1 class="h3 mb-0 text-gray-800">Category Edit Form</h1> -->
    </div>
    <!-- Content Row -->
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Category Edit Form</h6>
                    <a href="index.php?page=category" class="btn-sm btn-primary"> < Back</a>
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <div class="mb-2">
                            <label for="">Name</label>
                            <input type="text" value="<?php echo $category->name ?>" name="name" class="form-control">
                            <span class="text-danger"><?php echo $nameERR; ?></span>
                        </div>
                        <!-- <div class="mb-2">
                            <label for="">Email</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="mb-2">
                            <label for="">Address</label>
                            <textarea name="" id="" rows="5" class="form-control"></textarea>
                        </div> -->
                        <button name="categoryUpdateBtn" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>