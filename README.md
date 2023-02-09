# DevAwesome SizeChart for Magento 2

## Main Functionalities
Magento 2 : Product SizeChart module based on Attribute Sets. This module allows you to set product sizechart image in 
Attribute Set. Based on the product attribute set, it will showcase the sizechart on frontend.

- Show sizechart on PDP based on the product Attribute Set
- Display sizechart to specific product types only
- The module comes with REST Api / GraphQl support

## How to install & upgrade DevAwesome_Sizechart

### 1. Install via composer (recommend)

We recommend you to install DevAwesome_Sizechart module via composer. It is easy to install, update and maintaince.

Run the following command in Magento 2 root folder.

#### 1.1 Install

```
composer require devawesome/module-sizechart
php bin/magento setup:upgrade
php bin/magento setup:static-content:deploy
```

#### 1.2 Upgrade

```
composer update devawesome/module-sizechart
php bin/magento setup:upgrade
php bin/magento setup:static-content:deploy
```

Run compile if your store in Product mode:

```
php bin/magento setup:di:compile
```

### 2. Copy and paste

If you don't want to install via composer, you can use this way.

- Download [the latest version here](https://github.com/rahulbarot/magento2-Sizechart/archive/refs/heads/master.zip)
- Extract `master.zip` file to `app/code/DevAwesome/Sizechart` ; You should create a folder path `app/code/DevAwesome/Sizechart` if not exist.
- Go to Magento root folder and run upgrade command line to install `DevAwesome_Sizechart`:

```
php bin/magento setup:upgrade
php bin/magento setup:static-content:deploy
```
