# abilto

## Simple Forum built on Laravel 5
####Functionalities:

1. Register user
2. Login User
3. Edit User Profile
3. Submit a post
4. Submit comment to a post
5. User is only allowed to be logged in from one browser at a time

####Added Models:

1. User
2. Post
3. Comment

####Added Controllers:

1. ForumController
2. PostController
3. UserController

####Added Test Cases:

1. CommentAcceptanceTest
2. PostAcceptanceTest
3. UserAcceptanceTest
4. CommentTest
5. PostTest
6. UserTest

To setup:

1.``` git clone https://github.com/ezraundag/abilto.git ```

2.``` cd abilto ```

3.```composer update```

4.```php artisan migrate```

5.To run test: ```phpunit```

when InvalidArgumentException in FileViewFinder.php is encountered, run the following

```homestead> php artisan config:cache```

```homestead> php artisan config:clear```
