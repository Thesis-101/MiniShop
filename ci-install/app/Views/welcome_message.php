<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

    <title>Document</title>
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

    <table class="table caption-top container mt-5">
        <caption>
            <a class="btn btn-md btn-primary" href="<?= site_url('item-setup') ?>">Add Item</a>
        </caption>
        <thead>
            <tr>
                <th scope="col">Quantity</th>
                <th scope="col">Name of Product</th>
                <th scope="col">Description</th>
                <th scope="col">Price</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($items as $item) { ?>
                <tr>
                    <th scope="row"><?= $item['quantity'] ?></th>
                    <td><?= $item['item_name'] ?></td>
                    <td><?= $item['description'] ?></td>
                    <td><?= $item['price'] ?></td>
                    <td>
                        <a class="btn btn-sm btn-warning" href="<?= base_url('item-setup/edit/'.$item['id']) ?>">Edit</a>
                        <a class="btn btn-sm btn-danger" href="<?= base_url('item-setup/delete/'.$item['id']) ?>">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>

</html>