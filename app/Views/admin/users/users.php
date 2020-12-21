<?= $this->extend('admin/layout/template'); ?>

<?= $this->section('content-admin'); ?>

<!-- Start Card -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <form action="" method="POST">
                <div class="input-group mt-5">
                    <input type="text" class="form-control" placeholder="Cari product.." name="keyword">
                    <div class="input-group-append">
                        <button class="btn btn-dark" type="submit" name="submit"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-search" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z" />
                                <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z" />
                            </svg></button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row mt-2 justify-content-center">
        <table class="table table-hover table-bordered">
            <tr class="table-active">
                <th>No.</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Handphone</th>
            </tr>
            <?php foreach ($product as $p) : ?>
                <tr>
                    <td>1</td>
                    <td>Diki Fauzi</td>
                    <td>email@gmail.com</td>
                    <td>081231223444</td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>
<!-- End Card -->

<?= $this->endSection(); ?>