<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row mt-5 justify-content-center">
        <div class="col-md-12">
            <h1 class="text-center mt-5">Spesifikasi</h1>
        </div>
        <div class="col-md-5 mt-3">
            <img src="/img/<?= $product['image']; ?>" class="img-fluid">
        </div>

        <div class="col-md-5 mt-5">
            <ul class="list-group">
                <li class="list-group-item">
                    <h3><?= $product['brand']; ?> <?= $product['type']; ?></h3>
                </li>
                <li class="list-group-item">Harga : <?= $product['price']; ?></li>
                <li class="list-group-item">Operating System : <?= $product['os']; ?></li>
                <li class="list-group-item">CPU : <?= $product['cpu']; ?></li>
                <li class="list-group-item">RAM : <?= $product['ram']; ?></li>
                <li class="list-group-item">Storage : <?= $product['storage']; ?></li>
                <hr>
                <a href="#" class="btn btn-dark">Beli</a>
            </ul>
        </div>
    </div>

</div>

<?= $this->endSection(); ?>