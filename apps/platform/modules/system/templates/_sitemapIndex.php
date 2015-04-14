<?= '<?'?>xml version="1.0" encoding="UTF-8" ?>
<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <?php foreach($aSitemaps as $aSitemap):?>
    <sitemap>
        <loc><?=$aSitemap['loc']?></loc>
        <lastmod><?=$aSitemap['lastmod']?></lastmod>
    </sitemap>
    <?php endforeach; ?>
</sitemapindex>