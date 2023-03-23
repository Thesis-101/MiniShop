<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

    <title>Email Verification</title>
</head>
<body>
    <div class="container w-25 bg-light mt-5 p-5 rounded shadow mb-5">
        <h3 class="text-center mb-3">Email Verification</h3>
        <form action="<?= base_url('auth/verifying') ?>" method="post">
            <input type="hidden" name="_method" value="PUT">
            <div class="mb-3">
                <input class="form-control" type="text" name="code" id="code" placeholder="Enter verification code">
            </div>
            
            <button class="btn btn-sm btn-primary form-control" type="submit">Verify</button>
        </form>
    </div>
    
</body>
</html>