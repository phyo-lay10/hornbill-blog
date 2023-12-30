<?php 

    #get categories
    $stmt = $db->prepare("SELECT * FROM categories");
    $stmt->execute();
    $categories = $stmt->fetchAll(PDO::FETCH_OBJ);

    #create category
    $titleERR = '';
    $categoryERR = '';
    $contentERR = '';
    $imageERR = '';

    if(isset($_POST['blogCreateBtn'])) {
        $title = $_POST['title'];
        $categoryId = $_POST['category_id'];
        $content = $_POST['content'];
        $user_id = $_SESSION['user']->id;
        $created_at = date('Y-m-d H:i:s');

        $imageName = $_FILES['image']['name'];
        $imageTmpName = $_FILES['image']['tmp_name'];
        $imageType = $_FILES['image']['type'];


        if($title == '') {
            $titleERR = 'this field is required';
        } elseif($categoryId == '') {
            $categoryERR = 'this field is required';
        } elseif($content == '') {
            $contentERR = 'this field is required';
        } elseif($imageName == '') {
            $imageERR = 'this field is required';
        } else {
            $imageName = uniqid(). '_' .$imageName;
            if(in_array($imageType,['image/jpg', 'image/jpeg', 'image/png'])) {
                move_uploaded_file($imageTmpName, "../assets/blog-images/$imageName");
             }
             $stmt = $db->prepare("INSERT INTO blogs (title, category_id,content, image, user_id, created_at) VALUES('$title', $categoryId, '$content', '$imageName', $user_id, ' $created_at')");

             $result = $stmt->execute();

             if($result) {
                // echo "<script> location.href='index.php?page=blogs' </script>";
                echo "<script>sweetAlert('Congrats!', ' created a new blog', 'blogs')</script>";
             }
        }
    }
?>

<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <!-- <h1 class="h3 mb-0 text-gray-800">User Create Form</h1> -->
    </div>
    <!-- Content Row -->
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Blog Creation Form</h6>
                    <a href="index.php?page=blogs" class="btn-sm btn-primary"> <i class="fas fa-angle-double-left"></i> Back</a>
                </div>
                <div class="card-body">
                    <form  method="post" enctype="multipart/form-data">
                        <div class="mb-2">
                            <label for="title">Title</label>
                            <input type="text" name="title" id="title" class="form-control">
                            <span class="text-danger"><?php echo $titleERR; ?></span>
                        </div>
                        <div class="mb-2">
                            <label for="category">Category</label>
                            <select name="category_id" class="form-control">
                                <option value="">Select Category</option>
                                <?php foreach($categories as $category): ?>
                                <option value="<?php echo $category->id ?>"><?php echo $category->name ?></option>
                                <?php endforeach; ?>
                            </select>
                            <span class="text-danger"><?php echo $categoryERR; ?></span>
                        </div>
                        <div class="mb-2">
                            <label for="content">Content</label>
                            <textarea name="content" class="form-control" id="" rows="10"></textarea>
                            <span class="text-danger"><?php echo $contentERR; ?></span>
                        </div>

                        <div class="mb-2">
                            <label for="image">Image</label>
                            <input type="file" name="image" id="image"  class="form-control">
                            <span class="text-danger"><?php echo $imageERR; ?></span>
                        </div>
                        <button name="blogCreateBtn" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>