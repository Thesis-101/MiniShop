<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

    <title>Register Page</title>
</head>
<body>
    <div class="container w-25 bg-light mt-5 p-5 rounded shadow mb-5">
        <h3 class="text-center">Register</h3>

        <div class="image text-center">
            <img src="<?= base_url('images/default-image.jpg') ?>" alt="profille-image" id="profile-image" class="img-fluid" width="100px" height="100px">
        </div>

        <form action="<?= base_url('auth/create-user') ?>" method="post" enctype="multipart/form-data" class="form">
            <?= csrf_field(); ?>

            <div class="mb-3">
                <label class="form-label" for="name">Name :</label>
                <input class="form-control" type="text" name="name" id="name" value="<?= set_value('name'); ?>">
                <span style="color: red;">
                    <?= isset($validation) ? validation_errors($validation, 'name') : ''?>
                </span>
            </div>

            <div class="mb-3">
                <label class="form-label" for="email">Email :</label>
                <input class="form-control" type="email" name="email" id="email" value="<?= set_value('email'); ?>">
                <span style="color: red;">
                    <?= isset($validation) ? validation_errors($validation, 'email') : ''?>
                </span>
            </div>

            <div class="mb-3">
                <label class="form-label" for="password">Password :</label>
                <input class="form-control" type="password" name="password" id="password">
                <span style="color: red;">
                    <?= isset($validation) ? validation_errors($validation, 'password') : ''?>
                </span>
            </div>

            <div class="mb-3">
                <label class="form-label" for="confirm_password">Confirm Password :</label>
                <input class="form-control" type="password" name="confirm_password" id="confirm_password">
                <span style="color: red;">
                    <?= isset($validation) ? validation_errors($validation, 'confirm_password') : ''?>
                </span>
            </div>

            <div class="mb-3">
                <label class="form-label" for="image">Image :</label>
                <input class="form-control" type="file" id="image" name="image">
                <span style="color: red;">
                    <?= isset($validation) ? validation_errors($validation, 'image') : ''?>
                </span>
            </div>
            
            <button class="btn btn-sm btn-primary form-control mb-2" type="submit">Register</button>
        </form>

        <div class="text-center">
            <a class="" href="<?= site_url('auth/login') ?>"> Already have an account, login.</a>
        </div>
        
    </div>
    
</body>
<script>
    const imageInput = document.getElementById('image');
    imageInput.addEventListener('change', () => {
      const selectedFile = imageInput.files[0];
      const reader = new FileReader();
      reader.readAsDataURL(selectedFile);
      reader.onload = () => {
        const previewImage = document.getElementById('profile-image');
        previewImage.src = reader.result;
        // document.body.appendChild(previewImage);
      };
    });
</script>
</html>