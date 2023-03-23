<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

    <title>Login Page</title>
</head>
<body>
    <div class="container w-25 bg-light mt-5 p-5 rounded shadow">
        <h3 class="text-center">Login</h3>
        <form action="<?= base_url('auth/login') ?>" method="post" class="form">
            <?php
                if(session()->getFlashdata('status'))
                {
                    echo "<small class='text-center text-danger'>".session()->getFlashdata('status')."</small>";
                } 
            ?>
            <?= csrf_field(); ?>
            <div class="mb-3">
                <label class="form-label" for="email">Email :</label>
                <input class="form-control" type="email" name="email" id="email" required>
                <span style="color: red;">
                    <?= isset($validation) ? validation_errors($validation, 'email') : ''?>
                </span>
            </div>

            <div class="mb-3">
                <label class="form-label" for="password">Password :</label>
                <input class="form-control" type="password" name="password" id="password" required>
                <span style="color: red;">
                    <?= isset($validation) ? validation_errors($validation, 'password') : ''?>
                </span>
            </div>

            <button type="submit" class="btn btn-sm btn-primary form-control mb-2">Login</button>
        </form>

        <a href="<?= site_url('auth/register') ?>"> Create new account.</a>
    </div>
    
</body>
</html>