<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>


# PKL MODUL 3 

Build a laravel project that integrated with PostgreSQL database

## 3.1 
 - Create products table with migration 
 - Create 3 pages : 
    - Home page : To see a list of all products
    - Add product page : To add product 
    - Edit product page : To edit product 

## 3.2
 - Create brands table with migration 
 - Implement best practice to the project :
    - Using services for business logic 
    - Route grouping 
    - Using laravel naming conventions
 - Implement form request for product, brand, register and login validation 
 - Create 3 pages :  
    - Brands page : To see a list of all brands
    - Add brand page : To add brand 
    - Edit brand page : To edit brand 

## 3.3
 - Update table products with migration :
    - Change brand collumn datatype to bigint and rename it to brand_id
 - Add one-to-one relation to products model 
 - Implement Repository Pattern to the project 