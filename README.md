## TODO App with Lumen
The project it is API service to deal with tasking list and Categories List. 
User only able to access their own ToDo, Cateory list. 
 
## How to use
- Clone the repo
```
git clone https://github.com/ahmedzainsalem/lumen-toDO.git
```
- Set up database connection in the .env file:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_DATABASE=todo
DB_USERNAME=root
DB_PASSWORD=
```
- Make the database 'todo' or whatever you called it
- SSH into the virtual machine and run the following commands
```bash
cd /path/to/app/
```
```bash 
php artisan migrate
```
- Should just work!

# Header
- Content-Type: application/json
- Accept: application/json
- Authorization: Bearer <token>


you can find the APIs structure as follow:

##Api-files Folder ( contains )
-Auth
    *Login_api.docs
    *register_api.docs
-Category
    *category-create-API.docs
    *category-delete-API.docs
    *ategory-details-API.docs
    *category-get_all-API.docs
    *category-update-API.docs
-toDo
    *todo-create-API.docs
    *todo-delete-API.docs
    *todo-details-API.docs
    *todo-filter-all-API.docs
    *todo-filter-category-API.docs
    *todo-filter-month-API.docs
    *todo-filter-status-API.docs
    *todo-filter-year-API.docs
    *todo-get_all-API.docs
    *todo-update-API.docs
-User
    *All User API.docs
    *Profile_api.docs
    *user_by_id_api.docs
 



