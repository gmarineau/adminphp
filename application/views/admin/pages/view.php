<h1>Pages</h1>



<div class="drop-bloc ">
<h2><?php echo $page->title; ?></h2>
    <ul class="drop page" id="<?php echo $page->id; ?>">
    <?php
    $tabId = array();
    
    foreach($pagesSections as $pageSection)
    {
        $infoSection = current($section->getSection('id',$pageSection->id_sections));
        echo '<li id="sec_'.$infoSection->id.'">'.$infoSection->section.'</li>';
        $tabId[] = $pageSection->id_sections;
    }
    
    ?>
    </ul>
</div>

<div class="drop-bloc left">
    
    <h2>Sections</h2>
    <ul class="drop section" id="<?php echo $page->id; ?>">
    <?php
    foreach($sections as $section)
    {
        if(!in_array($section->id,$tabId)) {
            echo '<li id="sec_'.$section->id.'">'.$section->section.'</li>';
        }
    }
    ?>
    </ul>
</div>