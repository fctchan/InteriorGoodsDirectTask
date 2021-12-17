# InteriorGoodsDirectTask
Created by Frankie, Chun Ting, Chan on 17.12.2021

# Description
This task is using laravel in MVC and MySQL as database to build the program.

# Functionality
1) Showing top 10 highest average score players with finished 10 games or more
2) Can be browsed the player game record with highest score match (Play with, result and game date)
3) List all players' profile
4) Can be edited player' profile

# How to run
1) To create a database
- php artisan db:create igdgame

2) Use the migration to create table
- php artisan make:migration

3) Use seeder to create fake data into database
- php artisan db:seed --class=DatabaseSeeder
 
