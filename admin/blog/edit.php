<?php 

    $blogId = $_GET['blog_id'];

    #get categories
    $stmt = $db->prepare("SELECT * FROM categories");
    $stmt->execute();
    $categories = $stmt->fetchAll(PDO::FETCH_OBJ);

    #get blogs

    $blogStmt = $db->prepare("SELECT * FROM blogs WHERE id=$blogId");
    $blogStmt->execute();
    $blog = $blogStmt->fetchObject();


    #update blogs

    $titleERR = '';
    $categoryERR = '';
    $contentERR = '';
    $imageERR = '';

    if(isset($_POST['blogUpdateBtn'])) {
        $title = $_POST['title'];
        $categoryId = $_POST['category_id'];
        $content = $_POST['content'];
        $user_id = $_SESSION['user']->id;

        $imageName = $_FILES['image']['name'];
        $imageTmpName = $_FILES['image']['tmp_name'];
        $imageType = $_FILES['image']['type'];


        if($title == '') {
            $titleERR = 'this field is required';
        } elseif($categoryId == '') {
            $categoryERR = 'this field is required';
        } elseif($content == '') {
            $contentERR = 'this field is required';
        } else {
            if($imageName == '') {
                // $imageERR = 'this field is required'; 
                $stmt = $db->prepare("UPDATE blogs SET title='$title', category_id=$categoryId, content='$content' WHERE id=$blogId");
            } else {
                #delete old photo
                unlink("../assets/blog-images/$blog->image");
                if (in_array($imageType,['image/jpg', 'image/jpeg', 'image/png'])) {
                    move_uploaded_file($imageTmpName, "../assets/blog-images/$imageName");
                }
                $stmt = $db->prepare("UPDATE blogs SET title='$title', category_id=$categoryId, content='$content' , image='$imageName' WHERE id=$blogId");
            } 
            $result = $stmt->execute();

            if($result) {
                // echo "<script> location.href='index.php?page=blogs' </script>";
                echo "<script>sweetAlert('Alright!', ' updated a blog', 'blogs')</script>";
            }
        }
    }
?>

<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <!-- <h1 class="h3 mb-0 text-gray-800">Blog Edit Form</h1> -->
    </div>
    <!-- Content Row -->
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Blog Edition Form</h6>
                    <a href="index.php?page=blogs" class="btn-sm btn-primary"> <i class="fas fa-angle-double-left"></i> Back</a>
                </div>
                <div class="card-body">
                    <form  method="post" enctype="multipart/form-data">
                        <div class="mb-2">
                            <label for="title">Title</label>
                            <input type="text" name="title" value="<?php echo $blog->title ?>" id="title" class="form-control">
                            <span class="text-danger"><?php echo $titleERR; ?></span>
                        </div>
                        <div class="mb-2">
                            <label for="category">Category</label>
                            <select name="category_id" class="form-control">
                                <option value="">Select Category</option>
                                <?php foreach($categories as $category): ?>
                                <option value="<?php echo $category->id ?>"
                                <?php if($category->id == $blog->category_id) {
                                     echo "selected";
                                    }  
                                ?>
                                >
                                <?php echo $category->name ?></option>
                                <?php endforeach; ?>
                            </select>
                            <span class="text-danger"><?php echo $categoryERR; ?></span>
                        </div>
                        <div class="mb-2">
                            <label for="content">Content</label>
                            <textarea name="content" class="form-control" rows="10"><?php echo $blog->content ?></textarea>
                            <span class="text-danger"><?php echo $contentERR; ?></span>
                        </div>
                        <div class="mb-2">
                            <label for="image">Image</label>
                            <input type="file" name="image" id="image" value="<?php echo $blog->image ?>"  class="form-control">
                            <img src="../assets/blog-images/<?php echo $blog->image?>" style="width:100px">
                            <span class="text-danger"><?php echo $imageERR; ?></span>
                        </div>
                        <button name="blogUpdateBtn" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>