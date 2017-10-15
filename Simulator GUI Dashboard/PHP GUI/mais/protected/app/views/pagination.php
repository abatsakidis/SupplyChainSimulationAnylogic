<ul class="pagination">
    <li><a href="<?php echo $paginator->getUrl(1) ?>">&laquo;</a></li>
 
    <?php for ($i=1; $i <= $paginator->getLastPage(); $i++): ?>
        <li <?php echo ($i == $paginator->getCurrentPage() ? 'class="active"' : '') ?>><a href="<?php echo $paginator->getUrl($i) ?>"><?php echo $i ?></a></li>
    <?php endfor ?>    <li><a href="<?php echo $paginator->getLastPage() ?>">&raquo;</a></li>
</ul>