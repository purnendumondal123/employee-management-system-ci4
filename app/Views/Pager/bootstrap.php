<?php

use CodeIgniter\Pager\PagerRenderer;

/**
 * @var PagerRenderer $pager
 */

$pager->setSurroundCount(2);

if ($pager->getPageCount() <= 1) {
    return;
}
?>

<nav aria-label="Page navigation">
    <ul class="pagination justify-content-center">

        <!-- Previous -->
        <?php if ($pager->hasPrevious()) : ?>
            <li class="page-item">
                <a class="page-link" href="<?= $pager->getPrevious() ?>" aria-label="Previous">
                    Previous
                </a>
            </li>
        <?php else : ?>
            <li class="page-item disabled">
                <span class="page-link">Previous</span>
            </li>
        <?php endif; ?>

        <!-- Page Numbers -->
        <?php foreach ($pager->links() as $link) : ?>

            <?php if ($link['active']) : ?>

                <li class="page-item active" aria-current="page">
                    <span class="page-link"><?= $link['title'] ?></span>
                </li>

            <?php else : ?>

                <li class="page-item">
                    <a class="page-link" href="<?= $link['uri'] ?>">
                        <?= $link['title'] ?>
                    </a>
                </li>

            <?php endif; ?>

        <?php endforeach; ?>

        <!-- Next -->
        <?php if ($pager->hasNext()) : ?>
            <li class="page-item">
                <a class="page-link" href="<?= $pager->getNext() ?>" aria-label="Next">
                    Next
                </a>
            </li>
        <?php else : ?>
            <li class="page-item disabled">
                <span class="page-link">Next</span>
            </li>
        <?php endif; ?>

    </ul>
</nav>