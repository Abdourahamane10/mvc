<div class="blog-post">
    <h3><?= $article->title() ?> <small>16 Janvier 2019</small></h3>
    <!-- <img class="thumbnail" src="<?php echo "/public/images/07_route_glace.png"; ?>"style="width: 100%;"> -->
    <?= $article->content() ?>
    <div class="callout">
        <ul class="menu simple">
            <li><a href="<?php echo BASE_URL . "?action=author&name=mike" ?>">Auteur: Mike Mikers</a></li>
        </ul>
    </div>
</div>