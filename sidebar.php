<aside class="fash_sidebar">
    <?php
    if(is_home()){
        if(is_active_sidebar('fst_wgs')){
            dynamic_sidebar('fst_wgs');
        }
    } else {
        if(is_active_sidebar('fst_singluar_wgs')){
            dynamic_sidebar('fst_singluar_wgs');
        }
    }
    ?>
</aside>