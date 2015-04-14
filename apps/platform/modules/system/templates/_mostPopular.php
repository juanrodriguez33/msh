<section class="content secondHome">
    <div class="wrapper">
        <p class="head head1"><?=__('popular.destinations')?></p>
        <ul class="block steps">

            <li class="listContainer">
                <p class="index">
                    <p class="head head1"><?=__('popular.countries')?></p>
                </p>
                <ul class="li-gt shorter">
                    <?php foreach($aCountryList  as $country):?>
                        <li><a href="<?php echo MSHTools::getCountryUrl($country)?>"><?php echo $country->getTitle()?></a></li>
                    <?php endforeach; ?>
                </ul>
                <a href="<?=MSHTools::getChooseCountryUrl()?>"><?=__('popular.seeallcountries')?></a>
            </li>
            

            <li class="listContainer left">
                <p class="index">
                    <p class="head head1"><?=__('popular.regions')?></p>
                </p>
                <ul class="li-gt">
                    <?php foreach($aRegionList as $region):?>
                        <?php //to be fixed when an admin section is created, now hardcoding ?>
                        <?php if ($region->getTitle() == "Malaga"):?>
                            <li><a href="<?php echo MSHTools::getCountryRegionPropertiesUrl($region)?>"><?php echo $region->getTitle()?></a></li>
                        <?php else:?>
                            <li><a href="<?php echo MSHTools::getCountryRegionUrl($region)?>"><?php echo $region->getTitle()?></a></li>
                        <?php endif;?>
                    <?php endforeach; ?>
                </ul>
            </li>
            
            <li class="listContainer left">
                <p class="index">
                    <p class="head head1"><?=__('popular.cities')?></p>
                </p>
                <ul class="li-gt">
                    <?php foreach($aCityList as $city):?>
                        <?php $country = $city->getCountry()?>
                        <li><a href="<?php echo MSHTools::getCountryRegionCityUrl($city)?>"><?php echo $city->getTitle()?></a></li>
                    <?php endforeach; ?>
                </ul>
            </li>

        </ul>
    </div>
</section>