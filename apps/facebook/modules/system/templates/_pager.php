
<ul id="<?=$id?>" class="pager">
  <?php $start  = $iCurPage - 2 ?>
  <?php $stop   = $iCurPage + 2 ?>
  <?php if($start >= 2): ?>
    <li <?=$iCurPage==1? 'class="active"' : ''?>>
        <a href="<?=$sUrl?>?page=1" title="Ga naar pagina 1">1</a>
    </li>
  <?php endif; ?>
  <?php if($start >= 3): ?>
    <li class="liEllipsis">...</li>
  <?php endif; ?>
  <?php for($page = $start; $page <= $stop; $page++): ?>
    <?php if($page > 0 && $page <= $iPageCount): ?>
      <?php if($page == $iCurPage): ?>
        <li class="active">
      <?php else: ?>
        <li>
      <?php endif; ?>
        <a href="<?=$sUrl?>?page=<?=$page?>" title="Ga naar pagina <?php echo $page ?>"><?php echo $page ?></a>
      </li>
    <?php endif; ?>
  <?php endfor; ?>
  <?php if($stop < $iPageCount - 1): ?>
    <li class="liEllipsis">...</li>
  <?php endif; ?>
  <?php if($stop < $iPageCount): ?>
    <li><a href="<?=$sUrl?>?page=<?=$page?>" title="Ga naar pagina <?php echo $iPageCount ?>"><?php echo $iPageCount ?></a></li>
  <?php endif; ?>
</ul>


<?php /*
<ul id="ul_top_pager" class="pager">
    <li <?=$iCurPage==1? 'class="active"' : ''?>><a href="<?=$sUrl?>?page=1" title="Ga naar pagina 1">1</a></li>
    <?php for($i=2; $i<= $iPageCount; $i++): ?>
        <li <?=$iCurPage==$i? 'class="active"' : ''?>><a href="<?=$sUrl?>?page=<?=$i?>" title="Ga naar pagina <?=$i?>"><?=$i?></a></li>
    <?php endfor; ?>
</ul>*/
?>

<?php /*
<ul id="ul_pager" class="pager">
    <li <?=$iCurPage==1? 'class="active"' : ''?>><a href="<?=$sUrl?>?page=1" title="Ga naar pagina 1">1</a></li>
    <?php for($i=2; $i<= $iPageCount; $i++): ?>
        <li <?=$iCurPage==$i? 'class="active"' : ''?>><a href="<?=$sUrl?>?page=<?=$i?>" title="Ga naar pagina <?=$i?>"><?=$i?></a></li>
    <?php endfor; ?>
</ul>
*/?>