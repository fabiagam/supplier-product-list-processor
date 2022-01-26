# supplier-product-list-processor
A PHP-based supplier product list processor that runs on terminal to generate output files (csv, xml, json) with a grouped count for each unique combination
## Setup Instructions

**Note**  
Kindly ensure the machine to be used in launching this project  has PHP >= v7.0.x  already installed.

**Stack Requirements**  
```
1. PHP 7.3
2. Composer
```

**How to run the processor app**  
### 1) Clone the repository and install composer dependencies if not already installed

``` 
//on local
git clone https://github.com/fabiagam/supplier-product-list-processor.git
cd supplier-product-list-processor
```
**To run the parser file on the terminal:**  
``` 
php parser.php --file products_comma_separated.csv --unique-combinations=combination_count.csv`
``` 

# 1: Requirements 
- Ensure PHP installation path is set in environment variables (For windows use)

# 2: Considerations and Development Approach 
When working on this task the following were considered:

- Using the File Iterator class from PHP Generators 
- This is largely due toconsiderations for large files to parse
- The generators controll keywords such as 'yield; was used to pause execution of rlines of data from CSV file
- PHPUnit tests was written to validate data streamed from CSV filechecks correctly by asserting for boolean feedbacks
- composer was used to manage package dependencies fir PHP unit tests
- ![Unit_test_screen](https://user-images.githubusercontent.com/1788922/151258426-f3db9f89-2291-4dd2-9139-cb42f2b295d5.png)
