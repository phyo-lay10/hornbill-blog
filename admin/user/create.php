<?php 

    $nameERR = '';
    $emailERR = '';
    $passwordERR = '';

    if(isset($_POST['userCreateBtn'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $role = $_POST['role'];

        if($name == '') {
            $nameERR = 'This field is required';
        } elseif($email =='') {
            $emailERR = 'This field is required';
        }  elseif($password == '') {
            $passwordERR = 'This field is required';
        } else {
            $password = md5($password);   
            $stmt = $db->prepare("INSERT INTO users(name,email,password,role) VALUES('$name', '$email', '$password', '$role')");
            $result = $stmt->execute();
            if($result) {
                // echo "<script> location.href='index.php?page=users' </script>";
                echo "<script>sweetAlert('Congrats!', ' created a new user', 'users')</script>";
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
                    <h6 class="m-0 font-weight-bold text-primary">User Creation Form</h6>
                    <a href="index.php?page=users" class="btn-sm btn-primary"> <i class="fas fa-angle-double-left"></i> Back</a>
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <div class="mb-2">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control">
                            <span class="text-danger"> <?php echo $nameERR; ?></span>
                        </div>
                        <div class="mb-2">
                            <label for="email">Email</label>
                            <input type="text" name="email" id="email" class="form-control">
                            <span class="text-danger"> <?php echo $emailERR; ?></span>
                        </div>
                        <div class="mb-2">
                            <label for="">Role</label>
                            <select name="role" id="" class="form-control">
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                            </select>
                        </div>
                        <div class="mb-2">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password"  class="form-control">
                            <span class="text-danger">  <?php echo $passwordERR; ?></span>
                        </div>
                        <button name="userCreateBtn" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>