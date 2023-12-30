<?php 
    $userId = $_GET['user_id'];
    $stmt = $db->prepare("SELECT * FROM users WHERE id=$userId");
    $stmt->execute();
    $user = $stmt->fetchObject();

    $nameERR = '';
    $emailERR = '';
    $passwordERR = '';

    if(isset($_POST['userUpdateBtn'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $role = $_POST['role'];

        if($name == '') {
            $nameERR = 'This field is required';
        } elseif($email =='') {
            $emailERR = 'This field is required';
        } else {

            if($password == '') {
                $stmt = $db->prepare("UPDATE `users` SET name='$name',email='$email',role='$role' WHERE id=$userId");
            } else {
                $password = md5($password);
                $stmt = $db->prepare("UPDATE `users` SET name='$name',email='$email',password='$password',role='$role' WHERE id=$userId");
            }
            $result = $stmt->execute();
            if($result) {
                // echo "<script> location.href='index.php?page=users' </script>";
                echo "<script>sweetAlert('Alright!', ' edited a user', 'users')</script>";
            }
        }
        
    }
?>

<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <!-- <h1 class="h3 mb-0 text-gray-800">User Edit Form</h1> -->
    </div>
    <!-- Content Row -->
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">User Edition Form</h6>
                    <a href="index.php?page=users" class="btn-sm btn-primary"> <i class="fas fa-angle-double-left"></i> Back</a>
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <div class="mb-2">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" value="<?php echo $user->name ?>" class="form-control">
                            <span class="text-danger"> <?php echo $nameERR; ?></span>
                        </div>
                        <div class="mb-2">
                            <label for="email">Email</label>
                            <input type="text" name="email" id="email" value="<?php echo $user->email ?>" class="form-control">
                            <span class="text-danger"> <?php echo $emailERR; ?></span>
                        </div>
                        <div class="mb-2">
                            <label for="">Role</label>
                            <select name="role" id="" class="form-control">
                                <option value="admin"
                                <?php if($user->role == 'admin'): ?>
                                    selected
                                    <?php endif; ?>
                                >Admin</option>
                                <option value="user"
                                <?php if($user->role == 'user'): ?>
                                    selected
                                    <?php endif; ?>
                                >User</option>
                            </select>
                        </div>
                        <div class="mb-2">
                            <label for="password">Password</label>
                            <input type="checkbox" id="checkbox" 
                            onclick="showPasswordInput()">
                            <input type="text" name="password" class="form-control" style="display: none;" id="password-input" placeholder="Enter a new password">
                            <span class="text-danger">  <?php echo $passwordERR; ?></span>
                        </div>
                        <button name="userUpdateBtn" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    
    function showPasswordInput() {
        let passwordInput = document.getElementById('password-input');
        let checkbox = document.getElementById('checkbox');

        if(checkbox.checked) {
            passwordInput.style.display = 'block';
        }else {
            passwordInput.style.display = 'none';
        }
    }
</script>