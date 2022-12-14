<div>
    <ul class="pagination d-flex justify-content-center">
        <li class="page-item">
            <a class="page-link <?= $activePrev ? "disabled" : "" ?>" href="
                        <?= "?genre=" . $_GET['genre'] . "&currentPage=prev," . $currentPage ?>
                        ">&laquo;</a>
        </li>
        <?php for ($i = 1; $i < $nbPage + 1; $i++) : ?>
            <li class="page-item active">
                <a class="page-link <?= $i === $activePage ? 'disabled' : '' ?>" href="
                        <?= "?genre=" . $_GET['genre'] . "&currentPage=$i" ?>
                        "><?= $i ?></a>
            </li>
        <?php endfor ?>
        <li class="page-item ">
            <a class="page-link <?= $activeNext ? "disabled" : "" ?>" href="
                        <?= "?genre=" . $_GET['genre'] . "&currentPage=next," . $currentPage ?>
                        ">&raquo;</a>
        </li>
    </ul>
</div>