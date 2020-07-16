<?php
    function count_items_in_cart(){
        return count((array)session()->get('carts'));
}


