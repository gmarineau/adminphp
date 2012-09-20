<h1>Pages - <?php echo $page->title; ?></h1>

<div class="drop-bloc">

    <h2>Sections</h2>
    <?php
    $tabId = array();
    
    foreach($pagesSections as $pageSection)
    {
        $infoSection = current($section->getSection('id',$pageSection->id_sections));
        echo '<h3>'.$infoSection->section.'</h3>';
        echo '<ul class="drop-display page-section" id="'.$pageSection->id.'">';
            $tabDisplays = $display->getDisplays($pageSection->id);
            foreach($tabDisplays as $tabDisplay)
            {
                $infoType = current($this->type->getType('id',$tabDisplay->id_types));
                $function = 'get'.ucfirst($infoType->model);
                $model = $infoType->model;
                $field = $infoType->field;
                $infoContent = current($this->$model->$function('id',$tabDisplay->id_foreigns));
                $tabId[] = $infoType->id.'-'.$infoContent->id;
                echo '<li id="ct_'.$infoContent->id.$infoType->ext.'">'.$infoContent->$field.'</li>';
            }
        echo '</ul>'; 
    }
    ?>
</div>

<div class="drop-bloc left">
    
    <ul class="drop-display content" id="<?php echo $page->id; ?>">
    <?php
    
    foreach($types as $type)
    {
        $get = 'get'.ucfirst($type->type);
        $model = $type->model;
        $tabInfos = $this->$model->$get();
        echo '<h2>'.ucfirst($type->type).'</h2>';
        
        foreach($tabInfos as $tabInfo)
        {
            if(!in_array($type->id.'-'.$tabInfo->id,$tabId)) {
                $field = $type->field;
                echo '<li id="ct_'.$tabInfo->id.$type->ext.'">'.$tabInfo->$field.'</li>';
            }
        }
    }
    
    ?>
    </ul>
    
</div>