<?php
    // header
    require_once('layout/header.php');

    // navbar
    require_once('layout/navbar.php');

    #get a blog
    $blogId = $_GET['blog_id'];
    $stmt = $db->prepare("SELECT blogs.title, blogs.content, blogs.image, blogs.created_at, users.name FROM blogs INNER JOIN users ON blogs.user_id = users.id WHERE blogs.id = $blogId");
    $stmt->execute();
    $blog = $stmt->fetchObject();

    #create comment 
    if(isset($_POST['createCommentBtn'])) {
        $text = $_POST['text'];
        $userId = $_SESSION['user']->id;
        $date = date('Y-m-d H:i:s');
        $stmt = $db->prepare("INSERT INTO comments(text, blog_id, user_id, created_at) VALUES ('$text',$blogId,$userId,'$date')");
        $result = $stmt->execute();

        if($result) {
            echo "<script>sweetAlert('Congrats!', 'made a comment','blog-detail.php?blog_id=" . $blogId . " ')</script>";
        }

    }

    #get comments depending on blog
    $commentStmt = $db->prepare("SELECT comments.text, comments.created_at, users.name  FROM comments INNER JOIN users ON comments.user_id = users.id WHERE blog_id = $blogId");
    $commentStmt->execute();
    $comments = $commentStmt->fetchAll(PDO::FETCH_OBJ);
?>

    <div id="blog-detail">
        <div class="container">
            <div class="row mt-5">
                <div class="col-md-8">
                    <h3 data-aos="fade-right" data-aos-duration="1000">Blog Detail</h3>
                    <div class="heading-line" data-aos="fade-left" data-aos-duration="1000"></div>
                    <div class="card my-3" data-aos="zoom-in" data-aos-duration="1000">
                        <div class="card-body p-0">
                            <div class="img-wrapper">
                                <img src="assets/blog-images/<?php echo $blog->image ?>" class="img-fluid">
                            </div>
                            <div class="content p-3">
                                <h5 class="fw-bold"><?php echo $blog->title ?></h5>
                                <div class="mb-3"><?php echo $blog->created_at?>| by 
                                    <?php echo $blog->name ?>
                                </div>
                                
                                <p>
                                    <?php echo $blog->content ?>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Comment Section -->
                    <div class="comment">
                        <?php if(isset($_SESSION['user'])): ?>
                        <h5 data-aos="fade-right" data-aos-duration="1000">Leave a Comment</h5>
                        <form method="post" data-aos="fade-left" data-aos-duration="1000">
                            <div class="mb-2">
                                <!-- <input type="hidden" name="blog_id" value="<?php echo $blogId ?>"> -->
                                <textarea name="text" class="form-control" rows="5" required></textarea>
                            </div>
                            <button name="createCommentBtn" class="btn">Submit</button>
                        </form>
                        <?php else: ?>
                            <a href="#signIn" data-bs-toggle="offcanvas" aria-controls="staticBackdrop" class="btn btn-primary">Sign in to comment</a>
                        <?php endif; ?>

                        <h6 class="fw-bold mt-3">Users' comments</h6>
                        <?php foreach( $comments as $comment): ?>
                        <div class="card card-body my-3" data-aos="fade-right" data-aos-duration="1000">
                            <h6><?php echo $comment->name ?></h6>
                            <?php echo $comment->text ?>
                            <div class="mt-3">
                                <span class="float-end"><?php echo $comment->created_at ?></span>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php require_once('layout/rightside.php'); ?>
            </div>
        </div>
    </div>

<?php
    require_once('layout/footer.php');
?>