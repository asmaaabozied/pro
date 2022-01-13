<?php
/**
 * Product English Language Messages.
 *
 * @author Amk El-Kabbany at 19 May 2020
 * @contact alaa@upbeatdigital.teamm
 */
$array = [

    /*
    |--------------------------------------------------------------------------
    | Product English Messages
    |--------------------------------------------------------------------------
    |
    | The following English lines are used in Product module related actions. These messages
    | that needed to display to the user.
    |
    */
    'menu'  => 'Products',
    'fields' => [
        'preview_button' => 'Preview Main Image',
        'current_image' => 'Uploaded Main Image',
        'title_en' => 'Product Title',
        'title_en_help' => 'Please, enter the product title here',
        'description_en' => 'Product Description',
        'description_en_help' => 'Please, enter the product description here',
        'store_id' => 'Store',
        'store_id_help' => 'Please, choose the product here',
        'category_id' => 'Category',
        'category_id_help' => 'Please, choose the category here',
        'brand_id' => 'Brand',
        'brand_id_help' => 'Please, choose the brand here',
        'image' => 'Main Image',
        'image_help' => 'Please, choose product valid image here',
        'images' => 'Product Images',
        'images_help' => 'Please, choose product valid images here',
        'price' => 'Product Price',
        'price_help' => 'Please, enter product price here',
        'quantity' => 'Stock Quantity',
        'weight'   => 'Weight (in Kilograms)',
        'width'    => 'Width',
        'length'   => 'Length',
        'height'   => 'Height',
        'quantity_help' => 'Please, enter product quantity here',
        'discount_rate' => 'Discount Rate',
        'discount_rate_help' => 'Please, enter product discount rate here',
        'discount_end_date' => 'Discount End Date',
        'discount_end_date_help' => 'Please, pick product discount end date here',
        'discount_start_date' => 'Discount Start Date',
        'discount_start_date_help' => 'Please, pick product discount start date here',
        'discount' => 'Have Discount?',
        'discount_help' => 'Please, choose wither this product is have discount or not here',
        'active' => 'Is It Available?',
        'active_help' => 'Please, choose wither this product is available or not here',
        'in_slider'  => 'Is It in Page Category Slider',
        'in_slider_help' => 'Please, choose wither this product is in page category slider',
        'featured' => 'Is It Featured?',
        'featured_help' => 'Please, choose wither this product is featured or not here',
        'related_products' => 'Related Products',
        'related_products_help' => 'Please, choose wither this product is related products here',
        'category_attributes'  => [
            'header' => 'Selected Category Attributes',
            'title_en' => 'Attribute Title',
            'title_en_help' => 'Please, enter the paragraph title here',
            'description_en' => 'Attribute Description',
            'description_en_help' => 'Please, enter the paragraph description here',
            'value_en' => 'Attribute Value',
            'value_en_help' => 'Please, enter the paragraph value here',
            'active' => 'Is It Active?',
            'activated_help' => 'Please, choose wither this Attribute is active or not here',
        ],
        'product_images'  => [
            'header' => 'This Product Uploaded Images',
            'active' => 'Is It Active?',
            'main' => 'Is It Product Main Image?',
            'image' => 'Product Image?',
        ],
        'related_products_tab'  => [
            'header' => 'This Product Related Products',
            'title'  => 'Product Title',
        ],
        'favourites'  => [
            'header' => 'Users Who Favorite This Product',
            'user' => 'User Name',
            'ip' => 'IP',
        ],
    ],
    'messages' => [
        'created'   => 'Product has been created successfully.',
        'updated'   => 'Product has been updated successfully.',
        'deleted'   => 'Requested product has been deleted successfully.',
        'retrieved' => 'Requested product/s has been retrieved successfully.',
        'not_found' => 'Requested product is not found',
        'errors'    => [
            'created'   => 'Sorry product can not be created, Please try Again!.',
        ],
    ],
    'notifications' => [
        'new_product' => 'New product has been added, check it out'
    ]
];

$array = alterLangFiles('products', $array, $key = 'fields', 'en');
$array['fields'] = alterLangFiles('products_attributes', $array['fields'], $key = 'category_attributes', 'en');
return $array;
