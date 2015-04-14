<?php

class myUser extends MSHWebsiteUser
{
    public function getResultsPage() {
        $sSection = $this->getSearchSection();
        return $this->getAttribute("search_page_".$sSection, 1);
    }

    public function setResultsPage($iPage) {
        $sSection = $this->getSearchSection();
        $this->setAttribute("search_page_".$sSection, $iPage);
    }
}
