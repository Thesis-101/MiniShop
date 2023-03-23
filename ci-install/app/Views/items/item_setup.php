<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

    <title>Add Item</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">SULITPC.COM</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="<?= base_url('/') ?>">Sell Items</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="<?= base_url('profile') ?>">Profile</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="<?= site_url('auth/logout') ?>">Logout</a>
                </li>
            </ul>
            
            </div>
        </div>
    </nav>

    <div class="container w-25 bg-light mt-5 p-5 rounded shadow mb-5">
        <h3 class="text-center">Item Details</h3>

        <form action="<?= base_url('add-item') ?>" method="post" class="form">
            <?= csrf_field(); ?>

            <div class="mb-3">
                <label class="form-label" for="item_name">Item Name :</label>
                <input class="form-control" type="text" name="item_name" id="item_name" value="<?= set_value('item_name'); ?>">
                <span style="color: red;">
                    <?= isset($validation) ? validation_errors($validation, 'item_name') : ''?>
                </span>
            </div>

            <div class="mb-3">
                <label class="form-label" for="description">Item Description :</label>
                <input class="form-control" type="text" name="description" id="description" value="<?= set_value('description'); ?>">
                <span style="color: red;">
                    <?= isset($validation) ? validation_errors($validation, 'description') : ''?>
                </span>
            </div>

            <div class="mb-3">
                <label class="form-label" for="quantity">Quantity :</label>
                <input class="form-control" type="text" name="quantity" id="quantity">
                <span style="color: red;">
                    <?= isset($validation) ? validation_errors($validation, 'quantity') : ''?>
                </span>
            </div>

            <div class="mb-3">
                <label class="form-label" for="price">Price :</label>
                <input class="form-control" type="text" name="price" id="price">
                <span style="color: red;">
                    <?= isset($validation) ? validation_errors($validation, 'price') : ''?>
                </span>
            </div>
            
            <button class="btn btn-md btn-primary form-control mb-2" type="submit">Add Item</button>
        </form>
        <a href="<?= base_url('/') ?>">Back</a>
    </div>
</body>

</html>