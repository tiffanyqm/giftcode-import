## Super Simple Mass Import for Shopify Gift Codes

This insanely simple set of PHP files will mass import gift codes into a Shopify store leveraging Private App credentials. It is intended for one-time use to prevent shop admins from recreating gift codes by hand. (It should run fast enough to allow a pretty seamless cutover from an old system.) [Note that the Gift Card resource is available to Shopify Plus merchants only.](https://help.shopify.com/api/reference/gift_card)

## Installation

- You need all php files. The code could all live in one file, but this structure permits some future expansion.
- The business happens inside process.php. 

## Usage

- Format your gift codes list like giftcards_sample.csv
- Save as giftcards.csv and upload to the same directory that houses process.php
- Call process.php
- Remove code and/or CSV, because this is intended for one-time use only.

## Resources

- [Shopify API: Gift Cards](https://help.shopify.com/api/reference/gift_card)
- [Shopify Private App Credentials](https://help.shopify.com/api/guides/api-credentials#generate-private-app-credentials)

## Contribute

Contributions are always welcome!


