# Magento 2 : Product SizeChart module based on Attribute Sets


## Main Functionalities
Magento 2 : Product SizeChart module based on Attribute Sets. This module allows you to set product sizechart image in 
Attribute Set. Based on the product attribute set, it will showcase the sizechart on frontend.

- Show sizechart on PDP based on the product Attribute Set
- Display sizechart to specific product types only
- The module comes with REST Api / GraphQl support

## Installation
In production please use the `--keep-generated` option

### Type 1: Install using Zip file

 - Unzip the zip file in `app/code/DevAwesome`
 - Enable the module by running `php bin/magento module:enable DevAwesome_Sizechart`
 - Apply database updates by running `php bin/magento setup:upgrade`\*
 - Flush the cache by running `php bin/magento cache:flush`

### Type 2: Install using Composer


 - Add the composer repository to the configuration by running `composer config repositories.repo.magento.com composer https://repo.magento.com/`
 - Install the module composer by running `composer require devawesome/module-sizechart`
 - enable the module by running `php bin/magento module:enable DevAwesome_Sizechart`
 - apply database updates by running `php bin/magento setup:upgrade`\*
 - Flush the cache by running `php bin/magento cache:flush`


## Configuration
