<?php
function inc_number(&$i = 0){
    $i++;
    return $i;
}

function get_image_product($products_id){
    $product = App\Models\Product::find($products_id);
    return '/products/small/'.$product->image;
}
function get_parent_id(){
    
}

